<?php

$servername = "localhost";
$username = "application";
$password = "6FQAjKu5H8Q7oJ9f";
$dbname = "ergdata";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<h2>CONNECT ERROR</h2>" . $conn->connect_error);
}

$sql = "SELECT password  FROM users where username=" . $_POST["user"].";";

if($result = $conn->query($sql) == FALSE) {
    die("<h2>QUERY ERROR: </h2>" . $conn->connect_error);
}
//validate user
$pwd = $result->fetch_assoc();
echo $pwd;

//header("Location:home.php?success=true");
?>
