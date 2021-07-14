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
		if(isset($_POST["btnAccount"]) && !empty($_POST['oudeAntwoord']) && !empty($_POST['nieuwAntwoord'])){
            $user = $users->searchForUser($_SESSION['user']);
            if ($_POST['oudeAntwoord'] == $user['antwoordtekst']){
                    $users->updateUserAccount($_POST['vraag'], $_POST['nieuwAntwoord'], $_SESSION['user']);
                    header("refresh:1;url=../pages/profile.php?message=antwoordIsAangepast");
                } else {
                    header("refresh:1;url=../pages/profile.php?message=oudAntwoordIncorrect");
                }
            }else {
                header("refresh:1;url=../pages/profile.php?message=vulAlleVeldenIn");
            }
        }else {
            header("refresh:1;url=../pages/profile.php?message=vulAlleVeldenIn");
        }
	}
?>
