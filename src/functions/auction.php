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
$veilingID = $_GET['veilingID'];
function getBid() {
    $data = array();
    $data[1] = $_GET['veilingID'];
    var_dump(is_numeric($_POST['valueBid']));
    if(is_numeric($_POST['valueBid'])){
    $data[2] = $_POST['valueBid'];
    } else {header("location: ../pages/veiling.php?error=numeric&veilingID=".$_GET['veilingID']); return;}
    
    $data[3] = $_SESSION['user'];

    return $data;
}

if(isset($_POST['submitBid'])) {
    if(!is_numeric($_POST['valueBid'])){
       header("location: ../pages/veiling.php?error=numeric&veilingID=".$_GET['veilingID']);
       return;
    }
    global $veilingen;
    $getHighestBid = $veilingen->getHighestBid($_GET['veilingID']);

    $highestBid = $getHighestBid;
    $newBid = getBid();
    // Check current (highest) bid to select box
    if ($highestBid >= 1 && $highestBid <= 49.99) {
        $box = 0;
        } elseif ($highestBid >= 50 && $highestBid <= 499.99) {
        $box = 1;
        } elseif ($highestBid >= 500 && $highestBid <= 999.99) {
        $box = 2;
        } elseif ($highestBid >= 1000 && $highestBid <= 4999.99) {
        $box = 3;
        } elseif ($highestBid >= 5000) {
        $box = 4;
    }
   // Insert bid to database if values are true. If not, exit and echo warning.
    switch ($box) {
        case 0:
            if ($newBid[2] >= ($highestBid + 0.50)) {
                echo 'inside';
                var_dump($newBid);
                $insert = $veilingen->addBidToDatabase($newBid[1], $newBid[2], $newBid[3]);
                echo 'outside';
                header("location: ../pages/veiling.php?veilingID=".$veilingID);
                return;
            } else {
                header("location: ../pages/veiling.php?error=ongeldig50c&veilingID=".$veilingID);
                return;
            }
            break;

        case 1:
            if ($newBid[2] >= ($highestBid + 1)) {
                $insert = $veilingen->addBidToDatabase($newBid[1], $newBid[2], $newBid[3]);
                header("location: ../pages/veiling.php?veilingID=".$veilingID);
                return;
            } else {
                header("location: ../pages/veiling.php?error=ongeldig1&veilingID=".$veilingID);
                return;
            }
            break;

        case 2:
            if ($newBid[2] >= ($highestBid + 5)) {
                $insert = $veilingen->addBidToDatabase($newBid[1], $newBid[2], $newBid[3]);
                header("location: ../pages/veiling.php?veilingID=".$veilingID);
                return;
            } else {
                header("location: ../pages/veiling.php?error=ongeldig5&veilingID=".$veilingID);
                return;
            }
            break;

        case 3:
            if ($newBid[2] >= ($highestBid + 10)) {
                $insert = $veilingen->addBidToDatabase($newBid[1], $newBid[2], $newBid[3]);
                header("location: ../pages/veiling.php?veilingID=".$veilingID);
                return;
            } else {
                header("location: ../pages/veiling.php?error=ongeldig10&veilingID=".$veilingID);
                return;
            }
            break;
            
        case 4:
            if ($newBid[2] >= ($highestBid + 50)) {
                $insert = $veilingen->addBidToDatabase($newBid[1], $newBid[2], $newBid[3]);
                header("location: ../pages/veiling.php?veilingID=".$veilingID);
                return;
            } else {
                header("location: ../pages/veiling.php?error=ongeldig50&veilingID=".$veilingID);
                return;
            }
            break;
    }
}