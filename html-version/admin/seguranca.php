<?php
require_once __DIR__ . '/_auth.php';
require_login();

$user = current_user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    if ($action === 'change_password') {
        $curr = (string)($_POST['current'] ?? '');
        $new  = (string)($_POST['new'] ?? '');
        $rep  = (string)($_POST['confirm'] ?? '');
        if (!password_verify($curr, $user['password_hash'] ?? ''))
            flash('error', 'Senha atual incorreta.');
        elseif (strlen($new) < 6)
            flash('error', 'A nova senha deve ter ao menos 6 caracteres.');
        elseif ($new !== $rep)
            flash('error', 'Confirmação não confere.');
        else {
            update_user($user['id'], ['password_hash' => password_hash($new, PASSWORD_BCRYPT)]);
            admin_log('security.password_change', ''); flash('success', 'Senha atualizada com sucesso.');
        }
    } elseif ($action === 'change_email') {
        $email = trim((string)($_POST['email'] ?? ''));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            flash('error', 'E-mail inválido.');
        else {
            update_user($user['id'], ['email' => $email]);
            flash('success', 'E-mail atualizado. Os links de recuperação irão para este endereço.');
        }
    }
    header('Location: ' . base_url('admin/seguranca.php'));
    exit;
}

$csrf = csrf_token();
$page_title = 'Segurança';
$active = 'seguranca';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="grid grid-2">
  <div class="card">
    <h2>Alterar senha</h2>
    <p class="sub">A senha atual é obrigatória para confirmar a alteração.</p>
    <form method="post">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
      <input type="hidden" name="action" value="change_password">
      <div class="field"><label>Senha atual</label><input name="current" type="password" required></div>
      <div class="field"><label>Nova senha</label><input name="new" type="password" minlength="6" required></div>
      <div class="field"><label>Confirmar nova senha</label><input name="confirm" type="password" minlength="6" required></div>
      <button class="btn btn-primary">Atualizar senha</button>
    </form>
  </div>

  <div class="card">
    <h2>E-mail de recuperação</h2>
    <p class="sub">Endereço usado para enviar o link de redefinição de senha.</p>
    <form method="post">
      <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
      <input type="hidden" name="action" value="change_email">
      <div class="field"><label>Usuário</label><input value="<?= e($user['username'] ?? '') ?>" disabled></div>
      <div class="field"><label>E-mail</label><input name="email" type="email" required value="<?= e($user['email'] ?? '') ?>"></div>
      <button class="btn btn-primary">Salvar e-mail</button>
    </form>
  </div>
</div>

<div class="card">
  <h2>Sessão atual</h2>
  <p class="sub">Você está conectado como <strong><?= e($user['username']) ?></strong>.</p>
  <a href="<?= e(base_url('admin/logout.php')) ?>" class="btn btn-out">Encerrar sessão</a>
</div>
<?php layout_end(); ?>
