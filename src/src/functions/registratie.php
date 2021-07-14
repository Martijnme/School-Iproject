<?php
require_once('../data/Database.php');
require_once('../data/User.php');
require_once('../data/Mail.php');
$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();
$users = new User($conn);   

$email = "";
$bevestigingscode = ""; 
$gebruikersnaam = ""; 
$wachtwoord = "";
$voornaam = "";
$achternaam = "";
$geboortedatum = "";
$adresregel1 = "";
$adresregel2 = "";
$postcode = "";
$woonplaats = "";
$land = "";
$telefoonnumer1 = "";
$telefoonnumer2 = "";
$vraag = "";
$antwoord = "";
$bank = "";
$bankrekening = "";
$controleoptie = "";
$creditcard = "";  
$verkoperBox;
$verkoper;       
     

if($_SERVER["REQUEST_METHOD"] == "POST") {
// MAIL CODE PHP MAILER
if(isset($_POST["Verstuurcode"])){
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];
        $type = "email";
        $input = rand(10000, 99999);
        $mail = new SendMail($email);
        $SendMail = $mail->sendMail($email, $input);
        //$SendMail = $mail->insertVerificationCode($email, $type, $input);
        header("location: ../pages/registratie.php?email=".$_POST['email']);
    } else {
        header("location: ../pages/registratie.php?error=errormail");
    }
} else if(isset($_POST["Registreren"])){
    //MAIL CHECK REGISTREREN
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST["email"];
        } else {
            header("location: ../pages/registratie.php?error=errormail");
        }
// CODE        
if(!empty($_POST['codemail'])) {
    // $mailer = new SendMail($email);
    // $SendMail = $mailer->getVerificationCode($email, 'email');
    // if ($_POST['codemail'] == $mailer){
    // $bevestigingscode = $_POST['codemail'];
    //} 
} else {
    header("location: ../pages/registratie.php?error=errorcode");
}

// GEBRUIKERSNAAM CHECK IF EXISTS
        if(!empty($_POST['gebruikersnaam'])) {
            $user = $users->searchForUniqueUser($_POST["gebruikersnaam"]);
//CHECK FOR USERNAME IN USE 
            if(empty($user)) {
                $gebruikersnaam = $_POST["gebruikersnaam"];
            } else {
                header("location: ../pages/registratie.php?error=errorgebruikerexists");
            }
        } else {
            header("location: ../pages/registratie.php?error=errorgebruikergevuld");
        }
//CHECK FOR PASSWORD LANGER DAN 7        
        if (strlen($_POST['password']) > 7) {
            $wachtwoord = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
        }  else {
            header("location: ../pages/registratie.php?error=errorwachtwoord");
        } 
// VOORNAAM
        if (!empty($_POST["voornaam"])) {
            $voornaam = $_POST["voornaam"];
        } else {
            header("location: ../pages/registratie.php?error=errorvoornaam");
        }
// ACHTERNAAM
        if (!empty($_POST["achternaam"])) {
            $achternaam = $_POST["achternaam"];
        } else {
            header("location: ../pages/registratie.php?error=errorachternaam");
        }
// GEBROOTEDATUM
       if (!empty($_POST["geboortedatum"])) {
        $geboortedatum = $_POST["geboortedatum"];
       } else {
        header("location: ../pages/registratie.php?error=errorgeboortedatum");
       }
//ADRES 1
       if (!empty($_POST["adresregel1"])) {
        $adresregel1 = $_POST["adresregel1"];
        } else {
            header("location: ../pages/registratie.php?error=erroradres");
        }
//ADRES 2
       if(!empty($_POST["adresregel2"])) {
           $adresregel2 = $_POST["adresregel2"];
       }
//POSTCODE       
       $remove = str_replace(" ","",$_POST["postcode"]);
        $upper = strtoupper($remove);
        if(preg_match("/^\W*[1-9]{1}[0-9]{3}\W*[a-zA-Z]{2}\W*$/",  $upper)) {
            $postcode = $_POST["postcode"];
        } else {
            header("location: ../pages/registratie.php?error=errorpostcode");
        }
