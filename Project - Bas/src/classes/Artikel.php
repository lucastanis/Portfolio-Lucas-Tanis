<?php
// auteur: Lucas Tanis
// functie: Defenitie Class Artikel
namespace Bas\classes;

use Bas\classes\Database;

include_once "functions.php";

class Artikel extends Database
{
    public $artId;
    public $artOmschrijving;
    public $artInkoop;
    public $artVerkoop;
    public $artVoorraad;
    public $artMinVoorraad;
    public $artMaxVoorraad;
    public $artLocatie;
    private $table_name = "artikel";

    // Methods

    public function crudArtikel($searchArtId = null): void
    {
        // Haal alle Artikel(en) op uit de database mbv de method getArtikel() of getArtikelen

        if ($searchArtId){
            $lijst = $this->getArtikel($searchArtId);
            if (empty($lijst[0]['artId'])){
                echo '<script>alert("Artikel bestaat niet")</script>';
                echo "<script> location.replace('read.php'); </script>";
            }
        } else {
            $lijst = $this->getArtikelen();
        }

        // Print een HTML tabel van de lijst
        $this->showArtikel($lijst);
    }

    /**
     * Summary of getArtikel
     * @return mixed
     */
    public function getArtikelen(): array
    {

        $conn = $this->getConnection();

        $lijst = $conn->query("SELECT * FROM artikel")->fetchAll();

        return $lijst;
    }

    public function getArtikel($artId): array
    {

        $conn = $this->getConnection();

        $lijst = $conn->query("SELECT * FROM artikel WHERE artid = $artId")->fetchAll();

        return $lijst;
    }

    public function showArtikel($lijst): void
    {

        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        $txt .= getTableHeader($lijst[0]);

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["artId"] . "</td>";
            $txt .= "<td>" . $row["artOmschrijving"] . "</td>";
            $txt .= "<td>" . $row["artInkoop"] . "</td>";
            $txt .= "<td>" . $row["artVerkoop"] . "</td>";
            $txt .= "<td>" . $row["artVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artMinVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artMaxVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artLocatie"] . "</td>";

            //Update
            // Wijzig knopje
            $txt .= "<td>";
            $txt .= " 
            <form method='post' action='update.php?artId=$row[artId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";

            //Delete
            $txt .= "<td>";
            $txt .= " 
            <form method='post' action='delete.php?artId=$row[artId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    // Delete artikel

    /**
     * Summary of deleteKlant
     * @param int $artId
     * @return bool
     */
    public function deleteArtikel(int $artId): bool
    {

        $stmt = $this->getConnection()->prepare("DELETE FROM artikel WHERE artId = :artId");
        $stmt->bindParam(':artId', $artId);
        return $stmt->execute();

    }

    public function updateArtikel($data): bool {
        try {
            $sql = "UPDATE artikel SET 
                        artOmschrijving = :artOmschrijving, 
                        artInkoop = :artInkoop, 
                        artVerkoop = :artVerkoop, 
                        artVoorraad = :artVoorraad, 
                        artMinVoorraad = :artMinVoorraad,
                        artMaxVoorraad = :artMaxVoorraad,
                        artLocatie = :artLocatie
                        WHERE artId = :artId";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':artId', $data['artId']);
            $stmt->bindParam(':artOmschrijving', $data['artOmschrijving']);
            $stmt->bindParam(':artInkoop', $data['artInkoop']);
            $stmt->bindParam(':artVerkoop', $data['artVerkoop']);
            $stmt->bindParam(':artVoorraad', $data['artVoorraad']);
            $stmt->bindParam(':artMinVoorraad', $data['artMinVoorraad']);
            $stmt->bindParam(':artMaxVoorraad', $data['artMaxVoorraad']);
            $stmt->bindParam(':artLocatie', $data['artLocatie']);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function DropDownArtikel($row_selected = -1): void {

        $lijst = $this->getArtikelen();
        $artikelen = [];

        echo "<label for='Artikel'>Artikel: </label>";
        echo "<select name='artId'>";

        foreach ($lijst as $row) {

            if (!in_array($row["artOmschrijving"], $artikelen)) {
                $selected = ($row_selected == $row["artOmschrijving"]) ? "selected" : "";
                echo "<option value='{$row['artId']}' $selected>{$row['artOmschrijving']}</option>\n";
                $artikelen[] = $row["artOmschrijving"];
            }

        }
        echo "</select>";
    }

    public function DropDownLocatie($row_selected = -1): void {

        $lijst = $this->getArtikelen();
        $locaties = [];

        echo "<label for='Locatie'>Locatie: </label>";
        echo "<select name='artLocatie'>";

        foreach ($lijst as $row) {
            if (!in_array($row["artLocatie"], $locaties)) {
                $selected = ($row_selected == $row["artLocatie"]) ? "selected" : "";
                echo "<option value='{$row['artLocatie']}' $selected>{$row['artLocatie']}</option>\n";
                $locaties[] = $row["artLocatie"];
            }
        }
        echo "</select>";
    }

    /**
     * Summary of BepMaxArtikelId
     * @return int
     */
    private function BepMaxArtikelId(): int
    {

        // Bepaal uniek nummer
        $sql = "SELECT MAX(artId)+1 FROM $this->table_name";
        return (int)self::$conn->query($sql)->fetchColumn();
    }


    /**
     * Summary of insertArtikel
     * @param mixed $row
     * @return mixed
     */

    public function insertArtikel($row): bool
    {
        try {
            // Bepaal een unieke artId
            $artId = $this->BepMaxArtikelId();

            // Haal de waarden uit het $_POST array
            $artOmschrijving = $row['artOmschrijving'];
            $artInkoop = $row['artInkoop'];
            $artVerkoop = $row['artVerkoop'];
            $artVoorraad = $row['artVoorraad'];
            $artMinVoorraad = $row['artMinVoorraad'];
            $artMaxVoorraad = $row['artMaxVoorraad'];
            $artLocatie = $row['artLocatie'];

            // Query
            $sql = "INSERT INTO artikel (artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                VALUES (:artId, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie )";

            // Prepare and execute the query
            $conn = $this->getConnection();

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':artOmschrijving', $artOmschrijving);
            $stmt->bindParam(':artInkoop', $artInkoop);
            $stmt->bindParam(':artVerkoop', $artVerkoop);
            $stmt->bindParam(':artVoorraad', $artVoorraad);
            $stmt->bindParam(':artMinVoorraad', $artMinVoorraad);
            $stmt->bindParam(':artMaxVoorraad', $artMaxVoorraad);
            $stmt->bindParam(':artLocatie', $artLocatie);

            $stmt->execute();

            return "Nieuwe klant toegevoegd met artikelId: " . $artId;


        } catch (PDOException $e) {
            return "Fout bij het toevoegen van artikel: " . $e->getMessage();
        }
    }

}