var map;
var geocoder = new google.maps.Geocoder;
var directionsService = new google.maps.DirectionsService;
var directionsDisplay = new google.maps.DirectionsRenderer({
  draggable: true,
  map: map,
  //panel: document.getElementById('right-panel')
});
var LatitudOrigen;
var LongitudOrigen;
var LatitudDestino;
var LongitudDestino;
function initialize() {
// Instantiate a directions service.


  directionsDisplay.addListener('directions_changed', function() {
    computeTotalDistance(directionsDisplay.getDirections());
  });
  var mapOptions = {
    zoom: 6,
    disableDefaultUI: true,
    zoomControl: true,
    scaleControl: true,
    zoomControl: true,
    center: new google.maps.LatLng(6.760825009855806, -66.84538344062503),
    styles: [
      {
        "featureType": "all",
        "stylers": [
          {
            "saturation": 0
          },
          {
            "hue": "#e7ecf0"
          }
        ]
      },
      {
        "featureType": "road",
        "stylers": [
          {
            "saturation": -70
          }
        ]
      },
      {
        "featureType": "transit",
        "stylers": [
          {
            "visibility": "on"
          }
        ]
      },
      {
        "featureType": "poi",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "water",
        "stylers": [
          {
            "visibility": "simplified"
          },
          {
            "saturation": -60
          }
        ]
      }
    ]
  };//end map options

  map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
  directionsDisplay.setMap(map);
  //onchange marker
  var onChangeHandler = function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  };
  document.getElementById('start').addEventListener('change', onChangeHandler);
  document.getElementById('end').addEventListener('change', onChangeHandler);
}
var input_start = /** @type {!HTMLInputElement} */
(document.getElementById('start'));
var autocomplete_start = new google.maps.places.Autocomplete(input_start);
//autocomplete.bindTo('bounds', map);
autocomplete_start.addListener('place_changed', function() {
  calculateAndDisplayRoute(directionsService, directionsDisplay);
});
var input_end = /** @type {!HTMLInputElement} */
(document.getElementById('end'));
var autocomplete_end = new google.maps.places.Autocomplete(input_end);
//autocomplete.bindTo('bounds', map);
autocomplete_end.addListener('place_changed', function() {
  calculateAndDisplayRoute(directionsService, directionsDisplay);
});
google.maps.event.addDomListener(window, 'load', initialize);
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  directionsService.route({
    origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    travelMode: 'DRIVING'
  }, function(response, status) {
    if (status === 'OK') {
      directionsDisplay.setDirections(response);
        getGeocodeOrigen();
        getGeocodeDestino();
    } else {
      //window.alert('Directions request failed due to ' + status);
    }
  });
  //getGeocodeOrigen();
  //getGeocodeDestino();
}
function getGeocodeOrigen(){
  geocoder.geocode({'address': document.getElementById('end').value}, function(results, status) {
    if (status === 'OK') {
      //console.log("Origen");
      //console.log(results);
      var LatitudOrigen = results[0].geometry.location.lat();
      var LongitudOrigen = results[0].geometry.location.lng();
      //console.log(LatitudOrigen + " "  +LongitudOrigen);
      //console.log(results);
      //console.log(results[0].formatted_address);
      //$("#end").val(results[0].formatted_address);
      //map.setCenter(results[0].geometry.location);
    } else {
      window.alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
function getGeocodeDestino(){
  geocoder.geocode({'address': document.getElementById('end').value}, function(results, status) {
    if (status === 'OK') {
      //console.log("Destino");
      //console.log(results);
      LatitudDestino = results[0].geometry.location.lat();
      LongitudDestino = results[0].geometry.location.lng();
      //console.log(LatitudDestino + "  "  + LongitudDestino);

      //map.setCenter(results[0].geometry.location);
    } else {
      window.alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
function computeTotalDistance(results) {
 /*LatitudDestino = results[0].geometry.location.lat();
 LongitudDestino = results[0].geometry.location.lng();
 console.log(LatitudDestino + "  "  + LongitudDestino);*/
  //getGeocodeOrigen();
  //getGeocodeDestino();
  //console.log(results.routes[0].legs[0]);
  LatitudOrigen = results.routes[0].legs[0].start_location.lat();
  LongitudOrigen = results.routes[0].legs[0].start_location.lng();
  LatitudDestino = results.routes[0].legs[0].end_location.lat();
  LongitudDestino = results.routes[0].legs[0].end_location.lng();

  //console.log("Origen" + LatitudOrigen + "  "  + LongitudOrigen);

  //console.log("Destino" + LatitudDestino + "  "  + LongitudDestino);

  var total = 0;
  var myroute = results.routes[0];
  for (var i = 0; i < myroute.legs.length; i++) {
    total += myroute.legs[i].distance.value;
  }
  total = total / 1000;
  //console.log(total);
  //document.getElementById('total').innerHTML = total + ' km';
}
function clearMarkers() {
  setMapOnAll(null);
}
