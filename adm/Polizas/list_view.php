<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
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
					<th><input id="idPoliza" name="idPoliza" type="text"></th>
                    <th><input id="Seguro" name="Seguro" type="text"></th>
                    <th><input id="NumPoliza" name="NumPoliza" type="text"></th>
                    <th><input id="Placa" name="Placa" type="text"></th>
					<th><input id="Cedula" name="Cedula" type="text"></th>
					<th><input id="NombreApellido" name="NombreApellido" type="text"></th>
					<th><input id="Vencimiento" name="Vencimiento" type="text"></th>				
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>
	<a class="btn btn-default"  href="<?php echo full_url."/adm/solicitud/index.php";?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>

	<a class="btn btn-default"  href="<?php echo full_url."/adm/Polizas/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>
</div>
	<?php include('../../view_footer_solicitud.php')?>
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
		 "sDom": 'ltrip',
        "ajax": "<?php echo full_url."/adm/Polizas/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "idPoliza" },
            { "data": "Seguro" },
            { "data": "NumPoliza" },
            { "data": "Placa" },
            { "data": "Cedula" },
            { "data": "NombreApellido" },
            { "data": "Vencimiento" },
            { "data": "actions" }
        ],"rowCallback": function( row, data, index ) {
            //alert(data.Status);
            /*if ( data.idSolicitud == "10" ) {
				$(row).css("background-color","red");
				$("td:eq(3)", row).css("background-color","red");
			 
            }*/
            if ( data.EstatusPoliza == "Vencido" ) {
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