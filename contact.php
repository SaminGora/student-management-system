<?php 
include 'connection.php';
if(isset($_POST['submit'])){
 $name    = trim($_POST['name']);
    $address = trim($_POST['address']);
    $contact = trim($_POST['contact']);
    $email   = trim($_POST['email']);
    $comment = trim($_POST['comment']);

    if(!preg_match("/^9\d{9}$/",$contact)){
    header("Location:contact.php?error=Invalid contact number (10 digits required)");
    exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location:contact.php?error=Invalid email format");
        exit();
    }
    $sql="INSERT INTO contact(name,address,contact,email,comment)values('$name','$address','$contact','$email','$comment')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header("location:contact.php?success=successfull");
        exit();
    }
    else{
         header("location:contact.php?error=Error");
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            body {
                font-family: sans-serif; /* Added for better default */
            }

            nav .logo {
                width: 8em;
                height: 5em;
                object-fit: contain; /* Ensure logo doesn't distort */
            }

            nav {
                display: flex;
                justify-content: space-between; /* changed from space-evenly for better edge control */
                align-items: center;
                background-color: #34495e;
                padding: 0 5%;
                min-height: 10vh; /* Ensure nav has height */
            }

            nav ul {
                display: flex;
                gap: 2em;
                padding: 0;
            }

            ul li {
                list-style: none;
            }

            ul li a {
                text-decoration: none;
                color: white;
                font-size: 1.2em; /* Reduced from 2em which is quite large */
                position: relative;
                transition: color 0.3s;
            }

            ul li a::after {
                content: "";
                position: absolute;
                left: 0;
                bottom: -5px;
                width: 0;
                height: 2px;
                background: red;
                transition: 0.5s ease;
            }

            ul li a:hover {
                color: #ddd;
            }

            ul li a:hover::after {
                width: 100%;
            }

            /* Container for Form */
            .contact {
                width: 90%;
                max-width: 800px;
                margin: 4em auto;
            }

            .contact h1 {
                text-align: center;
                margin-bottom: 1em;
            }
            
            label {
                font-size: 1.2em; /* Adjusted */
                display: inline-block;
                margin-top: 1em;
            }

            span {
                font-size: small;
                color: red;
            }

            input, textarea {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 1rem;
            }

            textarea {
                height: 10em;
                resize: vertical;
            }

            .submit {
                width: 100%;
                max-width: 150px;
                height: 3em;
                border: none;
                border-radius: 8px;
                outline: none;
                background-color: rgb(126, 126, 234);
                color: white;
                font-size: 1em;
                cursor: pointer;
                margin-top: 1.5em;
                display: block;
            }

            .submit:hover {
                background-color: rgb(88, 88, 232);
            }

            /* Map Section */
            .map {
                width: 90%;
                max-width: 1000px;
                margin: 2em auto;
                text-align: center;
            }

            .map iframe {
                width: 100%;
                height: 450px;
                max-height: 50vh;
            }

            /* Details Section */
            .detail {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                align-items: center; /* Center items vertically */
                justify-items: center; /* Center items in their grid cells */
                margin: 0 auto 4em auto;
                background-color: rgb(38, 35, 35);
                width: 90%;
                max-width: 1000px;
                padding: 20px;
                color: white;
                border-radius: 10px;
                text-align: center; /* Center text within divs */
            }

            footer {
                background-color: black;
                color: white;
                text-align: center;
                padding: 25px 0;
            }

            .error, .success {
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1.5rem;
                text-align: center;
                font-weight: 500;
            }

            .error {
                background-color: #fce8e6;
                color: red;
                border: 1px solid rgba(231, 76, 60, 0.2);
            }

            .success {
                background-color: #e8f8f5;
                color: green;
                border: 1px solid rgba(46, 204, 113, 0.2);
            }

            /* Responsive Media Queries */
            @media (max-width: 768px) {
                nav {
                    flex-direction: column;
                    padding: 1em;
                }
                
                nav ul {
                    flex-direction: column; /* Stack menu items */
                    gap: 1em;
                    margin-top: 1em;
                    align-items: center;
                }

                .contact, .map, .detail {
                    width: 95%;
                }

                label {
                    font-size: 1.1em;
                }
                
                .map iframe {
                    height: 300px;
                }
            }
            </style>
</head>

<body>
     <nav>
    <div>
    <img src="./images/logo.png" alt="logo" class="logo">
    </div>
    <div>
      <ul>
            <li>  <a href="index.php">Home</a></li>
            <li>  <a href="contact.php">Contact</a></li>
            <li>  <a href="./admin/login.php">Admin</a></li>
            <li>  <a href="\studentmgt\user\teachers\login.php">Teacher</a></li>
        </ul>
    </div>
  </nav> 
 
    <div class="contact">
        <h1>Contact Us</h1>
        <?php 
        if(isset($_GET['error'])){?>
        <p class="error"><?php echo $_GET['error'];?></p>
       <?php }
        ?> <?php 
        if(isset($_GET['success'])){?>
        <p class="success"><?php echo $_GET['success'];?></p>
       <?php }
        ?>
    <form method="post">
        <label>Name<span>*</span></label><br>
        <input type="text"name="name" required><br>
        <label>Address<span>*</span></label><br>
        <input type="text"name="address" required><br>
        <label>Contact<span>*</span></label><br>
        <input type="number"name="contact" required><br>
        <label>Email<span>*</span></label><br>
        <input type="email"name="email" required><br>
       <label>Comment or Message<span>*</span></label><br>
       <textarea required ></textarea><br>
        <input type="submit"class="submit" value="Submit"name="submit">
    </form>
    </div>
    <div class="map">
     <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.007802289502!2d85.3240!3d27.7172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDQzJzAyLjAiTiA4NcKwMTknMjcuNiJF!5e0!3m2!1sen!2snp!4v1632141200000"
    width="750"
    height="450"
    style="border:0;"
    allowfullscreen=""
    loading="lazy">
  </iframe>
    </div>
    <div class="detail">
        <div class="address">
          <p>Sahidsmriti Khelmaidan, Ittachhen-2
          Bhaktapur, Nepal</p>
        </div>
        <div class="contact">
            <p>Tel:01-6618760,9812345678</p>
        </div>
        <div class="email">
            <p>Email:hegs@gmail.com</p>
        </div>
    </div>
    <footer>
        <p>Copyright &copy2025 Himalayan Glory | Developed By Samin. Powered by ABC Enterprise.</p>
    </footer>
</body>
</html>