//WOONPLAATS        
        if(!empty($_POST["woonplaats"])) {
            $woonplaats = trim($_POST["woonplaats"]);
        } else {
            header("location: ../pages/registratie.php?error=errorwoon");
        }
//LAND        
        if(!empty(trim($_POST["land"]))) {
            $land = trim($_POST["land"]);
        } else {
            header("location: ../pages/registratie.php?error=errorland");
        }
//TEL 1
        if(strlen($_POST["tel1"]) > 8 && strlen($_POST["tel1"]) < 14) {
            $telefoonnumer1 = $_POST["tel1"];
        } else {
            header("location: ../pages/registratie.php?error=errortel");
        }
//TEL 2 
        if(!empty($_POST["tel2"])) {
            if(strlen($_POST["tel2"]) > 8 && strlen($_POST["tel2"]) < 14) {
                $telefoonnumer2 = $_POST["tel2"];
            }    else {
                header("location: ../pages/registratie.php?error=errortel2");
            }
        } 
// VRAAG        
        if($_POST["vraag"] != 0) {
            $vraag = $_POST["vraag"];
        } else {
            header("location: ../pages/registratie.php?error=errorvraag");
        }
// ANTWOORD        
        if(!empty($_POST["vraag-antwoord"]))  {
            $antwoord = $_POST["vraag-antwoord"];
            $verkoper = "no";
        } else { 
            header("location: ../pages/registratie.php?error=errorantwoord");
        }
//VERKOPER JA?NEE
        if(isset($_POST['verkoperswitch'])){
            $verkoper = "yes";
//BANK            
            if(!empty($_POST["bank"])) {
                $bank = $_POST["bank"];
            } else {
                header("location: ../pages/registratie.php?error=errorbank");
            }
//BANKREKENING            
            if(!empty($_POST["bankrekening"])){
                if (preg_match("/^\d+$/", $_POST["bankrekening"])) {
                    $bankrekening = $_POST["bankrekening"];
                } else {
                    header("location: ../pages/registratie.php?error=errorbankrekening");
                }
            } else {
                header("location: ../pages/registratie.php?error=errorbankrekening");
            }
//CONTROLE            
            if ($_POST["controle-bank"] != "0") {
                $controleoptie = $_POST["controle-bank"];
            } else {
                header("location: ../pages/registratie.php?error=errorcontrole-bank");
            }
//KAART NUMMER            
            if(!empty($_POST['cred-nummer'])) {
                if (preg_match("/^\d+$/", trim($_POST["cred-nummer"]))) {
                    $creditcard = $_POST["cred-nummer"];
                } else {
                    header("location: ../pages/registratie.php?error=errorcreditcard");
                }
            }
//UITVOEREN SELLER QUERY            
            $user = $users->registerSeller($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $woonplaats, $land, $geboortedatum, $email, $wachtwoord, $vraag, $antwoord, $verkoper, $bank, $bankrekening, $controleoptie, $creditcard);
//UITVOEREN TELEFOONGEBRUIKER QUERY
            $user = $users->registerPhoneNumber($telefoonnumer1, $gebruikersnaam);
// IS TEL 2 GEVULD            
            if(isset($telefoonnumer2)){
                $user = $users->registerPhoneNumber($telefoonnumer2, $gebruikersnaam);
            } 
//REGSISTRATIE SUCCESVOL            
            if($user == true) {
                header("location: login.php?message=succesRegister");
            } else {
                header("location: ../pages/registratie.php?error=errorVERKOPER_REG");
        }
    } else {
//UITVOEREN USER REGISTER        
        $user = $users->registerUser($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $woonplaats, $land, $geboortedatum, $email, $wachtwoord, $vraag, $antwoord, $verkoper);
// UITVOEREN TEL1 QUERY        
            $user = $users->registerPhoneNumber($telefoonnumer1, $gebruikersnaam);
// CHECK TEL 2 LEEG JA?NEE            
            if(isset($telefoonnumer2)){
                $user = $users->registerPhoneNumber($telefoonnumer2, $gebruikersnaam);
            }
            if($user == true) {
            header("location: login.php?message=succesRegister");
            }
        }
    }
}
?>  