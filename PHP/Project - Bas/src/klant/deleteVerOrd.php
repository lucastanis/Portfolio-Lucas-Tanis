<?php
// auteur: Lucas Tanis
// functie: Artikel verwijderen
require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;
 
if (isset($_POST['verwijderen'])) {
 
    $artId = $_POST['artId'];
    if (empty($artId)) {
        echo '<script>alert("Geen Artikel ID ontvangen")</script>';
        exit;
    }
    echo "Artikel ID to delete: " . $artId . "<br>";
   
    $verkooporder = new Verkooporder();
 
    $success = $verkooporder->deleteVerkoop($artId);
    if ($success) {
        echo '<script>alert("Artikel verwijderd")</script>';  
    } else {
        echo '<script>alert("Artikel verwijderen mislukt")</script>';
    }
 
    echo "<script> location.replace('verkoop.php'); </script>";
} else {
    echo 'Invalid request';
}
?>