<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="container-fluid">
	<h1 class="">Servicios</h1>

	<div id="DataServicios">

	</div>

	<a class="btn btn-default"  href="<?php echo full_url."/adm/Servicios/index.php?action=new"?>"><i class="fa fa-plus-circle"></i> Agregar</a>
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
