<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = $mysqli->real_escape_string($_POST['role']);

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

    if ($mysqli->query($sql) === TRUE) {
        header('Location: ../admin/users.php'); 
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
    <title>Gebruiker Toevoegen</title>
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
            <h3>TOEVOEGEN</h3>
            <ul>
                <li><a href="../admin/users.php">Gebruikers Overzicht</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Voeg een nieuwe gebruiker toe</h1>

            <form action="../admin/add_user.php" method="POST">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required><br><br>

                <label for="role">Rol:</label>
                <select id="role" name="role" required>
                    <option value="voter">Stemmer</option>
                    <option value="candidate">Kandidaat</option>
                    <option value="party">Partij</option>
                    <option value="election_type">Verkiezingstype</option>
                </select><br><br>

                <input type="submit" value="Gebruiker Toevoegen">
            </form>

        </div>
    </div>

</body>
</html>
