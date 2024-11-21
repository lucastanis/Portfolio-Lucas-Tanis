<?php
// auteur: Lucas Tanis
// functie: Definitie Class Klant
namespace Bas\classes;

use Bas\classes\Database;
use PDOException;

include_once "functions.php";

class Klant extends Database
{
    public $klantId;
    public $klantnaam;
    public $klantemail = null;
    public $klantadres;
    public $klantwoonplaats;
    public $klantpostcode;
    private $table_name = "klant";

    // Methods

    /**
     * Summary of crudKlant
     * @return void
     */
    public function crudKlant($searchKlantId = null): void
    {
        // Haal alle klant(en) op uit de database mbv de method getKlant() of getKlanten()

        if ($searchKlantId){
            $lijst = $this->getKlant($searchKlantId);
            if (empty($lijst[0]['klantId'])){
                echo '<script>alert("Klant bestaat niet")</script>';
                echo "<script> location.replace('read.php'); </script>";
            }
        } else {
            $lijst = $this->getKlanten();
        }

        // Print een HTML tabel van de lijst

        $this->showKlanten($lijst);

    }

    /**
     * Summary of getKlanten
     * @return mixed
     */
    public function getKlanten(): array
    {

        $conn = $this->getConnection();

        $lijst = $conn->query("SELECT * FROM klant")->fetchAll();

        return $lijst;
    }

    /**
     * Summary of getKlant
     * @param int $klantId
     * @return mixed
     */
    public function getKlant(int $klantId): array
    {
        $conn = $this->getConnection();

        $lijst = $conn->query("SELECT * FROM klant WHERE klantId = $klantId")->fetchAll();

        return $lijst;
    }


    /**
     * Summary of showTable
     * @param mixed $lijst
     * @return void
     */
    public function showKlanten($lijst): void
    {

        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        $txt .= getTableHeader($lijst[0]);

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["klantId"] . "</td>";
            $txt .= "<td>" . $row["klantNaam"] . "</td>";
            $txt .= "<td>" . $row["klantEmail"] . "</td>";
            $txt .= "<td>" . $row["klantAdres"] . "</td>";
            $txt .= "<td>" . $row["klantPostcode"] . "</td>";
            $txt .= "<td>" . $row["klantWoonplaats"] . "</td>";

            //Update
            $txt .= "<td>";
            $txt .= " 
            <form method='post' action='update.php?klantId=$row[klantId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";

            //Delete
            $txt .= "<td>";
            $txt .= " 
            <form method='post' action='delete.php?klantId=$row[klantId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";

        echo $txt;
    }


    // Delete klant

    /**
     * Summary of deleteKlant
     * @param int $klantId
     * @return bool
     */
    public function deleteKlant(int $klantId): bool
    {

        $stmt = $this->getConnection()->prepare("DELETE FROM klant WHERE klantId = :klantId");
        $stmt->bindParam(':klantId', $klantId);
        return $stmt->execute();

    }

    public function updateKlant($data): bool {
        try {
            $sql = "UPDATE klant SET 
                        klantNaam = :klantNaam, 
                        klantEmail = :klantEmail, 
                        klantAdres = :klantAdres, 
                        klantPostcode = :klantPostcode, 
                        klantWoonplaats = :klantWoonplaats
                        WHERE klantId = :klantId";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':klantId', $data['klantId']);
            $stmt->bindParam(':klantNaam', $data['klantNaam']);
            $stmt->bindParam(':klantEmail', $data['klantEmail']);
            $stmt->bindParam(':klantAdres', $data['klantAdres']);
            $stmt->bindParam(':klantPostcode', $data['klantPostcode']);
            $stmt->bindParam(':klantWoonplaats', $data['klantWoonplaats']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function DropDownKlant($row_selected = -1): void {

        $lijst = $this->getKlanten();
        $klanten = [];

        echo "<label for='Klant'>Klantnaam: </label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            if (!in_array($row["klantNaam"], $klanten)) {
                $selected = ($row_selected == $row["klantNaam"]) ? "selected" : "";
                echo "<option value='{$row['klantId']}' $selected>{$row['klantNaam']}</option>\n";
                $klanten[] = $row["klantNaam"];
            }
        }
        echo "</select>";
    }

    /**
     * Summary of BepMaxKlantId
     * @return int
     */
    private function BepMaxKlantId(): int
    {

        // Bepaal uniek nummer
        $sql = "SELECT MAX(klantId)+1 FROM $this->table_name";
        return (int)self::$conn->query($sql)->fetchColumn();
    }

    /**
     * Summary of insertKlant
     * @param mixed $row
     * @return mixed
     */

    public function insertKlant($row): bool
    {
        try {
            // Bepaal een unieke klantId
            $klantId = $this->BepMaxKlantId();

            // Haal de waarden uit het $_POST array
            $naam = $row['klantNaam'];
            $email = $row['klantEmail'];
            $adres = $row['klantAdres'];
            $postcode = $row['klantPostcode'];
            $plaats = $row['klantWoonplaats'];

            // Query
            $sql = "INSERT INTO klant (klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
                VALUES (:klantId, :naam, :email, :adres, :postcode, :plaats)";

            // Prepare and execute the query
            $conn = $this->getConnection();

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':plaats', $plaats);

            $stmt->execute();

            return "Nieuwe klant toegevoegd met klantId: " . $klantId;


        } catch (PDOException $e) {
            return "Fout bij het toevoegen van klant: " . $e->getMessage();
        }
    }
}

?>