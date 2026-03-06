<?php
include_once('../connection.php');
session_start();
// If not logged in → go back to home.php
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Students</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
</head>
<body>
  <?php include 'includes/sidebar.php';
// Number of records per page
$limit =5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
// Calculate the starting record
$start = ($page - 1) * $limit;
// Fetch total records
$result_count = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];

// Calculate total pages
$total_pages = ceil($total_records / $limit);

  ?>
  
  <div class="table-data">
    <h2>Students</h2>
    <form method="post">
  <label>Class:</label>
  <input type="number" placeholder="e.g 1" name="search">
  <input type="submit" name="find" value="Find">
</form>
<div class="table">
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
      "SELECT student_id, name,class_id,roll,gender,email,parent_name,contact,admission_date from students where class_id=$var LIMIT $start, $limit";
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
      $sql="SELECT student_id, name,class_id,roll,gender,email,parent_name,contact,admission_date from students LIMIT $start, $limit";
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
        </div>
    </table>
    
    </div>
<div class="pagination">
  <?php
    if ($page > 1) {
        echo '<a href="?page=1">First ></a>';
        echo '<a href="?page='.($page - 1).'">Prev ></a>';
    }
    if ($page < $total_pages) {
        echo '<a href="?page='.($page + 1).'">Next ></a>';
        echo '<a href="?page='.$total_pages.'">Last</a>';
    }
  ?>
</div>
</body>
</html>