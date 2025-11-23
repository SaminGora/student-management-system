<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include_once('../connection.php');

if (isset($_POST['tadd'])){
    $name = mysqli_real_escape_string($conn, $_POST['tname']) ;
    $contact = mysqli_real_escape_string($conn, $_POST['tcontact']);
    $email= mysqli_real_escape_string($conn,$_POST['temail']);
    $subject=  mysqli_real_escape_string($conn,$_POST['tsubject']);
    $role=  mysqli_real_escape_string($conn,$_POST['trole']);
    $username=  mysqli_real_escape_string($conn,$_POST['tusername']);
    $password=  $_POST['tpass'];
    $hash_password  =password_hash($password, PASSWORD_DEFAULT);
       // File upload
    $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $file_path = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
    }
  if(empty($name) || empty($contact)|| empty($contact) || empty($subject) || empty($role) || empty($username) || empty($password)){
      header("Location: add-teachers.php?error= Please fill all field");
        exit();
       }
 if(!preg_match("/^9\d{9}$/",$contact)){
    header("Location: add-teachers.php?error=Invalid contact number (10 digits required)");
    exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: add-teachers.php?error=Invalid email format");
        exit();
    }
    if(strlen($password) < 6){
        header("Location: add-teachers.php?error=Password must be at least 6 characters long");
        exit();
    }
    

    $sql = "INSERT INTO teachers ( Name, Contact,Email, subject, Role, username, password,image) 
          VALUES ( '$name', '$contact','$email', '$subject', '$role', '$username', '$hash_password','$file_path')";
         
           if (mysqli_query($conn, $sql)) {
        // ✅teacher added successfully → now send email
          
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
            $mail->addAddress($email, $name); // send to student

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Teacher login Details";
            $mail->Body    = "
                <h3>Hello $name,</h3>
                <p>Your account has been created successfully.</p>
                <p><b>Username:</b> $username <br>
                <b>Password:</b> $password</p>
                <p>Please change your password after first login.</p>
            ";

            $mail->send();
        header("Location: add-teachers.php?success=Added successfully and mailed");
         exit();
            
        } catch (Exception $e) {
           header("Location: add-teachers.php?error=Student added, but email could not be sent. Error:{$mail->ErrorInfo}");
         exit();
           
        }
    } else {
       header("Location: add-teachers.php?error=Database error:"  . mysqli_error($conn));
         exit();
       
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Teacher</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-teacher.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="container">
   <div class="sub-head">
      <h2>Add Teachers</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Teachers</p>
    </div>
  <div class="add-teacher">
    <form method="post" enctype="multipart/form-data">
    <?php
   if(isset($_GET['error'])){?>
    <p class="error"><?php echo $_GET['error'];?></p>
  <?php }?>
   <?php
   if(isset($_GET['success'])){?>
    <p class="success"><?php echo $_GET['success'];?></p>
  <?php }?>
      <label>Name</label>
      <input type="text" name="tname"><br>
       <label>Contact</label>
      <input type="tel" name="tcontact"><br>
      <label>Email</label>
      <input type="email" name="temail"><br>
       <label>Subject</label>
      <input type="text" name="tsubject"><br>
       <label>Role</label>
       <select name="trole">
        <option>class teacher</option>
          <option>subject teacher</option>
       </select>
      <label>Username</label>
      <input type="text" name="tusername"><br>
      <label>Password</label>
      <input type="password" name="tpass"><br>
       <label>Image</label>
      <input type="file" name="file"><br>
      <input type="submit"class="add-btn" value="Add" name="tadd">
    </form>
  </div>
 </div>  
</body>
</html>