<?php
require_once __DIR__ . '/_auth.php';
require_login();

$PAGES = ['home'=>'Home','sobre'=>'Sobre','quick-massage'=>'Quick Massage','contato'=>'Contato','faq'=>'FAQ'];
$activePage = $_GET['p'] ?? 'home';
if (!isset($PAGES[$activePage])) $activePage = 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $data = load_json('seo', []);
    $p = $_POST['page'] ?? 'home';
    if (!isset($PAGES[$p])) $p = 'home';
    $data[$p] = [
        'title'          => trim((string)($_POST['title'] ?? '')),
        'description'    => trim((string)($_POST['description'] ?? '')),
        'keywords'       => trim((string)($_POST['keywords'] ?? '')),
        'og_title'       => trim((string)($_POST['og_title'] ?? '')),
        'og_description' => trim((string)($_POST['og_description'] ?? '')),
        'og_image'       => trim((string)($_POST['og_image'] ?? '')),
    ];
    save_json('seo', $data);
    admin_log('seo.save', $p); flash('success', 'SEO da página "' . $PAGES[$p] . '" salvo.');
    header('Location: ' . base_url('admin/seo.php?p='.urlencode($p)));
    exit;
}

$seo = load_json('seo', []);
$cur = $seo[$activePage] ?? ['title'=>'','description'=>'','keywords'=>'','og_title'=>'','og_description'=>'','og_image'=>''];
$csrf = csrf_token();
$page_title = 'SEO';
$active = 'seo';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card" style="padding-bottom:6px;">
  <div style="display:flex;gap:6px;flex-wrap:wrap;">
    <?php foreach ($PAGES as $k=>$lbl): ?>
      <a href="?p=<?= e($k) ?>" class="btn btn-sm <?= $activePage===$k?'btn-primary':'btn-out' ?>"><?= e($lbl) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<form method="post">
  <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
  <input type="hidden" name="page" value="<?= e($activePage) ?>">

  <div class="card">
    <h2>Metadados gerais — <?= e($PAGES[$activePage]) ?></h2>
    <div class="field"><label>Título da página (title)</label>
      <input name="title" maxlength="70" value="<?= e($cur['title']) ?>">
      <small>Recomendado: até 60 caracteres.</small>
    </div>
    <div class="field"><label>Meta descrição</label>
      <textarea name="description" rows="2" maxlength="200"><?= e($cur['description']) ?></textarea>
      <small>Recomendado: até 160 caracteres.</small>
    </div>
    <div class="field"><label>Palavras-chave (separadas por vírgula)</label>
      <input name="keywords" value="<?= e($cur['keywords']) ?>">
    </div>
  </div>

  <div class="card">
    <h2>Compartilhamento (Open Graph / Facebook)</h2>
    <div class="field"><label>Título Open Graph</label><input name="og_title" value="<?= e($cur['og_title']) ?>"></div>
    <div class="field"><label>Descrição Open Graph</label>
      <textarea name="og_description" rows="2"><?= e($cur['og_description']) ?></textarea>
    </div>
    <div class="field"><label>Imagem (URL completa, 1200×630 recomendado)</label>
      <input name="og_image" value="<?= e($cur['og_image']) ?>" placeholder="https://godaiterapias.com.br/assets/uploads/og.jpg">
    </div>
  </div>

  <button class="btn btn-primary">Salvar SEO</button>
</form>
<?php layout_end(); ?>
