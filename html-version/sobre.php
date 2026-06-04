<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Sobre — Godai Terapias Integrativas';
$pageDesc  = 'Conheça a história, missão, valores e equipe da Godai Terapias Integrativas — wellness corporativo humanizado.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero container">
  <span class="eyebrow">Sobre a Godai</span>
  <h1 style="margin-top:24px;">Equilíbrio, acolhimento e bem-estar.</h1>
  <p>A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio, acolhimento e bem-estar através das terapias corporais. Inspirada no conceito oriental dos cinco elementos — Terra, Água, Fogo, Ar e Vazio — a marca traduz harmonia entre corpo, mente e ambiente.</p>
</section>

<section class="bg-white">
  <div class="container grid grid-2" style="align-items:start;">
    <div style="border-radius:20px;overflow:hidden;">
      <img src="<?= e(base_url('assets/img/about-zen.jpg')) ?>" alt="Equilíbrio zen" loading="lazy" style="aspect-ratio:4/5;width:100%;object-fit:cover;">
    </div>
    <div>
      <span class="eyebrow">Nossa história</span>
      <h2 style="margin-top:16px;">Uma trajetória feita de cuidado e propósito.</h2>
      <div style="margin-top:24px;color:var(--muted);line-height:1.7;display:flex;flex-direction:column;gap:14px;">
        <p>A GODAI Terapias Integrativas nasceu da união entre experiência terapêutica, vivência corporativa e propósito humano.</p>
        <p>A trajetória de Erica Aires nas terapias integrativas começou em 2001, com formação em Naturopatia, Shiatsu e Acupuntura, em São Paulo. Desde então, sua atuação sempre esteve voltada ao cuidado físico, emocional e ao desenvolvimento de experiências terapêuticas humanizadas.</p>
        <p>Ao longo dos anos, Erica atuou em atendimentos domiciliares, clínicas, quiosques e espaços especializados em Quick Massage, além de desenvolver trabalhos em empresas e ambientes corporativos. Sua trajetória também inclui experiências internacionais no Japão, México e especializações em Chiang Mai, na Tailândia — referência mundial em terapias tradicionais e massagem tailandesa.</p>
        <p>Foi justamente a vivência no Japão, em ambientes industriais e de alta exigência física e emocional, que fortaleceu a percepção sobre a importância do bem-estar dentro das organizações.</p>
        <p>Nesse processo, Wellington Aires passou a integrar o projeto, contribuindo com sua experiência em ambientes corporativos e industriais, além da formação em Quick Massage pelo Senac. Sua atuação trouxe uma visão estratégica voltada à estruturação dos atendimentos corporativos, organização operacional e desenvolvimento da experiência oferecida às empresas.</p>
        <p>Da união dessas experiências nasceu a GODAI Terapias Integrativas: uma empresa criada para promover qualidade de vida, equilíbrio e valorização humana dentro das organizações.</p>
        <p>Inspirada nos cinco elementos da filosofia japonesa — Terra, Água, Fogo, Ar e Vazio — a GODAI acredita que ambientes mais saudáveis geram pessoas mais engajadas, produtivas e equilibradas.</p>
        <p>Hoje, a empresa atua levando experiências de bem-estar corporativo através da Quick Massage e de abordagens integrativas voltadas à redução do estresse, alívio de tensões e promoção da qualidade de vida no ambiente de trabalho.</p>
      </div>
    </div>
  </div>
</section>

<section style="background:var(--cream);">
  <div class="container">
    <span class="eyebrow">Filosofia</span>
    <h2 style="margin-top:16px;">Os cinco elementos</h2>
    <p class="lead" style="margin-top:16px;">Cada elemento carrega uma força que inspira a forma como cuidamos do outro. Juntos, formam o nome e a essência da Godai.</p>
    <div class="diff-grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
      <?php foreach ([
        ['🏔','Terra','Estabilidade e enraizamento.'],
        ['💧','Água','Fluidez e adaptação.'],
        ['🔥','Fogo','Energia e transformação.'],
        ['🌬','Ar','Leveza e respiração.'],
        ['✨','Vazio','Conexão e essência.'],
      ] as [$ic,$lbl,$d]): ?>
        <div class="diff-item" style="flex-direction:column;text-align:center;align-items:center;">
          <span class="ico" style="font-size:1.3rem;"><?= $ic ?></span>
          <p style="font-weight:600;color:var(--sage-deep);margin-top:10px;"><?= e($lbl) ?></p>
          <p style="margin-top:4px;font-size:.85rem;color:var(--muted);"><?= e($d) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="container">
    <div class="text-center">
      <span class="eyebrow">Identidade</span>
      <h2 style="margin-top:16px;">Missão, Visão e Valores</h2>
    </div>
    <div class="mvv-grid">
      <div class="mvv-card">
        <span class="ico">🎯</span>
        <h3>Missão</h3>
        <p>Promover experiências de bem-estar corporativo voltadas à qualidade de vida, equilíbrio e valorização das pessoas.</p>
      </div>
      <div class="mvv-card">
        <span class="ico">👁</span>
        <h3>Visão</h3>
        <p>Ser referência em wellness corporativo e experiências integrativas humanizadas.</p>
      </div>
      <div class="mvv-card">
        <span class="ico">♡</span>
        <h3>Valores</h3>
        <p>Cuidado com as pessoas, qualidade e excelência, ética e transparência, humanização dos ambientes corporativos.</p>
      </div>
    </div>
  </div>
</section>

<section style="background:var(--cream);">
  <div class="container" style="max-width:1000px;">
    <div class="text-center">
      <span class="eyebrow">Certificações</span>
      <h2 style="margin-top:16px;">Formação e especializações</h2>
    </div>
    <div class="cert-grid">
      <div class="cert-card">
        <h3>Erica Aires</h3>
        <ul>
          <?php foreach (['Naturopatia','Shiatsu','Acupuntura','Bambuterapia','Thai Table Massage','Reflexologia','Foot Massage'] as $c): ?>
            <li><?= e($c) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="cert-card">
        <h3>Wellington Aires</h3>
        <ul><li>Formação em Quick Massage — Senac</li></ul>
      </div>
    </div>
  </div>
</section>

<section class="bg-white" style="padding:60px 0;">
  <div class="container text-center" style="max-width:680px;">
    <span class="ico" style="display:inline-grid;place-items:center;width:48px;height:48px;border-radius:999px;background:rgba(86,108,80,.1);color:var(--sage);font-size:1.3rem;">📍</span>
    <h2 style="margin-top:16px;font-size:1.6rem;">Região de atendimento</h2>
    <p style="color:var(--muted);margin-top:10px;">Indaiatuba/SP — demais regiões mediante consulta.</p>
  </div>
</section>

<section class="bg-sage">
  <div class="container cta-block">
    <h2>Pronto para levar bem-estar à sua empresa?</h2>
    <div class="actions">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-cream btn-pill">Solicitar orçamento</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
