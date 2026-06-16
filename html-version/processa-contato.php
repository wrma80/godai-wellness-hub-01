<?php
// Handler do formulário de contato / orçamento.
// 1) Valida + sanitiza
// 2) Salva a mensagem em data/messages.json (histórico do painel)
// 3) Envia e-mail via SMTP (Locaweb) usando includes/mailer.php

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/mailer.php';

header('Content-Type: application/json; charset=utf-8');

function respond(int $status, array $body): void {
    http_response_code($status);
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, ['ok' => false, 'message' => 'Método não permitido.']);
}

// Rate limit básico por sessão (1 envio a cada 30s)
$now = time();
$last = $_SESSION['contact_last_send'] ?? 0;
if ($now - $last < 30) {
    respond(429, ['ok' => false, 'message' => 'Aguarde alguns segundos antes de enviar novamente.']);
}

// Honeypot
if (!empty(trim((string)($_POST['website'] ?? '')))) {
    respond(200, ['ok' => true, 'message' => 'Sua solicitação foi enviada com sucesso. Em breve nossa equipe entrará em contato.']);
}

function clean(string $v, int $max = 500): string {
    $v = trim($v);
    $v = preg_replace("/[\r\n]+/", ' ', $v);
    if (mb_strlen($v) > $max) $v = mb_substr($v, 0, $max);
    return $v;
}

$nome           = clean((string)($_POST['nome'] ?? ''), 100);
$empresa        = clean((string)($_POST['empresa'] ?? ''), 120);
$whatsapp       = clean((string)($_POST['whatsapp'] ?? ''), 30);
$telefone       = clean((string)($_POST['telefone'] ?? ''), 30);
$email          = clean((string)($_POST['email'] ?? ''), 150);
$cidade         = clean((string)($_POST['cidade'] ?? ''), 80);
$tipo           = clean((string)($_POST['tipo'] ?? ''), 80);
$colaboradores  = clean((string)($_POST['colaboradores'] ?? ''), 10);
$mensagemRaw    = trim((string)($_POST['mensagem'] ?? ''));
$mensagem       = mb_substr($mensagemRaw, 0, 2000);

$errors = [];
if ($nome === '')                         $errors[] = 'Informe seu nome.';
if ($empresa === '')                      $errors[] = 'Informe a empresa.';
if ($whatsapp === '' && $telefone === '') $errors[] = 'Informe um WhatsApp ou telefone.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'E-mail inválido.';
if ($cidade === '')                       $errors[] = 'Informe a cidade.';
if ($mensagem === '')                     $errors[] = 'Escreva uma mensagem.';

if ($errors) respond(422, ['ok' => false, 'message' => implode(' ', $errors)]);

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
$ip = trim(explode(',', (string)$ip)[0]);
$dataHora = date('d/m/Y H:i:s');

// 1) Salvar no histórico (sempre, mesmo se SMTP falhar — para não perder o lead)
$record = [
    'id'           => 'm' . substr(bin2hex(random_bytes(6)), 0, 10),
    'nome'         => $nome,
    'empresa'      => $empresa,
    'email'        => $email,
    'whatsapp'     => $whatsapp,
    'telefone'     => $telefone,
    'cidade'       => $cidade,
    'tipo'         => $tipo,
    'colaboradores'=> $colaboradores,
    'mensagem'     => $mensagem,
    'ip'           => $ip,
    'created_at'   => date('c'),
];
$msgs = load_json('messages', []);
array_unshift($msgs, $record);
if (count($msgs) > 2000) $msgs = array_slice($msgs, 0, 2000);
save_json('messages', $msgs);

// 2) Preparar e-mail
$settings = get_settings();
$destino  = filter_var($settings['contactEmail'] ?? $settings['email'] ?? '', FILTER_VALIDATE_EMAIL)
            ?: 'contato@godaiterapias.com.br';

$esc = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$linhasMsg = nl2br($esc($mensagem));

