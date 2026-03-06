<?php
$conn=mysqli_connect(
    $servername="localhost",
    $username="root",
    $password="",
    $dbname="school"
);
if(!$conn)
die("Connection failed: " . mysqli_connect_error());
?>