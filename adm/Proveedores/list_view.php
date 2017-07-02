<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="container-fluid">
	<h1 class="text-center big_title">Proveedores</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Cédula/RIF</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Tipo</th>
				<th>Estado</th>
				<th>Ciudad</th>
				<th>Zona</th>
				<th>Detalle</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th><input id="Identificacion" name="Identificacion" type="text"></th>
				<th><input id="Nombres" name="Nombres" type="text"></th>
				<th><input id="Apellidos" name="Apellidos" type="text"></th>
				<th><input id="NombreProveedorTipo" name="NombreProveedorTipo" type="text"></th>
				<th><input id="NombreEstado" name="NombreEstado" type="text"></th>
				<th><input id="Ciudad" name="Ciudad" type="text"></th>
				<th><input id="Zona" name="Zona" type="text"></th>
				<th>Detalle</th>
			</tr>
		</tfoot>
	</table>
	<a class="btn btn-primary"  href="<?php echo full_url."/adm/Proveedores/index.php?action=new"?>"><i class="fa fa-plus"></i> Agregar</a>
</div>
<?php include('../../view_footer_admin.php')?>
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
			$(this).html( '<button id="clear" class="btn -btn-default"> Limpiar</button>' );
		}

	} );


	var table = $('#example').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
		"scrollY":	'200px',
		"sDom": 'trp',
		"ajax": "<?php echo full_url."/adm/Proveedores/index.php?action=list_json"?>",
		"language": {
			"url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
		},
		"columns": [
			{ "data": "Identificacion" },
			{ "data": "Nombres" },
			{ "data": "Apellidos" },
			{ "data": "NombreProveedorTipo" },
			{ "data": "NombreEstado" },
			{ "data": "Ciudad" },
			{ "data": "Zona" },
			{ "data": "actions" }
		],"rowCallback": function( row, data, index ) {
		},
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [ 7 ] }
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
	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});


} );

</script>
