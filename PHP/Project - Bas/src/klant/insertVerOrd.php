<?php
// auteur: Lucas Tanis
// functie: Insert class Artikel
 
require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Verkooporder;
use Bas\classes\Klant;
Use Bas\classes\Artikel;
 
if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $database = new Database();
    $db = $database->getConnection();
    $v = new Verkooporder;
    $v->toevoegenVerkoop($_POST);
    
    if($_SESSION['verkoopordercheck']) {
        echo "<script> alert('Data Inserted successfully'); </script>";
    } else {
        echo "<script> alert('Data Insertion failed'); </script>";
    }
}

?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
    <h1>Verkooporder toevoegen</h1>
    <h2>Toevoegen</h2>
    <form method="post">
        <?php
        $klant = new Klant();
        $klant->dropDownKlant();
        ?>
        <br>
        <?php
        $artikel = new Artikel();
        $artikel->dropDownArtikel   ();
        ?>
        <br>
    <label for="nv">verkOrdDatum:</label>
    <input type="text" id="nv" name="verkOrdDatum" placeholder="verkOrdDatum" required/>
    <br>
    <label for="nv">verkOrdBestAantal:</label>
    <input type="text" id="nv" name="verkOrdBestAantal" placeholder="verkOrdBestAantal" required/>
    <br>
    <label for="nv">Status:</label>
    <select id="nv" name="verkOrdStatus" required>
    <option value="">Selecteer Status</option>
    <option value="verkOrdStatus">1</option>
    <option value="verkOrdStatus">2</option>
</select>

    <br>
    <input type='submit' name='insert' value='Toevoegen'>
    </form></br>
 
    <a href='verkoop.php'>Terug</a>
 
</body>
</html>