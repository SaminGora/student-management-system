<!-- delete notice -->
<?php
include_once('../connection.php');
if(isset($_GET['deleteid'])){
    $notice_id=$_GET['deleteid'];
    $sql = "SELECT file_path FROM notice WHERE id = '$notice_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row && !empty($row['file_path'])) {
        $file_path =$row['file_path'];  
        
        if (file_exists($file_path)) {
            unlink($file_path);
        }
      }
    $sql="delete from notice where id=$notice_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-notice.php?success=deleted successfully");
    }else{
        die(mysqli_error($conn));
    }
}
$notice_id=$_GET['editid'];
$sql="SELECT * from notice where id=$notice_id";
$records = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($records);
 $notice_title=$row['noticetitle'];
 $notice_for=$row['classid'];
 $notice_msg=$row['noticemsg'];
 if(isset($_POST['edit-notice']))
 {
   $notice_title=$_POST['notice_title'];
   $notice_for=$_POST['class_id'];
   $notice_msg=$_POST['notice_msg'];
   $file=$_POST['file'];
    $sql="update notice set noticetitle='$notice_title',classid='$notice_for',noticemsg='$notice_msg',file_path='$file' where id=$notice_id";
    if(mysqli_query($conn,$sql)){
        header("location:view-notice.php?success=updated successfully");
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
    <link rel="stylesheet" href="/studentmgt/admin/css/add-notice.css">
    <title>Notice</title>
</head>
<body>
  <?php include'includes/sidebar.php'?>
       <div class="container">
    <h2>Add notice</h2>
  <div class="add-notice">
    <form method="post">
        <label>Notice Title</label>
        <input type="text" name="notice_title" required value="<?php echo $notice_title?>"><br>
          <label>Notice For</label>
         <select name="class_id" id="class_id" required >
          <option value=""><?php echo $notice_for?></option>
          <option value="0">All classes</option>
        <?php
      include_once("../connection.php");
      $sql = "SELECT class_id, class_name FROM classes";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
      }
    ?>
  </select><br>
  <label>Notice Msg</label>
        <input type="text" name="notice_msg" required value="<?php echo $notice_msg?>"><br>
        <input type="file" name="file"><br>
        <input type="submit"class="add-btn" value="Edit" name="edit-notice">
    </form>
  </div>
 </div> 
</body>
</html>