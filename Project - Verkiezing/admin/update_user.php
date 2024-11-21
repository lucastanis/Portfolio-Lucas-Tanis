<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if (!isset($_GET['id'])) {
    header('Location: ../admin/users.php'); 
    exit;
}

$id = $mysqli->real_escape_string($_GET['id']);
$result = $mysqli->query("SELECT * FROM users WHERE id = '$id'");

if ($result->num_rows == 0) {
    echo "Geen gebruiker gevonden.";
    exit;
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $role = $mysqli->real_escape_string($_POST['role']);


    $sql = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id = '$id'";

    if ($mysqli->query($sql) === TRUE) {
        header('Location: ../admin/users.php'); 
        exit;
    } else {
        echo "Fout bij bijwerken: " . $mysqli->error;
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
    <title>Gebruiker Bijwerken</title>
</head>
<body>
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="../public/homepage.php">TERUG NAAR HOME PAGINA</a></li>
                <li><a href="../admin/users.php">TERUG NAAR HET OVERZICHT</a></li>
            </ul>
        </nav>
    </section>

    <div class="container">
        <div class="sidebar">
        <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/logo.png" alt="Logo" class="footer-logo" style="width: 125px">
            <h3>BEWERKEN</h3>
            <ul>
                <li><a href="../admin/users.php">Gebruikers Overzicht</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Gebruiker Bijwerken</h1>

            <form action="../admin/update_user.php?id=<?= $user['id']; ?>" method="POST">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" value="<?= $user['username']; ?>" required><br><br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required><br><br>

                <label for="role">Rol:</label>
                <select id="role" name="role" required>
                    <option value="voter" <?= ($user['role'] == 'voter') ? 'selected' : ''; ?>>Stemmer</option>
                    <option value="candidate" <?= ($user['role'] == 'candidate') ? 'selected' : ''; ?>>Kandidaat</option>
                    <option value="party" <?= ($user['role'] == 'party') ? 'selected' : ''; ?>>Partij</option>
                    <option value="election_type" <?= ($user['role'] == 'election_type') ? 'selected' : ''; ?>>Verkiezingstype</option>
                </select><br><br>

                <input type="submit" value="Bijwerken">
            </form>
        </div>
    </div>

</body>
</html>
