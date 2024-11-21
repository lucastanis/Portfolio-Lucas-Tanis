<!--
	Auteur: Lucas Tanis
	Function: Home Page CRUD
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
	<h1>CRUD Klant</h1>
	<nav>
		<a href='../index.html'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe klant</a><br><br>
	</nav>

    <form method="GET">
        <label for="searchKlantId">Zoek op Klant:</label>
        <input type="number" id="searchKlantId" name="searchKlantId">
        <button type="submit">Zoek</button>
    </form>
<br>

<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Klant;

// Maak een object Klant
$klant = new Klant;
$searchKlantId = $_GET['searchKlantId'] ?? null;

// Start CRUD
$klant->crudKlant($searchKlantId);

?>
</body>
</html>