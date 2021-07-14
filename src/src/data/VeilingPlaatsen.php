<?php
    class VeilingPlaatsen {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }

        function plaatsVeiling($titel, $beschrijving, $rubriekop, $betalingswijze, $betalingsinstructie, $plaatsnaam, $land, $looptijd, $verzendkosten, $verzendinstructies, $verkoper) {
            //  initialiseert datum en tijd 
            date_default_timezone_set("Europe/Amsterdam");
            $startdate = date("Y/m/d");

            $verschil=strtotime($looptijd);
            $enddate = date("Y/m/d", $verschil);

            $starttime = date("H:i:s");
            $endtime = $starttime;
 
            // zet de gegevens in de tabel Voorwerp
            $commandVoorwerp = $this->dbContext->prepare('INSERT into Voorwerp(titel, beschrijving, betalingswijze, betalingsinstructie, plaatsnaam, land, 
            looptijd, looptijdBeginDag, looptijdBeginTijdstip, verzendkosten, verzendinstructies, verkoper, koper, 
            looptijdeindedag, looptijdeindeTijdstip, veilingGesloten, verkoopprijs)
            VALUES(?, ?, ?, ?, ?, ?, ?, '.$startdate.', '.$starttime.', ?, ?, ?, null,
            '.$enddate.', '.$endtime.', "open", null)');
            
            $commandVoorwerp->execute(array($titel, $beschrijving, $betalingswijze, $betalingsinstructie, $plaatsnaam, $land, $looptijd, $verzendkosten, $verzendinstructies,
            $verkoper, $looptijdeindedag));

            // zet de gegevens in de tabel VoorwerpinRubriek
            $commandRubriek = $this->dbContext->prepare('INSERT into VoorwerpinRubriek(voorwerpnummer, rubriekopLaagsteNiveau, hoofdRuriek)
                                                         VALUES(?, ?, ?)');
            $commandRubriek->execute(array($this->getVoorwerpnummer($titel), $rubriek, $this->getPreviousRubriek($rubriek)));

            return true;
        }

        function getVoorwerpnummer($titel) {
            $command = $this->dbContext->prepare('SELECT voorwerpnummer from Voorwerp where titel = ?');
            $command->execute(array($titel));

            return $command->fetch();
        }

        function getRubrieknummer($rubriek) {
            $command = $this->dbContext->prepare('SELECT rubrieknummer from Rubriek where rubrieknaam = ?');
            $command->execute(array($rubriek));

            return $command->fetch();
        }

        function getPreviousRubriek($rubriek) {
            $array = array();
            $result = $this->getRubrieknummer($rubriek);
            array_push($array, $result[0]);
            do{
            $command = $this->dbContext->prepare('SELECT rubrieknummer from Rubriek where rubrieknummer IN (select volgnr from Rubriek where rubrieknummer = ?)');
            $command->execute(array($result[0]));
            $result = $command->fetch();
            array_push($array, $result[0]);
            }while($result[0] != -1);
            array_pop($array);
            $hoofdrubriek = end($array);
            return $hoofdrubriek;
        }
    }

?>