<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="css/bootstrap-icons.min.css"> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="aos.css">
</head>
<body>
   <?php
    include 'includes/header.php';
    ?>
    <div class="containers" id="loginform" style="<?php echo isset($_SESSION['error']) ? 'display:block;' : 'display:none;';?>">
        <div class="box">
          <i class="bi bi-x-square close-icon"></i>
          <h1>Login</h1>
              <p class="error" id="loginError" style="color:red;">
                <?php 
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                } 
                ?>
                </p> 
           
          <form id="loginForm" method="POST" action="sts-authentication.php">
              <label>Username</label><br><i class="bi bi-person-circle"></i>
              <input type="text" name="username">
              <br>
              <label>Password</label><br> <i id="toggle" class="bi bi-eye"></i>
              <input type="password" id="password" name="pass"><br>
              <input type="submit" value="Login" name="signup" class="btn"><br>
          </form>
          <script>
          
          </script>
        </div>
      </div>
   <div class=" main">
       <div  data-aos="fade-down" class="background">
           <h1 > Himalayan Glory <br> English School</h1>
           <p>providing best education with great educational environment</p><br>
            <p>Registered students can login here</p> 
            <button id="loginbtn" data-aos="fade-right" data-aos-duration="700"> Log in </button>
       </div>
   </div>
   <div class="second">
    <div  class="image"  data-aos="fade-right"data-aos-duration="700">
    <img src="./images/Principal.jpg" >
    <h2> Krishna Ram Twanabasu</h2>
    <p>Principle - Himalayan Glory English School</p>
    </div>
    <div  class=" description"  data-aos="fade-right"data-aos-duration="700">
        <h2>Himalayan Glory : A leading exampler</h2>
    <p>
    With the name of Twinkle primary school, It was established on 26th Falgun 2037 B.S. (1981 A.D.) with  pre-primary classes. Later it got permission on Falgun 2046B.S. to run class from 1 to 5. As well as on 14th Shrawan 2046, with the formal decision of all committee of school, the school name was changed to Himalayan Glory English School. Again the success and development of school lead to lower secondary school from 6 to 8 on 10th Falgun 2064. It got permission to run secondary level (up to class 10) on 11th Asar 2067 with the objectives of qualitative education. Even though, the school is registered in Company act (according to government law) it is non-profit, service oriented institution as it is totally based on local society. It has been running for providing qualitative education at affordable fees. It is the leading exemplar for all institutional school as more than 200 local people contribute and invest to establish it. Simply Himalayan Glory English School is a community based private institutional school established by local society for them.
    </p>
        
    </div>
  </div>
   <div class="grid">
      <div class="div"data-aos="fade-up" data-aos-duration="600"><h1 class="counter" data-target="500">0</h1><p>Students</p></div>
      <div class="div"data-aos="fade-up"data-aos-duration="600"><h1 class="counter" data-target="40">0</h1><p>Dedicated Teachers</p></div>
      <div class="div"data-aos="fade-up"data-aos-duration="600"><h1 class="counter" data-target="300">0</h1><p>SLC/ SEE Passed Out Students</p></div>
      <div class="div"data-aos="fade-up"data-aos-duration="600"><h1 class="counter" data-target="100">0</h1><p>Success Rate</p></div>
</div>
 <script src="aos.js"></script>
 <script src="index.js"></script>
   <div class=" header"> 
    <h1> Why to choose us?</h1>
   </div>
   <div class=" grid-section">
    <div class="section"> 
        <img src="./images/Quality eductaion.jpg">
        <h2> Quality Education</h2>
    </div>
    <div class="section">
        <img src="./images/music class.jpg">
        <h2>Music Classes</h2>
    </div>
    <div class="section">
        <img src="./images/dance class.jpg">
        <h2>Dance Classes</h2>
    </div>
    <div class="section">
        <img src="./images/sports.jpg">
        <h2>Sports</h2>
    </div>
    <div class="section">
        <img src="./images/japanese class.jpg">
        <h2>Japanese Classes</h2>
    </div>
    <div class="section">
        <img src="./images/scout.jpg">
        <h2> Scout Education</h2>
    </div>
    <div class="section">
        <img src="./images/DRR.jpg">
        <h2>DRR Classes</h2>
    </div>
    <div class="section">
        <img src="./images/sports.jpg">
        <h2>Other Extracurricular Activities</h2>
    </div>
   </div>
   <div class="team">
     <h1> Meet Our Dedicated Team</h1>
   </div>
   <div class="meet-team">
      <div class="members">
        <img src="./images/director.jpg">
        <h2>Asharam Baidhya </h2>
        <p> Director</p>
      </div>
      <div class="members">
        <img src="./images/Principal.jpg">
        <h2> Krishna Ram Twanabasu</h2>
        <p> Principal</p>
      </div>
      <div class="members">
        <img src="./images/shyamsundar.jpg">
        <h2> Shyam Sundar Matang</h2>
        <p> Administrator</p>
      </div>
      <div class="members">
        <img src="./images/kamalsuwal.jpg">
        <h2> Kamal Suwal</h2>
        <p> Administrator</p>
      </div>
   </div>
<!-- <button> SEE MORE</button> -->
 <section class="testimonial-section"  data-aos="fade-right"data-aos-duration="1000">
    <h2>What Our Ex-Students say?</h2>
    <p>
      From the year 2066 until today, more than 250 students from different 12 batches complete their 
      SLC/SEE degree from this school and are engaged in higher education studies. 
      The words of some former students are given here.
    </p>
  </section>

  <section class="testimonial-cards">
    <div class="testimonial-card card1"  data-aos="flip-right"data-aos-duration="800">
      <p>“Himalayan Glory has been my second home. The teachers are amazing, and I’ve learned so much—not just in studies but in life too!”</p>
      <div class="testimonial-footer">
        <img src="./images/redisha.jpg" alt="Redisha Jakibanjan">
        <div>
          <h4>Redisha Jakibanjan</h4>
          <span>SLC Batch 2067</span>
        </div>
      </div>
    </div>

    <div class="testimonial-card card2" data-aos="flip-right"data-aos-duration="800">
      <p>“I love how Himalayan Glory encourages us in both academics and ECA. I’ve grown confident through stage programs, sports, and competitions!”</p>
      <div class="testimonial-footer">
        <img src="./images/rejina.jpg" alt="Rejina Garu">
        <div>
          <h4>Rejina Garu</h4>
          <span>SLC Batch 2069</span>
        </div>
      </div>
    </div>

    <div class="testimonial-card card3"  data-aos="flip-right"data-aos-duration="800">
      <p>“Himalayan Glory School made learning fun and meaningful. I’ll always be proud to be a part of this wonderful institution.”</p>
      <div class="testimonial-footer">
        <img src="./images/sushil.jpg" alt="Sushil Dyopala">
        <div>
          <h4>Sushil Dyopala</h4>
          <span>SLC Batch 2070</span>
        </div>
      </div>
    </div>
  </section>
    <?php
    include 'includes/footer.php';
    ?>
 
</body>
</html>