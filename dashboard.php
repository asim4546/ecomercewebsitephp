<?php
session_start();

// Check if the user is not logged in, redirect to the login page (login.php)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoesStore</title>
    <link rel="stylesheet" href="main.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

</style>
</head>

<body>
  
  <div class="header-container">
    <p class="navbar-brand">
      <img src="logo.png" alt="">
    </p>
    </div>

   
    <div class="topnav" id="myTopnav">
      <a href="#home" class="active">Home</a>
      <a href="./AddProducts.php">AddProducts</a>
      <a href="Viewproducts.php">view products</a>
      <a href="./logout.php">Log Out</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
  
  
  


    <div class="img-slider">
      <div class="slide active">
        <img src="1.jpg" alt="" >
        <div class="info">
   <br><br> <h2>From out store to your feet</h2>
          
        </div>
      </div>
      <div class="slide">
        <img src="2.jpg" alt="">
        <div class="info">
          <h2>The best shoes at the tip of your fingers.</h2>
        </div>
      </div>
      <div class="slide">
        <img src="3.jpg" alt="">
        <div class="info">
          <h2>We made shoes. </h2><h2>You spread the word.</h2>
        </div>
      </div>
      <div class="slide">
        <img src="4.jpg" alt="">
        <div class="info">
          <h2>Feel the earth beneath your feet.</h2>
          
        </div>
      </div>
      <div class="slide">
        <img src="5.jpg" alt="">
        <div class="info">
          <h2>We make every step comfortable.</h2>
          
        </div>
      </div>
      
      <div class="navigation">
        <div class="btn active"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
      </div>
    </div>

    <script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;

    // Javascript for image slider manual navigation
    var manualNav = function(manual){
      slides.forEach((slide) => {
        slide.classList.remove('active');

        btns.forEach((btn) => {
          btn.classList.remove('active');
        });
      });

      slides[manual].classList.add('active');
      btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
      });
    });

  

    // Javascript for image slider autoplay navigation
    var repeat = function(activeClass){
      let active = document.getElementsByClassName('active');
      let i = 1;

      var repeater = () => {
        setTimeout(function(){
          [...active].forEach((activeSlide) => {
            activeSlide.classList.remove('active');
          });

        slides[i].classList.add('active');
        btns[i].classList.add('active');
        i++;

        if(slides.length == i){
          i = 0;
        }
        if(i >= slides.length){
          return;
        }
        repeater();
      }, 10000);
      }
      repeater();
    }
    repeat();
    </script>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
  </body>
</html>
