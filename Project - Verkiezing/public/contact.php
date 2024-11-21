<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $charCount = strlen($message);
    if ($charCount > 50) {
        $error = "Je bericht mag maximaal 50 leestekens bevatten.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Bedankt voor je bericht, we nemen zo snel mogelijk contact met je op.";
        } else {
            $error = "Er is iets misgegaan. Probeer het later opnieuw.";
        }

        $stmt->close();
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_user.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Contact</title>
    <script>
        function validateMessage() {
            const message = document.getElementById('message').value;
            const charCount = message.length;

            if (charCount > 100) {
                alert("Je bericht mag maximaal 100 leestekens bevatten.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="homepage.php">HOME</a></li>
                <li><a href="registratie.php">REGISTREREN</a></li>
                <li><a href="login.php">INLOGGEN</a></li>
            </ul>
        </nav>
    </section>

    <div class="container">
        <div class="content">
            <h1>Contacteer ons</h1>
            <?php if (isset($success)) { echo "<p style='color:green;'>$success</p>"; } ?>
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

            <form action="contact.php" method="POST" onsubmit="return validateMessage();">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="message">Bericht (Max 100 leestekens):</label>
                <textarea id="message" name="message" maxlength="50" required></textarea><br><br>

                <input type="submit" value="Verstuur">
            </form>
        </div>
    </div>
</body>
</html>
