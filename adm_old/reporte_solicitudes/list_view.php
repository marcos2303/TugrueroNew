<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="">
	<h1 class="text-center big_title">Reporte de servicios</h1>
 	<div class="col-sm-12 col-md-12 alert alert-info">

        <form id="" class="" target="_blank" action="<?php echo full_url."/adm/reporte_solicitudes/index.php"?>" method="post"> 
		<input type="hidden" name="action" value="pdf">
            <div id="campos">
				
			</div>
			<div class="form-group">
				<div class="col-sm-6 col-md-6">
					<label>Fecha desde: </label>
					<input id="desde" name="desde" type="text" class="filtros form-control input-sm">
				</div>
				<div class="col-sm-6 col-md-6">
					<label>Fecha hasta: </label>
                                        <input id="hasta" name="hasta" type="text" class="filtros form-control input-sm">
				</div>
				<div class="col-sm-6 col-md-6">
					<label>Estatus Grúa: </label>
					
					<select name="EstatusGrua" id="EstatusGrua" class="form-control input-sm filtros" >
						<option value="">Seleccione...</option>
						<option value="Completado">Completado</option>
						<option value="Cancelado">Cancelado</option>
						<option value="Asistiendo">Asistiendo</option>
						<option value="Activo">Activo</option>
					</select>
				</div>
				<div class="col-sm-6 col-md-6">
					<label>Estatus Cliente: </label>
					
					<select name="EstatusCliente" id="EstatusCliente" class="form-control input-sm filtros">
						<option value="">Seleccione...</option>
						<option value="Completado">Completado</option>
						<option value="Cancelado">Cancelado</option>
						<option value="Asistido">Asistido</option>
						<option value="Activo">Activo</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-12">
					<a id="buscar" class="btn btn-success"><i class="fa fa-filter"></i> Aplicar filtros</a>
					<button type="button" id="clear2" class="btn btn-success">Limpiar</button>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-12 col-md-12">
					<label>Seguro a emitir: </label>
						<select name="formato" class="form-control input-sm">
							<option value="1">Genérico</option>
							<?php foreach($seguros_list as $list):?>
							<option value="<?php echo $list['name']?>"><?php echo $list['name']?></option>
							<?php endforeach;?>
						</select>
						<button type="submit" class="btn btn-sm btn-success">Imprimir PDF</button>
				</div>
			</div>
        </form> 
		
		
		
		
			

            

	</div>  
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id.Solicitud</th>
					<th>Id.Póliza</th>
                    <th>Cédula</th>
					<th>Cliente</th>
					<th>Placa</th>
					<th>Modelo</th>
					<th>Seguro</th>
					<th>Origen</th>
					<th>Destino</th>
					<th>Taxi</th>
                    <th>Servicio baremo</th>
                    <th>Utilidad</th>
                    <th>Servicio de Grúa</th>
                    <th>Fecha</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><input id="idSolicitud" name="idSolicitud" type="text"></th>
                    <th><input id="idPoliza" name="idPoliza" type="text"></th>
                    <th><input id="Cedula" name="Cedula" type="text"></th>			
					<th><input id="Cliente" name="Cliente" type="text"></th>
					<th><input id="Placa" name="Placa" type="text"></th>
					<th><input id="Modelo" name="Modelo" type="text"></th>
					<th><input id="Seguro" name="Seguro" type="text"></th>
					<th><input id="EstadoOrigen" name="EstadoOrigen" type="text"></th>
					<th><input id="Direccion" name="Direccion" type="text"></th>
                    <th>Taxi</th>
                    <th>Servicio baremo</th>
                    <th>Utilidad</th>
                    <th>Servicio de Grúa</th>
                    <th><input id="TimeOpen" name="TimeOpen" type="text"></th>
                    <th>Detalle</th>
					
				</tr>
			</tfoot>
		</table> 
      
</div>
  


	<?php include('../../view_footer_solicitud.php')?>
