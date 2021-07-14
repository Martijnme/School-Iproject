<!--
SCIPT OM TOE TE VOEGEN NIEUWE VOORWERPEN
insert into Voorwerp(voorwerpnummer,titel,beschrijving,startprijs,betalingswijze,betalingsinstructie,plaatsnaam,land,looptijd,looptijdBeginDag,looptijdbeginTijdstip,verzendkosten,verzendinstructies,verkoper,koper,looptijdeindedag,looptijdeindeTijdstip,veilingGesloten,verkoopprijs)
VALUES(3,'Adidas NMD', 'Sportieve sneakers met boostzool', '35','Bank/Giro','betalen met de pin','zandvoort','Nederland','20','2021/05/01','15:15:50','3.50','standaard kleine pakketten', 'PdeL42',NULL,'2021/05/21','08:08:08','NO',NUll)

insert into VoorwerpinRubriek
VALUES(5, <laasteniveau>,<rootitem>)
-->
<?php 
    class Category {
        private $dbContext;
		
        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }       
        function getItemsInElement($categroyname){
            $command = $this->dbContext->prepare('SELECT rubrieknaam FROM Rubriek WHERE volgnr IN (SELECT rubrieknummer from Rubriek  where rubrieknaam = ?)');
			
            $command->execute(array($categroyname));
			
			return $command->fetchAll();

        }
		
		function getHotTopics(){
			$command = $this->dbContext->prepare('SELECT top 4 rubrieknaam, count(*) from Rubriek join VoorwerpinRubriek on Rubriek.rubrieknummer = VoorwerpinRubriek.hoofdRubriek GROUP BY rubrieknaam ORDER by rubrieknaam DESC');
            $command->execute();

            $result = $command->fetchAll();
            return $result;
		}
    }
?>