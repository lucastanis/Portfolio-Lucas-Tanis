<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $mysqli->prepare("SELECT name, email, message, created_at FROM contact_messages WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name, $email, $message, $created_at);
    $stmt->fetch();
    $stmt->close();
} else {
    die("Geen bericht opgegeven.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Bericht Bekijken</title>
</head>
<body>

<section class="navbar-section">
    <nav class="navbar">
        <div class="logo">JOUW STEM TELT</div>
        <ul>
            <li><a href="../admin/admin_messages.php">TERUG NAAR BERICHTEN</a></li>
        </ul>
    </nav>
</section>

<div class="container">
    <section class="content">
        <h1>Bericht van <?= htmlspecialchars($name); ?></h1>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($email); ?></p>
        <p><strong>Bericht:</strong></p>
        <p><?= nl2br(htmlspecialchars($message)); ?></p>
        <p><strong>Aangemaakt op:</strong> <?= $created_at; ?></p>
    </section>
</div>

</body>
</html>

<?php
$mysqli->close();
?>
