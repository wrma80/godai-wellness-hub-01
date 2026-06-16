<?php
// includes/mailer.php — wrapper PHPMailer reutilizável (contato + reset senha).
declare(strict_types=1);

if (is_file(__DIR__ . '/email-config.php')) {
    require_once __DIR__ . '/email-config.php';
} else {
    require_once __DIR__ . '/email-config.example.php';
}
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

function smtp_configured(): bool {
    return defined('SMTP_HOST') && SMTP_HOST !== ''
        && defined('SMTP_USERNAME') && SMTP_USERNAME !== ''
        && defined('SMTP_PASSWORD') && SMTP_PASSWORD !== '';
}

/**
 * Envia um e-mail via SMTP autenticado (Locaweb).
 * @return array{ok:bool, error?:string}
 */
function send_mail(string $to, string $subject, string $html, ?string $altText = null, ?string $replyTo = null, ?string $replyToName = null): array {
    if (!smtp_configured()) {
        @file_put_contents(GODAI_DATA . '/contact-pending.log',
            '[' . date('c') . "] SMTP não configurado. Para: $to | Assunto: $subject\n",
            FILE_APPEND);
        return ['ok' => false, 'error' => 'SMTP não configurado.'];
    }
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = (defined('SMTP_SECURE') && SMTP_SECURE === 'ssl')
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port    = defined('SMTP_PORT') ? (int)SMTP_PORT : 587;
        $mail->CharSet = 'UTF-8';
        $mail->Timeout = 15;

        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        $mail->addAddress($to);
        if ($replyTo) $mail->addReplyTo($replyTo, $replyToName ?: '');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = $altText ?: trim(strip_tags($html));

        $mail->send();
        return ['ok' => true];
    } catch (MailException $e) {
        @file_put_contents(GODAI_DATA . '/contact-errors.log',
            '[' . date('c') . '] ' . $mail->ErrorInfo . "\n",
            FILE_APPEND);
        return ['ok' => false, 'error' => $mail->ErrorInfo];
    }
}
