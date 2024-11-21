<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

// Haal stemresultaten op
$stemResultaten = $mysqli->query("
    SELECT 
        p.name AS partij, 
        COUNT(v.gekozen_partij) AS aantal_stemmen 
    FROM votes v
    JOIN parties p ON v.gekozen_partij = p.id
    GROUP BY v.gekozen_partij
");

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Live Resultaten</title>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function () {
            var chartData = [];
            <?php while ($row = $stemResultaten->fetch_assoc()): ?>
                chartData.push({ label: "<?php echo $row['partij']; ?>", y: <?php echo $row['aantal_stemmen']; ?> });
            <?php endwhile; ?>

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", 
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column",
                    dataPoints: chartData
                }]
            });
            chart.render();
        }
    </script>
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
            <li><a href="../kanidaat/admin_kandidaten.php">Kandidaten Beheren</a></li>
            <li><a href="../admin/resultaten.php">Live Resultaten</a></li>
            <li><a href="../admin/admin_messages.php">Berichten</a></li>
        </ul>
    </aside>

    <!-- Content Section (Grafiek) -->
    <section class="content">
        <h1>Live Stemresultaten</h1>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        
    </section>
</div>

</body>
</html>

<?php
$mysqli->close();
?>
