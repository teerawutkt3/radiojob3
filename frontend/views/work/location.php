<?php
use kartik\alert\Alert;
?>



   <?php

/* @var $this yii\web\View */

$this->title = 'Location';
?>
<div class="site-index">

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArBQOuYHVIZ0ZIJIXJ4n0GW4FtjAUwInk&language=th&libraries=places"></script>
<div class="row">
	<div class="col-md-10">
		<h1> ระบุตำแหน่ง</h1>
	</div>
	<div class="col-md-2"><br>
					
		<form action="/work/create" method="get">
          	  <input type="text" hidden="hidden" name="location" id="location"> 
              <input type="text" hidden="hidden" name="lat" id="lat"> 
              <input type="text" hidden="hidden" name="long" id="lng">
            <!--   <button type="button" class="btn btn-block btn-success">ตกลง</button> --> 
               <button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#btn">
					ตกลง
				</button>

                    <!-- Modal -->
                    <div id="btn" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-body">
                            <h3 class="text-center">ยืนยันตำแหน่ง</h3>
                                          <div class="row">
                                               <div class="col-md-3"></div>
                                               <div class="col-md-3">
                                                     <button class="btn btn-success btn-lg btn-block " type="submit">   
                                                      <span class="	glyphicon glyphicon-ok-sign"></span> ตกลง</button>
                                               </div>
                                                <div class="col-md-3">   
                                                            <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"> 
                                                             <span class="	glyphicon glyphicon-remove-sign"></span> ยกเลิก</button>
                                                </div>
                                                 <div class="col-md-3"></div><br><br><br><br>
                                                  </div>
                          </div>
                       
                        </div>
                    
                      </div>
                    </div><!-- end Modal -->
        </form>
	</div>
</div>
<?php if (!$_GET){

}else{
    echo Alert::widget([
        'options' => [
            'class' => 'alert-danger',
        ],
        'body' => 'กรุณาระบุชื่อสถานที่',
    ]);
}?>
<div class="panel panel-default">
			
  <div class="panel-body  ">
  
 <input id="searchInput" value="" class="input-controls" type="text"  placeholder="ระบุชื่อสถานที่">
 <div class="map" id="map" style="width: 100%; height: 600px;"></div>
 <div class="form_area">
  </div></div>
    
 </div>
<script>
/* script */
function initialize() {
	var latlng = new google.maps.LatLng(15.333748349440457,101.01005214062502);
   var markers = [];
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 7
    });
 
    var marker = new google.maps.Marker({
      map: map,
      position: false,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
   document.getElementById('location').value = address; 
   document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng; 
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>



<style type="text/css">
    .input-controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchInput {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 50%;
    }
    #searchInput:focus {
      border-color: #4d90fe;
    }
</style>
</div>
    