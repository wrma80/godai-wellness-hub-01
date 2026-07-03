<?php
require_once __DIR__ . '/_auth.php';
require_login();

$list = load_json('messages', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    if ($action === 'delete') {
        $list = array_values(array_filter($list, fn($m)=>$m['id']!==$id));
        save_json('messages', $list);
        admin_log('mensagens.delete', $id);
        flash('success', 'Mensagem excluída.');
    } elseif ($action === 'toggle_read') {
        foreach ($list as &$m) {
            if (($m['id'] ?? '') === $id) $m['is_read'] = empty($m['is_read']);
        }
        unset($m);
        save_json('messages', $list);
        admin_log('mensagens.toggle_read', $id);
    } elseif ($action === 'mark_all_read') {
        foreach ($list as &$m) $m['is_read'] = true;
        unset($m);
        save_json('messages', $list);
        admin_log('mensagens.mark_all_read', '');
        flash('success', 'Todas as mensagens marcadas como lidas.');
    }
    header('Location: ' . base_url('admin/mensagens.php' . (!empty($_GET['id']) ? '?id=' . urlencode($_GET['id']) : '')));
    exit;
}

// CSV export
if (($_GET['export'] ?? '') === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="mensagens-godai-' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fprintf($out, "\xEF\xBB\xBF"); // BOM UTF-8
    fputcsv($out, ['Data','Nome','Empresa','E-mail','WhatsApp','Telefone','Cidade','Tipo','Colaboradores','Mensagem','IP']);
    foreach ($list as $m) {
        fputcsv($out, [
            $m['created_at'] ?? '',
            $m['nome'] ?? '',
            $m['empresa'] ?? '',
            $m['email'] ?? '',
            $m['whatsapp'] ?? '',
            $m['telefone'] ?? '',
            $m['cidade'] ?? '',
            $m['tipo'] ?? '',
            $m['colaboradores'] ?? '',
            $m['mensagem'] ?? '',
            $m['ip'] ?? '',
        ]);
    }
    fclose($out);
    exit;
}

$q = trim((string)($_GET['q'] ?? ''));
$from = $_GET['from'] ?? '';
$to   = $_GET['to'] ?? '';

$filtered = array_filter($list, function($m) use ($q,$from,$to) {
    if ($q !== '') {
        $hay = strtolower(($m['nome']??'').' '.($m['empresa']??'').' '.($m['email']??'').' '.($m['mensagem']??''));
        if (strpos($hay, strtolower($q)) === false) return false;
    }
    $ts = strtotime($m['created_at'] ?? 'now');
    if ($from && $ts < strtotime($from . ' 00:00:00')) return false;
    if ($to && $ts > strtotime($to . ' 23:59:59')) return false;
    return true;
});

$detail = null;
if (!empty($_GET['id'])) {
    foreach ($list as $m) if ($m['id'] === $_GET['id']) { $detail = $m; break; }
}

$csrf = csrf_token();
$page_title = 'Mensagens recebidas';
$active = 'mensagens';
require __DIR__ . '/_layout.php';
layout_start();
?>
<?php
// Auto-marcar como lida ao abrir o detalhe
if ($detail && empty($detail['is_read'])) {
    foreach ($list as &$m) {
        if (($m['id'] ?? '') === $detail['id']) $m['is_read'] = true;
    }
    unset($m);
    save_json('messages', $list);
    $detail['is_read'] = true;
}
?>
<?php if ($detail): ?>
  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
      <h2>Mensagem de <?= e($detail['nome']) ?></h2>
      <a href="<?= e(base_url('admin/mensagens.php')) ?>" class="btn btn-sm btn-out">← Voltar</a>
    </div>
    <p class="sub"><?= e(date('d/m/Y H:i', strtotime($detail['created_at']))) ?> · IP <?= e($detail['ip'] ?? '—') ?></p>
    <table class="tbl" style="margin-top:14px;">
      <tr><th style="width:200px;">Empresa</th><td><?= e($detail['empresa'] ?? '') ?></td></tr>
      <tr><th>E-mail</th><td><a href="mailto:<?= e($detail['email']) ?>"><?= e($detail['email']) ?></a></td></tr>
      <tr><th>WhatsApp</th><td><?= e($detail['whatsapp'] ?? '') ?></td></tr>
      <?php if(!empty($detail['telefone'])): ?><tr><th>Telefone</th><td><?= e($detail['telefone']) ?></td></tr><?php endif; ?>
      <tr><th>Cidade</th><td><?= e($detail['cidade'] ?? '') ?></td></tr>
      <tr><th>Tipo</th><td><?= e($detail['tipo'] ?? '') ?></td></tr>
      <tr><th>Colaboradores</th><td><?= e($detail['colaboradores'] ?? '') ?></td></tr>
    </table>
    <h3 style="margin-top:20px;color:var(--sage-deep);">Mensagem</h3>
    <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:8px;padding:14px 16px;white-space:pre-wrap;"><?= e($detail['mensagem'] ?? '') ?></div>
    <div style="display:flex;gap:10px;margin-top:20px;">
      <form method="post" style="margin:0;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
        <input type="hidden" name="action" value="toggle_read">
        <input type="hidden" name="id" value="<?= e($detail['id']) ?>">
        <button class="btn btn-out">Marcar como <?= !empty($detail['is_read']) ? 'não lida' : 'lida' ?></button>
      </form>
      <form method="post" onsubmit="return confirm('Excluir esta mensagem?')" style="margin:0;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?= e($detail['id']) ?>">
        <button class="btn btn-danger">Excluir mensagem</button>
      </form>
    </div>
  </div>
