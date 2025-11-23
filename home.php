<?php
session_start();

// If not logged in → go back to home.php
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link href="css/bootstrap.css">
</head>
<body>

    <div class="banner">
    <?php include("includes/header.php");?>
        <div class="banner-title">
            <div class="title">
            <h1  style=" font-family: cursive";>Welcome to <br>LearnDesk</h1>
            <p>Registered Students Can Login</p>
            </div>
            <a href="#">Login here </a>
            <div class="scl-img">
            <img src="images/download.jpg">
            </div>
        </div>
    </div>
    <a href="logout.php">Log out</a>
    <div class="teachers">
    <h2>Our Teachers</h2>
    <div class="teacher-section">
        <div class="teacher1">
        <img src="images/teacher/1697436278765.jpg">
        <h4>Mr.sachin shresthe</h4>
       </div>
         <div class="teacher2 ">
        <img src="images/teacher/DSC03872.jpg">
        <h4>Mr.sachin shresthe</h4>
        </div>
        <div class="teacher3">
        <img src="images/teacher/DSC05002.jpg">
        <h4>Mr.sachin shresthe</h4>
        </div>
        
    </div>
</div>
    <div class="course">
    <h2>Our Courses</h2>
    <div class="course-section">
        <div class="graphics">
            <h3>Graphics Desiging</h3>
            <p>Learn the art of visual communication through design. This course covers the fundamentals of typography, color theory, layout, and popular tools like Photoshop and Illustrator—perfect for beginners and aspiring designers.</p>
           
        </div>
        <div class="web">
            <h3>Web Development</h3>
            <p>Learn to build modern, responsive websites using HTML, CSS, JavaScript, and popular frameworks. This course is perfect for beginners aiming to become professional web developers.</p>
           
        </div>
        <div class="app">
            <h3>App Development</h3>
            <p>Dive into the world of mobile app creation. Learn how to design, build, and deploy Android and iOS apps using tools like Flutter or React Native—no prior coding experience required.</p>
           
        </div>
    </div>
    </div>
    <div class="public-notice">


    
</div>

    <div class="admission">
      <h2>Admission form</h2>
      <?php 
        session_start();
        if(isset($_SESSION['msg'])){
        echo '<p class="adm-msg">'.$_SESSION['msg'].'</p>';
        unset($_SESSION['msg']);
    } ?> 
      <form action="admission.php" method="POST">
        <label>Student Name:</label>
        <input type="text" name="adm-name" required><br>
        <label>Father Name:</label>
        <input type="text" name="adm-father" required><br>
        <label>Class:</label>
        <input type="number"name="adm-cls"><br>
        <label>Address:</label>
        <input type="text"name="adm-address" required><br>
        <label>Contact Number:</label>
        <input type="tel"name="adm-contact" required><br>
        <label>Email:</label>
        <input type="email"name="adm-email" required><br>
        <input type="submit" value="submit"name="submit"class="submit-btn">
        </form>
</div>
    <?php include("includes/footer.php");?>
</body>
   </html>