<div id="floating-panel">
  <div id="" class="">
    <b>Origen: </b>
    <input id="start" type="text" value="" class="">
    <b>Destino: </b>
    <input id="end" type="text" value="" class="">
    <button id="clear" class="btn btn-danger" onclick="clearMarkers();">Limpiar</button>

  </div>
</div>
<div id="map-canvas"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&v=3.exp&libraries=places" async defer></script>

<script src="<?php echo full_url."/web/js/maps/mapa_servicio.js";?>" async defer></script>
