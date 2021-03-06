var Servidor = "http://localhost/";
var Proyecto = "TugrueroNew/";
var link_servidor = Servidor + Proyecto;
Cargando("");

$(window).on('load', function(){
    closePops();
});
function Cargando(mensaje){
var popup = {
			"popup": "popupCargando",
			"imagen": "Loader",
			"mensaje": mensaje,
			"displaybarra": ['none'],
			"displaysBotones": ['none', 'none', 'none', 'none'],
			"text": ['', '', '', ''],
			"onClick": ["", "", "", ""]

		};
		genericPop(popup);
}
function listaProveedoresTipo(IdProveedorTipo){
  //$('#IdProveedorTipo').find('option').remove().end().append('<option value="">Seleccione...</option>');
  $('#IdProveedorTipo').find('option').remove().end();
  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaProveedoresTipo.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdProveedorTipo) != 'undefined'){
        if(parseInt(IdProveedorTipo) === parseInt(item.IdProveedorTipo)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdProveedorTipo").append('<option value="'+ item.IdProveedorTipo +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaEstados(IdEstado){
  $('#IdEstado').find('option').remove().end();
  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaEstados.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdEstado) != 'undefined'){
        if(parseInt(IdEstado) === parseInt(item.IdEstado)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdEstado").append('<option value="'+ item.IdEstado +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaEstadosOrigen(IdEstado){
  $('#IdEstadoOrigen').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdEstadoOrigen').find('option').remove().end();

  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaEstados.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdEstado) != 'undefined'){
        if(parseInt(IdEstado) === parseInt(item.IdEstado)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdEstadoOrigen").append('<option value="'+ item.IdEstado +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaEstadosDestino(IdEstado){
  $('#IdEstadoDestino').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdEstadoDestino').find('option').remove().end();
  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaEstados.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdEstado) != 'undefined'){
        if(parseInt(IdEstado) === parseInt(item.IdEstado)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdEstadoDestino").append('<option value="'+ item.IdEstado +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaGruasTipos(IdGruaTipo){
  $('#IdGruaTipo').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdGruaTipo').find('option').remove().end();

  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaGruasTipos.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdGruaTipo) != 'undefined'){
        if(parseInt(IdGruaTipo) === parseInt(item.IdGruaTipo)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdGruaTipo").append('<option value="'+ item.IdGruaTipo +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaMarcas(IdMarca){
  $('#IdMarca').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdMarca').find('option').remove().end();

  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaMarcas.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdMarca) != 'undefined'){
        if(parseInt(IdMarca) === parseInt(item.IdMarca)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdMarca").append('<option value="'+ item.IdMarca +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaSeguros(IdSeguro){
  $('#IdSeguro').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdSeguro').find('option').remove().end();
  var selected = "";
  var jqxhr = $.get( link_servidor + "/servicios/adminapp/listaSeguros.php", function(datos) {
  })
  .done(function(datos) {
    $.each(datos.data, function(i, item) {
      selected = "";
      if(typeof(IdSeguro) != 'undefined'){
        if(parseInt(IdSeguro) === parseInt(item.IdSeguro)){
          selected = 'selected = "selected"';
        }
      }
      $("#IdSeguro").append('<option value="'+ item.IdSeguro +'" '+selected+'>' + item.Nombre + '</option>');
    });
  })
  .fail(function() {
    alert( "error" );
  });
}
function listaAverias(IdAveria){
  $('#IdAveria').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdAveria').find('option').remove().end();

  var selected = "";
  var parametros = {
    "IdAveriaPadre": "0"
  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaAverias.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdAveria) != 'undefined'){
          if(parseInt(IdAveria) === parseInt(item.IdAveria)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdAveria").append('<option value="'+ item.IdAveria +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaAveriasHijo(IdAveria,IdAveriaPadre){
  $('#IdAveriaHijo').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdAveriaHijo').find('option').remove().end();

  var selected = "";
  var parametros = {
    "IdAveriaPadre": IdAveriaPadre
  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaAverias.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdAveria) != 'undefined'){
          if(parseInt(IdAveria) === parseInt(item.IdAveria)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdAveriaHijo").append('<option value="'+ item.IdAveria +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;

}
function listaCondicionLugar(IdCondicionLugar){
  $('#IdCondicionLugar').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdCondicionLugar').find('option').remove().end();

  var selected = "";
  var parametros = {

  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaCondicionLugar.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdCondicionLugar) != 'undefined'){
          if(parseInt(IdCondicionLugar) === parseInt(item.IdCondicionLugar)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdCondicionLugar").append('<option value="'+ item.IdCondicionLugar +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaBancos(IdBanco){
  $('#IdBanco').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdBanco').find('option').remove().end();

  var selected = "";
  var parametros = {

  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaBancos.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdBanco) != 'undefined'){
          if(parseInt(IdBanco) === parseInt(item.IdBanco)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdBanco").append('<option value="'+ item.IdBanco +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaServiciosTipos(IdServicioTipo){
  $('#IdServicioTipo').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdServicioTipo').find('option').remove().end();

  var selected = "";
  var parametros = {

  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaServiciosTipos.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdServicioTipo) != 'undefined'){
          if(parseInt(IdServicioTipo) === parseInt(item.IdServicioTipo)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdServicioTipo").append('<option value="'+ item.IdServicioTipo +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaServiciosTiposEstadistica(IdServicioTipo){
  $('#IdServicioTipo').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdServicioTipo').find('option').remove().end();

  var selected = "";
  var parametros = {

  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaServiciosTiposEstadistica.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdServicioTipo) != 'undefined'){
          if(parseInt(IdServicioTipo) === parseInt(item.IdServicioTipo)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdServicioTipo").append('<option value="'+ item.IdServicioTipo +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaEstatusFinales(IdEstatusFinal){
  $('#IdEstatusFinal').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdServicioTipo').find('option').remove().end();

  var selected = "";
  var parametros = {

  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaEstatusFinales.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {
      $.each(datos.data, function(i, item) {
        selected = "";
        if(typeof(IdEstatusFinal) != 'undefined'){
          if(parseInt(IdEstatusFinal) === parseInt(item.IdEstatus)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdEstatusFinal").append('<option value="'+ item.IdEstatus +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaTiposPagosElectronicos(IdTipoPagoElectronico){
  $('#IdTipoPagoElectronico').find('option').remove().end().append('<option value="0">Seleccione...</option>');
  //$('#IdTipoPagoElectronico').find('option').remove().end();
  var selected = "";
  var parametros = {

  };
  var jqxhr = $.ajax({
    url:  link_servidor + "/servicios/adminapp/listaTiposPagosElectronicos.php",
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(datos) {

      $.each(datos.data, function(i, item) {
        selected = "";

        if(typeof(IdTipoPagoElectronico) != 'undefined'){
          if(parseInt(IdTipoPagoElectronico) === parseInt(item.IdTipoPagoElectronico)){
            selected = 'selected = "selected"';
          }
        }
        $("#IdTipoPagoElectronico").append('<option value="'+ item.IdTipoPagoElectronico +'" '+selected+'>' + item.Nombre + '</option>');
      });
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        console.log("error");
      }
    }

  }).responseJSON;
}
function listaAnios(Anio){
  $('#Anio').find('option').remove().end().append('<option value="">Seleccione...</option>');
  var selected = "";
  var fecha_actual = new Date();
  var anio = fecha_actual.getFullYear();
  var anio_inicio = (parseInt(anio) - 50);
  //console.log(anio);
  for(i = anio; i>=anio_inicio;i--){
    selected = "";
    if(typeof(Anio) != 'undefined'){
      if(parseInt(Anio) === parseInt(i)){
        selected = 'selected = "selected"';
      }
    }
    $("#Anio").append('<option value="'+ i +'" '+selected+'>' + i + '</option>');
  }
}
function listaAnios(Anio){
  $('#Anio').find('option').remove().end().append('<option value="">Seleccione...</option>');
  var selected = "";
  var fecha_actual = new Date();
  var anio = fecha_actual.getFullYear();
  var anio_inicio = (parseInt(anio) - 50);
  //console.log(anio);
  for(i = anio; i>=anio_inicio;i--){
    selected = "";
    if(typeof(Anio) != 'undefined'){
      if(parseInt(Anio) === parseInt(i)){
        selected = 'selected = "selected"';
      }
    }
    $("#Anio").append('<option value="'+ i +'" '+selected+'>' + i + '</option>');
  }
}
function listaAnioTarjeta(AnioTarjeta){
  $('#AnioTarjeta').find('option').remove().end().append('<option value="">Seleccione...</option>');
  var selected = "";
  var fecha_actual = new Date();
  var anio = fecha_actual.getFullYear();
  var anio_inicio = (parseInt(anio) + 10);
  //console.log(anio);
  for(i = anio; i<=anio_inicio;i++){
    selected = "";
    if(typeof(Anio) != 'undefined'){
      if(parseInt(AnioTarjeta) === parseInt(i)){
        selected = 'selected = "selected"';
      }
    }
    $("#AnioTarjeta").append('<option value="'+ i +'" '+selected+'>' + i + '</option>');
  }
}
function DetalleServicio(IdServicio){
		$.ajax({
			url: link_servidor + "adm/Listas/index.php?action=detalle_servicio&IdServicio="+ IdServicio,
			success: function(html){
				$('#popupListas .modal-body').html(html);
				$('#popupListas').modal('show');
			}
		});
}
function ReiniciarDatosDispositivo(IdGrua){

        var parametros = {
		"IdGrua": IdGrua,
                "Disponible": 0,
                "Token": 0,
                "DeviceId": 0,
                "Latitud" : 0,
                "Longitud" : 0,
                "IdEstado" : 0,
                "Cedula" : "---",
                "Nombres" : "---",
                "Apellidos" : "---",
                "Celular" : "---",
	};
	var respuesta = AjaxCall("servicios/grueroapp/actualizarDatosGrua.php", parametros, actualizarSuccess, MensajeError);
}

function convertiraAJson(DataForm){
  var parametros = {};

  $.each(DataForm,function(i, v) {
    parametros[v.name] = v.value;
  });
  return parametros;
}
function convertiraAInputs(DataJson){

  $.each(DataJson,function(i, v) {
    $("#" + i).val(v);
  });
  return DataJson;
}
function AjaxCall(URL, parametros, exito, fallo, extra) {

  var data;

  var jqxhr = $.ajax({
    url:  link_servidor + URL,
    type: "POST",
    data: JSON.stringify(parametros),
    dataType: "json",
    timeout: 20000,
    global: false,
    async:false,
    success: function(data) {
      if(data.Error == "1"){
        if(fallo === undefined || fallo =="" || fallo == null){

        }else{
          MensajeErrorJson(data);
        }

      }else{
        if (exito === undefined || exito =="" || exito == null ) {

        }else{
          exito(data,extra);
        }


      }
      return data;
    },
    error: function(jqXHR, textStatus) {
      if (textStatus !== "abort") {
        fallo(jqXHR);
      }
    }

  }).responseJSON;

  return jqxhr;

}
function agregarSuccess(data, extra){
  var parametros = {
    "popup": "popupSuccess",
    "imagen": "Check",
    "mensaje": "<h4>Guardado satisfactoriamente.</h4>",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };

  if(data.MensajeError !=''){
    parametros.mensaje = data.MensajeError;
    genericPop(parametros);
  }
  if(data.Agregado =="1"){
    genericPop(parametros);
  }

}

function actualizarSuccess(data, extra){
  var parametros = {
    "popup": "popupSuccess",
    "imagen": "Check",
    "mensaje": "<h4>Actualizado satisfactoriamente.</h4>",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  if(data.MensajeError !=''){
    parametros.mensaje = data.MensajeError;
    genericPop(parametros);
  }
  if(data.Actualizado =="1"){
    genericPop(parametros);
  }

}
function CargaSuccess(data, extra){
  var parametros = {
    "popup": "popupSuccess",
    "imagen": "Check",
    "mensaje": "<h4>Actualizado satisfactoriamente.</h4>",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  if(data.MensajeError !=''){
    parametros.mensaje = data.MensajeError;
    genericPop(parametros);
  }
}
function ServicioEnviado(data, extra){
  /*closePops();
  if(data.result != '' || data.result != null){
  var parametros = {
    "popup": "popupSuccess",
    "imagen": "Check",
    "mensaje": "<h4>Solicitud enviada satisfactoriamente. Recibido por: " + data.result.success + " Grueros </h4>",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
    genericPop(parametros);

  }*/

}
function MensajeError(jqXHR){
  var parametros = {
    "popup": "popupError",
    "imagen": "Error",
    "mensaje": "<h4>Se ha producido un error.</h4>",
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  genericPop(parametros);
}
function MensajeExtra(){

}

function MensajeErrorJson(data){
  var parametros = {
    "popup": "popupError",
    "imagen": "Error",
    "mensaje": "" + data.MensajeError,
    "displaybarra": ['none'],
    "displaysBotones": ['none', 'none', 'none', 'inline'],
    "text": ['', '', '', 'Aceptar'],
    "onClick": ["", "", "", "closePops()"]

  };
  if(data.MensajeError!=""){
    genericPop(parametros);
  }else{
      return false;
  }

}

function genericPop(parametros) {

  var pop = document.getElementById(parametros.popup); //Venatana padre


  var mensaje = pop.getElementsByTagName('p');
  var botones = pop.getElementsByTagName('button'); //[0]interno,[1]aceptar,[2]cancelar,[2]Conitnuar	var barra = pop.getElementsByClassName('progress');
  var barra = pop.getElementsByClassName('progress');
  barra[0].style.display = parametros.displaybarra;
  hideShow(botones, parametros);
  mensaje[0].innerHTML = parametros.mensaje;

  if (!$("#" + parametros.popup).hasClass('in')) {
    $("#" + parametros.popup).modal("show");
  }
  if(parametros.imagen !='none'){
    var imagen = pop.getElementsByTagName('img');
    imagen[0].src = link_servidor + "/web/img_admin/SVGs/" + parametros.imagen + ".svg";
    $(imagen[0]).css('width', '50%');
    $(imagen[0]).css('height', '50%');
    $(imagen[0]).css('min-width', '25%');
    $(imagen[0]).css('min-height', '25%');
  }


}

function closePops() {

  if ($("#popupSuccess").hasClass("in"))
  $("#popupSuccess").modal("hide");
  if ($("#popupError").hasClass("in"))
  $("#popupError").modal("hide");
  if ($("#popupCargando").hasClass("in"))
  $("#popupCargando").modal("hide");
  if ($("#popupAutenticacion").hasClass("in"))
  $("#popupAutenticacion").modal("hide");
  if ($("#popupListas").hasClass("in"))
  $("#popupListas").modal("hide");
  if ($("#popupMapa").hasClass("in"))
  $("#popupMapa").modal("hide");
}
function closePopsLista2() {


  if ($("#popupListas2").hasClass("in"))
  $("#popupListas2").modal("hide");
}
function hideShow(elementos, parametros) {

  for (var i = 0; i < elementos.length; i++) {
    elementos[i].style.display = parametros.displaysBotones[i];
    elementos[i].setAttribute('onClick', parametros.onClick[i]);
    elementos[i].innerHTML = parametros.text[i];
  }
}
function clearInputs(Form){

  $(':input','#' + Form).not(':button, :submit, :reset, :hidden').val('').removeAttr('checked').removeAttr('selected');
}
function autenticacionEspecial(Usuario, ClaveEspecial){
  closePops();
  var parametros = {
    Usuario: Usuario,
    ClaveEspecial: ClaveEspecial
  }
  var respuesta = AjaxCall("servicios/adminapp/autenticacionEspecial.php", parametros,null, MensajeError);
  $("#Usuario").val("");
  $("#UsuarioClaveEspecial").val("");
  return respuesta;
}
function creaEstrellas(elemento, estrellas){
	var html = "";
	for(i=0; i<estrellas; i++){
		html+= '<i class="fa fa-star"></i>';
	}
	$("#" + elemento).html(html);
}
function siNo(elemento, respuesta){
	var html = "";

            if(respuesta == 1){
                html = "Si";
            }
            else if(respuesta == 1){
                html = "No";
            }


	$("#" + elemento).html(html);
}
