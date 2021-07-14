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
        
        function searchForUser($username) {
            $command = $this->dbContext->prepare('SELECT gebruikersnaam,voornaam,achternaam,adresregel1,adresregel2,postcode,plaatsnaam,land,geboortedag,mailbox,wachtwoord,vraag,antwoordtekst,verkoper from Gebruiker where gebruikersnaam = ?');
            $command->execute(array($username));
            return $command->fetch();
        }
		 function searchForUniqueUser($username)  {
            $command = $this->dbContext->prepare('SELECT gebruikersnaam FROM Gebruiker where gebruikersnaam = ?' );
            $command->excute(array($username));
            return $command->fetch();
        }
		
//		UPDATE USER
		function updateUserMailbox($email,$user){
            $command = $this->dbContext->prepare('update Gebruiker set mailbox = ? where gebruikersnaam = ?');
			$bevestiging = $this->dbContext->prepare('update Bevestiging set Gebruikersmailbox = ? WHERE Gebruikersmailbox IN (select mailbox from Gebruiker where gebruikersnaam = ?)');
            $bevestiging->execute(array($email, $user));
			$command->execute(array($email, $user));
           }
           
	   function updateUserAdress($adres1, $adres2, $postcode, $plaatsnaam, $land, $user){
		   $command = $this->dbContext->prepare('update Gebruiker set adresregel1 = ?, adresregel2 = ?, postcode = ?, plaatsnaam = ?, land = ? where gebruikersnaam = ?');
		   $command->execute(array($adres1, $adres2, $postcode, $plaatsnaam, $land, $user));
		   return true;
	   }

	   function updateUserAccount($antwoord, $vraag, $user) {
		   $command = $this->dbContext->prepare('update Gebruiker set vraag= ?, antwoordtekst = ? where gebruikersnaam = ?' );
		   $command->excute(array($vraag,$antwoord, $user));
		   return true;
		}
		
		function updateUserWachtwoord($wachtwoord,$user) {
		   $command = $this->dbContext->prepare('update Gebruiker set wachtwoord= ? where gebruikersnaam = ?' );
		   $command->excute(array($wachtwoord, $user));
	   		return true;
        }
        
       

//	   REGISTER USER
       function registerUser($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper) {
        $commandGebruiker = $this->dbContext->prepare('INSERT INTO Gebruiker (gebruikersnaam, voornaam, achternaam, adresregel1, adresregel2, postcode, plaatsnaam, land, Geboortedag, Mailbox, wachtwoord, vraag, antwoordtekst, Verkoper) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $commandGebruiker->execute(array($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper));
            return true;
        }

        function registerSeller($gebruikersnaam, $voornaam,  $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper, $bank, $bankrekening, $controleoptie, $creditcard) {
            $this->registerUser($gebruikersnaam, $voornaam, $achternaam, $adresregel1, $adresregel2, $postcode, $plaatsnaam, $land, $geboortedag, $email, $wachtwoord, $vraag, $antwoord, $verkoper);
            $commandVerkoper = $this->dbContext->prepare('INSERT INTO Verkoper (gebruiker, bank, Bankrekening, controleoptie, Creditcard) VALUES(?,?,?,?,?)');
            $commandVerkoper->execute(array($gebruikersnaam, $bank, $bankrekening, $controleoptie, $creditcard));
            return true;
        }

        function registerPhoneNumber($telnummer, $gebruikersnaam) {
            $command = $this->dbContext->prepare('INSERT INTO Gebruikerstelefoon (gebruiker, telefoonnummer) VALUES (?,?)');
            $command->execute(array($gebruikersnaam,$telnummer));
            return true;
        }


//      DELETE USER
        function VerwijderGebruiker ($gebruikersnaam) { 
	        $commandTelefoonnummer = $this->dbContext->prepare('delete from gebruikerstelefoon where gebruiker = ?');
	        $commandVerkoper = $this->dbContext->prepare('delete from Verkoper where gebruiker = ?');
	        $commandGebruiker = $this->dbContext->prepare('delete from Gebruiker where gebruikersnaam = ?');
		    $commandTelefoonnummer->execute(array($gebruikersnaam));
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