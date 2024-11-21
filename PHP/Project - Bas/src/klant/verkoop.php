<!--
	Auteur: Lucas Tanis
	Function: Verkoop Order
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
	<h1>Verkoop Orders</h1>
    <a href='insertVerOrd.php'>Toevoegen nieuwe verkooporder</a><br><br>

	
<?php

require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

// Create a PDO instance
$dsn = "mysql:host=localhost;dbname=bas project 8";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create an instance of Verkooporder and pass the PDO object
    $verkooporder = new Verkooporder($db);

    // Start CRUD
    $verkooporder->crudVerkoop();

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>
<br>
<nav>
		<a href='../index.html'>Home</a><br>
		
	</nav>

</body>
</html>