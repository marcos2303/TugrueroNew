<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>

	<h1 class="text-center">Administradores/Operadores</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>IdUsuario</th>
					<th>Login</th>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
					<th>Télefono/Celular</th>
					<th>Correo electrónico</th>
					<th>Status</th>				
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>IdUsuario</th>
					<th>Login</th>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
					<th>Télefono/Celular</th>
					<th>Correo electrónico</th>
					<th>Status</th>				
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>
	<a class="btn btn-default"  href="<?php echo full_url."/adm/UsuariosInternos/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>
	<?php include('../../view_footer_solicitud.php')?>
<script>

	
$(document).ready(function() {
	
	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		
		if(title != 'Detalle')
		{
			$(this).html( '<input size="10" class="input-sm" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );			
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
        "ajax": "<?php echo full_url."/adm/UsuariosInternos/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "id_user" },
			{ "data": "login" },
            { "data": "document" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "contacto" },
            { "data": "email" },
            { "data": "status" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 8 ] }
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
	});

} );

</script>