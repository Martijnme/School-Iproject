<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('../data/Database.php');
require_once('../data/VeilingPlaatsen.php');


$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$veilingen = new VeilingPlaatsen($conn);


$result = $veilingen->getPreviousRubriek('Behuizingen en kasten');
echo "<br>"."HEAD RUBRIEK : ";
echo $result;
?>