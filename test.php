<?php
$servername = "localhost";
$username = "root";
$password = "dataadmin";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
echo "<br>";

// Query:
$sql = "INSERT INTO users (email, passwort, vorname, nachname) VALUES ('t2@t2.t2', 'pw2', 'v2', 'n2' )";

// run query
if ($conn->query($sql) === TRUE) {
    echo "Query Successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?> 
