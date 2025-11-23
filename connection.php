<?php
$conn=mysqli_connect(
    $servername="localhost",
    $username="root",
    $password="",
    $dbname="studentmgt"
);
if (!$conn){
  die("error".mysqli_error($conn));
}

?>