<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Sobre — Godai Terapias Integrativas';
$pageDesc  = 'Conheça a filosofia da Godai: equilíbrio, acolhimento e bem-estar inspirados nos cinco elementos.';
$elements = [
  ['🏔','Terra','Estabilidade e enraizamento.'],
  ['💧','Água','Fluidez e adaptação.'],
  ['🔥','Fogo','Energia e transformação.'],
  ['🌬','Ar','Leveza e respiração.'],
  ['✨','Éter','Conexão e essência.'],
];
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero container">
  <span class="eyebrow">Sobre a Godai</span>
  <h1 style="margin-top: 24px;">Equilíbrio, acolhimento e bem-estar.</h1>
  <p>A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio, acolhimento e bem-estar através das terapias corporais. Inspirada no conceito oriental dos cinco elementos — Terra, Água, Fogo, Ar e Éter — a marca traduz harmonia entre corpo, mente e ambiente.</p>
</section>

<section class="bg-white">
  <div class="container grid grid-2">
    <div style="border-radius: 20px; overflow: hidden;">
      <img src="<?= e(base_url('assets/img/about-zen.jpg')) ?>" alt="Composição zen" loading="lazy" style="aspect-ratio: 1/1; object-fit: cover; width: 100%;">
    </div>
    <div>
      <h2>Os cinco elementos</h2>
      <p class="lead" style="margin-top: 16px;">Cada elemento carrega uma força que inspira a forma como cuidamos do outro. Juntos, formam o nome e a essência da Godai.</p>
      <div class="elements-list">
        <?php foreach ($elements as [$icon, $name, $desc]): ?>
          <div class="item">
            <div class="ico"><?= e($icon) ?></div>
            <div>
              <div style="font-weight: 600; color: var(--sage-deep);"><?= e($name) ?></div>
              <p><?= e($desc) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="bg-sage text-center">
  <div class="container" style="max-width: 720px;">
    <h2>Pronto para levar bem-estar à sua empresa?</h2>
    <p class="lead" style="margin: 16px auto 0;">Vamos desenhar juntos um programa que combine com a sua equipe e seus objetivos.</p>
    <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-cream btn-pill" style="margin-top: 32px;">Solicitar orçamento</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
