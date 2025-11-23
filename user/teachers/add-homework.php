<?php
include_once("../../connection.php");
if(isset($_POST['add-homework'])){
    $title=$_POST['h-title'];
    $for=$_POST['class_id'];
    $des=$_POST['h-description'];
    $sub_date=$_POST['h-date'];

    $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $file_path = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
    }
    
   $sql="INSERT Into homework(title,hw_for,description,file_path,sub_date)values('$title','$for','$des','$file_path','$sub_date')";
    if(mysqli_query($conn, $sql)){
            header("Location: add-homework.php?success=Added successfully");
            exit();
           }
            else {
             header("Location: add-homework.php?error= Database error");
             exit();
            }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homework</title>
    <link rel="stylesheet" href="/studentmgt/user/teachers/css/add-homework.css">
</head>
<body>
    <?php include 'includes/sidebar.php'?>
    <div class="container">
        <h2>Add Homework</h2>
        <?php if(isset($_GET['error'])){?>
            <p class="error"><?php echo $_GET['error'];?></p>
       <?php }?>
       <?php if(isset($_GET['success'])){?>
            <p class="success"><?php echo $_GET['success'];?></p>
       <?php }?>
        <div class="add-homework">
        <form method="post"  enctype="multipart/form-data">
            <label>Homework Title</label><br>
            <input type="text" name="h-title" required><br>
            <label>Homework For</label><br>
            <select name="class_id" id="class_id" required>
            <option value="">-- Select Class --</option>
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
            <input type="text" name="h-description" required><br>
            <label>Submission Data</label><br>
            <input type="date" name="h-date" required><br>
            <input type="file" name="file"><br>
            <input type="submit"  class="add-btn" value="Add" name="add-homework">
        </form>
        </div>
    </div>
</body>
</html>