<!--
    Auteur: Lucas Tanis
    Function: home page CRUD Klant
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
    <div>
    <h1>Artikel</h1>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='../klant/insertart.php'>Toevoegen nieuwe artikel</a><br><br>
    </nav>
   
<?php
 
// Autoloader classes via composer
require '../../vendor/autoload.php';
 
use Bas\classes\Artikel;
 
// Maak een object Klant.
$artikel = new Artikel;
 
// Start CRUD
$artikel->crudartikel();
 
?>
</body>
</html>