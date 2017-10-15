$(document).ready(function(){
    Inicializa();
    if($("#action").val()=='new'){
        CrearServicio();//se crea el servicio
    }else{
        EditarDatosServicio();//se cargan los datos en los inputs
    }


  //activar el onchange de los campos
  $(".SaveAutomaticoServicio").change(function(){
    //console.log("SaveAutomaticoServicio");
    AccionesChange(this);
    GuardarAutomaticoServicio();
  });
  $(".SaveAutomaticoServicioCliente").change(function(){
    //console.log("SaveAutomaticoServicioCliente");
    AccionesChange(this);
    GuardarAutomaticoServicioCliente();
  });
  $(".SaveAutomaticoServicioGrua").change(function(){
    //console.log("SaveAutomaticoServicioGrua");
    AccionesChange(this);
    GuardarAutomaticoServicioGrua();
  });

  $(".SaveAutomaticoServicioPrecio").change(function(){
    //console.log("SaveAutomaticoServicioPrecio");
    AccionesChange(this);
    GuardarAutomaticoServicioPrecio();
  });


});//end document ready
function AccionesChange(e){
    //console.log("acciones change");
    if($(e).attr('name') == "IdMetodoPago"){
            if($(e).val()== 1){
                $("#DivBancos").show();
                $("#DivTDC").hide();
            }
            if($(e).val()== 2){
                $("#DivBancos").hide();
                $("#DivTDC").show();
            }
    }
    if($(e).attr('name') == "IdTipoPagoElectronico"){
            $("#MercadopagoDiv").hide();
            $("#MercadopagoLinkDiv").hide();
            if($(e).val()== 2){
                $("#MercadopagoDiv").show();
            }
            if($(e).val() == 1){
                $("#MercadopagoLinkDiv").show();
                CargarLinkMercadoPago();

            }
    }
    if($(e).attr('name') == "HoraTiempoEstimadoEspera" || $(e).attr('name') == "MinutosTiempoEstimadoEspera"){
            calculaTiempoDeEspera();
    }
    if($(e).attr('name') == "Cedula" || $(e).attr('name') == "Placa"){
      CargaHistorialServicios();
    }
    if($(e).attr('name') == "Cedula" || $(e).attr('name') == "Placa"){
      if($("#Cedula").val() != '' && $("#Placa").val() !=''){
          CargaHistorialServicios();
      }

    }
    if($(e).attr('name') == "IdAveria"){
        //console.log('averia');
      listaAveriasHijo($("#IdAveriaHijo").val(),$(e).val());
      if($('#IdAveria option:selected').val()==1 || $('#IdAveria option:selected').val()==4){
        $("#IdAveriaHijo").show();
        $("#IdAveriaHijo").css("display", "block");
      }else{
        $(".Averias").hide();
        $(".Averias").css("display", "hide");
      }
    }
    if($(e).attr('name') == "HoraTiempoEstimadoEspera" || $(e).attr('name') == "MinutosTiempoEstimadoEspera"){
        calculaTiempoDeEspera();
    }
    if($(e).attr('name') == "EstatusGrueroCliente"){
        actualizarServiciosEstatusClienteGruero();
    }
    if($(e).attr('name') == "EstatusLlegada"){
        actualizarServiciosEstatusLlegada();
    }
   if($(e).attr('name') == "Pagado"){
        if($(e).val()==1){
           BloqueaCamposPago();
        }

    }
    if($(e).attr('name') == "PrecioSIvaBaremoModificado"){
        var iva = calculaIva(9,parseInt($(e).val()));
        $("#IvaBaremoModificado").val(iva);
        var precioCIva = calculaPrecioCIva(9,parseInt($(e).val()));
        $("#PrecioCIvaBaremoModificado").val(precioCIva);
    }
    if($(e).attr('name') == "PrecioClienteSIva"){
        var iva = calculaIva(9,parseInt($(e).val()));
        $("#IvaCliente").val(iva);
        var precioCIva = calculaPrecioCIva(9,parseInt($(e).val()));
        $("#PrecioClienteCIva").val(precioCIva);
    }
}
function Inicializa(){
  $("#IdAveriaHijo").hide();
  $("#DivBancos").hide();
  $("#DivTDC").hide();
  $("#MercadopagoLinkDiv").hide();
  $("#MercadopagoDiv").hide();

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
    $('input[name=IdMetodoPago][value=3]').prop('checked', 'checked');
    $('input[name=IdMetodoPago][value=2]').prop('disabled', 'disabled');
    $('input[name=IdMetodoPago][value=1]').prop('disabled', 'disabled');

  }else if($("#IdServicioTipo").val()=="3"){

    $(".asegurado").show();
    $('#Nombres').prop('readonly', false);
    $('#Apellidos').prop('readonly', false);
    $('#Celular').prop('readonly', false);
    $('#IdMarca').prop('disabled', false);
    $('#Modelo').prop('readonly', false);
    $('#Color').prop('readonly', false);
    $('#IdSeguro').prop('disabled', false);
    $('input[name=IdMetodoPago][value=3]').prop('checked', 'checked');
    $('input[name=IdMetodoPago][value=2]').prop('disabled', 'disabled');
    $('input[name=IdMetodoPago][value=1]').prop('disabled', 'disabled');
  }else{

    $(".asegurado").hide();
  }
}
function CrearServicio(){
  listaMarcas();
  listaEstadosOrigen();
  listaEstadosDestino();
  listaSeguros();
  listaAverias();
  listaCondicionLugar();
  listaBancos();
  listaTiposPagosElectronicos();
  listaAnioTarjeta();
  var parametros_iniciales = {
    "IdServicioTipo" : $("#IdServicioTipo").val(),
    "IdAplicacion" : 3,
    "IdEstatus" : 1,
    "IdUsuario" : $("#IdUsuario").val(),
  };
  var RespuestaServicio = AjaxCall("servicios/clienteapp/agregarServicio.php", parametros_iniciales, agregarSuccess, MensajeError);
  $("#IdServicio").val(RespuestaServicio.IdServicio);
  $("#CodigoServicio").val(RespuestaServicio.CodigoServicio);
  $("#Inicio").val(RespuestaServicio.DatosServicio.Inicio);
}
function EditarDatosServicio(){
  var parametros_servicio = {
    "IdServicio" : $("#IdServicio").val()
  }
  var DatosServicio = AjaxCall("servicios/clienteapp/datosServicio.php", parametros_servicio, agregarSuccess, MensajeError);
  //console.log(DatosServicio);
    $.each(DatosServicio, function(index, item) {
        $("#" + index).val(item);


        //console.log( $("#" + index).prop("type"));
        if ($('input[name=' + index + ']').is(":radio")) {
            //console.log( index);
            $('input[name='+index+'][value='+item+']').prop('checked', 'checked');
            AccionesChange($('input[name='+index+'][value='+item+']'));
        }else{
            if(index == 'IdMarca') listaMarcas(item);
            if(index == 'IdEstadoOrigen') listaEstadosOrigen(item);
            if(index == 'IdEstadoDestino') listaEstadosDestino(item);
            if(index == 'IdSeguro') listaSeguros(item);
            if(index == 'IdAveria') listaAverias(item);
            if(index == 'IdCondicionLugar') listaCondicionLugar(item);
            if(index == 'IdBanco') listaBancos(item);
            if(index == 'IdTipoPagoElectronico'){
              listaTiposPagosElectronicos(item);

            }
            if(index == 'IdGrua') DatosGrua(item);
            if(index == 'AnioTarjeta') listaAnioTarjeta(item);
            if(index == 'Negociar' && item == 1){
                    $("#Negociar").val(1);
                    $(".Negociar").show();
                    $('#Negociar').prop('checked', 'checked');
            }
            AccionesChange($("#"+index));
        }



    });

    $.each(DatosServicio.Estatus, function(index, item) {
       if(item.IdEstatus == 4) {
           $("#EstatusGrueroCliente").prop("checked","checked");
           $("#FechaGrueroCliente").val(item.Fecha);
           $("#HoraGrueroCliente").val(item.Hora);
           AccionesChange($("#EstatusGrueroCliente"));
       }
       if(item.IdEstatus == 5) {
           $("#EstatusLlegada").prop("checked","checked");
           $("#FechaLlegada").val(item.Fecha);
           $("#HoraLlegada").val(item.Hora);
           AccionesChange($("#EstatusLlegada"));
       }

    });

    //cargo los marcadores en el mapa



}
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

 if($("#IdServicioTipo").val() == 1){
    $('#IdSeguro').prop('disabled', false);
    $('#IdMarca').prop('disabled', false);
 }


  var DataForm = $('#DataForm .SaveAutomaticoServicioCliente').serializeArray();
  //Servicios clientes

  //console.log(DataForm);
  /*if($('#IdSeguro').is(':disabled')){
      alert($('#IdSeguro option[disabled]:selected').val());
    var IdSeguro = {
      "name" :  "IdSeguro",
      "value" :  $('#IdSeguro option[disabled]:selected').val()

    };
  }*/

  var parametros_servicio_cliente = convertiraAJson(DataForm);
  //console.log(parametros_servicio_cliente);
  var actualizarServicio = AjaxCall("servicios/clienteapp/actualizarServicioCliente.php", parametros_servicio_cliente, agregarSuccess, MensajeError);
  var parametros_servicio = {
    "IdServicio" : $("#IdServicio").val()
  }
  var DatosServicio = AjaxCall("servicios/clienteapp/datosServicio.php", parametros_servicio, agregarSuccess, MensajeError);

 if($("#IdServicioTipo").val() == 1){
    $('#IdSeguro').prop('disabled', true);
    $('#IdMarca').prop('disabled', true);
 }

  $("#CodigoServicio").val(DatosServicio.CodigoServicio);
  $("#Inicio").val(DatosServicio.Inicio);
}
function GuardarAutomaticoServicioGrua(){
  var DataForm = $('#DataForm .SaveAutomaticoServicioGrua').serializeArray();
  var parametros_servicio_grua = convertiraAJson(DataForm);
    var actualizarServicioGrua = AjaxCall("servicios/clienteapp/actualizarServicioGrua.php", parametros_servicio_grua, agregarSuccess, MensajeError);


}
function GuardarAutomaticoServicioPrecio(){
  var DataForm = $('#DataForm .SaveAutomaticoServicioPrecio').serializeArray();
  var parametros_servicio_precio = convertiraAJson(DataForm);
  //console.log(parametros_servicio_precio);;
    var actualizarServicioPrecio = AjaxCall("servicios/clienteapp/actualizarServicioPrecio.php", parametros_servicio_precio, agregarSuccess, MensajeError);
}
function GuardarServicioNegociar(valor){
  var DataForm = $('#DataForm .SaveAutomaticoServicioPrecio').serializeArray();
  var Negociar = {
    "name" :  "Negociar",
    "value" :  valor,

  };
  DataForm.push(Negociar);
  var parametros_servicio_precio = convertiraAJson(DataForm);



  //console.log(DataForm);

  //console.log(parametros_servicio_precio);;
    var actualizarServicioPrecio = AjaxCall("servicios/clienteapp/actualizarServicioPrecio.php", parametros_servicio_precio, agregarSuccess, MensajeError);
}
function CargaHistorialServicios(){
  var Cedula = $("#Cedula").val();
  var Placa = $("#Placa").val();
  $.ajax({
    url: link_servidor + "/adm/Listas/index.php?action=lista_servicios_corta",
    data: { Cedula: Cedula, Placa: Placa},
    success: function(html){

      $("#DivHistorialServicios").html(html);
      //$("#example").dataTable().fnAdjustColumnSizing();
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
    //console.log("poliza");
    if(datos_poliza.Estatus == 2){
        autenticacionPolizaVencida(datos_poliza);
        return false;
    }

    $('#IdServicioTipo').val(1);
    $("#IdPoliza").val(datos_poliza.IdPoliza);
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
    $('#Nombres').prop('readonly', true);
    $('#Apellidos').prop('readonly', true);
    $('#Celular').prop('readonly', true);
    $('#IdMarca').prop('disabled', true);
    $('#Modelo').prop('readonly', true);
    $('#Color').prop('readonly', true);
    $('#IdSeguro').prop('disabled', true);

    listaSeguros(datos_poliza.IdSeguro);
    listaMarcas(datos_poliza.IdMarca);
    GuardarAutomaticoServicio();
    GuardarAutomaticoServicioCliente();


  }else{
      autenticacionPolizaForanea();
  }
}
  function autenticacionPolizaVencida(datos_poliza){
    var popup = {
			"popup": "popupAutenticacion",
			"imagen": "none",
			"mensaje": "¿La póliza consultada se encuentra vencida, coloque credenciales para continuar con el servicio",
			"displaybarra": ['none'],
			"displaysBotones": ['none', 'none', 'inline', 'inline'],
			"text": ['', '', 'Cancelar', 'Aceptar'],
			"onClick": ["", "", "cerrarPopAutenticacion()", "permitirPolizaVencida("+ datos_poliza +")"]

		};
		genericPop(popup);
  }
    function permitirPolizaVencida(datos_poliza){
       console.log(datos_poliza);
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
                    //console.log("aqui");
    $('#IdServicioTipo').val(1);
    $("#IdPoliza").val(datos_poliza.IdPoliza);
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
    $('#Nombres').prop('readonly', true);
    $('#Apellidos').prop('readonly', true);
    $('#Celular').prop('readonly', true);
    $('#IdMarca').prop('disabled', true);
    $('#Modelo').prop('readonly', true);
    $('#Color').prop('readonly', true);
    $('#IdSeguro').prop('disabled', true);
        listaMarcas();
        listaSeguros();
        GuardarAutomaticoServicio();
        GuardarAutomaticoServicioCliente();
        var parametros_servicio = {
          "IdServicio" : $("#IdServicio").val()
        }
        var DatosServicio = AjaxCall("servicios/clienteapp/datosServicio.php", parametros_servicio, agregarSuccess, MensajeError);

        $("#CodigoServicio").val(DatosServicio.CodigoServicio);
        $("#Inicio").val(DatosServicio.Inicio);

   }
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
                    //console.log("aqui");
        $('#IdServicioTipo').val(3);
        $('#IdPoliza').val(0);
        $('#Nombres').prop('readonly', false);
        $('#Apellidos').prop('readonly', false);
        $('#Celular').prop('readonly', false);
        $('#IdMarca').prop('disabled', false);
        $('#IdMarca').removeAttr("disabled");
        $('#Modelo').prop('readonly', false);
        $('#Color').prop('readonly', false);
        $('#IdSeguro').prop('disabled', false);
        $('#IdSeguro').removeAttr("disabled");
        $('#DesdeVigencia').val("");
        $('#Vencimiento').val("");
        listaMarcas();
        listaSeguros();
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
  function autenticacionCambiarPrecios(){
        $(".Negociar").hide();
        $("#Negociar").val(0);
        $('#Negociar').prop('checked', false);
    var popup = {
			"popup": "popupAutenticacion",
			"imagen": "none",
			"mensaje": "¿Está seguro(a) de cambiar los precios?",
			"displaybarra": ['none'],
			"displaysBotones": ['none', 'none', 'inline', 'inline'],
			"text": ['', '', 'Cancelar', 'Aceptar'],
			"onClick": ["", "", "cerrarPopAutenticacion()", "permitirCambioPrecio()"]

		};
		genericPop(popup);
  }

  function permitirCambioPrecio(){
  	var Usuario = $('#Usuario').val();
  	var ClaveEspecial = $('#UsuarioClaveEspecial').val();
  	var autenticacion = autenticacionEspecial(Usuario, ClaveEspecial);


  	if(autenticacion.MensajeError == ''){
  		if(autenticacion.AutorizarPagos != "1"){
                    $(".Negociar").hide();
                    $("#Negociar").val(0);
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
                    //console.log("Mostrar");
                    $(".Negociar").show();
                    $("#Negociar").val(1);
                    $('#Negociar').prop('checked', 'checked');
                    $("#PrecioSIvaBaremoModificado").val( $("#PrecioSIvaBaremo").val() );
                    $("#PrecioCIvaBaremoModificado").val( $("#PrecioCIvaBaremo").val() );
                    $("#IvaBaremoModificado").val( $("#IvaBaremo").val() );
                    GuardarServicioNegociar(1);
                }
  	}else{
            //console.log("Ocultar");
  		//limpiarGruaForm();
  	}
}
  function cerrarPopAutenticacion(){
  	//limpiarGruaForm();
  	closePops();

  }
function EnviarServicio(tipo){

if(tipo == 2){//directo a gruero
    if($("#IdGrua").val() == ""){
  			var popup = {
  				"popup": "popupError",
  				"imagen": "Error",
  				"mensaje": "No se ha asignado gruero.",
  				"displaybarra": ['none'],
  				"displaysBotones": ['none', 'none', 'none', 'inline'],
  				"text": ['', '', '', 'Aceptar'],
  				"onClick": ["", "", "", "closePops()"]

  			};
  			genericPop(popup);
        return false;
    }

}

//Cargando("Enviando la solicitud. Espere un momento.");
extra = {
    Gruas : 0
};
var parametros_servicio = {
      "IdServicio": $("#IdServicio").val(),
      "TipoEnvio" : tipo,
      "IdEstatus" : $("#IdEstatus").val(),
      "IdAplicacion" : 3,
      "IdGrua" : $("#IdGrua").val(),
};

  var EnvioServicio = AjaxCall("servicios/adminapp/push.php", parametros_servicio);
  console.log(EnvioServicio);
  if(EnvioServicio.success == 0){
    var popup = {
      "popup": "popupError",
      "imagen": "Error",
      "mensaje": "No se encontraron grueros.",
      "displaybarra": ['none'],
      "displaysBotones": ['none', 'none', 'none', 'inline'],
      "text": ['', '', '', 'Aceptar'],
      "onClick": ["", "", "", "closePops()"]

    };
    genericPop(popup);
  }
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
    //console.log("baremo");
  var parametros_servicio = convertiraAJson(DataForm);
  var DatosServicio = AjaxCall("servicios/clienteapp/Baremo.php", parametros_servicio,agregarSuccess,MensajeError);
  $("#PrecioSIvaBaremo").val(DatosServicio.Baremo.PrecioSIvaBaremo);
  $("#IvaBaremo").val(DatosServicio.Baremo.IvaBaremo);
  $("#PrecioCIvaBaremo").val(DatosServicio.Baremo.PrecioCIvaBaremo);

  $("#PrecioClienteSIva").val(DatosServicio.Baremo.PrecioClienteSIva);
  $("#IvaCliente").val(DatosServicio.Baremo.IvaCliente);
  $("#PrecioClienteCIva").val(DatosServicio.Baremo.PrecioClienteCIva);
}
function CambiarNegociar(e){

  if ($(e).is(':checked')) {
    autenticacionCambiarPrecios();
  }else{
    $("#Negociar").val(0);
    $(".Negociar").hide();
    $("#PrecioSIvaBaremoModificado").val(0);
    $("#IvaBaremoModificado").val(0);
    $("#PrecioCIvaBaremoModificado").val(0);
    GuardarServicioNegociar(0);
  }

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
  $("#IdGrua.SaveAutomaticoServicioGrua").val(Datos.IdGrua);
  $("#Cedula.SaveAutomaticoServicioGrua").val(Datos.Cedula);
  $("#Nombres.SaveAutomaticoServicioGrua").val(Datos.Nombres);
  $("#Apellidos.SaveAutomaticoServicioGrua").val(Datos.Apellidos);
  $("#NombreGruasTipo").val(Datos.NombreGruasTipo);
  $("#Celular.SaveAutomaticoServicioGrua").val(Datos.Celular);
  $("#IdProveedor.SaveAutomaticoServicioGrua").val(Datos.IdProveedor);
  var fechahora = new Date();
  var minutos = fechahora.getMinutes();
  var hora = fechahora.getHours();
  var dia = fechahora.getDate();
  mes = fechahora.getMonth() + 1;
  anio= fechahora.getFullYear();


  if(minutos < 10){
    minutos = "0" + minutos;
  }
  if(hora < 10){
    hora = "0" + hora;
  }
  if(dia < 10){
    dia = "0" + dia;
  }

  var HoraAsignacion = String(hora+":"+minutos);
  var FechaAsignacion = String(anio+"-"  +mes+"-"+dia);
  $("#FechaAsignacion").val(FechaAsignacion);
  $("#HoraAsignacion").val(HoraAsignacion);

  calculaTiempoDeEspera();
  GuardarAutomaticoServicioGrua();

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
    $(".EstatusGrueroCliente").show();
    var actualizarServicioEstatus = AjaxCall("servicios/clienteapp/actualizarServiciosEstatus.php", parametros);
  }else{
    $(".EstatusGrueroCliente").hide();
    $("#HoraGrueroCliente").val();
    $("#FechaGrueroCliente").val();
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
    $(".EstatusLlegada").show();
    var actualizarServicioEstatus = AjaxCall("servicios/clienteapp/actualizarServiciosEstatus.php", parametros);
  }else{
    $(".EstatusLlegada").hide();
    $("#HoraLlegada").val();
    $("#FechaLlegada").val();
    var eliminarServicioEstatus = AjaxCall("servicios/clienteapp/eliminarServiciosEstatus.php", parametros);
  }

}
function CargarLinkMercadoPago(){
  var PrecioClienteCIva = $("#PrecioClienteCIva").val();
  //console.log($("#PrecioClienteCIva").val());
  $.ajax({
    url: link_servidor + "/adm/Listas/index.php?action=mercadopagolink&PrecioClienteCIva=" + PrecioClienteCIva,
    success: function(data){
      $("#Link").val(data.Link);
      GuardarAutomaticoServicioPrecio();
    },
    dataType: "json"
  });
}
function BloqueaCamposPago(){
    $(".BloqueoPagos").attr("disabled", "disabled");
    $(".BloqueoPagos").attr("readonly", "readonly");
    //console.log("Bloqueo");
}
function calculaTiempoDeEspera(){


  if($("#HoraAsignacion").val() == ''){
      return false;
  }
  var HoraAsignacion =$("#HoraAsignacion").val();
  HoraAsignacion = HoraAsignacion.split(":");
  hora = HoraAsignacion[0];
  minuto = HoraAsignacion[1];

  var horasumada = parseInt($("#HoraTiempoEstimadoEspera").val());
  var minutosumado = parseInt($("#MinutosTiempoEstimadoEspera").val());
  fecha=$("#FechaAsignacion").val();
  parametros=fecha.split("-");
  fecha = new Date(parametros[0] , parametros[1]-1 , parametros[2], hora , minuto);
  //console.log(fecha);
  fecha.setHours(horasumada + fecha.getHours());
  fecha.setMinutes(minutosumado + fecha.getMinutes());
  //console.log(fecha);

  minutos2 = fecha.getMinutes();
  hora2 = fecha.getHours();
  dia2 = fecha.getDate();
  mes2 = fecha.getMonth() + 1;
  anio2= fecha.getFullYear();

  //console.log("hora " + hora2);

  //console.log("minuto " + minutos2);


  if(mes2 <10){
    mes2 = "0" + mes2;
  }
  if(minutos2 <10){
    minutos2 = "0" + minutos2;
  }
  if(hora2 <10){
    hora2 = "0" + hora2;
  }
  if(dia2<10){
    dia2 = "0" + dia2;
  }

  var FechaEstimadaLlegada = String(anio2+"-"+mes2+"-"+dia2);
  var HoraEstimadaLlegada = String(hora2+":"+minutos2);
  $("#FechaEstimadaLlegada").val(FechaEstimadaLlegada);
  $("#HoraEstimadaLlegada").val(HoraEstimadaLlegada);
  if(horasumada <10){
      horasumada = "0" + horasumada;
  }
  if(minutosumado <10){
      minutosumado = "0" + minutosumado;
  }
  $("#TiempoEstimadoEspera").val(horasumada + ":" + minutosumado);
    //GuardarAutomaticoServicioGrua();
}
function mensajes(){
  $.ajax({
    url: link_servidor + "/adm/Listas/index.php?action=mensajes&IdServicio=" + $("#IdServicio").val(),
    success: function(html){
      $('#popupListas .modal-body').html(html);
      $('#popupListas').modal('show');
    }
  });
}