<script>

	

	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		
		if($(this).index()!=14 && $(this).index()!=9 && $(this).index()!=10 && $(this).index()!=11 && $(this).index()!=12)
		{
			$(this).html( '<input size="10" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );
            $('#campos').append( '<input size="10" class="input-sm filtros" id="field_'+$(this).index()+'" type="hidden"  name="field_'+$(this).index()+'"/> ' );	
		}
		if($(this).index()==14)
		{
			$(this).html( '<button id="clear">Limpiar</button>' );	
		}

	} );

	
    var table = $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
		 "sDom": 'ltrip',
        "ajax": {
                    "url": "<?php echo full_url."/adm/reporte_solicitudes/index.php?action=list_json"?>",
                    "data": function(d) {
                    d.desde = $('#desde').val();
                    d.hasta =  $('#hasta').val();
                    d.EstatusGrua = $('#EstatusGrua').val();
                    d.EstatusCliente = $('#EstatusCliente').val();
                    }
		},
	
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "rowCallback": function( row, data, index ) {
            if ( data.MontoTaxiLimpio != "0.00") 
            {
                    //alert(data.MontoTaxiLimpio);           
            }

        },  
        "columns": [
            { "data": "idSolicitud" },
            { "data": "idPoliza" },
            { "data": "Cedula" },
            { "data": "Cliente" },
            { "data": "Placa" },
            { "data": "Modelo" },
            { "data": "Seguro" },
            { "data": "EstadoOrigen" },
            { "data": "Direccion" },
            { "data": "MontoTaxi" },
            { "data": "Monto" },
            { "data": "Utilidad" },
            { "data": "MontoFinal" },
            { "data": "TimeOpen" },
            { "data": "actions" }

			
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 9,10,11,12,14 ] }
       ]
    });

$('#column_0').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(0)).search($(this).val()).draw();
        $('#field_0').val($(this).val());
    }
});
$('#column_1').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(1)).search($(this).val()).draw();
        $('#field_1').val($(this).val());
    }
});
$('#column_2').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(2)).search($(this).val()).draw();
        $('#field_2').val($(this).val());
    }
});
$('#column_3').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(3)).search($(this).val()).draw();
        $('#field_3').val($(this).val());
    }
});
$('#column_4').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(4)).search($(this).val()).draw();
        $('#field_4').val($(this).val());
    }
});
$('#column_5').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(5)).search($(this).val()).draw();
        $('#field_5').val($(this).val());
    }
});
$('#column_6').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(6)).search($(this).val()).draw();
        $('#field_6').val($(this).val());
    }
});
$('#column_7').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(7)).search($(this).val()).draw();
        $('#field_7').val($(this).val());
    }
});
$('#column_8').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(8)).search($(this).val()).draw();
        $('#field_8').val($(this).val());
    }
});
$('#column_9').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(9)).search($(this).val()).draw();
        $('#field_9').val($(this).val());
    }
});
$('#column_10').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(10)).search($(this).val()).draw();
        $('#field_10').val($(this).val());
    }
});
$('#column_11').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(11)).search($(this).val()).draw();
        $('#field_11').val($(this).val());
    }
});
$('#column_12').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(12)).search($(this).val()).draw();
        $('#field_12').val($(this).val());
    }
});
$('#column_13').on ('keypress', function(e){
    if(e.which == 13) {
        table.column(table.column(13)).search($(this).val()).draw();
        $('#field_13').val($(this).val());
    }
});
	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});
	$('#clear2').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});
$('#buscar').click(function(){
	 table.draw();
});

function changeUtilidad(idSolicitud, monto, utilidad)
{
	
		$.ajax({
		  type: "POST",
		  url: '<?php echo full_url?>/adm/ajax/index.php',
		  data: {action: 'change_utilidad',idSolicitud:idSolicitud,monto: monto, utilidad:utilidad},
		  success: function(){
                                table.draw();
				alert('Utilidad actualizada para el servicio #' + idSolicitud);
				
		  },
		});		


	

}
function changeMontoTaxi(idSolicitud, monto)
{
	
		$.ajax({
		  type: "POST",
		  url: '<?php echo full_url?>/adm/ajax/index.php',
		  data: {action: 'change_monto_taxi',idSolicitud:idSolicitud,MontoTaxi: monto},
		  success: function(){
                                table.draw();
                                alert('Monto taxi actualizado para el servicio #' + idSolicitud);
				
		  },
		});		


	

}

</script>