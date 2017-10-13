  var datos = {};
  listaSeguros();
  listaServiciosTiposEstadistica();
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
     if($(this).attr('id') == "activaAgendado"){
        if ($(this).is(':checked')) {
            $("#Agendado").attr("disabled",false);
        }else{
            $("#Agendado").attr("disabled","disabled");
            delete datos[$("#activaAgendado").attr("id")];
            delete datos[$("#Agendado").attr("id")];
        }        
    }
  });
  
  $(".DatosEstadistica").change(function(){
        
        //datos[$(this).attr("id" )] = $(this).val();
        console.log(datos);
  });
  $("#btnResumenGeneral").click(function(){
        if ( $.fn.DataTable.isDataTable( '#tbl' ) ) {
         // $('#tbl').destroy();
        }
        $("#ResumenLLamadas").find("tbody tr").remove();
      $(".NoBd").html(0);
      $(".Bd").html(0);
      var DataForm = $('#DataForm  .DatosEstadistica').serializeArray();
      var parametros = convertiraAJson(DataForm);
      var datos = AjaxCall("servicios/adminapp/resumen_general.php", parametros, null,null);
        $.each(datos.countbd, function(field, value) {
            $("#Bd" + field).html(value);
        });
        $.each(datos.countbd_agendados, function(field, value) {
            $("#BdAgendado" + field).html(value);
        });
        $.each(datos.countnobd, function(field, value) {
            $("#NoBd" + field).html(value);
        });
        $.each(datos.countnobd_agendados, function(field, value) {
            $("#NoBdAgendado" + field).html(value);
        });
        
        columnArray = [];
        var data = []; 
        $.each(datos.datos_generales, function(field, value) {
                console.log(value);
                data.push(value);
        });
        $.each(datos.datos_generales[0], function(field, value) {
            if(!parseInt(field)){
               
                var put = {
                    "title" : field 
                };   
            
                columnArray.push(put);
            }
        });
        delete columnArray[0];
        //console.log(data);
        
        $('#tbl').DataTable( {
            "sDom": 'trp',
            "destroy": true,
            data: data,
            columns: [
                    {
                   "title" : "IdServicio"
                    },
                    {
                   "title" : "Codigo"
                    },                    {
                   "title" : "Aplicación"
                    },                    {
                   "title" : "Tipo servicio"
                    },                    {
                   "title" : "Estatus"
                    },                    {
                   "title" : "Agendado"
                    },                    {
                   "title" : "FechaAgendado"
                    },                    {
                   "title" : "Inicio"
                    },                    {
                   "title" : "Fin"
                    }
   
                   
            ]
        });
        
        llenarLLamadasParticulares(datos.datos_llamadas_particular);
        llenarLLamadasSeguros(datos.datos_llamadas_seguros);
      
      $("#DivResumenGeneral").show();
  });
});//end document ready

function llenarLLamadasParticulares(datos){
        $.each(datos, function(field, value) {
            $( "#ResumenLLamadasTbody" ).append( "<tr><td>" + value.Nombre + "</td><td>" + value.Cuenta + "</td></tr>" );
        });
}
function llenarLLamadasSeguros(datos){
        $.each(datos, function(field, value) {
            $( "#ResumenLLamadasTbody" ).append( "<tr><td>" + value.Nombre + "</td><td>" + value.Cuenta + "</td></tr>" );
        });
}



