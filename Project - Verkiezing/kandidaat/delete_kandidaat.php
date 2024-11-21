<?php
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Verwijder de partij uit de database
    $sql = "DELETE FROM parties WHERE id = $id";

    if ($mysqli->query($sql) === TRUE) {
        header('Location: ../partij/admin_partijen.php?message=Partij succesvol verwijderd');
        exit;
    } else {
        echo "Fout bij verwijderen: " . $mysqli->error;
    }
} else {
    echo "Geen partij ID opgegeven";
}

$mysqli->close();
?>
