<?php
session_start();
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define constants
define('SMTP_HOST', 'mail.YOUR_DOMAIN.com');
define('SMTP_USER', 'YOUR_EMAIL');
define('SMTP_PASS', 'YOUR_PASSWORD');
define('SMTP_PORT', 465);
define('MAIL_FROM', 'YOUR_EMAIL');
define('MAIL_NAME', 'YOUR_NAME');
define('MAIL_TO', 'RECIPIENT_EMAIL');

// JSON header
header('Content-Type: application/json');

// Check CSRF token
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['status' => 'error', 'title' => 'Invalid Request', 'message' => 'Only POST requests are allowed!']);
    exit;
}

if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    echo json_encode(['status' => 'error', 'title' => 'Invalid CSRF Token', 'message' => 'CSRF verification failed!']);
    exit;
}

// Get and sanitize form data
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING) ?: 'No Subject';
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING) ?: 'No Message';

$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = SMTP_PORT;

    // Sender & Recipient
    $mail->setFrom(MAIL_FROM, MAIL_NAME);
    $mail->addAddress(MAIL_TO, 'Recipient');
    $mail->addReplyTo(MAIL_FROM, MAIL_NAME);

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $mail->Body = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
    $mail->AltBody = strip_tags($message);

    // Send Email
    $mail->send();
    echo json_encode(['status' => 'success', 'title' => 'Email Sent!', 'message' => 'Your email has been sent successfully!']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'title' => 'Failed to Send', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
}
?>