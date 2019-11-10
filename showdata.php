<!DOCTYPE html>
<html>
<head>
    <title>data</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Data:</h1>

<div class="row">
<div class="col-6">
<table class="table">
<thead>
    <tr>
        <th scope="col">Produkt</th>
        <th scope="col">Menge</th>
    </tr>
</thead>
<tbody>
<?php
// creates a database-connection on the object $conn
require 'establish_connection.php';

$sql = "SELECT produkte.name AS NAME, IFNULL(SUM(eintragungen.menge), 0) AS MENGE FROM produkte LEFT JOIN eintragungen ON produkte.id = eintragungen.produkt GROUP BY produkte.id";

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "  <tr>"
        ."      <th scope='row'>" . $row['NAME'] . "</th>"
        ."      <td>" . $row['MENGE'] . "</td>"
        ."  </tr>";
}
?>
</tbody>
</div>
</div>
</div>
</body>
</html>
