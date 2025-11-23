<?php
 include_once('D:\xampp\htdocs\studentmgt\connection.php');

 session_start(); 

  //If not logged in → go back to home.php
  if (!isset($_SESSION['teacher_id'])) {
  header("Location: ../../index.php");
      exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="/studentmgt/user/teachers/css/dashboard.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap-icons.min.css">
</head>

<body>
  <?php include'includes/sidebar.php'?>
  <div class="main">
  <div class="content">
     <div class="total-notice">
      <!-- total classes --> 
       <div>
        <h6>Total Homework</h6>
       <a href="view-homework.php">View Homework</a>
       </div>
        <div class="class-icon">
        <i class="bi bi-book-half"></i>
        </div>
     </div>
   <!--total student-->
     <div class="total-students">
      <div>
      <h6>Total Students</h6>
      <a href="view-student.php">View Students </a>
      </div>
      <div class="class-icon">
       <i class="bi bi-people-fill"></i>
        </div>
     </div>
      <!--total teachers-->
     <div class="total-teachers">
      <div>
      <h6>Total Teachers</h6>
      <a href="view-teacher.php">View Teachers</a>
      </div>
      <div class="class-icon">
        <i class="bi bi-file-person-fill"></i>
        </div>
     </div>
      <!--notice-->
     <div class="total-notice">
      <div>
      <h6>Total Notice</h6>
      <a href="view-class.php">View Notice</a>
      </div>
      <div class="class-icon">
        <i class="bi bi-bell"></i>
        </div>
     </div>
</div>
</body>
</html>