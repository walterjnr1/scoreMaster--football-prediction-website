<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
include( 'vendor/autoload.php');

function sendEmail($to, $subject, $body,$backupFile = null) {
    // Access global variables if needed
    global $app_email, $app_name;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ucnewspro@gmail.com';
        $mail->Password   = 'qbffuhedyrxdcciw';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom($app_email, $app_name);
        $mail->addAddress($to);

// Attachment
if ($backupFile && file_exists($backupFile)) {
    $mail->addAttachment($backupFile);
}

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>


