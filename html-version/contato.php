<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Contato — Solicite um orçamento | Godai';
$pageDesc  = 'Fale com a Godai Terapias Integrativas e leve a Quick Massage Corporativa para a sua empresa em Indaiatuba/SP e região.';
$s = get_settings();

// Construção da mensagem do WhatsApp ao enviar formulário (server-side fallback).
$wppRedirect = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']     ?? '');
    $empresa  = trim($_POST['empresa']  ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email    = trim($_POST['email']    ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $text = "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.\n\n"
          . "Nome: $nome\nEmpresa: $empresa\nTelefone: $telefone\nE-mail: $email\n\nMensagem: $mensagem";
    $wppRedirect = whatsapp_link($text);
}

include __DIR__ . '/includes/header.php';
?>
<section class="container" style="padding: 80px 0;">
  <div class="grid grid-2">
    <div>
      <span class="eyebrow">Contato</span>
      <h1 style="margin-top: 16px;">Vamos conversar sobre o bem-estar da sua equipe.</h1>
      <p class="lead" style="margin-top: 24px;">Preencha o formulário ou fale conosco diretamente. Respondemos rapidamente com uma proposta personalizada.</p>
      <ul class="contact-info">
        <li class="line"><span class="ico">📍</span> <?= e($s['city']) ?></li>
        <li class="line"><span class="ico">✉</span> <a href="mailto:<?= e($s['email']) ?>"><?= e($s['email']) ?></a></li>
        <li class="line"><span class="ico">💬</span> <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener">WhatsApp</a></li>
        <li class="line"><span class="ico">◎</span> <a href="<?= e($s['instagram']) ?>" target="_blank" rel="noopener">Instagram</a></li>
      </ul>
    </div>

    <form method="post" class="contact-card" id="contactForm">
      <?php if ($wppRedirect): ?>
        <div class="alert alert-success">
          Mensagem encaminhada! Continue a conversa pelo
          <a href="<?= e($wppRedirect) ?>" target="_blank" rel="noopener" style="font-weight:600; color: var(--sage);">WhatsApp</a>.
        </div>
        <script>window.open(<?= json_encode($wppRedirect) ?>, '_blank');</script>
      <?php endif; ?>
      <div class="field"><label>Nome</label><input type="text" name="nome" maxlength="100" required></div>
      <div class="field"><label>Empresa</label><input type="text" name="empresa" maxlength="120" required></div>
      <div class="field-row">
        <div class="field"><label>Telefone</label><input type="tel" name="telefone" maxlength="20" required></div>
        <div class="field"><label>E-mail</label><input type="email" name="email" maxlength="150" required></div>
      </div>
      <div class="field" style="margin-top: 18px;">
        <label>Mensagem</label>
        <textarea name="mensagem" rows="4" maxlength="1000" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-pill" style="margin-top: 24px; width: 100%; justify-content: center;">Solicitar orçamento ✈</button>
    </form>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
