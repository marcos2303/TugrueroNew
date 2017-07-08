<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
    <script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: -28.643387, lng: 153.612224},
    mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_CENTER
    },
    zoomControl: true,
    zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    },
    scaleControl: true,
    streetViewControl: true,
    streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
    }
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=true&callback=initMap" async defer>
    </script>
<div class="">
   <div class="wrapper">
      <header class="main-header"></header>

        <aside class="main-sidebar">
            <div id="map"></div>
        </aside>
        <div class="content-wrapper">
            <a href="#" class="btn btn-default" data-toggle="push-menu" role="button"><i class="fa fa-map-marker"></i> Mapa</a>

            <a class="btn btn-default"  href="<?php echo full_url."/adm/Servicios/index.php";?>"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

        </div>

        <div class="control-sidebar-bg"></div>
    </div>

</div>
<?php include('../../view_footer_admin.php');?>
