<?ph p //sabotage!

require_once('../data/Database.php');
require_once('../data/Auction.php');


$db = new Database('sql2.ip.aimsites.nl',"iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();


Class cron{
    private $dbContext;

    function __construct($dbContext) {
        $this->dbContext = $dbContext;
    }

    function checkforClose() {
        //  initialiseert datum en tijd 
        date_default_timezone_set("Europe/Amsterdam");
        $date = date('Y-m-d');
        $time = date('H:i:s');
        // Selecteer alles over tijd, en stuur het door naar de verkoper
        $command = $this->dbContext->prepare('SELECT voorwerpnummer FROM Voorwerp WHERE VeilinveilingGesloten = ? AND looptijdeindedag <= ? AND looptijdeindeTijdstip <= ?');
        
        $command->execute(array('open',$date, $time));
        
        return $command->fetchAll();
        // stuur een mail naar de verkoper.

    }
    function makeClose() {
        //  initialiseert datum en tijd 
        date_default_timezone_set("Europe/Amsterdam");
        $date = date('Y-m-d');
        $time = date('H:i:s');
        // Selecteer alles over tijd, en zet het op gesloten.
        $command = $this->dbContext->prepare('UPDATE Voorwerp SET veilingGesloten = ? IN (SELECT veilingGesloten FROM Voorwerp WHERE looptijdeindedag <= ? AND looptijdeindeTijdstip <= ? AND veilingGesloten = ?)');
        
        $command->execute(array('gesloten', 'open',$date, $time, 'open'));
        
        return $command->fetchAll();
    
    }
}
?>