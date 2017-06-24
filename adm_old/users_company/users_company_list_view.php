<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center"><label class="label label-default">Usuarios compañias</label></h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Usuario</th>
					<th>Compañia</th>
					<th>Status</th>
                                        <th>Fecha creado</th>
                                        <th>Fecha modificado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id</th>
					<th>Usuario</th>
					<th>Compañia</th>
					<th>Status</th>
                                        <th>Fecha creado</th>
                                        <th>Fecha modificado</th>
					<th>Acciones</th>
				</tr>
			</tfoot>
		</table>
	<a class="btn btn-default"  href="<?php echo full_url."/adm/users_company/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>
</div>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/users_company/index.php?action=users_company_list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "id" },
            { "data": "login" },
            { "data": "razon_social" },
            { "data": "status" },
            { "data": "date_created" },
            { "data": "date_updated" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 6 ] }
       ]				
    });
} );

</script>
