<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>
<style>

table tbody tr {
	cursor: pointer;	
}
table.dataTable tbody > tr.seleccionado,
table.dataTable tbody > tr > .seleccionado {
  background-color: #ccc !important;
  color: #000 !important
}
</style>
<div class="container-fluid">
	<h1 class="text-center">Solicitudes de planes</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="99%" cellspacing="0">
			<thead>
				<tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>	
                                    <th>Cédula</th>	
                                    <th>Rif</th>
                                    <th>Plan</th>
                                    <th>Precio total</th>
                                    <th>Método de pago</th>
                                    <th>Estatus</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Vendedor</th>
                                    <th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input id="idSolicitudPlan" name="idSolicitudPlan" type="text"></th>
                                        <th><input id="Nombres" name="Nombres" type="text"></th>
                                        <th><input id="Apellidos" name="Apellidos" type="text"></th>
                                        <th><input id="Cedula" name="Cedula" type="text"></th>
                                        <th><input id="Rif" name="Rif" type="text"></th>	
                                        <th><input id="Plan" name="Plan" type="text"></th>		
                                        <th><input id="PrecioTotal" name="PrecioTotal" type="text"></th>
                                        <th><input id="TipoPago" name="TipoPago" type="text"></th>		
					<th><input id="Estatus" name="Estatus" type="text"></th>		
					<th><input id="FechaSolicitud" name="FechaSolicitud" type="text"></th>	
					<th><input id="IdV" name="IdV" type="text"></th>		

                                        <th>Detalle</th>
				</tr>
			</tfoot>
		</table>
		<a class="btn btn-primary"  href="<?php echo full_url."/adm/Planes/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>

</div>
	<?php include('../../view_footer_admin.php')?>
<script>

	
$(document).ready(function() {
	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		
		if(title != 'Detalle')
		{
			$(this).html( '<input size="5" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );			
			if(title=="Apellidos"){
				$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );			

			}
			if(title=="Nombres"){
				$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );			

			}
			if(title=="Plan"){
				$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );			

			}
			if(title=="ID"){
				$(this).html( '<input size="2" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );			

			}
		}
		if(title == 'Detalle')
		{
			$(this).html( '<button class="btn btn-sm" id="clear">Limpiar</button>' );	
		}

	} );

	
    var table = $('#example').DataTable({
        "scrollX": true,
		"autoWidth": true,
        "processing": true,
        "serverSide": true,
		 "sDom": 'trp',
        "ajax": "<?php echo full_url."/adm/Planes/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "order": [[ 0, "desc" ]],
        "columns": [
            { "data": "idSolicitudPlan","width": "5%" },
            { "data": "Nombres","width": "12%" },
            { "data": "Apellidos","width": "12%" },
            { "data": "Cedula","width": "5%" },
            { "data": "Rif","width": "5%" },
            { "data": "Plan","width": "16%" },
            { "data": "PrecioTotal","width": "5%" },
            { "data": "TipoPago","width": "10%" },
            { "data": "Estatus","width": "5%" },
            { "data": "FechaSolicitud","width": "5%" },
            { "data": "NombreVendedor","width": "5%" },
            { "data": "actions", "width": "15%"}
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 11 ] }
       ]				
    });
	//click
    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('seleccionado') ) {
            $(this).removeClass('seleccionado');
        }
        else {
            table.$('tr.seleccionado').removeClass('seleccionado');
            $(this).addClass('seleccionado');
        }
    } );
	//double click
	$('#example tbody').on('dblclick', 'tr', function () {
	var data = table.row( this ).data();
	$(this).addClass('seleccionado');
	console.log(data.idSolicitudPlan);

	$(location).attr('href', '<?php echo full_url."/adm/solicitud_plan/index.php?action=edit&idSolicitudPlan="?>' + + data.idSolicitudPlan);
	} );
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
	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});


} );
</script>