<style type="text/css">
.map-canvas { height: 246px; }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ0nN0gR3ZR25qqNKhdxHQGZ9azjHJc14&sensor=false"></script>
<script src="<?=base_url();?>assets/frontend-assets/js/markerwithlabel.js" type="text/javascript"></script>
<script type="text/javascript">

function initialize() {
  /* office locations lat long */
  var vic_office_location = new google.maps.LatLng(-37.908520,145.244338);
  var nsw_office_location = new google.maps.LatLng(-33.933573,151.147417);
  var qld_office_location = new google.maps.LatLng(-27.561786,153.069330);
  
  /* map options */
  var vic_mapOptions = {
    zoom: 16,
    center: vic_office_location,
  }
  var nsw_mapOptions = {
    zoom: 16,
    center: nsw_office_location,
  }
  var qld_mapOptions = {
    zoom: 16,
    center: qld_office_location,
  }
  
  /* load map into each office location container */
  var vic_map = new google.maps.Map(document.getElementById('vic-map'), vic_mapOptions);
  var nsw_map = new google.maps.Map(document.getElementById('nsw-map'), nsw_mapOptions);
  var qld_map = new google.maps.Map(document.getElementById('qld-map'), qld_mapOptions);
  
  /* map markers */
  var vic_marker = new google.maps.Marker({
      position: vic_office_location,
      map: vic_map
  });
  var vic_iw = new google.maps.InfoWindow({
       content: "WAVE1 - VIC"
  });
  
  var nsw_marker = new google.maps.Marker({
      position: nsw_office_location,
      map: nsw_map
  });
  var nsw_iw = new google.maps.InfoWindow({
       content: "WAVE1 - NSW"
  });
  
  var qld_marker = new google.maps.Marker({
      position: qld_office_location,
      map: qld_map
  });
  var qld_iw = new google.maps.InfoWindow({
       content: "WAVE1 - QLD"
  });
	 
  google.maps.event.addListener(vic_marker, "click", function (e) { vic_iw.open(vic_map, vic_marker); });
  google.maps.event.addListener(nsw_marker, "click", function (e) { nsw_iw.open(nsw_map, nsw_marker); });
  google.maps.event.addListener(qld_marker, "click", function (e) { qld_iw.open(qld_map, qld_marker); });
  vic_iw.open(vic_map, vic_marker);
  nsw_iw.open(nsw_map, nsw_marker);
  qld_iw.open(qld_map, qld_marker);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div class="col-md-4">
    <div class="box bottom20">
       <div id="vic-map" class="map-canvas"></div> 
    </div>
    <div class="box bottom20">
       <div id="nsw-map" class="map-canvas"></div>  
    </div>
    <div class="box bottom20">
       <div id="qld-map" class="map-canvas"></div> 
    </div>
</div>
