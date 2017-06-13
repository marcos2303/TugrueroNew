<?php //include('../../autoload.php')?>
<!doctype html>
<html ng-app="cssawds">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grueros Venezuela, Grúas Venezuela">
    <meta name="author" content="tugruero">
    <link rel="alternate" hreflang="es" href="www.tugruero.com" />
    <link href="<?php echo full_url?>/web/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="<?php echo full_url?>/web/img/favicon.ico" type="image/x-icon"/>
    <link href="<?php echo full_url?>/web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo full_url?>/web/css/menu2.css">  
	<link rel="stylesheet" href="<?php echo full_url?>/web/css/hover.css">  
	<link href="<?php echo full_url?>/web/css/freelancer_app.css" rel="stylesheet">
        <title>TUGRUERO®</title>
</head>
<style>
html, body {
        height: 100%;
        margin: 0;
        padding: 0;
		padding-left: 10px;
		padding-top: 30px;
		
		font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif ;
		/*background: url(<?php echo full_url?>/web/img/fondos/Fondo-Tu-Gruero2.jpg) no-repeat center center fixed ;*/
    
		overflow-x: hidden;
		margin: 0;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;		
		
}
#map {
	height: 100%;
}
</style>

	<div id="map" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</html>

    <script src="../../web/js/jquery.js"></script>
    <script src="../../web/js/bootstrap.min.js"></script>
    <script src="../../web/js/freelancer.js"></script>
	
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=false&libraries=places"></script>

	<script>

      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
		var markerStore = {};
		var INTERVAL = 40000;
		var myLatlng = new google.maps.LatLng(10.5168373,-66.9279394);
		var myOptions = {
			zoom: 8,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		}
    var map = new google.maps.Map(document.getElementById("map"), myOptions);
	getMarkers();
function getMarkers() {
$.getJSON("<?php echo full_url;?>/adm/solicitud/index.php?action=json_test", function(json1) {
			$.each(json1, function(key, data) {
				var latLng = new google.maps.LatLng(data.lat, data.lng); 
				// Creating a marker and putting it on the map
				var infowindow = new google.maps.InfoWindow({
						content: data.contentinfo
				});
				if(markerStore.hasOwnProperty(key)) {
					markerStore[key].setPosition(new google.maps.LatLng(data.lat, data.lng));
				}else{
					var marker = new google.maps.Marker({
						position: latLng,
						//position: new google.maps.LatLng(position.lat,position.long),
						icon: {
						  path: google.maps.SymbolPath.CIRCLE,
						  //path: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
						  fillColor: 'yellow',
						  fillOpacity: 0.8,
						  scale: 1,
						  strokeColor: 'green',
						  strokeWeight: 14,
						},
						map: map,
						title: data.title,
						label: "G"
					});					
					marker.addListener('click', function() {
						infowindow.open(map, marker);
					});
					markerStore[key] = marker;
				}

				


			});
		});
		window.setTimeout(getMarkers,INTERVAL);
}
	setInterval( function () {
		initMap();
	},1000000 );
    </script>