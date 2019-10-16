<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
</head>
<body style="height: 100vh;">
<?php
if($_GET['success'] == 'false') {
    echo "
    <div class='fixed-top'>
        <div class='alert alert-danger mt-2 ml-5 mr-5'>
            <strong>Fehler!</strong> Falsche/Keine Anmeldung.
        </div>
    </div>
        ";
}
?>
<div style="height: 100%;" class="container d-flex flex-column justify-content-center">
<form action="/enter-session.php" class="align-self-center" method="post">
<div class="input-group mb-3 align-self-center input-group-lg">
    <div class="input-group-prepend">
        <span class="input-group-text">Login</span>
    </div>
    <input type="text" class="form-control" placeholder="Benutzername" name="user">
    <input type="password" class="form-control" placeholder="Passwort" name="pwd">
    <div class="input-group-append">
        <button class="btn btn-success" type="submit">Weiter</button>
    </div>
</div>
</form>
</div>
</body>
</html>
