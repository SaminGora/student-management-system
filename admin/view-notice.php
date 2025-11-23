<?php
include_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Notice</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-notice.css">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Notice</h2>
     <?php
    if(isset($_GET['success'])){?>
        <p class="success"><?php echo $_GET['success'];?></p>
    <?php }?>
    <table class="table table-striped"  style="border-collapse:collapse;">
        <tr>
            <th>S.N</th>
            <th>Notice Title</th>
            <th>Notice For</th>
            <th>Notice message</th>
            <th>Action</th>
        <tr>
        <?php
      $records = mysqli_query($conn, 
     "SELECT id,noticetitle,classid,noticemsg FROM notice");
      $serialno=1;
        while ($row = mysqli_fetch_assoc($records)) {
       
        echo '<tr>
         <td>'.$serialno++.'</td>
        <td>'.$row['noticetitle'].'</td>
         <td>'.$row['classid'].'</td>
         <td> '.$row['noticemsg'].' </td>
        <td>
        <a href="manage-notice.php?editid='.$row['id'].'"><button class="btn btn-primary">Edit</button></a>
        <a href="manage-notice.php?deleteid='.$row['id'].'"onclick="return confirm(\'Are you sure you want to delete?\')"><button class="btn btn-secondary">Delete</button></td></a>
        </tr>';
           
        }
        ?>


        </tr>
    </table>
    </div>

</body>
</html>