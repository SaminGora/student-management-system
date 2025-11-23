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
    <title>Document</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/dashboard.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap-icons.min.css">
</head>

<body>
  <?php include'includes/sidebar.php'?>
  <div class="main">
  <div class="content">
      <div class="total-class">
        <!-- total classes -->
        <div>
          <h6>Total Classes</h6>
          <div class="count">
         <?php
          $sql = "SELECT COUNT(class_id) AS total_classes FROM classes";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <p class="count-value"><?php echo $row['total_classes'];?></p>
          </div>
        <a href="view-class.php">View Class</a>
        </div>
          <div class="class-icon">
          <i class="bi bi-book-half"></i>
          </div>
      </div>
     <!--total student-->
      <div class="total-students">
        <div>
        <h6>Total Students</h6>
           <div class="count">
         <?php
          $sql = "SELECT COUNT(student_id) AS total_student FROM students";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <p class="count-value"><?php echo $row['total_student'];?></p>
          </div>
        <a href="view-students.php">View Students </a>
        </div>
        <div class="class-icon">
        <i class="bi bi-people-fill"></i>
          </div>
      </div>
        <!--total teachers-->
      <div class="total-teachers">
        <div>
        <h6>Total Teachers</h6>
           <div class="count">
         <?php
          $sql = "SELECT COUNT(T_id) AS total_teacher FROM teachers";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <p class="count-value"><?php echo $row['total_teacher'];?></p>
          </div>
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
           <div class="count">
         <?php
          $sql = "SELECT COUNT(id) AS total_notice FROM notice";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <p class="count-value"><?php echo $row['total_notice'];?></p>
          </div>
        <a href="view-class.php">View Notice</a>
        </div>
        <div class="class-icon">
          <i class="bi bi-bell"></i>
          </div>
     </div>
</div>

  <div class="quick-link">
   <h2>Quick Action</h2>
   <div class="add-students">
      <a href="add-students.php">Add Students </a>
    </div>
     <div class="add-class">
      <a href="add-class.php">Add Class</a>
    </div>
     <div class="add-teachers">
      <a href="add-teachers.php">Add Teachers</a>
     </div>
  </div>
</div>

</body>
</html>