<?php 
    require_once('../data/Database.php');
    require_once('../data/User.php');

     $db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
     $conn = $db->connect();

     $users = new User($conn);
     $users->logout();
?>