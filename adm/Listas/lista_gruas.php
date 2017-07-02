<?php //include('../../view_header_admin.php')?>
<div class="container-fluid">
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
		"scrollX": false,
		"processing": true,
		"serverSide": true,
		"scrollY": "500px",
	  "scrollCollapse": true,
		"sDom": 'trp',
		"ajax": "<?php echo full_url."/adm/Listas/index.php?action=lista_gruas_json&IdProveedor=";if(isset($values['IdProveedor']) and $values['IdProveedor']!='') echo $values['IdProveedor']; ?>",
		"language": {
			"url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
		},
		"columns": [
			{ "data": "Placa" },
			{ "data": "NombreGruaTipo" },
			{ "data": "NombreMarca" },
			{ "data": "Modelo" },
			{ "data": "Color" },
			{ "data": "Anio" },
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

	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});


} );

</script>
