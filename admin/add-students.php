<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

include_once('../connection.php');
if (isset($_POST['sts-add'])) {
$name           = mysqli_real_escape_string($conn, $_POST['sts-name']);
$class_id       = mysqli_real_escape_string($conn, $_POST['class_id']);
$address       = mysqli_real_escape_string($conn, $_POST['sts-address']);
$gender         = mysqli_real_escape_string($conn, $_POST['sts-gender']);
$dob            = mysqli_real_escape_string($conn, $_POST['sts-dob']);
$email          = mysqli_real_escape_string($conn, $_POST['sts-email']);
$username       = mysqli_real_escape_string($conn, $_POST['sts-username']);
$password       = $_POST['sts-pass'];
$hash_password  =password_hash($password, PASSWORD_DEFAULT);
$parentname     = mysqli_real_escape_string($conn, $_POST['parent-name']);
$parentcontact  = mysqli_real_escape_string($conn, $_POST['parent-contact']);
$parentemail    = mysqli_real_escape_string($conn, $_POST['parent-email']);
   
   // File upload
    $file_path = "";
    $target_dir = "uploads/";
    if(!empty($_FILES['file']['name'])){
        $file_path = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);
    }
    // Find max roll in this class
    $sql = "SELECT MAX(roll) AS last_roll FROM students WHERE class_id = $class_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $new_roll = $row['last_roll'] + 1;

      if( empty($name)|| empty($class_id)||empty($address)|| empty($gender)|| empty($dob)|| empty($email)|| empty($username) || empty($password)|| empty($parentname)|| empty($parentcontact) || empty($parentemail) ){
      header("Location: add-students.php?error= Please fill all field");
        exit();
       }
    if(!preg_match("/^9\d{9}$/",$parentcontact)){
    header("Location: add-students.php?error=Invalid contact number (10 digits required)");
    exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: add-students.php?error=Invalid email format");
        exit();
    }
      if(!filter_var($parentemail, FILTER_VALIDATE_EMAIL)){
        header("Location: add-students.php?error=Invalid parent's email format");
        exit();
      }
    if(strlen($password) < 6){
        header("Location: add-students.php?error=Password must be at least 6 characters long");
        exit();
    }
    // Insert new student with auto roll
    $sql = "INSERT INTO students 
        (name, class_id, roll,address,gender, dob, email,username, password, parent_name, contact, parent_email,image) 
        VALUES ('$name', '$class_id', '$new_roll','$address', '$gender', '$dob', '$email', '$username', '$hash_password', '$parentname', '$parentcontact', '$parentemail','$file_path')";
    
        if (mysqli_query($conn, $sql)) {
        // ✅ Student added successfully → now send email
          
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
            $mail->Subject = "Student login Details";
            $mail->Body    = "
                <h3>Hello $name,</h3>
                <p>Your account has been created successfully.</p>
                <p><b>Username:</b> $username <br>
                <b>Password:</b> $password</p>
                <p>Please change your password after first login.</p>
            ";

                $mail->send();
              header("Location: add-students.php?success=Added successfully and mailed");
              exit();
          } 
          catch (Exception $e) {
          header("Location: add-students.php?error=Student added, but email could not be sent. Error:{$mail->ErrorInfo}");
         exit();
        }
    } 
    else {
       header("Location: add-students.php?error=Database error:"  . mysqli_error($conn));
         exit();
    }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Students</title>
    <link rel="stylesheet" href="/studentmgt/admin/css/add-students.css">
    <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap.min.css">
</head>
<body>
  <?php include'includes/sidebar.php'?>
  <div class="container">
    <div class="sub-head">
    <h2>Add Students</h2>
    <p><a href="dashboard.php">Dashboard</a>/Add Students</p>
    </div>
  <div class="add-students">
    <form method="post" enctype="multipart/form-data">
      <div>
    <?php
   if(isset($_GET['error'])){?>
    <p class="error"><?php echo $_GET['error'];?></p>
  <?php }?>
   <?php
   if(isset($_GET['success'])){?>
    <p class="success"><?php echo $_GET['success'];?></p>
  <?php }?>
      <label>Name</label>
      <input type="text" name="sts-name"><br>
        <label>Class</label>
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
  <label>Address</label>
  <input type="text" name="sts-address"><br>
   <label>Gender</label>
<div class="gender-group">
  <label>
    <input type="radio" name="sts-gender" value="Male"> Male
  </label>
  <label>
    <input type="radio" name="sts-gender" value="Female"> Female
  </label>
</div>
<br>
       <label>DOB</label>
      <input type="date" name="sts-dob"><br>
      <label>Email</label>
      <input type="email" name="sts-email"><br>
       <label>Username</label>
      <input type="text" name="sts-username"><br>
      <label>Password</label>
      <input type="password" name="sts-pass"><br>
      <label>Image</label>
      <input type="file" name="file"><br>
      </div>
      <div>
       <h4>Parent details</h4><br>
       <label>Patent's name</label>
      <input type="text" name="parent-name"><br>
      <label>Contact</label>
      <input type="tel" name="parent-contact"><br>
      <label>Parent's email</label>
      <input type="email" name="parent-email"><br>
    </div>
      <input type="submit"class="add-btn" value="Add" name="sts-add">
    </form>
  </div>
 </div>  
</body>
</html>