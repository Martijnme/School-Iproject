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
    if(isset($_POST['btnVerwijder']) && !empty($_POST['gebruikersnaam'])){
        if($_SESSION['user'] === $_POST['gebruikersnaam']) {  
			$users->VerwijderGebruiker($_SESSION['user']);
        } else {
        header("location: ../pages/profile.php?message=errorDelete");
    }
}
}
?>