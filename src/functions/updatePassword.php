<?php 
if (!isset($_SESSION)) {
  session_start();
}
   require_once('../data/Database.php');
   require_once('../data/User.php');
   
    $db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
    $conn = $db->connect();
   
    $users = new User($conn);
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   	if (isset($_POST) && !empty($_POST)) {
		if(isset($_POST["btnPassword"]) && !empty($_POST['Newpassword']) && !empty($_POST['Oldpassword'])){
            $user = $users->searchForUser($_SESSION['user']);
            if (password_verify($_POST['Oldpassword'], $user['wachtwoord'])){
                if (strlen($_POST['Newpassword']) > 7) {  
                    $passwordhash = password_hash($_POST['Newpassword'], PASSWORD_DEFAULT);
                    $users->updateUserWachtwoord($passwordhash, $_SESSION['user']);
                    header("refresh:1;url=../pages/profile.php?message=wachtwoordIsGeupdatet");
                } else {
                    header("refresh:1;url=../pages/profile.php?message=wachtwoordTekort");
                }
            }else {
                header("refresh:1;url=../pages/profile.php?message=OldPasswordIncorrect");
            }
        }else {
            header("refresh:1;url=../pages/profile.php?message=veldIsLeeg");
        }
	}else {
        header("refresh:1;url=../pages/profile.php?message=veldIsLeeg");
    }
}
?>

