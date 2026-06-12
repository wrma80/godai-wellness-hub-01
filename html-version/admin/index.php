<?php
require_once __DIR__ . '/_auth.php';

$view   = $_GET['view'] ?? ($_GET['tab'] ?? 'services');
$action = $_POST['action'] ?? '';

// ---------- LOGIN ----------
if ($view === 'login' || $action === 'login') {
    if ($action === 'login') {
        check_csrf();
        $u = $_POST['username'] ?? '';
        $p = $_POST['password'] ?? '';
        $cred = admin_credentials();
        if ($u === ($cred['username'] ?? '') && password_verify($p, $cred['password_hash'] ?? '')) {
            $_SESSION['godai_admin'] = true;
            session_regenerate_id(true);
            header('Location: ' . base_url('admin/?tab=services'));
            exit;
        }
        flash('error', 'Usuário ou senha incorretos.');
    }
    $flash = pop_flash();
    $csrf = csrf_token();
    ?>
    <!doctype html><html lang="pt-BR"><head>
      <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Painel Godai — Login</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
      <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css')) ?>">
    </head><body>
      <div class="login-shell">
        <form method="post" class="login-card">
          <div style="text-align:center;">
            <span class="logo-frame"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai" style="height:56px;"></span>
          </div>
          <h1 style="margin-top: 20px;">Painel Godai</h1>
          <p class="sub">Acesso restrito ao administrador.</p>
          <?php if ($flash): ?>
            <div class="alert alert-<?= e($flash['type']) ?>" style="margin-top: 20px;"><?= e($flash['msg']) ?></div>
          <?php endif; ?>
          <input type="hidden" name="action" value="login">
          <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
          <div class="field" style="margin-top: 20px;"><label>Usuário</label><input name="username" required autocomplete="username"></div>
          <div class="field" style="margin-top: 14px;"><label>Senha</label><input name="password" type="password" required autocomplete="current-password"></div>
          <button class="btn btn-primary btn-pill" style="margin-top: 22px; width: 100%; justify-content: center;">Entrar</button>
          <p class="sub" style="margin-top: 18px; font-size: .76rem;">
            Acesso padrão: <strong>admin</strong> / <strong>admin123</strong> — altere após o primeiro login.
          </p>
        </form>
      </div>
    </body></html>
    <?php
    exit;
}

// Logout
if (($_GET['logout'] ?? '') === '1') {
    $_SESSION = [];
    session_destroy();
    header('Location: ' . base_url('admin/?view=login'));
    exit;
}

require_login();

// ---------- AÇÕES ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();

    if ($action === 'save_settings') {
        $current = get_settings();
        foreach (['whatsappNumber','whatsappMessage','email','contactEmail','instagram','city'] as $k) {
            $current[$k] = trim((string)($_POST[$k] ?? ''));
        }
        save_json('settings', $current);
        flash('success', 'Contatos atualizados.');
        header('Location: ' . base_url('admin/?tab=settings')); exit;
    }

    if ($action === 'save_services') {
        $rows = [];
        foreach (($_POST['svc'] ?? []) as $i => $row) {
            $title = trim($row['title'] ?? '');
            if ($title === '') continue;
            $rows[] = [
                'id'            => $row['id'] ?: 's' . uniqid(),
                'title'         => $title,
                'duration'      => trim($row['duration'] ?? ''),
                'capacity'      => trim($row['capacity'] ?? ''),
                'description'   => trim($row['description'] ?? ''),
                'display_order' => (int)($row['display_order'] ?? ($i + 1)),
            ];
        }
        save_json('services', $rows);
        flash('success', 'Serviços atualizados.');
        header('Location: ' . base_url('admin/?tab=services')); exit;
    }

    if ($action === 'add_service') {
        $rows = get_services();
        $rows[] = [
            'id' => 's' . uniqid(),
            'title' => 'Novo serviço',
            'duration' => '',
            'capacity' => '',
            'description' => '',
            'display_order' => count($rows) + 1,
        ];
        save_json('services', $rows);
        header('Location: ' . base_url('admin/?tab=services')); exit;
    }

    if ($action === 'delete_service') {
        $id = $_POST['id'] ?? '';
        $rows = array_values(array_filter(get_services(), fn($r) => $r['id'] !== $id));
        save_json('services', $rows);
        flash('success', 'Serviço removido.');
        header('Location: ' . base_url('admin/?tab=services')); exit;
    }

    if ($action === 'save_pricing') {
        $rows = [];
        foreach (($_POST['pri'] ?? []) as $i => $row) {
            $rows[] = [
                'id'            => $row['id'] ?: 'p' . uniqid(),
                'time_label'    => trim($row['time_label'] ?? ''),
                'solo_price'    => trim($row['solo_price'] ?? ''),
                'solo_capacity' => trim($row['solo_capacity'] ?? ''),
                'duo_price'     => trim($row['duo_price'] ?? ''),
                'duo_capacity'  => trim($row['duo_capacity'] ?? ''),
                'display_order' => (int)($row['display_order'] ?? ($i + 1)),
            ];
        }
        save_json('pricing', $rows);
        flash('success', 'Preços atualizados.');
        header('Location: ' . base_url('admin/?tab=pricing')); exit;
    }

    if ($action === 'change_password') {
        $curr = $_POST['current'] ?? '';
        $new  = $_POST['new'] ?? '';
        $cred = admin_credentials();
        if (!password_verify($curr, $cred['password_hash'] ?? '')) {
            flash('error', 'Senha atual incorreta.');
        } elseif (strlen($new) < 6) {
            flash('error', 'A nova senha deve ter ao menos 6 caracteres.');
        } else {
            $cred['password_hash'] = password_hash($new, PASSWORD_BCRYPT);
            save_json('admin', $cred);
            flash('success', 'Senha atualizada.');
        }
        header('Location: ' . base_url('admin/?tab=account')); exit;
    }
}

