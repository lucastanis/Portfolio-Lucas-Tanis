<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id, name, email, message, created_at FROM contact_messages ORDER BY created_at DESC");

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $mysqli->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../admin/admin_messages.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Berichten Overzicht</title>
</head>
<body>

<section class="navbar-section">
    <nav class="navbar">
        <div class="logo">JOUW STEM TELT</div>
        <ul>
            <li><a href="../admin/users.php">TERUG NAAR HET ADMIN PANEL</a></li>
        </ul>
    </nav>
</section>

<div class="container">
    <aside class="sidebar">
        <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/logo.png" alt="Logo" class="footer-logo" style="width: 125px">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="../admin/users.php">Gebruikers Overzicht</a></li>
            <li><a href="../partij/admin_partijen.php">Partijen Beheren</a></li>
            <li><a href="../kanidaat/admin_kandidaten.php">Kandidaten Beheren</a></li>
            <li><a href="../admin/resultaten.php">Live Resultaten</a></li>
            <li><a href="../admin/admin_messages.php">Berichten</a></li>
        </ul>
    </aside>

    <section class="content">
        <h1>Overzicht van Berichten</h1>

        <table>
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Bericht</th>
                <th>Aangemaakt op</th>
                <th>Acties</th> 
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="../admin/admin_viewmessages.php?id=<?= $row['id']; ?>" style="text-decoration: none;">Bekijk Bericht</a>
                    </td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a href="../admin/admin_messages.php?delete_id=<?= $row['id']; ?>" onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');" style="color: red; text-decoration: none;">Verwijder</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>
</div>

</body>
</html>

<?php
$mysqli->close();
?>
