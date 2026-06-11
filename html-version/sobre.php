<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Sobre — Godai Terapias Integrativas';
$pageDesc  = 'Conheça a história, a fundadora e a trajetória da Godai Terapias Integrativas — bem-estar corporativo com experiência nacional e internacional.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero container">
  <span class="eyebrow" style="text-transform:none;letter-spacing:normal;font-weight:500;">Sobre a Godai</span>
  <h1 style="margin-top:24px;">Uma história construída pelo cuidado com as pessoas.</h1>
  <p>Há mais de duas décadas, nossa trajetória é guiada por um propósito simples: promover experiências de bem-estar que contribuam para uma rotina mais equilibrada, saudável e humana.</p>
  <p style="margin-top:14px;">Hoje, a Godai Terapias Integrativas reúne experiência nacional e internacional para levar às empresas soluções de bem-estar voltadas à valorização das pessoas e à qualidade de vida no ambiente corporativo.</p>
</section>

<!-- NOSSA ORIGEM -->
<section class="bg-white">
  <div class="container grid grid-2" style="align-items:center;">
    <div style="border-radius:20px;overflow:hidden;background:var(--cream);display:flex;align-items:center;justify-content:center;padding:48px;">
      <img src="<?= e(base_url('assets/img/godai-logo-cream.png')) ?>" alt="Logo Godai Terapias Integrativas" loading="lazy" style="width:100%;max-width:420px;height:auto;object-fit:contain;">
    </div>
    <div>
      <span class="eyebrow">Nossa origem</span>
      <h2 style="margin-top:16px;">Como nasceu a Godai</h2>
      <div style="margin-top:24px;color:var(--muted);line-height:1.7;display:flex;flex-direction:column;gap:14px;">
        <p>A Godai Terapias Integrativas nasceu da união entre experiência, propósito e paixão pelo cuidado humano.</p>
        <p>Após mais de 20 anos de atuação em terapias integrativas, atendimentos corporativos e experiências de bem-estar em diferentes países, surgiu o desejo de transformar essa trajetória em um projeto capaz de levar equilíbrio, acolhimento e qualidade de vida para empresas e colaboradores.</p>
        <p>Inspirada pelo conceito japonês <em>"Godai"</em>, que representa os cinco elementos da natureza, a empresa foi criada para promover experiências que conectam corpo, mente e bem-estar.</p>
      </div>
    </div>
  </div>
</section>

<!-- TIMELINE DA FUNDADORA -->
<section style="background:var(--cream);">
  <div class="container" style="max-width:920px;">
    <div class="text-center">
      <span class="eyebrow">Trajetória</span>
      <h2 style="margin-top:16px;">Timeline da Fundadora</h2>
    </div>
    <ol class="timeline">
      <?php $tl = [
        ['2001', ['Início da formação em Naturopatia, Shiatsu, Acupuntura e Bambuterapia.']],
        ['2002', ['Primeiros atendimentos terapêuticos em domicílio.']],
        ['2005', ['Início da atuação em Quick Massage Corporativa.', 'Empresas atendidas: Procter & Gamble, Braskem, Locaweb.']],
        ['2013', ['Mudança para o Japão.', 'Continuidade dos atendimentos terapêuticos.']],
        ['2016', ['Especialização em Chiang Mai (Tailândia).', 'Formações em Thai Table Massage, Reflexologia e Foot Massage.']],
        ['2016–2024', ['Atendimentos e vivência internacional.', 'Países: Japão, Tailândia, México e Estados Unidos.']],
        ['Atualmente', ['Fundação da Godai Terapias Integrativas no Brasil.']],
      ]; foreach ($tl as [$year, $items]): ?>
        <li class="timeline-item">
          <span class="timeline-dot" aria-hidden="true"></span>
          <p class="timeline-year"><?= e($year) ?></p>
          <ul class="timeline-list">
            <?php foreach ($items as $i): ?><li><?= e($i) ?></li><?php endforeach; ?>
          </ul>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- EXPANSÃO E ATUAÇÃO CONJUNTA -->
<section class="bg-white">
  <div class="container" style="max-width:820px;">
    <span class="eyebrow">Expansão e atuação conjunta</span>
    <h2 style="margin-top:16px;">Duas trajetórias, um mesmo propósito</h2>
    <div style="margin-top:24px;color:var(--muted);line-height:1.7;display:flex;flex-direction:column;gap:14px;">
      <p>Com a expansão da Godai, Wellington Aires passou a integrar oficialmente a empresa como sócio proprietário e terapeuta.</p>
      <p>Com formação em Quick Massage pelo Senac e experiência corporativa em ambientes industriais e organizacionais, contribui para o desenvolvimento das experiências de bem-estar voltadas às empresas.</p>
      <p>A união de diferentes experiências fortalece a atuação da Godai e amplia a capacidade de oferecer atendimentos humanizados, profissionais e alinhados às necessidades do ambiente corporativo.</p>
    </div>
  </div>
