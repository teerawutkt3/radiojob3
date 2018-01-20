<?php

/* @var $this yii\web\View */

$this->title = 'นำทาง';
?>
<div class="site-index">
<script type="text/javascript" src="https://dl.dropboxusercontent.com/s/u0735yw5gepbtax/RouteBoxer_packed.js"></script>
<script type="text/javascript" src="https://dl.dropboxusercontent.com/s//fyvzhaoqi3r6nps/RouteBoxer.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlMCXTr74f7ah640MrjFbb3V4KUHhqRis&language=th&libraries=places"></script>
</head>

<?php //$id = $_GET['id'];
      $lat=$lat;
     $long= $long; ?>
<div class="site-index">

    <script type="text/javascript">
    
    var map = null;
    var boxpolys = null;
    var directions = null;
    var routeBoxer = null;
    var distance = null; // km
    var this_lat = null;
    var this_long = null;
    function initialize() {
      // Default the map view to the continental U.S.
      var mapOptions = {
        center: new google.maps.LatLng(37.09024, -95.712891),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 18
      };
            			// Try HTML5 geolocation.
	  map = new google.maps.Map(document.getElementById("map"), mapOptions);
    
     	infoWindow = new google.maps.InfoWindow;

			// Try HTML5 geolocation.
			if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
				  lat: position.coords.latitude,
				  lng: position.coords.longitude
				};
                                  this.this_lat = position.coords.latitude;
                                  this.this_long = position.coords.longitude;
				infoWindow.setPosition(pos);
				infoWindow.setContent('ตำแน่งปัจจุบัน');
				infoWindow.open(map);
				map.setCenter(pos);
                           
			  }, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			  });
			} else {
			  // Browser doesn't support Geolocation
			  handleLocationError(false, infoWindow, map.getCenter());
			}
    
      routeBoxer = new RouteBoxer();
      
      directionService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({ map: map });      
    }
    
    function route() {
      // Clear any previous route boxes from the map
      clearBoxes();
      
      // Convert the distance to box around the route from miles to km
      distance = parseFloat(document.getElementById("distance").value) * 1.609344;
      
      var request = {
        origin: this_lat+","+this_long,
        
        destination: "<?php echo $lat.",".$long ?>",
        travelMode: google.maps.DirectionsTravelMode.DRIVING
      }
      
      // Make the directions request
      directionService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsRenderer.setDirections(result);
 
          // Box around the overview path of the first route
          var path = result.routes[0].overview_path;
         
          var boxes = routeBoxer.box(path, distance);
          drawBoxes(boxes);
        } else {
          alert("Directions query failed: " + status);
        }
      });
    }
    
  

    
    // Draw the array of boxes as polylines on the map
    function drawBoxes(boxes) {
      boxpolys = new Array(boxes.length);
      for (var i = 0; i < boxes.length; i++) {
        boxpolys[i] = new google.maps.Rectangle({
          bounds: boxes[i],
          fillOpacity: 0,
          strokeOpacity: 1.0,
          strokeColor: '#000000',
          strokeWeight: 1,
          map: map
        });
      }
    }
    
    // Clear boxes currently on the map
    function clearBoxes() {
      if (boxpolys != null) {
        for (var i = 0; i < boxpolys.length; i++) {
          boxpolys[i].setMap(null);
        }
      }
      boxpolys = null;
    }
    
    
  </script>
  <style>
    #map {
      border: 1px solid black;
      width: 100%;
      height: 700px;
    }
  </style>
  </head>
  <body onload="initialize();">
  <h1>นำทางไปยัง <?=(!$name_office || !isset($name_office)?"":$name_office)?></h1>
			<p class="text-danger"> * กรุณาเปิด การอนุญาติให้เข้าถึงตำแน่งของคุณ</p>
			<h1 class="text-center">
    <button type="submit" class="btn btn-danger" onclick="route()"><span class="	glyphicon glyphicon-flag"></span> เดินทาง</button>
   </h1>
   <div class="panel panel-primary">
  <div class="panel-heading">Panel Heading</div>
  <div class="panel-body">
    <div id="map" ></div>
  </div>
</div>
  
    <input type="hidden" id="distance" value="1" size="2">
    
</div>