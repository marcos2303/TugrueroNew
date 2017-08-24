  var datos = {};
  listaSeguros();
  listaServiciosTipos();
  listaEstatusFinales();
  
$(document).ready(function(){
  $('#IdServicioTipo').append('<option value="Todos">Todos</option>');
  //$("#IdSeguro option").eq(-1).before("<option>hi</option")
  $('#IdSeguro').append('<option value="Todos">Todos</option>');
  $('#IdEstatusFinal').append('<option value="Todos">Todos</option>');


  $(".activaInputs").change(function(){
    if($(this).attr('id') == "activaIdServicioTipo"){
        if ($(this).is(':checked')) {
            $("#IdServicioTipo").attr("disabled",false);
        }else{
            $("#IdServicioTipo").attr("disabled","disabled");
        }        
    }
    if($(this).attr('id') == "activaIdSeguro"){
        if ($(this).is(':checked')) {
            $("#IdSeguro").attr("disabled",false);
        }else{
            $("#IdSeguro").attr("disabled","disabled");
        }        
    }
    if($(this).attr('id') == "activaFechasRango"){
        if ($(this).is(':checked')) {
          $("#FechaDesde").prop("disabled",false);
          $("#FechaHasta").prop("disabled",false);
          if ($("#activaFechasRango").is(':checked')) {
                $("#activaFechaEspecifica").prop("checked",false);
                $("#FechaEspecifica").prop("disabled","disabled");
                $("#FechaEspecifica").val(null);

          }else{

          }
        }else{
          $("#FechaDesde").prop("disabled","disabled");
          $("#FechaHasta").prop("disabled","disabled");
          $("#FechaDesde").val(null);
          $("#FechaHasta").val(null);          
        }  

    }
    if($(this).attr('id') == "activaFechaEspecifica"){

        
        if ($(this).is(':checked')) {
          $("#FechaEspecifica").prop("disabled",false);
          if ($("#activaFechasRango").is(':checked')) {
                $("#activaFechasRango").prop("checked",false);
                $("#FechaDesde").prop("disabled","disabled");
                $("#FechaHasta").prop("disabled","disabled");
                $("#FechaDesde").val(null);
                $("#FechaHasta").val(null);
          }     

        }else{
          $("#FechaEspecifica").prop("disabled","disabled");
          $("#FechaEspecifica").val(null);
          delete datos[$("#activaFechaEspecifica").attr("id")];
          delete datos[$("#FechaEspecifica").attr("id")];
        }  
          
 
    }
    if($(this).attr('id') == "activaIdEstatusFinal"){
        if ($(this).is(':checked')) {
            $("#IdEstatusFinal").attr("disabled",false);
        }else{
            $("#IdEstatusFinal").attr("disabled","disabled");
            delete datos[$("#activaIdEstatusFinal").attr("id")];
            delete datos[$("#IdEstatusFinal").attr("id")];
        }        
    }
    if($(this).attr('id') == "activaBaseDatos"){
        if ($(this).is(':checked')) {
            $("#BaseDatos").attr("disabled",false);
        }else{
            $("#BaseDatos").attr("disabled","disabled");
            delete datos[$("#activaBaseDatos").attr("id")];
            delete datos[$("#BaseDatos").attr("id")];
        }        
    }
  });
  
  $(".DatosEstadistica").change(function(){
        
        //datos[$(this).attr("id" )] = $(this).val();
        console.log(datos);
  });
});//end document ready



