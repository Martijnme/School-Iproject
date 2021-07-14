<?php
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_GET['error'])) {
  $error = $_GET['error'];
}
if(isset($_GET['veilingID'])){
  $veilingID = $_GET['veilingID'];
}else{
  $veilingID = 1;
}
require_once('../data/Database.php');
require_once('../data/Auction.php');
require_once('../data/User.php');

$db = new Database('sql2.ip.aimsites.nl', "iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$veilingen = new Auction($conn);

$auction = $veilingen->searchForAuction($veilingID);
if(!$auction){
  $auction = $veilingen->searchForAuction(1);
}
$getHighestBid = $veilingen->getHighestBid($veilingID);
$highestBid = $getHighestBid;

if (empty($highestBid)) {
  $current = $auction['startprijs'];
  } else {
  $current = $highestBid;
  }
  
  $images = $veilingen->getVeilingimages($veilingID);
  if((int)$veilingID < 9){
  $main = $veilingen->getMainimages($veilingID);
  }
?>

<!doctype html>
<html lang="NL">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="shortcut icon" href="../../images/FaviconMenu.jpg" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../styles/card.css" />
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/button.css" />
  <link rel="stylesheet" href="../styles/navigation.css">
  <link rel="stylesheet" href="../styles/auction.css">

  <title>Eenmaal Andermaal</title>
</head>

<body class="container-fluid">
  <main class="row">
    <?php include '../components/navigation.php' ?>

    <section class="col-10 offset-2 pt-5">
      <div class="container p-0">
        <div class="row justify-content-center">

          <section class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pb-3">
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <?php 
                  $i = 0;
                  if(empty($images)){
                    if((int)$veilingID < 9){ ?>
                      <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                          <img src="../../images/<?=$main['titel']?>.jpg" alt="<?=$main['titel']?>">
                        </div>
                      </div>
                      <?php }else{ ?>
                  <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                      <img src="../../images/placeholder1.jpg" alt="...">
                    </div>
                  </div>
                  <?php  } }else {
                  foreach ($images as $image){
                    if($i == 0){ $i++;?>
                  <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                      <img src="../../pics/<?=$image['filenaam']?>" alt="...">
                    </div>
                  </div>
                  <?php }else{ ?>
                  <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                      <img src="../../pics/<?=$image['filenaam']?>" alt="...">
                    </div>
                  </div>
                  <?php } } } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: gray;"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: gray;"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
              <section>
                <h5 class="auction-title"><?= $auction['titel'] ?></h5>
                <p class="veilingDetailStatusOpen"><?= $auction['veilingGesloten'] ?></p>
              </section>

              <section class="pb-1">
                <p class="auction-country"><?= $auction['plaatsnaam'] ?> - <?= $auction['land'] ?></p>
                <p class="auction-start-price">Startprijs: €<?= $auction['startprijs'] ?></p>

                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. When an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
              </section>

              <section class="mt-2">
                <h5 class="auction-details-title">Veiling informatie</h5>
                <ul class="col-7 auction-list">
                  <li>Verkoper:</li>
                  <li>Looptijd:</li>
                  <li>Begin datum:</li>
                  <li>Begin tijd:</li>
                  <li>Eind datum:</li>
                  <li>Eind tijd:</li>
                  <li>Verzendkosten:</li>
                  <li>Verzendinstructies:</li>
                </ul>

                <ul class="col-5 auction-details">
                  <li><?= $auction['verkoper'] ?></li>
                  <li><?= $auction['looptijd'] ?></li>
                  <li><?= $auction['looptijdBeginDag'] ?></li>
                  <li><?= $auction['looptijdbeginTijdstip'] ?></li>
                  <li><?= $auction['looptijdeindedag'] ?></li>
                  <li><?= $auction['looptijdeindeTijdstip'] ?></li>
                  <li>€<?= $auction['verzendkosten'] ?></li>
                  <li><?= $auction['verzendinstructies'] ?></li>
                </ul>
              </section>

              <section>
                <h5>Huidig bod: <strong><?= '€'.$current ?></strong></h5>
              </section>

              <form method="POST" action="../functions/auction.php?veilingID=<?=$veilingID?>">
                <section class="col-12 input-group pl-0 pr-0 pt-3 pb-3">
                  <?php
                  if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                    echo '<input type="text" class="col-6 form-control auction-bid" name="valueBid" placeholder="Bedrag">';
                    echo '<input type="submit" class="col-6 btn btn-primary auction-button" name="submitBid" value="BIEDEN">';

                    if ($error == 'numeric') {
                      echo '<p class="pt-2 text-danger"> Alleen cijfers zijn toegestaan tijdens het uitbrengen van een bod </p>';
                    } else if ($error == 'ongeldig50c') {
                      echo '<p class="pt-2 text-danger"> De minimale verhoging voor deze veiling is €0.50 cent. </p>';
                    } elseif ($error == 'ongeldig1') {
                      echo '<p class="pt-2 text-danger"> De minimale verhoging voor deze veiling is €1 euro. </p>';
                    } elseif ($error == 'ongeldig5') {
                      echo '<p class="pt-2 text-danger"> De minimale verhoging voor deze veiling is €5 euro. </p>';
                    } elseif ($error == 'ongeldig10') {
                      echo '<p class="pt-2 text-danger"> De minimale verhoging voor deze veiling is €10 euro. </p>';
                    } elseif ($error == 'ongeldig50') {
                      echo '<p class="pt-2 text-danger"> De minimale verhoging voor deze veiling is €50 euro. </p>';
                    }

                  } else {
                    echo '<input type="text" class="col-6 form-control auction-bid" placeholder="Bedrag" readonly>';
                    echo '<a href="#" class="col-6 btn btn-secondary auction-button disabled" tabindex="-1" role="button" aria-disabled="true">BIEDEN</a>';
                    echo '<p class="pt-2 text-danger"> Je moet ingelogd zijn om te mogen bieden. </p>';
                  }
                  ?>
                </section>
              </form>

            </div>
          </section>

          <section class="row">
            <div class="col-12">
              <h2>Extra informatie</h2>
              <p><?= $auction['beschrijving'] ?></p>
            </div>
          </section>

          <section class="row mt-5">
            <h5 class="auction-details-title">Misschien ook interessant?</h5>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
              <div class="col-12 card">
                <img class="card-img-top" src="../../images/Schoen.jpg" alt="Nette schoen">
                <div class="card-body">
                  <h5 class="card-title">Nette schoen</h5>
                  <p class="veilingStatusOpen">OPEN</p>
                  <div class="card-text d-flex justify-content-between beschrijving">
                    <p class="huidigeBod">Huidig bod:</p>
                    <p class="prijs">€150,56</p>
                  </div>
                  <a href="#" class="btn btn-primary d-grid">BIEDEN</a>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
              <div class="col-12 card">
                <img class="card-img-top" src="../../images/Speaker.jpg" alt="Speaker">
                <div class="card-body">
                  <h5 class="card-title">Speaker</h5>
                  <p class="veilingStatusOpen">OPEN</p>
                  <div class="card-text d-flex justify-content-between beschrijving">
                    <p class="huidigeBod">Huidig bod:</p>
                    <p class="prijs">€320,86</p>
                  </div>
                  <a href="#" class="btn btn-primary d-grid">BIEDEN</a>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
              <div class="col-12 card">
                <img class="card-img-top" src="../../images/Huis.jpg" alt="Huis">
                <div class="card-body">
                  <h5 class="card-title">Huis</h5>
                  <p class="veilingStatusOpen">OPEN</p>
                  <div class="card-text d-flex justify-content-between beschrijving">
                    <p class="huidigeBod">Huidig bod:</p>
                    <p class="prijs">€260,23</p>
                  </div>
                  <a href="#" class="btn btn-primary d-grid">BIEDEN</a>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
              <div class="col-12 card">
                <img class="card-img-top" src="../../images/Boot.jpg" alt="Boot">
                <div class="card-body">
                  <h5 class="card-title">Boot</h5>
                  <p class="veilingStatusOpen">OPEN</p>
                  <div class="card-text d-flex justify-content-between beschrijving">
                    <p class="huidigeBod">Huidig bod:</p>
                    <p class="prijs">€410,23</p>
                  </div>
                  <a href="#" class="btn btn-primary d-grid">BIEDEN</a>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>
</body>

</html>