<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Quick Massage Corporativa — Godai Terapias Integrativas';
$pageDesc  = 'Quick Massage in company: sessões de 10 a 15 minutos com cadeira ergonômica para alívio de tensões e bem-estar dos colaboradores.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero container">
  <span class="eyebrow">Quick Massage</span>
  <h1 style="margin-top:24px;">Quick Massage Corporativa</h1>
  <p>Experiências voltadas à redução do estresse, alívio de tensões musculares e promoção da qualidade de vida no ambiente corporativo.</p>
  <div style="margin-top:32px;">
    <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento →</a>
  </div>
</section>

<section class="bg-white">
  <div class="container grid grid-2">
    <div>
      <span class="eyebrow">O que é</span>
      <h2 style="margin-top:16px;">O que é a Quick Massage</h2>
      <p style="color:var(--muted);margin-top:18px;line-height:1.7;">A Quick Massage é uma técnica de massoterapia focada no alívio rápido de tensões musculares, realizada em cadeira ergonômica especialmente desenvolvida para proporcionar conforto e praticidade.</p>
      <p style="color:var(--muted);margin-top:14px;line-height:1.7;">Com sessões de 10 a 15 minutos, o atendimento é realizado com o colaborador sentado e vestido, tornando a experiência prática, eficiente e ideal para o ambiente corporativo.</p>
    </div>
    <div style="border-radius:20px;overflow:hidden;box-shadow:var(--shadow-xl);">
      <img src="<?= e(base_url('assets/img/hero-massage.jpg')) ?>" alt="Sessão Quick Massage" loading="lazy" style="aspect-ratio:4/3;width:100%;object-fit:cover;">
    </div>
  </div>
</section>

<section style="background:var(--cream);">
  <div class="container">
    <span class="eyebrow">Processo</span>
    <h2 style="margin-top:16px;">Como funciona</h2>
    <div class="como-grid">
      <?php foreach (['Atendimento realizado na empresa','Sessões de 10 a 15 minutos','Cadeira ergonômica inclusa','Sem necessidade de troca de roupa'] as $c): ?>
        <div class="como-item"><span class="ico">⏱</span><p><?= e($c) ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-sage">
  <div class="container">
    <span class="eyebrow on-dark">Benefícios</span>
    <h2 style="margin-top:16px;">Principais benefícios</h2>
    <div class="benefits">
      <?php foreach (['Redução do estresse','Relaxamento muscular','Melhora da circulação','Mais disposição','Bem-estar corporativo','Qualidade de vida'] as $b): ?>
        <div class="benefit"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="container">
    <span class="eyebrow">Indicações</span>
    <h2 style="margin-top:16px;">Para quais empresas é indicado</h2>
    <div class="empresa-grid">
      <?php foreach ([
        ['💼','Escritórios'],['🏭','Indústrias'],['🧑‍💻','Coworkings'],
        ['🩺','Clínicas'],['📅','SIPAT'],['🎉','Eventos corporativos'],
      ] as [$ic,$t]): ?>
        <div class="empresa-item"><span class="ico"><?= $ic ?></span><p><?= e($t) ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section style="background:var(--cream);padding:80px 0;">
  <div class="container text-center" style="max-width:760px;">
    <span class="eyebrow">Experiência corporativa</span>
    <p style="margin-top:24px;font-size:1.15rem;color:var(--sage-deep);line-height:1.7;">Atendimento pensado para empresas que valorizam o bem-estar, a experiência dos colaboradores e um ambiente corporativo mais saudável e humanizado.</p>
  </div>
</section>

<section class="bg-white">
  <div class="container">
    <span class="eyebrow">Diferenciais</span>
    <h2 style="margin-top:16px;">Diferenciais Godai</h2>
    <div class="diff-grid">
      <?php foreach ([
        ['🏆','20+ anos de expertise'],['📄','Relatórios para o RH'],['🌍','Experiência internacional'],
        ['⚡','Agilidade e praticidade'],['🏢','Grandes empresas'],['📍','Atendimento local'],
      ] as [$ic,$t]): ?>
        <div class="diff-item"><span class="ico"><?= $ic ?></span><p><?= e($t) ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-sage">
  <div class="container cta-block">
    <h2>Leve mais bem-estar e qualidade de vida para sua empresa.</h2>
    <div class="actions">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-cream btn-pill">Solicitar orçamento →</a>
      <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-outline-cream btn-pill">Falar no WhatsApp</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
