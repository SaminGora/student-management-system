<?php
include_once('C:\xampp\htdocs\studentmgt\connection.php');

session_start(); 

 // If not logged in → go back to home.php
 if (!isset($_SESSION['student_id'])) {
 header("Location: ../../index.php");
     exit();
 } 
 $sts_id=$_SESSION['student_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendence</title>
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/attendence.css">
</head>
<?php include'includes/sidebar.php'?>
<body>
    <div class="table-data">
        <div class="detail">
    <?php 
     $present = $conn->query("SELECT COUNT(*) AS total FROM attendence WHERE student_id = '$sts_id' AND attendence = 'present'")->fetch_assoc()['total'];
     $absent = $conn->query("SELECT COUNT(*) AS total FROM attendence WHERE student_id = '$sts_id' AND attendence = 'absent'")->fetch_assoc()['total'];

     $total = $present + $absent;
    $percentage = $total > 0 ? round(($present / $total) * 100, 2) : 0;
    ?><div>
    <p style="color:green">Present Days: <?php echo $present?></p>
    <p style="color:red">Absent Days: <?php echo $absent?></p>
    <p style="color:blue">Percentage: <?php echo $percentage ."%"?></p>
    </div>
            <div>
            <h2>View Attendence</h2>
            </div>
   
   </div>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>Attendence</th>
            <th>Date</th>
           
        </tr>
    <?php 
    $sql="SELECT attendence.*, students.name, students.roll, students.class_id as class_name
          FROM attendence 
          JOIN students ON attendence.student_id = students.student_id
          WHERE attendence.student_id=$sts_id";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
          echo '<tr>
          <td>'.$row['name'].'</td>
          <td>'.$row['class_name'].'</td>
          <td>'.$row['roll'].'</td>
          <td>'.$row['attendence'].'</td>
          <td>'.$row['date'].'</td>
          </tr>';

    }
    ?>
    </table>
    <?php }
      else{
         echo "<p style='text-align:center; color:gray; margin-top:20px;'>📢 No Attendence.</p>";
      }
    ?>

   </div> 
</body>
</html>