$(document).ready(function(){
	var respuesta = {};
	if($('#action').val()=='update'){
		var parametros = {
			IdUsuario : $('#IdUsuario').val()
		};
		var datos = AjaxCall("servicios/adminapp/datosUsuario.php", parametros, CargaSuccess, MensajeError);
                if(datos.AutorizarServicios == 1){
                    $("#AutorizarServicios").attr("checked","checked");
                }
                if(datos.AutorizarPagos == 1){
                    $("#AutorizarPagos").attr("checked","checked");
                }
                if(datos.AutorizarGruas == 1){
                    $("#AutorizarGruas").attr("checked","checked");
                }
		convertiraAInputs(datos);
	}
        
	$('#DataForm').submit(function(event){
			if(!this.checkValidity()){

					event.preventDefault();
					$('#DataForm :input:visible[required="required"]').each(function()
					{
					    if(!this.validity.valid)
					    {
					        $(this).focus();
					        // break
					        return false;
					    }
					});
			}else{
					EnviarUsuario();
					return false;

			}
		return false;
	});

	function EnviarUsuario(){

		var DataForm = $('#DataForm .DatosUsuario').serializeArray();
		var parametros = convertiraAJson(DataForm);
		if($("#IdUsuario").val()==''){
			var respuesta = AjaxCall("servicios/adminapp/agregarUsuario.php", parametros, agregarSuccess, MensajeError);
			$("#IdUsuario").val(respuesta.IdUsuario);
		}else{
			var respuesta = AjaxCall("servicios/adminapp/actualizarUsuario.php", parametros, actualizarSuccess, MensajeError);
		}
		$("#action").val("update");


	}
});
