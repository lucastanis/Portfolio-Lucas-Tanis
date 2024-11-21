<?php
// functie: Update Klant Pagina

require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant;

if (isset($_GET['klantId']) && !empty($_GET['klantId'])){
    $row = $klant->getKlant($_GET['klantId']);
} else {
    echo "Geen klantId opgegeven<br>";
    // Extra debuginformatie
    if (!isset($_GET['klantId'])) {
        echo "klantId is niet ingesteld in de URL.<br>";
    } elseif (empty($_GET['klantId'])) {
        echo "klantId is leeg.<br>";
    }
    exit; // Stop verdere uitvoering als klantId niet is opgegeven
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>    
<form method="post">
    <input type="hidden" name="klantId" value="<?php if(isset($row)) { echo $row['klantId']; } ?>">
    <input type="text" name="klantnaam" required value="<?php if(isset($row)) { echo $row['klantNaam']; } ?>"> *</br>
    <input type="email" name="klantemail" required value="<?php if(isset($row)) { echo $row['klantEmail']; } ?>"> *</br>
    <input type="text" name="klantadres" required value="<?php if(isset($row)) { echo $row['klantAdres']; } ?>"> *</br>
    <input type="text" name="klantPostcode" required value="<?php if(isset($row)) { echo $row['klantPostcode']; } ?>"> *</br>
    <input type="text" name="klantWoonplaats" required value="<?php if(isset($row)) { echo $row['klantWoonplaats']; } ?>"> *</br>
    </br>
    <button type="submit" name="update" value="Update Customer">Update Customer</button>
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
if(isset($_POST["update"]) && $_POST["update"] == "Update Customer"){
    if(isset($_POST['klantId'], $_POST['klantnaam'], $_POST['klantemail'], $_POST['klantadres'], $_POST['klantPostcode'], $_POST['klantWoonplaats'])){

        $klantData = array(
            'klantId' => $_POST['klantId'],
            'klantNaam' => $_POST['klantnaam'],
            'klantEmail' => $_POST['klantemail'],
            'klantAdres' => $_POST['klantadres'],
            'klantPostcode' => $_POST['klantPostcode'],
            'klantWoonplaats' => $_POST['klantWoonplaats']
        );

        $klant->updateKlant($klantData);
    } else {
        echo "Vul alle vereiste velden in.";
        // Extra debuginformatie
        if (!isset($_POST['klantId'])) {
            echo "klantId is niet ingesteld in het POST-verzoek.<br>";
        }
        if (!isset($_POST['klantnaam'])) {
            echo "klantnaam is niet ingesteld in het POST-verzoek.<br>";
        }
        if (!isset($_POST['klantemail'])) {
            echo "klantemail is niet ingesteld in het POST-verzoek.<br>";
        }
        if (!isset($_POST['klantadres'])) {
            echo "klantadres is niet ingesteld in het POST-verzoek.<br>";
        }
        if (!isset($_POST['klantPostcode'])) {
            echo "klantPostcode is niet ingesteld in het POST-verzoek.<br>";
        }
        if (!isset($_POST['klantWoonplaats'])) {
            echo "klantWoonplaats is niet ingesteld in het POST-verzoek.<br>";
        }
    }
}
?>
