<?php
include_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Teachers</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-teacher.css">
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
            <th>Action</th>
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
        <td>
        <div class="button">
        <a href="manage-teacher.php?editid='.$row['T_id'].'"><button class="btn btn-primary">Edit</button></a>
        <a href="manage-teacher.php?deleteid='.$row['T_id'].'"onclick="return confirm(\'Are you sure you want to delete?\')"><button class="btn btn-secondary">Delete</button></a>
        </div>
        </td>
        </tr>';
           
        }
        ?>


        </tr>
    </table>
    </div>

</body>
</html>