</section>

<!-- EXPERIÊNCIA INTERNACIONAL -->
<section class="bg-sage">
  <div class="container text-center" style="max-width:780px;">
    <span class="ico" style="display:inline-grid;place-items:center;width:56px;height:56px;border-radius:999px;background:rgba(244,241,234,.12);color:var(--cream);font-size:1.5rem;">🌍</span>
    <span class="eyebrow on-dark" style="display:inline-block;margin-top:18px;">Experiência internacional</span>
    <h2 style="margin-top:14px;">Uma visão global sobre bem-estar</h2>
    <div style="margin-top:18px;color:rgba(244,241,234,.85);line-height:1.7;display:flex;flex-direction:column;gap:14px;">
      <p>Nossa trajetória inclui atendimentos e experiências profissionais em diferentes países, permitindo compreender como o cuidado com as pessoas é valorizado em diferentes culturas.</p>
      <p>Essa vivência internacional influencia diretamente a forma como desenvolvemos experiências de bem-estar corporativo: com atenção aos detalhes, acolhimento e foco na experiência do colaborador.</p>
    </div>
  </div>
</section>

<!-- MISSÃO, VISÃO E VALORES -->
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
        <ul class="mvv-values">
          <?php foreach (['Cuidado com as pessoas','Cliente em primeiro lugar','Qualidade e excelência','Ética e transparência','Humanização'] as $v): ?>
            <li><?= e($v) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- FUNDADORES / CERTIFICAÇÕES -->
<section style="background:var(--cream);">
  <div class="container" style="max-width:1000px;">
    <div class="text-center">
      <span class="eyebrow">Certificações e formações</span>
      <h2 style="margin-top:16px;">Fundadores</h2>
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

<!-- REDE DE PROFISSIONAIS PARCEIROS -->
<section class="bg-white">
  <div class="container text-center" style="max-width:820px;">
    <span class="ico" style="display:inline-grid;place-items:center;width:56px;height:56px;border-radius:999px;background:rgba(86,108,80,.1);color:var(--sage);font-size:1.5rem;">👥</span>
    <span class="eyebrow" style="display:inline-block;margin-top:18px;">Parcerias</span>
    <h2 style="margin-top:14px;">Rede de Profissionais Parceiros</h2>
    <div style="margin-top:18px;color:var(--muted);line-height:1.7;display:flex;flex-direction:column;gap:14px;">
      <p>A Godai está preparada para ampliar sua capacidade de atendimento através de uma rede de terapeutas parceiros cuidadosamente selecionados.</p>
      <p>Todos os profissionais passam por critérios de avaliação relacionados à formação, experiência, postura profissional, qualidade do atendimento e alinhamento aos valores da empresa.</p>
      <p>Nosso compromisso é garantir uma experiência de bem-estar consistente, humanizada e de excelência, independentemente do tamanho da ação ou do número de profissionais envolvidos.</p>
    </div>
  </div>
</section>

<!-- REGIÃO DE ATENDIMENTO -->
<section style="background:var(--cream);padding:60px 0;">
  <div class="container text-center" style="max-width:680px;">
    <span class="ico" style="display:inline-grid;place-items:center;width:48px;height:48px;border-radius:999px;background:rgba(86,108,80,.1);color:var(--sage);font-size:1.3rem;">📍</span>
    <h2 style="margin-top:16px;font-size:1.6rem;">Região de atendimento</h2>
    <p style="color:var(--muted);margin-top:10px;">Atendemos empresas em <strong style="color:var(--sage-deep);">Indaiatuba/SP</strong>.<br>Demais regiões mediante consulta.</p>
  </div>
</section>

<!-- CTA FINAL -->
<section class="bg-sage">
  <div class="container cta-block">
    <span class="eyebrow on-dark">Vamos juntos</span>
    <h2 style="margin-top:14px;">Leve experiências de bem-estar para sua empresa</h2>
    <p style="margin-top:16px;color:rgba(244,241,234,.85);max-width:640px;margin-left:auto;margin-right:auto;">Conheça nossas soluções de Quick Massage Corporativa e descubra como promover mais qualidade de vida, equilíbrio e valorização para sua equipe.</p>
    <div class="actions">
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-cream btn-pill">Solicitar orçamento</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
