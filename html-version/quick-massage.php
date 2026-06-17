<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Quick Massage Corporativa — Godai Terapias Integrativas';
$pageDesc  = 'Quick Massage in company: sessões de 10 a 15 minutos com cadeira ergonômica para alívio de tensões e bem-estar dos colaboradores.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero container fade-up">
  <span class="eyebrow">Quick Massage</span>
  <h1 style="margin-top:24px;">Quick Massage Corporativa</h1>
  <p>Experiências voltadas à redução do estresse, alívio de tensões musculares e promoção da qualidade de vida no ambiente corporativo.</p>
  <div style="margin-top:32px;">
    <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento →</a>
  </div>
</section>

<!-- O QUE É -->
<section class="bg-white">
  <div class="container grid grid-2" style="align-items:center;">
    <div>
      <span class="eyebrow">O que é</span>
      <h2 style="margin-top:16px;">O que é a Quick Massage</h2>
      <p style="color:var(--muted);margin-top:18px;line-height:1.7;">A Quick Massage é uma técnica de massoterapia focada no alívio rápido de tensões musculares, realizada em cadeira ergonômica especialmente desenvolvida para proporcionar conforto e praticidade.</p>
      <p style="color:var(--muted);margin-top:14px;line-height:1.7;">Com sessões de 10 a 15 minutos, o atendimento é realizado com o colaborador sentado e vestido, tornando a experiência prática, eficiente e ideal para o ambiente corporativo.</p>
    </div>
    <div style="border-radius:20px;overflow:hidden;box-shadow:var(--shadow-xl);">
      <img src="<?= e(base_url('assets/img/quick-massage-session.jpg')) ?>" alt="Sessão de Quick Massage corporativa em escritório" loading="lazy" style="aspect-ratio:4/3;width:100%;object-fit:cover;">
    </div>
  </div>
</section>

<!-- PROCESSO -->
<section style="background:var(--cream);">
  <div class="container">
    <div style="max-width:640px;">
      <span class="eyebrow">Processo</span>
      <h2 style="margin-top:16px;">Como funciona</h2>
      <p style="margin-top:14px;color:var(--muted);line-height:1.7;">Da solicitação ao resultado: quatro etapas para uma experiência simples, fluida e eficiente.</p>
    </div>

    <div class="process-grid">
      <?php
      $proc = [
        ['01','📅','Agendamento','A empresa define a data, horário e quantidade de colaboradores que participarão da ação.'],
        ['02','🛠','Montagem','A equipe da Godai realiza toda a preparação necessária no local, levando a estrutura de atendimento e organizando o espaço para a realização das sessões.'],
        ['03','🤝','Atendimento','Sessões de Quick Massage de 10 a 15 minutos por colaborador, focadas em ombros, costas e braços, proporcionando alívio imediato das tensões musculares.'],
        ['04','✨','Resultado','Colaboradores mais relaxados, valorizados e engajados, contribuindo para um ambiente corporativo mais saudável.'],
      ];
      foreach ($proc as $i => [$n,$ic,$t,$d]): ?>
        <div class="process-card">
          <div class="process-head">
            <span class="process-ico"><?= $ic ?></span>
            <span class="process-num"><?= e($n) ?></span>
          </div>
          <h3><?= e($t) ?></h3>
          <p><?= e($d) ?></p>
          <?php if ($i < count($proc) - 1): ?><span class="process-arrow" aria-hidden="true">›</span><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="process-callout">
      <span class="callout-ico">ℹ</span>
      <div>
        <p class="callout-title">Não é necessário trocar de roupa.</p>
        <p>O atendimento é realizado diretamente na cadeira ergonômica de massagem, de forma rápida, discreta e eficiente, sem impactar a rotina de trabalho.</p>
      </div>
    </div>
  </div>
</section>

<!-- BENEFÍCIOS -->
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

<!-- INDICAÇÕES -->
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

<!-- EXPERIÊNCIA CORPORATIVA -->
<section style="background:var(--cream);padding:80px 0;">
  <div class="container text-center" style="max-width:760px;">
    <span class="eyebrow">Experiência corporativa</span>
    <p style="margin-top:24px;font-size:1.15rem;color:var(--sage-deep);line-height:1.7;">Atendimento pensado para empresas que valorizam o bem-estar, a experiência dos colaboradores e um ambiente corporativo mais saudável e humanizado.</p>
  </div>
</section>

<!-- CTA -->
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
