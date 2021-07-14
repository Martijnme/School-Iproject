<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('../data/Database.php');
require_once('../data/User.php');

$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();
$users = new User($conn);   

$bank = "";
$bankrekening = "";
$controleoptie = "";
$creditcard = "";  
$verkoper;       
     

if($_SERVER["REQUEST_METHOD"] == "POST") {

//BANK            
        if(!empty($_POST["bank"])) {
            $bank = $_POST["bank"];
        } else {
            header("location: ../pages/profile.php?message=errorbank");
            return;
        }
//BANKREKENING            
        if(!empty($_POST["bankrekening"])){
            if (is_numeric($_POST["bankrekening"]) && strlen($_POST["bankrekening"]) <= 10) {
                $bankrekening = $_POST["bankrekening"];
            } else {
                header("location: ../pages/profile.php?message=errorbankrekening&".$_POST['bankrekening']);
                return;
            }
        } else {
            header("location: ../pages/profile.php?message=errorbankrekening");
            return;
        }
//CONTROLE            
        if ($_POST["controle-bank"] != "0") {
            $controleoptie = $_POST["controle-bank"];
        } else {
            header("location: ../pages/profile.php?message=errorcontrole-bank");
            return;
        }
//KAART NUMMER            
        if(!empty($_POST['cred-nummer'])) {
            if (preg_match("/^\d+$/", trim($_POST["cred-nummer"])) && strlen($_POST['cred-nummer']) < 4) {
                $creditcard = $_POST["cred-nummer"];
            } else {
                header("location: ../pages/profile.php?message=errorcreditcard");
                return;
            }
        }
        $user = $users->registerAfterSeller($_SESSION['user'], $bank, $bankrekening, $controleoptie, $creditcard);
        $user = $users->updateSellerState($_SESSION['user']);
//REGSISTRATIE SUCCESVOL            
        if($user == true) {
            $_SESSION['seller'] = true;
            header("location: ../pages/profile.php?message=succesVerkoperRegister");
        } else {
            header("location: ../pages/profile.php?message=errorVerkoperReg");
        }
}
?>  