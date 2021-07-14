<?php 
echo 'test';
// if (!isset($_SESSION)) {
//   session_start();
// }
//    require_once('../data/Database.php');
//    require_once('../data/User.php');
//    //require_once('../data/Mail.php');
   
//     $db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
//     $conn = $db->connect();
   
//     $users = new User($conn);
// 	$a = 1;
//    var_dump($a);
   //if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	// if(isset($_POST["Verstuurcode"])){
// 	// 		$email = $_POST['email'];
// 	// 		$type = "email";
// 	// 		$input = rand(10000, 99999);
// 	// 		$mail = new SendMail($email);
// 	// 		$SendMail = $mail->sendMail($email, $input);
// 	// 		//$SendMail = $mail->insertVerificationCode($email, $type, $input);
// 	// 		header("location: ../pages/profile.php?email=".$_POST['email']);
// 	// 	}
   	//if (isset($_POST) && !empty($_POST)) {
// 		// if(isset($_POST["btnAccount"])){
// 		// 	$users->updateUserAccount($_POST['antwoord'],$_POST['vraag'],$_SESSION['user']);
// 		// 	header("refresh:1;url=../pages/profile.php");
// 		// }
// 		// if(isset($_POST['btnAdress']) && !empty($_POST['adresregel1']) && !empty($_POST['postcode']) && !empty($_POST['land'])){
// 		// 	$adres2 = trim($_POST['adresregel2'], " ");
// 		//     $users->updateUserAdress($_POST['adresregel1'],$adres2,$_POST['postcode'],$_POST['woonplaats'],$_POST['land'],$_SESSION['user']);
// 		// 	header("refresh:1;url=../pages/profile.php?message=persoonsgegevensupdate");
// 		// }
// 		// if(isset($_POST['btnMail']) && !empty($_POST['email'])){
// 		// 	$users->updateUserMailbox($_POST['email'],$_SESSION['user']);
// 		// 	header("refresh:1;url=../pages/profile.php");
// 		// }
		//if(isset($_POST['btnPassword']) /*&& !empty($_POST['Newpassword'] && !empty($_POST['Oldpassword']*/)){
			//check of oude ww overeen komt
			//$user = $users->searchForUser($username);
			//if (password_verify($_POST["Oldpassword"], $user['wachtwoord'])){//of $_SESSION['wachtwoord']?
				//check of nieuwe ww langer is dan 7 tekens
				// if (strlen($_POST['Newpassword']) > 7) {
				// 	echo '3';
				// 	//zoja nieuw ww wordt gehasht
				// 	$Newpassword = password_hash($_POST['Newpassword'], PASSWORD_DEFAULT);
				// 	echo '4';
				// 	$users->updateUserWachtwoord($Newpassword,$_SESSION['user']);
				// 	echo '5';
				// 	} else {
				// 		header("location: ../pages/profile.php?error=errorNewpassword");
				// 	}	
				// 	} else {
				// 	header("location: ../pages/profile.php?error=errorOldpassword");
				// } 
				// } else {
				// 	header("location: ../pages/profile.php?error=errorEmptypassword");
				// }  
			//}
		//}
?>

