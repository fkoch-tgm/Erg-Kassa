<?php
session_start();
echo "test";
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

//validate user
$user = -1;
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($_SESSION['user'] == $row['id'] && $_SESSION['pwd'] == $row['password']) {
            echo "<br>user authenticated: " . $row['username'] . "<br>";
            //set user
            $user = $row['id'];
        }
    }
}
else {
    header("Location:home.php?success=false&error=nouser");
    //die("<h2>DATABASE ERROR: EMPTY</h2>");
}
//if no user => die
if($user == -1) {
    //    die("no user found");
    header("Location:login.php?success=false&error=uservalidation");
}

//Save all the Data
$sql = "SELECT * FROM produkte";
$result = $conn->query($sql);
$sql_insert = "";
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //create long SQL-String with inserts
        if($_POST[$row['id']] > 0) {
            $sql_insert .= "INSERT INTO eintragungen (produkt, menge, user) VALUES (".$row['id'].", ".$_POST[$row['id']].", ".$user.");";
        }
        unset($_POST[$row['id']]);
    }
}
else {
    die("<br>no products");
}
if($conn->multi_query($sql_insert) === TRUE) {
    echo "eintragungen gemacht";
    header("Location:home.php?success=true");
}
else {
    header("Location:home.php?success=false&error=insertfailed");
}
?>
