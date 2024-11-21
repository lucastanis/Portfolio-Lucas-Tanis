<?php
// auteur: Lucas Tanis
// functie: VerkoopOrder Verwijderen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\VerkoopOrder;

if(isset($_POST["verwijderen"])){

    // Maak een object VerkoopOrder

    $order = new VerkoopOrder();

    // Delete the customer
    $verkOrdId = $_GET['verkOrdId'];

    $order->deleteVerkoopOrder($verkOrdId);


    echo '<script>alert("verkoop order verwijderd")</script>';
    echo "<script> location.replace('read.php'); </script>";
}
?>



