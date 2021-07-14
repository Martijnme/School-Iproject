<?php 
require_once('../data/Database.php');
require_once('../data/User.php');
$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$users = new User($conn);

$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty(trim($_POST['gebruikersnaam']))) {
		$username = $_POST['gebruikersnaam'];
	}

	if (!empty(trim($_POST["wachtwoord"]))) {
		$password = $_POST["wachtwoord"];
	}

	$user = $users->searchForUser($username);
	if ($user != null) {
			if (password_verify($password, $user['wachtwoord'])){
			session_start();
			
			
			$_SESSION["loggedIn"] = true;
			$_SESSION["user"] = $user['gebruikersnaam'];
			if(strtoupper($user['verkoper']) === 'YES'){
				$_SESSION['seller'] = true;			
			}else{
				$_SESSION['seller'] = false;
			}
			
			header("location: ../../index.php");
		} else {
			header("location: login.php?message=error");
		}
	} else {
		header("location: login.php?message=error");
	}
}
?>