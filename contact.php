<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
nav .logo{
  width:8em ;
  height:5em;
}
nav{
  display: flex;
  justify-content: space-evenly;
  align-items: center;
 background-color: aqua;
  top: 0;
  left: 0;
  right: 0;
}
nav ul{
   display: flex;
   gap: 2em;
}
ul li{
        list-style: none;
    }
    ul h2{
        color: antiquewhite;
        font-size: 2em;
    }
    ul li a{
        text-decoration: none;
        color: white;
        font-size: 2em;
        position: relative;
    }
ul li a::after {
  content: "";             /* Required for pseudo-element */
  position: absolute;
  left: 0;
  bottom: 0;               /* Position underline at the bottom */
  width: 0;
  height:2px;             /* Thickness of underline */
  background: red;         /* Underline color */
  transition: 0.5s ease;   /* Smooth animation */
}
    ul li a:hover{
        color: rgb(0, 0, 0);
    }
    ul li a:hover::after {
  width: 100%;             /* Expand underline on hover */
}
       .contact{
         margin: 4em 20em;
        
       }
        label{
            font-size: 2em;
        }
        span{
            font-size: small;
            color: red;
        }
        input{
            width: 35em;
            height: 1.5em;
            padding: 8px 0;
        }
        textarea{
            width: 35em;
            height: 10em;
        }
        .submit{
            width: 10em;
            height: 3em;
            border: none;
            border-radius: 8px;
            outline: none;
            background-color: rgb(126, 126, 234);
        }
        .submit:hover{
            background-color: rgb(88, 88, 232);
        }
        .map{
            margin:0 20em;
        }
        /* .detail{
            display: grid;
            grid-template-columns: 3fr 1fr 1fr;
            align-items: center;
            margin: 0 20em 4em 20em;
            background-color: rgb(38, 35, 35);
            width: 50%;
            height: 20vh;
        } */
       .detail {
        display: grid;
        grid-template-columns: repeat(3,2fr);
        align-items: center;
        margin: 0 auto 4em auto; /* center horizontally */
        background-color: rgb(38, 35, 35);
        width: 70%; /* a bit wider */
        padding: 20px; /* inner spacing */
        color: white; /* text visible on dark background */
        border-radius: 10px; /* optional rounded corners */
        }
        footer{
            background-color: black;
            color: white;
            text-align: center;
            padding:25px 0;
        }
    </style>
</head>
<body>
     <nav>
    <div>
    <img src="./images/logo.png" alt="" class="logo">
    </div>
    <div>
      <ul>
            <li>  <a href="index.php">Home</a></li>
            <li>  <a href="about.php">About</a></li>
            <li>  <a href="contact.php">Contact</a></li>
        </ul>
    </div>
  </nav>
    <div class="contact">
        <h1>Contact Us</h1>
    <form>
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