$html = '<div style="font-family:Arial,sans-serif;background:#f5f3ee;padding:24px;color:#2b2b2b;">'
      . '<div style="max-width:620px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e6e2d8;">'
      . '<div style="background:#6b7d63;padding:22px 28px;color:#fff;">'
      . '<h1 style="margin:0;font-size:18px;font-weight:600;">Novo Pedido de Orçamento</h1>'
      . '<p style="margin:6px 0 0;font-size:13px;opacity:.85;">Godai Terapias Integrativas</p>'
      . '</div>'
      . '<div style="padding:24px 28px;font-size:14px;line-height:1.55;">'
      . '<table style="width:100%;border-collapse:collapse;">'
      . '<tr><td style="padding:6px 0;color:#6b7d63;width:200px;"><strong>Nome</strong></td><td style="padding:6px 0;">' . $esc($nome) . '</td></tr>'
      . '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>Empresa</strong></td><td style="padding:6px 0;">' . $esc($empresa) . '</td></tr>'
      . ($telefone !== '' ? '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>Telefone</strong></td><td style="padding:6px 0;">' . $esc($telefone) . '</td></tr>' : '')
      . ($whatsapp !== '' ? '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>WhatsApp</strong></td><td style="padding:6px 0;">' . $esc($whatsapp) . '</td></tr>' : '')
      . '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>E-mail</strong></td><td style="padding:6px 0;">' . $esc($email) . '</td></tr>'
      . '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>Cidade</strong></td><td style="padding:6px 0;">' . $esc($cidade) . '</td></tr>'
      . ($tipo !== '' ? '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>Tipo</strong></td><td style="padding:6px 0;">' . $esc($tipo) . '</td></tr>' : '')
      . ($colaboradores !== '' ? '<tr><td style="padding:6px 0;color:#6b7d63;"><strong>Qtd. colaboradores</strong></td><td style="padding:6px 0;">' . $esc($colaboradores) . '</td></tr>' : '')
      . '</table>'
      . '<hr style="border:none;border-top:1px solid #ece8de;margin:18px 0;">'
      . '<p style="color:#6b7d63;margin:0 0 6px;"><strong>Mensagem</strong></p>'
      . '<div style="background:#faf8f2;border:1px solid #ece8de;border-radius:8px;padding:14px;">' . $linhasMsg . '</div>'
      . '<hr style="border:none;border-top:1px solid #ece8de;margin:18px 0;">'
      . '<p style="font-size:12px;color:#888;margin:0;">Enviado em ' . $esc($dataHora) . ' &middot; IP ' . $esc($ip) . '</p>'
      . '<p style="font-size:12px;color:#888;margin:6px 0 0;">Disponível também em: Painel &rarr; Mensagens recebidas.</p>'
      . '</div></div></div>';

$alt = "Novo Pedido de Orçamento - Godai\n\n"
     . "Nome: $nome\nEmpresa: $empresa\n"
     . ($telefone !== '' ? "Telefone: $telefone\n" : '')
     . ($whatsapp !== '' ? "WhatsApp: $whatsapp\n" : '')
     . "E-mail: $email\nCidade: $cidade\n"
     . ($tipo !== '' ? "Tipo: $tipo\n" : '')
     . ($colaboradores !== '' ? "Colaboradores: $colaboradores\n" : '')
     . "\nMensagem:\n$mensagem\n\nEnviado em $dataHora — IP $ip";

// 3) Enviar e-mail
if (!smtp_configured()) {
    @file_put_contents(GODAI_DATA . '/contact-pending.log',
        "[$dataHora] SMTP não configurado. De: $email — $nome ($empresa)\n", FILE_APPEND);
    // Mensagem já salva — responder sucesso para o usuário (lead preservado no painel).
    $_SESSION['contact_last_send'] = $now;
    respond(200, ['ok' => true, 'message' => 'Sua solicitação foi recebida com sucesso. Em breve nossa equipe entrará em contato.']);
}

$result = send_mail($destino, 'Novo Pedido de Orçamento - Godai Terapias Integrativas', $html, $alt, $email, $nome);

if ($result['ok']) {
    $_SESSION['contact_last_send'] = $now;
    respond(200, ['ok' => true, 'message' => 'Sua solicitação foi enviada com sucesso. Em breve nossa equipe entrará em contato.']);
} else {
    // E-mail falhou mas a mensagem foi salva no painel.
    $_SESSION['contact_last_send'] = $now;
    respond(200, ['ok' => true, 'message' => 'Sua solicitação foi recebida. Nossa equipe retornará em breve.']);
}
