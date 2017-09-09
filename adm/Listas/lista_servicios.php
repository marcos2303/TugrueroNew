<table id="example" class="table table-striped table-bordered table-responsive" width="100%">
  <thead class="">
    <tr>
      <th>IdServicio</th>
      <th>Código</th>
      <th>Detalle</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th><input id="IdServicio" name="IdServicio" type="text"></th>
      <th><input id="CodigoServicio" name="CodigoServicio" type="text"></th>
      <th>Detalle</th>
    </tr>
  </tfoot>
</table>
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
    }
    if(title == 'Detalle')
    {
      $(this).html( '<button id="clear" class="btn btn-default">Limpiar</button>' );
    }

  } );


  var table = $('#example').DataTable({
    "scrollX": true,
    "processing": true,
    "sServerMethod": "POST",
    "serverSide": true,
    "bAutoWidth": true,
    "sScrollY": "260",
    "sDom": 'Btrp',
    "ajax":link_servidor + "/adm/Listas/index.php?action=lista_servicios_json&IdProveedor=<?php echo $values['IdProveedor'];?>&IdGrua=<?php echo $values['IdGrua'];?>&EditarServicio=<?php echo $values['EditarServicio'];?>",
    "language": {
      "url": link_servidor + "/web/js/datatables.spanish.lang"
    },

buttons: [
            'colvis'
        ],
                "columns": [
                  { "data" : "IdServicio" },
                  { "data" : "CodigoServicio" },
                  { "data" : "actions" },
                ],
                "aoColumnDefs": [
                  { "visible": false, "targets": []
                  },
                  { 'bSortable': false, 'aTargets': [ 2 ] }
                ]
              });
                 new FixedColumns( table );
                //$('#example').css( 'display', 'table' );

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
        console.log(data);
    } );
	$('#example tbody').on('dblclick', 'tr', function () {
	var data = table.row( this ).data();
	$(this).addClass('seleccionado');

	$(location).attr('href', '<?php echo full_url."/adm/Servicios/index.php?action=edit&IdServicio="?>' + data.IdServicio);
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
        $('#column_11').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(11)).search($(this).val()).draw();
          }
        });
        $('#column_12').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(12)).search($(this).val()).draw();
          }
        });
        $('#column_13').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(13)).search($(this).val()).draw();
          }
        });
        $('#column_14').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(14)).search($(this).val()).draw();
          }
        });
        $('#column_15').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(15)).search($(this).val()).draw();
          }
        });
        $('#column_16').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(16)).search($(this).val()).draw();
          }
        });
        $('#column_17').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(17)).search($(this).val()).draw();
          }
        });
        $('#column_18').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(18)).search($(this).val()).draw();
          }
        });
        $('#column_19').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(19)).search($(this).val()).draw();
          }
        });
        $('#column_20').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(20)).search($(this).val()).draw();
          }
        });
        $('#column_21').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(21)).search($(this).val()).draw();
          }
        });
        $('#column_22').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(22)).search($(this).val()).draw();
          }
        });
        $('#column_23').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(23)).search($(this).val()).draw();
          }
        });
        $('#column_24').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(24)).search($(this).val()).draw();
          }
        });
        $('#column_25').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(25)).search($(this).val()).draw();
          }
        });
        $('#column_26').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(26)).search($(this).val()).draw();
          }
        });
        $('#column_27').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(27)).search($(this).val()).draw();
          }
        });
        $('#column_28').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(28)).search($(this).val()).draw();
          }
        });
        $('#column_29').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(29)).search($(this).val()).draw();
          }
        });
        $('#column_30').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(30)).search($(this).val()).draw();
          }
        });
        $('#column_31').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(31)).search($(this).val()).draw();
          }
        });
        $('#column_32').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(32)).search($(this).val()).draw();
          }
        });
        $('#column_33').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(33)).search($(this).val()).draw();
          }
        });
        $('#column_34').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(34)).search($(this).val()).draw();
          }
        });
        $('#column_35').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(35)).search($(this).val()).draw();
          }
        });
        $('#column_36').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(36)).search($(this).val()).draw();
          }
        });
        $('#column_37').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(37)).search($(this).val()).draw();
          }
        });
        $('#column_38').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(38)).search($(this).val()).draw();
          }
        });
        $('#column_39').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(39)).search($(this).val()).draw();
          }
        });
        $('#column_40').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(40)).search($(this).val()).draw();
          }
        });
        $('#column_41').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(41)).search($(this).val()).draw();
          }
        });
        $('#column_42').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(42)).search($(this).val()).draw();
          }
        });
        $('#column_43').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(43)).search($(this).val()).draw();
          }
        });
        $('#column_44').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(44)).search($(this).val()).draw();
          }
        });
        $('#column_45').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(45)).search($(this).val()).draw();
          }
        });
        $('#column_46').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(46)).search($(this).val()).draw();
          }
        });
        $('#column_47').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(47)).search($(this).val()).draw();
          }
        });
        $('#column_48').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(48)).search($(this).val()).draw();
          }
        });
        $('#column_49').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(49)).search($(this).val()).draw();
          }
        });
        $('#column_50').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(50)).search($(this).val()).draw();
          }
        });
        $('#column_51').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(51)).search($(this).val()).draw();
          }
        });
        $('#column_52').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(52)).search($(this).val()).draw();
          }
        });
        $('#column_53').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(53)).search($(this).val()).draw();
          }
        });
        $('#column_54').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(54)).search($(this).val()).draw();
          }
        });
        $('#column_55').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(55)).search($(this).val()).draw();
          }
        });
        $('#column_56').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(56)).search($(this).val()).draw();
          }
        });
        $('#column_57').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(57)).search($(this).val()).draw();
          }
        });
        $('#column_58').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(58)).search($(this).val()).draw();
          }
        });
        $('#column_59').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(59)).search($(this).val()).draw();
          }
        });
        $('#column_60').on ('keypress', function(e){
          if(e.which == 13) {
            table.column(table.column(60)).search($(this).val()).draw();
          }
        });
        $('#clear').click(function(){
          table.search( '' ).columns().search( '' ).draw();
          $('.filtros').val('');
        });


      } );
      </script>
