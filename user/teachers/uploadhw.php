<?php
include('../../connection.php');
$hwid=$_GET['hwid'];
$sts_id=$_GET['studentid'];
if(isset($_POST['remark-btn'])){
    $remark=$_POST['remark'];
    $sql="UPDATE uploadhomework set teacher_remark='$remark' where hwid=$hwid and sts_id=$sts_id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "<script> alert('successfully remarked');</script>";
    }else{
        echo "<script>alert('database error');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/upload-homework.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <title>Remark homework</title>
</head>
<body>
    <?php include('includes/sidebar.php');?>
    <div class="table-data">
        <h2>View Homework</h2>
         <?php
      $sql = "SELECT students.name AS student_name,
                students.roll,
                students.class_id,
                students.email,
                homework.title,
                homework.description,
                homework.sub_date,
                uploadhomework.file_path,
                uploadhomework.post_date,
                uploadhomework.teacher_remark
                FROM students
                JOIN homework 
                ON students.class_id = homework.hw_for
                LEFT JOIN uploadhomework 
                ON uploadhomework.hwid = homework.id
                AND uploadhomework.sts_id = students.student_id
                WHERE uploadhomework.hwid = $hwid AND uploadhomework.sts_id = $sts_id";

         $result=mysqli_query($conn,$sql);
         while($row=mysqli_fetch_assoc($result)){
        ?>
        <table   class="table table-bordered">
        <tr>
            <th>Name</th> <?php echo'<td>'.$row['student_name'].'</td>' ?>
        </tr>
        <tr>
            <th>Class</th><?php echo'<td>'.$row['class_id'].'</td> '?>
        </tr>
        <tr>
            <th>Email</th><?php echo '<td>'.$row['email'].'</td>'?>
        </tr>
        <tr>
             <th> Homework Description</th><?php echo '<td>'.$row['description'].'</td>'?>
        </tr>
        <tr>
            <th>Submission date</th><?php echo'<td>'.$row['sub_date'].'</td>  '?>
        </tr>
        <tr>
            <th>Post date</th><?php echo'<td>'.$row['post_date'].'</td> '?>
        </tr>
        <tr>
        <th>Uploaded File</th>
        <td>
            <?php 
            if (!empty($row['file_path'])) {
                echo '<a href="../../../studentmgt/user/students/'.$row['file_path'].'" target="_blank">📂 View File</a>';
            } else {
                echo 'No file uploaded';
            }
            ?>
        </td>
    </tr>
        <tr>
        <?php
           echo '<form method="post">
           <tr>
            <th>Teacher Remark</th>
            <td>
              <input type="text" name="remark" value="'.$row['teacher_remark'].'" required>
            </td>
           </tr>
           <tr>
             <td colspan="2">
                <input type="submit" class="btn btn-primary" name="remark-btn" value="Remark">
             </td>
            </tr>
           </form>';
           ?>
        </table>
         <?php }
         ?>
    </div>
</body>
</html>