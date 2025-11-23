<?php
include_once('../../connection.php');

session_start();

// If not logged in → go back to home.php
if (!isset($_SESSION['teacher_id'])) {
    header("Location:login.php");
    exit();
}
$id=$_SESSION['teacher_id'];
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
    $sql="SELECT * from teachers where T_id=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $name=$row['Name'];
    $contact=$row['Contact'];
    $email=$row['Email'];
    $role=$row['Role'];
    $username=$row['username'];
    
    ?>
          <table   class="table table-bordered">
        <tr>
            <th>Name</th> <?php echo'<td>'.$name.'</td>' ?>
        </tr>
        <tr>
            <th>Contact</th><?php echo'<td>'.$contact.'</td> '?>
        </tr>
        <tr>
            <th>Email</th><?php echo '<td>'.$email.'</td>'?>
        </tr>
        <tr>
            <th>Role</th><?php echo '<td>'.$role.'</td>'?>
        </tr>
        <tr>
            <th>Username</th><?php echo '<td>'.$username.'</td>'?>
        </tr>
       
    </table>
    </div>
</body>
</html>