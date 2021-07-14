<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('../data/Database.php');
require_once('../data/VeilingPlaatsen.php');
require_once('../data/User.php');
require_once('../data/Auction.php');

$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$user = new User($conn);
$userinfo = $user->getUserLocation($_SESSION['user']);
$auction = new Auction($conn);
$veilingen = new VeilingPlaatsen($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$checktitle = $veilingen->searchForUniqueTitle($_POST['titel']);
    var_dump($checktitle);
    if (empty($checktitle)) {
        try{
        $plaatsen = $veilingen->plaatsVeiling(
            $_POST['titel'],
            $_POST['beschrijving'],
            $_POST['Startprijs'],
            $_POST['betalen'],
            $_POST['Betalingsinstructie'],
            $userinfo['plaatsnaam'],
            $userinfo['land'],
            $_POST['duur'],
            $_POST['verzendkosten'],
            $_POST['Verzendinstructie'],
            $_SESSION['user'],
            $_POST['rubriek']
         ); }
         catch (Exception $e){
            echo $e->getMessage();
         }
         if($plaatsen){
             header("location: ../pages/veiling.php?veilingID=".$auction->getAuctionID($_POST['titel'],$_SESSION['user']));
         } 
    }

    else {
        header("location: ../pages/veilingplaatsen.php?error=errortitleinuse");
    } 
}
