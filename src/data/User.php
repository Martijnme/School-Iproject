<?php 
    class User {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }

        // bevestigingscode mail
        function generateCode() {
            $bevestigingCode = rand(10000, 99999);
            return $bevestigingCode;
        }
        function getUserLocation($username){
            $command = $this->dbContext->prepare('SELECT plaatsnaam,land from Gebruiker where gebruikersnaam = ?');
            $command->execute(array($username));
            return $command->fetch();
        }

        function getvraag(){
            $command = $this->dbContext->prepare('SELECT vraagnummer, tekstvraag from vraag');
            $command->execute();
            return $command->fetchAll();
        }
// USER SEARCH        
        function searchForUser($username) {
            $command = $this->dbContext->prepare('SELECT gebruikersnaam,voornaam,achternaam,adresregel1,adresregel2,postcode,plaatsnaam,land,geboortedag,mailbox,wachtwoord,vraag,antwoordtekst,verkoper from Gebruiker where gebruikersnaam = ?');
            $command->execute(array($username));
            return $command->fetch();
        }

        function getFirstPhonenumber($username) {
            $command = $this->dbContext->prepare('SELECT top 1 telefoonnummer from Gebruikerstelefoon where gebruiker = ? order by volgnr asc');
            $command->execute(array($username));
            return $command->fetch();
        }

        function getSecondPhonenumber($username) {
            $command = $this->dbContext->prepare('SELECT top 1 telefoonnummer from Gebruikerstelefoon where gebruiker = ? order by volgnr desc');
            $command->execute(array($username));
            return $command->fetch();
        }
// USER UNIQUE        
		 function searchForUniqueUser($username){
            $command = $this->dbContext->prepare('SELECT top 1 * FROM gebruiker where gebruikersnaam = ?');
            $command->execute(array($username));
            return $command->fetch();
        }

// SELLER UNIQUE        
function searchForUniqueSeller($username){
    $command = $this->dbContext->prepare('SELECT top 1 * FROM verkoper where gebruiker = ?');
    $command->execute(array($username));
    return $command->fetch();
}
		
// UPDATE USER
		function updateUserMailbox($email,$user){
            echo"u.1";
            $command = $this->dbContext->prepare('update Gebruiker set mailbox = ? where gebruikersnaam = ?');
			// $bevestiging = $this->dbContext->prepare('update Bevestiging set Gebruikersmailbox = ? WHERE Gebruikersmailbox IN (select mailbox from Gebruiker where gebruikersnaam = ?)');
            // $bevestiging->execute(array($email, $user));
            echo " u.2";
			$command->execute(array($email, $user));
            echo " u.3";
            return true;
           }
           
	   function updateUserAdress($adres1, $adres2, $postcode, $plaatsnaam, $land, $user){
		   $command = $this->dbContext->prepare('update Gebruiker set adresregel1 = ?, adresregel2 = ?, postcode = ?, plaatsnaam = ?, land = ? where gebruikersnaam = ?');
		   $command->execute(array($adres1, $adres2, $postcode, $plaatsnaam, $land, $user));
		   return true;
	   }

	   function updateUserAccount($vraagnummer, $antwoord, $user) {
		   $command = $this->dbContext->prepare('update Gebruiker set vraag = ?, antwoordtekst = ? where gebruikersnaam = ?' );
		   $command->execute(array($vraagnummer, $antwoord, $user));
		   return true;
		}
		
		function updateUserWachtwoord($wachtwoord, $user) {
		   $command = $this->dbContext->prepare('update Gebruiker set wachtwoord= ? where gebruikersnaam = ?' );
		   $command->execute(array($wachtwoord, $user));
	   		return true;
        }
        
       

