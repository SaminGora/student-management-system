<?php
include_once('../connection.php');

if (isset($_POST['class-add'])){
 
    $class_id = $_POST['class_id'];
    $class_name = $_POST['class_name'] ;
    $teacher_id = $_POST['teacher_id'];
    
  if(empty($class_id)|| empty($class_name)|| empty($teacher_id)){
      header("Location: add-classes.php?error= Please fill all field");
        exit();
       }
    $sql = "INSERT INTO classes (class_id,class_name,teacher_id) 
          VALUES ('$class_id','$class_name','$teacher_id')";
          if(mysqli_query($conn, $sql)){
            header("Location: add-classes.php?success=Added successfully");
            exit();
           }
            else {
             header("Location: add-classes.php?error= Database error");
             exit();
            }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Classes</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-class.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="container">
    <div class="sub-head">
    <h2>Add Class</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Class</p>
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
        <label>Class Id</label>
        <input type="text" name="class_id"><br>
        <label>Class Name</label>
        <input type="text" name="class_name"><br>
         <label>Class Teacher</label>
         <select name="teacher_id" required>
          <option value="">-- Select teacher --</option>
        <?php
      include_once("../connection.php");
      $sql = "SELECT T_id, Name FROM teachers";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['T_id']."'>".$row['Name']."</option>";
      }
      ?> 
      </select>
        <input type="submit"class="add-btn" value="Add" name="class-add"><br>
       <a href="view-class.php" class="btn btn-info">View Classes</a>
    </form>
  </div>
 </div>  
</body>
</html>