<?php else: ?>
  <?php
    // Ordena por data DESC (mais nova primeiro). array_unshift já faz isso, mas usort garante consistência.
    $ordered = $filtered;
    usort($ordered, fn($a,$b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));
    $unreadCount = count(array_filter($list, fn($m) => empty($m['is_read'])));
  ?>
  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;flex-wrap:wrap;gap:10px;">
      <div>
        <strong><?= count($ordered) ?></strong> mensagens
        <?php if ($unreadCount > 0): ?>
          · <span style="background:var(--sage);color:#fff;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:600;"><?= $unreadCount ?> não lida<?= $unreadCount === 1 ? '' : 's' ?></span>
        <?php endif; ?>
      </div>
      <?php if ($unreadCount > 0): ?>
        <form method="post" style="margin:0;" onsubmit="return confirm('Marcar todas as mensagens como lidas?');">
          <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
          <input type="hidden" name="action" value="mark_all_read">
          <button class="btn btn-sm btn-out">Marcar todas como lidas</button>
        </form>
      <?php endif; ?>
    </div>

    <form method="get" style="display:flex;gap:10px;flex-wrap:wrap;align-items:end;margin-bottom:14px;">
      <div class="field" style="margin:0;flex:1;min-width:200px;"><label>Buscar</label><input name="q" value="<?= e($q) ?>" placeholder="Nome, empresa, e-mail..."></div>
      <div class="field" style="margin:0;"><label>De</label><input type="date" name="from" value="<?= e($from) ?>"></div>
      <div class="field" style="margin:0;"><label>Até</label><input type="date" name="to" value="<?= e($to) ?>"></div>
      <button class="btn btn-out">Filtrar</button>
      <a href="?<?= e(http_build_query(array_merge($_GET, ['export'=>'csv']))) ?>" class="btn btn-primary">Exportar CSV</a>
    </form>

    <?php if (!$ordered): ?>
      <p class="sub">Nenhuma mensagem encontrada.</p>
    <?php else: ?>
      <table class="tbl">
        <thead><tr><th style="width:32px;"></th><th>Data</th><th>Nome</th><th>Empresa</th><th>E-mail</th><th>Cidade</th><th></th></tr></thead>
        <tbody>
          <?php foreach ($ordered as $m): $unread = empty($m['is_read']); ?>
            <tr style="<?= $unread ? 'background:var(--cream-2);font-weight:500;' : '' ?>">
              <td style="text-align:center;"><?php if ($unread): ?><span title="Não lida" style="display:inline-block;width:8px;height:8px;border-radius:999px;background:var(--sage);"></span><?php endif; ?></td>
              <td><?= e(date('d/m/Y H:i', strtotime($m['created_at']))) ?></td>
              <td><?= e($m['nome'] ?? '') ?></td>
              <td><?= e($m['empresa'] ?? '') ?></td>
              <td><?= e($m['email'] ?? '') ?></td>
              <td><?= e($m['cidade'] ?? '') ?></td>
              <td class="actions"><a href="?id=<?= e($m['id']) ?>" class="btn btn-sm btn-out">Ver</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
<?php endif; ?>
<?php layout_end(); ?>
