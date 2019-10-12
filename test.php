<?php
$servername = "localhost";
$username = "root";
$password = "dataadmin";

// Create connection
$conn = new mysqli($servername, $username, $password);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Datenbank erstellen
$sql = "CREATE DATABASE myDB";
if($conn->query($sql) === TRUE) {
    echo "DB created";
}
else {
    echo "error: " . $conn->error;
}

$conn->close();
?> 
