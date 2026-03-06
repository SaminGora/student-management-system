<?php
include_once('C:\xampp\htdocs\studentmgt\connection.php');
session_start(); 
 // If not logged in → go back to home.php
 if (!isset($_SESSION['student_id'])) {

   header("Location: ../../index.php");
     exit();
 } 
  $class=$_SESSION['class_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Teachers</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Teachers</h2>
    <table class="table table-striped"  style="border-collapse:collapse;">
        <tr>
            <th>Teacher Id</th>
            <th> Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Role</th>
        <tr>
        <?php
      $records = mysqli_query($conn, 
      "SELECT T_id, Name, Contact,Email, subject, Role from teachers");
        while ($row = mysqli_fetch_assoc($records)) {
        echo '<tr>
        <td>'.$row['T_id'].'</td>
         <td>'.$row['Name'].'</td>
         <td> '.$row['Contact'].' </td>
         <td> '.$row['Email'].' </td>
         <td>'.$row['subject'].'</td>
         <td>'.$row['Role'].'</td>
        
        </tr>';
           
        }
        ?>


        </tr>
    </table>
    </div>

</body>
</html>