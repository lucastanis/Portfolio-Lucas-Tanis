<?php
    // auteur: Lucas Tanis
    // functie: Update Class Klant

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\Klant;

    $klant = new Klant;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $klantId = $_POST["klantId"];
        $conn = $klant->getConnection();

        $array = $conn->query("SELECT klantNaam FROM klant WHERE klantId = $klantId")->fetch();

        $naam = implode(',', $array);

        print_r($naam);

        $data = [
            'klantId' => $_GET['klantId'],
            'klantNaam' => $naam,
            'klantEmail' => $_POST['klantEmail'],
            'klantAdres' => $_POST['klantAdres'],
            'klantPostcode' => $_POST['klantPostcode'],
            'klantWoonplaats' => $_POST['klantWoonplaats'],
        ];
        print_r($data);

        if ($klant->updateKlant($data)) {
            echo '<script>alert("Klant succesvol bijgewerkt."); location.replace("read.php");</script>';
        } else {
            echo '<script>alert("Er is een fout opgetreden bij het bijwerken van de klant.");</script>';
        }

    }

if (isset($_GET['klantId'])){

    $row = $klant->getKlant($_GET['klantId']);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>

<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>

<form method="post">

    <input type="hidden" name="klantId" value="<?php if(isset($row)) { echo $row[0]['klantId']; }  ?>">

    <?php $klant->DropDownKlant($row[0]['klantNaam']); ?> *</br>

    <label for='Email'>Email: </label>
    <input type="text" name="klantEmail" value="<?php if(isset($row)) { echo $row[0]['klantEmail']; }  ?>"> *</br>

    <label for='Adres'>Adres:</label>
    <input type="text" name="klantAdres" required value="<?php if(isset($row)) { echo $row[0]['klantAdres']; } ?>"> *</br>

    <label for='Postcode'>Postcode:</label>
    <input type="text" name="klantPostcode" required value="<?php if(isset($row)) { echo $row[0]['klantPostcode']; } ?>"> *</br>

    <label for='Woonplaats'>Woonplaats:</label>
    <input type="text" name="klantWoonplaats" required value="<?php if(isset($row)) { echo $row[0]['klantWoonplaats']; } ?>"> *</br>

    </br>
    <input type="submit" name="update" value="Wijzigen">

</form>

</br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
}
?>
