<?php
if (!isset($_SESSION)) {
  session_start();
}
$category = array("Root");
$_SESSION['route'] = $category;
require_once('src/data/Database.php');
require_once('src/data/Category.php');
$db = new Database('sql2.ip.aimsites.nl', "iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$topics = new Category($conn); 

$hotTopics = $topics->getHotTopics();
$populairTopics = $topics->getpopulairTopics();
$rubriek = $topics->getRubrieknaamExceptRoot();

?>
<!DOCTYPE html>
<html lang="nl">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
  <!-- Our icon -->
  <link rel="shortcut icon" href="../images/FaviconMenu.jpg" type="image/x-icon" />
  <!-- Our CSS -->
  <link rel="stylesheet" href="src/styles/card.css" />
  <link rel="stylesheet" href="src/styles/main.css" />
  <link rel="stylesheet" href="src/styles/button.css" />
  <link rel="stylesheet" href="src/styles/navigation.css">

  <title>Eenmaal Andermaal</title>
</head>

<body class="container-fluid">

  <main class="row">
    <?php include 'src/components/navigation.php' ?>

    <section class="col-10 offset-2">
      <div class="container p-0">
        <div class="row justify-content-center">

          <section class="row">
            <?php include 'src/components/searchbar.php' ?>
          </section>

          <section class="row">
            <h2>Hot categorieën</h2>
            <?php foreach ($hotTopics as $topicname) { ?>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                <div class="col-12 card">
                  <div class="category">
                    <img class="card-img-top categoryImage" src="./images/Categorie/<?= $topicname['rubrieknaam'] ?>.jpg" alt="<?= $topicname['rubrieknaam'] ?>">
                  </div>
                  <div class="card-body">
                    <a href="src/pages/category.php?rubriek=<?= $topicname['rubrieknaam'] ?>" style="color: black;"><h5 class="card-title m-0"><?= $topicname['rubrieknaam'] ?></h5></a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </section>

          <section class="row">
            <h2>Populair</h2>
            <?php foreach ($populairTopics as $topic) { ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
              <div class="col-12 card">
                <img class="card-img-top" src="./images/<?=str_replace(' ','',$topic['titel'])?>.jpg" alt="<?$topic['titel']?>">
                <div class="card-body">
                  <h5 class="card-title"><?=$topic['titel']?></h5>
                  <p class="veilingStatusOpen"><?=strtoUpper($topic['veilingGesloten'])?></p>
                  <div class="card-text d-flex justify-content-between beschrijving">
                    <p class="huidigeBod">Huidig bod:</p>
                    <p class="prijs">€<?php if(isset($topic['bod'])){echo $topic['bod'];}else{ echo $topic['startprijs'];}?></p>
                  </div>
                  <a href="src/pages/veiling.php?veilingID=<?=$topic['voorwerpnummer']?>" class="btn btn-primary d-grid">BEKIJKEN</a>
                </div>
              </div>
            </div>
            <?php } ?>
          </section>

          <section class="row">
            <h2>Vrije tijd</h2>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
              <div class="col-12 card">
                <img class="card-img-top" src="./images/Schoen.jpg" alt="Nette schoen">
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
                <img class="card-img-top" src="./images/Speaker.jpg" alt="Speaker">
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
                <img class="card-img-top" src="./images/Huis.jpg" alt="Huis">
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
                <img class="card-img-top" src="./images/Boot.jpg" alt="Boot">
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