<?php
// bootstrap.php — Setup inicial do admin (acessar uma única vez no navegador).
// Cria o usuário padrão "Godai/123456" se nenhum usuário existir.
// Após criar, exibe instruções para apagar este arquivo do servidor.

require_once __DIR__ . '/_auth.php';

$users = load_users();
$alreadyExists = !empty($users);

$msg = null;
$msgType = null;

if (!$alreadyExists && ($_POST['confirm'] ?? '') === 'yes') {
    $userId = 'u' . substr(bin2hex(random_bytes(6)), 0, 10);
    $newUser = [
        'id'            => $userId,
        'username'      => 'Godai',
        'password_hash' => password_hash('123456', PASSWORD_BCRYPT),
        'email'         => 'contato@godaiterapias.com.br',
        'role'          => 'admin',
        'created_at'    => date('c'),
    ];
    save_users([$newUser]);
    $msg = 'Usuário "Godai" criado com sucesso. Senha inicial: 123456 — altere após o primeiro login.';
    $msgType = 'success';
    $alreadyExists = true;
}
?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Setup Inicial — Painel Godai</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= e(base_url('admin/assets/admin.css')) ?>">
<meta name="robots" content="noindex,nofollow">
</head><body class="admin">
<div class="lg-shell">
  <div class="lg-card" style="max-width:520px;">
    <div class="logo-wrap"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai"></div>
    <h1>Setup Inicial</h1>
    <p class="sub">Criação do usuário administrador padrão</p>

    <?php if ($msg): ?>
      <div class="alert alert-<?= e($msgType) ?>" style="margin-top:14px;"><?= e($msg) ?></div>
    <?php endif; ?>

    <?php if ($alreadyExists): ?>
      <div class="alert alert-info" style="margin-top:14px;">
        <strong>Já existe um usuário cadastrado.</strong><br>
        Este script não criará novos usuários para evitar substituições acidentais.
      </div>
      <div style="background:#fbe9e7;border:1px solid #f0c2bc;padding:14px 16px;border-radius:8px;margin-top:18px;color:#9c2f22;font-size:13px;">
        <strong>⚠ AÇÃO RECOMENDADA</strong><br>
        Apague o arquivo <code>html-version/admin/bootstrap.php</code> do servidor via FTP para evitar acessos indevidos.
      </div>
      <p style="text-align:center;margin-top:20px;">
        <a href="<?= e(base_url('admin/login.php')) ?>" class="btn btn-primary">Ir para o login →</a>
      </p>
    <?php else: ?>
      <p style="margin:14px 0;font-size:14px;color:#444;line-height:1.6;">
        Será criado o usuário inicial:
      </p>
      <div style="background:var(--cream-2);border:1px solid var(--line);border-radius:8px;padding:14px 16px;margin-bottom:18px;font-family:monospace;font-size:14px;">
        <div>Usuário: <strong>Godai</strong></div>
        <div>Senha: <strong>123456</strong></div>
        <div>E-mail: <strong>contato@godaiterapias.com.br</strong></div>
      </div>
      <form method="post">
        <input type="hidden" name="confirm" value="yes">
        <button class="btn btn-primary" style="width:100%;">Criar usuário administrador</button>
      </form>
      <p class="sub" style="margin-top:18px;">A senha será armazenada com hash bcrypt. Após o login, troque a senha em Segurança.</p>
    <?php endif; ?>
  </div>
</div>
</body></html>
