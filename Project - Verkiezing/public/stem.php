<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

// Controleer verbinding
if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}


if (!isset($_SESSION['username'])) {
    die("Je moet ingelogd zijn om te stemmen.");
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['gekozen_partij'], $_POST['gekozen_kandidaat'])) {
        $gekozen_partij = $_POST['gekozen_partij'];
        $gekozen_kandidaat = $_POST['gekozen_kandidaat'];
        $username = $_SESSION['username'];

        $query = $mysqli->prepare("SELECT * FROM votes WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $message = "Je hebt al gestemd.";
            echo "<script>alert('$message');</script>";
        } else {

            $query = $mysqli->prepare("INSERT INTO votes (username, gekozen_partij, gekozen_kandidaat) VALUES (?, ?, ?)");
            $query->bind_param("ssi", $username, $gekozen_partij, $gekozen_kandidaat);
            
            if ($query->execute()) {
                $message = "Stem succesvol geregistreerd!";
                echo "<script>alert('$message');</script>";
            } else {
                $message = "Fout bij registreren van stem: " . $query->error;
                echo "<script>alert('$message');</script>";
            }
        }
    } else {
        $message = "Vul alle velden in.";
        echo "<script>alert('$message');</script>";
    }
}

$parties = $mysqli->query("SELECT * FROM parties");
$candidates = $mysqli->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/stem.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Stemmen</title>
    <script>

        function updateCandidates() {
            var partijSelect = document.getElementById('gekozen_partij');
            var gekozenPartij = partijSelect.value;
            var kandidaatSelect = document.getElementById('gekozen_kandidaat');

 
            kandidaatSelect.innerHTML = '<option value="">Selecteer een kandidaat</option>';

            <?php while ($candidate = $candidates->fetch_assoc()): ?>
                if (gekozenPartij == "<?php echo $candidate['party_id']; ?>") {
                    var option = document.createElement("option");
                    option.value = "<?php echo $candidate['id']; ?>";
                    option.text = "<?php echo $candidate['name']; ?>";
                    kandidaatSelect.appendChild(option);
                }
            <?php endwhile; ?>
        }
    </script>
</head>
<body>
    <div class="navbar-section">
        <nav class="navbar">
            <div class="logo">JOUW STEM TELT</div>
            <ul>
                <li><a href="../public/homepage.php">Home</a></li>
                <li><a href="../public/account.php">Account</a></li>
                <li><a href="../login/logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <h1>Stemmen</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="gekozen_partij">Kies een partij:</label>
                <select name="gekozen_partij" id="gekozen_partij" required onchange="updateCandidates()">
                    <option value="">Selecteer een partij</option>
                    <?php
                    // Reset de pointer naar het begin van de resultaten
                    $parties->data_seek(0);
                    while ($party = $parties->fetch_assoc()): ?>
                        <option value="<?php echo $party['id']; ?>"><?php echo $party['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="gekozen_kandidaat">Kies een kandidaat:</label>
                <select name="gekozen_kandidaat" id="gekozen_kandidaat" required>
                    <option value="">Selecteer een kandidaat</option>
                </select>
            </div>

            <input type="submit" value="Stemmen" class="submit-button">
        </form>
    </div>

</body>
</html>
