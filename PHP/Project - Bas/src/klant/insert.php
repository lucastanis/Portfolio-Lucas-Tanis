<?php
// auteur: Lucas Tanis
// functie: Insert Verkooporder Pagina
 
// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;
 
if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
 
        $Klant = new Klant();
        $Klant->toevoegenKlant($_POST);
}
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

<h1>CRUD Klant</h1>
    <form method="post">
    <label for="nv">Klantnaam:</label>
    <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
    <br>  
    <label for="an">Klantemail:</label>
    <input type="text" id="an" name="klantemail" placeholder="Klantemail" required/>
    <br>
    <label for="nv">KlantAdres:</label>
    <input type="text" id="nv" name="klantadres" placeholder="Klantadres" required/>
    <br>
    <label for="nv">KlantPostcode:</label>
    <input type="text" id="nv" name="klantpostcode" placeholder="KlantPostcode" required/>
    <br>  
    <label for="nv">KlantWoonplaats:</label>
    <input type="text" id="nv" name="klantwoonplaats" placeholder="KlantWoonplaats" required/>
    <br>    <br>
    <input type='submit' name='insert' value='Toevoegen'>
    </form></br>
 
    <a href='read.php'>Terug</a>

</body>
</html>



