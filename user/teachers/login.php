<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="/studentmgt/admin/css/bootstrap-icons.min.css">
     <link rel="stylesheet" href="/studentmgt/user/teachers/css/login.css">
    <title>Admin login</title>
</head>
<body>
     <div class="containers" id="loginform">
        <div class="box">
          <h1>Login</h1>
            <?php 
            
              if(isset($_SESSION['error'])){
                echo ' <p class="error">'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
            }?>
           
          <form id="loginForm" method="POST" action="authentication.php">
              <label>Username </label><br><i class="bi bi-person-circle"></i>
              <input type="text" name="username">
              <br>
              <label>Password</label><br><i class="bi bi-lock-fill"></i>
              <input type="password" name="pass"><br>
              <input type="submit" value="Login" name="signup" class="btn"><br>
          </form>
        </div>
      </div>
</body>
</html>