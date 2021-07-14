<?php
    class Bieden {
        private $dbContext;

        function __construct($dbContext) {
            $this->dbContext = $dbContext;
        }

        function addBidToDatabase($item, $bid,$user) {
            $command = $this->dbContext->prepare('INSERT into Bod(voorwerp, bodbedrag, gebruiker, bodDag, bodTijdstip) 
                                                  VALUES(?, ?, ?, CURRENT_DATE, CURRENT_TIME)');
            $command->execute(array($item, $bid, $user));

            return '<p> Bod is succesvol geplaatst </p>';
        }

    }

?>