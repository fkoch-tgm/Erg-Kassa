<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>

    <style type="text/css">
        .numberinput {
            width: 2em;
            height: 1.5em;
            text-align: center;
            background: #25ffb3;
            border: #25ffb3 medium solid;
            border-radius: .25rem;
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
<div class="container-fluid">
    <form action="insert_data.php" method="post">
    <div class='row'>
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
        $hz = 0;
        $vr = 0;
        while ($row = $result->fetch_assoc()) {
            if ($hz == 3) {
                $hz = 0;
                echo "</div><div class='row'>";
            }
            echo "
<div class='col-sm-4 d-flex'>
   <div class='btn btn-block btn-primary m-2' onclick='inc(" . $row['shortname'] . ")'>
    <input id='" . $row['shortname'] . "' class='numberinput' type=text min='0' max='9' value='0' name='" . $row['id'] . "' readonly width='1'>
    <span class='h6'>" . $row['name'] . "</span>
   </div> 
</div>
";
            //reset POST
            $_POST[$row['id']] = 0;
            $hz = $hz + 1;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>
</div>
<div class="d-flex content-align-end flex-row">
    <div class="input-group input-group-lg">
    <input type="text" class="form-control" placeholder="Username" name="user" value="<?php echo $_POST['user'] ?>">
    <input type="text" class="form-control" placeholder="Passwort" name="pwd" value="<?php echo $_POST['pwd'] ?>">
        <div class="input-group-append">
            <button class="btn btn-success btn-large" type=submit>Senden</button>
        </div>
    </div>
</div>
</form>
</div>
</body>
</html>
