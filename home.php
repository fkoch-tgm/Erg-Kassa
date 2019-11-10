<?php 
session_start();
if(isset($_SESSION['user']) == FALSE) {
    header("Location:login.php?success=false&error=nouserinhome");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .numberinput {
            width: 3em;
        }
    </style>
<script type="text/javascript">
function inc(input) {
    stat = Number(input.getAttribute("value"));
    if(stat == 10) {
        alert("Zu viele!");
    }
    else {
        input.setAttribute("value",String(stat+1));
    }
}
</script>
</head>
<body>

<form action="insert_data.php" method="post">

<div class="container">
<br>
<!-- alerts -->
<?php
if($_GET['success'] == 'true') {
    echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
    Erfolgreich gespeichert!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>
";
}

if($_GET['success'] == 'false') {
    echo "
<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    Ein Fehler ist aufgetreten
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>
";
}
?>


<div class="row">
<?php
$servername = "localhost";
$username = "root";
$password = "6bULvH7qXG54HGs7";
$dbname = "ergdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<h2>ERROR</h2>" . $conn->connect_error);
}

$sql = "SELECT * FROM produkte";
$result = $conn->query($sql);

if ($num_rows = $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "
                <div class='col-md-4 p-2'>
                    <div class='btn btn-primary btn-lg btn-block' onclick='inc(" . $row['shortname'] . ")'>
                        <div class='row'>
                            <div class='col-auto'>
                                <input name='". $row['shortname'] ."' id='" . $row['shortname'] . "' class='numberinput' type='text' value='0' readonly width='1'>
                            </div>
                            <div class='col'>
                                <span class='h6'>" . $row['name'] . "</span>
                            </div>
                        </div>
                    </div>
                </div>
                 ";
        //reset POST
        $_POST[$row['id']] = 0;
    }
} else {
    echo "<h1>0 results</h1>";
}
$conn->close();
?>
</div>
</div>

<div class="fixed-bottom d-flex flex-row m-2 justify-content-between" style="heigth:50px">
    <a class="btn btn-danger btn-lg align-self-start" href="/abmelden.php">Abmelden</a>
    <button class="btn btn-success btn-lg align-self-end" type="submit">Bestellung speichern</button>
</div>

</form>

<!-- JavaScript --> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
