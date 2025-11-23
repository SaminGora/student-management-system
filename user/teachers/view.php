<?php include('../../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendence</title>
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="/studentmgt/user/teachers/css/attendence.css">
</head>

<body>
    <?php include 'includes/sidebar.php';?>
    <div class="table-data">
    <h2>View Attendence</h2>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>Attendence</th>
           
        </tr>
    <?php 
    $class=$_GET['class'];
    $sql="SELECT * from attendence where class=$class";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
          echo '<tr>
          <td>'.$row['name'].'</td>
          <td>'.$row['class'].'</td>
          <td>'.$row['roll'].'</td>
          <td>'.$row['attendence'].'</td>
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