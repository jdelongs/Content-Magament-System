<?php
//connect to the database
$conn = new PDO('mysql:host=host;dbname=dbname', 'user', 'password');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
