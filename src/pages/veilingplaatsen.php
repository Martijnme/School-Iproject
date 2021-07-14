<?php
if (!isset($_SESSION)) {
  session_start();
}
if(!$_SESSION['loggedIn']){
  header('location: ../functions/login.php?message=veilingplaatsen');
}else if(!$_SESSION['seller']){
  header('location: profile.php?error=veilingplaatsen');
}
$error= "";
    if(isset($_GET['error'])) { $error = $_GET['error']; }

require_once('../data/Database.php');
require_once('../data/Category.php');

$db = new Database('sql2.ip.aimsites.nl', "iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$category = new Category($conn);
$rubriek = $category->getRubrieknaamExceptRootForadding();
?>

<!doctype html>
<html lang="NL">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="shortcut icon" href="../images/FaviconMenu.jpg" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/navigation.css" />
  <link rel="stylesheet" href="../styles/button.css" />
  <link rel="stylesheet" href="../styles/form.css">

  <title>Eenmaal Andermaal</title>
</head>

<body class="container-fluid">
  <main class="row">
    <?php include '../components/navigation.php' ?>

    <section class="col-10 offset-2">
      <div class="container p-0">
        <section class="row justify-content-center">

          <form method="POST" action="../functions/createVeiling.php" enctype='multipart/form-data'>
            <section class="row pt-5">
              <div class="col-12 pb-4">
                <h2>Veiling plaatsen</h2>
              </div>

              <div class="col-12 col-md-6">
                <h5>Product</h5>
                <div class="col-12">
                  <div class="form-group mb-3">
                    <input type="text" class="form-control" name="titel" placeholder="Titel*" aria-label="Titel" required>
                  </div>
                  <?php if ($error == "errortitleinuse") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Deze titel wordt al gebruikt.</p>";
              } ?>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <textarea type="text" class="form-control" style="min-height: 125px" name="beschrijving" placeholder="Beschrijving*" aria-label="Beschrijving" rows="4" required></textarea>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <input class="form-control" list="datalistOptions" name="rubriek" placeholder="Zoek naar rubriek..." required>
                    <datalist id="datalistOptions">
                           <?php foreach($rubriek as $r) { ?>
                                <option value="<?=$r['rubrieknaam']?>">
                            <?php } ?>
                    </datalist>
                  </div>
                </div>
                

                <div class="col-12">
                  <div class="form-group mb-3">
                    <input class="form-control" name="file[]" type="file" id="formFileMultiple" multiple>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <h5>Prijs</h5>
                <div class="col-12">
                  <div class="form-group mb-3">
                    <input type="text" class="form-control" name="Startprijs" placeholder="Startprijs*" aria-label="Startprijs" required>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <select class="form-select" name="betalen" aria-label="Betalingswijze" required>
                      <option value="">Betalingswijze</option>
                      <option value="bank">Bank</option>
                      <option value="contant">Contant</option>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <select class="form-select" name="Betalingsinstructie" aria-label="Betalingsinstructie" required>
                      <option value="">Betalingsinstructie</option>
                      <option value="ideal">iDeal</option>
                      <option value="paypal">PayPal</option>
                      <option value="gepast">Gepast</option>
                    </select>
                  </div>
                </div>

                <h5>Verzending</h5>
                <div class="col-12">
                  <div class="form-group mb-3">
                    <select class="form-select" name="verzendkosten" aria-label="Verzendkosten" required>
                      <option value="">Verzendkosten</option>
                      <option value="gratis">Gratis</option>
                      <option value="5">€5 - Brievenbus</option>
                      <option value="10">€10 - Pakket</option>
                      <option value="20">€20 - Aangetekend</option>
                      <option value="40">€40 - Spoed</option>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <select class="form-select" name="Verzendinstructie" aria-label="Verzendinstructie" required>
                      <option value="">Verzendinstructie</option>
                      <option value="postnl">PostNL</option>
                      <option value="dhl">DHL</option>
                      <option value="DPD">DPD</option>
                      <option value="ups">UPS</option>
                      <option value="usps">USPS</option>
                    </select>
                  </div>
                </div>
              </div>
            </section>

            <section class="row">
              <h5>Veiling duur</h5>
              <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                  <select class="form-select" name="duur" aria-label="Selecteer duur" required>
                    <option value="">Selecteer duur</option>
                    <option value="1">1 dag</option>
                    <option value="3">3 dagen</option>
                    <option value="5">5 dagen</option>
                    <option value="7">7 dagen</option>
                    <option value="10">10 dagen</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group mb-3 d-grid">
                  <input type="submit" name="btnplaatsen" value="PLAATSEN" class="btn btn-primary">
                  <!-- Zonder voorwaardes heeft dit weinig zin.
                  <div class="col-12 form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Ik ga akkoord met de algemene voorwaarden</label>
                  </div>
                  -->
                </div>
              </div>
            </section>
          </form>
        </section>
      </div>
    </section>

  </main>
</body>

</html>