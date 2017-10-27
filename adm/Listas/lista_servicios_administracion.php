<table id="example" border="1" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
  <thead class="">
    <tr>
      <td colspan="20"><label for="Seleccionador"><input type="checkbox" id="Seleccionador"> Seleccionar/Deseleccionar</label></td>
    </tr>
    <tr>
      <th>Código</th>
      <th>Tipo</th>
      <th>#Factura</th>
      <th>Fecha factura digital</th>
      <th>Fecha factura física</th>
      <th>Fecha estimada pago</th>
      <th>¿Pagada?</th>
      <th>Detalle</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th class="text-center"><input id="CodigoServicio" class="form-control" name="CodigoServicio" type="text"></th>
      <th class="text-center"><input id="NombreServicioTipo" class="form-control" name="NombreServicioTipo" type="text"></th>
      <th class="text-center"><input id="NumeroFactura" class="form-control" name="NumeroFactura" type="text"></th>
      <th class="text-center"><input id="FechaFacturaDigital" class="form-control" name="FechaFacturaDigital" type="text"></th>
      <th class="text-center"><input id="FechaFacturaFisica" class="form-control" name="FechaFacturaFisica" type="text"></th>
      <th class="text-center"><input id="FechaEstimadaPagos" class="form-control" name="FechaEstimadaPago" type="text"></th>
      <th class="text-center">
        <select id="SelectFacturaPagada" class="form-control">
          <option>...</option>
          <option value = "1" >Si</option>
          <option value = "0" >No</option>
        </select>
      </th>
      <th class="text-center">Detalle</th>
    </tr>
  </tfoot>
</table>
<?php if(isset($values['regresar']) and $values['regresar'] == 1):?>
  <a href="#" class="btn btn-default" onclick="ListarGruas(<?php echo $values['IdProveedor']?>);"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

<?php endif;?>
<script>

$('#example tfoot th').each( function () {
  var title = $('#example thead th').eq( $(this).index() ).text();

  if(title != 'Detalle' && title != '¿Pagada?')
  {
    $(this).html( '<input size="10%" class="form-control" id="column_'+$(this).index()+'" type="text" placeholder="'+title+'" />' );
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
  "sDom": 'Btrp',
  "iDisplayLength": 10,
  "ajax":link_servidor + "/adm/Listas/index.php?action=lista_servicios_administracion_json&IdProveedor=<?php echo $values['IdProveedor'];?>&IdGrua=<?php echo $values['IdGrua'];?>",
  "language": {
    "url": link_servidor + "/web/js/datatables.spanish.lang"
  },

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
  "columns": [
    { "data" : "CodigoServicio" },
    { "data" : "NombreServicioTipo" },
    { "data" : "NumeroFactura" },
    { "data" : "FechaFacturaDigital" },
    { "data" : "FechaFacturaFisica" },
    { "data" : "FechaEstimadaPago" },
    { "data" : "FacturaPagada" },
    { "data" : "actions" },
  ],
  "aoColumnDefs": [
    { "visible": false, "targets": []},
    //{ "targets": -1, "visible": false},
    { 'bSortable': false, 'aTargets': [ 7 ] }
  ]
});
$('#example').css( 'display', 'table' );

//table.responsive.recalc();

$('#column_0').on('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(0)).search($(this).val()).draw();
  }
});
$('#column_1').on('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(1)).search($(this).val()).draw();
  }
});
$('#column_2').on('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(2)).search($(this).val()).draw();
  }
});
$('#column_3').on ('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(3)).search($(this).val()).draw();
  }
});
$('#column_4').on('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(4)).search($(this).val()).draw();
  }
});
$('#column_5').on('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(5)).search($(this).val()).draw();
  }
});
$('#column_6').on('keypress', function(e){
  if(e.which == 13) {
    table.column(table.column(6)).search($(this).val()).draw();
  }
});
$('#SelectFacturaPagada').on('change', function(e){
    if($(this).val() == 0 || $(this).val() == 1)  table.column(table.column(6)).search($(this).val()).draw();

});
$('#clear').click(function(){
  table.search( '' ).columns().search( '' ).draw();
  $('.filtros').val('');
});

