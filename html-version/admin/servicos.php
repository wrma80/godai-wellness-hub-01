<?php
require_once __DIR__ . '/_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $list = get_services();

    if ($action === 'save_all') {
        $rows = [];
        foreach (($_POST['svc'] ?? []) as $i => $row) {
            $title = trim($row['title'] ?? '');
            if ($title === '') continue;
            $rows[] = [
                'id'            => $row['id'] ?: 's' . substr(bin2hex(random_bytes(4)),0,8),
                'title'         => $title,
                'duration'      => trim($row['duration'] ?? ''),
                'capacity'      => trim($row['capacity'] ?? ''),
                'description'   => trim($row['description'] ?? ''),
                'display_order' => (int)($row['display_order'] ?? ($i + 1)),
            ];
        }
        usort($rows, fn($a,$b)=>$a['display_order']<=>$b['display_order']);
        save_json('services', $rows);
        flash('success', 'Serviços atualizados.');
    } elseif ($action === 'add') {
        $list[] = ['id'=>'s'.substr(bin2hex(random_bytes(4)),0,8),'title'=>'Novo serviço','duration'=>'','capacity'=>'','description'=>'','display_order'=>count($list)+1];
        save_json('services', $list);
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $list = array_values(array_filter($list, fn($r)=>$r['id']!==$id));
        save_json('services', $list);
        flash('success', 'Serviço removido.');
    }
    header('Location: ' . base_url('admin/servicos.php'));
    exit;
}

$svcs = get_services();
$csrf = csrf_token();
$page_title = 'Serviços';
$active = 'servicos';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div><h2>Serviços</h2><p class="sub" style="margin:4px 0 0;">Lista de serviços exibida no site.</p></div>
    <form method="post" style="margin:0;"><input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="add">
      <button class="btn btn-out">+ Novo serviço</button>
    </form>
  </div>

  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_all">
    <div class="grid grid-2">
      <?php foreach ($svcs as $i => $s): ?>
        <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:10px;padding:18px;">
          <input type="hidden" name="svc[<?= $i ?>][id]" value="<?= e($s['id']) ?>">
          <div class="field"><label>Título</label><input name="svc[<?= $i ?>][title]" value="<?= e($s['title']) ?>" required></div>
          <div class="row">
            <div class="field"><label>Duração</label><input name="svc[<?= $i ?>][duration]" value="<?= e($s['duration']) ?>"></div>
            <div class="field"><label>Capacidade</label><input name="svc[<?= $i ?>][capacity]" value="<?= e($s['capacity']) ?>"></div>
          </div>
          <div class="field"><label>Descrição</label><textarea name="svc[<?= $i ?>][description]" rows="2"><?= e($s['description']) ?></textarea></div>
          <div style="display:flex;justify-content:space-between;align-items:end;">
            <div class="field" style="max-width:100px;margin:0;"><label>Ordem</label><input type="number" name="svc[<?= $i ?>][display_order]" value="<?= (int)$s['display_order'] ?>"></div>
            <button type="submit" form="del-<?= e($s['id']) ?>" class="btn btn-sm btn-danger">Excluir</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if (!$svcs): ?><p class="sub">Nenhum serviço cadastrado.</p><?php endif; ?>
    <button class="btn btn-primary" style="margin-top:18px;">Salvar serviços</button>
  </form>

  <?php foreach ($svcs as $s): ?>
    <form id="del-<?= e($s['id']) ?>" method="post" style="display:none;" onsubmit="return confirm('Excluir este serviço?')">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($s['id']) ?>">
    </form>
  <?php endforeach; ?>
</div>
<?php layout_end(); ?>
