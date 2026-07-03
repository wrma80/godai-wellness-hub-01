<?php
require_once __DIR__ . '/_auth.php';
require_login();

$messages = load_json('messages', []);
$faq = load_json('faq', []);
$gal = load_json('gallery', []);
$lastMsg = $messages[0] ?? null;
$last30 = array_filter($messages, fn($m) => strtotime($m['created_at'] ?? 'now') >= strtotime('-30 days'));
$unreadCount = count(array_filter($messages, fn($m) => empty($m['is_read'])));

$page_title = 'Dashboard';
$active = 'dashboard';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="grid grid-4">
  <div class="kpi">
    <div class="lbl">Mensagens recebidas</div>
    <div class="num"><?= count($messages) ?><?php if ($unreadCount > 0): ?> <span style="font-size:14px;background:var(--sage);color:#fff;padding:3px 10px;border-radius:999px;vertical-align:middle;"><?= $unreadCount ?> nova<?= $unreadCount === 1 ? '' : 's' ?></span><?php endif; ?></div>
    <div class="meta"><?= count($last30) ?> nos últimos 30 dias</div>
  </div>
  <div class="kpi"><div class="lbl">FAQs cadastradas</div><div class="num"><?= count($faq) ?></div><div class="meta">Perguntas frequentes ativas</div></div>
  <div class="kpi"><div class="lbl">Imagens na galeria</div><div class="num"><?= count($gal) ?></div><div class="meta"><?= count(array_filter($gal, fn($g)=>!empty($g['is_primary']))) ?> marcadas como principais</div></div>
  <div class="kpi"><div class="lbl">Último orçamento</div><div class="num" style="font-size:18px;line-height:1.3;"><?= $lastMsg ? e(date('d/m/Y H:i', strtotime($lastMsg['created_at']))) : '—' ?></div><div class="meta"><?= $lastMsg ? e($lastMsg['nome'] ?? '') : 'Nenhum recebido' ?></div></div>
</div>

<div class="card" style="margin-top:22px;">
  <h2>Atalhos rápidos</h2>
  <div class="grid grid-4" style="margin-top:8px;">
    <a href="<?= e(base_url('admin/contatos.php')) ?>" class="btn btn-out">☎ Editar contatos</a>
    <a href="<?= e(base_url('admin/faq.php')) ?>"      class="btn btn-out">? Gerenciar FAQ</a>
    <a href="<?= e(base_url('admin/galeria.php')) ?>"  class="btn btn-out">▣ Galeria</a>
    <a href="<?= e(base_url('admin/email.php')) ?>"    class="btn btn-out">✦ Configurar SMTP</a>
  </div>
</div>

<div class="card">
  <h2>Últimas mensagens</h2>
  <?php if (!$messages): ?>
    <p class="sub">Nenhuma mensagem recebida ainda.</p>
  <?php else: ?>
    <table class="tbl">
      <thead><tr><th>Data</th><th>Nome</th><th>Empresa</th><th>E-mail</th><th></th></tr></thead>
      <tbody>
        <?php foreach (array_slice($messages, 0, 8) as $m): ?>
          <tr>
            <td><?= e(date('d/m/Y H:i', strtotime($m['created_at']))) ?></td>
            <td><?= e($m['nome'] ?? '') ?></td>
            <td><?= e($m['empresa'] ?? '') ?></td>
            <td><?= e($m['email'] ?? '') ?></td>
            <td class="actions"><a href="<?= e(base_url('admin/mensagens.php?id='.urlencode($m['id']))) ?>" class="btn btn-sm btn-out">Ver</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php if (!smtp_configured_safe()): ?>
<div class="alert alert-error">
  ⚠ <strong>SMTP não configurado.</strong> Os formulários não conseguirão enviar e-mails.
  <a href="<?= e(base_url('admin/email.php')) ?>" style="color:inherit;text-decoration:underline;">Configurar agora</a>.
</div>
<?php endif; ?>

<?php
layout_end();

// Helper local (não importa mailer pra evitar carregar PHPMailer no dashboard)
function smtp_configured_safe(): bool {
    $path = GODAI_ROOT . '/includes/email-config.php';
    if (!is_file($path)) return false;
    $c = file_get_contents($path);
    return strpos($c, "SMTP_HOST',     '')") === false && strpos($c, "SMTP_HOST', '')") === false;
}
?>
