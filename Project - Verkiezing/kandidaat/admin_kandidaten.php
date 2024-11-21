<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

$result = $mysqli->query("
    SELECT candidates.id, candidates.name AS kandidaat, parties.name AS partij 
    FROM candidates 
    LEFT JOIN parties ON candidates.party_id = parties.id
");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Overzicht van Kandidaten</title>
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
            <li><a href="../kandidaatidaat/admin_kandidaten.php">Kandidaten Beheren</a></li>
            <li><a href="../admin/resultaten.php">Live Resultaten</a></li>
            <li><a href="../admin/admin_messages.php">Berichten</a></li>
        </ul>
    </aside>

    <!-- Content Section (CRUD) -->
    <section class="content">
        <h1>Overzicht van Kandidaten</h1>

        <?php if (isset($_GET['message'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Naam van Kandidaat</th>
                <th>Partij</th>
                <th>Acties</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['kandidaat']; ?></td>
                    <td><?= $row['partij']; ?></td>
                    <td>
                        <a href="../kandidaat/update_kandidaat.php?id=<?= $row['id']; ?>">Bewerken</a> | 
                        <a href="../kandidaat/delete_kandidaat.php?id=<?= $row['id']; ?>" onclick="return confirm('Weet je zeker dat je deze kandidaat wilt verwijderen?');">Verwijderen</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="../kandidaat/add_kandidaat.php"><button>Voeg nieuwe kandidaat toe</button></a>
    </section>
</div>

</body>
</html>

<?php
$mysqli->close();
?>
