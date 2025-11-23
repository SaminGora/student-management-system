<?php
session_start();
include('../connection.php');

if (isset($_POST['signup'])){
    $username=$_POST['username'];
    $password=$_POST['pass'];
  
    if(empty($username) && empty($password)){
        // $error1 = "Username and password is required";
        
        $_SESSION['error']="username and password is empty";
        header("location:login.php");
        exit();
    }
    else if(empty($username)){
        // $error1 = "Username  is required";
        $_SESSION['error']="username is required";
        header("location:login.php");
       exit();
    }
    else if(empty($password)){
        // $error1 = " password is required";
        $_SESSION['error']="password is required";
        header("location:login.php");
        exit();
    }
    else{
    $sql = "SELECT id, password FROM admin WHERE username = '$username' && password='$password'";
    $result=mysqli_query($conn,$sql);
    if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
             $_SESSION['admin_id'] = $row['id'];
             header("location:dashboard.php");
    }
    else{
        $_SESSION['error']="incorrect username and password";
        header("location:login.php");
    
    }
}
}
?>