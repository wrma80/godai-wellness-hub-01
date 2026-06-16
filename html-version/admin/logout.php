<?php
require_once __DIR__ . '/_auth.php';
logout_user();
header('Location: ' . base_url('admin/login.php'));
exit;
