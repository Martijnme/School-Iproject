<?php
if (!isset($_SESSION)) {
  session_start();
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

          <form method="POST" action="../functions/createVeiling.php">
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
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <textarea type="text" class="form-control" style="min-height: 125px" name="beschrijving" placeholder="Beschrijving*" aria-label="Beschrijving" rows="4" required></textarea>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <!-- <p>Rubriek</p> -->
                    <input class="form-control" list="datalistOptions" placeholder="Zoek naar rubriek..." required>
                    <datalist id="datalistOptions">
                      <!-- Voorbeelden -->
                      <option value="Verzamelen">
                      <option value="Computers">
                      <option value="Speelgoed">
                      <option value="Postzegels">
                      <option value="Boeken">
                    </datalist>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <input class="form-control" type="file" id="formFileMultiple" multiple>
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
                    <select class="form-select" aria-label="Betalingswijze" required>
                      <option selected>Betalingswijze</option>
                      <option value="bank">Bank</option>
                      <option value="contant">Contant</option>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <input type="text" class="form-control" name="Betalingsinstructie" placeholder="Betalingsinstructie" aria-label="Betalingsinstructie">
                  </div>
                </div>

                <h5>Verzending</h5>
                <div class="col-12">
                  <div class="form-group mb-3">
                    <select class="form-select" aria-label="Verzendkosten" required>
                      <option selected>Verzendkosten</option>
                      <option value>Gratis</option>
                      <option value>€5 - Brievenbus</option>
                      <option value="bank">€10 - Pakket</option>
                      <option value="contant">€20 - Aangetekend</option>
                      <option value="contant">€40 - Spoed</option>
                    </select>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group mb-3">
                    <input type="text" class="form-control" name="Verzendinstructie" placeholder="Verzendinstructie" aria-label="Verzendinstructie">
                  </div>
                </div>
              </div>
            </section>

            <section class="row">
              <h5>Veiling duur</h5>
              <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                  <select class="form-select" aria-label="Selecteer duur">
                    <option selected>Selecteer duur</option>
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
                  <div class="col-12 form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Ik ga akkoord met de algemene voorwaarden</label>
                  </div>
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