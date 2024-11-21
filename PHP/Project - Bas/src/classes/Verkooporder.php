<?php
 
namespace Bas\classes;
 
use Bas\classes\Database;
use PDO;
use PDOException;
 
class Verkooporder extends Database {
   
    private $table = 'verkoop';
 
    public $verkOrdDatum;
    public $verkOrdBestAantal;
    public $verkOrdStatus;
 
   
 
   
    public function crudverkoop(): void
    {
        // Haal alle klant op uit de database mbv de method getKlant()
        $lijst = $this->getverkoop();
 
        // Print een HTML tabel van de lijst
        $this->showTable($lijst);
    }
    public function showTable($lijst): void {
        $txt = "<table>";
        $txt .= "<tr>";
        $txt .= "<th>klantnaam</th>";
        $txt .= "<th>artnaam</th>";
        $txt .= "<th>verkOrdBestDatum</th>";
        $txt .= "<th>verkOrdBestAantal</th>";
        $txt .= "<th>verkOrdStatus</th>";
        $txt .= "</tr>";
   
        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .= "<td>" . $row["klantNaam"] . "</td>";
            $txt .= "<td>" . $row["artOmschrijving"] . "</td>";
            $txt .= "<td>" . $row["verkOrdDatum"] . "</td>";
            $txt .= "<td>" . $row["verkOrdBestAantal"] . "</td>";
            $txt .= "<td>" . $row["verkOrdStatus"] . "</td>";
            $txt .= "<td>";
            $txt .= "<form method='post' action='updateVerOrd.php'>";
            $txt .= "<input type='hidden' name='artId' value='" . $row['artId'] . "'>";
            $txt .= "<button type='submit' name='update'>Update</button>";
            $txt .= "</form>";
            $txt .= "<form method='post' action='../klant/deleteVerOrd.php'>";
            $txt .= "<input type='hidden' name='artId' value='" . $row['artId'] . "'>";
            $txt .= "<button type='submit' name='verwijderen'>Verwijderen</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "</tr>";
        }
   
        $txt .= "</table>";  
        echo $txt;
    }
       
        public function getverkoop()
        {
           
            $sql = "SELECT *
            FROM verkoop
            join klant ON verkoop.klantid = klant.klantid JOIN artikel ON verkoop.artId = artikel.artId;";
           
            $result = self::$conn->prepare($sql);
            $result->execute();
    
            return $result;
        }
   
 
        public function toevoegenVerkoop($lijst)
{
    try {   
        // Extract data from $lijst array
        $klantId = $lijst['klantId'];
        $artId = $lijst['artOmschrijving'];
        $verkOrdDatum = $lijst['verkOrdDatum'];
        $verkOrdBestAantal = $lijst['verkOrdBestAantal'];
        $verkOrdStatus = 1;
 
        // Prepare the SQL query
        $query = "INSERT INTO `verkoop` (`klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`)
                  VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
 
        // Prepare the statement
        $stmt = self::$conn->prepare($query);
 
        // Bind parameters
        $stmt->bindParam(':klantId', $klantId);
        $stmt->bindParam(':artId', $artId);
        $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
        $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
        $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);
 
        // Execute the statement
        session_start();
        if ($stmt->execute()) {
            echo "Verkooporder succesvol toegevoegd.";
            $_SESSION['verkoopordercheck'] = true;
           
        } else {
            $_SESSION['verkoopordercheck'] = false;
            throw new PDOException("Data insertion failed.");
           
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

    public function deleteVerkoop(int $klantId): bool {
        try {

            $query = "DELETE FROM Klant WHERE klantId = :klantId";

            $stmt = self::$conn->prepare($query);

            $stmt->bindParam(':klantId', $klantId);

            if ($stmt->execute()) {

                return true;
            } else {
            
                return false;
            }
        } catch (PDOException $e) {
    
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>