<?php
require_once __DIR__ . '/../includes/config.php';

function admin_credentials(): array {
    return load_json('admin', ['username' => 'admin', 'password_hash' => '']);
}

function is_logged_in(): bool {
    return !empty($_SESSION['godai_admin']);
}

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: ' . base_url('admin/?view=login'));
        exit;
    }
}

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
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
