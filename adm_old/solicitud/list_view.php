<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<style>
.modal-dialog-center {
    margin-top: 50%;
	padding-left: 60%;
}	
</style>
	<h1 class="text-center">Solicitudes/Servicios Activos</h1>
	<div class="col-sm-8 col-sm-offset-4 well" >
		<a class="btn btn-default"  href="<?php echo full_url."/adm/Polizas/index.php"?>"><i class="fa fa-file-o fa-pull-left"></i> Generar Solicitud</a>
		<a class="text-center btn btn-primary" target="_blank" href="<?php echo full_url?>/adm/solicitud/index.php?action=solicitudes_livemap"><i class="fa fa-map-marker fa-pull-left"></i> Ver solicitudes/servicios activos en Mapa</a>
		<a class="text-center btn btn-primary" target="_blank" href="<?php echo full_url?>/adm/solicitud/index.php?action=grueros_mapa"><i class="fa fa-map-marker fa-pull-left"></i> Ver grueros en Mapa</a>
		
	
	</div>
        <table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
            <thead>
                    <tr>
                        <th>IdSolicitud/Servicio</th>
                        <th>IdPoliza</th>
						<th>Origen</th>
                        <th>Cedula</th>
                        <th>Placa</th>
                        <th>Status solicitud</th>
                        <th>Status cliente</th>
                        <th>Status gruero</th>
						<th>Abierto</th>
                        <th>Inicio</th>						
                        <th style="min-width: 150px;">Detalle</th>
                    </tr>
            </thead>
            <tfoot>
                    <tr>
                        <th>IdSolicitud/Servicio</th>
                        <th>IdPoliza</th>
						<th>Origen</th>
                        <th>Cedula</th>
                        <th>Placa</th>
                        <th>Status solicitud</th>
                        <th>Status cliente</th>
                        <th>Status gruero</th>
						<th>Abierto</th>
                        <th>Inicio</th>						
                        <th>Detalle</th>
                    </tr>
            </tfoot>
        </table>
	<div class="col-sm-4 col-sm-offset-8">
		
		
	</div>
	

        <div class="col-sm-12" id="toogles">
            
        </div>
	<?php include('../../view_footer_solicitud.php')?>
<script>

	
$(document).ready(function() {
	$('#example tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		
		if(title != 'Detalle')
		{       //$('#toogles').append('- <a class="btn btn-success toggle-vis" data-column="'+$(this).index()+'">'+title+'</a>' );
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
		"aaSorting": [ [0,"desc" ]],
		 "sDom": 'ltrip',
		//"cache": false,
        "ajax": "<?php echo full_url."/adm/solicitud/index.php?action=list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },"rowCallback": function( row, data, index ) {
            //alert(data.Status);
            /*if ( data.idSolicitud == "10" ) {
				$(row).css("background-color","red");
				$("td:eq(3)", row).css("background-color","red");
			 
            }*/
            if ( data.EstatusSolicitud == "Desierto" ) {
				$("td:eq(5)", row).css("background-color","red");
				beep();
            }
            if ( data.StatusDesierto == "1" ) {
				$("td:eq(5)", row).css("background-color","yellow");
				//beep();
            }
            if ( data.RetardoActivoActivo == "1" ) {
				$(row).css("background-color","red");
				beep();
			 
            }
            if ( data.EstatusGrua == "Abandonado" ) {
				$(row).css("background-color","orange");
				beep();
			 
            }
        },
        "columns": [
            { "data": "idSolicitud" },
            { "data": "idPoliza" },
			{ "data": "Origen" },
            { "data": "Cedula" },
            { "data": "Placa" },
            { "data": "EstatusSolicitud" },
            { "data": "EstatusCliente" },
            { "data": "EstatusGrua" },
			{ "data": "TimeOpen" },
            { "data": "TimeInicio" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 10 ] }
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
        table.column(table.column(9)).search($(this).val()).draw();
    }
});
	$('#clear').click(function(){
		table.search( '' ).columns().search( '' ).draw();
		$('.filtros').val('');
	});
setInterval( function () {
    table.ajax.reload();
},25000 );
    
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
} );

   
</script>
<script>
function beep() {
    var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
    snd.play();
}
//beep();


</script>
<script>
    function addBitacora(idSolicitud){
        //alert(idSolicitud);
	$.ajax({
		type: "GET",
		url: '<?php echo full_url;?>/adm/solicitud/index.php',
		data: { action: "bitacora_list", idSolicitud: idSolicitud},
		success: function(html){
			$('.modal-body').html(html);
			$('.modal-title').html('Bitácora');
			$('#myModal').modal('show');
		}
	});
    }
    function saveBitacora(){
       var data_form = $("#bitacoraForm").serializeArray();
       if(data_form[1].value == '')
       {
           alert('La observación no puede estar vacía');
       }else
       {
		  
		    $('#save_bitacora').addClass('disabled');
            $.ajax({
                    type: "POST",
                    url: '<?php echo full_url;?>/adm/solicitud/index.php?action=save_bitacora',
                    data: data_form,
                    success: function(html){
						alert('Observación agregada satisfactoriamente');
						$('#myModal').modal('toggle');
                    }
            });           
       }

            
    }
</script>