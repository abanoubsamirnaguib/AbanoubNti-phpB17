<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

abstract class Mail
{
    protected PHPMailer $mail;
    protected $mailTo;
    protected $subject;
    protected $body;
    public function __construct(string $mailTo, string $subject, string $body)
    {
        $this->mailTo = $mailTo;
        $this->subject = $subject;
        $this->body = $body;
        //Create an instance; passing `true` enables exceptions
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.io';
        $this->mail->SMTPAuth   = true;
 
        $this->mail->Password   = '';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        // $this->mail->Port       = 465;

        //mailtrap
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }
    public abstract function send(): bool;
}
