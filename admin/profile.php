<?php
include_once('../connection.php');

session_start();

// If not logged in → go back to home.php
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
}
$id=$_SESSION['admin_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/profile.css">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Personal Details</h2>
    <?php 
    $sql="SELECT * from admin where id=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $contact=$row['contact'];
    $email=$row['email'];
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
            <th>Username</th><?php echo '<td>'.$username.'</td>'?>
        </tr>
       
    </table>
    </div>

</body>
</html>