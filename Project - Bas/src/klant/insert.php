<?php
//  Auteur: Lucas Tanis
//	Function: Klant Toevoegen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

    $Klant = new Klant;
    $Klant->insertKlant($_POST);

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

<h1>CRUD Klant</h1>
<h2>Toevoegen</h2>

<form method="post" action="">

    <label for="name">Klantnaam:</label>
    <input type="text" name="klantNaam" placeholder="Klantnaam" */></br>

    <label for="mail">Klantemail:</label>
    <input type="text" name="klantEmail" placeholder="Klantemail" */><br>

    <label for="adress">KlantAdres:</label>
    <input type="text" name="klantAdres" placeholder="klantAdres" */></br>

    <label for="code">KlantPostcode:</label>
    <input type="text" name="klantPostcode" placeholder="klantPostcode" */></br>

    <label for="place">KlantWoonplaats:</label>
    <input type="text" name="klantWoonplaats" placeholder="klantWoonplaats" */></br>

    </br>
    <input type='submit' name='insert' value='Toevoegen'>

</form>

</br>

<a href='read.php'>Terug</a>

</body>
</html>