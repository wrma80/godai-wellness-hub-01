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
      <img src="<?= e(base_url('assets/img/hero-massage.jpg')) ?>" alt="Terapeuta realizando Quick Massage em ambiente corporativo moderno">
    </div>
  </div>
</section>

<!-- SEÇÃO 1 — CENÁRIO ATUAL -->
<section class="bg-white">
  <div class="container">
    <div style="max-width:760px;">
      <span class="eyebrow">Desafios Corporativos</span>
      <h2 style="margin-top:16px;">As pessoas enfrentam cada vez mais pressão no ambiente de trabalho</h2>
      <p class="lead" style="margin-top:18px;">A rotina corporativa moderna apresenta diversos fatores que impactam o bem-estar dos colaboradores.</p>
      <p style="margin-top:12px;color:var(--muted);line-height:1.7;">Longos períodos sentados, excesso de demandas, pressão por resultados e altos níveis de estresse podem afetar a qualidade de vida e a experiência dentro da empresa.</p>
    </div>
    <div class="diff-grid">
      <?php foreach ([
        ['⚡','Estresse diário'],
        ['💭','Sobrecarga emocional'],
        ['💪','Tensão muscular'],
        ['🧠','Fadiga mental'],
        ['📈','Pressão por resultados'],
        ['🪑','Sedentarismo ocupacional'],
      ] as [$ic,$txt]): ?>
        <div class="diff-item">
          <span class="ico"><?= $ic ?></span>
          <p><?= e($txt) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SEÇÃO 2 — COMO A QUICK MASSAGE AJUDA -->
<section style="background:var(--cream);">
  <div class="container">
    <div style="max-width:760px;">
      <span class="eyebrow">Solução</span>
      <h2 style="margin-top:16px;">Pequenas pausas que geram grandes resultados</h2>
      <p class="lead" style="margin-top:18px;">Em poucos minutos, a Quick Massage proporciona relaxamento, conforto e uma pausa saudável durante a rotina corporativa.</p>
      <p style="margin-top:12px;color:var(--muted);line-height:1.7;">É uma ação simples, de rápida implementação e com alta aceitação entre os colaboradores.</p>
    </div>
    <div class="benefits" style="margin-top:48px;">
      <?php foreach ([
        'Relaxamento imediato',
        'Alívio de tensões musculares',
        'Sensação de bem-estar',
        'Redução do estresse',
        'Recuperação da disposição',
        'Pausa saudável durante a jornada',
      ] as $b): ?>
        <div class="benefit" style="background:#fff;border:1px solid var(--border);"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SEÇÃO 3 — VALORIZAÇÃO -->
<section class="bg-white">
  <div class="container">
    <div style="max-width:760px;">
      <span class="eyebrow">Pessoas</span>
      <h2 style="margin-top:16px;">Demonstre cuidado com quem faz sua empresa acontecer</h2>
      <p class="lead" style="margin-top:18px;">Quando a empresa investe em iniciativas voltadas ao bem-estar, os colaboradores percebem o cuidado da organização com sua qualidade de vida.</p>
      <p style="margin-top:12px;color:var(--muted);line-height:1.7;">Essa percepção fortalece vínculos e contribui para uma experiência mais positiva no ambiente corporativo.</p>
    </div>
    <div class="diff-grid">
      <?php foreach ([
        ['🤝','Valorização das pessoas'],
        ['🏆','Reconhecimento interno'],
        ['🔥','Engajamento'],
        ['💚','Bem-estar emocional'],
        ['🏢','Cultura organizacional'],
        ['✨','Experiência do colaborador'],
      ] as [$ic,$txt]): ?>
        <div class="diff-item">
          <span class="ico"><?= $ic ?></span>
          <p><?= e($txt) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SEÇÃO 4 — NR-1 -->
