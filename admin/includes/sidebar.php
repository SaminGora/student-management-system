<?php 
include('../connection.php');
// $id=$_SESSION['admin_id'];
$id=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="/studentmgt/admin/css/style.css">
  <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap-icons.min.css">
</head>
<body>
<header>
   <?php 
  $sql="SELECT * from admin where id=$id";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result)){
   $name=$row['name'];
   $email=$row['email'];
   $img=$row['image'];
  }
  
  ?>
  <div class="head">
    <i class="bi bi-list" id="menu-icon" ></i>
    <h3>Welcome to admin dashboard!</h3>
    <div >
    <img id="profile" class="profile-img"src="../images/Principal.jpg"><strong><?php echo $name ?> </strong>
    </div>
  </div>
    <div class="dropdown" id="dropdown-block">
        <img class="profile-img" src="../images/Principal.jpg">
        <p><?php echo $name ?><br><?php echo $email?></p>
        <ul>
        <li><i class="bi bi-person-bounding-box"></i><a href="profile.php">My profile</a></li>
        <li><i class="bi bi-gear-wide-connected"></i><a href="change-password.php">Change Password</a></li>
        <li><i class="bi bi-box-arrow-left"></i><a href="../logout.php">Log out</a></li>
        </ul>
  </div>
</header>



<aside id="sidebar">
  <div class="head">
  <img src="../images/logo.png" class="logo">
  <div class="menu"> 
    <i class="bi bi-x-lg"id="cross-icon"></i>
  </div>
  </div>
 
  <div class="profile">
     <i class="bi bi-person"id="profile-icon"></i>Admin
 </div>
<hr>

  <div class="sidebar-link">
  <ul>
  <li><a href="dashboard.php">Dashboard</a><i class="bi bi-pc-display-horizontal"></i></li>
   <li><a href="./add-classes.php">Classes</a><i class="bi bi-bell-fill"></i></li>
  <li id="teacher">
      <a href="">Teacher</a><i class="bi bi-file-earmark-person-fill"></i>
      </li>
      <ul id="teacher-toggle" style="display:none;">
        <li><a href="../admin/add-teachers.php">Add Teacher</a></li>
        <li><a href="view-teacher.php">Manage Teacher</a></li>
      </ul>
    
    <li id="student">
      <a href="">Students</a><i class="bi bi-people"></i></li>
      <ul id="sts-toggle" style="display:none;">
        <li><a href="add-students.php">Add Student</a></li>
        <li><a href="view-students.php">Manage Student</a></li>
      </ul>
    <li><a href="notice.php">Result</a><i class="bi bi-bell-fill"></i></li>

    <li id="fee">
      <a href="">Fee</a><i class="bi bi-people"></i></li>
    <ul id="fee-toggle" style="display:none;">
        <li><a href="fee.php">Add Fee</a></li>
        <li><a href="manage-fee.php">View Fee</a></li>
    </ul>

     
    <li id="notice">
      <a href="">Notice</a><i class="bi bi-file-earmark-person-fill"></i>
      </li>
      <ul id="notice-toggle" style="display:none;">
        <li><a href="../admin/add-notice.php">Add notice</a></li>
        <li><a href="view-notice.php">Manage </a></li>
      </ul>
  </ul>
  
  </div>
</aside>
<script src="../admin/js/sidebar.js"></script>
</body>
</html>