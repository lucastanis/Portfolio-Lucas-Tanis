<!--
	Auteur: Lucas Tanis
	Function: Home Page CRUD VerkoopOrder
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
<h1>CRUD VerkoopOrder</h1>
<nav>
    <a href='../index.html'>Home</a><br>
    <a href='insert.php'>Toevoegen nieuwe VerkoopOrder</a><br><br>
</nav>

<form method="GET">
    <label for="searchVerkOrdId">Zoek op Verkooporder</label>
    <input type="number" id="searchVerkOrdId" name="searchVerkOrdId">
    <button type="submit">Zoek</button>
</form>
<br>

<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\VerkoopOrder;

// Maak een object VerkoopOrder
$verOrder = new VerkoopOrder;
$searchVerkOrdId = $_GET['searchVerkOrdId'] ?? null;

// Start CRUD
$verOrder->crudVerkoopOrder($searchVerkOrdId);

?>
</body>
</html>