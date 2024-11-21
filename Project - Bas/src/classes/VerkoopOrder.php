<?php
// auteur: Lucas Tanis
// functie: Definitie Class Klant
namespace Bas\classes;
use Bas\classes\Database;

include_once "functions.php";

class VerkoopOrder extends Database
{
    public $verkOrdId;
    public $klantId;
    public $artId;
    public $verkOrdDatum;
    public $verkOrdBestAantal;
    public $verkOrdStatus;
    private $table_name = "verkoop";

    // Methods

    public function crudVerkoopOrder($searchVerkOrdId = null): void
    {
        // Haal alle Verkoop order op uit de database mbv de method getVerkoopOrder() of getVerkoopOrders()

        if ($searchVerkOrdId){
            $lijst = $this->getVerkoopOrder($searchVerkOrdId);
            if (empty($lijst[0]['verkOrdId'])){
                echo '<script>alert("Order bestaat niet")</script>';
                echo "<script> location.replace('read.php'); </script>";
            }
        } else {
            $lijst = $this->getVerkoopOrders();
        }

        // Print een HTML tabel van de lijst
        $this->showVerkoopOrder($lijst);
    }

    /**
     * Summary of getVerkoopOrder
     * @return mixed
     */
    public function getVerkoopOrders(): array
    {

        $conn = $this->getConnection();

        $lijst = $conn->query("SELECT * FROM verkoop")->fetchAll();

        return $lijst;
    }
    public function getVerkoopOrder(int $verkOrdId): array
    {

        $conn = $this->getConnection();

        $lijst = $conn->query("SELECT * FROM verkoop WHERE verkOrdId = $verkOrdId")->fetchAll();

        return $lijst;
    }

    public function showVerkoopOrder($lijst): void
    {

        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        $txt .= getTableHeader($lijst[0]);

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["verkOrdId"] . "</td>"; //dropdown
            $txt .= "<td>" . $row["klantId"] . "</td>";
            $txt .= "<td>" . $row["artId"] . "</td>";
            $txt .= "<td>" . $row["verkOrdDatum"] . "</td>";
            $txt .= "<td>" . $row["verkOrdBestAantal"] . "</td>";
            $txt .= "<td>" . $row["verkOrdStatus"] . "</td>";


            //Update
            // Wijzig knopje
            $txt .= "<td>";
            $txt .= " 
            <form method='post' action='update.php?verkOrdId=$row[verkOrdId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";

            //Delete
            $txt .= "<td>";
            $txt .= " 
            <form method='post' action='delete.php?verkOrdId=$row[verkOrdId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    public function deleteVerkoopOrder(int $verkOrdId): bool
    {

        $stmt = $this->getConnection()->prepare("DELETE FROM verkoop WHERE verkOrdId = :verkOrdId");
        $stmt->bindParam(':verkOrdId', $verkOrdId);
        return $stmt->execute();

    }

    public function updateVerkooporder($data): bool {
        try {
            $sql = "UPDATE verkoop SET 
                        klantId = :klantId, 
                        artId = :artId, 
                        verkOrdDatum = :verkOrdDatum, 
                        verkOrdBestAantal = :verkOrdBestAantal,
                        verkOrdStatus = :verkOrdStatus
                        WHERE verkOrdId = :verkOrdId";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':verkOrdId', $data['verkOrdId']);
            $stmt->bindParam(':klantId', $data['klantId']);
            $stmt->bindParam(':artId', $data['artId']);
            $stmt->bindParam(':verkOrdDatum', $data['verkOrdDatum']);
            $stmt->bindParam(':verkOrdBestAantal', $data['verkOrdBestAantal']);
            $stmt->bindParam(':verkOrdStatus', $data['verkOrdStatus']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function DropDownOrdStatus($row_selected = -1): void {

        $lijst = $this->getVerkoopOrders();
        $addedStatuses = [];

        echo "<label for='Orderstatus'>Orderstatus: </label>";
        echo "<select name='verkOrdStatus'>";

//        $status = [
//            1 => "Genoteerd in deze tabel",
//            2 => "Magazijnmedewerker verzamelt het artikel (picking)",
//            3 => "Tas met artikel is bij de bezorger",
//            4 => "Tas met artikel is afgeleverd bij de klant"
//        ];

        foreach ($lijst as $row) {

            if (!in_array($row["verkOrdStatus"], $addedStatuses)) {
                $selected = ($row_selected == $row["verkOrdStatus"]) ? "selected" : "";
                echo "<option value='{$row['verkOrdStatus']}' $selected>{$row["verkOrdStatus"]}</option>\n";
            }
        }

        echo "</select>";
    }

    /**
     * Summary of BepMaxVerkOrdId
     * @return int
     */
    private function BepMaxVerkOrdId(): int
    {

        // Bepaal uniek nummer
        $sql = "SELECT MAX(verkOrdId)+1 FROM $this->table_name";
        return (int)self::$conn->query($sql)->fetchColumn();
    }


    /**
     * Summary of insertVerkoopOrder
     * @param mixed $row
     * @return mixed
     */

    public function insertVerkoopOrder($row): bool
    {
        try {

            // Bepaal een unieke verkOrdId
            $verkOrdId = $this->BepMaxVerkOrdId();

            // Haal de waarden uit het $row array
            $klantId = $row['klantId'];
            $artId = $row['artId'];
            $verkOrdDatum = $row['verkOrdDatum'];
            $verkOrdBestAantal = $row['verkOrdBestAantal'];
            $verkOrdStatus = $row['verkOrdStatus'];

            // Query
            $sql = "INSERT INTO verkoop (verkOrdId, klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:verkOrdId, :klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";

            // Prepare and execute the query
            $conn = $this->getConnection();

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':verkOrdId', $verkOrdId);
            $stmt->bindParam(':klantId', $klantId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':verkOrdDatum', $verkOrdDatum);
            $stmt->bindParam(':verkOrdBestAantal', $verkOrdBestAantal);
            $stmt->bindParam(':verkOrdStatus', $verkOrdStatus);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            error_log("Fout bij het toevoegen van verkoopOrder: " . $e->getMessage());
            return false;
        }
    }


}