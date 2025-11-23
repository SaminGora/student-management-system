<!-- edit class -->
<?php
include_once('../connection.php');
if(isset($_GET['deleteid'])){
    $sts_id=$_GET['deleteid'];
    $sql = "SELECT image FROM students WHERE student_id = '$sts_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row && !empty($row['image'])) {
        $file_path =$row['image'];  
        
        if (file_exists($file_path)) {
            unlink($file_path);
        }
      }
    $sql="delete from students where student_id=$sts_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-students.php");
    }else{
        die(mysqli_error($conn));
    }
}
$sts_id=$_GET['editid'];
$sql="SELECT * from students where student_id=$sts_id";
$records = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($records);
         $sname=$row['name'];
         $class_id=$row['class_id'];
         $gender=$row['gender'];
         $dob=$row['dob'];
         $semail=$row['email'];
         $p_name=$row['parent_name'];
         $p_contact=$row['contact'];
         $p_email=$row['parent_email'];
 if(isset($_POST['sts-add']))
  {
         $name=$_POST['sts-name'];
         $class_id=$_POST['class_id'];
         $gender=$_POST['sts-gender'];
         $dob=$_POST['sts-dob'];
         $email=$_POST['sts-email'];
         $p_name=$_POST['parent-name'];
         $p_contact=$_POST['parent-contact'];
         $p_email=$_POST['parent-email'];
    $sql="update students set name='$name',class_id='$class_id',gender='$gender',dob='$dob',email='$email',parent_name='$p_name',contact='$p_contact',parent_email='$p_email' where student_id=$sts_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-students.php");
    }
    else{
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update students</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
</head>
<body>
     <?php include'includes/sidebar.php'?>
    <div class="container">
    <h2>Edit Students</h2>
  <div class="add-students">
    <form method="post">
      <div>
    <?php
   if(isset($_GET['error'])){?>
    <p class="error"><?php echo $_GET['error'];?></p>
  <?php }?>
   <?php
   if(isset($_GET['success'])){?>
    <p class="success"><?php echo $_GET['success'];?></p>
  <?php }?>
     <label>Name</label>
      <input type="text" name="sts-name" value="<?php echo $sname?>"><br>
        <label>Class</label>
         <select name="class_id" id="class_id">
          <option value="">-- Select Class --</option>
        <?php
      include_once("../connection.php");
      $sql = "SELECT class_id, class_name FROM classes";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
      }
    ?>
  </select><br>
   <label>Gender</label>
<div class="gender-group">
  <label>
    <input type="radio" name="sts-gender" value="Male"> Male
  </label>
  <label>
    <input type="radio" name="sts-gender" value="Female"> Female
  </label>
</div>
<br>
       <label>DOB</label>
      <input type="date" name="sts-dob" value="<?php echo $dob?>"><br>
      <label>Email</label>
      <input type="email" name="sts-email" value="<?php echo $semail?>"><br>
      </div>
      <div>
       <h4>Parent details</h4><br>
       <label>Patent's name</label>
      <input type="text" name="parent-name" value="<?php echo $p_name?>"><br>
      <label>Contact</label>
      <input type="tel" name="parent-contact" value="<?php echo $p_contact?>"><br>
      <label>Parent's email</label>
      <input type="email" name="parent-email" value="<?php echo $p_email?>"><br>
    </div>
      <input type="submit"class="add-btn" value="Add" name="sts-add">
    </form>
    </div>
    </div>
</body>
</html>