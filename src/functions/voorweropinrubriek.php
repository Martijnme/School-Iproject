<?php

require_once('../data/Database.php');
require_once('../data/Auction.php');

$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$auction = new Auction($conn);


$res = $auction->batchTopLevelRubriek();
?>