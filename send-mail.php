<?php
session_start();
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ===============================
// SMTP Server Configuration
// ===============================
define('SMTP_HOST', 'mail.iqbolshoh.uz'); // The mail server address (e.g., mail.example.com)
define('SMTP_USER', 'info@iqbolshoh.uz'); // SMTP username (your email address)
define('SMTP_PASS', 'YOUR_SECURE_PASSWORD'); // SMTP password (use a secure method to store this)
define('SMTP_PORT', 465); // SMTP port: 465 for SSL, 587 for TLS

// ===============================
// Email Sender Details
// ===============================
define('MAIL_FROM', 'info@iqbolshoh.uz'); // The email address that will appear as the sender
define('MAIL_NAME', 'Iqbolshoh Ilhomjonov'); // The sender's name (your name or company name)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');

    // CSRF Token validation
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        echo json_encode(['status' => 'error', 'title' => 'Invalid CSRF Token', 'message' => 'Invalid CSRF token!']);
        exit;
    }

    // Validate inputs
    if (empty($_POST['subject']) || empty($_POST['message']) || empty($_POST['mail_to'])) {
        echo json_encode(['status' => 'error', 'title' => 'Missing Data', 'message' => 'All fields are required!']);
        exit;
    }

    // Validating the recipient email address format to ensure it's a valid email.
    $mail_to = trim($_POST['mail_to']);
    if (!filter_var($mail_to, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'title' => 'Email', 'message' => 'Invalid email format!']);
        exit;
    }

    $subject = htmlspecialchars(trim($_POST['subject']), ENT_QUOTES, 'UTF-8');
    $message = nl2br(htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8'));

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
        $mail->addAddress($mail_to);
        $mail->addReplyTo(MAIL_FROM, MAIL_NAME);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = strip_tags($message);

        // Send Email
        $mail->send();
        echo json_encode(['status' => 'success', 'title' => 'Email Sent!', 'message' => 'Your email has been sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'title' => 'Failed to Send', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
}