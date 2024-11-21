<?php
    // auteur: Lucas Tanis
    // functie: Update verkoopOrder

    // Autoloader classes via composer
    require '../../vendor/autoload.php';

    use Bas\classes\verkoopOrder;
    use Bas\classes\klant;
    use Bas\classes\artikel;

    $verkoopOrder = new VerkoopOrder();
    $klant = new Klant();
    $artikel = new Artikel();

    $orderId = $_GET['verkOrdId'];
    $lijstOrder = $verkoopOrder->getVerkoopOrder($orderId);

    $klantId = $lijstOrder[0]["klantId"];
    $artId = $lijstOrder[0]["artId"];

    $lijstKlant = $klant->getKlant($klantId);
    $klantNaam = $lijstKlant[0]["klantNaam"];

    $lijstArtikel = $artikel->getArtikel($artId);
    $artikelOmschrijving = $lijstArtikel[0]["artOmschrijving"];

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {

            $data = [
                'verkOrdId' => $_GET['verkOrdId'],
                'klantId' => $_POST['klantId'],
                'artId' => $_POST['artId'],
                'verkOrdDatum' => $_POST['verkOrdDatum'],
                'verkOrdBestAantal' => $_POST['verkOrdBestAantal'],
                'verkOrdStatus' => $_POST['verkOrdStatus'],
            ];

        if ($verkoopOrder->updateVerkooporder($data)) {
            echo '<script>alert("Verkoop order succesvol bijgewerkt."); location.replace("read.php");</script>';
        } else {
            echo '<script>alert("Er is een fout opgetreden bij het bijwerken van de verkoop order.");</script>';
        }
    }

    if (isset($_GET['verkOrdId'])) {
        $row = $verkoopOrder->getVerkoopOrder($_GET['verkOrdId']);

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

    <h1>CRUD VerkoopOrder</h1>
    <h2>Verkoop order bijwerken</h2>
    <form method="post">

        <input type="hidden" name="verkOrdId" value="<?php if(isset($row)) { echo $row[0]['verkOrdId']; }  ?>">

        <?php $klant->DropDownKlant($klantNaam); ?> *</br>

        <?php $artikel->DropDownArtikel($artikelOmschrijving); ?> *</br>

        <label for="datum">Datum: </label>
        <input type="text" name="verkOrdDatum" value="<?php if(isset($row)) { echo $row[0]['verkOrdDatum']; }  ?>"> *</br>

        <label for="aantal">Aantal: </label>
        <input type="text" name="verkOrdBestAantal" value="<?php if(isset($row)) { echo $row[0]['verkOrdBestAantal']; }  ?>"> *</br>

        <?php $verkoopOrder->DropDownOrdStatus($row[0]["verkOrdStatus"]); ?> * </br>

        </br>
        <input type='submit' name='update' value='Wijzigen'>

    </form>

    </br>

    <a href='read.php'>Terug</a>

    </body>
    </html>

    <?php
        }
    ?>

