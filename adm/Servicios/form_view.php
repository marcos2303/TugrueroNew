<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>

<div class="">
   <div class="wrapper">
      <header class="main-header"></header>

        <aside class="main-sidebar">
            <div><?php include('mapa_servicio.php');?></div>
        </aside>
        <div class="content-wrapper">
            <a href="#" class="btn btn-default" data-toggle="push-menu" role="button"><i class="fa fa-map-marker"></i> Mapa</a>

            <a class="btn btn-default"  href="<?php echo full_url."/adm/Servicios/index.php";?>"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

        </div>

        <div class="control-sidebar-bg"></div>
    </div>

</div>
<?php include('../../view_footer_admin.php');?>
