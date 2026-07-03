<?php
require_once __DIR__ . '/_auth.php';
if (is_logged_in()) {
    $u = current_user();
    admin_log('auth.logout', 'usuário: ' . ($u['username'] ?? ''));
}
logout_user();
header('Location: ' . base_url('admin/login.php'));
exit;
