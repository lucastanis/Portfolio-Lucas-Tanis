<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $mysqli->real_escape_string($_POST['name']);
    $party_id = $_POST['party_id'];

    $sql = "INSERT INTO candidates (name, party_id) VALUES ('$name', $party_id)";

    if ($mysqli->query($sql) === TRUE) {
        header('Location: ../kandidaat/admin_kandidaten.php'); 
        exit;
    } else {
        echo "Fout bij toevoegen: " . $mysqli->error;
    }
}

$partijen_result = $mysqli->query("SELECT id, name FROM parties");

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add_user.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Kandidaat Toevoegen</title>
</head>
<body>
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="../kandidaat/admin_kandidaten.php">TERUG NAAR HET ADMIN PANEL</a></li>
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
            <h1>Voeg een nieuwe kandidaat toe</h1>

            <form action="../kandidaat/add_kandidaat.php" method="POST">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="party_id">Partij:</label>
                <select id="party_id" name="party_id" required>
                    <?php while ($party = $partijen_result->fetch_assoc()): ?>
                        <option value="<?= $party['id']; ?>"><?= $party['name']; ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <input type="submit" value="Kandidaat Toevoegen">
            </form>
        </div>
    </div>

</body>
</html>
