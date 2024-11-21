<?php

// Auteur: Lucas Tanis
// Function: artikel verwijderen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if(isset($_POST["verwijderen"])){

    // Maak een object Artikel

    $artikel = new Artikel();

    // Delete the customer
    $artId = $_GET['artId'];

    $artikel->deleteArtikel($artId);


    echo '<script>alert("Artikel verwijderd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}
?>



