<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Godai Terapias Integrativas — Quick Massage Corporativa em Indaiatuba';
$pageDesc  = 'Bem-estar corporativo que transforma ambientes. Quick Massage in company para empresas, SIPATs e programas de qualidade de vida.';
$pricing = get_pricing();
$elements = [
  ['🏔', 'Terra'], ['💧', 'Água'], ['🔥', 'Fogo'], ['🌬', 'Ar'], ['✨', 'Éter'],
];
$benefits = [
  'Redução do estresse',
  'Melhora do clima organizacional',
  'Valorização dos colaboradores',
  'Aumento do bem-estar',
  'Ações de qualidade de vida',
  'Experiência corporativa diferenciada',
];
include __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="container grid grid-2">
    <div class="fade-up">
      <span class="eyebrow eyebrow-pill">🌿 Bem-estar Corporativo</span>
      <h1 style="margin-top: 24px;">Bem-estar corporativo que <em>transforma</em> ambientes.</h1>
      <p class="lead" style="margin-top: 24px;">A Godai Terapias Integrativas oferece experiências de relaxamento e qualidade de vida diretamente na sua empresa através da Quick Massage Corporativa.</p>
      <div style="margin-top: 32px; display: flex; flex-wrap: wrap; gap: 12px;">
        <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento →</a>
        <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-outline btn-pill">Falar no WhatsApp</a>
      </div>
    </div>
    <div class="fade-up-d1">
      <div class="hero-img">
        <img src="<?= e(base_url('assets/img/hero-massage.jpg')) ?>" alt="Sessão de quick massage corporativa em ambiente de escritório" width="1536" height="1024">
        <div class="hero-bubble">
          <span class="dot">♥</span>
          <div>
            <div style="font-size: .68rem; text-transform: uppercase; letter-spacing: .12em; color: var(--muted);">+ saúde corporativa</div>
            <div style="font-weight: 600; color: var(--sage-deep); font-size: .9rem;">15 min que renovam</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SOBRE -->
<section class="bg-white">
  <div class="container grid grid-2">
    <div>
      <div style="border-radius: 20px; overflow: hidden; background: var(--cream);">
        <img src="<?= e(base_url('assets/img/about-zen.jpg')) ?>" alt="Equilíbrio e elementos naturais" loading="lazy" style="aspect-ratio: 4/5; object-fit: cover; width: 100%;">
      </div>
    </div>
    <div>
      <span class="eyebrow">Sobre a Godai</span>
      <h2 style="margin-top: 16px;">Equilíbrio entre corpo, mente e ambiente.</h2>
      <div style="margin-top: 24px; display: flex; flex-direction: column; gap: 16px; color: var(--muted);">
        <p>A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio, acolhimento e bem-estar através das terapias corporais.</p>
        <p>Inspirada no conceito oriental dos cinco elementos — Terra, Água, Fogo, Ar e Éter — a marca traduz harmonia entre corpo, mente e ambiente.</p>
        <p>Atuamos com Quick Massage Corporativa levando experiências de relaxamento e qualidade de vida diretamente às empresas, contribuindo para ambientes mais saudáveis, produtivos e humanos.</p>
      </div>
      <div class="elements">
        <?php foreach ($elements as [$icon, $label]): ?>
          <div class="element"><span><?= e($icon) ?></span><span><?= e($label) ?></span></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- BENEFÍCIOS -->
<section class="bg-sage">
  <div class="container">
    <div style="max-width: 640px;">
      <span class="eyebrow on-dark">Para sua empresa</span>
      <h2 style="margin-top: 16px;">Benefícios que se sentem em todo o ambiente.</h2>
      <p class="lead" style="margin-top: 16px;">Mais que uma massagem: uma experiência de cuidado que reflete em produtividade, clima e engajamento.</p>
    </div>
    <div class="benefits">
      <?php foreach ($benefits as $b): ?>
        <div class="benefit"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- TABELA DE PREÇOS -->
<section id="planos">
  <div class="container">
    <div class="text-center" style="max-width: 600px; margin: 0 auto;">
      <span class="eyebrow">Planos</span>
      <h2 style="margin-top: 16px;">Tabela de atendimento</h2>
      <p class="lead" style="margin: 16px auto 0;">Formatos pensados para diferentes tamanhos de equipe e durações de evento.</p>
    </div>
    <div class="pricing-card">
      <div class="pricing-head">
        <div>Tempo</div><div>1 Terapeuta</div><div>Capacidade</div><div>2 Terapeutas</div><div>Capacidade</div>
      </div>
      <?php foreach ($pricing as $row): ?>
        <div class="pricing-row">
          <div><div class="col-label">Tempo</div><div class="time"><?= e($row['time_label']) ?></div></div>
          <div><div class="col-label">1 Terapeuta</div><div class="val"><?= e($row['solo_price']) ?></div></div>
          <div><div class="col-label">Capacidade</div><div class="cap"><?= e($row['solo_capacity']) ?></div></div>
          <div><div class="col-label">2 Terapeutas</div><div class="val"><?= e($row['duo_price']) ?></div></div>
          <div><div class="col-label">Capacidade</div><div class="cap"><?= e($row['duo_capacity']) ?></div></div>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="pricing-note">Valores corporativos para atendimento in company com emissão de Nota Fiscal.</p>
    <div class="text-center" style="margin-top: 40px;">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento personalizado →</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
