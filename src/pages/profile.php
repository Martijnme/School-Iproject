<?php
   if (!isset($_SESSION)) {
     session_start();
   }
   
   if(isset($_GET['message'])){
     $message = $_GET['message'];  
   }
   if(isset($_GET['email'])){
      $email = $_GET['email'];
   }
   require_once('../data/Database.php');
   require_once('../data/User.php');
   
   $db = new Database('sql2.ip.aimsites.nl', "iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
   $conn = $db->connect();
   
   $user = new User($conn);
   
   $userdetail = $user->searchForUser($_SESSION['user']);
   $vraag = $user->getvraag();
   $telefoonnummer1 = $user->getFirstPhonenumber($_SESSION['user']);
   $telefoonnummer2 = $user->getSecondPhonenumber($_SESSION['user']);
   
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
      <link rel="stylesheet" href="../styles/main.css">
      <link rel="stylesheet" href="../styles/form.css">
      <link rel="stylesheet" href="../styles/navigation.css">
      <link rel="stylesheet" href="../styles/button.css">
      <title>Eenmaal Andermaal</title>
   </head>
   <body class="container-fluid">
      <main class="row">
         <?php include '../components/navigation.php'?>
         <section class="col-10 offset-2">
            <div class="container p-0">
            <div class="row justify-content-center">
               <div class="row">
                  <img src="../../images/FaviconMenu-Big.svg" style="max-height: 20vh" alt="EenmaalAndermaal logo">
               </div>
               <form method="POST" action="../functions/updateUser.php">
                  <div class="row">
                     <?php if($message == 'succesVerkoperRegister'){ echo "<p style='color: #76BA1B; font-weight: bold;text-align: left;'>U bent een verkoper geworden</p>";}
                        if ($message == "persoonsgegevensupdate") { echo "<p style='color: #76BA1B; font-weight: bold;text-align: left;'>Uw persoosngegevens zijn gewijzigd</p>";}
                        if ($message == "antwoordIsAangepast") { echo "<p style='color: #76BA1B'>Uw antwoord op de beveiligingsvraag is gewijzigd.</p>";} 
                        if ($message == "wachtwoordIsGeupdatet") { echo "<p style='color: #76BA1B'>Uw wachtwoord is gewijzigd.</p>";} 
                        if ($message == "emailupdate") { echo "<p style='color: #76BA1B; font-weight: bold;text-align: left;'>Uw email is gewijzigd</p>";}
                        if ($message == "emailSend") { echo "<p style='color: #76BA1B; font-weight: bold;text-align: left;'>Uw code is verstuurd.</p>";}
                     ?>
                     <h2> Mijn gegevens</h2>
                     <p> <span style="font-weight: bold">1. </span>E-Mail</p>
                     <div class="col-12">
                        <div class="form-group mb-3"> 
                        <?php if(empty($email)) {?>
                           <input type="email" name="email" class="form-control" value="<?= $userdetail['mailbox'] ?>" aria-label="email" aria-describedby="basic-addon1" required>
                           <?php }else{?>
                              <input type="email" name="email" class="form-control" value="<?=$email?>" aria-label="email" aria-describedby="basic-addon1" required readonly>
                           <?php } ?>
                           <input class="btn btn-primary mt-1" type="submit" name ="VerstuurcodeProfile" value="Verstuur code" />
                        </div>
                     </div>
                     <div class="col-12 col-md-8">
                        <div class="mb-3">
                           <input type="text" name="Bevestigingscode" class="form-control" placeholder="Bevestigingscode*">
                        </div>
                     </div>
                     <div class="col-12 col-md-4">
                        <div class="mb-3">
                           <input type="submit" name="btnMail" id="send" value="WIJZIGEN" class="btn btn-primary mb-3 mail-button">
                        </div>
                     </div>
                  </div>
                  <?php
                     if ($message == "errorcode") {echo "<p style='color: #ff0f0f;>De ingevulde code is incorrect</p>";}
                     if ($message == "errorcodeIngevuld") {echo "<p style='color: #ff0f0f;>De ingevulde code is niet ingevuld</p>";}
                     ?>
                  </form>

                  <form method="POST" action="../functions/updateUser.php">
                  <div class="row">
                     <p> <span style="font-weight: bold">2. </span>Persoonsgegevens</p>
                     <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                           <!-- <p>Adres</p> -->
                           <input type="text" name="adresregel1" value="<?= trim($userdetail['adresregel1'], " ") ?>" placeholder="Adresregel 1*" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                           <!-- <p>Adres 2</p> -->
                           <input type="text" name="adresregel2" value="<?= trim($userdetail['adresregel2'], " ") ?>" placeholder="Adresregel 2" class="form-control">
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                           <!-- <p>Postcode</p> -->
                           <input type="text" name="postcode" value="<?= $userdetail['postcode'] ?>" placeholder="Postcode*" class="form-control"  required>
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                           <!-- <p>Woonplaats</p> -->
                           <input type="text" name="woonplaats" value="<?= $userdetail['plaatsnaam'] ?>" placeholder="Woonplaats*" class="form-control"  required>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="form-group mb-3">
                           <!-- <p>Land</p> -->
                           <input type="text" name="land" value="<?= $userdetail['land'] ?>" placeholder="Land*" class="form-control mb-3"  required>
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                           <!-- <p>Telefoonnummer</p> -->
                           <input type="tel" name="telefoonnummer1" value="<?= $telefoonnummer1['telefoonnummer'] ?>" placeholder="Telefoon 1" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                           <!-- <p>Telefoonnummer 2</p> -->
                           <input type="tel" name="telefoonnummer1" value="<?= trim($telefoonnummer2['telefoonnummer'], " ") ?>" placeholder="Telefoon 2" class="form-control">     
                        </div>
                     </div>
                     <div class="col-12">
                        <input type="submit" name="btnAdress" id="send" value="WIJZIGEN" class="btn btn-primary mb-3 reg-button">
                     </div>
                  </div>
               </form>

               <form method="POST" action="../functions/updatePassword.php">
                  <div class="row">
                     <p> <span style="font-weight: bold">3. </span>Wachtwoord</p>
                     <div class="col-12 col-md-4">
                        <div class="mb-3">
                           <input type="password" name="Newpassword" placeholder="Nieuw Wachtwoord*" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-12 col-md-4">
                        <div class="mb-3">
                           <input type="password" name="Oldpassword" placeholder="Huidig Wachtwoord*" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-12 col-md-4">
                        <div class="mb-3">
                           <input type="submit" name="btnPassword" id="send" value="WIJZIGEN" class="btn btn-primary mb-3 mail-button">
                        </div>
                     </div>
                     <?php 
                     if ($message == "wachtwoordTekort") { echo "<p style='color: #ff0f0f;'>Uw wachtwoord moet minimaal 7 tekens bevatten.</p>";}
                     if ($message == "OldPasswordIncorrect") {echo "<p style='color: #ff0f0f;'>Uw huidig wachtwoord is incorrect.</p>";}
                     if ($message == "veldIsLeeg") {echo "<p style='color: #ff0f0f;>U moet alle velden invullen.</p>";}
                     ?>
                  </div>
               </form>

               <form method="POST" action="../functions/updateBeveiligingsvraag.php">
               <div class="row">
                     <p> <span style="font-weight: bold">4. </span>Beveiligingsvraag : <span style="font-family: italic">
                     <?php foreach($vraag as $v) {
                              if ($v['vraagnummer'] == $userdetail['vraag']){
                                 echo $v['tekstvraag'];
                              }  
                           } 
                     ?>
                     </span>
                     </p>
                              
                     <div class="col-12 col-md-4">
                        <div class="mb-3">
                           <select name="vraag" id="vraag" class="form-control" aria-label=".form-select-sm example" required>
                           <?php foreach($vraag as $v) {
                              if ($v['vraagnummer'] == $userdetail['vraag']){
                                echo "<option value=".$v['vraagnummer']." selected>".$v['tekstvraag']."</option>" ;
                              }else{
                                echo "<option value=".$v['vraagnummer'].">".$v['tekstvraag']."</option>" ;
                              }
                            }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-12 col-md-3">
                        <div class="mb-3">
                           <input type="text" name="oudeAntwoord" placeholder="Huidig antwoord*" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-12 col-md-3">
                        <div class="mb-3">
                           <input type="text" name="nieuwAntwoord" placeholder="Nieuw antwoord*" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-12 col-md-2">
                        <div class="mb-3">
                           <input type="submit" name="btnAccount" id="send" value="WIJZIGEN" class="btn btn-primary mb-3 mail-button">
                        </div>
                     </div>
                     <?php 
                     if ($message == "oudAntwoordIncorrect") { echo "<p style='color: #ff0f0f;'>Uw antwoord op de beveiligingsvraag is incorrect.</p>";}
                     if ($message == "vulAlleVeldenIn") {echo "<p style='color: #ff0f0f;'>U moet alle velden invullen.</p>";}
                     ?>
                  </div>
                  
               </form>
               <?php if(!$_SESSION['seller']){?>
               <form method="POST" action="../functions/registratieVerkoper.php">
                  <p> <span style="font-weight: bold">5. </span>Wilt u verkoper worden?</p>
                  <div id="verkoper">
                     <div class="row">
                        <div class="col">
                           <div class="form-group mb-3">
                              <select name="bank" id="bank" class="form-control" aria-placeholder="Bank*" required>
                                 <option value=""> Bank*</option>
                                 <option value="Rabobank"> Rabobank</option>
                                 <option value="ING"> ING </option>
                                 <option value="SNS"> SNS </option>
                                 <option value="ABN-Amro"> ​ABN-Amro </option>
                                 <option value="ASN"> ASN </option>
                                 <option value="Bunq"> Bunq </option>
                                 <option value="DHB"> DHB </option>
                                 <option value="Knab"> Knab </option>
                                 <option value="Triodos"> Triodos </option>
                              </select>
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group mb-3">
                              <input type="text" name="bankrekening" placeholder="Creditcardnummer*" class="form-control" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col">
                           <div class="form-group mb-3">
                              <select name="controle-bank" id="controle-bank" class="form-control" aria-placeholder="Controle-optie*" required>
                                 <option value=""> Controle optie*</option>
                                 <option value="creditcard"> Creditcard</option>
                                 <option value="post"> Post </option>
                              </select>
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group mb-3">
                              <input type="text" name="cred-nummer" placeholder="CVV" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php 
                     if ($message == "errorcontrole-bank") { echo "<p style='color: #ff0f0f;'>U moet een controle methode selecteren.</p>";} 
                     if ($message == "errorbank") { echo "<p style='color: #ff0f0f;'>U moet een bank invoeren</p>";}
                     if ($message == "errorbankrekening") {echo "<p style='color: #ff0f0f;'>Uw kaartnummer is ongeldig of bevat meet dan 10 tekens.</p>";}
                     if ($message == "errorcreditcard") {echo "<p style='color: #ff0f0f;'>Uw CCV is onjuist.</p>";}
                     ?>
                  <input type="submit" name="btnRegVerkoper" value="WORDT VERKOPER" class="btn btn-primary mb-3 reg-button">
               </form>
               <?php }?>
               <form method="POST" action="../functions/deleteUser.php">
                  <div class="row">
                     <p style="font-weight: bold">Account verwijderen</p>
                     <div class="col-12 col-md-8">
                        <input type="text" name="gebruikersnaam" placeholder="voer in gebruikersnaam" class="form-control" required>
                        <p> Voer uw gebruikersnaam in om uw account te verwijderen.</p>
                     </div>
                     <div class="col-12 col-md-4">
                        <input type="submit" name="btnVerwijder" id="send" value="VERWIJDEREN" class="btn btn-primary mb-3 reg-button">
                     </div>
                     <?php
                     if ($message == "errorDelete") {echo "<p style='color: #ff0f0f;'>De ingevulde gebruikersnaam is incorrect</p>";}
                     ?>
               </form>
               <script 
                  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" 
                  integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" 
                  crossorigin="anonymous"></script>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>