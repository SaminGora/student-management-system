<?php
session_start();
include('../../connection.php');

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
    $sql = "SELECT T_id, Role,password FROM teachers WHERE username = '$username'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if ($row && password_verify($password, $row['password'])) {
             $_SESSION['teacher_id'] = $row['T_id'];
             $_SESSION['role'] = $row['Role'];
             header("location:dashboard.php");
    }
    
    else{
        $_SESSION['error']="incorrect username and password";
        header("location:login.php");
    }
}
}
?>