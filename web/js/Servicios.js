$(document).ready(function(){
  listaMarcas();
  if($("#IdServicioTipo").val()=="1"){
    $(".asegurado").show();
    $('#Nombres').prop('readonly', true);
    $('#Apellidos').prop('readonly', true);
    $('#Celular').prop('readonly', true);
    $('#IdMarca').prop('disabled', true);
    $('#Modelo').prop('readonly', true);
    $('#Color').prop('readonly', true);
  }else{
    $(".asegurado").hide();
  }
  //crear servicio
  var parametros_iniciales = {
    "IdServicioTipo" : $("#IdServicioTipo").val(),
    "IdAplicacion" : 2,
    "IdEstatus" : 1,
    "IdUsuario" : $("#IdUsuario").val(),
  };
  var RespuestaServicio = AjaxCall("servicios/clienteapp/agregarServicio.php", parametros_iniciales, agregarSuccess, MensajeError);
  $("#IdServicio").val(RespuestaServicio.IdServicio);
  $("#CodigoServicio").val(RespuestaServicio.CodigoServicio);
  //cargar historial de servicios


  //activar el onchange de los campos
  $(".SaveAutomaticoServicio").change(function(){
    GuardarAutomaticoServicio();
    if($(this).attr('name') == "Cedula" || $(this).attr('name') == "Placa"){
      CargaHistorialServicios();
    }


  });
  $(".SaveAutomaticoServicioCliente").change(function(){
    GuardarAutomaticoServicioCliente();

    if($(this).attr('name') == "Cedula" || $(this).attr('name') == "Placa"){
      CargaHistorialServicios();
    }
  });
});//end document ready

function GuardarAutomaticoServicio(){
  var DataForm = $('#DataForm SaveAutomaticoServicio').serializeArray();
  //Servicios
  var parametros_servicio = convertiraAJson(DataForm);
  delete parametros_servicio.Cedula;
  var actualizarServicio = AjaxCall("servicios/clienteapp/actualizarServicio.php", parametros_servicio, agregarSuccess, MensajeError);


}
function GuardarAutomaticoServicioCliente(){
  var DataForm = $('#DataForm .SaveAutomaticoServicioCliente').serializeArray();
  //Servicios clientes
  var parametros_servicio_cliente = convertiraAJson(DataForm);
  //console.log(parametros_servicio_cliente);
  var actualizarServicio = AjaxCall("servicios/clienteapp/actualizarServicioCliente.php", parametros_servicio_cliente, agregarSuccess, MensajeError);

}
function CargaHistorialServicios(){
  $.ajax({
    url: link_servidor + "/adm/Listas/index.php?action=lista_servicios_corta",
    success: function(html){
      $("#DivHistorialServicios").html(html);
    }
  });


}
function DatosPoliza(){
  var Cedula = $("#Cedula").val();
  var Placa = $("#Placa").val();
  var parametros_poliza = {
    "Cedula" : Cedula,
    "Placa" : Placa
  }
  var datos_poliza = AjaxCall("servicios/adminapp/datosPoliza.php", parametros_poliza);
  if(datos_poliza.IdPoliza){
    $("#IdPoliza").val(datos_poliza.IdPoliza);
    $("#Nombres").val(datos_poliza.Nombres);
    $("#Apellidos").val(datos_poliza.Apellidos);
    $("#IdMarca").val(datos_poliza.IdMarca);
    $("#Modelo").val(datos_poliza.Modelo);
    $("#Color").val(datos_poliza.Color);
    $("#Celular").val(datos_poliza.Celular);
    $("#DesdeVigencia").val(datos_poliza.DesdeVigencia);
    $("#Vencimiento").val(datos_poliza.Vencimiento);
    $("#Celular").val(datos_poliza.Celular);
    $("#Domicilio").val(datos_poliza.Domicilio);

    GuardarAutomaticoServicioCliente();

  }
}
