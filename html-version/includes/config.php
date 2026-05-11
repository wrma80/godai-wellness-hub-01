<?php
// Configuração geral do site Godai (versão PHP).
// Para alterar conteúdo, use o painel em /admin/

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('GODAI_ROOT', dirname(__DIR__));
define('GODAI_DATA', GODAI_ROOT . '/data');

// URL base relativa (funciona em subpastas da hospedagem).
function base_url(string $path = ''): string {
    static $base = null;
    if ($base === null) {
        $script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
        // Se estamos em /admin/, subir um nível.
        if (preg_match('#/admin$#', $script)) {
            $script = preg_replace('#/admin$#', '', $script);
        }
        $base = rtrim($script, '/');
    }
    return $base . '/' . ltrim($path, '/');
}

function e(?string $v): string {
    return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function current_page(): string {
    $name = basename($_SERVER['SCRIPT_NAME'] ?? '');
    return preg_replace('/\.php$/', '', $name) ?: 'index';
}

require_once __DIR__ . '/data.php';
