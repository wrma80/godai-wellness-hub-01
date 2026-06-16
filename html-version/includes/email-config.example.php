<?php
// ============================================================================
// MODELO DE CONFIGURAÇÃO SMTP — Locaweb (Hospedagem Compartilhada)
// ============================================================================
//
// COMO USAR:
//   1. Faça upload deste arquivo via FTP para html-version/includes/
//   2. No servidor, copie-o para "email-config.php" (mesmo diretório).
//   3. Preencha as credenciais SMTP fornecidas pela Locaweb.
//   4. NUNCA versionar o "email-config.php" real no Git.
//
// O arquivo "email-config.php" está listado no .gitignore — apenas este
// modelo (.example.php) é versionado.
//
// Configurações típicas da Locaweb:
//   SMTP_HOST   = 'email-ssl.com.br'  (ou 'smtp.seudominio.com.br')
//   SMTP_PORT   = 587                 (STARTTLS)  ou 465 (SSL)
//   SMTP_SECURE = 'tls'               (para porta 587) ou 'ssl' (porta 465)
//   SMTP_USERNAME = 'contato@seudominio.com.br'  (e-mail completo)
//   SMTP_PASSWORD = 'sua-senha-de-email'
// ============================================================================

declare(strict_types=1);

define('SMTP_HOST',     '');
define('SMTP_PORT',     587);
define('SMTP_SECURE',   'tls');           // 'tls' (587) ou 'ssl' (465)
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');

define('SMTP_FROM',      'contato@godaiterapias.com.br');
define('SMTP_FROM_NAME', 'Godai Terapias Integrativas');
