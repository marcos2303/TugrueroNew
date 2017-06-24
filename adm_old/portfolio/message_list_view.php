<?php include('../../view_header.php')?>
<link href="<?php echo full_url;?>/web/css/datatables.css" rel="stylesheet">

<table id="example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Email</th>
                <th>Teléfono</th>
		<th>Mensaje</th>
                <th>Fecha</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Email</th>
                <th>Teléfono</th>
		<th>Mensaje</th>
                <th>Fecha</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
<a class="btn btn-success"  href="<?php echo full_url."/adm/messages/index.php?action=new"?>">Agregar</a>
<?php include('../../view_footer.php')?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo full_url."/adm/messages/index.php?action=messages_list_json"?>",
        "columns": [
            { "data": "id_message" },
            { "data": "names" },
            { "data": "email" },
            { "data": "phone" },
            { "data": "message" },
            { "data": "date_added" },
            { "data": "status" },
            { "data": "actions" }
        ],
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 7 ] }
       ]				
    });
} );

</script>
<script src="<?php echo full_url;?>/web/js/datatables.js"></script>