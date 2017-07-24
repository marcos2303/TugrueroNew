var map_gruas;
var markers = [];
function initializeGruas() {

  /*var marcadores = [
  ['León', 42.603, -5.577],
  ['Salamanca', 40.963, -5.669],
  ['Zamora', 41.503, -5.744]
];*/
map_gruas = new google.maps.Map(document.getElementById('mapa'), {
  zoom: 6,
  disableDefaultUI: true,
  zoomControl: true,
  scaleControl: true,
  zoomControl: true,
  center: new google.maps.LatLng(6.760825009855806, -66.84538344062503),
  mapTypeId: google.maps.MapTypeId.ROADMAP,
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

});
setMarker(map_gruas);
}
function setMarker(map_gruas) {
  var parametros_gruas = {

  }
  var marcadores = [];
  var DatosGruas = AjaxCall("servicios/adminapp/datosGruasMapa.php", parametros_gruas);
  console.log(DatosGruas);
  $(DatosGruas.DatosGruas ).each(function( index, value ) {
    var info = "<b>Proveedor :</b> " + value.NombresProveedor + value.ApellidosProveedor+ "<br>";
    info+= "<b>Celular1 : </b>" + value.Celular1Proveedor + "<br>";
    info+= "<b>Celular2 : </b>" + value.Celular2Proveedor + "<br>";
    info+= "<b>Celular3 : </b>" + value.Celular3Proveedor + "<br>";
    info+= "<b>Gruero : </b>" + value.Nombres +" " + value.Nombres + "<br>";
    info+= "<b>Celular gruero : </b>" + value.Celular + "<br>";
    info+= "<b>Placa : </b>" + value.Placa + "<br>";
    info+= "<b>Marca : </b>" + value.NombreMarca + "<br>";
    info+= "<b>Modelo : </b>" + value.NombreGruasTipo + "<br>";
    info+= "<b>Anio : </b>" + value.Anio + "<br>";
    info+= "<b>Color : </b>" + value.Color + "<br>";
    info+= "<b>Estatus : </b>" + value.Estatus + "<br>";
    info+= "<b>Ultima actualización : </b>" + value.UltimaActualizacion + "<br>";
    info+= "<p class='text-center'><button class='btn btn-tugruero' onclick='SeleccionarGruaMapa("+ value.IdGrua+")'> Seleccionar </button></p>";
    marcadores[index] = [
      info,
      value.Latitud,
      value.Longitud,
      value.Disponible
    ];

  });
  var infowindow = new google.maps.InfoWindow();
  var i;
  var image = '';
  for (i = 0; i < marcadores.length; i++) {
    if(marcadores[i][3] == 0){
      image = link_servidor + 'web/img_admin/SVGs/GruaRoja.svg';
    }
    if(marcadores[i][3] == 1){
      image = link_servidor + 'web/img_admin/SVGs/GruaVerde.svg';
    }
    if(marcadores[i][3] == 2){
      image = link_servidor + 'web/img_admin/SVGs/GruaAmarilla.svg';
    }
    markers[i] = new google.maps.Marker({
      position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
      map: map_gruas,
      icon : image
    });
    markers[i].setMap(map_gruas);
    google.maps.event.addListener(markers[i], 'click', (function(markers, i) {
      return function() {
        infowindow.setContent(marcadores[i][0]);
        infowindow.open(map_gruas, markers);
      }
    })(markers[i], i));
  }

}
function setMapOnAll(map_gruas) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map_gruas);
  }
}
var IntervalMapa;
$(document).ready(function(){
  $('#popupMapa').on('shown.bs.modal', function () {
    initializeGruas();
  });
  IntervalMapa = setInterval(function() {
    setMapOnAll(null);
    setMarker(map_gruas);
  },30000);
});
function stopInterval(){
  clearInterval(IntervalMapa);
  closePops();
}
google.maps.event.addDomListener(window, 'load', initializeGruas);
