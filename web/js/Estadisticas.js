  listaSeguros();
  listaServiciosTipos();
  listaEstatusFinales();
$(document).ready(function(){



  $('#IdServicioTipo').append('<option value="Todos">Todos</option>');
  //$("#IdSeguro option").eq(-1).before("<option>hi</option")
  $('#IdSeguro').append('<option value="Todos">Todos</option>');
  $('#IdEstatusFinal').append('<option value="Todos">Todos</option>');


  $(".activaInputs").change(function(){
    if($(this).attr('name') == "activaIdServicioTipo"){
        if ($(this).is(':checked')) {
            $("#IdServicioTipo").attr("disabled",false);
        }else{
            $("#IdServicioTipo").attr("disabled","disabled");
        }        
    }
    if($(this).attr('name') == "activaIdSeguro"){
        if ($(this).is(':checked')) {
            $("#IdSeguro").attr("disabled",false);
        }else{
            $("#IdSeguro").attr("disabled","disabled");
        }        
    }
    if($(this).attr('name') == "activaFechasRango"){
        if ($(this).is(':checked')) {
          $("#FechaDesde").prop("readonly",false);
          $("#FechaHasta").prop("readonly",false);
          if ($("#activaFechasRango").is(':checked')) {
                $("#activaFechaEspecifica").prop("checked",false);
                $("#FechaEspecifica").prop("readonly","readonly");
                $("#FechaEspecifica").val(null);

          }
        }else{
          $("#FechaDesde").prop("readonly","readonly");
          $("#FechaHasta").prop("readonly","readonly");
          $("#FechaDesde").val(null);
          $("#FechaHasta").val(null);
        }  
          

          //$("#FechaEspecifica").val(null);

    }
    if($(this).attr('name') == "activaFechaEspecifica"){

        
        if ($(this).is(':checked')) {
          $("#FechaEspecifica").prop("readonly",false);
          if ($("#activaFechasRango").is(':checked')) {
                $("#activaFechasRango").prop("checked",false);
                $("#FechaDesde").prop("readonly","readonly");
                $("#FechaHasta").prop("readonly","readonly");
                $("#FechaDesde").val(null);
                $("#FechaHasta").val(null);
          }     

        }else{
          $("#FechaEspecifica").prop("readonly","readonly");
          $("#FechaEspecifica").val(null);
        }  
          
 
    }
    if($(this).attr('name') == "activaIdEstatusFinal"){
        if ($(this).is(':checked')) {
            $("#IdEstatusFinal").attr("disabled",false);
        }else{
            $("#IdEstatusFinal").attr("disabled","disabled");
        }        
    }
    if($(this).attr('name') == "activaBaseDatos"){
        if ($(this).is(':checked')) {
            $("#BaseDatos").attr("disabled",false);
        }else{
            $("#BaseDatos  ").attr("disabled","disabled");
        }        
    }
  });
});//end document ready

