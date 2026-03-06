<?php
include_once('../connection.php');
session_start();
// If not logged in → go back to home.php
if (!isset($_SESSION['admin_id'])) {
    header("Location:login.php");
    exit();
}
if (isset($_POST['exam-add'])){
 
    $exam_name = $_POST['exam_name'] ;
    $year = $_POST['year'];
    
  if( empty($exam_name_name)|| empty($year)){
      header("Location: add-exam.php?error= Please fill all field");
        exit();
       }
    $sql = "INSERT INTO exam (exam_name,year) 
          VALUES ('$exam_name','$year')";
          if(mysqli_query($conn, $sql)){
            header("Location: add-exam.php?success=Added successfully");
            exit();
           }
            else {
             header("Location: add-exam.php?error= Database error");
             exit();
            }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Exam</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="container">
    <div class="sub-head">
    <h2>Add Exam</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Exam</p>
    </div>
    
  <div class="add-class">
    <form method="post">
    <?php
    if(isset($_GET['error'])){?>
        <p class="error"><?php echo $_GET['error'];?></p>
    <?php }?>
    <?php
    if(isset($_GET['success'])){?>
        <p class="success"><?php echo $_GET['success'];?></p>
    <?php }?>
        <label>Exam Name</label>
        <input type="text" name="exam_name"><br>
         <label>Year</label>
        <input type="number" name="year"><br>
        <input type="submit"class="add-btn" value="Add" name="exam-add"><br>
      
    </form>
  </div>
 </div>  
</body>
</html>