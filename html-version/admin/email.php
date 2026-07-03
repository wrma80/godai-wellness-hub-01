<?php
require_once __DIR__ . '/_auth.php';
require_login();
require_once __DIR__ . '/../includes/mailer.php';

$CONFIG_PATH = GODAI_ROOT . '/includes/email-config.php';
$cur = [
    'SMTP_HOST'      => defined('SMTP_HOST') ? SMTP_HOST : '',
    'SMTP_PORT'      => defined('SMTP_PORT') ? (int)SMTP_PORT : 587,
    'SMTP_SECURE'    => defined('SMTP_SECURE') ? SMTP_SECURE : 'tls',
    'SMTP_USERNAME'  => defined('SMTP_USERNAME') ? SMTP_USERNAME : '',
    'SMTP_PASSWORD'  => defined('SMTP_PASSWORD') ? SMTP_PASSWORD : '',
    'SMTP_FROM'      => defined('SMTP_FROM') ? SMTP_FROM : '',
    'SMTP_FROM_NAME' => defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $newPass = (string)($_POST['SMTP_PASSWORD'] ?? '');
        $vals = [
            'SMTP_HOST'      => trim((string)($_POST['SMTP_HOST'] ?? '')),
            'SMTP_PORT'      => (int)($_POST['SMTP_PORT'] ?? 587),
            'SMTP_SECURE'    => in_array($_POST['SMTP_SECURE'] ?? 'tls', ['tls','ssl'], true) ? $_POST['SMTP_SECURE'] : 'tls',
            'SMTP_USERNAME'  => trim((string)($_POST['SMTP_USERNAME'] ?? '')),
            // Mantém senha existente se o campo veio vazio
            'SMTP_PASSWORD'  => $newPass !== '' ? $newPass : $cur['SMTP_PASSWORD'],
            'SMTP_FROM'      => trim((string)($_POST['SMTP_FROM'] ?? '')),
            'SMTP_FROM_NAME' => trim((string)($_POST['SMTP_FROM_NAME'] ?? '')),
        ];

        $php = "<?php\n// Gerado pelo painel admin em " . date('c') . "\n// NÃO versionar este arquivo. Está no .gitignore.\ndeclare(strict_types=1);\n\n";
        $php .= "define('SMTP_HOST',     " . var_export($vals['SMTP_HOST'], true) . ");\n";
        $php .= "define('SMTP_PORT',     " . $vals['SMTP_PORT'] . ");\n";
        $php .= "define('SMTP_SECURE',   " . var_export($vals['SMTP_SECURE'], true) . ");\n";
        $php .= "define('SMTP_USERNAME', " . var_export($vals['SMTP_USERNAME'], true) . ");\n";
        $php .= "define('SMTP_PASSWORD', " . var_export($vals['SMTP_PASSWORD'], true) . ");\n";
        $php .= "define('SMTP_FROM',      " . var_export($vals['SMTP_FROM'], true) . ");\n";
        $php .= "define('SMTP_FROM_NAME', " . var_export($vals['SMTP_FROM_NAME'], true) . ");\n";

        if (@file_put_contents($CONFIG_PATH, $php, LOCK_EX) === false) {
            flash('error', 'Não foi possível escrever em includes/email-config.php. Verifique as permissões de escrita (chmod 664).');
        } else {
            @chmod($CONFIG_PATH, 0640);
            admin_log('email.save', ''); flash('success', 'Configurações SMTP salvas.');
        }
        header('Location: ' . base_url('admin/email.php'));
        exit;
    }

    if ($action === 'test') {
        $to = trim((string)($_POST['test_to'] ?? ''));
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            flash('error', 'Informe um e-mail válido para o teste.');
        } else {
            $r = send_mail($to, 'Teste SMTP — Painel Godai',
                '<p>Este é um e-mail de <strong>teste</strong> enviado pelo painel administrativo.</p><p>Se você recebeu esta mensagem, o SMTP está configurado corretamente.</p>');
            if ($r['ok']) flash('success', 'E-mail de teste enviado para ' . $to . '. Verifique a caixa de entrada.');
            else flash('error', 'Falha: ' . $r['error']);
        }
        header('Location: ' . base_url('admin/email.php'));
        exit;
    }
}

$csrf = csrf_token();
$page_title = 'E-mail / SMTP';
$active = 'email';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <h2>Credenciais SMTP — Locaweb</h2>
  <p class="sub">As credenciais são gravadas em <code>html-version/includes/email-config.php</code> (não versionado no Git).</p>

  <?php if (!is_writable(dirname($CONFIG_PATH)) || (is_file($CONFIG_PATH) && !is_writable($CONFIG_PATH))): ?>
    <div class="alert alert-error">
      ⚠ O arquivo <code>includes/email-config.php</code> não tem permissão de escrita. Via FTP, defina <strong>chmod 664</strong> no arquivo (ou 775 na pasta).
    </div>
  <?php endif; ?>

  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
    <input type="hidden" name="action" value="save">

    <div class="row">
      <div class="field"><label>Host SMTP</label><input name="SMTP_HOST" value="<?= e($cur['SMTP_HOST']) ?>" placeholder="email-ssl.com.br ou smtp.seudominio.com.br"></div>
      <div class="field"><label>Porta</label><input type="number" name="SMTP_PORT" value="<?= (int)$cur['SMTP_PORT'] ?>"></div>
    </div>
    <div class="row">
      <div class="field"><label>Segurança</label>
        <select name="SMTP_SECURE">
          <option value="tls" <?= $cur['SMTP_SECURE']==='tls'?'selected':'' ?>>TLS / STARTTLS (porta 587)</option>
          <option value="ssl" <?= $cur['SMTP_SECURE']==='ssl'?'selected':'' ?>>SSL (porta 465)</option>
        </select>
      </div>
      <div class="field"><label>Usuário (e-mail completo)</label><input name="SMTP_USERNAME" value="<?= e($cur['SMTP_USERNAME']) ?>"></div>
    </div>
    <div class="field"><label>Senha</label>
      <input name="SMTP_PASSWORD" type="password" placeholder="<?= $cur['SMTP_PASSWORD'] !== '' ? '••••••••  (deixe em branco para manter a atual)' : 'Digite a senha do e-mail' ?>">
      <small>Por segurança a senha nunca é exibida. Para alterar, digite uma nova; para manter, deixe vazio.</small>
    </div>
    <div class="row">
      <div class="field"><label>Remetente (e-mail)</label><input name="SMTP_FROM" type="email" value="<?= e($cur['SMTP_FROM']) ?>"></div>
      <div class="field"><label>Remetente (nome exibido)</label><input name="SMTP_FROM_NAME" value="<?= e($cur['SMTP_FROM_NAME']) ?>"></div>
    </div>

    <button class="btn btn-primary">Salvar configurações</button>
  </form>
</div>

<div class="card">
  <h2>Enviar e-mail de teste</h2>
  <p class="sub">Use após salvar as credenciais para confirmar a conexão SMTP.</p>
  <form method="post" style="display:flex;gap:10px;align-items:end;flex-wrap:wrap;">
    <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
    <input type="hidden" name="action" value="test">
    <div class="field" style="flex:1;min-width:240px;margin:0;"><label>Enviar teste para</label>
      <input name="test_to" type="email" required value="<?= e(current_user()['email'] ?? '') ?>">
    </div>
    <button class="btn btn-out">Enviar teste</button>
  </form>
</div>
<?php layout_end(); ?>
