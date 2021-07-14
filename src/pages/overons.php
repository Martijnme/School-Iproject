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

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
  <!-- Our icon -->
  <link rel="shortcut icon" href="../../images/FaviconMenu.jpg" type="image/x-icon" />
  <!-- Our CSS -->
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/navigation.css" />
  <link rel="stylesheet" href="../styles/overons.css" />

  <title>Eenmaal Andermaal</title>
</head>

<body class="container-fluid">
  <main class="row">
    <?php include '../components/navigation.php' ?>

    <section class="col-10 offset-2">
      <div class="container p-0">
        <div class="row justify-content-center">

          <section class="row pt-5">
            <h1 class="pb-5">Over ons</h1>
            <div class="col-12 col-lg-6 pb-3">
              <img src="../../images/Oktay.jpg" alt="Oktay" class="about-us-image">
            </div>

            <div class="col-12 col-lg-6 m-auto">
              <h2>Oktay Soytürk</h2>
              <h3 class="job">Software Development</h3>
              <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>

              <h4 class="specialities-title">Specialiteiten:</h4>
              <ul class="specialities">
                <li><img src="../../images/Check.svg" alt=""> Front-end Development</li>
                <li><img src="../../images/Check.svg" alt=""> Graphic design</li>
                <li><img src="../../images/Check.svg" alt=""> UI/UX design</li>
              </ul>
            </div>
          </section>

          <section class="row pt-5">
            <div class="col-12 col-lg-6 m-auto order-sm-last">
              <h2>Martijn Engel</h2>
              <h3 class="job">Web Development</h3>
              <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>

              <h4 class="specialities-title">Specialiteiten:</h4>
              <ul class="specialities">
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
              </ul>
            </div>

            <div class="col-12 col-lg-6 pb-3 pt-3 order-first order-lg-last">
              <img src="../../images/gerrit.jpg" alt="Martijn Engel" class="about-us-image">
            </div>
          </section>

          <section class="row pt-5">
            <div class="col-12 col-lg-6 pb-3 pt-3">
              <img src="../../images/bas.jpg" alt="Bas Imthorn" class="about-us-image">
            </div>

            <div class="col-12 col-lg-6 m-auto">
              <h2>Bas Imthorn</h2>
              <h3 class="job">Data Solutions Development</h3>
              <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>

              <h4 class="specialities-title">Specialiteiten:</h4>
              <ul class="specialities">
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
              </ul>
            </div>
          </section>

          <section class="row pt-5">
            <div class="col-12 col-lg-6 m-auto order-sm-last">
              <h2>Manuel van den Beld</h2>
              <h3 class="job">Infrastructure & Security Management</h3>
              <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>

              <h4 class="specialities-title">Specialiteiten:</h4>
              <ul class="specialities">
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
              </ul>
            </div>

            <div class="col-12 col-lg-6 pb-3 pt-3 order-first order-lg-last">
              <img src="../../images/placeholder1.jpg" alt="Manuel van den Beld" class="about-us-image">
            </div>
          </section>

          <section class="row pt-5">
            <div class="col-12 col-lg-6 pb-3 pt-3">
              <img src="../../images/placeholder1.jpg" alt="Mitchel van de Pest" class="about-us-image">
            </div>

            <div class="col-12 col-lg-6 m-auto">
              <h2>Mitchel van de Pest</h2>
              <h3 class="job">Embedded Software Development</h3>
              <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>

              <h4 class="specialities-title">Specialiteiten:</h4>
              <ul class="specialities">
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
                <li><img src="../../images/Check.svg" alt=""> ???</li>
              </ul>
            </div>
          </section>

          <section class="row pt-5 pb-5">
            <div class="col-12 col-lg-6 m-auto order-sm-last">
              <h2>Albert Jan Nap</h2>
              <h3 class="job">Web Development</h3>
              <p class="description">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>

              <h4 class="specialities-title">Specialiteiten:</h4>
              <ul class="specialities">
                <li><img src="../../images/Check.svg" alt=""> Design</li>
                <li><img src="../../images/Check.svg" alt=""> Backend</li>
                <li><img src="../../images/Check.svg" alt=""> Frontend design</li>
              </ul>
            </div>

            <div class="col-12 col-lg-6 pb-3 pt-3 order-first order-lg-last">
              <img src="../../images/ajpicture.jpg" alt="Albert Jan Nap" class="about-us-image">
            </div>
          </section>

        </div>
      </div>
    </section>

  </main>
</body>

</html>