<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Godai Terapias Integrativas — Quick Massage Corporativa em Indaiatuba';
$pageDesc  = 'Bem-estar corporativo que transforma ambientes. Quick Massage in company para empresas, SIPATs e programas de qualidade de vida.';
$s = get_settings();
include __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero container">
  <div class="grid grid-2">
    <div class="fade-up">
      <span class="eyebrow eyebrow-pill">🌿 Bem-estar Corporativo</span>
      <h1 style="margin-top:24px;">Bem-estar corporativo que <em>transforma</em> ambientes.</h1>
      <p class="lead" style="margin-top:24px;">A Godai Terapias Integrativas oferece experiências de relaxamento e qualidade de vida diretamente na sua empresa através da Quick Massage Corporativa.</p>
      <div style="margin-top:32px;display:flex;gap:12px;flex-wrap:wrap;">
        <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento →</a>
        <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-outline btn-pill">Falar no WhatsApp</a>
      </div>
    </div>
    <div class="hero-img fade-up-d1">
      <img src="<?= e(base_url('assets/img/hero-massage.jpg')) ?>" alt="Sessão de Quick Massage corporativa">
      <div class="hero-bubble">
        <span class="dot">♡</span>
        <div>
          <p style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);">Saúde corporativa</p>
          <p style="font-weight:600;color:var(--sage-deep);">15 min que renovam</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SOBRE A GODAI -->
<section class="bg-white">
  <div class="container grid grid-2">
    <div style="border-radius:20px;overflow:hidden;">
      <img src="<?= e(base_url('assets/img/about-zen.jpg')) ?>" alt="Equilíbrio e elementos naturais" loading="lazy" style="aspect-ratio:4/5;width:100%;object-fit:cover;">
    </div>
    <div>
      <span class="eyebrow">Sobre a Godai</span>
      <h2 style="margin-top:16px;">Equilíbrio entre corpo, mente e ambiente.</h2>
      <p class="lead" style="margin-top:24px;">A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio, acolhimento e bem-estar através das terapias corporais.</p>
      <p style="color:var(--muted);margin-top:14px;">Inspirada no conceito oriental dos cinco elementos — Terra, Água, Fogo, Ar e Vazio — a marca traduz harmonia entre corpo, mente e ambiente.</p>
      <p style="color:var(--muted);margin-top:14px;">Atuamos com Quick Massage Corporativa levando experiências de relaxamento e qualidade de vida diretamente às empresas.</p>
      <div class="elements">
        <div class="element"><span>🏔</span><span>Terra</span></div>
        <div class="element"><span>💧</span><span>Água</span></div>
        <div class="element"><span>🔥</span><span>Fogo</span></div>
        <div class="element"><span>🌬</span><span>Ar</span></div>
        <div class="element"><span>✨</span><span>Vazio</span></div>
      </div>
    </div>
  </div>
</section>

<!-- PARA SUA EMPRESA -->
<section class="bg-sage">
  <div class="container">
    <span class="eyebrow on-dark">Para sua empresa</span>
    <h2 style="margin-top:16px;">Benefícios que se sentem em todo o ambiente.</h2>
    <p class="lead" style="margin-top:16px;">Mais que uma massagem: uma experiência de cuidado que reflete em produtividade, clima e engajamento.</p>
    <div class="benefits">
      <?php foreach (['Redução do estresse','Melhora do clima organizacional','Valorização dos colaboradores','Aumento do bem-estar','Ações de qualidade de vida','Experiência corporativa diferenciada'] as $b): ?>
        <div class="benefit"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- DIFERENCIAIS -->
<section class="bg-white">
  <div class="container">
    <span class="eyebrow">Diferenciais</span>
    <h2 style="margin-top:16px;">Por que escolher a Godai.</h2>
    <p class="lead" style="margin-top:16px;">Cuidado, estrutura e experiência corporativa premium em todos os atendimentos.</p>
    <div class="diff-grid">
      <?php foreach ([
        ['🏆','20+ anos de expertise'],
        ['🌍','Experiência internacional'],
        ['🎓','Profissionais qualificados'],
        ['🏢','Experiência corporativa premium'],
        ['📦','Estrutura completa inclusa'],
        ['🤝','Atendimento humanizado'],
      ] as [$ic,$txt]): ?>
        <div class="diff-item">
          <span class="ico"><?= $ic ?></span>
          <p><?= e($txt) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FORMAS DE CONTRATAÇÃO -->
<section style="background:var(--cream);">
  <div class="container">
    <div class="text-center">
      <span class="eyebrow">Formas de Contratação</span>
      <h2 style="margin-top:16px;">Escolha o formato ideal para sua empresa</h2>
      <p class="lead" style="margin:16px auto 0;">Três modalidades pensadas para diferentes momentos e necessidades corporativas.</p>
    </div>
    <div class="plans-grid">
      <?php $plans = [
        ['Avulso','Ação Pontual','Perfeito para SIPAT, eventos internos e campanhas de bem-estar.', ['Agendamento único','Ideal para ações pontuais','Ideal para datas comemorativas','Contratação por período de atendimento'], false],
        ['Pacote Corporativo','Flexibilidade de Utilização','Ideal para empresas que desejam múltiplos atendimentos corporativos sem fidelização recorrente.', ['Utilização conforme agenda da empresa','Condições corporativas diferenciadas','Melhor custo-benefício','Ideal para SIPATs e campanhas periódicas'], true],
        ['Programa Corporativo','Parceria Estratégica','Programa contínuo de bem-estar para empresas com visão de longo prazo.', ['Atendimento recorrente','Planejamento contínuo das ações','Organização do calendário corporativo','Programa estruturado de qualidade de vida'], false],
      ]; foreach ($plans as [$t,$sub,$desc,$items,$feat]): ?>
        <div class="plan-card<?= $feat ? ' is-featured' : '' ?>">
          <h3 style="text-align:center;"><?= e($t) ?></h3>
          <span class="plan-sub" style="text-align:center;display:block;margin-top:8px;"><?= e($sub) ?></span>
          <p class="plan-desc" style="text-align:center;"><?= e($desc) ?></p>
          <ul>
            <?php foreach ($items as $i): ?><li><?= e($i) ?></li><?php endforeach; ?>
          </ul>
          <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-outline btn-pill">Solicitar orçamento →</a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="bg-sage">
  <div class="container cta-block">
    <h2>Vamos construir uma experiência de bem-estar para a sua equipe?</h2>
    <div class="actions">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-cream btn-pill">Solicitar orçamento →</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
