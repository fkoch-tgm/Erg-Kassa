<?php
$servername = "localhost";
$username = "User for Application";
$password = "Password for User";
$dbname = "Database Name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<h2>ERROR:</h2><br>" . $conn->connect_error);
}

?>
