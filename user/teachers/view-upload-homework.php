<?php
include('../../connection.php');
$hwid=$_GET['uploadid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add-homework.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <title>Uploaded Homework</title>
</head>
<body>
    <?php include('includes/sidebar.php');?>
    <div class="table-data">
        <h2>Uploaded Homeworks</h2>
        <?php
        $sql="SELECT * from homework where id=$hwid";
        $records = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($records);
        $title=$row['title'];
        $sub_date=$row['sub_date'];
        $class=$row['hw_for'];
        
       ?>
       <p><strong>Title:</strong> <?php echo $title ?><br />
        <strong>Last Date of Submission:</strong> <?php echo $sub_date?></p>
        <table  class="table table-bordered">
        <tr>
            <th>S.N</th>
            <th>Student Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>Action</th>
        </tr>
       <?php
       $sql = "SELECT students.student_id, students.name, students.roll, students.class_id, uploadhomework.file_path
        FROM students
        INNER JOIN uploadhomework 
        ON students.student_id = uploadhomework.sts_id
        WHERE uploadhomework.hwid = '$hwid'";
       $result=mysqli_query($conn,$sql);
       $serial=1;
       if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
        $name=$row['name'];
       $roll=$row['roll'];
            echo '<tr>';
            echo '<td>' . $serial++ . '</td>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $class . '</td>';
            echo '<td>' .$roll. '</td>';
            echo '<td>
                <a href="uploadhw.php?studentid='.$row['student_id'].'&hwid=' .$hwid.'"><button class="btn btn-primary">View</button></a>
                </td>';
            echo '</tr>';
        }
    } else {
        echo "<p style='text-align:center; color:gray; margin-top:20px;'>📢 No homeworks have been published yet.</p>";
    }
        ?>
    
        </table>
    </div> 
</body>
</html>