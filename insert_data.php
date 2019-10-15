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

echo "connection established <br>";



//Save all the Data
$sql = "SELECT shortname FROM produkte";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<br> shortname: " . $row['shortname'];
        echo" - " . $_POST[$row['shortname']];
        //create long SQL-String with inserts
    }
}
else {
    echo "<br>no products";
}


//validate user
$sql = "SELECT * FROM users"; 
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<br>user: " . $row['username'] . " pwd: " . $row['password'];
        if($_POST['user'] == $row['username'] && $_POST['pwd'] == $row['password']) {
            echo "<br>user authenticated";
            //INSERT the new Data^
        }
    }
}
else {
    die("<h2>DATABASE ERROR: EMPTY</h2>");
}


//header("Location:home.php?success=true");
?>
