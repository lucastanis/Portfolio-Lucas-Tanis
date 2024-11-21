<?php
// auteur: Erik van der Wiel
// functie: Artikel Toevoegen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

    $artikel = new Artikel;
    $artikel->insertArtikel($_POST);

    header("Location: read.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h1>CRUD Artikel</h1>
<h2>Toevoegen</h2>
<form method="post">
    <label for="Artikel">Artikel:</label>
    <input type="text" id="nv" name="artOmschrijving" placeholder="artOmschrijving" required/>
    <br>
    <label for="Inkoop">Inkoopprijs:</label>
    <input type="text" id="an" name="artInkoop" placeholder="artInkoop" required/>
    <br>
    <label for="Verkoop">Verkoopprijs:</label>
    <input type="text" id="an" name="artVerkoop" placeholder="artVerkoop" required/>
    <br>
    <label for="Voorraad">Voorraad:</label>
    <input type="text" id="an" name="artVoorraad" placeholder="artVoorraad" required/>
    <br>
    <label for="MinVoorraad">Minimale Voorraad:</label>
    <input type="text" id="an" name="artMinVoorraad" placeholder="artMinVoorraad" required/>
    <br>
    <label for="MaxVoorraad">Maximale Voorraad:</label>
    <input type="text" id="an" name="artMaxVoorraad" placeholder="artMaxVoorraad" required/>
    <br>
    <label for="Locatie">Locatie:</label>
    <select name="artLocatie">
    <option value="Kies">Kies een locatie</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    </select>
    <br><br>
    <input type='submit' name='insert' value='Toevoegen'>
</form></br>

<a href='read.php'>Terug</a>

</body>
</html>



