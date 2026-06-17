<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Benefícios da Quick Massage Corporativa | Godai Terapias Integrativas';
$pageDesc  = 'Descubra como a Quick Massage Corporativa pode contribuir para o bem-estar dos colaboradores, ações de qualidade de vida, SIPAT e programas corporativos.';
include __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero container">
  <div class="grid grid-2">
    <div class="fade-up">
      <span class="eyebrow eyebrow-pill">🏢 Benefícios para Empresas</span>
      <h1 style="margin-top:24px;">Sua empresa cuida dos resultados. <em>Nós ajudamos a cuidar das pessoas.</em></h1>
      <p class="lead" style="margin-top:24px;">A Quick Massage Corporativa é uma solução prática e eficiente para promover bem-estar, aliviar tensões e fortalecer ações de qualidade de vida dentro das organizações.</p>
      <p style="margin-top:14px;color:var(--muted);">Investir nas pessoas é investir em um ambiente mais saudável, equilibrado e produtivo.</p>
      <div style="margin-top:32px;display:flex;gap:12px;flex-wrap:wrap;">
        <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento →</a>
        <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-outline btn-pill">Falar no WhatsApp</a>
      </div>
    </div>
    <div class="hero-img fade-up-d1">
      <img src="<?= e(base_url('assets/img/beneficios-hero.png')) ?>" alt="Terapeuta Godai realizando Quick Massage em ambiente corporativo">
    </div>
  </div>
</section>

<!-- 1 — TIMELINE: CENÁRIO -->
<section class="bg-white">
  <div class="container">
    <div style="max-width:720px;">
      <span class="eyebrow">Cenário corporativo</span>
      <h2 style="margin-top:16px;">O cenário atual das empresas</h2>
      <p class="lead" style="margin-top:18px;">As organizações enfrentam desafios cada vez maiores relacionados ao bem-estar, saúde mental, engajamento e qualidade de vida dos colaboradores.</p>
    </div>
    <ol style="list-style:none;margin:56px auto 0;padding:0 0 0 32px;max-width:720px;border-left:1px solid rgba(86,108,80,.25);display:flex;flex-direction:column;gap:32px;">
      <?php $i = 1; foreach ([
        'Pressão por resultados',
        'Estresse ocupacional',
        'Sobrecarga emocional',
        'Queda no bem-estar',
        'Necessidade de ações de qualidade de vida',
      ] as $step): ?>
        <li style="position:relative;">
          <span style="position:absolute;left:-49px;top:-2px;width:34px;height:34px;border-radius:50%;border:1px solid rgba(86,108,80,.35);background:var(--cream);display:grid;place-items:center;font-size:.72rem;font-weight:600;color:var(--sage);"><?= str_pad((string)$i, 2, '0', STR_PAD_LEFT) ?></span>
          <p style="font-size:1.1rem;font-weight:500;color:var(--sage-deep);"><?= e($step) ?></p>
        </li>
      <?php $i++; endforeach; ?>
    </ol>
  </div>
</section>

<!-- 2 — CARDS: COMO AJUDA -->
<section style="background:var(--cream);">
  <div class="container">
    <div style="max-width:720px;">
      <span class="eyebrow">Solução</span>
      <h2 style="margin-top:16px;">Como a Quick Massage ajuda</h2>
      <p class="lead" style="margin-top:18px;">Em poucos minutos, a Quick Massage proporciona relaxamento, conforto e uma pausa saudável durante a rotina corporativa.</p>
    </div>
    <div class="benefits">
      <?php foreach ([
        'Relaxamento imediato',
        'Alívio de tensões musculares',
        'Sensação de bem-estar',
        'Redução do estresse',
        'Pausa saudável na rotina',
        'Recuperação da disposição',
      ] as $b): ?>
        <div class="benefit benefit-light"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 3 — TAGS / CHIPS: APLICAÇÕES -->
<section class="bg-white">
  <div class="container">
    <div style="max-width:720px;">
      <span class="eyebrow">Aplicações</span>
      <h2 style="margin-top:16px;">Onde a Quick Massage pode ser aplicada</h2>
      <p class="lead" style="margin-top:18px;">A flexibilidade da Quick Massage permite sua utilização em diferentes momentos e ações corporativas.</p>
    </div>
    <div style="margin-top:40px;display:flex;flex-wrap:wrap;gap:12px;">
      <?php foreach ([
        'SIPAT','Semana da Saúde','Outubro Rosa','Novembro Azul','Dia do Trabalhador',
        'Datas comemorativas','Campanhas internas','Endomarketing','Integração de equipes',
        'Eventos corporativos','Treinamentos','Convenções',
      ] as $tag): ?>
        <span style="display:inline-flex;align-items:center;padding:10px 18px;border-radius:999px;border:1px solid rgba(86,108,80,.25);background:rgba(244,241,234,.6);color:var(--sage-deep);font-size:.9rem;"><?= e($tag) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 4 — DUAS COLUNAS: NR-1 -->
