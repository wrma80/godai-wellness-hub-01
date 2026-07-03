<?php
require_once __DIR__ . '/_auth.php';

if (is_logged_in()) {
    header('Location: ' . base_url('admin/index.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $u = trim((string)($_POST['username'] ?? ''));
    $p = (string)($_POST['password'] ?? '');
    $user = find_user_by_username($u);
    if ($user && password_verify($p, $user['password_hash'] ?? '')) {
        login_user($user);
        admin_log('auth.login', 'usuário: ' . $u);
        header('Location: ' . base_url('admin/index.php'));
        exit;
    }
    admin_log('auth.login_failed', 'tentativa: ' . $u);
    flash('error', 'Usuário ou senha incorretos.');
}

$csrf = csrf_token();
$flash = pop_flash();
$noUsers = empty(load_users());
?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login — Painel Godai</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= e(base_url('admin/assets/admin.css')) ?>">
<meta name="robots" content="noindex,nofollow">
</head><body class="admin">
<div class="lg-shell">
  <form method="post" class="lg-card">
    <div class="logo-wrap"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai"></div>
    <h1>Painel Godai</h1>
    <p class="sub">Acesso restrito ao administrador</p>

    <?php if ($flash): ?><div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['msg']) ?></div><?php endif; ?>

    <?php if ($noUsers): ?>
      <div class="alert alert-info">
        Nenhum usuário cadastrado. Execute <a href="<?= e(base_url('admin/bootstrap.php')) ?>">setup inicial</a>.
      </div>
    <?php endif; ?>

    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
    <div class="field"><label>Usuário</label><input name="username" required autocomplete="username" autofocus></div>
    <div class="field"><label>Senha</label><input name="password" type="password" required autocomplete="current-password"></div>
    <button class="btn btn-primary" style="width:100%;margin-top:8px;">Entrar</button>
    <div class="links"><a href="<?= e(base_url('admin/esqueci.php')) ?>">Esqueci minha senha</a></div>
  </form>
</div>
</body></html>
