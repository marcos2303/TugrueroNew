<table id="example" border="1" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
  <thead class="">
    <tr>
      <td colspan="64"><label for="Seleccionador"><input type="checkbox" id="Seleccionador"> Seleccionar/Deseleccionar</label></td>
    </tr>
    <tr>
      <th>Código</th>
      <th>Aplicación</th>
      <th>Tipo</th>
      <th>#Factura</th>
      <th>Fecha factura digital</th>
      <th>Fecha factura física</th>
      <th>Fecha estimada pago</th>
      <th>¿Pagada?</th>
      <th>Precio S/IVA baremo</th>
      <th>IVA baremo</th>
      <th>Precio C/IVA Baremo</th>
      <th>Precio S/IVA modificado</th>
      <th>IVA modificado</th>
      <th>Precio C/IVA modificado</th>
      <th>Precio cliente S/IVA</th>
      <th>IVA cliente</th>
      <th>Precio cliente C/IVA</th>
      <th>Detalle</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th><input id="CodigoServicio" name="CodigoServicio" type="text"></th>
      <th><input id="NombreAplicacion" name="NombreAplicacion" type="text"></th>
      <th><input id="NombreServicioTipo" name="NombreServicioTipo" type="text"></th>
      <th><input id="NumeroFactura" name="NumeroFactura" type="text"></th>
      <th><input id="FechaFacturaDigital" name="FechaFacturaDigital" type="text"></th>
      <th><input id="FechaFacturaFisica" name="FechaFacturaFisica" type="text"></th>
      <th><input id="FechaEstimadaPagos" name="FechaEstimadaPago" type="text"></th>
      <th><input id="FacturaPagada" name="FacturaPagada" type="text"></th>
      <th><input id="PrecioSIvaBaremo" name="PrecioSIvaBaremo" type="text"></th>
      <th><input id="IvaBaremo" name="IvaBaremo" type="text"></th>
      <th><input id="PrecioCIvaBaremo" name="PrecioCIvaBaremo" type="text"></th>
      <th><input id="PrecioSIvaModificado" name="PrecioSIvaModificado" type="text"></th>
      <th><input id="IvaModificado" name="IvaModificado" type="text"></th>
      <th><input id="PrecioCIvaModificado" name="PrecioCIvaModificado" type="text"></th>
      <th><input id="PrecioClienteSIva" name="PrecioClienteSIva" type="text"></th>
      <th><input id="IvaCliente" name="IvaCliente" type="text"></th>
      <th><input id="PrecioClienteCIva" name="PrecioClienteCIva" type="text"></th>

      <th>Detalle</th>
    </tr>
  </tfoot>
</table>
<?php if(isset($values['regresar']) and $values['regresar'] == 1):?>
  <a href="#" class="btn btn-default" onclick="ListarGruas(<?php echo $values['IdProveedor']?>);"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

<?php endif;?>
<script>

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
    { "data" : "NombreAplicacion" },
    { "data" : "NombreServicioTipo" },
    { "data" : "NumeroFactura" },
    { "data" : "FechaFacturaDigital" },
    { "data" : "FechaFacturaFisica" },
    { "data" : "FechaEstimadaPago" },
    { "data" : "FacturaPagada" },
    { "data" : "PrecioSIvaBaremo" },
    { "data" : "IvaBaremo" },
    { "data" : "PrecioCIvaBaremo" },
    { "data" : "PrecioSIvaModificado" },
    { "data" : "IvaModificado" },
    { "data" : "PrecioCIvaModificado" },
    { "data" : "PrecioClienteSIva" },
    { "data" : "IvaCliente" },
    { "data" : "PrecioClienteCIva" },
    { "data" : "actions" },
  ],
  "aoColumnDefs": [
    { "visible": false, "targets": [1,8,9,10,11,12,13,14,15,16]},
    //{ "targets": -1, "visible": false},
    { 'bSortable': false, 'aTargets': [ 17 ] }
  ]
});
$('#example').css( 'display', 'table' );

//table.responsive.recalc();

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