$("#Seleccionador").click(function(){
  ManejarSeleccion($(this));
});
function ManejarSeleccion(e){
  if ($(e).is(':checked')) {
    $(".selec").prop("checked",true);
  }else{
    $(".selec").prop("checked",false);
  }
}
function CambiarNumeroFactura(e,IdServicioPadre){
  var NumeroFactura = $(e).val();
  var IdServicio = "";
  var parametros = {
    "IdServicio" : [],
    "NumeroFactura" : NumeroFactura
  };
  parametros["IdServicio"].push(IdServicioPadre);
  $('.selec').each(function (i,v) {

    if ($(v).is(':checked')) {
      IdServicio = $(v).val();
      $(".NumeroFactura_"+IdServicio).val(NumeroFactura);
      parametros["IdServicio"].push(IdServicio);
    }
  });

  var actualizarServicioPrecio = AjaxCall("servicios/clienteapp/actualizarServicioPrecioArray.php", parametros, null, null,null);

  var popup = {
    "popup": "popupSuccess",
    "imagen": "none",
    "mensaje": "Registro(s) actualizado(s) satisfactoriamente.",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  genericPop(popup);
}
function CambiarFechaFacturaDigital(e,IdServicioPadre){
  var FechaFacturaDigital = $(e).val();
  var IdServicio = "";
  var parametros = {
    "IdServicio" : [],
    "FechaFacturaDigital" : FechaFacturaDigital
  };
  parametros["IdServicio"].push(IdServicioPadre);
  $('.selec').each(function (i,v) {

    if ($(v).is(':checked')) {
      IdServicio = $(v).val();
      $(".FechaFacturaDigital_"+IdServicio).val(FechaFacturaDigital);
      parametros["IdServicio"].push(IdServicio);
    }
  });
  var actualizarServicioPrecio = AjaxCall("servicios/clienteapp/actualizarServicioPrecioArray.php", parametros, null, null,null);

  var popup = {
    "popup": "popupSuccess",
    "imagen": "none",
    "mensaje": "Registro(s) actualizado(s) satisfactoriamente.",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  genericPop(popup);

}
function CambiarFechaFacturaFisica(e,IdServicioPadre){
  var FechaFacturaFisica = $(e).val();
  var IdServicio = "";
  var parametros = {
    "IdServicio" : [],
    "FechaFacturaFisica" : FechaFacturaFisica
  };
  parametros["IdServicio"].push(IdServicioPadre);
  $('.selec').each(function (i,v) {

    if ($(v).is(':checked')) {
      IdServicio = $(v).val();
      $(".FechaFacturaFisica_"+IdServicio).val(FechaFacturaFisica);
      parametros["IdServicio"].push(IdServicio);
    }
  });

  var actualizarServicioPrecio = AjaxCall("servicios/clienteapp/actualizarServicioPrecioArray.php", parametros, null, null,null);
  $(actualizarServicioPrecio.IdServicio).each(function (i,v) {
    $(".FechaEstimadaPago_"+ v).val(actualizarServicioPrecio.FechaEstimadaPago);

  });

  var popup = {
    "popup": "popupSuccess",
    "imagen": "none",
    "mensaje": "Registro(s) actualizado(s) satisfactoriamente.",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  genericPop(popup);
}
function CambiarFacturaPagada(e,IdServicioPadre){


  var Pagada = 0;
  var IdServicio = "";
  if ($(e).is(':checked')) {
    Pagada = 1;
  }else{
    Pagada = 0;
  }
  var parametros = {
    "IdServicio" : [],
    "FacturaPagada" : Pagada
  };
  parametros["IdServicio"].push(IdServicioPadre);
  $('.selec').each(function (i,v) {

    if ($(v).is(':checked')) {
      IdServicio = $(v).val();
      $(".FacturaPagada_"+IdServicio).val(Pagada);
      if(Pagada){
        $(".FacturaPagada_"+IdServicio).prop("checked","checked");
      }else{
        $(".FacturaPagada_"+IdServicio).prop("checked",false);
      }

      parametros["IdServicio"].push(IdServicio);
      //closePops();
    }
  });
  var actualizarServicioPrecio = AjaxCall("servicios/clienteapp/actualizarServicioPrecioArray.php", parametros,null,null,null);
  var popup = {
    "popup": "popupSuccess",
    "imagen": "none",
    "mensaje": "Registro(s) actualizado(s) satisfactoriamente.",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  genericPop(popup);
}
</script>
<script src="<?php echo full_url;?>/web/js/Administracion.js"></script>
