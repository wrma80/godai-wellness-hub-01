<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Metodologia — Como funciona | Godai';
$pageDesc  = 'Etapas para levar a Quick Massage Corporativa até a sua empresa, do alinhamento ao atendimento.';
$steps = [
  ['🤝','Alinhamento com a empresa','Entendemos o objetivo, o público e o contexto da ação.'],
  ['📋','Definição do formato','Escolha do tempo, número de terapeutas e estrutura ideal.'],
  ['📅','Organização da agenda','Agendamentos otimizados para máxima participação.'],
  ['🏢','Atendimento in company','Equipe, cadeiras e materiais entregues e montados no local.'],
  ['✨','Experiência de relaxamento','Bem-estar imediato e impacto no clima organizacional.'],
];
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero container">
  <span class="eyebrow">Metodologia</span>
  <h1 style="margin-top: 24px;">Como funciona</h1>
  <p>Um processo simples, fluido e cuidadosamente desenhado para que a sua empresa viva uma experiência de bem-estar do começo ao fim.</p>
</section>

<section class="bg-white">
  <div class="container">
    <ol class="timeline">
      <?php foreach ($steps as $i => [$icon, $title, $desc]): ?>
        <li class="timeline-item">
          <span class="marker"><?= e($icon) ?></span>
          <div class="body">
            <span class="step">Etapa <?= $i + 1 ?></span>
            <h3><?= e($title) ?></h3>
            <p><?= e($desc) ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ol>
    <div class="text-center" style="margin-top: 56px;">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Quero implementar na minha empresa</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
