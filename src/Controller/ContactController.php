<?php
namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;

class ContactController
{
    public function send(array $data)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USER'];
        $mail->Password   = $_ENV['MAIL_PASS'];
        $mail->Port       = $_ENV['MAIL_PORT'];
        $mail->setFrom($data['email'], $data['name']);
        $mail->addAddress($_ENV['MAIL_TO']);
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['message'];
        $mail->send();
        header('Location: /contact?sent=1');
    }
}
