<!-- delete class -->
<?php
include_once('../connection.php');
if(isset($_GET['deleteid'])){
    $class_id=$_GET['deleteid'];
    $sql="delete from classes where class_id=$class_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-class.php");
    }else{
        die(mysqli_error($conn));
    }
}
$class_id=$_GET['editid'];
$sql="SELECT * from classes where class_id=$class_id";
$records = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($records);
 $class_id= $row['class_id'];
 $class_name=$row['class_name'];
 $teacher_id=$row['teacher_id'];
 if(isset($_POST['edit']))
 {
    $class_id= $_POST['class_id'];
    $class_name=$_POST['class_name'];
    $teacher_id= $_POST['class_teacher'];

    $sql="update classes set class_id= '$class_id',class_name='$class_name',teacher_id='$teacher_id' where class_id=$class_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-class.php");
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
    <title>update class</title>
        <link rel="stylesheet" href="/studentmgt/admin/css/add-class.css">
</head>
<body>
     <?php include'includes/sidebar.php'?>
    <div class="container">
        <h2>Edit classes</h2>
    <div class="add-class">
    <form method="post">
        <label>Class Id</label>
        <input type="text" name="class_id"  value="<?php echo $class_id;?>"><br>
        <label>Class Name</label>
        <input type="text" name="class_name"  value="<?php echo $class_name;?>"><br>
        <label> Teacher Id </label>
        <input type="text" name="class_teacher"  value="<?php echo $teacher_id;?>"><br>
        <input type="submit" name="edit"class="add-btn" value="Edit">
    </form>
    </div>
    </div>
</body>
</html>