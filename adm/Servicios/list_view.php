<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="container-fluid" >
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-tugruero">
            <div class="inner">
                <h3 class="text-center">Servicios</h3>
                <div class="text-center">
                    <a href="<?php echo full_url."/adm/Servicios/index.php?action=new&IdServicioTipo=1"?>" class="btn btn-tugruero">Asegurado</a>
                    <a href="<?php echo full_url."/adm/Servicios/index.php?action=new&IdServicioTipo=2"?>" class="btn btn-tugruero">Particular</a>
                </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-tugruero">
            <div class="inner">
                <h3 class="text-center">Monitoreo</h3>
                <div class="text-center">
                    <a href="<?php echo full_url."/adm/Servicios/index.php?action=new"?>" class="btn btn-tugruero">Servicios activos</a>
                    <a href="<?php echo full_url."/adm/Servicios/index.php?action=new"?>" class="btn btn-tugruero">Grueros</a>
                </div>
            </div>
          </div>
        </div>
      </div>
	<div id="DataServicios"></div>
</div>
<?php include('../../view_footer_admin.php')?>

<script>
$.ajax({
	url: link_servidor + "/adm/Listas/index.php?action=lista_servicios",
	success: function(html){
		$("#DataServicios").append(html);
	}
});


</script>
