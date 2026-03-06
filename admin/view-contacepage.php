<?php 
include '../connection.php';
session_start();
// If not logged in → go back to home.php
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
   <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
  <title>View contact msg</title>
</head>
<body>
<?php include'includes/sidebar.php';?>
<div class="table-data">
    <h2>Contact Page</h2>
<table class="table table-striped">
<tr>
  <th>Name</th>
  <th>Contact</th>
  <th>Address</th>
  <th>Email</th>
  <th>Message</th>
  
</tr>
<?php 
$sql="SELECT * from contact";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{
echo'<tr>
  <td> '.$row['name'].'</td>
  <td>'.$row['contact'].'</td>
  <td>'.$row['address'].'</td>
  <td>'.$row['email'].'td>
  <td>'.$row['comment'].'</td>
  
</tr>';
} 
?>

</table>
</div>

</body>
</html>
