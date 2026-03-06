<?php
include_once("../../connection.php");
use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
  require_once __DIR__ . '/../../vendor/autoload.php';
 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

if(isset($_POST['add-homework'])){
    $title=$_POST['h-title'];
    $for=$_POST['class_id'];
    $des=$_POST['h-description'];
    $sub_date=$_POST['h-date'];
    

   $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $fileName = $_FILES['file']['name'];
        $allowedTypes = array('pdf','jpg','jpeg'); 
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {
            $file_path = $target_dir . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
        }
        else{
              header("Location:add-homework.php?error= only PDF, JPG, JPEG files are allowed");
             exit();
        }
    }
   $sql="INSERT Into homework(title,hw_for,description,file_path,sub_date)values('$title','$for','$des','$file_path','$sub_date')";
     if(mysqli_query($conn, $sql)){
        
          $sql="SELECT email from students where class_id=$for";
      
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
            $mail->Password   = $_ENV['gmail_pass'];     // ⚡ Use Gmail App Password, not your real password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('gorasamin6@gmail.com', 'School Admin');
            $mail->addAddress($email); // send to student

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Homework";
            $mail->Body    = "
                <h3>New Homework Added</h3>
                <p><strong>Title:</strong> $title</p>
                <p><strong>Message:</strong> $des</p>
                <p>Please check the application for more details.</p>
               
            ";

        $mail->send();
            
        } catch (Exception $e) {
          error_log("Failed to send email to $email: " . $e->getMessage());
           
        }
       }
      header("Location: add-homework.php?success=homework added and emails sent to all students");
      exit();
   } else {
       header("Location: add-homework.php?error=Database error:"  . mysqli_error($conn));
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
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
</head>
<body>
    <?php include 'includes/sidebar.php'?>
    <div class="container">
        <h2>Add Homework</h2>
        <div class="add-homework">
             <?php if(isset($_GET['error'])){?>
            <p class="error"><?php echo $_GET['error'];?></p>
       <?php }?>
       <?php if(isset($_GET['success'])){?>
            <p class="success"><?php echo $_GET['success'];?></p>
       <?php }?>
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