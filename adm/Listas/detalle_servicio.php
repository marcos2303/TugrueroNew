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
          <div class="col-sm-2">
            <label class="">Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Aplicación </label><p id="NombreAplicacion"></p>
          </div>
          <div class="col-sm-2">
            <label>NombreServicioTipo</label><p id="NombreServicioTipo"></p>
          </div>
          <div class="col-sm-2">
            <label>NombreEstatus </label><p id="NombreEstatus"></p>
          </div>
          <div class="col-sm-2">
            <label>Agendado </label><p id="Agendado"></p>
          </div>
          <div class="col-sm-2">
            <label>FechaAgendado </label><p id="FechaAgendado"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <label>NombreUsuarioServicio </label><p id="NombreUsuarioServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>NombreAveria </label><p id="NombreAveria"></p>
          </div>
          <div class="col-sm-2">
            <label>AveriaDetalle </label><p id="AveriaDetalle"></p>
          </div>
          <div class="col-sm-2">
            <label>NombreCondicionLugar </label><p id="NombreCondicionLugar"></p>
          </div>
          <div class="col-sm-2">
            <label>CondicionDetalle </label><p id="CondicionDetalle"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
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
          <div class="col-sm-3">
            <label>NombreSeguro </label><p id="NombreSeguro"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <label>CedulaCliente </label><p id="CedulaCliente"></p>
          </div>
          <div class="col-sm-3">
            <label>ApellidosCliente</label><p id="ApellidosCliente"></p>
          </div>
          <div class="col-sm-3">
            <label>NombresCliente </label><p id="NombresCliente"></p>
          </div>
          <div class="col-sm-3">
            <label>CelularCliente </label><p id="CelularCliente"></p>
          </div>
		</div>
		 <div class="row">
          <div class="col-sm-3">
            <label>PlacaCliente</label><p id="PlacaCliente"></p>
          </div>
          <div class="col-sm-3">
            <label>NombreMarcaCliente </label><p id="NombreMarcaCliente"></p>
          </div>
          <div class="col-sm-3">
            <label>ModeloCliente </label><p id="ModeloCliente"></p>
          </div>			 
          <div class="col-sm-3">
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
          <div class="col-sm-2">
            <label>NombresProveedor </label><p id="NombresProveedor"></p>
          </div>
          <div class="col-sm-2">
            <label>CedulaGruas </label><p id="CedulaGruas"></p>
          </div>
          <div class="col-sm-2">
            <label>NombresGruas </label><p id="NombresGruas"></p>
          </div>
          <div class="col-sm-2">
            <label>ApellidosGruas </label><p id="ApellidosGruas"></p>
          </div>
          <div class="col-sm-2">
            <label>CelularGruas </label><p id="CelularGruas"></p>
          </div>
          <div class="col-sm-2">
            <label>PlacaGrua </label><p id="PlacaGrua"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
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
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
          </div>
          <div class="col-sm-2">
            <label>Código servicio </label><p id="CodigoServicio"></p>
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

			});
		},
	  dataType: "json"
	});
	
});


</script>
