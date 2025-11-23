<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
    footer{
        background-color: rgb(3, 3, 3);
        height:auto;
        margin-top:5em;
       padding: 4em;
    }
    .logo img{
        width: 15em;
        height: 10em;
    }
    .logo h2{
        color: aliceblue;
    }
    
    footer{
        display: grid;
        grid-template-rows:1fr;
        grid-template-columns:repeat(3,2fr);
       
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
        font-size: 1.5em;
    }
     ul li a:hover{
        color: rgb(94, 94, 236);
    }
    .footer p{
        color: white;
       font-size:15px;
    }
    .follow h3{
        color: white;
    }
     #copyright{
        color:white;
        grid-column: 1 / -1;   /* spans all 3 columns */
        text-align: center;
    }
    @media only screen and (max-width: 600px) {
        footer{
            grid-template-columns:1fr;
            height:auto;
            text-align:center;
        }
    }
 </style>
</head>
<body>
    <footer>
    <div class="logo">
        <h2>Himalayan Glory English School</h2>
        <img src="./images/logo.png" alt="" class="logo">
        <div class="footer">
            <p> Himalayan Glory English School is affiliated to NEB Nepal. It impacts education in School level as well as in  Extra Ciruculam Activities(ECA)</p>
            <p>
            TEL : 01-6618760,9812345678<br>
            E-mail :hges@gmail.com</p>
        </div>
    </div>
    <div class="follow">
        <h3>Follow Us</h3>
    </div>
    <div class="menu">
        <ul>
            <h2>Menu</h2>
            <li>  <a href="about.html">Home</a></li>
            <li>  <a href="about.html">About</a></li>
            <li>  <a href="contact.html">Contact</a></li>
        </ul>
    </div>
     <p id="copyright">Copyright &copy2025 Himalayan Glory | Developed By Samin. Powered by ABC Enterprise.</p>
    </footer>
    
</body>
</html>