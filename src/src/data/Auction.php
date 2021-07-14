<?php 
    class Auction {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }

        function searchForAuction($auction) {
            $command = $this->dbContext->prepare('SELECT titel, beschrijving, startprijs, plaatsnaam, land, looptijd, convert(VARCHAR,looptijdBeginDag,105) as [looptijdBeginDag], convert(varchar(5), looptijdbeginTijdstip, 108) as [looptijdbeginTijdstip], verzendkosten, verzendinstructies, verkoper, convert(VARCHAR,looptijdeindedag,105) as [looptijdeindedag], convert(varchar(5), looptijdeindeTijdstip, 108) as[looptijdeindeTijdstip], veilingGesloten, verkoopprijs from Voorwerp where voorwerpnummer = ?');
            $command->execute(array($auction));

            return $command->fetch();
        }
		function getAllAuctionByRubrieknaam($rubrieknaam){
			$command = $this->dbContext->prepare('select titel,beschrijving,startprijs,plaatsnaam,verkoper,convert(VARCHAR,looptijdeindedag,105) as [looptijdEinDag] from VoorwerpinRubriek JOIN Voorwerp on Voorwerp.voorwerpnummer = VoorwerpinRubriek.voorwerp where rubriekopLaagsteNiveau IN (select rubrieknummer from Rubriek where rubrieknaam = ?)');
			$command->execute(array($rubrieknaam));
			
			return $command->fetchAll();
		}

        function addBidToDatabase($item, $bid,$user) {
            date_default_timezone_set("Europe/Amsterdam");
            $startdate = date("Y/m/d");
            $starttime = date("H:i:s");

            $command = $this->dbContext->prepare('INSERT into Bod(voorwerp, bodbedrag, gebruiker, bodDag, bodTijdstip) 
                                                  VALUES(?, ?, ?, ?,?)');
            $command->execute(array($item, $bid, $user,$startdate,$starttime));          
        }
    }
?>