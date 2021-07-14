<?php
if (!isset($_SESSION)) { 
    session_start(); 
}

require_once('../data/Database.php');
require_once('../data/Auction.php');


$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$auction = new Auction($conn);
$res = $auction->updatewithhash();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>
