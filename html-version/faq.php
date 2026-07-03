<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'FAQ — Perguntas frequentes | Godai';
$pageDesc  = 'Tire suas dúvidas sobre a Quick Massage Corporativa da Godai: estrutura, atendimento, regiões, nota fiscal e mais.';
include __DIR__ . '/includes/header.php';
$faq = get_faq();

?>

<section class="page-hero container fade-up">
  <span class="eyebrow">FAQ</span>
  <h1 style="margin-top:24px;">Perguntas frequentes</h1>
  <p>Reunimos as dúvidas mais comuns sobre a Quick Massage Corporativa.</p>
</section>

<section style="background:var(--cream);">
  <div class="container">
    <div class="accordion">
      <?php foreach ($faq as $i => $item): ?>
        <div class="accordion-item<?= $i === 0 ? ' is-open' : '' ?>">
          <button type="button" class="accordion-q" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
            <span><?= e($item['question']) ?></span>
            <span class="toggle" aria-hidden="true">⌄</span>
          </button>
          <div class="accordion-a"><?= e($item['answer']) ?></div>
        </div>
      <?php endforeach; ?>
      <?php if (empty($faq)): ?>
        <p style="text-align:center;padding:40px 0;color:var(--muted);">Nenhuma pergunta cadastrada no momento.</p>
      <?php endif; ?>
    </div>
    </div>
  </div>
</section>

<section class="bg-sage">
  <div class="container cta-block">
    <h2>Ainda ficou com dúvidas?</h2>
    <div class="actions">
      <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-cream btn-pill">💬 Falar no WhatsApp</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
