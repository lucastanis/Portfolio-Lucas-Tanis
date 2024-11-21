<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $mysqli->real_escape_string($_POST['name']);

    $sql = "INSERT INTO parties (name) VALUES ('$name')";

    if ($mysqli->query($sql) === TRUE) {
        header('Location: ../partij/admin_partijen.php'); 
        exit;
    } else {
        echo "Fout bij toevoegen: " . $mysqli->error;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add_user.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Partij Toevoegen</title>
</head>
<body>
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="../partij/admin_partijen.php">TERUG NAAR HET ADMIN PANEL</a></li>
            </ul>
        </nav>
    </section>

    <div class="container">
        <div class="sidebar">
            <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/logo.png" alt="Logo" class="footer-logo" style="width: 125px">
            <h3>TOEVOEGEN</h3>
            <ul>
            <li><a href="../admin/users.php">Gebruikers Overzicht</a></li>
            <li><a href="../partij/admin_partijen.php">Partijen Beheren</a></li>
            <li><a href="../kandidaat/admin_kandidaten.php">Kandidaten Beheren</a></li>
            <li><a href="../admin/resultaten.php">Live Resultaten</a></li>
            <li><a href="../admin/admin_messages.php">Berichten</a></li>
        </ul>
        </div>

        <div class="content">
            <h1>Voeg een nieuwe partij toe</h1>

            <form action="../partij/add_partij.php" method="POST">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" required><br><br>

                <input type="submit" value="Partij Toevoegen">
            </form>
        </div>
    </div>

</body>
</html>
