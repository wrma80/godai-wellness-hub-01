<?php
require_once __DIR__ . '/_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $list = get_pricing();

    if ($action === 'save_all') {
        $rows = [];
        foreach (($_POST['pri'] ?? []) as $i => $row) {
            $rows[] = [
                'id'            => $row['id'] ?: 'p' . substr(bin2hex(random_bytes(4)),0,8),
                'time_label'    => trim($row['time_label'] ?? ''),
                'solo_price'    => trim($row['solo_price'] ?? ''),
                'solo_capacity' => trim($row['solo_capacity'] ?? ''),
                'duo_price'     => trim($row['duo_price'] ?? ''),
                'duo_capacity'  => trim($row['duo_capacity'] ?? ''),
                'display_order' => (int)($row['display_order'] ?? ($i + 1)),
            ];
        }
        save_json('pricing', $rows);
        flash('success', 'Preços atualizados.');
    } elseif ($action === 'add') {
        $list[] = ['id'=>'p'.substr(bin2hex(random_bytes(4)),0,8),'time_label'=>'4h','solo_price'=>'','solo_capacity'=>'','duo_price'=>'','duo_capacity'=>'','display_order'=>count($list)+1];
        save_json('pricing', $list);
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $list = array_values(array_filter($list, fn($r)=>$r['id']!==$id));
        save_json('pricing', $list);
        flash('success', 'Faixa removida.');
    }
    header('Location: ' . base_url('admin/pricing.php'));
    exit;
}

$pricing = get_pricing();
$csrf = csrf_token();
$page_title = 'Preços';
$active = 'pricing';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div><h2>Tabela de preços</h2><p class="sub" style="margin:4px 0 0;">Faixas exibidas na página Quick Massage.</p></div>
    <form method="post" style="margin:0;"><input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="add">
      <button class="btn btn-out">+ Nova faixa</button>
    </form>
  </div>

  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_all">
    <div class="grid grid-2">
      <?php foreach ($pricing as $i => $p): ?>
        <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:10px;padding:18px;">
          <input type="hidden" name="pri[<?= $i ?>][id]" value="<?= e($p['id']) ?>">
          <div class="field"><label>Tempo (ex: 4h)</label><input name="pri[<?= $i ?>][time_label]" value="<?= e($p['time_label']) ?>" required></div>
          <div class="row">
            <div class="field"><label>Preço — 1 terapeuta</label><input name="pri[<?= $i ?>][solo_price]" value="<?= e($p['solo_price']) ?>"></div>
            <div class="field"><label>Capacidade — 1 terapeuta</label><input name="pri[<?= $i ?>][solo_capacity]" value="<?= e($p['solo_capacity']) ?>"></div>
          </div>
          <div class="row">
            <div class="field"><label>Preço — 2 terapeutas</label><input name="pri[<?= $i ?>][duo_price]" value="<?= e($p['duo_price']) ?>"></div>
            <div class="field"><label>Capacidade — 2 terapeutas</label><input name="pri[<?= $i ?>][duo_capacity]" value="<?= e($p['duo_capacity']) ?>"></div>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:end;">
            <div class="field" style="max-width:100px;margin:0;"><label>Ordem</label><input type="number" name="pri[<?= $i ?>][display_order]" value="<?= (int)$p['display_order'] ?>"></div>
            <button type="submit" form="delp-<?= e($p['id']) ?>" class="btn btn-sm btn-danger">Excluir</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="btn btn-primary" style="margin-top:18px;">Salvar preços</button>
  </form>

  <?php foreach ($pricing as $p): ?>
    <form id="delp-<?= e($p['id']) ?>" method="post" style="display:none;" onsubmit="return confirm('Excluir esta faixa?')">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($p['id']) ?>">
    </form>
  <?php endforeach; ?>
</div>
<?php layout_end(); ?>
