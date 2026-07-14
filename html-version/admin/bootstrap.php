<?php
// bootstrap.php — Setup inicial: cria o primeiro usuário administrador.
// Só funciona enquanto NÃO houver usuários cadastrados. Depois é bloqueado.
require_once __DIR__ . '/_auth.php';

if (!empty(load_users())) {
    // Já existe usuário — bloqueia o bootstrap por segurança.
    header('Location: ' . base_url('admin/login.php'));
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $username = trim((string)($_POST['username'] ?? ''));
    $email    = trim((string)($_POST['email'] ?? ''));
    $pass     = (string)($_POST['password'] ?? '');
    $pass2    = (string)($_POST['password2'] ?? '');

    if ($username === '' || strlen($username) < 3) $errors[] = 'Usuário deve ter ao menos 3 caracteres.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))  $errors[] = 'E-mail inválido.';
    if (strlen($pass) < 8)                           $errors[] = 'Senha deve ter ao menos 8 caracteres.';
    if ($pass !== $pass2)                            $errors[] = 'As senhas não conferem.';

    if (!$errors) {
        $user = [
            'id'            => 'u' . substr(bin2hex(random_bytes(6)), 0, 10),
            'username'      => $username,
            'password_hash' => password_hash($pass, PASSWORD_DEFAULT),
            'email'         => $email,
            'role'          => 'admin',
            'created_at'    => date('c'),
        ];
        save_users([$user]);
        admin_log('auth.bootstrap', 'usuário inicial criado: ' . $username);
        login_user($user);
        header('Location: ' . base_url('admin/index.php'));
        exit;
    }
}

$csrf = csrf_token();
?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Setup inicial — Painel Godai</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= e(base_url('admin/assets/admin.css')) ?>">
<meta name="robots" content="noindex,nofollow">
</head><body class="admin">
<div class="lg-shell">
  <form method="post" class="lg-card">
    <div class="logo-wrap"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai"></div>
    <h1>Setup inicial</h1>
    <p class="sub">Crie o primeiro usuário administrador do painel.</p>

    <?php foreach ($errors as $err): ?>
      <div class="alert alert-error"><?= e($err) ?></div>
    <?php endforeach; ?>

    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
    <div class="field"><label>Usuário</label><input name="username" required autofocus autocomplete="username"></div>
    <div class="field"><label>E-mail</label><input name="email" type="email" required autocomplete="email"></div>
    <div class="field"><label>Senha (mín. 8 caracteres)</label><input name="password" type="password" required autocomplete="new-password"></div>
    <div class="field"><label>Confirmar senha</label><input name="password2" type="password" required autocomplete="new-password"></div>
    <button class="btn btn-primary" style="width:100%;margin-top:8px;">Criar administrador</button>
  </form>
</div>
</body></html>
