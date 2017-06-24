<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Masters</h1>
	<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Responsable</th>
					<th>Rif</th>
					<th>Razón social</th>
					<th>Disponibilidad en vivo</th>
					<th>Estatus</th>
					<th>Fecha creado</th>
					<th>Fecha modificado</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Id</th>
					<th>Responsable</th>
					<th>Rif</th>
					<th>Razón social</th>
					<th>Disponibilidad en vivo</th>
					<th>Estatus</th>
					<th>Fecha creado</th>
					<th>Fecha modificado</th>
					<th>Detalle</th>
				</tr>
			</tfoot>
		</table>
	<!--<a class="btn btn-default"  href="<?php echo full_url."/adm/company/index.php?action=new"?>"><i class="fa fa-file-o fa-pull-left fa-border"></i>Agregar</a>-->
</div>
	<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/company/index.php?action=company_list_json"?>",
		"language": {
                "url": "<?php echo full_url."/web/js/"?>datatables.spanish.lang"
        },
        "columns": [
            { "data": "id" },
            { "data": "responsible_name" },
            { "data": "RIF" },
			{ "data": "Razon_social" },
			{ "data": "Disponibilidad" },
            { "data": "status" },
            { "data": "date_created" },
            { "data": "date_updated" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 8 ] }
       ]				
    });
} );

</script>
