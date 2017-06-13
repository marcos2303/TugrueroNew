<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Operadores</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nombres y apellidos</th>
					<th>Usuario</th>
					<th>Master</th>
					<th>Disponibilidad</th>
					<th>Estatus</th>
					<th>Placa</th>
                    <th>Fecha creado</th>
                    <th>Fecha modificado</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id</th>
					<th>Nombres y apellidos</th>
					<th>Usuario</th>
					<th>Master</th>
					<th>Disponibilidad</th>
					<th>Estatus</th>
					<th>Placa</th>
                    <th>Fecha creado</th>
                    <th>Fecha modificado</th>
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>
	<!--<a class="btn btn-default"  href="<?php echo full_url."/adm/users/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>-->
</div>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/users/index.php?action=users_list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "id_user" },
			{ "data": "NombreApellido" },
            { "data": "login" },
			{ "data": "rif" },
			{ "data": "disponibilidad" },
            { "data": "status" },
			{ "data": "placa" },
            { "data": "date_created" },
            { "data": "date_updated" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 9] }
       ]				
    });
} );

</script>
