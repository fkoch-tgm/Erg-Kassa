 <html>
<body>

<form action="testform.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

<h2>Ausgabe:</h2>
<p>
    Name: <?php echo $_POST['name']; ?> <br>
    email: <?php echo $_POST['email']; ?>
</p>
</body>
</html> 
