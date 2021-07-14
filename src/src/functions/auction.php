<?php
if (!isset($_SESSION)) {
    session_start();
  }

require_once('../data/Database.php');
require_once('../data/Auction.php');
require_once('../data/User.php');

$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$veilingen = new Auction($conn);

function getBid() {
    $data = array();
    $data[1] = 8;
    $data[2] = $_POST['valueBid'];
    $data[3] = $_SESSION['user'];

    return $data;
}
  
if(isset($_POST['submitBid'])) {
    $bid = getBid();
    $insert = $veilingen->addBidToDatabase($bid[1], $bid[2], $bid[3]);
    header("location: ../pages/veiling.php");
}
