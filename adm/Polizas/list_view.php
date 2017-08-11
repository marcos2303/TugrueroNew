<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>

	<h1 class="text-center big_title">Pólizas</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>IdPoliza</th>
                    <th>Seguro</th>
                    <th>Número póliza</th>
                    <th>Placa</th>
					<th>Cédula</th>
					<th>Nombre y apellido</th>
					<th>Vencimiento</th>				
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input id="IdPoliza" name="IdPoliza" type="text"></th>
                    <th><input id="Seguro" name="Seguro" type="text"></th>
                    <th><input id="NumPoliza" name="NumPoliza" type="text"></th>
                    <th><input id="Placa" name="Placa" type="text"></th>
					<th><input id="Cedula" name="Cedula" type="text"></th>
					<th><input id="NombresApellidos" name="NombresApellidos" type="text"></th>
					<th><input id="Vencimiento" name="Vencimiento" type="text"></th>				
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>

        <a class="btn btn-primary"  href="<?php echo full_url."/adm/Polizas/index.php?action=add"?>"><i class="fa fa-plus"></i> Agregar</a>
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
			$(this).html( '<button id="clear">Limpiar</button>' );	
		}

	} );

	
    var table = $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "sDom": 'trp',
        "ajax": "<?php echo full_url."/adm/Polizas/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "IdPoliza" },
            { "data": "Seguro" },
            { "data": "NumPoliza" },
            { "data": "Placa" },
            { "data": "Cedula" },
            { "data": "NombresApellidos" },
            { "data": "Vencimiento" },
            { "data": "actions" }
        ],"rowCallback": function( row, data, index ) {
            if ( data.Estatus == "2" ||  data.Estatus == "0") {
				$(row).css("background-color","red");
            }
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