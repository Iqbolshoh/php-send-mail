<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !isset($_POST['csrf_token']) ||
        !isset($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        echo json_encode(['status' => 'error', 'title' => 'Invalid CSRF Token', 'message' => 'Invalid CSRF token!']);
        exit;
    }
    header('Content-Type: application/json');

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'mail.iqbolshoh.uz';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@iqbolshoh.uz';
        $mail->Password = 'IIlhomjonov$777'; // ❌ DO NOT HARD-CODE PASSWORDS (Move to env file)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender & Recipient
        $mail->setFrom('info@iqbolshoh.uz', 'Iqbolshoh');
        $mail->addAddress('iilhomjonov@gmail.com', 'Recipient');

        // Reply-To
        $mail->addReplyTo('info@iqbolshoh.uz', 'Iqbolshoh');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Subject';
        $mail->Body = 'This is the email <b>HTML</b> content.';
        $mail->AltBody = 'This is the plain text email content.';

        // Send Email
        $mail->send();
        echo json_encode(['status' => 'success', 'title' => 'Email Sent!', 'message' => 'Your email has been sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'title' => 'Failed to Send', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
    }
}
?>