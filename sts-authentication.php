<?php
session_start();
include('connection.php');

if (isset($_POST['signup'])){
    $username=$_POST['username'];
    $password=$_POST['pass'];
  
    if(empty($username) && empty($password)){
        // $error1 = "Username and password is required";
        
        $_SESSION['error']="username and password is empty";
        header("location:index.php");
        exit();
    }
    else if(empty($username)){
        // $error1 = "Username  is required";
        $_SESSION['error']="username is required";
        header("location:index.php");
       exit();
    }
    else if(empty($password)){
        // $error1 = " password is required";
        $_SESSION['error']="password is required";
        header("location:index.php");
        exit();
    }
    else{
    $sql = "SELECT student_id,class_id, password FROM students WHERE username = '$username'";
    $result=mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($result);
        if ($row && password_verify($password, $row['password'])) {
             $_SESSION['student_id'] = $row['student_id'];
             $_SESSION['class_id'] = $row['class_id'];
             header("location:user/students/dashboard.php");
    }
    else{
        $_SESSION['error']="incorrect username and password";
        header("location:index.php");
    
    }
}
}
?>