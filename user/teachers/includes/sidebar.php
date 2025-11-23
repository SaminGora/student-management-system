<?php 
session_start();
include '../../connection.php';
if (!isset($_SESSION['teacher_id'])) {
  header("Location: ../../index.php");
      exit();
  }
$id=$_SESSION['teacher_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="/studentmgt/user/teachers/css/style.css">
   <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap-icons.min.css">
</head>
<body>
<header>
   <?php 
  $sql="SELECT * from teachers where T_id=$id";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result)){
   $name=$row['Name'];
   $email=$row['Email'];
  if(!empty($row['image'])){
  $img = '../../admin/'.$row['image'];
  }
   
  }
  
  ?>
  <div class="head">
    <i class="bi bi-list" id="menu-icon" ></i>
    <h3>Welcome to Teacher dashboard!</h3>
    <div >
    <img id="profile" class="profile-img" src="<?php echo "$img" ?>"><strong><?php echo $name ?> </strong>
    </div>
  </div>
    <div class="dropdown" id="dropdown-block">
        <img class="profile-img" src="<?php echo "$img" ?>">
        <p><?php echo $name ?><br><?php echo $email?></p>
        <ul>
        <li><i class="bi bi-person-bounding-box"></i><a href="profile.php">My profile</a></li>
        <li><i class="bi bi-gear-wide-connected"></i><a href="change-password.php">Change Password</a></li>
        <li><i class="bi bi-box-arrow-left"></i><a href="../../logout.php">Log out</a></li>
        </ul>
  </div>
</header>


<aside id="sidebar">
  <div class="head">
   <img src="../../images/logo.png" alt="" class="logo">
  <div class="menu"> 
    <i class="bi bi-x-lg"id="cross-icon"></i>
  </div>
  </div>
  <div class="profile">
     <i class="bi bi-person"id="profile-icon"></i>teacher
 </div>
 <hr>

  <div class="sidebar-link">
  <ul>
  <li><a href="dashboard.php">Dashboard</a><i class="bi bi-pc-display-horizontal"></i></li>
       <li id="homework">
        <a href="">Homework</a><i class="bi bi-bell-fill"></i></li>
       <ul id="homework-toggle" style="display:none;">
         <li><a href="add-homework.php">Add Homework</a><i class="bi bi-bell-fill"></i></li>
         <li><a href="view-homework.php">Manage Homework</a><i class="bi bi-bell-fill"></i></li>
         </ul>
        <li><a href="attendence.php">Attendence</a><i class="bi bi-bell-fill"></i></li>
  </ul>
  
  </div>
</aside>
<script src="./js/sidebar.js"></script>
</body>
</html>