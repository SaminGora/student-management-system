<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
include_once('../../connection.php');

if (isset($_POST['add-notes'])){
    $subject = $_POST['subject'] ;
    $msg = $_POST['msg'] ;
    $for = $_POST['class_id'] ;

     // File upload
    $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $file_path = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
    }

    $sql = "INSERT INTO note (subject,class,description,file) 
          VALUES ('$subject', '$for', '$msg','$file_path')";
          if(mysqli_query($conn, $sql)){
        if ($notice_for == 0) {
    // All classes
      $sql = "SELECT email FROM students";
      } else {
          $sql="SELECT email from students where class_id=$for";
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
            $mail->Password   = 'fxgt hzqa dfrt fktv';     // ⚡ Use Gmail App Password, not your real password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('gorasamin6@gmail.com', 'School Admin');
            $mail->addAddress($email); // send to student

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Notice";
            $mail->Body    = "
                <h3>New Notes Added</h3>
                <p><strong>Title:</strong> $subject</p>
                <p><strong>Message:</strong> $msg</p>
                <p>Please check the notice board for more details.</p>
               
            ";

        $mail->send();
            
        } catch (Exception $e) {
          error_log("Failed to send email to $email: " . $e->getMessage());
           
        }
       }
      header("Location: notes.php?success=Notes added and emails sent to all students");
      exit();
   } else {
       header("Location: notes.php?error=Database error:"  . mysqli_error($conn));
         exit();
       
    }
  
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
    <title>Notes</title>
</head>
<body>
  <?php include'includes/sidebar.php'?>
       <div class="container">
        <div class="sub-head">
    <h2>Add Notes</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Notes</p>
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
        <label>Subject</label>
        <input type="text" name="subject" required><br>
          <label>For</label>
         <select name="class_id" id="class_id" required>
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
  <label>Description</label>
        <input type="text" name="msg" required><br>
         <input type="file" name="file"><br>
        <input type="submit"class="add-btn" value="Add" name="add-notes">
    </form>
  </div>
 </div> 
</body>
</html>