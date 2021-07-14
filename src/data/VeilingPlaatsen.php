<?php
    class VeilingPlaatsen {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }

        // TITLE UNIQUE        
		 function searchForUniqueTitle($titel){
            $command = $this->dbContext->prepare('SELECT top 1 * FROM voorwerp where titel = ?');
            $command->execute(array($titel));
            return $command->fetch();
        }

        function plaatsVeiling($titel, $beschrijving,$startprijs, $betalingswijze, $betalingsinstructie, $plaatsnaam, $land, $looptijd, $verzendkosten, $verzendinstructies, $verkoper,$rubriek) {
            //  initialiseert datum en tijd 
            date_default_timezone_set("Europe/Amsterdam");
            $startdate = date("Y/m/d");
            
            $verschil=strtotime($startdate. ' + '.$looptijd . ' days');
            $enddate = date("Y/m/d", $verschil);
            $starttime = date("H:i:s");
            $endtime = $starttime;
            // zet de gegevens in de tabel Voorwerp
            $commandVoorwerp = $this->dbContext->prepare('INSERT into Voorwerp(titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, plaatsnaam, land, 
            looptijd, looptijdBeginDag, looptijdBeginTijdstip, verzendkosten, verzendinstructies, verkoper, koper, 
            looptijdeindedag, looptijdeindeTijdstip, veilingGesloten, verkoopprijs,Valuta,Conditie)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

            try{
                $commandVoorwerp->execute(array($titel, $beschrijving, $startprijs, $betalingswijze, $betalingsinstructie, $plaatsnaam, $land, $looptijd,$startdate,$starttime,
                $verzendkosten, $verzendinstructies, $verkoper,NULL,$enddate,$endtime,"open",NULL,NULL,NULL));
            }catch(Exception $e){
                return false;
            }
            // // zet de gegevens in de tabel VoorwerpinRubriek
            $commandRubriek = $this->dbContext->prepare('INSERT into VoorwerpinRubriek(voorwerp, rubriekopLaagsteNiveau, hoofdRubriek) VALUES(?, ?, ?)');
            $commandRubriek->execute(array($this->getVoorwerpnummer($titel,$verkoper), $this->getRubrieknummer($rubriek), $this->getPreviousRubriek($rubriek)));
            return true;
        }

        function getVoorwerpnummer($titel,$username) {
            $command = $this->dbContext->prepare('SELECT top 1 voorwerpnummer from voorwerp where titel = ? AND verkoper = ?');
            $command->execute(array($titel,$username));
            $result = $command->fetch();
            return $result[0];
        }

        function getRubrieknummer($rubriek) {
            $command = $this->dbContext->prepare('SELECT rubrieknummer from Rubriek where rubrieknaam = ?');
            $command->execute(array($rubriek));
            $result = $command->fetch();
            return $result[0];
        }

        function getPreviousRubriek($rubriek) {
            $array = array();
            $result = $this->getRubrieknummer($rubriek);
            array_push($array, $result);
            do{
            $command = $this->dbContext->prepare('SELECT rubrieknummer from Rubriek where rubrieknummer IN (select volgnr from Rubriek where rubrieknummer = ?)');
            $command->execute(array($result));
            $temp = $command->fetch();
            $result = $temp[0];
            array_push($array, $result);
            }while($result != -1);
            array_pop($array);
            $hoofdrubriek = end($array);
            return $hoofdrubriek;
        }
    }

?>