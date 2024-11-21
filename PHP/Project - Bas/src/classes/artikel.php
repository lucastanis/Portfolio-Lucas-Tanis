<?php

namespace Bas\classes;

use PDO;

class Artikel extends Database{

    private $table = 'artikel';

    public $artOmschrijving;
    public $artInkoop;
    public $artVerkoop;
    public $artVoorraad;
    public $artMinVoorraad;
    public $artMaxVoorraad;
    public $artLocatie;


    public function toevoegenArtikel($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                  VALUES (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':artOmschrijving', $data["artOmschrijving"]);
        $stmt->bindParam(':artInkoop', $data["artInkoop"]);
        $stmt->bindParam(':artVerkoop', $data["artVerkoop"]);
        $stmt->bindParam(':artVoorraad', $data["artVoorraad"]);
        $stmt->bindParam(':artMinVoorraad', $data["artMinVoorraad"]);
        $stmt->bindParam(':artMaxVoorraad', $data["artMaxVoorraad"]);
        $stmt->bindParam(':artLocatie', $data["artLocatie"]);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }
    }


    public function getArtikel()
    {
       
        $sql = "SELECT * FROM artikel";
        $result = self::$conn->prepare($sql);
        $result->execute();
 
        return $result;
    }
     
    public function dropDownArtikel($row_selected = -1)
    {
 
        // Haal alle klanten op uit de database mbv de method getKlanten()
        $lijst = $this->getArtikel();
 
        echo "<label for='Artikel'>ArtOmschrijving:</label>";
        echo "<select name='artOmschrijving'>";
        foreach ($lijst as $row) {
            if ($row_selected == $row["artOmschrijving"]) {
                echo "<option value='$row[artId]' selected='selected'> $row[artOmschrijving]</option>\n";
            } else {
                echo "<option value='$row[artId]'> $row[artOmschrijving]</option>\n";
            }
        }
        echo "</select>";
    }

    public function showTable($lijst) {
        $txt = "<table>";
        $txt .= "<tr>";
        $txt .= "<th>artOmschrijving</th>";
        $txt .= "<th>artInkoop</th>";
        $txt .= "<th>artVerkoop</th>";
        $txt .= "<th>artVoorraad</th>";
        $txt .= "<th>artMinVoorraad</th>";
        $txt .= "<th>artMaxVoorraad</th>";
        $txt .= "<th>artLocatie</th>";
        $txt .= "</tr>";
 
        foreach($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["artOmschrijving"] . "</td>";
            $txt .= "<td>" . $row["artInkoop"] . "</td>";
            $txt .= "<td>" . $row["artVerkoop"] . "</td>";
            $txt .= "<td>" . $row["artVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artMinVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artMaxVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artLocatie"] . "</td>";
            $txt .= "<td>";
            $txt .= "<form method='post' action='update.php'>";
            $txt .= "<input type='hidden' name='artId' value='" . $row['artId'] . "'>";
            $txt .= "<button type='submit' name='update'>Update</button>";
            $txt .= "</form>";
            $txt .= "<form method='post' action='../klant/deleteArtikel.php'>";
            $txt .= "<input type='hidden' name='artId' value='" . $row['artId'] . "'>";
            $txt .= "<button type='submit' name='verwijderen'>Verwijderen</button>";
            $txt .= "</form>";
            $txt .= "</td>";
            $txt .= "</tr>";
        }
       
 
 
        $txt .= "</table>";
        echo $txt;
    }

    public function crudArtikel(): void {
        // Haal alle artikelen op uit de database mbv de method getArtikelen()
        $lijst = $this->getArtikelen();
 
        // Print een HTML tabel van de lijst
        $this->showTable($lijst);
    }

    public function getArtikelen() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
 

}
?>