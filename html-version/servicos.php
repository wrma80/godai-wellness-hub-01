<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Serviços — Quick Massage Corporativa | Godai';
$pageDesc  = 'Quick Massage Corporativa de 4h, 6h e 8h, SIPATs, eventos e planos mensais para empresas.';
$services = get_services();
$pricing = get_pricing();
include __DIR__ . '/includes/header.php';
?>
<section class="container" style="padding: 80px 0 0;">
  <div class="grid grid-2" style="align-items: end;">
    <div>
      <span class="eyebrow">Serviços</span>
      <h1 style="margin-top: 16px;">Soluções de Quick Massage para a rotina corporativa.</h1>
    </div>
    <p class="lead">Atendimento in company com terapeutas qualificados, equipamentos próprios e formato sob medida para o seu evento ou programa contínuo.</p>
  </div>

  <div class="grid grid-3" style="margin-top: 56px;">
    <?php foreach ($services as $s): ?>
      <article class="card">
        <h3><?= e($s['title']) ?></h3>
        <div class="card-tags">
          <span class="tag">⏱ <?= e($s['duration']) ?></span>
          <span class="tag cream">👥 <?= e($s['capacity']) ?></span>
        </div>
        <p><?= e($s['description']) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="bg-white">
  <div class="container grid grid-2">
    <div style="border-radius: 20px; overflow: hidden;">
      <img src="<?= e(base_url('assets/img/services-corporate.jpg')) ?>" alt="Atendimento corporativo" loading="lazy" style="aspect-ratio: 4/3; object-fit: cover; width: 100%;">
    </div>
    <div>
      <h2>Tabela de atendimento</h2>
      <p class="lead" style="margin-top: 16px;">Valores corporativos com emissão de Nota Fiscal. Atendimento in company.</p>
      <div style="margin-top: 32px; display: flex; flex-direction: column; gap: 12px;">
        <?php foreach ($pricing as $row): ?>
          <div style="border: 1px solid var(--border); border-radius: 14px; padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <p style="font-size: 1.6rem; font-weight: 700; color: var(--sage);"><?= e($row['time_label']) ?></p>
              <span style="font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; color: var(--muted);">por jornada</span>
            </div>
            <div style="margin-top: 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; font-size: .9rem;">
              <div>
                <div style="font-size: .72rem; color: var(--muted);">1 terapeuta</div>
                <div style="font-weight: 600; color: var(--sage-deep);"><?= e($row['solo_price']) ?></div>
                <div style="font-size: .76rem; color: var(--muted);"><?= e($row['solo_capacity']) ?></div>
              </div>
              <div>
                <div style="font-size: .72rem; color: var(--muted);">2 terapeutas</div>
                <div style="font-weight: 600; color: var(--sage-deep);"><?= e($row['duo_price']) ?></div>
                <div style="font-size: .76rem; color: var(--muted);"><?= e($row['duo_capacity']) ?></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill" style="margin-top: 32px;">Solicitar orçamento →</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
