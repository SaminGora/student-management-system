<?php
include_once("../../connection.php");
$class=$_GET['class'];
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
   $sql="SELECT * FROM students where class_id=$class";
   $result=$conn->query($sql);
   while($row=$result->fetch_assoc()){
    
   ?>
   <tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['roll'];?></td>
    <td><?php echo $row['contact'];?></td>
    <td>
    Present
    <input type="radio" required name="attendence[<?php echo $row['roll'];?>]" value="present">
    Absent
    <input type="radio" required name="attendence[<?php echo $row['roll'];?>]" value="absent">

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
    $sql="SELECT distinct date FROM attendence";
    $result=$conn->query($sql);
     $b=false;
    if($result->num_rows>0){
       while($row=$result->fetch_assoc()){
        if($date==$row['date']){
            $b=true;
            echo"<script>alert('already attendend');</script>";
        }
       }
    }
   
    if(!$b){
        foreach($att as $roll => $value){
            // Get name from class11 table
            $result = $conn->query("SELECT student_id,name FROM students WHERE roll = '$roll'");
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $sts_id=$row['student_id'];
            if($value=="present"){
                $sql="INSERT INTO attendence(student_id,name,roll,class,attendence,date)VALUES('$sts_id','$name','$roll','$class','present','$date')";
                $insertresult=$conn->query($sql);
            }
        
            else
                {              
                $sql="INSERT INTO attendence(student_id,name,roll,class,attendence,date)VALUES('
                $sts_id','$name','$roll','$class','absent','$date')";
                $insertresult=$conn->query($sql);
        }
           }
        if($insertresult){
           echo"<script>alert('succesfully attendend');</script>"; 
        }
    }
}
?>

</body>

</html>