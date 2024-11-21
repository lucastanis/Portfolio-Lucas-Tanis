<?php 
// auteur: Lucas Tanis
// functie: Klant Verwijderen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["verwijderen"])){
	
	// Maak een object Klant

	$klant = new Klant();

	// Delete the customer
	$klantId = $_GET['klantId'];

	$klant->deleteKlant($klantId);


	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



