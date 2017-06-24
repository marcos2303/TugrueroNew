<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Sesiones</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Usuario</th>
                    <th>Usuario</th>
                    <th>Nombres y apellidos</th>
					<th>Placa</th>
					<th>Celular</th>
					<th>Disponible</th>
					<th>Estado</th>
					<th>Zona</th>
					<th>Condición</th>
					<th>DeviceId</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input id="idGrua" name="idGrua" type="text"></th>
                    <th><input id="cedula" name="cedula" type="text"></th>
                    <th><input id="nombre" name="nombre" type="text"></th>			
					<th><input id="placa" name="placa" type="text"></th>
					<th><input id="celular" name="celular" type="text"></th>
					<th><input id="disponible" name="disponible" type="text"></th>
					<th><input id="location" name="location" type="text"></th>
					<th><input id="zone_work" name="zone_work" type="text"></th>
					<th><input id="condicion" name="condicion" type="text"></th>
					<th>DeviceId</th>
					<th>Detalle</th>
					
				</tr>
			</tfoot>
		</table>
</div>
	<?php include('../../view_footer_solicitud.php')?>
<script>

	

	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		
		if(title != 'Detalle' && title != 'DeviceId')
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
        "ajax": "<?php echo full_url."/adm/grueros_aws/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "idGrua" },
            { "data": "Cedula" },
            { "data": "Nombre" },
			{ "data": "Placa" },
			{ "data": "Celular" },
			{ "data": "Disponible" },
			{ "data": "ZoneWork" },
			{ "data": "Location" },
			{ "data": "Condicion" },
			{ "data": "DeviceId" },
			
            { "data": "actions" }

			
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 9,10 ] }
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
        table.column(table.column(8)).search($(this).val()).draw();
    }
});

	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});


function resetSessionAws(idGrua)
{
	
	if(confirm('¿Está seguro(a) de resetear los datos de sesión para el usuario #'+idGrua + '?'))
	{
		$.ajax({
		  type: "POST",
		  url: '<?php echo full_url?>/adm/grueros_aws/index.php',
		  data: {idGrua:idGrua,action: 'reset'},
		  success: function(){
				table.search( '' ).columns().search( '' ).draw();
				$('.filtros').val('');
				alert('Sesión reseteada para el usuario #' + idGrua);
				
		  },
		});		
	}else
	{
		return false;
	}

	

}
function cambiaStatus(idGrua, statusCambiar)
{
	
	if(confirm('¿Está seguro(a) de cambiar la condición del gruero #'+idGrua + '?'))
	{
		$.ajax({
		  type: "POST",
		  url: '<?php echo full_url?>/adm/grueros_aws/index.php',
		  data: {idGrua:idGrua,action: 'cambia_status',statusCambiar:statusCambiar},
		  success: function(){
				table.search( '' ).columns().search( '' ).draw();
				$('.filtros').val('');
				alert('Condición cambiada satisfactoriamente para el gruero #' + idGrua);
				
		  },
		});		
	}else
	{
		return false;
	}
}

</script>
