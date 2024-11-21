<?php
    // auteur: Lucas Tanis
    // functie: Update Class Klant

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\Artikel;

    $artikel = new Artikel();

    if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {

        $data = [
            'artId' => $_GET['artId'],
            'artOmschrijving' => $_POST['artOmschrijving'],
            'artInkoop' => $_POST['artInkoop'],
            'artVerkoop' => $_POST['artVerkoop'],
            'artVoorraad' => $_POST['artVoorraad'],
            'artMinVoorraad' => $_POST['artMinVoorraad'],
            'artMaxVoorraad' => $_POST['artMaxVoorraad'],
            'artLocatie' => $_POST['artLocatie'],
        ];

        if ($artikel->updateArtikel($data)) {
            echo '<script>alert("Artikel succesvol bijgewerkt."); location.replace("read.php");</script>';
        } else {
            echo '<script>alert("Er is een fout opgetreden bij het bijwerken van het artikel.");</script>';
        }
    }

    if (isset($_GET['artId'])) {
        $row = $artikel->getArtikel($_GET['artId']);

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

    <h1>CRUD artikel</h1>
    <h2>Wijzigen</h2>

    <form method="post">

        <input type="hidden" name="artId" value="<?php if(isset($row)) { echo $row[0]['artId']; }  ?>">

        <label for='Artikel'>Artikel: </label>
        <input type="text" name="artOmschrijving" value="<?php if(isset($row)) { echo $row[0]['artOmschrijving']; }  ?>"> *</br>

        <label for='Inkoop'>Inkoopprijs:</label>
        <input type="text" name="artInkoop" value="<?php if(isset($row)) { echo $row[0]['artInkoop']; } ?>"> *</br>

        <label for='Verkoop'>Verkoopprijs:</label>
        <input type="text" name="artVerkoop" value="<?php if(isset($row)) { echo $row[0]['artVerkoop']; } ?>"> *</br>

        <label for='Voorraad'>Voorraad:</label>
        <input type="text" name="artVoorraad" value="<?php if(isset($row)) { echo $row[0]['artVoorraad']; } ?>"> *</br>

        <label for='MinVoorraad'>Minimale Voorraad:</label>
        <input type="text" name="artMinVoorraad" value="<?php if(isset($row)) { echo $row[0]['artMinVoorraad']; } ?>"> *</br>

        <label for='MaxVoorraad'>Maximale Voorraad:</label>
        <input type="text" name="artMaxVoorraad" value="<?php if(isset($row)) { echo $row[0]['artMaxVoorraad']; } ?>"> *</br>

        <?php $artikel->DropDownLocatie($row[0]['artLocatie']); ?> *</br>

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