<?php
include_once('../../connection.php');

session_start();

// If not logged in → go back to home.php
if (!isset($_SESSION['student_id'])) {
    header("Location:login.php");
    exit();
}
$id=$_SESSION['student_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/studentmgt/user/students/css/profile.css">
    <title>Profile</title>
</head>
<body>
    <?php include'includes/sidebar.php';?>
      <div class="table-data">
    <h2>Personal Details</h2>
    <?php 
    $sql="SELECT * from students where student_id=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $sts_id=$row['student_id'];
    $dob=$row['dob'];
    $roll=$row['roll'];
    $class=$row['class_id'];
    $address=$row['address'];
    $email=$row['email'];
    $contact=$row['contact'];
    $parent_name=$row['parent_name'];
    $parent_email=$row['parent_email'];
    $admission_date=$row['admission_date'];
    $username=$row['username'];
    
    ?>
          <table   class="table table-bordered">
        <tr>
            <th>Name</th> <?php echo'<td>'.$name.'</td>' ?> <th>Class</th> <?php echo'<td>'.$class.'</td>' ?>
        </tr>
         <tr>
            <th>Roll</th> <?php echo '<td>'.$roll.'</td>'?> <th> Email</th><?php echo '<td>'.$email.'</td>'?>
        </tr>
         <tr>
            <th>Date of Birth</th><?php echo '<td>'.$dob.'</td>'?><th>Address</th> <?php echo'<td>'.$address.'</td>' ?>
        </tr>
         <tr>
            <th>Parent Name</th> <?php echo'<td>'.$parent_name.'</td>' ?><th>Student Id</th><?php echo'<td>'.$sts_id.'</td> '?>
        </tr>
         <tr>
            <th>Parent Email</th><?php echo '<td>'.$parent_email.'</td>'?><th>Parent Contact</th><?php echo'<td>'.$contact.'</td> '?> 
        </tr>
         <tr>
            <th>Username</th> <?php echo'<td>'.$username.'</td>' ?><th>Admission Date</th><?php echo '<td>'.$admission_date.'</td>'?>
        </tr>
       
        <tr>
       
    </table>
    </div>
</body>
</html>