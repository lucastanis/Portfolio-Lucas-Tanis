<?php
// Verbinden met de database
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Wachtwoord versleutelen
    $role = $mysqli->real_escape_string($_POST['role']);

    // Controleren of de e-mail of gebruikersnaam al bestaat
    $sql_check = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = $mysqli->query($sql_check);

    if ($result->num_rows > 0) {
        $error = "Gebruikersnaam of e-mailadres is al in gebruik.";
    } else {
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
        
        if ($mysqli->query($sql) === TRUE) {
            // Succesvolle registratie
            header('Location: ../login/login.php');
            exit;
        } else {
            $error = "Fout bij registratie: " . $mysqli->error;
        }
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
    <title>Registreren</title>
</head>
<body>
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="../public/homepage.php">HOME</a></li>
                <li><a href="../login/login.php">INLOGGEN</a></li>
            </ul>
        </nav>
    </section>

    <div class="container">
        <div class="content">
            <h1>Registreren</h1>
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

            <form action="../login/registratie.php" method="POST">
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

                <input type="submit" value="Registreren">
            </form>

            <p>Heb je al een account? <a href="../login/login.php">Log hier in</a>.</p>
        </div>
    </div>
</body>
</html>
