<!DOCTYPE html>
<html>
  <head>
    <title>TUGRUERO®</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
	  <div id="map"></div>
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 7.6168373, lng: -64.9279394},
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
        });
		//var idPoliza = $('#idPoliza').val();
				//cliente
		$.getJSON("<?php echo full_url;?>/adm/solicitud/index.php?action=json_test", function(json1) {
			$.each(json1, function(key, data) {
				var latLng = new google.maps.LatLng(data.lat, data.lng); 
				// Creating a marker and putting it on the map
				var infowindow = new google.maps.InfoWindow({
						content: data.contentinfo
				});
				var color = "blue";
				if(data.Disponible == "NO")
				{
					color = "red";
				}
				var marker = new google.maps.Marker({
					position: latLng,
					icon: {
					  path: google.maps.SymbolPath.CIRCLE,
					  //path: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
					  fillColor: 'yellow',
					  fillOpacity: 0.8,
					  scale: 1,
					  strokeColor: color,
					  strokeWeight: 20,
					  
					},
					map: map,
					title: data.title,
					label: "G",
					idGrua: data.idGrua
				});
				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});
				

				marker.addListener('dblclick', function() {
					//alert(this.idGrua);
					
					if(data.Disponible == 'SI')
					{
						if(confirm("¿Está seguro(a) de asignar a "+ data.Nombre + " " + data.Apellido +" Cédula " + data.Cedula +" con la grúa de placa "+ data.Placa + " modelo " + data.Modelo+" color "+data.Color+"?"))
						{
							$("#idGrua").val(this.idGrua);
							$('#parcial_gruero').html(data.contentinfo);
							$('#myModal').data('modal', null);
							$('#myModal').modal('toggle');

						}
						else
						{
							return false;
						}
					}else{
						alert("El gruero "+ data.Nombre + " " + data.Apellido +" Cédula " + data.Cedula +" con la grúa de placa "+ data.Placa + " modelo " + data.Modelo+" color "+data.Color+" ya se encuentra asignado en otro servicio o no está disponible");
						return false;
					}
					

					

					
				});				
			


			});
		});
      }

    </script>
    <script src="../../web/js/jquery.js"></script>
    <script src="../../web/js/bootstrap.min.js"></script>
    <script src="../../web/js/freelancer.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=false&callback=initMap&libraries=places">
    </script>
  </body>
</html>