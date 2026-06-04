<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Contato — Solicite um orçamento | Godai';
$pageDesc  = 'Fale com a Godai Terapias Integrativas e leve a Quick Massage Corporativa para a sua empresa em Indaiatuba/SP e região.';
$s = get_settings();

$wppRedirect = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']     ?? '');
    $empresa  = trim($_POST['empresa']  ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $email    = trim($_POST['email']    ?? '');
    $cidade   = trim($_POST['cidade']   ?? '');
    $tipo     = trim($_POST['tipo']     ?? '');
    $qtd      = trim($_POST['colaboradores'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $text = "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.\n\n"
          . "Nome: $nome\nEmpresa: $empresa\nWhatsApp: $whatsapp\nE-mail: $email\nCidade: $cidade\n"
          . "Tipo de atendimento: $tipo\nQuantidade de colaboradores: $qtd\n\nMensagem: $mensagem";
    $wppRedirect = whatsapp_link($text);
}

include __DIR__ . '/includes/header.php';
?>

<section class="page-hero container">
  <span class="eyebrow">Contato</span>
  <h1 style="margin-top:24px;">Solicite um orçamento</h1>
  <p>A Godai oferece experiências de bem-estar voltadas ao cuidado, valorização e qualidade de vida no ambiente corporativo.</p>
</section>

<section class="bg-white" style="padding:30px 0 0;">
  <div class="container">
    <div class="bullet-list" style="margin-top:0;">
      <?php foreach (['Atendimento personalizado','Estrutura inclusa','Atendimento corporativo','Flexibilidade de horários'] as $d): ?>
        <div class="item"><?= e($d) ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="container" style="padding:60px 0 100px;">
  <div class="grid grid-2" style="align-items:start;">
    <div>
      <h2>Vamos conversar.</h2>
      <p class="lead" style="margin-top:18px;">Preencha o formulário ou fale conosco diretamente. Respondemos rapidamente com uma proposta personalizada.</p>
      <ul class="contact-info">
        <li class="line"><span class="ico">📍</span> <?= e($s['city']) ?></li>
        <li class="line"><span class="ico">✉</span> <a href="mailto:<?= e($s['email']) ?>"><?= e($s['email']) ?></a></li>
        <li class="line"><span class="ico">💬</span> <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener">WhatsApp</a></li>
        <li class="line"><span class="ico">◎</span> <a href="<?= e($s['instagram']) ?>" target="_blank" rel="noopener">Instagram</a></li>
      </ul>
      <div style="margin-top:36px;padding:22px;border:1px solid var(--border);border-radius:14px;background:rgba(244,241,234,.4);">
        <p style="font-size:.72rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:var(--sage);">Área de atendimento</p>
        <p style="margin-top:8px;color:var(--sage-deep);">Indaiatuba/SP — demais regiões mediante consulta.</p>
      </div>
    </div>

    <form method="post" class="contact-card" id="contactForm">
      <?php if ($wppRedirect): ?>
        <div class="alert alert-success">
          Mensagem encaminhada! Continue a conversa pelo
          <a href="<?= e($wppRedirect) ?>" target="_blank" rel="noopener" style="font-weight:600;color:var(--sage);">WhatsApp</a>.
        </div>
        <script>window.open(<?= json_encode($wppRedirect) ?>, '_blank');</script>
      <?php endif; ?>
      <div class="field"><label>Nome</label><input type="text" name="nome" maxlength="100" required></div>
      <div class="field"><label>Empresa</label><input type="text" name="empresa" maxlength="120" required></div>
      <div class="field-row">
        <div class="field"><label>WhatsApp</label><input type="tel" name="whatsapp" maxlength="20" required></div>
        <div class="field"><label>E-mail</label><input type="email" name="email" maxlength="150" required></div>
      </div>
      <div class="field-row">
        <div class="field"><label>Cidade</label><input type="text" name="cidade" maxlength="80" required></div>
        <div class="field">
          <label>Tipo de atendimento</label>
          <select name="tipo" required>
            <option value="" disabled selected>Selecione</option>
            <option>Avulso / Ação Pontual</option>
            <option>Pacote Corporativo</option>
            <option>Programa Corporativo</option>
            <option>SIPAT / Evento</option>
          </select>
        </div>
      </div>
      <div class="field" style="margin-top:18px;"><label>Quantidade de colaboradores</label><input type="number" name="colaboradores" min="1" required></div>
      <div class="field" style="margin-top:18px;">
        <label>Mensagem</label>
        <textarea name="mensagem" rows="4" maxlength="1000" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-pill" style="margin-top:24px;width:100%;justify-content:center;">Enviar orçamento ✈</button>
    </form>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
