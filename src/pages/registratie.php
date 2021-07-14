<?php
if (!isset($_SESSION)) {
  session_start();
}
$error= "";
    if(isset($_GET['error'])) { $error = $_GET['error']; }
if(isset($_GET['email'])){$email = $_GET['email'];}else{$email = '';}
?>
<!DOCTYPE html>
<html lang="NL">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../../images/FaviconMenu.jpg" type="image/x-icon" />
  <meta charset="utf-8" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/main.css">
  <link rel="stylesheet" href="../styles/form.css">
  <link rel="stylesheet" href="../styles/navigation.css">
  <link rel="stylesheet" href="../styles/button.css">
  <script src="../lib/register.js"></script>


  <title>EenmaalAndermaal</title>
</head>

<body class="container-fluid">
  <?php include '../components/navigation.php' ?>
  <section class="col-10">
    <div class="container p-0 offset-1">
      <div class="row justify-content-center">
        <!--Vereist aanpassing naar de juiste action!-->
        <form action="../functions/registratie.php" method="POST" target="_self">
          <img src="../../images/FaviconMenu-Big.svg" style="max-height: 20vh" alt="EenmaalAndermaal logo">
          <h2> Registratie</h2>
          <p> <span style="font-weight: bold">1. </span>E-Mail bevestigen </p>
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
              <?php
              if($email === ''){
                echo "<input type='email' name='email' class='form-control' placeholder='E-Mail*' aria-label='email' aria-describedby='basic-addon1'>";
              }else{
                echo "<input type='email' name='email' class='form-control' placeholder='E-Mail*' value= ".$email." aria-label='email' aria-describedby='basic-addon1' readonly>";
                echo "<p style='color: green;'>De bevestigingscode is verzonden</p>";
              }
              ?>
              </div>
            </div>
            <?php if ($error == "errormail") {
              echo "<p style='color: #ff0f0f; font-size: 75%'>mail ongeldig</p>";
            } ?>
            <?php if ($error  == "errorcode") {
              echo "<p style='color: #ff0f0f; font-size: 75%'>bevestiginscode ongeldig</p>";
            } ?>
            <div class="col">
              <div class="form-group mb-3">
              <?php
              if($email === ''){
                echo " <input type='text' name='codemail' class='form-control' placeholder='Bevestigingscode*' style=' visibility: hidden;'>";
              }else{
                echo " <input type='text' name='codemail' class='form-control' placeholder='Bevestigingscode*' style=' visibility: visible;'>";
              }
              ?>
                <!-- <input type="text" name="codemail" class="form-control" placeholder="Bevestigingscode*"> -->
              </div>
            </div>
          </div>
          <input class="btn btn-primary" type="submit" name ="Verstuurcode" value="Verstuurcode" />
          <p class="pt -2"> <span style="font-weight: bold">2. </span>
            Accountgegevens</p>
          <div class="row">
            <div class="col">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" name="gebruikersnaam" placeholder="Gebruikersnaam*" aria-label="gebruikersnaam" aria-describedby="basic-addon1">
              </div>
              <?php if ($error == "errorgebruikergevuld") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>gebruikersnaam onjuist. </p>";
              } ?>
              <?php if ($error == "errorgebruikerlang") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>De naam is te lang, maak het korter dan 10 karakters </p>";
              } ?>
              <?php if ($error == "errorgebruikerexists") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Deze naam is al gebruikt.</p>";
              } ?>
            </div>
            <div class="col">
              <div class="form-group mb-3">
                <input type="password" name="password" placeholder="Wachtwoord*" class="form-control" >
              </div>
            </div>
          </div>
          <?php if ($error  == "errorwachtwoord") {
            echo "<p style='color: #ff0f0f; font-size: 75%'> Het wachtwoord moet uit minimaal 8 karakters bestaan.</p>";
          } ?>
          <p> <span style="font-weight: bold">3. </span>
            Persoonsgegevens</p>
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="voornaam" placeholder="Voornaam*" class="form-control" >
              </div>
            </div>
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="achternaam" placeholder="Achternaam*" class="form-control" >
              </div>
            </div>
            </div>
            <?php if ($error == "errorvoornaam") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Je moet een voornaam in typen.</p>";
              } ?>
              <?php if ($error == "errorgeboortedatum") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Je moet een achternaam in typen.</p>";
              } ?>
            <div class="col">
              <input placeholder="Geboortedatum*" name="geboortedatum" type="text" onfocus="(this.type = 'date')" class="form-control mb-3" >
              <?php if ($error == "errorgeboortedatum") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>postcode ongeldig</p>";
              } ?>
            </div>
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="adresregel1" placeholder="Adresregel1*" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="adresregel2" placeholder="Adresregel2" class="form-control">
              </div>
            </div>
          </div>
          <?php if ($error == "erroradres") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Je moet een adres in typen.</p>";
              } ?>
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="postcode" placeholder="Postcode*" class="form-control" >
              </div>
            </div>
            <?php if ($error == "errorpostcode") {
              echo "<p style='color: #ff0f0f; font-size: 75%'>postcode ongeldig</p>";
            } ?>
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="woonplaats" placeholder="Woonplaats*" class="form-control" >
              </div>
            </div>
          </div>
          <?php if ($error == "errorwoon") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Je moet een woonplaats in typen.</p>";
              } ?>
          <div class="col">
            <input type="text" name="land" placeholder="Land*" class="form-control mb-3" >
          </div>
          <?php if ($error == "errorland") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>Je moet een land in typen.</p>";
              } ?>
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="tel1" placeholder="Telefoonnummer 1*" class="form-control" >
              </div>
            </div>
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="tel2" placeholder="Telefoonnummer 2" class="form-control">
              </div>
            </div>
          </div>
          <?php if ($error == "errortel") {
            echo "<p style='color: #ff0f0f; font-size: 75%'>telefoonnummer 1 is ongeldig</p>";
          } ?>
          <?php if ($error  == "errortel2") {
            echo "<p style='color: #ff0f0f; font-size: 75%'>telefoonnummer 2 is ongeldig</p>";
          } ?>
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
                <select name="vraag" id="vraag" class="form-control" aria-label=".form-select-sm example" >
                  <option value="0"> Beveiligingsvraag*</option>
                  <option value="1"> In welke straat ben je geboren? </option>
                  <option value="2"> Wat is de meisjesnaam van je moeder?</option>
                  <option value="3">Wat is je lievelingsgerecht? </option>
                  <option value="4">Hoe heet je oudste zusje?</option>
                  <option value="5">Hoe heet je huisdier?</option>
                </select>
              </div>
            </div>
            <?php if ($error == "errorvraag") {
              echo "<p style='color: #ff0f0f; font-size: 75%'>U moet een vraag selecteren.</p>";
            } ?>
            <div class="col">
              <div class="form-group mb-3">
                <input type="text" name="vraag-antwoord" placeholder="Antwoord*" class="form-control" >
              </div>
            </div>
          </div>
          <div class="form-check form-switch mb-3">
            <label class="form-check-label" for="flexSwitchCheckDefault"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg> Wilt u verkoper worden?</label>
            <input class="form-check-input" name="verkoperswitch" type="checkbox" id="flexSwitchCheckDefault" onclick="verkoperToggle()">
          </div>
          <div id="verkoper" style="visibility: hidden">
            <div class="row">
              <div class="col">
                <div class="form-group mb-3">
                  <input type="text" name="bank" placeholder="Bank*" class="form-control">
                </div> 
              </div>              
              <div class="col">
                <div class="form-group mb-3">
                  <input type="text" name="bankrekening" placeholder="Bankrekening*" class="form-control" >
                </div>
              </div>
            </div>
            <?php if ($error == "errorbank") {
              echo "<p style='color: #ff0f0f; font-size: 75%'>U moet een bank invoeren</p>";
            } ?>
            <?php if ($error == "errorbankrekening") {
              echo "<p style='color: #ff0f0f; font-size: 75%'>U moet een bankrekening invullen, of een met alleen nummers.</p>";
            } ?>
            <div class="row">
              <div class="col">
                <div class="form-group mb-3">
                  <select name="controle-bank" id="controle-bank" class="form-control" aria-placeholder="Controle-optie*" >
                    <option value="0"> Controle optie*</option>
                    <option value="creditcard"> Creditcard</option>
                    <option value="post"> Post </option>
                  </select>
                </div>
              </div>
              
              <?php if ($error == "errorcontrole-bank") {
                echo "<p style='color: #ff0f0f; font-size: 75%'>U moet een controle methode selecteren.</p>";
              } ?>
              <div class="col">
                <div class="form-group mb-3">
                  <input type="text" name="cred-nummer" placeholder="Creditcardnummer" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="Registreren" value="Registreren" class="btn btn-primary mb-3 reg-button">
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
      </div>
    </div>
  </section>
</body>

</html>