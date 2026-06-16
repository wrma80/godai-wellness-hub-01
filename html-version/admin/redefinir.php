<?php
require_once __DIR__ . '/_auth.php';

$token = (string)($_GET['token'] ?? $_POST['token'] ?? '');
$entry = $token !== '' ? consume_reset_token($token) : null;
$done = false;
$err = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entry) {
    check_csrf();
    $new = (string)($_POST['new'] ?? '');
    $rep = (string)($_POST['confirm'] ?? '');
    if (strlen($new) < 6)        $err = 'A nova senha deve ter ao menos 6 caracteres.';
    elseif ($new !== $rep)       $err = 'Confirmação não confere.';
    else {
        update_user($entry['user_id'], ['password_hash' => password_hash($new, PASSWORD_BCRYPT)]);
        mark_reset_token_used($token);
        $done = true;
    }
}
$csrf = csrf_token();
?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Redefinir senha — Painel Godai</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= e(base_url('admin/assets/admin.css')) ?>">
<meta name="robots" content="noindex,nofollow">
</head><body class="admin">
<div class="lg-shell">
  <div class="lg-card">
    <div class="logo-wrap"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai"></div>
    <h1>Definir nova senha</h1>

    <?php if (!$entry && !$done): ?>
      <div class="alert alert-error" style="margin-top:14px;">
        Link inválido ou expirado. Solicite uma nova redefinição.
      </div>
      <div class="links"><a href="<?= e(base_url('admin/esqueci.php')) ?>">← Solicitar novo link</a></div>
    <?php elseif ($done): ?>
      <div class="alert alert-success" style="margin-top:14px;">
        Senha redefinida com sucesso. Você já pode entrar com a nova senha.
      </div>
      <p style="text-align:center;margin-top:20px;"><a href="<?= e(base_url('admin/login.php')) ?>" class="btn btn-primary">Ir para o login →</a></p>
    <?php else: ?>
      <?php if ($err): ?><div class="alert alert-error"><?= e($err) ?></div><?php endif; ?>
      <form method="post" style="margin-top:6px;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
        <input type="hidden" name="token" value="<?= e($token) ?>">
        <div class="field"><label>Nova senha</label><input name="new" type="password" minlength="6" required autofocus></div>
        <div class="field"><label>Confirmar nova senha</label><input name="confirm" type="password" minlength="6" required></div>
        <button class="btn btn-primary" style="width:100%;margin-top:8px;">Redefinir senha</button>
      </form>
    <?php endif; ?>
  </div>
</div>
</body></html>
