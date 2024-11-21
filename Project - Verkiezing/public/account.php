<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Account Overzicht</title>
</head>
<body>

    <section class="navbar-section">
        <nav class="navbar">
        <a href="../public/homepage.php" class="logo" style="color: white; text-decoration: none;">
    JOUW STEM TELT
</a>
            <ul>
                <li><a href="../public/contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../public/account.php">Account</a></li>
                    <li><a href="../login/logout.php">Uitloggen</a></li>
                <?php else: ?>
                    <li><a href="../login/login.php">Inloggen</a></li>
                    <li><a href="../login/register.php">Registreren</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </section>

    <div class="container">
        <div class="square-container">
            <h2>Account Overzicht</h2>
            <p><strong>Gebruikersnaam:</strong> <?php echo $_SESSION['username']; ?></p>
            <p><strong>Rol:</strong> <?php echo $_SESSION['role']; ?></p>
            <a href="../login/logout.php" class="btn-logout">Uitloggen</a>
        </div>
    </div>

</body>
</html>
