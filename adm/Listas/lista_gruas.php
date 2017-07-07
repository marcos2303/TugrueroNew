<?php //include('../../view_header_admin.php')?>
<div class="">
	<h3 class="text-center">Grúas</h3>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Placa</th>
				<th>Tipo grúa</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Color</th>
				<th>Año</th>
				<th>Clave</th>
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
				<th>Detalle</th>
			</tr>
		</tfoot>
	</table>
</div>
<?php //include('../../view_footer_admin.php')?>
<script>


$(document).ready(function() {
	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();

		if(title != 'Detalle')
		{
			$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );
		}
		if(title == 'Detalle')
		{
			$(this).html( '<button id="clear" class="btn btn-default">Limpiar</button>' );
		}

	} );


	var table = $('#example').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
		"sScrollY": "400",
		"sDom": 'Btrp',
		"ajax": "<?php echo full_url."/adm/Listas/index.php?action=lista_gruas_json&IdProveedor=";if(isset($values['IdProveedor']) and $values['IdProveedor']!='') echo $values['IdProveedor']; ?>",
		"language": {
			"url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
		},

		buttons: [
				{
						extend: 'colvisGroup',
						text: 'Básicos',
						show: [ 1, 2, 3,4 ],
						hide: [ 5,6 ]
				},
				{
						extend: 'colvisGroup',
						text: 'APP',
						show: [  6 ],
						hide: [ 1, 2,3,4,5 ]
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
			{ "data": "actions" }
		],"rowCallback": function( row, data, index ) {
		},
		"aoColumnDefs": [
			{ "visible": false, "targets": [5,6] },
			{ 'bSortable': false, 'aTargets': [ 6,7 ] }
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

	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});


} );

</script>
