<style>
#map {
    width: 100%;
    height: 400px;
}
.controls {
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
    <div id="floating-panel">
      <!--<input onclick="clearMarkers();" type=button value="Hide Markers">-->
      <!--<input onclick="showMarkers();" type=button value="Show All Markers">-->
		<input id="searchInput" class="controls" type="text" placeholder="Enter a location">
      <input onclick="deleteMarkers();" type=button value="Borrar Marcador">
	  <input id="latlon" type="text" value="">
    </div>
    <div id="map"></div>
    <p>Click on the map to add markers.</p>
<input id="searchInput" class="controls" type="text" placeholder="Enter a location">
<div id="map"></div>
<ul id="geoData">
    <li>Full Address: <span id="location"></span></li>
    <li>Postal Code: <span id="postal_code"></span></li>
    <li>Country: <span id="country"></span></li>
    <li>Latitude: <span id="lat"></span></li>
    <li>Longitude: <span id="lon"></span></li>
</ul>

<script>
var map;
var markers = [];	
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
	
  map.addListener('click', function(event) {
    addMarker(event.latLng);
  });	
	
	
	
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

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
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
        document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lon').innerHTML = place.geometry.location.lng();
    });
}

function addMarker(location) {
	

  if(markers.length == 0)
  {
	var marker = new google.maps.Marker({
	  position: location,
	  icon: {
		path: google.maps.SymbolPath.CIRCLE,
		scale: 10
	  },
	  draggable: true,
	  map: map
	});
	marker.addListener('dragend', function(event) {
		//alert(event.latLng);
		$('#latlon').val(event.latLng);
	});

	  
	/*var marker = new google.maps.Marker({
	  position: location,
	  map: map,
	  icon: 'http://www.tugruero.com/web/img/profile.png'
	});	 */ 
	  
	$('#latlon').val(location);
	markers.push(marker);
	
	  
  }	
	
	



}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
  $('#latlon').val(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&libraries=places&callback=initMap" async defer></script>