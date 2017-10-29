<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="container-fluid" >
	<div id="DataServicios"></div>
</div>
<?php include('../../view_footer_admin.php')?>
<script>
$.ajax({
	url: link_servidor + "/adm/Listas/index.php?action=lista_servicios_administracion",
	success: function(html){
		$("#DataServicios").append(html);
	}
});
</script>
