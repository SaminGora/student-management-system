<?php
include_once("connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <!-- For CSS -->
<link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">

<!-- For JavaScript -->
<script src="/studentmgt/js/bootstrap.bundle.js"></script>

    
</head>
<body>
    <a href="view.php" class="btn btn-primary">View</a>
<form method="post">
    <table class="table"  style="border-collapse:collapse;">
    <tr>
        <th>Name</th>
        <th>Roll</th>
        <th>Contact</th>
        <th>Attendence</th>
   </tr>

   <?php
   $sql="SELECT * FROM class11";
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
    
</form>
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
            echo "already taken";
        }
       }
    }
   
    if(!$b){

        foreach($att as $roll => $value){
            // Get name from class11 table
            $result = $conn->query("SELECT name FROM class11 WHERE roll = '$roll'");
            $row = $result->fetch_assoc();
            $name = $row['name'];
         
            if($value=="present"){
               
                $sql="INSERT INTO attendence(name,roll,attendence,date)VALUES('$name','$roll','present','$date')";
                $insertresult=$conn->query($sql);
            }
        
            else
                {
               
                    $sql="INSERT INTO attendence(name,roll,attendence,date)VALUES('$name','$roll','absent','$date')";
                $insertresult=$conn->query($sql);
            
        }
            
           }
        
        if($insertresult){
            echo "succesfully attendend";
        }
    }
}
?>

</body>

</html>