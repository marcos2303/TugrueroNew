$(document).ready(function(){
  $.ajax({
    url: link_servidor + "/adm/Mapas/index.php?action=mapa_servicio",
    success: function(html){
      $('#MapaServicio').html(html);
    }
  });

  listaMarcas();
  listaEstadosOrigen();
  listaEstadosDestino();
  listaSeguros();
  listaAverias();
  listaCondicionLugar();
  $("#IdAveriaHijo").hide();
  //listaAveriasHijo();
  if($("#IdServicioTipo").val()=="1"){
    $(".asegurado").show();
    $('#Nombres').prop('readonly', true);
    $('#Apellidos').prop('readonly', true);
    $('#Celular').prop('readonly', true);
    $('#IdMarca').prop('disabled', true);
    $('#Modelo').prop('readonly', true);
    $('#Color').prop('readonly', true);
    $('#IdSeguro').prop('disabled', true);
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
  $("#Inicio").val(RespuestaServicio.DatosServicio.Inicio);
  //cargar historial de servicios


  //activar el onchange de los campos
  $(".SaveAutomaticoServicio").change(function(){

    if($(this).attr('name') == "Cedula" || $(this).attr('name') == "Placa"){
      CargaHistorialServicios();
    }
    if($(this).attr('name') == "IdAveria"){

      listaAveriasHijo($("#IdAveriaHijo").val(),$(this).val());
      console.log($('#IdAveria option:selected').val());
      if($('#IdAveria option:selected').val()==1 || $('#IdAveria option:selected').val()==4){
        $("#IdAveriaHijo").show();
        $("#IdAveriaHijo").css("display", "block");
      }else{
        $(".Averias").hide();
        $(".Averias").css("display", "hide");
      }
    }

    GuardarAutomaticoServicio();
  });
  $(".SaveAutomaticoServicioCliente").change(function(){
    GuardarAutomaticoServicioCliente();

    if($(this).attr('name') == "Cedula" || $(this).attr('name') == "Placa"){
      CargaHistorialServicios();
    }
  });
  $(".SaveAutomaticoServicioGrua").change(function(){
    GuardarAutomaticoServicioGrua();
  });
});//end document ready

function GuardarAutomaticoServicio(){
  var DataForm = $('#DataForm .SaveAutomaticoServicio').serializeArray();
  //Servicios
  var parametros_servicio = convertiraAJson(DataForm);
  delete parametros_servicio.Cedula;
  var actualizarServicio = AjaxCall("servicios/clienteapp/actualizarServicio.php", parametros_servicio, agregarSuccess, MensajeError);
  //console.log(actualizarServicio);
  var parametros_servicio = {
    "IdServicio" : $("#IdServicio").val()
  }
  var DatosServicio = AjaxCall("servicios/clienteapp/datosServicio.php", parametros_servicio, agregarSuccess, MensajeError);

  $("#CodigoServicio").val(DatosServicio.CodigoServicio);
  $("#Inicio").val(DatosServicio.Inicio);

}
function GuardarAutomaticoServicioCliente(){
  var DataForm = $('#DataForm .SaveAutomaticoServicioCliente').serializeArray();
  //Servicios clientes
  var parametros_servicio_cliente = convertiraAJson(DataForm);
  console.log(parametros_servicio_cliente);
  var actualizarServicio = AjaxCall("servicios/clienteapp/actualizarServicioCliente.php", parametros_servicio_cliente, agregarSuccess, MensajeError);
  var parametros_servicio = {
    "IdServicio" : $("#IdServicio").val()
  }
  var DatosServicio = AjaxCall("servicios/clienteapp/datosServicio.php", parametros_servicio, agregarSuccess, MensajeError);

  $("#CodigoServicio").val(DatosServicio.CodigoServicio);
  $("#Inicio").val(DatosServicio.Inicio);
}
function GuardarAutomaticoServicioGrua(){
  var DataForm = $('#DataForm .SaveAutomaticoServicioGrua').serializeArray();
  var parametros_servicio_grua = convertiraAJson(DataForm);
  var actualizarServicioGrua = AjaxCall("servicios/clienteapp/actualizarServicioGrua.php", parametros_servicio_grua, agregarSuccess, MensajeError);
}
function CargaHistorialServicios(){
  var Cedula = $("#Cedula").val();
  var Placa = $("#Placa").val();
  $.ajax({
    url: link_servidor + "/adm/Listas/index.php?action=lista_servicios_corta",
    data: { Cedula: Cedula, Placa: Placa},
    success: function(html){

      $("#DivHistorialServicios").html(html);
      $("#example").dataTable().fnAdjustColumnSizing();
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
    console.log("poliza");
    $('#IdServicioTipo').val(1);
    $("#IdPoliza").val(datos_poliza.IdPoliza);
    $("#IdSeguro").val(datos_poliza.IdSeguro);
    $("#Nombres").val(datos_poliza.Nombres);
    $("#Apellidos").val(datos_poliza.Apellidos);
    $("#IdMarca").val(datos_poliza.IdMarca);
    $("#Modelo").val(datos_poliza.Modelo);
    $("#Color").val(datos_poliza.Color);
    $("#CelularBD").val(datos_poliza.Celular);
    $("#DesdeVigencia").val(datos_poliza.DesdeVigencia);
    $("#Vencimiento").val(datos_poliza.Vencimiento);
    $("#CelularBD").val(datos_poliza.Celular);
    $("#Domicilio").val(datos_poliza.Domicilio);
    $("#Celular").val(datos_poliza.Celular);
    $('#Celular').prop('readonly', false);

    //listaSeguros(datos_poliza.IdSeguro);
    /*console.log(datos_poliza.IdSeguro);
    console.log($('#IdSeguro option:selected').val());*/
    GuardarAutomaticoServicio();
    GuardarAutomaticoServicioCliente();


  }else{
      autenticacionPolizaForanea();
  }
}
  function autenticacionPolizaForanea(){
    var popup = {
			"popup": "popupAutenticacion",
			"imagen": "none",
			"mensaje": "¿La póliza consultada no se encuentra registrada, coloque credenciales para continuar con el servicio",
			"displaybarra": ['none'],
			"displaysBotones": ['none', 'none', 'inline', 'inline'],
			"text": ['', '', 'Cancelar', 'Aceptar'],
			"onClick": ["", "", "cerrarPopAutenticacion()", "permitirPolizaForanea()"]

		};
		genericPop(popup);
  }
  function cerrarPopAutenticacion(){
  	//limpiarGruaForm();
  	closePops();

  }
  function permitirPolizaForanea(){
  	var Usuario = $('#Usuario').val();
  	var ClaveEspecial = $('#UsuarioClaveEspecial').val();
  	var autenticacion = autenticacionEspecial(Usuario, ClaveEspecial);

  	if(autenticacion.MensajeError == ''){
  		if(autenticacion.AutorizarServicios != "1"){
  			closePops();
  			var popup = {
  				"popup": "popupError",
  				"imagen": "Error",
  				"mensaje": "No tiene los privilegios suficientes para realizar esta modificación",
  				"displaybarra": ['none'],
  				"displaysBotones": ['none', 'none', 'none', 'inline'],
  				"text": ['', '', '', 'Aceptar'],
  				"onClick": ["", "", "", "closePops()"]

  			};
  			genericPop(popup);
  		}else{
        $('#IdServicioTipo').val(3);
        $('#IdPoliza').val(null);
        $('#Nombres').prop('readonly', false);
        $('#Apellidos').prop('readonly', false);
        $('#Celular').prop('readonly', false);
        $('#IdMarca').prop('disabled', false);
        $('#Modelo').prop('readonly', false);
        $('#Color').prop('readonly', false);
        $('#IdSeguro').prop('disabled', false);
        GuardarAutomaticoServicio();
        GuardarAutomaticoServicioCliente();
        var parametros_servicio = {
          "IdServicio" : $("#IdServicio").val()
        }
        var DatosServicio = AjaxCall("servicios/clienteapp/datosServicio.php", parametros_servicio, agregarSuccess, MensajeError);

        $("#CodigoServicio").val(DatosServicio.CodigoServicio);
        $("#Inicio").val(DatosServicio.Inicio);
  		}
  	}else{
  		//limpiarGruaForm();
  	}
}
function EnviarServicio(){
var parametros_servicio = {
      "IdServicio": $("#IdServicio").val(),
      "TipoEnvio" : "Masivo",
      "LatitudOrigen": $("#LatitudOrigen").val(),
      "LongitudOrigen": $("#LongitudOrigen").val(),
      "IdEstadoOrigen": $('#IdEstadoOrigen').val(),
      //"IdGrua": 1,
      "notification": {
        "body" : "¡Nuevo servicio de Grúa!",
        "title" : "TU/GRUERO®",
        "sound" : "default",
      }
};
  var EnvioServicio = AjaxCall("servicios/clienteapp/sendPush.php", parametros_servicio,agregarSuccess,MensajeError);


}
function CambiarAgendado(e){

  if ($(e).is(':checked')) {
    $("#Agendado").val(1);
    $(".Agendado").show();
  }else{
    $("#Agendado").val(0);
    $(".Agendado").hide();
    $("#FechaAgendado").val("");
    $("#HoraAgendado").val("");
  }
  GuardarAutomaticoServicio();
}
function ConsultarBaremo(){
  var parametros_servicio = convertiraAJson(DataForm);
  var DatosServicio = AjaxCall("servicios/clienteapp/Baremo.php", parametros_servicio,agregarSuccess,MensajeError);
  $("#PrecioSIvaBaremo").val(DatosServicio.Baremo.PrecioSIvaBaremo);
  $("#IvaBaremo").val(DatosServicio.Baremo.IvaBaremo);
  $("#PrecioCIvaBaremo").val(DatosServicio.Baremo.PrecioCIvaBaremo);
}
function CambiarNegociar(e){

  if ($(e).is(':checked')) {
    $("#Agendado").val(1);
    $(".Agendado").show();
  }else{
    $("#Agendado").val(0);
    $(".Agendado").hide();
    $("#FechaAgendado").val("");
    $("#HoraAgendado").val("");
  }
  GuardarAutomaticoServicio();
}
function BusquedaGrueroMapa(){
  $.ajax({
    url: link_servidor + "/adm/Mapas/index.php?action=mapa_grueros",
    success: function(html){
      $('#popupMapa .modal-body').html(html);
      $('#popupMapa').modal('show');
    }
  });
}
function BusquedaGrueroLista(){
  $.ajax({
    url: link_servidor + "/adm/Listas/index.php?action=lista_gruas&opcion=1",
    success: function(html){
      $('#popupListas .modal-body').html(html);
      $('#popupListas').modal('show');
    }
  });
}
function SeleccionarGruaLista(IdGrua){
  DatosGrua(IdGrua);
  $("#IdGrua").val(IdGrua);
  closePops();
}
function SeleccionarGruaMapa(IdGrua){
  DatosGrua(IdGrua);
  $("#IdGrua").val(IdGrua);
  stopInterval();
  closePops();
}
function DatosGrua(IdGrua){
  var parametros = {
    IdGrua: IdGrua
  };
  var Datos = AjaxCall("servicios/clienteapp/datosGrua.php", parametros);
  $("#NombresGrua").val(Datos.Nombres + ' ' + Datos.Apellidos);
  $("#NombreGruasTipo").val(Datos.NombreGruasTipo);
}
function FinalizarServicio(){
  if(!confirm("¿Está seguro(a) de finalizar el servicio" + $("#CodigoServicio").val() +"?")){
    return false;
  }else{
    return false;
  }
}
function actualizarServiciosEstatusClienteGruero(){
  var parametros = {
    "IdServicio": $("#IdServicio").val(),
    "IdEstatus" : 4,
    "IdUsuario" : $("#IdUsuario").val(),
    "Fecha": $("#FechaGrueroCliente").val(),
    "Hora": $("#HoraGrueroCliente").val(),


  }

  if ($('#EstatusGrueroCliente').is(':checked')) {
    var actualizarServicioEstatus = AjaxCall("servicios/clienteapp/actualizarServiciosEstatus.php", parametros);
  }else{
    var eliminarServicioEstatus = AjaxCall("servicios/clienteapp/eliminarServiciosEstatus.php", parametros);
  }


}
function actualizarServiciosEstatusLlegada(){
  var parametros = {
    "IdServicio": $("#IdServicio").val(),
    "IdEstatus" : 5,
    "IdUsuario" : $("#IdUsuario").val(),
    "Fecha": $("#FechaLlegada").val(),
    "Hora": $("#HoraLlegada").val(),


  }
  if ($('#EstatusLlegada').is(':checked')) {
    var actualizarServicioEstatus = AjaxCall("servicios/clienteapp/actualizarServiciosEstatus.php", parametros);
  }else{
    var eliminarServicioEstatus = AjaxCall("servicios/clienteapp/eliminarServiciosEstatus.php", parametros);
  }

}
