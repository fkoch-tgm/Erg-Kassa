<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "dataadmin";
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
        /*
        while ($row = $result->fetch_assoc()) {
            echo "";
        }*/
        $hz = 0;
        $vr = 0;
        echo "<div class='row'>";
        while($row = $result->fetch_assoc()) {
            if($hz == 3) {
                $hz=0;
                echo "</div><div class='row'>";
            }
            echo "
<div class='col-sm-4'>
    <h4>". $row['name'] . "</h4>
</div>
            ";
            $hz = $hz + 1;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>
</body>
</html>