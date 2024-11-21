<?php

$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $sql = "DELETE FROM users WHERE id = $user_id";

    if ($mysqli->query($sql) === TRUE) {
        echo "Gebruiker succesvol verwijderd!";
        header('Location: ../admin/users.php'); 
        exit;
    } else {
        echo "Fout bij verwijderen: " . $mysqli->error;
    }
} else {
    echo "Geen gebruikers-ID opgegeven.";
}

$mysqli->close();
?>
