<?php 
if (!isset($_SESSION)) {
  session_start();
}
   require_once('../data/Database.php');
   require_once('../data/User.php');
   require_once('../data/Mail.php');
   
    $db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
    $conn = $db->connect();
   
    $users = new User($conn);


	function sendAndInsert($email, $conn){
			$type = "email";
			$input = rand(10000, 99999);
			$mail = new SendMail($conn);
			$SendMail = $mail->sendMail($email, $input);
			$insertMail = $mail->insertVerificationCode($email, $type, $input);
			if($SendMail){
				return true;
			} else {
				return false;
			}	
	} 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["Verstuurcode"])){
					if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
						$email = $_POST["email"];
						if(sendAndInsert($email, $conn)){
						header("location: ../pages/registratie.php?email=".$emailAdres);
					}else{
						header("location: ../pages/registratie.php?error=errormail");	
					}
				} else {
				header("location: ../pages/registratie.php?error=errormail");
				return;
			}
		}
		if(isset($_POST["VerstuurcodeProfile"])){
			if(empty($_POST['email'])){
				header("location: ../pages/profile.php?error=errormail");
			}else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
				$email = $_POST["email"];
				if(sendAndInsert($email, $conn)){
					header("location: ../pages/profile.php?message=emailSend&email=".$email);
				}else{
					header("location: ../pages/profile.php?error=errormail");	
				}
				} else {
					header("location: ../pages/profile.php?error=errormail");
				}
			}	


// 	if(isset($_POST["Verstuurcode"])){
// 		if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
// 			$email = $_POST["email"];
// 			$type = "email";
// 			$input = rand(10000, 99999);
// 			$mail = new SendMail($conn);
// 			$SendMail = $mail->sendMail($email, $input);
// 			$insertMail = $mail->insertVerificationCode($email, $type, $input);
// 			if($SendMail){
// 			header("location: ../pages/registratie.php?email=".$emailAdres);
// 			}else{
// 				header("location: ../pages/registratie.php?error=errormail");	
// 			}
// 		} else {
// 			header("location: ../pages/registratie.php?error=errormail");
// 			return;
// 		}
// 	}
// 	if(isset($_POST["VerstuurcodeProfile"])){
// 		if(empty($_POST['email'])){
// 			header("location: ../pages/profile.php?error=errormail");
// 		}else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
// 			$email = $_POST["email"];
// 			$type = "email";
// 			$input = rand(10000, 99999);
// 			$mail = new SendMail($conn);
// 			$SendMail = $mail->sendMail($email, $input);
// 			$insertMail = $mail->insertVerificationCode($email, $type, $input);
// 			if($SendMail){
// 			header("location: ../pages/profile.php?message=emailSend&email=".$email);
// 			}else{
// 				header("location: ../pages/profile.php?error=errormail");	
// 			}
// 		} else {
// 			header("location: ../pages/profile.php?error=errormail");
// 		}
// 	}


		if(isset($_POST['btnMail'])) {
				if(!empty($_POST['Bevestigingscode'])) {
					$mailer = new SendMail($conn);
					var_dump($_POST["email"]);
					$mailingcode = $mailer->getVerificationCode($_POST["email"]);
				if ($_POST['Bevestigingscode'] == $mailingcode){
					$users->updateUserMailbox($_POST['email'],$_SESSION['user']);
					header("location: ../pages/profile.php?message=emailupdate");	
				}else{
					header("location: ../pages/profile.php?message=errorcode");
					return;
				}
			}else{
					header("location: ../pages/profile.php?message=errorcodeIngevuld");
					return;
				}
		}
   		if (isset($_POST) && !empty($_POST)) {
		if(isset($_POST["btnAccount"])){
			$users->updateUserAccount($_POST['antwoord'],$_POST['vraag'],$_SESSION['user']);
			header("refresh:1;url=../pages/profile.php");
		}
		// if(isset($_POST['btnAdress']) && !empty($_POST['adresregel1']) && !empty($_POST['postcode']) && !empty($_POST['land'])){
		// 	$adres2 = trim($_POST['adresregel2'], " ");
		//     $users->updateUserAdress($_POST['adresregel1'],$adres2,$_POST['postcode'],$_POST['woonplaats'],$_POST['land'],$_SESSION['user']);
		// 	header("refresh:1;url=../pages/profile.php?message=persoonsgegevensupdate");
		// }

		if(isset($_POST['btnAdress']) && !empty($_POST['adresregel1']) && !empty($_POST['postcode']) && !empty($_POST['land'])){
			$adres2 = trim($_POST['adresregel2'], " ");
			$remove = str_replace(" ","",$_POST["postcode"]);
        	$upper = strtoupper($remove);
        	if(preg_match("/^\W*[1-9]{1}[0-9]{3}\W*[a-zA-Z]{2}\W*$/",  $upper)) {
			$users->updateUserAdress($_POST['adresregel1'],$adres2,$_POST['postcode'],$_POST['woonplaats'],$_POST['land'],$_SESSION['user']);
			header("refresh:1;url=../pages/profile.php?message=persoonsgegevensupdate");
        	} else {
				header("location: ../pages/profile.php?message=errorpostcode");
				return;
        	}    
		}
	}   
}
  
?>

