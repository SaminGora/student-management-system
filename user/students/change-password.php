<?php
include_once('../connection.php');

if (isset($_POST['update-password'])){
    $sql="SELECT password from admin";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $password=$row['password'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm=$_POST['confirm_password'];
  
    if($password==$old_password){
        if($new_password==$confirm){
        $sql="UPDATE students set password='$new_password'";
         if(mysqli_query($conn, $sql)){
            header("Location:change-password.php?success=updated successfully");
            exit();
           }
            else {
             header("Location:change-password.php?error= Database error");
             exit();
            }
        }else{
            header("Location:change-password.php?error= password must be same");
            exit(); 
        }
    }else{
       header("Location:change-password.php?error=incorrect password");
            exit(); 
    }
   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/studentmgt/user/students/css/changepassword.css">
    <title>password</title>
</head>
<body>
  <?php include'includes/sidebar.php'?>
       <div class="container">
    <h2>Change Password</h2>
  <div class="change-password">
    <form method="post">
    <?php
    if(isset($_GET['error'])){?>
        <p class="error"><?php echo $_GET['error'];?></p>
    <?php }?>
    <?php
    if(isset($_GET['success'])){?>
        <p class="success"><?php echo $_GET['success'];?></p>
    <?php }?>
     <script>
        // Remove ?success=... or ?error=... from URL after displaying once
        if (window.location.search.includes('success=') || window.location.search.includes('error=')) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        </script>
        <label>Old Password</label>
        <input type="password" id="oldpassword" name="old_password" required> <i class="bi bi-eye toggle"data-target="oldpassword"></i> <br>
        <label>New Password</label>
        <input type="password" id="newpassword" name="new_password" required> <i  class="bi bi-eye toggle" data-target="newpassword"></i><br>
        <label>Confirm Password</label>
        <input type="password"  id="confirmpassword" name="confirm_password"> <i  class="bi bi-eye toggle"data-target="confirmpassword"></i><br>
        <input type="submit"class="add-btn" value="Update Password"name="update-password">
    </form>
  </div>
 </div> 
 <script>
    const toggle=document.querySelectorAll('.toggle');
    
   toggle.forEach(icon=>{
        icon.addEventListener('click',function(){
            const targetid=icon.getAttribute('data-target');
            const input=document.getElementById(targetid);

             const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
        });
    });

//     toggle.addEventListener('click', () => {
//    const isPassword = pass.type === 'password';
//     pass.type = isPassword ? 'text' : 'password';

//     toggle.classList.toggle('bi-eye');
//     toggle.classList.toggle('bi-eye-slash');
//     });
 </script>
</body>
</html>