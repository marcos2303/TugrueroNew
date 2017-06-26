var Servidor = "http://localhost/";
var Proyecto = "TugrueroNew/";
var link_servidor = Servidor + Proyecto;
        
        
    function listaProveedoresTipo(IdProveedorTipo){
        
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
    function listaGruasTipos(IdGruaTipo){
        
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


    function AjaxCall(URL, parametros, exito, fallo, extra) {
            
            var data;
           
            var jqxhr = $.ajax({
                    url:  "http://localhost/TugrueroNew/" + URL,
                    type: "POST",
                    data: JSON.stringify(parametros),
                    dataType: "json",
                    timeout: 20000,
                    global: false,
                    async:false,
                    success: function(data) {
                        if(data.Error == "1"){
                            MensajeErrorJson(data);
                        }else{
                            if (extra === undefined) {
                                    exito(data);
                            } else {
                                    exito(data, extra);
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
    function MensajeSuccess(data, extra){
	var parametros = {
		"popup": "popupSuccess",
		"imagen": "Logon",
		"mensaje": "<h4>Guardado satisfactoriamente.</h4>",
		"displaybarra": ['none'],
		"displaysBotones": ['none', 'none', 'none', 'inline'],
		"text": ['', '', '', 'Aceptar'],
		"onClick": ["", "", "", "closePops()"]

	};
	genericPop(parametros);

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
	genericPop(parametros);
    }

    function genericPop(parametros) {

	var pop = document.getElementById(parametros.popup); //Venatana padre
	var imagen = pop.getElementsByTagName('img');
	imagen[0].src = link_servidor + "/web/img_admin/SVGs/" + parametros.imagen + ".svg";
	var mensaje = pop.getElementsByTagName('p');
	var botones = pop.getElementsByTagName('button'); //[0]interno,[1]aceptar,[2]cancelar,[2]Conitnuar	var barra = pop.getElementsByClassName('progress');
        var barra = pop.getElementsByClassName('progress');
        barra[0].style.display = parametros.displaybarra;
	hideShow(botones, parametros);
	mensaje[0].innerHTML = parametros.mensaje;

	if (!$("#" + parametros.popup).hasClass('in')) {
		$("#" + parametros.popup).modal("show");
	}
        
	$(imagen[0]).css('width', 'auto');
	$(imagen[0]).css('height', 'auto');
	$(imagen[0]).css('min-width', '100%');
	$(imagen[0]).css('min-height', '100%');

    }

    function closePops() {

	if ($("#popupSuccess").hasClass("in"))
		$("#popupSuccess").modal("hide");
	if ($("#popupError").hasClass("in"))
		$("#popupError").modal("hide");
	if ($("#popupCargando").hasClass("in"))
		$("#popupCargando").modal("hide");
    }
    function hideShow(elementos, parametros) {

            for (var i = 0; i < elementos.length; i++) {
                    elementos[i].style.display = parametros.displaysBotones[i];
                    elementos[i].setAttribute('onClick', parametros.onClick[i]);
                    elementos[i].innerHTML = parametros.text[i];
            }
    }
