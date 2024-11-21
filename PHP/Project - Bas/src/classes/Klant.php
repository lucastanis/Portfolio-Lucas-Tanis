<?php
// auteur: studentnaam
// functie: definitie class Klant
namespace Bas\classes;

use PDO;
use PDOException;

include_once "functions.php";

class Klant extends Database
{
    public $klantId;
    public $klantemail = null;
    public $klantnaam;
    public $klantwoonplaats;
    private $table_name = "Klant";

    // Methods

    public function getKlant(int $klantId)
    {
        try {
            $query = "SELECT * FROM Klant WHERE klantId = :klantId";
            $stmt = self::$conn->prepare($query);
            $stmt->bindParam(':klantId', $klantId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                echo "Geen klant gevonden met ID: $klantId";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function toevoegenVerkoop($lijst)
    {
        try {
            // Extract data from $lijst array
            $klantNaam = $lijst['klantNaam'];
            $klantEmail = $lijst['klantEmail'];
            $klantAdres = $lijst['klantAdres'];
            $klantPostcode = $lijst['klantPostcode'];
            $klantWoonplaats = $lijst['klantWoonplaats'];

            // Prepare the SQL query
            $query = "INSERT INTO `klant` (`klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`)
                      VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";

            // Prepare the statement
            $stmt = self::$conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Klant succesvol toegevoegd.";
            } else {
                echo "Er is een fout opgetreden bij het toevoegen van de klant.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function toevoegenKlant($lijst)
    {
        try {
            // Extract data from $lijst array
            $klantNaam = $lijst['klantnaam'];
            $klantEmail = $lijst['klantemail'];
            $klantAdres = $lijst['klantadres'];
            $klantPostcode = $lijst['klantpostcode'];
            $klantWoonplaats = $lijst['klantwoonplaats'];

            // Prepare the SQL query
            $query = "INSERT INTO `klant` (`klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`)
                      VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";

            // Prepare the statement
            $stmt = self::$conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Klant succesvol toegevoegd.";
            } else {
                echo "Er is een fout opgetreden bij het toevoegen van de klant.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function crudKlant(): void
    {
        // Haal alle klant op uit de database mbv de method getKlanten()
        $lijst = $this->getKlanten();

        // Print een HTML tabel van de lijst
        $this->showTable($lijst);
    }

    public function getKlanten()
    {
        $sql = "SELECT * FROM Klant";
        $result = self::$conn->prepare($sql);
        $result->execute();

        return $result;
    }

    public function dropDownKlant($row_selected = -1)
    {
        // Haal alle klanten op uit de database mbv de method getKlanten()
        $lijst = $this->getKlanten();

        echo "<label for='Klant'>Klantnaam:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            if ($row_selected == $row["klantId"]) {
                echo "<option value='$row[klantId]' selected='selected'> $row[klantNaam]</option>\n";
            } else {
                echo "<option value='$row[klantId]'> $row[klantNaam]</option>\n";
            }
        }
        echo "</select>";
    }

    public function showTable($lijst): void {
        $txt = "<table>";
        $txt .= "<tr>";
        $txt .= "<th>klantNaam</th>";
        $txt .= "<th>klantEmail</th>";
        $txt .= "<th>klantAdres</th>";
        $txt .= "<th>klantPostcode</th>";
        $txt .= "<th>klantWoonplaats</th>";
        $txt .= "<th>Acties</th>";
        $txt .= "</tr>";

        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .= "<td>" . $row["klantNaam"] . "</td>";
            $txt .= "<td>" . $row["klantEmail"] . "</td>";
            $txt .= "<td>" . $row["klantAdres"] . "</td>";
            $txt .= "<td>" . $row["klantPostcode"] . "</td>";
            $txt .= "<td>" . $row["klantWoonplaats"] . "</td>";
            $txt .= "<td>";
            $txt .= "<form method='get' action='update.php' style='display:inline;'>";
            $txt .= "<input type='hidden' name='klantId' value='" . $row['klantId'] . "'>";
            $txt .= "<button type='submit' name='update'>Updaten</button>";
            $txt .= "</form>";
            $txt .= "<form method='post' action='delete.php' style='display:inline;'>";
            $txt .= "<input type='hidden' name='klantId' value='" . $row['klantId'] . "'>";
            $txt .= "<button type='submit' name='verwijderen'>Verwijderen</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }

    // Delete klant
    public function deleteKlant(int $klantId): bool {
        try {
            // Prepare the SQL query
            $query = "DELETE FROM Klant WHERE klantId = :klantId";

            // Prepare the statement
            $stmt = self::$conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':klantId', $klantId, PDO::PARAM_INT);

            // Execute the statement
            if ($stmt->execute()) {
                // Deletion successful
                return true;
            } else {
                // Deletion failed
                return false;
            }
        } catch (PDOException $e) {
            // Error occurred
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Update klant
    public function updateKlant(array $row): bool {
        // Controleer of klantId is ingesteld
        if (!isset($row['klantId']) || empty($row['klantId'])) {
            // Geen klantId opgegeven
            echo "Geen klantId opgegeven.";
            return false;
        }

        try {
            // Extract data from $row array
            $klantId = $row['klantId'];
            $klantNaam = $row['klantNaam'];
            $klantEmail = $row['klantEmail'];
            $klantAdres = $row['klantAdres'];
            $klantPostcode = $row['klantPostcode'];
            $klantWoonplaats = $row['klantWoonplaats'];

            // Prepare the SQL query
            $query = "UPDATE Klant SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId";

            // Prepare the statement
            $stmt = self::$conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':klantId', $klantId, PDO::PARAM_INT);
            $stmt->bindParam(':klantNaam', $klantNaam);
            $stmt->bindParam(':klantEmail', $klantEmail);
            $stmt->bindParam(':klantAdres', $klantAdres);
            $stmt->bindParam(':klantPostcode', $klantPostcode);
            $stmt->bindParam(':klantWoonplaats', $klantWoonplaats);

            // Execute the statement
            if ($stmt->execute()) {
                // Update succesvol
                return true;
            } else {
                // Update mislukt
                echo "Er is een fout opgetreden bij het uitvoeren van de update.";
                return false;
            }
        } catch (PDOException $e) {
            // Fout opgetreden
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}



?>
