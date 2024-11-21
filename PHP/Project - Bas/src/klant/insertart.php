<?php
// auteur: Lucas Tanis
// functie: insert class Artikel

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Database;
use Bas\classes\Artikel;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $database = new Database();
    $db = $database->getConnection();

    $artikel = new Artikel($db);
    if($artikel->toevoegenArtikel($_POST)) {
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
    <h1>Artikelen toevoegen</h1>
    <form method="post">
        <label for="nv">Artikelomschrijving:</label>
        <input type="text" id="nv" name="artOmschrijving" placeholder="artikelomschrijving" required/>
        <br>   
        <label for="an">Artikelinkoop:</label>
        <input type="text" id="an" name="artInkoop" placeholder="artikelinkoop" required/>
        <br>
        <label for="av">Artikelverkoop:</label>
        <input type="text" id="av" name="artVerkoop" placeholder="artikelverkoop" required/>
        <br>
        <label for="af">Artikelvoorraad:</label>
        <input type="text" id="af" name="artVoorraad" placeholder="artikelvoorraad" required/>
        <br>  
        <label for="amv">Artikel Min Voorraad:</label>
        <input type="text" id="amv" name="artMinVoorraad" placeholder="artikelMinVoorraad" required/>
        <br>    
        <label for="amxv">Artikel Max Voorraad:</label>
        <input type="text" id="amxv" name="artMaxVoorraad" placeholder="artikelMaxVoorraad" required/>
        <br>
        <label for="al">Artikel Locatie:</label>
        <input type="text" id="al" name="artLocatie" placeholder="artikelLocatie" required/>
        <br>
        <br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>
    <a href="../index.html">Terug</a>
</body>
</html>
