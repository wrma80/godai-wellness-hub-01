<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'FAQ — Perguntas frequentes | Godai';
$pageDesc  = 'Tire suas dúvidas sobre a Quick Massage Corporativa da Godai: estrutura, atendimento, regiões, nota fiscal e mais.';
include __DIR__ . '/includes/header.php';
$faq = [
  ['Quantos colaboradores são atendidos por hora?', 'Em média, um terapeuta atende de 4 a 6 colaboradores por hora considerando sessões de 10 a 15 minutos. O número exato é definido conforme o formato do evento e a quantidade de profissionais alocados.'],
  ['Precisa de sala?', 'Não é obrigatório. Atendemos em qualquer ambiente reservado, como sala de reunião, copa, recepção ou área de descompressão. Apenas indicamos um espaço com boa privacidade e ventilação.'],
  ['Vocês levam cadeira?', 'Sim. A cadeira ergonômica de Quick Massage está inclusa em todos os atendimentos, sem custo adicional.'],
  ['A Quick Massage utiliza óleo?', 'Não. A técnica é realizada com o colaborador vestido, sem uso de óleos ou cremes — totalmente prática para o ambiente corporativo.'],
  ['Atendem finais de semana?', 'Sim, atendemos finais de semana mediante agendamento prévio, especialmente para eventos, SIPATs e ações pontuais.'],
  ['Emitem nota fiscal?', 'Sim. Emitimos Nota Fiscal de Serviço para todos os atendimentos corporativos.'],
  ['Atendem outras cidades?', 'Nosso atendimento principal é em Indaiatuba/SP. Demais regiões são atendidas mediante consulta de disponibilidade e custos de deslocamento.'],
];
?>

<section class="page-hero container">
  <span class="eyebrow">FAQ</span>
  <h1 style="margin-top:24px;">Perguntas frequentes</h1>
  <p>Reunimos as dúvidas mais comuns sobre a Quick Massage Corporativa.</p>
</section>

<section class="bg-white">
  <div class="container">
    <div class="accordion">
      <?php foreach ($faq as $i => [$q, $a]): ?>
        <div class="accordion-item<?= $i === 0 ? ' is-open' : '' ?>">
          <button type="button" class="accordion-q" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
            <span><?= e($q) ?></span>
            <span class="toggle">+</span>
          </button>
          <div class="accordion-a"><?= e($a) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-sage">
  <div class="container cta-block">
    <h2>Ainda ficou com dúvidas?</h2>
    <div class="actions">
      <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn-cream btn-pill">💬 Falar no WhatsApp</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php';
