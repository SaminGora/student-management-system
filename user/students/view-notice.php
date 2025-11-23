<?php
include_once('D:\xampp\htdocs\studentmgt\connection.php');
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
    <title> Notice</title>
    <link rel="stylesheet" href="/studentmgt/user/students/css/view-notice.css">
     <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Notice</h2>
      <?php
        $sql = "SELECT * FROM notice WHERE classid = '$class' OR classid = 0";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)){
        ?>
         <table class="table table-striped"  style="border-collapse:collapse;">
        <tr style="background-color:#f2f2f2;">
            <th>Title</th>
            <th>Notice For</th>
            <th>Description</th>
            <th>File</th>
        </tr>

        <?php
          echo "<tr>";
          echo "<td>{$row['noticetitle']}</td>";
          echo "<td>" . ($row['classid'] == 0 ? 'All Classes' : $row['classid']) . "</td>";
          echo "<td>{$row['noticemsg']}</td>";

          if(!empty($row['file_path'])){
              echo "<td><a href='../../admin/{$row['file_path']}' target='_blank'>📄 View File</a></td>";
          } else {
              echo "<td>No file attached</td>";
          }
          echo "</tr>";
       }
      ?>
    </table>
    <?php
    } else {
        echo "<p style='text-align:center; color:gray; margin-top:20px;'>📢 No notices have been published yet.</p>";
    }
    ?>
  </div>
</body>
</html>