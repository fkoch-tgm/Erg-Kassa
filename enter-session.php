<?php
session_start();
// creates a database-connection on the object $conn
require 'establish_connection.php';

echo "username: ".$_POST['user'];
echo "<br>password: ".$_POST['pwd']."<br>";


//validate user
$user = -1;
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($_POST['user'] == $row['username'] && $_POST['pwd'] == $row['password']) {
            echo "<br>user authenticated: " . $row['username'] . "<br>";
            //set user
            $user = $row['id'];
        }
    }
//if no user => die
if($user == -1) {
//    die("no user found");
    header("Location:login.php?success=false");
}
else {
$_SESSION['user'] = $user;
$_SESSION['pwd'] = $_POST['pwd'];
header("Location:home.php?user=".$user);
}
}
else {
//    die("<h2>DATABASE ERROR: EMPTY</h2>");
    header("Location:login.php?success=false");

}

?>
