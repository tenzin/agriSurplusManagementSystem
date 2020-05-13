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
      <!-- MAP STYLE -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" type="text/css">
      <style>
        .map {
          height: 730px;
          width: 90%;
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
        .ol-popup {
          position: absolute;
          background-color: white;
          box-shadow: 0 1px 4px rgba(0,0,0,0.2);
          padding: 15px;
          border-radius: 10px;
          border: 1px solid #cccccc;
          bottom: 12px;
          left: -50px;
          min-width: 280px;
          }
          .ol-popup:after, .ol-popup:before {
          top: 100%;
          border: solid transparent;
          content: " ";
          height: 0;
          width: 0;
          position: absolute;
          pointer-events: none;
          }
          .ol-popup:after {
          border-top-color: white;
          border-width: 10px;
          left: 48px;
          margin-left: -10px;
          }
          .ol-popup:before {
          border-top-color: #cccccc;
          border-width: 11px;
          left: 48px;
          margin-left: -11px;
          }
          .ol-popup-closer {
          text-decoration: none;
          position: absolute;
          top: 2px;
          right: 8px;
          }
          .ol-popup-closer:after {
          content: "x";
          }
      </style>
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
                  <p class="logo">VMIS</p>
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
        <!-- Map Block -->
         <div id="map" class="map"></div>
         <div id="popup" class="ol-popup">
           <a href="#" id="popup-closer" class="ol-popup-closer"></a>
           <div id="popup-content"></div>
         </div>
         <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
         <script type="text/javascript">
          var map = new ol.Map({
              target: 'map',
              layers: [
                  new ol.layer.Tile({
                  source: new ol.source.OSM()
                })
              ],
              view: new ol.View({
                  center: ol.proj.fromLonLat([90.46,27.60]),
                  zoom: 8.89
              })
          });

          var gewog_name = ['Chokhor', 'Ura', 'Tang', 'Chhume'];
          var long = [90.71112766300, 90.91560670800, 90.87104712900, 90.69937767200];
          var lat = [27.60460129980, 27.48790712980, 27.57078822880, 27.49359672880];
          var pointerFeatures = [];

          gewog_name.forEach(createFeatures);
          function createFeatures(value, index, array) {
            feature = new ol.Feature({
              geometry: new ol.geom.Point(ol.proj.fromLonLat([long[index],lat[index]])),
              ID: gewog_name[index],
              gewog_name: 'Gewog: ' + gewog_name[index]
            });
            console.log(feature.get('gewog_name'));
            pointerFeatures.push(feature);
          }

          // create the marker stylesheet
          var iconStyle = new ol.style.Style({
            image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
              anchor: [0.5, 46],
              anchorXUnits: 'fraction',
              anchorYUnits: 'pixels',
              //opacity: 0.75,
              src: '../../images/extension.png'
            }))
          });

          var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
              features: pointerFeatures,
            }),
            style: iconStyle
          });

        map.addLayer(layer);

        layer.getSource().forEachFeature(test_on_console);
        function test_on_console(feature) {
          console.log(feature.get('gewog_name'));
        }

        //trypopup
        //var container = document.getElementById('popup');

        var container = document.getElementById('popup');
        var content = document.getElementById('popup-content');
        var closer = document.getElementById('popup-closer');


        var overlay = new ol.Overlay({
          element: container
        });
        map.addOverlay(overlay);

        map.on('click', function(event) {
          map.forEachFeatureAtPixel(event.pixel, function(feature,layer) {
            var coordinate = event.coordinate;
          //  var content = document.getElementById('popup');
          //  content.innerHTML = '<p>Position:'+coordinate+'</p><code>' +feature.get('ID') + '</code>';
          //content = '<p>Position:'+coordinate+'</p><code>' +feature.get('ID') + '</code>';
          content.innerHTML= '<p>Gewog: '+feature.get('ID')+ '<br> Surplus: </p>' ;
          overlay.setPosition(coordinate);
              // console.log("ID: " + feature.get('ID'));
              // alert("You clicked on " + feature.get('ID'));

            });
        });

        closer.onclick = function() {
          overlay.setPosition(undefined);
          closer.blur();
          return false;
        };

        //end trypopup

        </script>

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
