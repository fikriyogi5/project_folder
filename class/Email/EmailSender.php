<?php
// classes/EmailSender.php
namespace Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailSender {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
    }

    public function sendEmail($to, $subject, $body) {
        try {
            // Server settings
            $this->mailer->SMTPDebug = SMTP::DEBUG_OFF; // Ganti dengan SMTP::DEBUG_SERVER untuk mode debug
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.example.com'; // Ganti dengan server SMTP Anda
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'your_username'; // Ganti dengan username SMTP Anda
            $this->mailer->Password = 'your_password'; // Ganti dengan password SMTP Anda
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Ganti dengan ENCRYPTION_SMTPS jika perlu
            $this->mailer->Port = 587; // Ganti dengan port SMTP Anda

            // Recipients
            $this->mailer->setFrom('from@example.com', 'Your Name');
            $this->mailer->addAddress($to);

            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

// index.php
// require 'classes/EmailSender.php';

// $emailSender = new \Email\EmailSender();

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $to = 'recipient@example.com';
//     $subject = 'Subject of the Email';
//     $body = 'This is the email body content.';

//     if ($emailSender->sendEmail($to, $subject, $body)) {
//         echo 'Email sent successfully.';
//     } else {
//         echo 'Email could not be sent.';
//     }
// }