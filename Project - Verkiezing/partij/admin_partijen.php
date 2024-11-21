<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id, name FROM parties");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Overzicht van Partijen</title>
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
    <!-- Sidebar -->
    <aside class="sidebar">
        <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/logo.png" alt="Logo" class="footer-logo" style="width: 125px">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="../admin/users.php">Gebruikers Overzicht</a></li>
            <li><a href="../partij/admin_partijen.php">Partijen Beheren</a></li>
            <li><a href="../kandidaat/admin_kandidaten.php">Kandidaten Beheren</a></li>
            <li><a href="../admin/resultaten.php">Live Resultaten</a></li>
            <li><a href="../admin/admin_messages.php">Berichten</a></li>
        </ul>
    </aside>

    <!-- Content Section (CRUD) -->
    <section class="content">
        <h1>Overzicht van Partijen</h1>

        <?php if (isset($_GET['message'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Naam van Partij</th>
                <th>Acties</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td>
                        <a href="../partij/update_partij.php?id=<?= $row['id']; ?>">Bewerken</a> | 
                        <a href="../partij/delete_partij.php?id=<?= $row['id']; ?>" onclick="return confirm('Weet je zeker dat je deze partij wilt verwijderen?');">Verwijderen</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="../partij/add_partij.php"><button>Voeg nieuwe partij toe</button></a>
    </section>
</div>

</body>
</html>

<?php
$mysqli->close();
?>
