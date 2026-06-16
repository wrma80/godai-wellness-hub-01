<?php
require_once __DIR__ . '/_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $current = get_settings();
    $fields = ['companyName','slogan','shortDescription','whatsappNumber','whatsappMessage',
               'email','contactEmail','phone','instagram','linkedin','address','city','state'];
    foreach ($fields as $k) {
        if (array_key_exists($k, $_POST)) {
            $current[$k] = trim((string)$_POST[$k]);
        }
    }
    save_json('settings', $current);
    flash('success', 'Informações de contato atualizadas.');
    header('Location: ' . base_url('admin/contatos.php'));
    exit;
}

$s = get_settings();
$csrf = csrf_token();
$page_title = 'Contatos';
$active = 'contatos';
require __DIR__ . '/_layout.php';
layout_start();
?>
<form method="post">
  <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">

  <div class="card">
    <h2>Empresa</h2>
    <p class="sub">Dados exibidos no rodapé e em metadados.</p>
    <div class="row">
      <div class="field"><label>Nome da empresa</label><input name="companyName" value="<?= e($s['companyName'] ?? 'Godai Terapias Integrativas') ?>"></div>
      <div class="field"><label>Slogan</label><input name="slogan" value="<?= e($s['slogan'] ?? '') ?>"></div>
    </div>
    <div class="field"><label>Descrição curta</label>
      <textarea name="shortDescription" rows="3"><?= e($s['shortDescription'] ?? '') ?></textarea>
    </div>
  </div>

  <div class="card">
    <h2>Contatos</h2>
    <div class="row">
      <div class="field"><label>E-mail principal</label><input type="email" name="email" value="<?= e($s['email'] ?? '') ?>"></div>
      <div class="field"><label>E-mail que recebe os formulários</label><input type="email" name="contactEmail" value="<?= e($s['contactEmail'] ?? $s['email'] ?? '') ?>"></div>
    </div>
    <div class="row">
      <div class="field"><label>Telefone</label><input name="phone" value="<?= e($s['phone'] ?? '') ?>" placeholder="(19) 99701-6552"></div>
      <div class="field"><label>WhatsApp (com DDI, só números)</label><input name="whatsappNumber" value="<?= e($s['whatsappNumber'] ?? '') ?>" placeholder="5519997016552"></div>
    </div>
    <div class="field"><label>Mensagem padrão WhatsApp</label>
      <textarea name="whatsappMessage" rows="2"><?= e($s['whatsappMessage'] ?? '') ?></textarea>
    </div>
    <div class="row">
      <div class="field"><label>Instagram</label><input name="instagram" value="<?= e($s['instagram'] ?? '') ?>" placeholder="https://instagram.com/godai_terapias"></div>
      <div class="field"><label>LinkedIn</label><input name="linkedin" value="<?= e($s['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/company/godai"></div>
    </div>
  </div>

  <div class="card">
    <h2>Endereço</h2>
    <div class="field"><label>Endereço completo</label><input name="address" value="<?= e($s['address'] ?? '') ?>"></div>
    <div class="row">
      <div class="field"><label>Cidade</label><input name="city" value="<?= e($s['city'] ?? 'Indaiatuba') ?>"></div>
      <div class="field"><label>Estado</label><input name="state" value="<?= e($s['state'] ?? 'SP') ?>"></div>
    </div>
  </div>

  <button class="btn btn-primary">Salvar alterações</button>
</form>
<?php layout_end(); ?>
