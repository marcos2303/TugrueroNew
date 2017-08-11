$(document).ready(function(){
    
    
	var respuesta = {};
	if($('#action').val()=='add'){
                $('input:radio[name="Estatus"][value="1"]').attr('checked',true);
		listaEstados();
		listaMarcas();
                listaSeguros();
                listaVehiculosTipos();
		listaAnios();    
	}
	if($('#action').val()=='update'){
		var parametros = {
			IdPoliza : $('#IdPoliza').val()
		};
		var datos = AjaxCall("servicios/adminapp/datosPoliza.php", parametros, CargaSuccess, MensajeError);
                if(datos.Estatus){
                    $('input:radio[name="Estatus"][value="'+ datos.Estatus +'"]').attr('checked',true);
                    $("#Estatus").val([datos.Estatus]);                    
                }

		convertiraAInputs(datos);
		if(datos.IdEstado != '') listaEstados(datos.IdEstado);
		if(datos.IdMarca != '') listaMarcas(datos.IdMarca);
                if(datos.IdSeguro != '') listaSeguros(datos.IdSeguro);
		if(datos.Anio != '') listaAnios(datos.Anio);
                if(datos.IdVehiculoTipo != '') listaVehiculosTipos(datos.IdVehiculoTipo);
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
                parametros.Estatus = $("input[name='Estatus']:checked").val()
		if($("#IdPoliza").val()==''){
			var respuesta = AjaxCall("servicios/adminapp/agregarPoliza.php", parametros, agregarSuccess, MensajeError);
			$("#IdPoliza").val(respuesta.IdPoliza);
		}else{
			var respuesta = AjaxCall("servicios/adminapp/actualizarPoliza.php", parametros, actualizarSuccess, MensajeError);
		}
		$("#action").val("update");


	}
});
