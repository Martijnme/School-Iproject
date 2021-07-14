<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/SMTP.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require_once('../data/Database.php');

$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

    class SendMail {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }
       

    function sendMail ($emailAdres, $code) {
    // $message = file_get_contents('../mail_templates/EmailCode.html');
    // $message = str_replace('%code%', $code, $message);    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'mail.ip.aimsites.nl';
    $mail->SMTPAuth = false;
    $mail->Port = 21009;
    $mail->setFrom('Bevestiging@EenmaalAndermaal.nl', 'EenmaalAndermaal - Bevestiging');
    $mail->addAddress($emailAdres);
    $mail->isHTML(true);
    $mail->Subject = 'Bevestigingscode - EenmaalAndermaal';
    //$mail->MsgHTML($message);
    $mail->Body = "Beste, \n Hierbij uw code : \n $code \n \n Met vriendelijke groet, \n\n EenmaalAndermaal";
    $mail->AltBody = "Beste,\n\nHierbij uw code: \n $code \n\n Met vriendelijke groet, \n\n EenMaalAnderMaal"; 
    if(!$mail->send()) {
        return false;
    } else {
        return true;
    }
    }
    function getVerificationCode ($email) {
        $command = $this->dbContext->prepare('SELECT top 1 Code from Bevestiging where Gebruikersmailbox = ? ORDER BY [action] DESC');
        $command->execute(array($email));
        $res = $command->fetch();
        return $res[0];
    }    
        

    function insertVerificationCode($email, $type, $input) {    
        $command = $this->dbContext->prepare('INSERT INTO Bevestiging (Gebruikersmailbox, Code, omschrijving) VALUES (?,?,?)');
        $command->execute(array($email, $input, $type));
        echo ' |2|';
        return true;
    }
    }
?>