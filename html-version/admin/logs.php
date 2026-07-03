<?php
// admin/logs.php — Histórico de ações administrativas.
require_once __DIR__ . '/_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    if (($_POST['action'] ?? '') === 'clear') {
        save_json('admin-logs', []);
        flash('success', 'Histórico de logs limpo.');
    }
    header('Location: ' . base_url('admin/logs.php'));
    exit;
}

$logs = load_json('admin-logs', []);
// Ordena por timestamp desc
usort($logs, fn($a,$b) => strcmp($b['ts'] ?? '', $a['ts'] ?? ''));
$csrf = csrf_token();
$page_title = 'Logs administrativos';
$active = 'logs';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div>
      <h2>Logs administrativos</h2>
      <p class="sub" style="margin:4px 0 0;">Últimas <?= count($logs) ?> ações registradas. Máximo mantido: 500 entradas (as mais antigas são descartadas).</p>
    </div>
    <?php if ($logs): ?>
      <form method="post" onsubmit="return confirm('Limpar TODO o histórico de logs?');" style="margin:0;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="clear">
        <button class="btn btn-out">Limpar histórico</button>
      </form>
    <?php endif; ?>
  </div>

  <?php if (!$logs): ?>
    <p class="sub">Nenhuma ação registrada ainda.</p>
  <?php else: ?>
    <table class="tbl">
      <thead>
        <tr>
          <th style="width:170px;">Data / Hora</th>
          <th style="width:140px;">Usuário</th>
          <th style="width:180px;">Ação</th>
          <th>Detalhe</th>
          <th style="width:130px;">IP</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (array_slice($logs, 0, 200) as $log): ?>
          <tr>
            <td><?= e(date('d/m/Y H:i:s', strtotime($log['ts'] ?? 'now'))) ?></td>
            <td><?= e($log['user'] ?? '—') ?></td>
            <td><code style="font-size:12px;"><?= e($log['action'] ?? '') ?></code></td>
            <td><?= e($log['detail'] ?? '') ?></td>
            <td style="font-family:monospace;font-size:12px;color:var(--muted);"><?= e($log['ip'] ?? '') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php layout_end(); ?>
