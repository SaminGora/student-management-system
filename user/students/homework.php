<?php
session_start();
include_once("../../connection.php");
if(!isset($_SESSION['student_id'])){
    header("location: ../../index.php");
    exit();
}
$sts_id=$_SESSION['student_id'];
$classid=$_SESSION['class_id'];
$hwid=$_GET['hwid'];

if(isset($_POST['hw-upload'])){

    $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $file_path = $target_dir.basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
    }
    
   $sql="INSERT Into uploadhomework(sts_id,hwid,file_path)values('$sts_id','$hwid','$file_path')";
    if(mysqli_query($conn, $sql)){
            header("Location:homework.php?success=uploaded successfully");
            exit();
           }
            else {
             header("Location:homework.php?error= Database error");
             exit();
            }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view-homework.css">
    <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
    <title>view homework</title>
</head>
<body>
    <?php include 'includes/sidebar.php'?>
    <div class="table-data">
        <h2>View Homeworks</h2>
        <?php
        $sql="SELECT * from homework where id='$hwid'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_assoc($result)){
        ?>
         <?php if(isset($_GET['error'])){?>
            <p class="error"><?php echo $_GET['error'];?></p>
       <?php }?>
       <?php if(isset($_GET['success'])){?>
            <p class="success"><?php echo $_GET['success'];?></p>
       <?php }?>
       <script>
        // Remove ?success=... or ?error=... from URL after displaying once
        if (window.location.search.includes('success=') || window.location.search.includes('error=')) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        </script>
        <table   class="table table-bordered">
        <tr>
            <th>Title</th> <?php echo'<td>'.$row['title'].'</td>' ?>
        </tr>
        <tr>
            <th>Homework For</th><?php echo'<td>'.$row['hw_for'].'</td> '?>
        </tr>
        <tr>
             <th>Description</th><?php echo '<td>'.$row['description'].'</td>'?>
        </tr>
        <tr>
            <th>Submission date</th><?php echo'<td>'.$row['sub_date'].'</td>  '?>
        </tr>
        <tr>
            <th>Post date</th><?php echo'<td>'.$row['post_date'].'</td> '?>
        </tr>
        <tr>
        <?php
         $sub_date=$row['sub_date'];
        $today_date=date('Y-m-d');
        if($today_date<=$sub_date){
           echo '<form method="post"  enctype="multipart/form-data">
           <tr>
            <th>Upload File</th>
            <td>
              <input type="file" name="file" required>
            </td>
           </tr>
           <tr>
             <td colspan="2">
                <input type="submit" class="btn btn-primary" name="hw-upload" value="Upload">
             </td>
            </tr>
           </form>';
        }
        else
            echo '<td colspan="2"><span style="color:red;">Cannot submit — submission date is over</span></td>';
        ?>
          
        </tr>
       <?php }?>  
    </table>
    <?php }?>
    </div>
</body>
</html>