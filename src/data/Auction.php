<?php 
    class Auction {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }

        function searchForAuction($auction) {
            $command = $this->dbContext->prepare('SELECT titel, beschrijving, startprijs, plaatsnaam, land, looptijd, convert(VARCHAR,looptijdBeginDag,105) as [looptijdBeginDag], convert(varchar(5), looptijdbeginTijdstip, 108) as [looptijdbeginTijdstip], verzendkosten, verzendinstructies, verkoper, convert(VARCHAR,looptijdeindedag,105) as [looptijdeindedag], convert(varchar(5), looptijdeindeTijdstip, 108) as[looptijdeindeTijdstip], veilingGesloten, verkoopprijs from Voorwerp where voorwerpnummer = ?;');
            $command->execute(array($auction));
            return $command->fetch();
        }
        function getAuctionID($auctiontitel, $user){
            $command = $this->dbContext->prepare('SELECT top 1 voorwerpnummer from Voorwerp where titel = ? AND verkoper = ?');
            $command->execute(array($auctiontitel, $user));
            $result = $command->fetch();
            return $result[0];
        }
		function getAllAuctionByRubrieknaam($rubrieknaam){
			$command = $this->dbContext->prepare('select titel,voorwerp,beschrijving,startprijs,plaatsnaam,verkoper,convert(VARCHAR,looptijdeindedag,105) as [looptijdEinDag], Voorwerp.veilingGesloten from VoorwerpinRubriek JOIN Voorwerp on Voorwerp.voorwerpnummer = VoorwerpinRubriek.voorwerp where rubriekopLaagsteNiveau IN (select rubrieknummer from Rubriek where rubrieknaam = ?)');
			$command->execute(array($rubrieknaam));
			
			return $command->fetchAll();
        }
        function getVeilingimages($v){
            $command = $this->dbContext->prepare('SELECT filenaam,voorwerp,voorwerp.titel from Bestand right join voorwerp on Bestand.voorwerp = voorwerp.voorwerpnummer where voorwerp = ?');
			$command->execute(array($v));
            
			return $command->fetchAll();
        }
        function getMainimages($v){
            $command = $this->dbContext->prepare('SELECT titel from voorwerp where voorwerpnummer = ?');
			$command->execute(array($v));
            
			return $command->fetch();
        }
        function getImages($v){
            $command = $this->dbContext->prepare('SELECT filenaam from Bestand where voorwerp = ?');
			$command->execute(array($v));
            
			return $command->fetch();
        }
        function getHighestBid($item){
			$command = $this->dbContext->prepare('SELECT max(bodBedrag) from Bod where voorwerp = ?');
			$command->execute(array($item));
            $result = $command->fetch();
            if ($result[0] == NULL){
                $op2 = $this->dbContext->prepare('SELECT startprijs from voorwerp where voorwerpnummer = ?');
                $op2->execute(array($item));
                $rect = $op2->fetch();
                return $rect[0];
            }
			return $result[0];
		}

        function addBidToDatabase($item, $bid, $user) {
            date_default_timezone_set("Europe/Amsterdam");
            $startdate = date("Y/m/d");
            $starttime = date("H:i:s");
            $command = $this->dbContext->prepare('INSERT into Bod(voorwerp, bodbedrag, gebruiker, bodDag, bodTijdstip) 
                                                  VALUES(?, ?, ?, ?, ?)');
            $command->execute(array($item, $bid, $user,$startdate,$starttime));  
            return true;
        }
        function updatewithhash(){
            $gebruiker = 'MartijnOnly';
        $command =$this->dbContext->prepare('UPDATE Gebruiker set wachtwoord = ? where gebruikersnaam = ?');
        $wachtwoord = password_hash($gebruiker, PASSWORD_DEFAULT);
        $command->execute(array($wachtwoord,$gebruiker));
        return true;
        }
    }
?>