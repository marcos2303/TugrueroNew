	<h3 class="text-center">Grúas</h3>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Aplicación</th>
				<th>Tipo conexión</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th><input id="NombreAplicacion" name="NombreAplicacion" type="text"></th>
				<th><input id="NombreConexionTipo" name="NombreConexionTipo" type="text"></th>
				<th><input id="Fecha" name="Fecha" type="text"></th>
			</tr>
		</tfoot>
	</table>
<?php if(isset($values['regresar']) and $values['regresar'] == 1):?>
  <a href="#" class="btn btn-default" onclick="ListarGruas(<?php echo $values['IdProveedor']?>);"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

<?php endif;?>
<script>


$(document).ready(function() {
	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();

		if(title != 'Detalle')
		{
			$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+ title +'" />' );
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
		"sScrollY": "300",
		"sDom": 'Btrp',
        "ajax": "<?php echo full_url."/adm/Listas/index.php?action=lista_conexiones_json"; ?><?php if(isset($values['IdUsuario']) and $values['IdUsuario']!='') echo "&IdUsuario=".$values['IdUsuario'];?>",		
        "language": {
			"url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
		},"rowCallback": function( row, data, index ) {
		},
		"columns": [
			{ "data": "NombreAplicacion" },
			{ "data": "NombreConexionTipo" },
			{ "data": "Fecha" }
		],
		buttons: [
				
				{
						extend: 'colvisGroup',
						text: 'Todos',
						show: ':hidden'
				}
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



} );

</script>
