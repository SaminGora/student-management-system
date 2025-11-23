<?php
session_start();
include_once("../../connection.php");
if(!isset($_SESSION['student_id'])){
    header("location: ../../index.php");
    exit();
}
$classid=$_SESSION['class_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view-homework.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <title>view homework</title></title>
</head>
<body>
    <?php include 'includes/sidebar.php'?>
    <div class="table-data">
        <h2>Homeworks</h2>
         <table  class="table table-bordered table-dark">
        <tr>
            <th>S.N</th>
            <th>Title</th>
            <th>Homework For</th>
            <th>Description</th>
            <th>Submission date</th>
            <th>Post date</th>
            <th>Action</th>
        </tr>
        <?php
        $sql="SELECT * from homework where hw_for='$classid'";
        $result=mysqli_query($conn,$sql);
        $serial=1;
        if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_assoc($result)){
        ?>
       
        <?php
        echo '<tr>
        <td>'.$serial++.'</td>
         <td>'.$row['title'].'</td>
         <td>'.$row['hw_for'].'</td>
         <td>'.$row['description'].'</td>
         <td>'.$row['sub_date'].'</td> 
         <td>'.$row['post_date'].'</td>
         <td><a href="homework.php?hwid='.$row['id'].'"><button class="btn btn-secondary">View</button></a></td>
        </tr>';
        
        }
    ?>
    </table>
    <?php
       } else{
          echo "<p style='text-align:center; color:gray; margin-top:20px;'>📢 No Homework have been asigned yet.</p>";   
        }
        ?>
    </div>
</body>
</html>