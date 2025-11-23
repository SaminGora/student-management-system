<?php
include_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Classes</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-class.css">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Classes</h2>
    <table class="table table-striped"  style="border-collapse:collapse;">
        <tr>
            <th>class id</th>
            <th>Class Name</th>
            <th>Class Teacher</th>
            <th>Action</th>
        <tr>
        <?php
      $records = mysqli_query($conn, 
      "SELECT c.class_id,c.class_name,t.Name AS teacher_name FROM classes c
       LEFT JOIN teachers t 
       ON c.teacher_id = t.T_id;");
        while ($row = mysqli_fetch_assoc($records)) {
        echo '<tr>
        <td>'.$row['class_id'].'</td>
         <td>'.$row['class_name'].'</td>
         <td> '.$row['teacher_name'].' </td>
        <td>
        <a href="manage-class.php?editid='.$row['class_id'].'"><button class="btn btn-primary">Edit</button></a>
        <a href="manage-class.php?deleteid='.$row['class_id'].'"onclick="return confirm(\'Are you sure you want to delete?\')"><button class="btn btn-secondary">Delete</button></td></a>
        </tr>';
           
        }
        ?>


        </tr>
    </table>
    </div>

</body>
</html>