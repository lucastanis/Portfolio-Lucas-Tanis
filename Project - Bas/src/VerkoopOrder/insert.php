<?php
// auteur: Lucas Tanis
// functie: Verkooporder Toevoegen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\VerkoopOrder;
use Bas\classes\Klant;
use Bas\classes\Artikel;

$klant = new Klant;
$artikel = new Artikel;
$verOrder = new VerkoopOrder;

$lijst = $verOrder->getVerkoopOrders();

$klantId = $lijst[0]["klantId"];
$verOrderId = $lijst[0]["verkOrdId"];
$artId = $lijst[0]["artId"];

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

    $verOrder = new VerkoopOrder;
    $verOrder->insertVerkoopOrder($_POST);

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

<h1>CRUD VerkoopOrder</h1>
<h2>Toevoegen</h2>

<form method="post">

    <?php $klant->DropDownKlant($klantId); ?> *</br>

    <?php $artikel->DropDownArtikel($artId); ?> *</br>

    <label for="datum">Datum:</label>
    <input type="text" name="verkOrdDatum" placeholder="verkOrdDatum"/> *<br>

    <label for="aantal">Aantal: </label>
    <input type="text" name="verkOrdBestAantal" placeholder="verkOrdBestAantal"/> *<br>

    <label for='Orderstatus'>Orderstatus: </label>
    <select name='verkOrdStatus'>
        <option value='kies'>Kies een status</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
    </select> *<br>

    <input type='submit' name='insert' value='Toevoegen'>
</form></br>

<a href='read.php'>Terug</a>

</body>
</html>



