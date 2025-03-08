<?php
session_start();
require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Check CSRF token
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        echo json_encode(['status' => 'error', 'title' => 'Invalid CSRF Token', 'message' => 'Invalid CSRF token!']);
        exit;
    }

    header('Content-Type: application/json');

    // Get form data
    $subject = $_POST['subject'] ?? 'No Subject';
    $message = $_POST['message'] ?? 'No Message';

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender & Recipient
        $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_NAME']);
        $mail->addAddress($_ENV['MAIL_TO'], 'Recipient');
        $mail->addReplyTo($_ENV['MAIL_FROM'], $_ENV['MAIL_NAME']);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = nl2br(htmlspecialchars($message));
        $mail->AltBody = strip_tags($message);

        // Send Email
        $mail->send();
        echo json_encode(['status' => 'success', 'title' => 'Email Sent!', 'message' => 'Your email has been sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'title' => 'Failed to Send', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
}
?>