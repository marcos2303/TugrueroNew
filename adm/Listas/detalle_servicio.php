<input type="text" id="IdServicio" value="<?php echo $values["IdServicio"]?>">
<h1 class="text-center">Servicio</h1>
<div class="panel-group" id="accordion_servicios" role="tablist" aria-multiselectable="true">
  <div class="panel panel-tugruero">
    <div class="panel-heading" role="tab" id="headingServiciosOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion_servicios" href="#collapseServiciosOne" aria-expanded="true" aria-controls="collapseServiciosOne">
          Servicio
        </a>
      </h4>
    </div>
    <div id="collapseServiciosOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingServiciosOne">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-2">
            <label class="">Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-md-2">
            <label>Aplicación </label><p id="NombreAplicacion"></p>
          </div>
          <div class="col-md-2">
            <label>NombreServicioTipo</label><p id="NombreServicioTipo"></p>
          </div>
          <div class="col-md-2">
            <label>NombreEstatus </label><p id="NombreEstatus"></p>
          </div>
          <div class="col-md-2">
            <label>Agendado </label><p id="Agendado"></p>
          </div>
          <div class="col-md-2">
            <label>FechaAgendado </label><p id="FechaAgendado"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label>NombreUsuarioServicio </label><p id="NombreUsuarioServicio"></p>
          </div>
          <div class="col-md-2">
            <label>NombreAveria </label><p id="NombreAveria"></p>
          </div>
          <div class="col-md-2">
            <label>AveriaDetalle </label><p id="AveriaDetalle"></p>
          </div>
          <div class="col-md-2">
            <label>NombreCondicionLugar </label><p id="NombreCondicionLugar"></p>
          </div>
          <div class="col-md-2">
            <label>CondicionDetalle </label><p id="CondicionDetalle"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-tugruero">
    <div class="panel-heading" role="tab" id="headingServiciosTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_servicios" href="#collapseServiciosTwo" aria-expanded="false" aria-controls="collapseServiciosTwo">
          Cliente
        </a>
      </h4>
    </div>
    <div id="collapseServiciosTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingServiciosTwo">
      <div class="panel-body">
		 <div class="row">
          <div class="col-md-3">
            <label>NombreSeguro </label><p id="NombreSeguro"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>CedulaCliente </label><p id="CedulaCliente"></p>
          </div>
          <div class="col-md-3">
            <label>ApellidosCliente</label><p id="ApellidosCliente"></p>
          </div>
          <div class="col-md-3">
            <label>NombresCliente </label><p id="NombresCliente"></p>
          </div>
          <div class="col-md-3">
            <label>CelularCliente </label><p id="CelularCliente"></p>
          </div>
		</div>
		 <div class="row">
          <div class="col-md-3">
            <label>PlacaCliente</label><p id="PlacaCliente"></p>
          </div>
          <div class="col-md-3">
            <label>NombreMarcaCliente </label><p id="NombreMarcaCliente"></p>
          </div>
          <div class="col-md-3">
            <label>ModeloCliente </label><p id="ModeloCliente"></p>
          </div>			 
          <div class="col-md-3">
            <label>ColorCliente </label><p id="ColorCliente"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-tugruero">
    <div class="panel-heading" role="tab" id="headingServiciosThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_servicios" href="#collapseServiciosThree" aria-expanded="false" aria-controls="collapseServiciosThree">
          Gruero
        </a>
      </h4>
    </div>
    <div id="collapseServiciosThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingServiciosThree">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-2">
            <label>IdentificacionProveedor </label><p id="IdentificacionProveedor"></p>
          </div>
          <div class="col-md-2">
            <label>Nombres proveedor </label><p id="NombresProveedor"></p>
          </div>
          <div class="col-md-2">
            <label>Apellidos proveedor </label><p id="ApellidosProveedor"></p>
          </div>
		</div>
		<div class="row"> 
          <div class="col-md-2">
            <label>CedulaGruas </label><p id="CedulaGruas"></p>
          </div>
          <div class="col-md-2">
            <label>NombresGruas </label><p id="NombresGruas"></p>
          </div>
          <div class="col-md-2">
            <label>ApellidosGruas </label><p id="ApellidosGruas"></p>
          </div>
          <div class="col-md-2">
            <label>CelularGruas </label><p id="CelularGruas"></p>
          </div>
          <div class="col-md-2">
            <label>PlacaGrua </label><p id="PlacaGrua"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label>ServicioGeneral </label><p id="ServicioGeneral"></p>
          </div>
          <div class="col-md-2">
            <label>TratoCordial </label><p id="TratoCordial"></p>
          </div>
          <div class="col-md-2">
            <label>TratoVehiculo </label><p id="TratoVehiculo"></p>
          </div>
          <div class="col-md-2">
            <label>Presencia </label><p id="Presencia"></p>
          </div>
          <div class="col-md-4">
			  <label>Recomienda </label><p id="Recomienda"><i class="fa fa-star"></i></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-tugruero">
    <div class="panel-heading" role="tab" id="headingServiciosFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_servicios" href="#collapseServiciosFour" aria-expanded="false" aria-controls="collapseServiciosFour">
          Precios
        </a>
      </h4>
    </div>
    <div id="collapseServiciosFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingServiciosFour">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-2">
            <label>NombreMetodoPago </label><p id="NombreMetodoPago"></p>
          </div>
		</div>
		<div class="row">	
          <div class="col-md-4">
            <label>NombreBanco </label><p id="NombreBanco"></p>
          </div>
          <div class="col-md-4">
            <label>Referencia </label><p id="Referencia"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label>NombreTipoPagoElectronico </label><p id="NombreTipoPagoElectronico"></p>
          </div>
          <div class="col-md-2">
            <label>NombreTipoPagoElectronico </label><p id="NombreTipoPagoElectronico"></p>
          </div>
		</div>
        <div class="row">
          <div class="col-md-2">
            <label>Link </label><p id="Link"></p>
          </div>
          <div class="col-md-2">
            <label>NumeroDocumento </label><p id="NombreTipoPagoElectronico"></p>
          </div>
          <div class="col-md-2">
            <label>TipoDocumento </label><p id="TipoDocumento"></p>
          </div>
          <div class="col-md-2">
            <label>NumeroDocumento </label><p id="NombreTipoPagoElectronico"></p>
          </div>
		</div>
        <div class="row">
          <div class="col-md-4">
            <label>PrecioSIvaBaremo </label><p id="PrecioSIvaBaremo"></p>
          </div>
          <div class="col-md-4">
            <label>IvaBaremo </label><p id="IvaBaremo"></p>
          </div>
          <div class="col-md-4">
            <label>PrecioCIvaBaremo </label><p id="PrecioCIvaBaremo"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>PrecioSIvaBaremoModificado </label><p id="PrecioSIvaBaremoModificado"></p>
          </div>
          <div class="col-md-4">
            <label>IvaBaremoModificado </label><p id="IvaBaremoModificado"></p>
          </div>
          <div class="col-md-4">
            <label>PrecioCIvaBaremoModificado </label><p id="PrecioCIvaBaremoModificado"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>PrecioClienteSIva </label><p id="PrecioClienteSIva"></p>
          </div>
          <div class="col-md-4">
            <label>IvaCliente </label><p id="IvaCliente"></p>
          </div>
          <div class="col-md-4">
            <label>PrecioClienteCIva </label><p id="PrecioClienteCIva"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
	
$(document).ready(function(){
	$.ajax({		
		url: link_servidor + "/adm/Listas/index.php?action=detalle_servicio_json&IdServicio=" + $("#IdServicio").val(),
		success: function(data){
			$.each(data, function(i, item) {

			  $("#" + i).html(item);
			  
						if(($("#" + i).attr('id')=="ServicioGeneral" || 
							  $("#" + i).attr('id')=="TratoCordial" || 
							  $("#" + i).attr('id')=="TratoVehiculo" || 
							  $("#" + i).attr('id')=="Presencia") 
							  && (parseInt(item) > 0) 
						) 
						{
						  creaEstrellas($("#" + i).attr('id'),item);
					    } 
						if($("#" + i).attr('id')=="Recomienda"){
							 siNo($("#" + i).attr('id'),item);
						}
			});
		},
	  dataType: "json"
	});
	
});

</script>
