<!-- edit class -->
<?php
include_once('../connection.php');
if(isset($_GET['deleteid'])){
    $T_id=$_GET['deleteid'];
    $sql = "SELECT image FROM teachers WHERE T_id = '$T_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row && !empty($row['image'])) {
        $file_path =$row['image'];  
        
        if (file_exists($file_path)) {
            unlink($file_path);
        }
      }
    $sql="delete from teachers where T_id=$T_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-teacher.php");
    }else{
        die(mysqli_error($conn));
    }
}
$T_id=$_GET['editid'];
$sql="SELECT * from teachers where T_id=$T_id";
$records = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($records);
    $t_id= $row['T_id'];
    $tname=$row['Name'];
    $contact=$row['Contact'];
    $temail=$row['Email'];
    $subject=$row['Subject'];
    $role=$row['Role'];
 if(isset($_POST['edit']))
 {
    $t_id= $_POST['tid'];
    $name=$_POST['tname'];
    $contact=$_POST['tcontact'];
    $email=$_POST['temail'];
    $subject=$_POST['tsubject'];
    $role=$_POST['trole'];

    $sql="update teachers set T_id= '$t_id',Name='$name',Contact='$contact',Email='$email',Role='$role' where T_id=$T_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-teacher.php");
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
    <title>update teaches</title>
        <link rel="stylesheet" href="/studentmgt/admin/css/add-class.css">
</head>
<body>
     <?php include'includes/sidebar.php'?>
    <div class="container">
        <h2>Edit Teachers</h2>
    <div class="add-class">
    <form method="post">
        <label>T_id</label>
      <input type="text" name="tid" value="<?php echo $t_id; ?>" ><br>
      <label>Name</label>
      <input type="text" name="tname" value="<?php echo $tname;?>"><br>
       <label>Contact</label>
      <input type="tel" name="tcontact" value="<?php echo $contact;?>"><br>
      <label>Email</label>
      <input type="email" name="temail" value="<?php echo $temail;?>"><br>
       <label>Subject</label>
      <input type="text" name="tsubject" value="<?php echo $subject;?>"><br>
       <label>Role</label>
       <select name="trole">
        <option>class teacher</option>
          <option>subject teacher</option>
       </select>
        <input type="submit" name="edit"class="add-btn" value="Edit">
    </form>
    </div>
    </div>
</body>
</html>