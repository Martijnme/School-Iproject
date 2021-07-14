<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/SMTP.php';
require '../../PHPMailer-master/src/PHPMailer.php';

    class SendMail {
        private $emailAdres;

        function __construct($emailAdres) {
            $this->$emailAdres = $emailAdres;
        }
       
    function sendMail ($emailAdres) {    
    $mail = new PHPMailer;
    $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host = 'mail.ip.aimsites.nl';
    $mail->SMTPAuth = false;
    $mail->Port = 21009;
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress("$emailAdres");
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->isHTML(true);
    $mail->Subject = 'Bevestigingscode - EenmaalAndermaal';
    $mail->Body = '12345';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if(!$mail->send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent';
}
header("location: ../pages/mailtest.php");
}
    }

?>