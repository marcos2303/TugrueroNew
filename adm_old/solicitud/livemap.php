<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<style>
html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        padding-left: 0px;
        padding-top: 0px;
		
        font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif ;    
        overflow-x: hidden;
	margin: 0;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;		
		
}
#map {
	height: 100%;
        padding-left: 10px;
        padding-right: 10px;
}
</style>

	<div id="map" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>


	<?php include('../../view_footer_solicitud.php')?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=false&libraries=places"></script>
	<script>

      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
		var markerStore = {};
        var markersID = [];
		var array_existe = [];
		var INTERVAL = 10000;
		var myLatlng = new google.maps.LatLng(7.6168373,-64.9279394);
		var myOptions = {
			zoom: 7,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
		}
    var map = new google.maps.Map(document.getElementById("map"), myOptions);

getMarkers();
function getMarkers() {
		$.each(markersID, function(i, value) {
			//console.log(value);
			var existe_en_json = array_existe.indexOf("" + value + ""); 
			if(existe_en_json == -1)
				{
					//console.log('No Existe' + value);
					console.log(existe_en_json);
					if((markerStore.hasOwnProperty(value))){
						marker = markerStore[value];
						marker.setMap(null);
						//console.log(marker);
						delete markerStore[value];
					}

					 
				}
		});
		//console.log(markerStore);
		//console.log(markersID);
		array_existe = [];	


$.getJSON("<?php echo full_url;?>/adm/solicitud/index.php?action=json_solicitudes_livemap", function(json1) {
			$.each(json1, function(key, data) {
                                $.each(data, function(key, data) {
                                                                    
                                        
									array_existe.push(data.idSolicitud + data.id);
                                    
                                    if((markerStore.hasOwnProperty(data.idSolicitud + data.id))) {
										
										
									}
                                    
                                    if((markerStore.hasOwnProperty(data.idSolicitud + data.id))) {
											
												//console.log(array_existe);
												//console.log(markerStore[data.idSolicitud + data.id].id);
												//alert(markersID[data.idSolicitud + data.id]);
												
												
												
												var existe_en_json = array_existe.indexOf(markersID[data.idSolicitud + data.id]); 
												
												if(existe_en_json == -1)
												{
													//console.log('No Existe');
												}else
												{
													//console.log('Existe');
												}
												
											 
											
											
											
											
                                            markerStore[data.idSolicitud + data.id].setPosition(new google.maps.LatLng(data.lat, data.lng));
                                            markerStore[data.idSolicitud + data.id].setIcon({
                                                      path: google.maps.SymbolPath.CIRCLE,
                                                      fillColor: 'yellow',
                                                      fillOpacity: 0.8,
                                                      scale: 1,
                                                      strokeColor: data.iconcolor,
                                                      strokeWeight: 14,
                                                    });
                                    }else{
                                            
                                            var latLng = new google.maps.LatLng(data.lat, data.lng);
                                            var marker = new google.maps.Marker({
                                                    position: latLng,
                                                    icon: {
                                                      path: google.maps.SymbolPath.CIRCLE,
                                                      fillColor: 'yellow',
                                                      fillOpacity: 0.8,
                                                      scale: 1,
                                                      strokeColor: data.iconcolor,
                                                      strokeWeight: 14,
                                                    },
                                                    map: map,
                                                    title: data.title,
                                                    label: data.label,
                                                    id: data.idSolicitud + data.id
                                            });
                                    // Creating a marker and putting it on the map
											var infowindow = new google.maps.InfoWindow({
															content: data.contentinfo
											});
                                            if(data.id != 0)
                                            {
                                            
                                            infowindow.open(map, marker);
                                                    marker.addListener('click', function() {
                                                            infowindow.open(map, marker);
                                                    });						
                                            }
                                            if(data.id == 0)
                                            {       
                                                    var center = new google.maps.LatLng(data.latCenter, data.lngCenter);
                                                    //alert(center);
                                                    // using global variable:
                                                    map.panTo(center);
                                            }					
                                            marker.addListener('click', function() {
                                                    infowindow.open(map, marker);
                                            });
                                            markerStore[data.idSolicitud + data.id] = marker;
											markersID.push(data.idSolicitud + data.id);
                                    }

				

                                });
			});
                        
		});
		


														

		window.setTimeout(getMarkers,INTERVAL);
}
    </script>