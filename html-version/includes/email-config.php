<?php
// Credenciais SMTP da Locaweb. Preencha após publicação do site.
// Nunca commitar senhas reais neste arquivo no repositório público.

declare(strict_types=1);

// Servidor SMTP (ex: 'email-ssl.com.br' ou 'smtp.seudominio.com.br')
define('SMTP_HOST', '');

// Porta SMTP (587 para STARTTLS, 465 para SSL)
define('SMTP_PORT', 587);

// Tipo de criptografia: 'tls' (porta 587) ou 'ssl' (porta 465)
define('SMTP_SECURE', 'tls');

// Usuário (geralmente o e-mail completo)
define('SMTP_USERNAME', '');

// Senha
define('SMTP_PASSWORD', '');

// Remetente exibido
define('SMTP_FROM', 'contato@godaiterapias.com.br');
define('SMTP_FROM_NAME', 'Godai Terapias Integrativas');
