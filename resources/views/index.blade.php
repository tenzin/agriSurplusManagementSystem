<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <title>Crop-SMS</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css">
      <!-- CUSTOM STYLE -->
      <link rel="stylesheet" href="css/template-style.css">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="js/template-scripts.js"></script> 
   </head>
   <body class="size-1140">
  	  <!-- PREMIUM FEATURES BUTTON -->
  	  <a target="_blank" class="hide-s" href="../template/onepage-premium-template/" style="position:fixed;top:130px;right:-14px;z-index:10;"><img src="img/premium-features.png" alt=""></a>
      <!-- TOP NAV WITH LOGO -->
      <header>
         <div id="topbar" class="hide-s hide-m">
              
         </div> 
         <nav>
            <div class="line">
               <div class="s-12 l-2">
                  <p class="logo">C-SMS</p>
               </div>
               <div class="top-nav s-12 l-10">
                  
                  <ul class="right">
                     <li class="active-item"><a href="#carousel">Home</a></li>
                     <li><a href="#features">Process</a></li>
                     <li><a href="#services">Services</a></li>
                     <li><a href="#contact">Contact</a></li>
                     <li><a href="{{url('login')}}">Login</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>  
      <section>
         <div id="map-block">  	  
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1247814.3661917313!2d16.569872019090596!3d48.23131953825178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c8cbf758ecb9f%3A0xddeb1d26bce5eccf!2sGallayova+2150%2F19%2C+841+02+D%C3%BAbravka!5e0!3m2!1ssk!2ssk!4v1440344568394" width="100%" height="450" frameborder="0" style="border:0"></iframe>
         </div>
         <!-- FIRST BLOCK -->
         <div id="first-block">
            <div class="line">
               <h1>What is C-SMS?</h1>
               <p>C-SMS is the Crop-Surplus Management System that will help to mange the surplus and market value to some place that
                   have no crop production</p>
               <div class="s-12 m-4 l-2 center"><a class="white-btn" href="#features">Click the Process</a></div>
            </div>
         </div>
         <!-- FEATURES -->
         <div id="features">
            <div class="line">
               <div class="margin">
                  <div class="s-12 m-6 l-3 margin-bottom">
                     <img src="{{asset('images/login.jpg')}}">
                     <h2>Login to System</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                  </div>
                  <div class="s-12 m-6 l-3 margin-bottom">
                  <img src="{{asset('images/surplus.jpg')}}">                    
                    <h2>Manage the Surplus</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat adipiscing.</p>
                  </div>
                  <div class="s-12 m-6 l-3 margin-bottom">
                  <img src="{{asset('images/interaction.jpg')}}">
                     <h2>Market Interaction</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna erat volutpat.</p>
                  </div>
                  <div class="s-12 m-6 l-3 margin-bottom">
                  <img src="{{asset('images/demand.jpg')}}">
                     <h2>Market Demand</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat nonummy.</p>
                  </div>
               </div>
            </div>
         </div>
         <!-- SERVICES -->
         <div id="services">
            <div class="line">
               <h2 class="section-title">What System do</h2>
               <div class="margin">
                  <div class="s-12 m-6 l-4 margin-bottom">
                  <img src="{{asset('images/management.jpg')}}">
                     <div class="service-text">
                        <h3>Surplus Management</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
                  <div class="s-12 m-6 l-4 margin-bottom">
                  <img src="{{asset('images/graph_icon.png')}}">
                     <div class="service-text">
                        <h3>We look to the Market Demand</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
                  <div class="s-12 m-12 l-4 margin-bottom">
                  <img src="{{asset('images/production.png')}}">
                     <div class="service-text">
                        <h3>Market for Crop Production</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
         <!-- CONTACT -->
         <div id="contact">
            <div class="line">
               <h2 class="section-title">Contact Us</h2>
               <div class="margin">
                  <div class="s-12 m-12 l-4 margin-bottom right-align">
                     <h3>Ministry Of Agriculture and Forests</h3>
                     <h>Department of Agriculture</h4>
                     <h5>Crop-Surplus Management System</h5>
                     <address>
                        <p><strong>Adress:</strong> Tashichho Dzong</p>
                        <p><strong>Post Box:</strong> 123</p>
                        <p><strong>Contact:</strong> +975-1745664/02-343457</p>
                        <p><strong>E-mail:</strong> info@tenzi.gmail</p>
                     </address>
                  </div>               
               </div>
            </div>
         </div>
      </section>

      <!-- FOOTER -->
      <footer>
         <div class="line">
            <div class="s-12 l-6">
               <p>Copyright 2020, Department of Agriculture</p>
               <p>Ministry of Agriculture and Forests</p>
            </div>
            <div class="s-12 l-6">
               <a class="right" href="http://www.moaf.gov.bt/" title="Responsee - lightweight responsive framework"><strong>Ministry of Agriculture and Forests</strong></a>
            </div>
         </div>
      </footer>

      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
            var theme_slider = $("#owl-demo");
            var owl = $('#owl-demo');
            owl.owlCarousel({
              nav: false,
              dots: true,
              items: 1,
              loop: true,
              autoplay: true,
              autoplayTimeout: 6000
            });
            var owl = $('#owl-demo2');
            owl.owlCarousel({
              nav: true,
              dots: false,
              items: 1,
              loop: true,
              navText: ["&#xf007","&#xf006"],
              autoplay: true,
              autoplayTimeout: 4000
            });
        
            // Custom Navigation Events
            $(".next-arrow").click(function() {
                theme_slider.trigger('next.owl');
            })
            $(".prev-arrow").click(function() {
                theme_slider.trigger('prev.owl');
            })     
        }); 
      </script>
   </body>
</html>