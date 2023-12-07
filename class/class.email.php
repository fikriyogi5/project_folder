<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoload.php

class EmailSender {
    private $to;
    private $subject;
    private $templatePath;
    private $templateData;

    public function __construct($to, $subject, $templatePath, $templateData = []) {
        $this->to = $to;
        $this->subject = $subject;
        $this->templatePath = $templatePath;
        $this->templateData = $templateData;
    }

    public function send() {
        $mail = new PHPMailer(true);

        try {
            $mail->setFrom('your_email@example.com', 'Your Name'); // Set sender email and name
            $mail->addAddress($this->to); // Add recipient
            $mail->Subject = $this->subject;
            $mail->isHTML(true);

            // Load the HTML template
            $htmlContent = file_get_contents($this->templatePath);

            // Replace placeholders in the template with actual data
            foreach ($this->templateData as $placeholder => $value) {
                $htmlContent = str_replace("{{$placeholder}}", $value, $htmlContent);
            }

            $mail->Body = $htmlContent;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}