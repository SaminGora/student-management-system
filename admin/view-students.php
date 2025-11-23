<?php
include_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Students</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data">
    <h2>Students</h2>
    <form method="post">
  <label>Class:</label>
  <input type="number" placeholder="e.g 1" name="search">
  <input type="submit" name="find" value="Find">
</form>
    <table class="table table-striped" >
        
        <tr>
          <th>S.N</th>
            <th>Student Id</th>
            <th> Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Parent's name</th>
            <th>Contact</th>
            <th>Admission</th>
            <th>Action</th>
           </tr>
        
        <?php
        
      if(isset($_POST['find'])){
      $var = trim($_POST['search']);
      $sql=
      "SELECT student_id, name,class_id,roll,gender,email,parent_name,contact,admission_date from students where class_id=$var";
      $records=mysqli_query($conn,$sql);
      $serial=1;
        while ($row = mysqli_fetch_assoc($records)) {
        echo '<tr>
        <td>'.$serial++.'</td>
        <td>'.$row['student_id'].'</td>
         <td>'.$row['name'].'</td>
         <td> '.$row['class_id'].' </td>
         <td> '.$row['roll'].' </td>
         <td>'.$row['gender'].'</td>
         <td>'.$row['email'].'</td>
         <td>'.$row['parent_name'].'</td>
         <td>'.$row['contact'].'</td>
         <td>'.$row['admission_date'].'</td>
        <td>
        <div class="button">
        <a href="manage-student.php?editid='.$row['student_id'].'"><button class="btn btn-primary">Edit</button></a>
        <a href="manage-student.php?deleteid='.$row['student_id'].'"><button class="btn btn-secondary">Delete</button></a>
        </div>
        </td>
        </tr>';
        }
      }else{
        $sql="SELECT student_id, name,class_id,roll,gender,email,parent_name,contact,admission_date from students";
      $records=mysqli_query($conn,$sql);
      $serial=1;
        while ($row = mysqli_fetch_assoc($records)) {
        echo '<tr>
        <td>'.$serial++.'</td>
        <td>'.$row['student_id'].'</td>
         <td>'.$row['name'].'</td>
         <td> '.$row['class_id'].' </td>
         <td> '.$row['roll'].' </td>
         <td>'.$row['gender'].'</td>
         <td>'.$row['email'].'</td>
         <td>'.$row['parent_name'].'</td>
         <td>'.$row['contact'].'</td>
         <td>'.$row['admission_date'].'</td>
        <td>
        <div class="button">
        <a href="manage-student.php?editid='.$row['student_id'].'"><button class="btn btn-primary">Edit</button></a>
        <a href="manage-student.php?deleteid='.$row['student_id'].'"onclick="return confirm(\'Are you sure you want to delete?\')"><button class="btn btn-secondary">Delete</button></a>
        </div>
        </td>
        </tr>';

        }
      }
        ?>
    </table>
    </div>

</body>
</html>