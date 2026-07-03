<?php
require_once __DIR__ . '/_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $list = load_json('faq', []);

    if ($action === 'save_all') {
        $rows = [];
        foreach (($_POST['faq'] ?? []) as $i => $row) {
            $q = trim($row['question'] ?? '');
            $a = trim($row['answer'] ?? '');
            if ($q === '') continue;
            $rows[] = [
                'id'            => $row['id'] ?: 'f' . substr(bin2hex(random_bytes(4)), 0, 8),
                'question'      => $q,
                'answer'        => $a,
                'display_order' => (int)($row['display_order'] ?? ($i + 1)),
            ];
        }
        usort($rows, fn($a,$b)=>$a['display_order']<=>$b['display_order']);
        save_json('faq', $rows);
        flash('success', 'FAQ atualizado.');
        admin_log('faq.save', count($rows) . ' perguntas');
    } elseif ($action === 'add') {
        $list[] = ['id'=>'f'.substr(bin2hex(random_bytes(4)),0,8),'question'=>'Nova pergunta','answer'=>'','display_order'=>count($list)+1];
        save_json('faq', $list);
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        $list = array_values(array_filter($list, fn($r)=>$r['id']!==$id));
        save_json('faq', $list);
        flash('success', 'Pergunta removida.');
        admin_log('faq.delete', $id);
    }
    header('Location: ' . base_url('admin/faq.php'));
    exit;
}

$items = load_json('faq', []);
usort($items, fn($a,$b)=>($a['display_order']??0)<=>($b['display_order']??0));
$csrf = csrf_token();
$page_title = 'FAQ';
$active = 'faq';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div><h2>Perguntas frequentes</h2><p class="sub" style="margin:4px 0 0;">Reordene editando o campo "Ordem". Salve para aplicar.</p></div>
    <form method="post" style="margin:0;">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="add">
      <button class="btn btn-out">+ Nova pergunta</button>
    </form>
  </div>

  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_all">
    <?php foreach ($items as $i => $it): ?>
      <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:10px;padding:18px;margin-bottom:14px;">
        <input type="hidden" name="faq[<?= $i ?>][id]" value="<?= e($it['id']) ?>">
        <div class="row">
          <div class="field"><label>Pergunta</label><input name="faq[<?= $i ?>][question]" value="<?= e($it['question']) ?>" required></div>
          <div class="field" style="max-width:120px;"><label>Ordem</label><input type="number" name="faq[<?= $i ?>][display_order]" value="<?= (int)$it['display_order'] ?>"></div>
        </div>
        <div class="field" style="margin-bottom:6px;"><label>Resposta</label>
          <textarea name="faq[<?= $i ?>][answer]" rows="3"><?= e($it['answer']) ?></textarea>
        </div>
        <div style="text-align:right;">
          <button type="submit" form="del-<?= e($it['id']) ?>" class="btn btn-sm btn-danger">Excluir</button>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (!$items): ?><p class="sub">Nenhuma pergunta cadastrada. Use "+ Nova pergunta".</p><?php endif; ?>
    <button class="btn btn-primary">Salvar alterações</button>
  </form>

  <?php foreach ($items as $it): ?>
    <form id="del-<?= e($it['id']) ?>" method="post" style="display:none;" onsubmit="return confirm('Excluir esta pergunta?');">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($it['id']) ?>">
    </form>
  <?php endforeach; ?>
</div>
<?php layout_end(); ?>
