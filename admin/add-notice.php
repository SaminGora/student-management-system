<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include_once('../connection.php');

if (isset($_POST['add-notice'])){
    $notice_title = $_POST['notice_title'] ;
    $notice_msg = $_POST['notice_msg'] ;
    $notice_for = $_POST['class_id'] ;

     // File upload
    $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $file_path = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
    }

    $sql = "INSERT INTO notice (noticetitle,classid,noticemsg,file_path) 
          VALUES ('$notice_title', '$notice_for', '$notice_msg','$file_path')";
          if(mysqli_query($conn, $sql)){
        if ($notice_for == 0) {
    // All classes
      $sql = "SELECT email FROM students";
      } else {
          $sql="SELECT email from students where class_id=$notice_for";
      }
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
            $email=$row['email'];
          
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';    // Gmail SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'gorasamin6@gmail.com';   // your Gmail
            $mail->Password   =      // ⚡ Use Gmail App Password, not your real password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('gorasamin6@gmail.com', 'School Admin');
            $mail->addAddress($email); // send to student

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Notice";
            $mail->Body    = "
                <h3>New Notice Published</h3>
                <p><strong>Title:</strong> $notice_title</p>
                <p><strong>Message:</strong> $notice_msg</p>
                <p>Please check the notice board for more details.</p>
               
            ";

        $mail->send();
            
        } catch (Exception $e) {
          error_log("Failed to send email to $email: " . $e->getMessage());
           
        }
       }
      header("Location: add-notice.php?success=Notice added and emails sent to all students");
      exit();
   } else {
       header("Location: add-notice.php?error=Database error:"  . mysqli_error($conn));
         exit();
       
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
        <div class="sub-head">
    <h2>Add Notice</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Notice</p>
    </div>
 
  <div class="add-notice">
    <form method="post"  enctype="multipart/form-data">
    <?php
    if(isset($_GET['error'])){?>
        <p class="error"><?php echo $_GET['error'];?></p>
    <?php }?>
    <?php
    if(isset($_GET['success'])){?>
        <p class="success"><?php echo $_GET['success'];?></p>
    <?php }?>
        <label>Notice Title</label>
        <input type="text" name="notice_title" required><br>
          <label>Notice For</label>
         <select name="class_id" id="class_id" required>
          <option value="">-- Select Class --</option>
          <option value="0">All Classes</option>
        <?php
      include_once("../connection.php");
      $sql = "SELECT class_id, class_name FROM classes";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
      }
    ?>
  </select><br>
  <label>Description</label>
        <input type="text" name="notice_msg" required><br>
         <input type="file" name="file"><br>
        <input type="submit"class="add-btn" value="Add" name="add-notice">
    </form>
  </div>
 </div> 
</body>
</html>
