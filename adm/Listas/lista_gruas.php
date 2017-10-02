	<h3 class="text-center">Grúas</h3>
	<table id="TablaGruas" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Placa</th>
				<th>Tipo grúa</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Color</th>
				<th>Año</th>
				<th>Clave</th>
				<th>IdentificacionProveedor</th>
				<th>Proveedor</th>
				<th>NombreEstado</th>
				<th>CiudadProveedor</th>
				<th>ZonaProveedor</th>
				<th>Celular1</th>
				<th>Celular2</th>
				<th>Celular3</th>
				<th>Disponible</th>
				<th>Detalle</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th><input id="Placa" name="Placa" type="text"></th>
				<th><input id="NombreGruaTipo" name="NombreGruaTipo" type="text"></th>
				<th><input id="NombreMarca" name="NombreMarca" type="text"></th>
				<th><input id="Modelo" name="Modelo" type="text"></th>
				<th><input id="Color" name="Color" type="text"></th>
				<th><input id="Anio" name="Anio" type="text"></th>
				<th><input id="Clave" name="Clave" type="text"></th>
				<th><input id="IdentificacionProveedor" name="IdentificacionProveedor" type="text"></th>
				<th><input id="Proveedor" name="Proveedor" type="text"></th>
				<th><input id="NombreEstado" name="NombreEstado" type="text"></th>
				<th><input id="CiudadProveedor" name="CiudadProveedor" type="text"></th>
				<th><input id="ZonaProveedor" name="ZonaProveedor" type="text"></th>
				<th><input id="Celular1" name="Celular1" type="text"></th>
				<th><input id="Celular2" name="Celular2" type="text"></th>
				<th><input id="Celular3" name="Celular3" type="text"></th>
				<th><input id="Disponible" name="Disponible" type="text"></th>
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
		"sDom": 'Btrp',
		"ajax": "<?php echo full_url."/adm/Listas/index.php?action=lista_gruas_json&IdProveedor=";if(isset($values['IdProveedor']) and $values['IdProveedor']!='') echo $values['IdProveedor']; ?>&opcion=<?php echo $values['opcion']?>&Estatus=<?php echo $values['Estatus']?>",
		"language": {
			"url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
		},

		buttons: [
				{
						extend: 'colvisGroup',
						text: 'Básicos',
						show: [ 1, 2, 3,4,16 ],
						hide: [ 5,6,7,8,9,10,11 ]
				},
				{
						extend: 'colvisGroup',
						text: 'APP',
						show: [  6,15,16 ],
						hide: [ 1, 2,3,4,5,7,8,9,10,11 ]
				},
				{
						extend: 'colvisGroup',
						text: 'Proveedor',
						show: [  7,8,9,10,11,16 ],
						hide: [ 1, 2,3,4,5,6,15 ]
				},
				{
						extend: 'colvisGroup',
						text: 'Todos',
						show: ':hidden'
				}
		],
		"columns": [
			{ "data": "Placa" },
			{ "data": "NombreGruaTipo" },
			{ "data": "NombreMarca" },
			{ "data": "Modelo" },
			{ "data": "Color" },
			{ "data": "Anio" },
			{ "data": "Clave" },
			{ "data": "IdentificacionProveedor" },
			{ "data": "Proveedor" },
			{ "data": "NombreEstado" },
			{ "data": "CiudadProveedor" },
			{ "data": "ZonaProveedor" },
			{ "data": "Celular1" },
			{ "data": "Celular2" },
			{ "data": "Celular3" },
			{ "data": "Disponible" },
			{ "data": "actions" }
		],"rowCallback": function( row, data, index ) {
		},
		"aoColumnDefs": [
			{ "visible": false, "targets": [5,6,7,8,9,10,11,12,13,14,15] },
			{ 'bSortable': false, 'aTargets': [ 16 ] }
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
	$('#column_6').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(6)).search($(this).val()).draw();
		}
	});
	$('#column_7').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(7)).search($(this).val()).draw();
		}
	});
	$('#column_8').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(8)).search($(this).val()).draw();
		}
	});
	$('#column_9').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(9)).search($(this).val()).draw();
		}
	});
	$('#column_10').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(10)).search($(this).val()).draw();
		}
	});
	$('#column_11').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(11)).search($(this).val()).draw();
		}
	});
	$('#column_12').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(12)).search($(this).val()).draw();
		}
	});
	$('#column_13').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(13)).search($(this).val()).draw();
		}
	});
	$('#column_14').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(14)).search($(this).val()).draw();
		}
	});
	$('#column_15').on ('keypress', function(e){
		if(e.which == 13) {
			table.column(table.column(15)).search($(this).val()).draw();
		}
	});
	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});


} );

</script>