//	   REGISTER USER
       function registerUser($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper) {
        //    echo $gebruikersnaam . "<br>" . $voornaam ."<br>". $achternaam."<br>". $adresregel1."<br>".$adresregel2."<br>".$postcode."<br>".$plaatsnaam."<br>".$land."<br>".$geboortedag."<br>".$email."<br>".$wachtwoord."<br>".$vraag."<br>".$antwoord."<br>".$verkoper;  
        $commandGebruiker = $this->dbContext->prepare('INSERT INTO Gebruiker (gebruikersnaam, voornaam, achternaam, adresregel1, adresregel2, postcode, plaatsnaam, land, Geboortedag, Mailbox, wachtwoord, vraag, antwoordtekst, Verkoper) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $commandGebruiker->execute(array($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper));
            return true;
        }

        function registerSeller($gebruikersnaam, $voornaam,  $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper, $bank, $bankrekening, $controleoptie, $creditcard) {
            $registeruser = $this->registerUser($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper);
            if($registeruser){
            $commandVerkoper = $this->dbContext->prepare('INSERT INTO Verkoper (gebruiker, bank, Bankrekening, controleoptie, Creditcard) VALUES(?,?,?,?,?)');
            $commandVerkoper->execute(array($gebruikersnaam, $bank, $bankrekening, $controleoptie, $creditcard));
            return true;
            }
        }

        function registerPhoneNumber($telnummer, $gebruikersnaam) {
            $command = $this->dbContext->prepare('INSERT INTO Gebruikerstelefoon (gebruiker, telefoonnummer) VALUES (?,?)');
            $command->execute(array($gebruikersnaam,$telnummer));
            return true;
        }
// REGISTER SELLER ON PROFILE PAGE
        function registerAfterSeller($gebruikersnaam, $bank, $bankrekening, $controleoptie, $creditcard) {
            $registerSeller= $this->searchForUniqueSeller($gebruikersnaam);
            if(!$registerSeller){
            $commandVerkoper = $this->dbContext->prepare('INSERT INTO Verkoper (gebruiker, bank, Bankrekening, controleoptie, Creditcard) VALUES(?,?,?,?,?)');
            $commandVerkoper->execute(array($gebruikersnaam, $bank, $bankrekening, $controleoptie, $creditcard));
            return true;
            }
        }
// UPDATE SELLERSTATE 
        function updateSellerState($gebuiker) {
            $command = $this->dbContext->prepare('UPDATE Gebruiker set verkoper = ? where gebruikersnaam = ?' );
            $command->execute(array('yes', $gebuiker));
            return true;
         }

//      DELETE USER
        function VerwijderGebruiker ($gebruikersnaam) { 
            $commandTelefoonnummer = $this->dbContext->prepare('DELETE from gebruikerstelefoon where gebruiker = ?');
            $commandVoorwerpRubriek = $this->dbContext->prepare('DELETE from VoorwerpinRubriek where voorwerp IN (select voorwerpnummer from Voorwerp where verkoper = ?)');
            $commandVoorwerp = $this->dbContext->prepare('DELETE from Voorwerp where verkoper = ?');
            $commandBod = $this->dbContext->prepare('DELETE from Bod where gebruiker = ?');         
            $commandVerkoper = $this->dbContext->prepare('DELETE from Verkoper where gebruiker = ?');
            $commandGebruiker = $this->dbContext->prepare('DELETE from Gebruiker where gebruikersnaam = ?');
            
            $commandTelefoonnummer->execute(array($gebruikersnaam));
            $commandVoorwerpRubriek->execute(array($gebruikersnaam));
            $commandVoorwerp->execute(array($gebruikersnaam));
            $commandBod->execute(array($gebruikersnaam));
            $commandVerkoper->execute(array($gebruikersnaam));
            $commandGebruiker->execute(array($gebruikersnaam));
            session_destroy();

            header("location: ../../index.php");
        }

//		LOG OUT USER
        function logout() {
            session_start();
            
            $_SESSION = array();
            
            session_destroy();
            
            header("location: ../../index.php");
            exit;
        }
    }
?>