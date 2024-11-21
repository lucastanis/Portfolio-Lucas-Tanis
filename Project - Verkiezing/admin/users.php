<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id, username, email, role, created_at FROM users");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Overzicht van Ingelogde Gebruikers</title>
</head>
<body>

<section class="navbar-section">
    <nav class="navbar">
        <div class="logo">JOUW STEM TELT</div>
        <ul>
            <li><a href="../public/homepage.php">TERUG NAAR HOME PAGINA</a></li>
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
        <h1>Overzicht van Ingelogde Gebruikers</h1>

        <?php if (isset($_GET['message'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Gebruikersnaam</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th>Aangemaakt op</th>
                <th>Acties</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['role']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a href="../admin/update_user.php?id=<?= $row['id']; ?>">Bewerken</a> | 
                        <a href="../admin/delete_user.php?id=<?= $row['id']; ?>" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijderen</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="../admin/add_user.php"><button>Voeg nieuwe gebruiker toe</button></a>
    </section>
</div>

</body>
</html>

<?php
$mysqli->close();
?>
