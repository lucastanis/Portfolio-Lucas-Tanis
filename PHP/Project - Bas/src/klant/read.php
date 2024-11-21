<!--
  Auteur: Lucas Tanis
  Function: CRUD van Klant
-->
 
<?php
$host = 'localhost'; 
$dbname = 'bas project 8'; 
$username = 'root'; 
$password = '';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 
 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
 
<body>
 
<div class="opbar">
  <h1>CRUD Klant</h1>
    <a href='../index.html'>Home</a><br>
    <a href='insert.php'>Toevoegen nieuwe klant</a><br><br>
   
    <div>
      <form action="">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Zoeken naar klanten.." title="Type in a name">
    </form>
  </div>
	<br>
</div>
	
 
 
<table id="myTable">
  <tr class="header">
    <th>Klantnaam</th>
    <th>Emailadres</th>
    <th>Addres</th>
    <th>Postcode</th>
    <th>Stad</th>
	<th>Acties</th>
  </tr>

  <?php
    $stmt = $conn->query("SELECT klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats FROM klant");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['klantNaam'] . "</td>";
        echo "<td>" . $row['klantEmail'] . "</td>";
        echo "<td>" . $row['klantAdres'] . "</td>";
        echo "<td>" . $row['klantPostcode'] . "</td>";
        echo "<td>" . $row['klantWoonplaats'] . "</td>";
        echo "<td>";
        echo "<form method='get' action='update.php' style='display:inline;'>";
        echo "<input type='hidden' name='klantId' value='" . $row['klantId'] . "'>";
        echo "<button type='submit' name='update'>Updaten</button>";
        echo "</form>";
        echo "<form method='post' action='delete.php' style='display:inline;'>";
        echo "<input type='hidden' name='klantId' value='" . $row['klantId'] . "'>";
        echo "<button type='submit' name='verwijderen'>Verwijderen</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
?>
</table>
 
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }      
  }
}
</script>
 
</body>
</html>
 
<?php
 
 
 
?>