<section class="bg-sage">
  <div class="container">
    <div class="grid grid-2" style="gap:48px;align-items:center;">
      <div>
        <span class="eyebrow on-dark">NR-1 e Riscos Psicossociais</span>
        <h2 style="margin-top:16px;color:var(--cream);">A importância do bem-estar diante das exigências da NR-1</h2>
        <p style="margin-top:20px;color:rgba(244,241,234,.9);line-height:1.7;">A atualização da NR-1 ampliou a atenção aos riscos psicossociais presentes nas organizações.</p>
        <p style="margin-top:12px;color:rgba(244,241,234,.8);line-height:1.7;">Questões relacionadas ao estresse, sobrecarga emocional e fatores que impactam a saúde mental passaram a receber maior atenção dentro dos programas de gestão ocupacional. A Quick Massage pode complementar iniciativas voltadas ao bem-estar e qualidade de vida dos colaboradores.</p>
        <p style="margin-top:24px;font-size:.82rem;color:rgba(244,241,234,.65);font-style:italic;line-height:1.6;">A Quick Massage não substitui programas obrigatórios de saúde ocupacional, mas pode complementar ações de bem-estar e qualidade de vida.</p>
      </div>
      <div style="display:grid;gap:12px;grid-template-columns:1fr 1fr;">
        <?php foreach ([
          'Estresse ocupacional','Sobrecarga emocional','Fadiga mental',
          'Pressão excessiva','Clima organizacional','Qualidade de vida',
        ] as $n): ?>
          <div style="padding:14px 18px;border-radius:12px;border:1px solid rgba(244,241,234,.2);background:rgba(244,241,234,.05);color:rgba(244,241,234,.95);font-size:.9rem;"><?= e($n) ?></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- 5 — ESTATÍSTICAS VISUAIS -->
<section class="bg-white">
  <div class="container">
    <div style="max-width:720px;">
      <span class="eyebrow">Benefícios para a empresa</span>
      <h2 style="margin-top:16px;">Impactos percebidos no ambiente corporativo</h2>
    </div>
    <div style="margin-top:56px;display:grid;gap:40px 40px;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));">
      <?php foreach ([
        'Bem-estar','Engajamento','Valorização dos colaboradores',
        'Clima organizacional','Experiência do colaborador','Ações de qualidade de vida',
      ] as $stat): ?>
        <div style="border-top:1px solid rgba(86,108,80,.2);padding-top:20px;">
          <div style="font-size:3.2rem;line-height:1;font-weight:300;color:var(--sage);">+</div>
          <p style="margin-top:14px;font-size:1.1rem;font-weight:500;color:var(--sage-deep);"><?= e($stat) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 6 — CHECKLIST PREMIUM: ESTRUTURA -->
<section style="background:var(--cream);">
  <div class="container" style="max-width:760px;">
    <div class="text-center">
      <span class="eyebrow">Estrutura</span>
      <h2 style="margin-top:16px;">Estrutura completa fornecida pela Godai</h2>
      <p class="lead" style="margin:18px auto 0;">A Godai fornece toda a estrutura necessária para a realização dos atendimentos. A empresa não precisa disponibilizar equipamentos ou infraestrutura específica.</p>
    </div>
    <ul style="list-style:none;margin:48px 0 0;padding:0;border:1px solid var(--border);border-radius:18px;background:#fff;overflow:hidden;">
      <?php $items = ['Cadeira profissional','Terapeutas qualificados','Organização dos atendimentos','Materiais inclusos','Atendimento personalizado','Estrutura completa']; foreach ($items as $idx => $b): ?>
        <li style="display:flex;align-items:center;gap:16px;padding:18px 24px;<?= $idx < count($items)-1 ? 'border-bottom:1px solid var(--border);' : '' ?>">
          <span style="flex:0 0 32px;height:32px;border-radius:999px;background:var(--sage);color:var(--cream);display:grid;place-items:center;font-weight:700;">✓</span>
          <span style="color:var(--sage-deep);font-size:1rem;"><?= e($b) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- 7 — BLOCO INSTITUCIONAL: CONTRATAÇÃO -->
<section class="bg-white">
  <div class="container" style="max-width:960px;">
    <div style="border:1px solid rgba(86,108,80,.2);background:rgba(244,241,234,.5);border-radius:24px;padding:56px 32px;text-align:center;">
      <span class="eyebrow">Formas de contratação</span>
      <h2 style="margin-top:14px;">Escolha o formato ideal para sua empresa</h2>
      <p class="lead" style="margin:20px auto 0;max-width:640px;">A Godai oferece diferentes modalidades de contratação — Avulso, Pacote Corporativo e Programa Corporativo — para atender desde ações pontuais até programas contínuos de qualidade de vida corporativa.</p>
      <div style="margin-top:32px;">
        <a href="<?= e(base_url('index.php#formas-contratacao')) ?>" class="btn btn-primary btn-pill">Conhecer modalidades de contratação →</a>
      </div>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="bg-sage">
  <div class="container cta-block">
    <h2>Vamos construir uma experiência de bem-estar para sua equipe?</h2>
    <p style="margin-top:16px;color:rgba(244,241,234,.85);max-width:640px;margin-left:auto;margin-right:auto;">Solicite um orçamento sem compromisso e descubra como a Quick Massage pode agregar valor às ações de qualidade de vida da sua empresa.</p>
    <div class="actions">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-cream btn-pill">Solicitar orçamento →</a>
      <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-outline-cream btn-pill">Falar no WhatsApp</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