<section class="bg-sage">
  <div class="container">
    <div style="max-width:760px;">
      <span class="eyebrow on-dark">Adequação Corporativa</span>
      <h2 style="margin-top:16px;">A importância do bem-estar diante das novas exigências da NR-1</h2>
      <p class="lead" style="margin-top:18px;color:rgba(244,241,234,.9);">A atualização da NR-1 ampliou a atenção aos riscos psicossociais presentes nas organizações.</p>
      <p style="margin-top:12px;color:rgba(244,241,234,.8);line-height:1.7;">Questões relacionadas ao estresse, sobrecarga emocional e fatores que impactam a saúde mental passaram a receber maior atenção dentro dos programas de gestão ocupacional. A Quick Massage pode complementar iniciativas voltadas ao bem-estar e qualidade de vida dos colaboradores.</p>
    </div>
    <div class="benefits" style="margin-top:48px;">
      <?php foreach ([
        'Estresse ocupacional',
        'Sobrecarga emocional',
        'Fadiga mental',
        'Pressão excessiva',
        'Clima organizacional',
        'Qualidade de vida',
      ] as $b): ?>
        <div class="benefit"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:36px;max-width:760px;font-size:.88rem;color:rgba(244,241,234,.7);font-style:italic;line-height:1.6;">A Quick Massage não substitui programas obrigatórios de saúde ocupacional, mas pode complementar ações de promoção do bem-estar e qualidade de vida.</p>
  </div>
</section>

<!-- SEÇÃO 5 — APLICAÇÕES -->
<section class="bg-white">
  <div class="container">
    <div style="max-width:760px;">
      <span class="eyebrow">Aplicações</span>
      <h2 style="margin-top:16px;">Onde a Quick Massage pode ser aplicada</h2>
      <p class="lead" style="margin-top:18px;">A flexibilidade da Quick Massage permite sua utilização em diferentes momentos e ações corporativas.</p>
    </div>
    <div class="empresa-grid">
      <?php foreach ([
        ['🏢','Programas de qualidade de vida'],
        ['🦺','SIPAT'],
        ['🎀','Outubro Rosa'],
        ['💙','Novembro Azul'],
        ['🎉','Datas comemorativas'],
        ['🎯','Campanhas de endomarketing'],
        ['📅','Eventos corporativos'],
        ['👥','Integração de equipes'],
        ['🏆','Reconhecimento de colaboradores'],
        ['🎓','Treinamentos e convenções'],
      ] as [$ic,$t]): ?>
        <div class="empresa-item"><span class="ico"><?= $ic ?></span><p><?= e($t) ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SEÇÃO 6 — ESTRUTURA -->
<section style="background:var(--cream);">
  <div class="container">
    <div style="max-width:760px;">
      <span class="eyebrow">Estrutura completa</span>
      <h2 style="margin-top:16px;">Implementação simples para sua empresa</h2>
      <p class="lead" style="margin-top:18px;">A Godai fornece toda a estrutura necessária para a realização dos atendimentos.</p>
      <p style="margin-top:12px;color:var(--muted);line-height:1.7;">A empresa não precisa disponibilizar equipamentos ou infraestrutura específica.</p>
    </div>
    <div class="benefits" style="margin-top:48px;">
      <?php foreach ([
        'Cadeira profissional',
        'Terapeutas qualificados',
        'Organização dos atendimentos',
        'Materiais inclusos',
        'Atendimento personalizado',
        'Estrutura completa',
      ] as $b): ?>
        <div class="benefit" style="background:#fff;border:1px solid var(--border);"><span class="check">✓</span><span><?= e($b) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SEÇÃO 7 — CONTRATAÇÃO (resumo) -->
<section class="bg-white">
  <div class="container">
    <div class="text-center" style="max-width:720px;margin:0 auto;">
      <span class="eyebrow">Contratação</span>
      <h2 style="margin-top:16px;">Modelos flexíveis para diferentes necessidades</h2>
      <p class="lead" style="margin:16px auto 0;">A Godai oferece formatos de contratação que se adaptam tanto a ações pontuais quanto a programas contínuos de bem-estar corporativo.</p>
    </div>
    <div class="diff-grid" style="margin-top:48px;">
      <?php foreach ([
        ['Contratação Avulsa', 'Ideal para SIPAT, eventos internos, campanhas corporativas e datas comemorativas.'],
        ['Pacote Corporativo', 'Ideal para múltiplas ações ao longo do ano, campanhas periódicas e empresas que desejam flexibilidade.'],
        ['Programa Corporativo', 'Ideal para ações recorrentes, calendário anual de bem-estar e programas estruturados de qualidade de vida.'],
      ] as [$t,$d]): ?>
        <div class="diff-item" style="flex-direction:column;align-items:flex-start;gap:10px;">
          <h3 style="font-size:1.1rem;color:var(--sage-deep);"><?= e($t) ?></h3>
          <p style="color:var(--muted);line-height:1.6;"><?= e($d) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center" style="margin-top:40px;">
      <a href="<?= e(base_url('index.php')) ?>#planos" class="btn btn-primary btn-pill">Conheça os formatos de contratação →</a>
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
