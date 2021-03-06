	<h3 class="text-center">Usuarios</h3>
	<table id="TablaGruas" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Login</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Celular</th>
				<th>Email</th>
                <th>Estatus</th>
				<th>Detalle</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th><input id="Login" name="Placa" type="text"></th>
				<th><input id="Nombres" name="NombreGruaTipo" type="text"></th>
				<th><input id="Apellidos" name="NombreMarca" type="text"></th>
				<th><input id="Celular" name="Modelo" type="text"></th>
				<th><input id="Email" name="Color" type="text"></th>
				<th><input id="Estatus" name="Anio" type="text"></th>
				<th>Detalle</th>
			</tr>
		</tfoot>
	</table>
<script>


$(document).ready(function() {
	$('#TablaGruas tfoot th').each( function () {
		var title = $('#TablaGruas thead th').eq( $(this).index() ).text();

		if(title != 'Detalle')
		{
			$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+ title +'" />' );
		}
		if(title == 'Detalle')
		{
			$(this).html( '<button id="clear" class="btn btn-default">Limpiar</button>' );
		}

	} );


	var table = $('#TablaGruas').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
        "sServerMethod": "POST",
		"sScrollY": "300",
		"sDom": 'trp',
		"ajax": "<?php echo full_url."/adm/Listas/index.php?action=lista_gruas_json&IdProveedor=";if(isset($values['IdProveedor']) and $values['IdProveedor']!='') echo $values['IdProveedor']; ?>&opcion=<?php echo $values['opcion']?>",
		"language": {
			"url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
		},
		"columns": [
			{ "data": "Login" },
			{ "data": "Nombres" },
			{ "data": "Apellidos" },
			{ "data": "Celular" },
			{ "data": "Email" },
			{ "data": "Estatus" },
			{ "data": "actions" }
		],"rowCallback": function( row, data, index ) {
		},
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [ 6 ] }
		]
	});

	$('#column_0').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(0)).search($(this).val()).draw();
		}
	});
	$('#column_1').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(1)).search($(this).val()).draw();
		}
	});
	$('#column_2').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(2)).search($(this).val()).draw();
		}
	});
	$('#column_3').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(3)).search($(this).val()).draw();
		}
	});
	$('#column_4').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(4)).search($(this).val()).draw();
		}
	});
	$('#column_5').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(5)).search($(this).val()).draw();
		}
	});


} );

</script>
