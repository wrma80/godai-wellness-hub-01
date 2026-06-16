<?php
require_once __DIR__ . '/_auth.php';
require_login();

$UPLOADS_DIR = GODAI_ROOT . '/assets/uploads';
$UPLOADS_URL = base_url('assets/uploads/');
$CATEGORIES  = ['hero','sobre','quick-massage','empresas','eventos','institucional','recursos'];

if (!is_dir($UPLOADS_DIR)) @mkdir($UPLOADS_DIR, 0775, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $list = load_json('gallery', []);

    if ($action === 'upload' && !empty($_FILES['image']['tmp_name'])) {
        $tmp = $_FILES['image']['tmp_name'];
        $orig = $_FILES['image']['name'] ?? 'img';
        $size = (int)($_FILES['image']['size'] ?? 0);
        if ($size > 8 * 1024 * 1024) {
            flash('error', 'Imagem maior que 8 MB.');
        } else {
            $info = @getimagesize($tmp);
            $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
            $mime = $info['mime'] ?? '';
            if (!isset($allowed[$mime])) {
                flash('error', 'Formato inválido. Use JPG, PNG ou WEBP.');
            } else {
                $ext = $allowed[$mime];
                $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower(pathinfo($orig, PATHINFO_FILENAME)));
                $slug = trim($slug, '-') ?: 'img';
                $fname = $slug . '-' . substr(bin2hex(random_bytes(4)),0,8) . '.' . $ext;
                if (move_uploaded_file($tmp, $UPLOADS_DIR . '/' . $fname)) {
                    $cat = $_POST['category'] ?? 'recursos';
                    if (!in_array($cat, $CATEGORIES, true)) $cat = 'recursos';
                    $list[] = [
                        'id'         => 'g' . substr(bin2hex(random_bytes(4)),0,8),
                        'filename'   => $fname,
                        'category'   => $cat,
                        'alt'        => trim((string)($_POST['alt'] ?? '')),
                        'is_primary' => false,
                        'uploaded_at'=> date('c'),
                    ];
                    save_json('gallery', $list);
                    flash('success', 'Imagem enviada.');
                } else {
                    flash('error', 'Falha ao salvar arquivo. Verifique permissões de escrita em assets/uploads/.');
                }
            }
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        foreach ($list as $g) {
            if ($g['id'] === $id) @unlink($UPLOADS_DIR . '/' . $g['filename']);
        }
        $list = array_values(array_filter($list, fn($g)=>$g['id']!==$id));
        save_json('gallery', $list);
        flash('success', 'Imagem removida.');
    } elseif ($action === 'set_primary') {
        $id = $_POST['id'] ?? '';
        $cat = $_POST['category'] ?? '';
        foreach ($list as &$g) {
            if ($g['category'] === $cat) $g['is_primary'] = ($g['id'] === $id);
        }
        save_json('gallery', $list);
        flash('success', 'Imagem principal definida.');
    } elseif ($action === 'update_alt') {
        $id = $_POST['id'] ?? '';
        foreach ($list as &$g) {
            if ($g['id'] === $id) $g['alt'] = trim((string)($_POST['alt'] ?? ''));
        }
        save_json('gallery', $list);
        flash('success', 'Legenda atualizada.');
    }
    header('Location: ' . base_url('admin/galeria.php' . (!empty($_POST['filter_cat']) ? '?cat=' . urlencode($_POST['filter_cat']) : '')));
    exit;
}

$list = load_json('gallery', []);
$activeCat = $_GET['cat'] ?? '';
$csrf = csrf_token();
$page_title = 'Galeria';
$active = 'galeria';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <h2>Enviar nova imagem</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
    <input type="hidden" name="action" value="upload">
    <div class="row">
      <div class="field"><label>Arquivo (JPG, PNG, WEBP — máx 8MB)</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp" required></div>
      <div class="field"><label>Categoria</label>
        <select name="category">
          <?php foreach ($CATEGORIES as $c): ?><option value="<?= e($c) ?>"><?= e(ucfirst(str_replace('-',' ',$c))) ?></option><?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="field"><label>Legenda / texto alternativo (alt)</label><input name="alt" placeholder="Ex: Equipe Godai realizando Quick Massage"></div>
    <button class="btn btn-primary">Enviar imagem</button>
  </form>
</div>

<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:12px;">
    <h2>Imagens cadastradas (<?= count($list) ?>)</h2>
    <div style="display:flex;gap:6px;flex-wrap:wrap;">
      <a href="?" class="btn btn-sm <?= $activeCat===''?'btn-primary':'btn-out' ?>">Todas</a>
      <?php foreach ($CATEGORIES as $c): ?>
        <a href="?cat=<?= e($c) ?>" class="btn btn-sm <?= $activeCat===$c?'btn-primary':'btn-out' ?>"><?= e(ucfirst(str_replace('-',' ',$c))) ?></a>
      <?php endforeach; ?>
    </div>
  </div>

  <?php $filtered = $activeCat ? array_filter($list, fn($g)=>$g['category']===$activeCat) : $list; ?>
  <?php if (!$filtered): ?>
    <p class="sub">Nenhuma imagem nesta categoria.</p>
  <?php else: ?>
    <div class="gal">
      <?php foreach ($filtered as $g): ?>
        <div class="gal-item">
          <img src="<?= e($UPLOADS_URL . $g['filename']) ?>" alt="<?= e($g['alt'] ?? '') ?>" loading="lazy">
          <div class="meta">
            <strong><?= e(ucfirst(str_replace('-',' ',$g['category']))) ?></strong>
            <?php if (!empty($g['is_primary'])): ?> · <span class="badge">Principal</span><?php endif; ?>
            <div style="margin-top:4px;color:var(--muted);font-size:11px;word-break:break-all;"><?= e($g['filename']) ?></div>
          </div>
          <div class="bar">
            <form method="post" style="display:flex;gap:6px;flex:1;">
              <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
              <input type="hidden" name="action" value="set_primary">
              <input type="hidden" name="id" value="<?= e($g['id']) ?>">
              <input type="hidden" name="category" value="<?= e($g['category']) ?>">
              <input type="hidden" name="filter_cat" value="<?= e($activeCat) ?>">
              <button class="btn btn-sm btn-out" <?= !empty($g['is_primary'])?'disabled':'' ?>>Definir principal</button>
            </form>
            <form method="post" onsubmit="return confirm('Excluir esta imagem?')" style="margin:0;">
              <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= e($g['id']) ?>">
              <input type="hidden" name="filter_cat" value="<?= e($activeCat) ?>">
              <button class="btn btn-sm btn-danger">×</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
<?php layout_end(); ?>
