<?php 
session_start();
if(isset($_SESSION['user']) == FALSE) {
    header("Location:login.php?success=false&error=nouserinhome");
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Date Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <title>data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <div id="dateContainer" class="input-group mb-3 align-self-center input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">Datum</span>
                </div>
                <input id="date" type="text" class="form-control" placeholder="Von-Bis">
                <div class="input-group-append">
                </div>
            </div>

            <script>
                $(function() {
                    $('#date').daterangepicker({
                        timePicker: true,
<?php 
if(isset($_GET['start']) and isset($_GET['end'])) {
    echo "startDate: moment(". $_GET['start'] . "),";
    echo "endDate: moment(" . $_GET['end'] . "),";
}
else {
    echo "startDate: moment().startOf('hour'),";
    echo "endDate: moment().startOf('hour').add(1,'day'),";
}
?>
                        timePicker24Hour: true,
                        
                        locale: {
                            format: 'DD.MM.YYYY (hh:mm)',
                            "separator": " - ",
                            "applyLabel": "Bestätigen",
                            "cancelLabel": "Abbrechen",
                            "fromLabel": "Von",
                            "toLabel": "Bis",
                            "daysOfWeek": [
                                "So",
                                "Mo",
                                "Di",
                                "Mi",
                                "Do",
                                "Fr",
                                "Sa"
                            ],
                            "monthNames": [
                                "Jänner",
                                "Februar",
                                "März",
                                "April",
                                "Mai",
                                "Juni",
                                "Juli",
                                "August",
                                "September",
                                "Oktober",
                                "November",
                                "Dezember"
                            ],
                        },
                        firstDay: 1,
                        parentEl: "#dateContainer"
                    }, function (start, end, label) {
                           window.location.href = "showdata.php?start="+start+"&end="+end;
                        }
                    );
                });
            </script>
        </div>
    </div>

<h1>Data:</h1>

<div class="row">
<div class="col-6">
<table class="table">
<thead>
    <tr>
        <th scope="col">Produkt</th>
        <th scope="col">Menge</th>
    </tr>
</thead>
<tbody>
<?php
// creates a database-connection on the object $conn
require 'establish_connection.php';

$sql = "SELECT produkte.name AS NAME, IFNULL(SUM(eintragungen.menge), 0) AS MENGE FROM produkte LEFT JOIN eintragungen ON produkte.id = eintragungen.produkt GROUP BY produkte.id";
// Date-String
$sql = $sql . " WHERE eintagungen.zeitpunkt > " . ($_GET['start'] / 1000) . " AND eintragungen.zeitpunkt < " . ($_GET['end'] / 1000);

//debug
echo "<script>console.log('$sql');</script>";

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "  <tr>"
        ."      <th scope='row'>" . $row['NAME'] . "</th>"
        ."      <td>" . $row['MENGE'] . "</td>"
        ."  </tr>";
}
?>
</tbody>
</div>
</div>
</div>
</body>
</html>
