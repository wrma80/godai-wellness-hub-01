<?php
// _auth.php — autenticação, sessão, usuários, recuperação de senha.
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

// -----------------------------------------------------------------------------
// USUÁRIOS
// admin.json schema novo:
//   { "users": [ { id, username, password_hash, email, role, created_at } ] }
// Compatível com schema antigo: { username, password_hash } -> migra na 1ª leitura.
// -----------------------------------------------------------------------------

function load_users(): array {
    $data = load_json('admin', []);
    if (isset($data['users']) && is_array($data['users'])) {
        return $data['users'];
    }
    if (!empty($data['username']) && !empty($data['password_hash'])) {
        // Migração automática do schema antigo
        $migrated = [[
            'id'            => 'u' . substr(bin2hex(random_bytes(6)), 0, 10),
            'username'      => $data['username'],
            'password_hash' => $data['password_hash'],
            'email'         => 'contato@godaiterapias.com.br',
            'role'          => 'admin',
            'created_at'    => date('c'),
        ]];
        save_json('admin', ['users' => $migrated]);
        return $migrated;
    }
    return [];
}

function save_users(array $users): bool {
    return save_json('admin', ['users' => array_values($users)]);
}

function find_user_by_username(string $username): ?array {
    foreach (load_users() as $u) {
        if (strcasecmp($u['username'] ?? '', $username) === 0) return $u;
    }
    return null;
}

function find_user_by_id(string $id): ?array {
    foreach (load_users() as $u) {
        if (($u['id'] ?? '') === $id) return $u;
    }
    return null;
}

function update_user(string $id, array $patch): bool {
    $users = load_users();
    foreach ($users as &$u) {
        if (($u['id'] ?? '') === $id) {
            $u = array_merge($u, $patch);
            return save_users($users);
        }
    }
    return false;
}

function current_user(): ?array {
    if (empty($_SESSION['godai_admin_uid'])) return null;
    return find_user_by_id($_SESSION['godai_admin_uid']);
}

function is_logged_in(): bool {
    return current_user() !== null;
}

function login_user(array $user): void {
    session_regenerate_id(true);
    $_SESSION['godai_admin_uid'] = $user['id'];
    $_SESSION['godai_admin']     = true; // compatibilidade
}

function logout_user(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: ' . base_url('admin/login.php'));
        exit;
    }
}

// -----------------------------------------------------------------------------
// CSRF + Flash
// -----------------------------------------------------------------------------
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}

function check_csrf(): void {
    $t = $_POST['_csrf'] ?? '';
    if (!is_string($t) || !hash_equals($_SESSION['csrf'] ?? '', $t)) {
        http_response_code(400);
        exit('CSRF inválido. Recarregue a página.');
    }
}

function flash(string $type, string $msg): void {
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}

function pop_flash(): ?array {
    if (empty($_SESSION['flash'])) return null;
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $f;
}

// -----------------------------------------------------------------------------
// Tokens de recuperação de senha
// -----------------------------------------------------------------------------
function create_reset_token(string $userId): string {
    $token = bin2hex(random_bytes(32));
    $list = load_json('password-resets', []);
    $list[] = [
        'token'      => hash('sha256', $token),
        'user_id'    => $userId,
        'expires_at' => time() + 3600, // 60min
        'used'       => false,
        'created_at' => date('c'),
    ];
    // Limpa expirados
    $list = array_values(array_filter($list, fn($r) => ($r['expires_at'] ?? 0) > time() && empty($r['used'])));
    save_json('password-resets', $list);
    return $token;
}

function consume_reset_token(string $token): ?array {
    $hash = hash('sha256', $token);
    $list = load_json('password-resets', []);
    foreach ($list as $r) {
        if (hash_equals($r['token'] ?? '', $hash) && empty($r['used']) && ($r['expires_at'] ?? 0) > time()) {
            return $r;
        }
    }
    return null;
}

function mark_reset_token_used(string $token): void {
    $hash = hash('sha256', $token);
    $list = load_json('password-resets', []);
    foreach ($list as &$r) {
        if (hash_equals($r['token'] ?? '', $hash)) $r['used'] = true;
    }
    save_json('password-resets', $list);
}
