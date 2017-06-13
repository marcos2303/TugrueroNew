<?php //include('../../view_header_app.php')?>
<?php //include('../menu.php')?>

	<h1 class="text-center">Grueros</h1>

        <table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
            <thead>
                    <tr>
                        <th>Id.Grúa</th>
						<th>Cédula</th>
						<th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Celular</th>
						<th>Disponible</th>
						<th>Estado</th>
						<th>Ciudad</th>
                        <th>Detalle</th>
                    </tr>
            </thead>
            <tfoot>
                    <tr>
                        <th>Id.Grúa</th>
						<th>Cédula</th>
						<th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Celular</th>
						<th>Disponible</th>
						<th>Estado</th>
						<th>Ciudad</th>
                        <th>Detalle</th>
                    </tr>
            </tfoot>
        </table>
	<?php //include('../../view_footer_solicitud.php')?>
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
			$(this).html( '<a id="clear" class="btn">Limpiar</a>' );	
		}

	} );

	
    var table = $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
		"aaSorting": [ [0,"desc" ]],
		 "sDom": 'ltrip',
		//"cache": false,
        "ajax": "<?php echo full_url."/adm/solicitud/index.php?action=gruero_select_datatable"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "idGrua" },
            { "data": "Cedula" },
			{ "data": "Nombre" },
            { "data": "Apellido" },
            { "data": "Placa" },
            { "data": "Modelo" },
            { "data": "Color" },
            { "data": "Celular" },
			{ "data": "Disponible" },
			{ "data": "zone_work" },
			{ "data": "location" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 11 ] }
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

function seleccionarGruero(idGrua, Nombre, Apellido, Cedula, Placa, Modelo, Color,Celular)
{
						if(confirm("¿Está seguro(a) de asignar a "+ Nombre + " " + Apellido +" Cédula " + Cedula +" con la grúa de placa "+ Placa + " modelo " + Modelo+" color "+Color+"?"))
						{

							var contentinfo = "<label>Cédula: </label> " + Cedula+ " <br>";
							contentinfo+= "<label>Nombre y apellido: </label> " + Nombre+ ' ' + Apellido + " <br>";
							contentinfo+= "<label>Contacto: </label> " + Celular+ " <br>";
							contentinfo+= "<label>Modelo: </label> " + Modelo+ " <br>";
							contentinfo+= "<label>Placa: </label> " + Placa+ " <br>";
							contentinfo+= "<label>Color: </label> " + Color + " <br>";					
							
							$("#idGrua").val(idGrua);
							$('#parcial_gruero').html(contentinfo);
							$('#myModal').data('modal', null);
							$('#myModal').modal('toggle');

						}
						else
						{
							return false;
						}
}
   
</script>