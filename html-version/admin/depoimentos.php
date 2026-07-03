<?php
// admin/depoimentos.php — CRUD de depoimentos (estrutura pronta, ainda não exibida no site).
require_once __DIR__ . '/_auth.php';
require_login();

$UPLOADS_DIR = GODAI_ROOT . '/assets/uploads/testimonials';
$UPLOADS_REL = 'assets/uploads/testimonials';
if (!is_dir($UPLOADS_DIR)) @mkdir($UPLOADS_DIR, 0775, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $list = load_json('testimonials', []);

    if ($action === 'save_all') {
        $rows = [];
        foreach (($_POST['tst'] ?? []) as $i => $row) {
            $name = trim($row['name'] ?? '');
            $text = trim($row['text'] ?? '');
            if ($name === '' || $text === '') continue;
            $id = $row['id'] ?: 't' . substr(bin2hex(random_bytes(4)),0,8);

            // Manter foto anterior por padrão
            $photo = $row['photo'] ?? '';

            // Se veio arquivo, salvar
            if (!empty($_FILES['tst']['tmp_name'][$i]['photo'])) {
                $tmp  = $_FILES['tst']['tmp_name'][$i]['photo'];
                $mime = @getimagesize($tmp)['mime'] ?? '';
                $ext  = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'][$mime] ?? '';
                if ($ext) {
                    $fname = $id . '_' . date('Ymd_His') . '.' . $ext;
                    if (@move_uploaded_file($tmp, $UPLOADS_DIR . '/' . $fname)) {
                        $photo = $UPLOADS_REL . '/' . $fname;
                    }
                }
            }

            $rows[] = [
                'id'            => $id,
                'name'          => $name,
                'company'       => trim($row['company'] ?? ''),
                'role'          => trim($row['role'] ?? ''),
                'text'          => $text,
                'photo'         => $photo,
                'active'        => !empty($row['active']),
                'display_order' => (int)($row['display_order'] ?? ($i + 1)),
            ];
        }
        usort($rows, fn($a,$b) => $a['display_order'] <=> $b['display_order']);
        save_json('testimonials', $rows);
        admin_log('testimonials.save', count($rows) . ' depoimentos');
        flash('success', 'Depoimentos salvos.');
    } elseif ($action === 'add') {
        $list[] = ['id'=>'t'.substr(bin2hex(random_bytes(4)),0,8),'name'=>'Novo depoimento','company'=>'','role'=>'','text'=>'','photo'=>'','active'=>true,'display_order'=>count($list)+1];
        save_json('testimonials', $list);
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $list = array_values(array_filter($list, fn($r) => ($r['id'] ?? '') !== $id));
        save_json('testimonials', $list);
        admin_log('testimonials.delete', $id);
        flash('success', 'Depoimento removido.');
    }
    header('Location: ' . base_url('admin/depoimentos.php'));
    exit;
}

$items = load_json('testimonials', []);
usort($items, fn($a,$b) => ($a['display_order'] ?? 0) <=> ($b['display_order'] ?? 0));
$csrf = csrf_token();
$page_title = 'Depoimentos';
$active = 'depoimentos';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div>
      <h2>Depoimentos</h2>
      <p class="sub" style="margin:4px 0 0;">Cadastro de depoimentos de clientes. <strong>Estrutura pronta</strong> — ainda não é exibido no site, será ativado em iteração futura.</p>
    </div>
    <form method="post" style="margin:0;">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="add">
      <button class="btn btn-out">+ Novo depoimento</button>
    </form>
  </div>

  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_all">
    <?php foreach ($items as $i => $t): ?>
      <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:10px;padding:18px;margin-bottom:14px;">
        <input type="hidden" name="tst[<?= $i ?>][id]" value="<?= e($t['id']) ?>">
        <input type="hidden" name="tst[<?= $i ?>][photo]" value="<?= e($t['photo'] ?? '') ?>">
        <div class="row">
          <div class="field"><label>Nome</label><input name="tst[<?= $i ?>][name]" value="<?= e($t['name']) ?>" required></div>
          <div class="field"><label>Empresa</label><input name="tst[<?= $i ?>][company]" value="<?= e($t['company'] ?? '') ?>"></div>
          <div class="field"><label>Cargo</label><input name="tst[<?= $i ?>][role]" value="<?= e($t['role'] ?? '') ?>"></div>
        </div>
        <div class="field"><label>Depoimento</label><textarea name="tst[<?= $i ?>][text]" rows="3" required><?= e($t['text']) ?></textarea></div>
        <div class="row">
          <div class="field">
            <label>Foto (opcional)</label>
            <?php if (!empty($t['photo'])): ?>
              <div style="margin-bottom:6px;"><img src="<?= e(base_url($t['photo'])) ?>" alt="" style="height:56px;width:56px;border-radius:999px;object-fit:cover;"></div>
            <?php endif; ?>
            <input type="file" name="tst[<?= $i ?>][photo]" accept="image/jpeg,image/png,image/webp">
            <small>JPG/PNG/WEBP. Deixe vazio para manter a foto atual.</small>
          </div>
          <div class="field" style="max-width:110px;"><label>Ordem</label><input type="number" name="tst[<?= $i ?>][display_order]" value="<?= (int)($t['display_order'] ?? $i+1) ?>"></div>
          <div class="field" style="max-width:130px;">
            <label>Status</label>
            <label style="display:flex;align-items:center;gap:8px;padding-top:8px;">
              <input type="checkbox" name="tst[<?= $i ?>][active]" value="1" <?= !empty($t['active']) ? 'checked' : '' ?>>
              <span>Ativo</span>
            </label>
          </div>
        </div>
        <div style="text-align:right;">
          <button type="submit" form="deltst-<?= e($t['id']) ?>" class="btn btn-sm btn-danger">Excluir</button>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (!$items): ?><p class="sub">Nenhum depoimento cadastrado. Use "+ Novo depoimento".</p><?php endif; ?>
    <button class="btn btn-primary">Salvar depoimentos</button>
  </form>

  <?php foreach ($items as $t): ?>
    <form id="deltst-<?= e($t['id']) ?>" method="post" style="display:none;" onsubmit="return confirm('Excluir este depoimento?');">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($t['id']) ?>">
    </form>
  <?php endforeach; ?>
</div>
<?php layout_end(); ?>
