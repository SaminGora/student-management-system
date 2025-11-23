<?php
include '../../connection.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="DELETE * from homework where id=$id";
    if(mysqli_query($conn,$sql)){
        header("location:view-homework.php?success=Delete successfully");
    }
    else{
        die(mysqli_error($conn));
    }
}
$id=$_GET['editid'];
$sql="SELECT * from homework where id=$id";
$records = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($records);
 $title=$row['title'];
 $hw_for=$row['hw_for'];
 $description=$row['description'];
 $sub_date=$row['sub_date'];
 if(isset($_POST['edit-homework']))
 {
   $title=$_POST['h-title'];
   $hw_for=$_POST['class_id'];
   $description=$_POST['h-description'];
   $sub_date=$_POST['h-date'];
   
    $sql="update homework set title='$title',hw_for='$hw_for',description='$description',sub_date='$sub_date' where id=$id";
    if(mysqli_query($conn,$sql)){
        header("location:view-homework.php?success=updated successfully");
        exit();
    }
    else{
        die(mysqli_error($conn));
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/studentmgt/user/teachers/css/add-homework.css">

    <title>udate homework</title>
</head>
<body>
        <?php include 'includes/sidebar.php'?>
    <div class="container">
        <h2>Update Homework</h2>
       <?php if(isset($_GET['success'])){?>
            <p class="success"><?php echo $_GET['success'];?></p>
       <?php }?>
        <div class="add-homework">
        <form method="post">
            <label>Homework Title</label><br>
            <input type="text" name="h-title" value="<?php echo $title;?>"required><br>
            <label>Homework For</label><br>
            <select name="class_id" id="class_id" required>
            <option value=""><?php echo $hw_for;?></option>
            <?php
            include_once("../../connection.php");
            $sql = "SELECT class_id, class_name FROM classes";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
            }
            ?>
            </select><br>
            <label>Homework Description</label><br>
            <input type="text" name="h-description"value="<?php echo $description;?>"required><br>
            <label>Submission Data</label><br>
            <input type="date" name="h-date" value="<?php echo $sub_date;?>"required><br>
            <input type="submit"  class="add-btn" value="Edit" name="edit-homework">
        </form>
        </div>
    </div>
</body>
</html>