<?php session_start();
include_once('../../connection.php');

 // If not logged in → go back to home.php
 if (!isset($_SESSION['student_id'])) {
 header("Location: ../../index.php");
     exit();
 } 
 $sts_id=$_SESSION['student_id'];
 $class_id=$_SESSION['class_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Students</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Students</h2>
<div class="table">
    <table class="table table-striped" >
        
        <tr>
          <th>S.N</th>
            <th>Student Id</th>
            <th> Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Parent's name</th>
            <th>Contact</th>
            <th>Admission</th>
           </tr>
        
        <?php
      $sql=
      "SELECT student_id, name,class_id,roll,gender,email,parent_name,contact,admission_date from students where class_id=$class_id";
      $records=mysqli_query($conn,$sql);
      $serial=1;
        while ($row = mysqli_fetch_assoc($records)) {
        echo '<tr>
        <td>'.$serial++.'</td>
        <td>'.$row['student_id'].'</td>
         <td>'.$row['name'].'</td>
         <td> '.$row['class_id'].' </td>
         <td> '.$row['roll'].' </td>
         <td>'.$row['gender'].'</td>
         <td>'.$row['email'].'</td>
         <td>'.$row['parent_name'].'</td>
         <td>'.$row['contact'].'</td>
         <td>'.$row['admission_date'].'</td>
        </tr>';
        }
        ?>
        </div>
    </table>
    </div>

</body>
</html>