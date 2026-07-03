<?php
// admin/navegacao.php — Gerenciar itens do menu principal do site.
require_once __DIR__ . '/_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $data   = load_json('navigation', ['items' => []]);
    $items  = $data['items'] ?? [];

    if ($action === 'save_all') {
        $rows = [];
        foreach (($_POST['nav'] ?? []) as $i => $row) {
            $label = trim($row['label'] ?? '');
            $href  = trim($row['href'] ?? '');
            if ($label === '' || $href === '') continue;
            $rows[] = [
                'key'     => $row['key'] ?: 'n' . substr(bin2hex(random_bytes(3)),0,6),
                'label'   => $label,
                'href'    => $href,
                'enabled' => !empty($row['enabled']),
                'order'   => (int)($row['order'] ?? ($i + 1)),
            ];
        }
        usort($rows, fn($a,$b) => $a['order'] <=> $b['order']);
        save_json('navigation', ['items' => $rows]);
        admin_log('nav.save', count($rows) . ' itens');
        flash('success', 'Menu atualizado. As alterações aparecem imediatamente no site.');
    } elseif ($action === 'add') {
        $items[] = ['key'=>'n'.substr(bin2hex(random_bytes(3)),0,6),'label'=>'Nova página','href'=>'index.php','enabled'=>true,'order'=>count($items)+1];
        save_json('navigation', ['items' => $items]);
    } elseif ($action === 'delete') {
        $key = $_POST['key'] ?? '';
        $items = array_values(array_filter($items, fn($r) => ($r['key'] ?? '') !== $key));
        save_json('navigation', ['items' => $items]);
        admin_log('nav.delete', $key);
        flash('success', 'Item removido.');
    }
    header('Location: ' . base_url('admin/navegacao.php'));
    exit;
}

$data  = load_json('navigation', ['items' => []]);
$items = $data['items'] ?? [];
usort($items, fn($a,$b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));
$csrf = csrf_token();
$page_title = 'Navegação do site';
$active = 'navegacao';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div>
      <h2>Menu principal</h2>
      <p class="sub" style="margin:4px 0 0;">Controle a ordem, ativação e rótulo dos itens do menu do site. Itens desativados ficam ocultos no header (desktop e mobile).</p>
    </div>
    <form method="post" style="margin:0;">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="add">
      <button class="btn btn-out">+ Novo item</button>
    </form>
  </div>

  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_all">
    <?php foreach ($items as $i => $it): ?>
      <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:10px;padding:18px;margin-bottom:14px;">
        <input type="hidden" name="nav[<?= $i ?>][key]" value="<?= e($it['key']) ?>">
        <div class="row">
          <div class="field"><label>Rótulo</label><input name="nav[<?= $i ?>][label]" value="<?= e($it['label']) ?>" required></div>
          <div class="field"><label>Link (href)</label><input name="nav[<?= $i ?>][href]" value="<?= e($it['href']) ?>" required placeholder="index.php ou beneficios.php"></div>
          <div class="field" style="max-width:110px;"><label>Ordem</label><input type="number" name="nav[<?= $i ?>][order]" value="<?= (int)($it['order'] ?? $i+1) ?>"></div>
          <div class="field" style="max-width:130px;">
            <label>Ativo</label>
            <label style="display:flex;align-items:center;gap:8px;padding-top:8px;">
              <input type="checkbox" name="nav[<?= $i ?>][enabled]" value="1" <?= !empty($it['enabled']) ? 'checked' : '' ?>>
              <span>Exibir no site</span>
            </label>
          </div>
        </div>
        <div style="text-align:right;">
          <button type="submit" form="delnav-<?= e($it['key']) ?>" class="btn btn-sm btn-danger">Excluir</button>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (!$items): ?><p class="sub">Nenhum item cadastrado.</p><?php endif; ?>
    <button class="btn btn-primary">Salvar menu</button>
  </form>

  <?php foreach ($items as $it): ?>
    <form id="delnav-<?= e($it['key']) ?>" method="post" style="display:none;" onsubmit="return confirm('Excluir este item do menu?');">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="key" value="<?= e($it['key']) ?>">
    </form>
  <?php endforeach; ?>
</div>
<?php layout_end(); ?>
