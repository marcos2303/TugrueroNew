<div class="table-responsive">
  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Código</th>
        <th>Tipo</th>
        <th>Estatus</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Detalle</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th><input id="CodigoServicio" name="CodigoServicio" type="text"></th>
        <th><input id="NombreServicioTipo" name="NombreServicioTipo" type="text"></th>
        <th><input id="NombreEstatus" name="NombreEstatus" type="text"></th>
        <th><input id="Inicio" name="Inicio" type="text"></th>
        <th><input id="Fin" name="Fin" type="text"></th>
        <th>Detalle</th>
      </tr>
    </tfoot>
  </table>
</div>

<?php if(isset($values['regresar']) and $values['regresar'] == 1):?>
  <a href="#" class="btn btn-default" onclick="ListarGruas(<?php echo $values['IdProveedor']?>);"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

<?php endif;?>
<script>
$(document).ready(function() {
  $('#example tfoot th').each( function () {
    var title = $('#example thead th').eq( $(this).index() ).text();

    if(title != 'Detalle')
    {
      $(this).html( '<input size="5%" class="input-sm filtros" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );
      if($(this).index() == 3 || $(this).index() == 4){
        $(this).html( '<input size="5%" class="input-sm filtros" id="column_'+$(this).index()+'" type="date" placeholder="'+title+'" />' );

      }
    }
    if(title == 'Detalle')
    {
      $(this).html( '<button id="clear" class="btn btn-default">Limpiar</button>' );
    }

  } );


  var table = $('#example').DataTable({
    "processing": true,
    "sServerMethod": "POST",
    "serverSide": true,
    lengthChange: false,
    //scrollCollapse: true,
    //"sScrollXInner":"110%",
    "sDom": 'Btrp',
    "ajax":link_servidor + "/adm/Listas/index.php?action=lista_servicios_grua_json&IdProveedor=<?php echo $values['IdProveedor'];?>&IdGrua=<?php echo $values['IdGrua'];?>&EditarServicio=<?php echo $values['EditarServicio'];?>",
    "language": {
      "url": link_servidor + "/web/js/datatables.spanish.lang"
    },

    "columns": [
      { "data" : "CodigoServicio" },
      { "data" : "NombreServicioTipo" },
      { "data" : "NombreEstatus" },
      { "data" : "Inicio" },
      { "data" : "Fin" },
      { "data" : "actions" },
    ],
    buttons: [
      {
        extend: 'colvis',
        collectionLayout: 'fixed two-column'
      }
    ],
    language: {
      buttons: {
        colvis: 'Mostrar/Ocultar columnas',
        colvisRestore: "Restaurar columnas",
      }
    },
    "aoColumnDefs": [
      { "visible": false, "targets": []},
      //{ "targets": -1, "visible": false},
      { 'bSortable': false, 'aTargets': [ 5 ] }
    ]
  });
  table.buttons().container().appendTo( '#example_wrapper .col-sm-6:eq(0)' );

  //click
  $('#example tbody').on( 'click', 'tr', function () {
    var data = table.row( this ).data();
    if ( $(this).hasClass('seleccionado') ) {
      $(this).removeClass('seleccionado');
    }
    else {
      table.$('tr.seleccionado').removeClass('seleccionado');
      $(this).addClass('seleccionado');
    }
    //console.log(data);
  } );
  $('#example tbody').on('dblclick', 'tr', function () {
    var data = table.row( this ).data();
    $(this).addClass('seleccionado');

    $(location).attr('href', '<?php echo full_url."/adm/Servicios/index.php?action=edit&IdServicio="?>' + data.IdServicio + "&IdServicioTipo=" + data.IdServicioTipo);
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
  $('#column_3').on ('change', function(e){

    table.column(table.column(3)).search($(this).val()).draw();

  });
  $('#column_4').on ('change', function(e){

    table.column(table.column(4)).search($(this).val()).draw();

  });
  $('#clear').click(function(){
    table.search( '' ).columns().search( '' ).draw();
    $('.filtros').val('');
  });


} );
</script>
