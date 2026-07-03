<?php
// admin/ctas.php — Editar textos/links dos principais botões (CTAs) do site.
require_once __DIR__ . '/_auth.php';
require_login();

$defaults = load_json('ctas', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $updated = [];
    foreach (($_POST['cta'] ?? []) as $key => $row) {
        $updated[$key] = [
            'label'       => trim($row['label'] ?? ''),
            'href'        => trim($row['href'] ?? ''),
            'description' => trim($row['description'] ?? ($defaults[$key]['description'] ?? '')),
        ];
    }
    save_json('ctas', $updated);
    admin_log('ctas.save', count($updated) . ' botões');
    flash('success', 'CTAs atualizados. As alterações refletem imediatamente no site.');
    header('Location: ' . base_url('admin/ctas.php'));
    exit;
}

$ctas = load_json('ctas', []);
$csrf = csrf_token();
$page_title = 'CTAs e Botões';
$active = 'ctas';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <h2>CTAs e Botões</h2>
  <p class="sub">Edite o texto e o destino dos principais botões espalhados pelo site. Deixe <code>href</code> vazio nos botões de WhatsApp para usar o número/mensagem configurados em <a href="<?= e(base_url('admin/contatos.php')) ?>">Contatos</a>.</p>
</div>

<form method="post">
  <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
  <?php foreach ($ctas as $key => $c): ?>
    <div class="card">
      <h2 style="margin:0 0 4px;font-size:16px;text-transform:uppercase;letter-spacing:.08em;color:var(--sage-deep);"><?= e($key) ?></h2>
      <p class="sub" style="margin:0 0 14px;"><?= e($c['description'] ?? '') ?></p>
      <div class="row">
        <div class="field"><label>Texto do botão</label><input name="cta[<?= e($key) ?>][label]" value="<?= e($c['label'] ?? '') ?>"></div>
        <div class="field"><label>Link (href)</label><input name="cta[<?= e($key) ?>][href]" value="<?= e($c['href'] ?? '') ?>" placeholder="contato.php ou https://…"></div>
      </div>
      <input type="hidden" name="cta[<?= e($key) ?>][description]" value="<?= e($c['description'] ?? '') ?>">
    </div>
  <?php endforeach; ?>
  <?php if (!$ctas): ?>
    <div class="card"><p class="sub">Nenhum CTA cadastrado. O arquivo <code>data/ctas.json</code> foi criado vazio — repopule com o template padrão.</p></div>
  <?php endif; ?>
  <button class="btn btn-primary">Salvar CTAs</button>
</form>
<?php layout_end(); ?>
