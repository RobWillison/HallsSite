<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/20/16
 * Time: 1:17 PM
 */

namespace HallsApplication\Service;

use PHPMailer;

class EmailService
{
    public function sendEmail($email,array $config)
    {
        if (! $this->validateEmail($email)) {
            return false;
        }

        $mail = new PHPMailer();

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $config['host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $config['username'];                 // SMTP username
        $mail->Password = $config['password'];                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($email->email(), 'Mailer');
        $mail->addAddress('indiapearce@hotmail.co.uk', 'India');     // Add a recipient

        $mail->Subject = 'From ' . $email->email();
        $mail->Body    = $email->message();

        if(!$mail->send()) {
            return $mail->ErrorInfo;
        }

        return true;
    }

    private function validateEmail($email)
    {
        return true;
    }

}