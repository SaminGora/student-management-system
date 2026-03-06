<?php
session_start();
include_once("../../connection.php");

$class = (int)$_GET['class'];
$teacher_id = $_SESSION['teacher_id'];
$role = $_SESSION['role'];

// Role check first
if ($role !== "class teacher") {
    echo "<script>alert('Access Denied! Only class teachers can access.'); window.location.href='attendence.php';</script>";
    exit;
}

// Check if this teacher is class teacher of this class
$sql = "SELECT 1 FROM classes WHERE class_id =$class AND teacher_id = $teacher_id";
$result=mysqli_query($conn,$sql);

if ($result->num_rows === 0) {
    echo "<script>alert('Access Denied! You are not assigned to this class.'); window.location.href='attendence.php';</script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendence</title>
   <!-- For CSS -->
<link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
<link rel="stylesheet" href="/studentmgt/user/teachers/css/attendence.css">

</head>
<body>
<?php include 'includes/sidebar.php'?>
    <div class="container">
 <div class="table-data">
    <h2>Take Attendence</h2>

<form method="post">
    <table class="table"  style="border-collapse:collapse;">
    <tr>
        <th>Name</th>
        <th>Roll</th>
        <th>Contact</th>
        <th>Attendence</th>
   </tr>

   <?php
   $sql="SELECT * FROM students where class_id=$class order by roll asc";
   $result=$conn->query($sql);
   while($row=$result->fetch_assoc()){
    
   ?>
   <tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['roll'];?></td>
    <td><?php echo $row['contact'];?></td>
    <td>
    Present
    <input type="radio" required name="attendence[<?php echo $row['student_id'];?>]" value="present">
    Absent
    <input type="radio" required name="attendence[<?php echo $row['student_id'];?>]" value="absent">

    </td>
   </tr>
   <?php }?>
    </table>
    <input type="submit" name="submit" value="take attendence" class="btn btn-secondary" >
    <a href="view.php?class=<?php echo $class?>" class="btn btn-primary">View</a>
</form>
</div>
</div>
    <?php
if($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['submit'])){
    $date=date('Y-m-d');
    $att=$_POST['attendence'];
    
    
    $success = false;
    foreach($att as $student_id => $value){
        // Check if this student already has attendance for today
        $check_sql = "SELECT attendence_id FROM attendence WHERE student_id = '$student_id' AND date = '$date'";
        $check_result = $conn->query($check_sql);
        
        if($check_result->num_rows == 0){
             $sql="INSERT INTO attendence(student_id, attendence, date) VALUES('$student_id', '$value', '$date')";
             if($conn->query($sql)){
                 $success = true;
             }
        }
    }
    
    if($success){
        echo"<script>alert('Attendance recorded successfully!');</script>"; 
    } else {
        echo"<script>alert('Attendance already recorded for selected students today.');</script>";
    }
}
?>

</body>

</html>