// ---------- RENDER ----------
$tab = $_GET['tab'] ?? 'services';
$flash = pop_flash();
$csrf = csrf_token();
$services = get_services();
$pricing = get_pricing();
$settings = get_settings();
?>
<!doctype html><html lang="pt-BR"><head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel Godai</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css')) ?>">
</head><body>
<div class="admin-shell">
  <div class="admin-topbar">
    <div class="brand">
      <span class="logo-frame"><img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai" style="height:34px;"></span>
      Painel Godai
    </div>
    <div style="display:flex; gap:10px; align-items:center;">
      <a href="<?= e(base_url('index.php')) ?>" target="_blank" class="btn btn-outline btn-pill" style="padding:8px 16px;">Ver site</a>
      <a href="<?= e(base_url('admin/?logout=1')) ?>" class="btn btn-primary btn-pill" style="padding:8px 16px;">Sair</a>
    </div>
  </div>

  <div class="admin-tabs">
    <a href="?tab=services" class="<?= $tab==='services'?'is-active':'' ?>">Serviços</a>
    <a href="?tab=pricing"  class="<?= $tab==='pricing'?'is-active':'' ?>">Preços</a>
    <a href="?tab=settings" class="<?= $tab==='settings'?'is-active':'' ?>">Contatos</a>
    <a href="?tab=account"  class="<?= $tab==='account'?'is-active':'' ?>">Conta</a>
  </div>

  <div class="admin-content">
    <?php if ($flash): ?>
      <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['msg']) ?></div>
    <?php endif; ?>

    <?php if ($tab === 'services'): ?>
      <div class="admin-section">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap; gap:10px;">
          <h2>Serviços</h2>
          <form method="post"><input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="add_service">
            <button class="btn btn-outline btn-pill" style="padding:10px 18px;">+ Adicionar serviço</button>
          </form>
        </div>
        <form method="post">
          <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_services">
          <div class="admin-grid">
            <?php foreach ($services as $i => $svc): ?>
              <div class="admin-card">
                <input type="hidden" name="svc[<?= $i ?>][id]" value="<?= e($svc['id']) ?>">
                <div class="field"><label>Título</label><input name="svc[<?= $i ?>][title]" value="<?= e($svc['title']) ?>" required></div>
                <div class="field-row">
                  <div class="field"><label>Duração</label><input name="svc[<?= $i ?>][duration]" value="<?= e($svc['duration']) ?>"></div>
                  <div class="field"><label>Capacidade</label><input name="svc[<?= $i ?>][capacity]" value="<?= e($svc['capacity']) ?>"></div>
                </div>
                <div class="field" style="margin-top:14px;"><label>Descrição</label>
                  <textarea name="svc[<?= $i ?>][description]" rows="2"><?= e($svc['description']) ?></textarea>
                </div>
                <div class="field-row">
                  <div class="field"><label>Ordem</label><input type="number" name="svc[<?= $i ?>][display_order]" value="<?= (int)$svc['display_order'] ?>" style="width:100px;"></div>
                  <div style="display:flex; align-items:end; justify-content:flex-end;">
                    <button type="submit" form="del-<?= e($svc['id']) ?>" class="btn btn-outline btn-pill" style="padding:8px 16px; color: var(--selo); border-color: rgba(231,54,53,.3);">Excluir</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="btn btn-primary btn-pill" style="margin-top:20px;">Salvar serviços</button>
        </form>
        <?php foreach ($services as $svc): ?>
          <form id="del-<?= e($svc['id']) ?>" method="post" onsubmit="return confirm('Excluir este serviço?');" style="display:none;">
            <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
            <input type="hidden" name="action" value="delete_service">
            <input type="hidden" name="id" value="<?= e($svc['id']) ?>">
          </form>
        <?php endforeach; ?>
      </div>

    <?php elseif ($tab === 'pricing'): ?>
      <h2>Tabela de preços</h2>
      <p style="color: var(--muted); font-size:.9rem; margin-top: 8px;">Edite os valores que aparecem na tabela do site.</p>
      <form method="post" style="margin-top: 20px;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_pricing">
        <div class="admin-grid">
          <?php foreach ($pricing as $i => $p): ?>
            <div class="admin-card">
              <input type="hidden" name="pri[<?= $i ?>][id]" value="<?= e($p['id']) ?>">
              <div class="field"><label>Tempo (ex: 4h)</label><input name="pri[<?= $i ?>][time_label]" value="<?= e($p['time_label']) ?>" required></div>
              <div class="field-row">
                <div class="field"><label>Preço — 1 terapeuta</label><input name="pri[<?= $i ?>][solo_price]" value="<?= e($p['solo_price']) ?>"></div>
                <div class="field"><label>Capacidade — 1 terapeuta</label><input name="pri[<?= $i ?>][solo_capacity]" value="<?= e($p['solo_capacity']) ?>"></div>
              </div>
              <div class="field-row">
                <div class="field"><label>Preço — 2 terapeutas</label><input name="pri[<?= $i ?>][duo_price]" value="<?= e($p['duo_price']) ?>"></div>
                <div class="field"><label>Capacidade — 2 terapeutas</label><input name="pri[<?= $i ?>][duo_capacity]" value="<?= e($p['duo_capacity']) ?>"></div>
              </div>
              <div class="field" style="margin-top:14px; max-width: 140px;"><label>Ordem</label><input type="number" name="pri[<?= $i ?>][display_order]" value="<?= (int)$p['display_order'] ?>"></div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="btn btn-primary btn-pill" style="margin-top:20px;">Salvar preços</button>
      </form>

    <?php elseif ($tab === 'settings'): ?>
      <h2>Contatos & informações</h2>
      <form method="post" style="margin-top: 20px; max-width: 720px;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="save_settings">
        <div class="field"><label>WhatsApp (com DDI, só números)</label><input name="whatsappNumber" value="<?= e($settings['whatsappNumber']) ?>" placeholder="5519999999999"></div>
        <div class="field" style="margin-top:14px;"><label>Mensagem padrão WhatsApp</label><textarea name="whatsappMessage" rows="2"><?= e($settings['whatsappMessage']) ?></textarea></div>
        <div class="field-row">
          <div class="field"><label>E-mail (exibido no site)</label><input type="email" name="email" value="<?= e($settings['email']) ?>"></div>
          <div class="field"><label>Cidade / Região</label><input name="city" value="<?= e($settings['city']) ?>"></div>
        </div>
        <div class="field" style="margin-top:14px;">
          <label>E-mail que receberá os formulários</label>
          <input type="email" name="contactEmail" value="<?= e($settings['contactEmail'] ?? $settings['email']) ?>" placeholder="contato@godaiterapias.com.br">
          <small style="display:block;margin-top:6px;color:var(--muted);font-size:.8rem;">Destinatário dos pedidos de orçamento enviados pelo formulário de contato.</small>
        </div>
        <div class="field" style="margin-top:14px;"><label>Instagram (URL completa)</label><input type="url" name="instagram" value="<?= e($settings['instagram']) ?>"></div>
        <button class="btn btn-primary btn-pill" style="margin-top:20px;">Salvar contatos</button>
      </form>

    <?php elseif ($tab === 'account'): ?>
      <h2>Alterar senha</h2>
      <form method="post" style="margin-top:20px; max-width:420px;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>"><input type="hidden" name="action" value="change_password">
        <div class="field"><label>Senha atual</label><input type="password" name="current" required></div>
        <div class="field" style="margin-top:14px;"><label>Nova senha</label><input type="password" name="new" required minlength="6"></div>
        <button class="btn btn-primary btn-pill" style="margin-top:18px;">Atualizar senha</button>
      </form>
    <?php endif; ?>
  </div>
</div>
</body></html>
