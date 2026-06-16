<?php
require_once __DIR__ . '/_auth.php';
require_once __DIR__ . '/../includes/mailer.php';

$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $username = trim((string)($_POST['username'] ?? ''));
    $user = find_user_by_username($username);

    if ($user && !empty($user['email'])) {
        $token = create_reset_token($user['id']);
        $link  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://')
               . ($_SERVER['HTTP_HOST'] ?? '') . base_url('admin/redefinir.php') . '?token=' . urlencode($token);

        $html = '<div style="font-family:Arial,sans-serif;max-width:560px;margin:0 auto;padding:24px;background:#f7f4ec;color:#2b2b2b;">'
              . '<div style="background:#fff;border:1px solid #ece8de;border-radius:12px;overflow:hidden;">'
              . '<div style="background:#6b7d63;color:#fff;padding:20px 28px;"><strong style="font-size:16px;">Redefinição de Senha — Painel Godai</strong></div>'
              . '<div style="padding:24px 28px;font-size:14px;line-height:1.6;">'
              . '<p>Olá,</p>'
              . '<p>Recebemos uma solicitação para redefinir a senha do usuário <strong>' . e($user['username']) . '</strong> no painel administrativo.</p>'
              . '<p style="text-align:center;margin:28px 0;"><a href="' . e($link) . '" style="background:#6b7d63;color:#fff;padding:12px 26px;border-radius:8px;text-decoration:none;font-weight:600;">Redefinir minha senha</a></p>'
              . '<p style="font-size:12px;color:#7b7b7b;">Este link é válido por <strong>60 minutos</strong> e pode ser usado apenas uma vez.<br>Caso não tenha sido você, ignore este e-mail — sua senha permanecerá inalterada.</p>'
              . '<hr style="border:none;border-top:1px solid #ece8de;margin:18px 0;">'
              . '<p style="font-size:11px;color:#999;">Se o botão não funcionar, copie este endereço no navegador:<br><span style="word-break:break-all;">' . e($link) . '</span></p>'
              . '</div></div></div>';

        send_mail($user['email'], 'Redefinição de Senha — Painel Godai', $html);
    }
    // Sempre exibir sucesso (não vazar se usuário existe ou não).
    $sent = true;
}

$csrf = csrf_token();
?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Recuperar senha — Painel Godai</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= e(base_url('admin/assets/admin.css')) ?>">
<meta name="robots" content="noindex,nofollow">
</head><body class="admin">
<div class="lg-shell">
  <div class="lg-card">
    <div class="logo-wrap"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai"></div>
    <h1>Recuperar senha</h1>
    <p class="sub">Enviaremos um link de redefinição ao e-mail cadastrado</p>

    <?php if ($sent): ?>
      <div class="alert alert-success">
        Se o usuário informado existir, um e-mail com instruções foi enviado.
        O link é válido por 60 minutos.
      </div>
      <div class="links"><a href="<?= e(base_url('admin/login.php')) ?>">← Voltar ao login</a></div>
    <?php else: ?>
      <form method="post">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
        <div class="field"><label>Usuário</label><input name="username" required autofocus></div>
        <button class="btn btn-primary" style="width:100%;margin-top:8px;">Enviar link de redefinição</button>
      </form>
      <div class="links"><a href="<?= e(base_url('admin/login.php')) ?>">← Voltar ao login</a></div>
    <?php endif; ?>
  </div>
</div>
</body></html>
