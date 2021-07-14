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
            $date = date('m-d-Y');
        //(old)	$command = $this->dbContext->prepare('SELECT top 4 rubrieknaam, count(*) from VoorwerpinRubriek join Rubriek on Rubriek.rubrieknummer = VoorwerpinRubriek.hoofdRubriek GROUP BY VoorwerpinRubriek.hoofdRubriek,rubrieknaam ORDER by count(*) DESC');
        	$command = $this->dbContext->prepare('SELECT top 4 rubrieknaam, count(*) from VoorwerpinRubriek join Rubriek on Rubriek.rubrieknummer = VoorwerpinRubriek.hoofdRubriek inner join Voorwerp on voorwerp.voorwerpnummer = VoorwerpinRubriek.voorwerp WHERE CAST(voorwerp.looptijdeindedag AS DATE) > ? GROUP BY rubrieknaam ORDER by count(*) DESC;');

            $command->execute(array($date));

            $result = $command->fetchAll();
            return $result;
        }
        function getpopulairTopics(){
            $date = date('m-d-Y');
        //(old)  $command = $this->dbContext->prepare('SELECT top 8 titel,veilingGesloten,MAX(Bod.bodbedrag) as [bod],startprijs,voorwerpnummer from voorwerp LEFT JOIN Bod on bod.voorwerp = voorwerp.voorwerpnummer group by voorwerpnummer,titel,veilingGesloten,startprijs order by voorwerpnummer ASC');
            
            $command = $this->dbContext->prepare('SELECT top 8 titel,veilingGesloten,MAX(Bod.bodbedrag) as [bod],startprijs,voorwerpnummer from voorwerp LEFT JOIN Bod on bod.voorwerp = voorwerp.voorwerpnummer WHERE CAST(looptijdeindedag as date) > ? group by voorwerpnummer,titel,veilingGesloten,startprijs order by voorwerpnummer ASC');

            $command->execute(array($date));

            $result = $command->fetchAll();
            return $result;
		}

        function getRubrieknaamExceptRoot(){
            $command = $this->dbContext->prepare('SELECT rubrieknaam, COUNT(VoorwerpinRubriek.hoofdRubriek) as aantal from Rubriek join Voorwerpinrubriek on rubriek.rubrieknummer = voorwerpinrubriek.rubriekopLaagsteNiveau OR rubriek.rubrieknummer = VoorwerpinRubriek.hoofdRubriek WHERE rubrieknummer != -1 and volgnr != -1 GROUP BY rubrieknaam ORDER BY COUNT(VoorwerpinRubriek.hoofdRubriek) DESC');
            $command->execute();
            $result = $command->fetchAll();
            return $result;
        }
        function getRubrieknaamExceptRootForadding(){
            $command = $this->dbContext->prepare('SELECT rubrieknummer, rubrieknaam from Rubriek where rubrieknummer != -1 and volgnr != -1 order by volgnr asc');
            $command->execute();
            $result = $command->fetchAll();
            return $result;
        }
        function searchForRubriek($rub){
            $command = $this->dbContext->prepare('SELECT rubrieknaam from Rubriek where rubrieknaam = ?');
            $command->execute(array($rub));
            return $command->fetchAll();
        }
    }
?>