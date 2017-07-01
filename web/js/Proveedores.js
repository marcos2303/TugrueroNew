$(document).ready(function(){
	var respuesta = {};
    if($('#action').val()=='new'){
			$("#DivBotones").hide();
		listaProveedoresTipo();
		listaEstados();
		listaGruasTipos();
                listaMarcas();
	}
	if($('#action').val()=='edit'){
		var parametros = {
			IdProveedor : $('#IdProveedor').val()
		};
		var datos = AjaxCall("servicios/adminapp/datosProveedor.php", parametros, CargaSuccess, MensajeError);
		convertiraAInputs(datos);
		if(datos.IdProveedorTipo != '') listaProveedoresTipo(datos.IdProveedorTipo);
		if(datos.IdEstado != '') listaEstados(datos.IdEstado);
		if(datos.IdGruaTipo != '') listaGruasTipos(datos.IdGruaTipo);
                if(datos.IdMarca != '') listaMarcas(datos.IdMarca);
	}
	/***************************************************/
    $('#EnviarProveedor').click(function(){
		var DataForm = $('#DataForm').serializeArray();

		var parametros = convertiraAJson(DataForm);
		if($("#IdProveedor").val()==''){
			var respuesta = AjaxCall("servicios/adminapp/agregarProveedor.php", parametros, agregarSuccess, MensajeError);
			$("#IdProveedor").val(respuesta.IdProveedor);
		}else{
			var respuesta = AjaxCall("servicios/adminapp/actualizarProveedor.php", parametros, actualizarSuccess, MensajeError);
		}
		$("#action").val("edit");
			$("#DivBotones").show();
    });
	/************************************************/


    $('#Verificar').click(function(){
        var DataFormGrua = $('#DataFormGrua').serializeArray();
	var parametros = convertiraAJson(DataFormGrua);
        parametros.IdProveedor = $('#IdProveedor').val();
	var respuesta = AjaxCall("servicios/adminapp/verificarPlaca.php", parametros, CargaSuccess, MensajeError);
        delete respuesta.IdProveedor;
        $("#IdGrua").val(respuesta.IdGrua);
                $("#DatosGrua").show();
		if(respuesta.MismoProveedor == "0"){
                    $("#Reasignar").show();
                    $("#EnviarGrua").hide();
		}else{
                    $("#EnviarGrua").show();
                    $("#Reasignar").hide();
                }
        if(respuesta.MensajeError == "" && respuesta.MismoProveedor == "0"){
            convertiraAInputs(respuesta);
            var popup = {
                    "popup": "popupAutenticacion",
                    "imagen": "none",
                    "mensaje": "",
                    "displaybarra": ['none'],
                    "displaysBotones": ['none', 'none', 'inline', 'inline'],
                    "text": ['', '', 'Cancelar', 'Aceptar'],
                    "onClick": ["", "", "closePops()", "reasignar()"]

            };
            genericPop(popup);

        }else{
            if(respuesta.MensajeError != ''){
                limpiarGruaForm();
            }else{
                convertiraAInputs(respuesta);
								if(respuesta.IdProveedorTipo != '') listaProveedoresTipo(respuesta.IdProveedorTipo);
								if(respuesta.IdEstado != '') listaEstados(respuesta.IdEstado);
								if(respuesta.IdGruaTipo != '') listaGruasTipos(respuesta.IdGruaTipo);
                if(respuesta.IdMarca != '') listaMarcas(respuesta.IdMarca);
            }

        }



    });
    $('#AgregarGrua').click(function(){
				if($("#action").val()!='new'){
					if($("#DivGruas").is(":visible") ){
	        }else{
	            $("#DivGruas").show();
	        }
				}

    });

    $('#EnviarGrua').click(function(){
		var DataForm = $('#DataFormGrua').serializeArray();

		var parametros = convertiraAJson(DataForm);
                parametros.IdProveedor = $("#IdProveedor").val();
		if($("#IdGrua").val()==''){
			var respuesta = AjaxCall("servicios/adminapp/agregarGrua.php", parametros, agregarSuccess,MensajeError);

		}else{
			var respuesta = AjaxCall("servicios/adminapp/actualizarGrua.php", parametros, actualizarSuccess,MensajeError);
		}
		$("#IdGrua").val("");
                $("#DatosGrua").hide();
                $("#Placa").val("");
                limpiarGruaForm();

    });
		$('#ListarGruas').click(function(){
			IdProveedor = $('#IdProveedor').val();
			$.ajax({
			  url: link_servidor + "adm/Listas/index.php?action=lista_gruas&IdProveedor="+ IdProveedor+"",
			  success: function(html){
						$('#popupListas .modal-body').html(html);
			   		$('#popupListas').modal('show');
				}
			});



    });

});
function reasignar(){
    var Usuario = $('#Usuario').val();
    var ClaveEspecial = $('#UsuarioClaveEspecial').val();
    var autenticacion = autenticacionEspecial(Usuario, ClaveEspecial);

    if(autenticacion.MensajeError == ''){
        if(autenticacion.AutorizarGruas != "1"){
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
              parametros = {
                IdGrua:  $("#IdGrua").val(),
                IdProveedor: $("#IdProveedor").val(),
              };
              respuesta = AjaxCall("servicios/adminapp/actualizarGrua.php", parametros, actualizarSuccess, MensajeError);
              $("#Reasignar").hide();
              $("#EnviarGrua").show();
        }
    }

}
function editarDatatable(Placa){

var parametros = {
	"Placa" : Placa
}
var respuesta = AjaxCall("servicios/adminapp/verificarPlaca.php", parametros, CargaSuccess, MensajeError);
}
function limpiarGruaForm(){
    $("#IdTipoGrua").removeAttr('selected');
    $('#IdTipoGrua').removeProp("selected");
    $("#IdMarca").removeAttr('selected');
    $("#Modelo").val("");
    $("#Color").val("");
    $("#Anio").removeAttr('selected');
    $("#Clave").val("");
}
