<?php
include_once('C:\xampp\htdocs\studentmgt\connection.php');
session_start(); 
 // If not logged in → go back to home.php
 if (!isset($_SESSION['student_id'])) {

   header("Location: ../../index.php");
     exit();
 } 
  $class=$_SESSION['class_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> view notes</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
     <link rel="stylesheet" href="/studentmgt/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="table-data" >
    <h2>Notes</h2>
      <?php
        $sql = "SELECT * FROM note WHERE class = '$class' OR class = 0";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
           while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="content">
           <div class="total-class">
            <h5><?= $row['subject']; ?></h5>
                <p ><?= $row['description']; ?></p>

                <?php if(!empty($row['file'])){ ?>
                    <a href="../teachers/<?= $row['file']; ?>" 
                       class="btn btn-primary btn-sm" target="_blank">
                       📄 View File
                    </a>
                <?php } else { ?>
                    <span class="text-danger">No file attached</span>
                <?php } ?>

           </div>
         </div>
                <?php } ?>
    <?php
    } else {
        echo "<p style='text-align:center; color:gray; margin-top:20px;'>📢 No notes have been published yet.</p>";
    }
    ?>
  </div>
</body>
</html>