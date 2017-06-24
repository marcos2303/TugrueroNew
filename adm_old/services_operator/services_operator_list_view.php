<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Servicios - Operadores</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Usuario</th>
					<th>Nombres y apellidos operador</th>
					<th>Número de solicitud</th>
					<th>Inicio del servicio</th>
					<th>Fin del servicio</th>
					<th>Estatus cliente</th>
					<th>Estatus grúa</th>
					<th>Motivo</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id.Grúa</th>
					<th>Usuario</th>
					<th>Nombres y apellidos operador</th>
					<th>Número de solicitud</th>
					<th>Inicio del servicio</th>
					<th>Fin del servicio</th>
					<th>Estatus cliente</th>
					<th>Estatus grúa</th>
					<th>Motivo</th>
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>
	
</div>

	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/services_operator/index.php?action=services_operator_list_json&id_user=".$values['id_user'].""?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "idGrua" },
			{ "data": "Cedula" },
			{ "data": "NombreApellido" },
			{ "data": "IdSolicitud" },
            { "data": "TimeInicio" },
            { "data": "TimeFin" },
            { "data": "EstatusCliente" },
            { "data": "EstatusGrua" },
            { "data": "Motivo" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 9 ] }
       ]				
    });
} );

</script>
