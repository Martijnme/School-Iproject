<?php
require_once('../data/Database.php');
require_once('../data/Category.php');
$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();
$cat = new Category($conn);   

$search = $cat->searchForRubriek($_POST['rubriek']);

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($search)){
      header('location: ../../src/pages/category.php?rubriek=Root');
    }else{
      header('location: ../../src/pages/category.php?rubriek='.$_POST['rubriek']);
    }
}
?>