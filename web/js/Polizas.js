$(document).ready(function(){
    
		//datos personales
		$('#Letra').attr('required', 'required');
		$('#Cedula').attr('required', 'required');
		$('#Nombres').attr('required', 'required');	
		$('#Apellidos').attr('required', 'required');	
		//datos poliza
		$('#IdSeguro').attr('required', 'required');	
		$('#IdEstado').attr('required', 'required');	
		//datos vehiculo
		$('#Placa').attr('required', 'required');
		$('#Marca').attr('required', 'required');
		$('#Modelo').attr('required', 'required');	
		$('#Año').attr('required', 'required');	
		$('#Color').attr('required', 'required');	
		$('#Tipo').attr('required', 'required');	    
    
    
	var respuesta = {};
	if($('#action').val()=='add'){
		listaEstados();
		listaMarcas();
                listaSeguros();
		listaAnios();
	}
	if($('#action').val()=='update'){
		var parametros = {
			IdPoliza : $('#IdPoliza').val()
		};
		var datos = AjaxCall("servicios/adminapp/datosPoliza.php", parametros, CargaSuccess, MensajeError);
		convertiraAInputs(datos);
		if(datos.IdEstado != '') listaEstados(datos.IdEstado);
		if(datos.IdMarca != '') listaMarcas(datos.IdMarca);
                if(datos.IdSeguro != '') listaSeguros(datos.IdSeguro);
		if(datos.Anio != '') listaAnios(datos.Anio);
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
					EnviarPoliza();
					return false;

			}
		return false;
	});

	function EnviarPoliza(){

		var DataForm = $('#DataForm .DatosPoliza').serializeArray();
		var parametros = convertiraAJson(DataForm);
		if($("#IdPoliza").val()==''){
			var respuesta = AjaxCall("servicios/adminapp/agregarPoliza.php", parametros, agregarSuccess, MensajeError);
			$("#IdPoliza").val(respuesta.IdPoliza);
		}else{
			var respuesta = AjaxCall("servicios/adminapp/actualizarPoliza.php", parametros, actualizarSuccess, MensajeError);
		}
		$("#action").val("update");


	}
});
