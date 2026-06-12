<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Contato — Solicite um orçamento | Godai';
$pageDesc  = 'Fale com a Godai Terapias Integrativas e leve a Quick Massage Corporativa para a sua empresa em Indaiatuba/SP e região.';
$s = get_settings();

include __DIR__ . '/includes/header.php';
?>

<section class="page-hero container">
  <span class="eyebrow">Contato</span>
  <h1 style="margin-top:24px;">Solicite um orçamento</h1>
  <p>A Godai oferece experiências de bem-estar voltadas ao cuidado, valorização e qualidade de vida no ambiente corporativo.</p>
</section>

<section class="bg-white" style="padding:30px 0 0;">
  <div class="container">
    <div class="bullet-list" style="margin-top:0;">
      <?php foreach (['Atendimento personalizado','Estrutura inclusa','Atendimento corporativo','Flexibilidade de horários'] as $d): ?>
        <div class="item"><?= e($d) ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="container" style="padding:60px 0 100px;">
  <div class="grid grid-2" style="align-items:start;">
    <div>
      <h2>Vamos conversar.</h2>
      <p class="lead" style="margin-top:18px;">Preencha o formulário e nossa equipe responderá rapidamente com uma proposta personalizada.</p>
      <ul class="contact-info">
        <li class="line"><span class="ico">📍</span> <?= e($s['city']) ?></li>
        <li class="line"><span class="ico">✉</span> <a href="mailto:<?= e($s['email']) ?>"><?= e($s['email']) ?></a></li>
        <li class="line"><span class="ico">◎</span> <a href="<?= e($s['instagram']) ?>" target="_blank" rel="noopener">Instagram</a></li>
      </ul>
    </div>

    <form method="post" class="contact-card" id="contactForm" novalidate>
      <div id="contactFeedback" role="status" aria-live="polite"></div>
      <div class="field"><label>Nome</label><input type="text" name="nome" maxlength="100" required></div>
      <div class="field"><label>Empresa</label><input type="text" name="empresa" maxlength="120" required></div>
      <div class="field-row">
        <div class="field"><label>WhatsApp</label><input type="tel" name="whatsapp" maxlength="20" required></div>
        <div class="field"><label>E-mail</label><input type="email" name="email" maxlength="150" required></div>
      </div>
      <div class="field-row">
        <div class="field"><label>Cidade</label><input type="text" name="cidade" maxlength="80" required></div>
        <div class="field">
          <label>Tipo de atendimento</label>
          <select name="tipo" required>
            <option value="" disabled selected>Selecione</option>
            <option>Avulso / Ação Pontual</option>
            <option>Pacote Corporativo</option>
            <option>Programa Corporativo</option>
            <option>SIPAT / Evento</option>
          </select>
        </div>
      </div>
      <div class="field" style="margin-top:18px;"><label>Quantidade de colaboradores</label><input type="number" name="colaboradores" min="1" required></div>
      <div class="field" style="margin-top:18px;">
        <label>Mensagem</label>
        <textarea name="mensagem" rows="4" maxlength="1000" required></textarea>
      </div>
      <!-- Honeypot anti-spam (não preencher) -->
      <div style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
        <label>Não preencha este campo<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      </div>
      <button type="submit" class="btn btn-primary btn-pill" id="contactSubmit" style="margin-top:24px;width:100%;justify-content:center;">Enviar orçamento ✈</button>
    </form>
  </div>
</section>

<script>
(function(){
  var form = document.getElementById('contactForm');
  if (!form) return;
  var feedback = document.getElementById('contactFeedback');
  var btn = document.getElementById('contactSubmit');
  form.addEventListener('submit', function(e){
    e.preventDefault();
    feedback.innerHTML = '';
    if (!form.checkValidity()) { form.reportValidity(); return; }
    btn.disabled = true;
    var originalLabel = btn.textContent;
    btn.textContent = 'Enviando...';
    var data = new FormData(form);
    fetch('<?= e(base_url('processa-contato.php')) ?>', { method: 'POST', body: data, credentials: 'same-origin' })
      .then(function(r){ return r.json().then(function(j){ return { ok: r.ok, body: j }; }); })
      .then(function(res){
        if (res.ok && res.body.ok) {
          form.reset();
          feedback.innerHTML = '<div class="alert alert-success" style="margin-bottom:16px;"><strong>Obrigado pelo contato!</strong><br>Recebemos sua solicitação e retornaremos o mais breve possível.</div>';
        } else {
          feedback.innerHTML = '<div class="alert alert-error" style="margin-bottom:16px;">' + (res.body && res.body.message ? res.body.message : 'Não foi possível enviar sua solicitação neste momento. Por favor, tente novamente mais tarde.') + '</div>';
        }
      })
      .catch(function(){
        feedback.innerHTML = '<div class="alert alert-error" style="margin-bottom:16px;">Não foi possível enviar sua solicitação neste momento. Por favor, tente novamente mais tarde.</div>';
      })
      .finally(function(){
        btn.disabled = false;
        btn.textContent = originalLabel;
        if (feedback.firstChild) feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
      });
  });
})();
</script>

<?php include __DIR__ . '/includes/footer.php';
