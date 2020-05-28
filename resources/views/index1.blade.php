<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>V-MIS</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">

   <!-- MAP STYLE -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" type="text/css">
      <style>
        .map {
          height: 700px;
          width: 100%;
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

<body id="page-top">
  <!-- Navigation -->
  
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">V-MIS</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          {{-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
              @if(Auth::check())
                <a class="nav-link js-scroll-trigger" href="{{url('/dashboard')}}">Dashboard</a>
                 @else
                    <a class="nav-link js-scroll-trigger"href="{{url('login')}}">Login</a>
                @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead -->
   <header class="bg-info py-5">
  </header>
   <div id="map" class="map"></div>
         <div id="popup" class="ol-popup">
           <a href="#" id="popup-closer" class="ol-popup-closer"></a>
           <div id="popup-content"></div>
         </div></br>
       
       <div class="row align-items-center justify-content-center text-center"> 
         <div class="align-self-baseline">
           <label><input type='checkbox' onclick='handleClickGewogExtension(this);'>&nbsp;Gewog Extension</label>&nbsp;&nbsp;&nbsp;
           <label><input type='checkbox' onclick='handleClickFG(this);'>&nbsp;Farmer's Group</label>&nbsp;&nbsp;&nbsp;
           <label><input type='checkbox' onclick='handleClickLUC(this);'>&nbsp;Land User Certificate</label>&nbsp;&nbsp;&nbsp;
           <label><input type='checkbox' onclick='handleClickCA(this);'>&nbsp;Commercial Aggregator</label>&nbsp;&nbsp;&nbsp;
           <!--<label><input type='checkbox' onclick='handleClickVSC(this);'>&nbsp;Vegetable Supply Company</label>&nbsp;&nbsp;&nbsp; -->
        </div> 
      </div>
    

  <!-- Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Contact Us</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Give us a Call or Send us an Email for any Enquiry!</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>+975-2-322228</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <div>test@test.com</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">&copy; 2020 - Department Of Agriculture, MoAF</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

  <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
    <script type="text/javascript">
          //Start of Map
          var map = new ol.Map({
              target: 'map',
              layers: [
                  new ol.layer.Tile({
                  source: new ol.source.OSM()
                })
              ],
              view: new ol.View({
                  center: ol.proj.fromLonLat([90.46,27.38]),
                  zoom: 8.8
              }),
              controls: [], //These options disable map scroll
              interactions: []
          });

          var gewog_extension_layer; //Gewog Extension Layer 
          var luc_layer; // Land User Certificate Layer
          var fg_layer; //Farmer Group Layer
          var ca_layer; //Commercial Aggregator Layer

          //Extension Map
          function show_gewog_extension_layer() {
            if(typeof gewog_extension_layer == 'undefined') {
              var pointerFeatures = [];

              const create_gewog_extension_layer = async () => {
                const response = await fetch('gewog_extension_map');
                const json = await response.json();
                json.data.forEach(function(value, index, array){
                  feature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([array[index].longitude, array[index].latitude])),
                    type: 'Gewog Extension',
                    place_type: 'Gewog',
                    place_name: array[index].gewog,
                    name: array[index].name,
                    contact: array[index].contact_number,
                    surplus_quantity: array[index].surplus_quantity
                  });
                  pointerFeatures.push(feature);
                })                
                var iconStyle = new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 46],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    //opacity: 0.75,
                    src: '../../images/extension.png'
                  }))
                });
                gewog_extension_layer = new ol.layer.Vector({
                  name: 'Gewog Extension',
                  source: new ol.source.Vector({
                    features: pointerFeatures,
                  }),
                  style: iconStyle
                });
                console.log('adding layer');
                map.addLayer(gewog_extension_layer);
              }
              create_gewog_extension_layer();
            }
            else {
              map.addLayer(gewog_extension_layer);
            }
          }

          //LUC Map
          function show_luc_layer() {
            if(typeof luc_layer == 'undefined') {
              var pointerFeatures = [];

              const create_luc_layer = async () => {
                const response = await fetch('luc_map');
                const json = await response.json();
                json.data.forEach(function(value, index, array){
                  feature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([array[index].longitude, array[index].latitude])),
                    type: 'Land User Certificate',
                    place_type: 'Gewog',
                    place_name: array[index].gewog,
                    name: array[index].name,
                    contact: array[index].contact_number,
                    surplus_quantity: array[index].surplus_quantity
                  });
                  pointerFeatures.push(feature);
                })                
                var iconStyle = new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 46],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    //opacity: 0.75,
                    src: '../../images/luc.png'
                  }))
                });
                luc_layer = new ol.layer.Vector({
                  name: 'LUC',
                  source: new ol.source.Vector({
                    features: pointerFeatures,
                  }),
                  style: iconStyle
                });
                map.addLayer(luc_layer);
              }
              create_luc_layer();
            }
            else {
              map.addLayer(luc_layer);
            }
          }

          //FG Map
          function show_fg_layer() {
            if(typeof fg_layer == 'undefined') {
              var pointerFeatures = [];

              const create_fg_layer = async () => {
                const response = await fetch('fg_map');
                const json = await response.json();
                json.data.forEach(function(value, index, array){
                  feature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([array[index].longitude, array[index].latitude])),
                    type: 'Farmer Group',
                    place_type: 'Gewog',
                    place_name: array[index].gewog,
                    name: array[index].name,
                    contact: array[index].contact_number,
                    surplus_quantity: array[index].surplus_quantity
                  });
                  pointerFeatures.push(feature);
                })                
                var iconStyle = new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 46],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    //opacity: 0.75,
                    src: '../../images/fg.png'
                  }))
                });
                fg_layer = new ol.layer.Vector({
                  name: 'FG',
                  source: new ol.source.Vector({
                    features: pointerFeatures,
                  }),
                  style: iconStyle
                });
                map.addLayer(fg_layer);
              }
              create_fg_layer();
            }
            else {
              map.addLayer(fg_layer);
            }
          }

          //CA Map
          function show_ca_layer() {
            if(typeof ca_layer == 'undefined') {
              var pointerFeatures = [];

              const create_ca_layer = async () => {
                const response = await fetch('ca_map');
                const json = await response.json();
                json.data.forEach(function(value, index, array){
                  feature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([array[index].longitude, array[index].latitude])),
                    type: 'Commercial Aggregator',
                    place_type: 'Dzongkhag',
                    place_name: array[index].dzongkhag,
                    name: array[index].name,
                    contact: array[index].contact_number,
                    surplus_quantity: array[index].surplus_quantity
                  });
                  pointerFeatures.push(feature);
                })                
                var iconStyle = new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 46],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    //opacity: 0.75,
                    src: '../../images/ca.png'
                  }))
                });
                ca_layer = new ol.layer.Vector({
                  name: 'CA',
                  source: new ol.source.Vector({
                    features: pointerFeatures,
                  }),
                  style: iconStyle
                });
                map.addLayer(ca_layer);
              }
              create_ca_layer();
            }
            else {
              map.addLayer(ca_layer);
            }
          }



        //popup
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
            content.innerHTML = "<center><b><u>" + feature.get('type') + "</u></b></center>" + 
                                feature.get('place_type') + ": " + feature.get('place_name') +
                                "<br>Name: " + feature.get('name') +
                                "<br>Contact: " + feature.get('contact') +
                                "<br>Surplus Quantity: " + feature.get('surplus_quantity') + " units. <small><i>Login to check surplus details.</i></small>";
            overlay.setPosition(coordinate);

          });
        });
        closer.onclick = function() {
          overlay.setPosition(undefined);
          closer.blur();
          return false;
        };
        //end popup

        //Handle ckecbox clicks

        function handleClickGewogExtension(status) {
          if(status.checked) {
            show_gewog_extension_layer();
          }
          else {
            remove_layer('Gewog Extension');
          }
        }

        function handleClickLUC(status) {
          if(status.checked) {
            show_luc_layer();
          }
          else {
            remove_layer('LUC');
          }
        }

        function handleClickFG(status) {
          if(status.checked) {
            show_fg_layer();
          }
          else {
            remove_layer('FG');
          }
        }

        function handleClickCA(status) {
          if(status.checked) {
            show_ca_layer();
          }
          else {
            remove_layer('CA');
          }
        }

        function remove_layer(layer_name) {
           map.getLayers().getArray()
             .filter(layer => layer.get('name') === layer_name)
             .forEach(layer => map.removeLayer(layer));
        }
      </script>

</body>

</html>
