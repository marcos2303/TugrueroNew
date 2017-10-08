<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingSix">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
        Asignación de gruero
      </a>
    </h4>
  </div>
  <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
    <div class="panel-body">
      <div class="" id="DivAsignacionGruero">
        <input type="text" class="form-control SaveAutomaticoServicioGrua" name="IdGrua" id="IdGrua">
		<input type="text" class="form-control SaveAutomaticoServicioGrua" name="IdProveedor" id="IdProveedor">
		<input type="text" class="form-control SaveAutomaticoServicioGrua" name="Cedula" id="Cedula">

        <div class="row">
          <div class="col-lg-4 col-xs-4 col-xs-offset-4">
            <!-- small box -->
            <div class="small-box bg-tugruero">
              <div class="inner">
                  <div class="text-center">
                      <a href="#" class="btn btn-tugruero" onclick="BusquedaGrueroMapa();">Mapa</a>
                      <a href="#" class="btn btn-tugruero" onclick="BusquedaGrueroLista();">Lista</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label> Nombres</label>
              <input type="text" class="form-control input-sm SaveAutomaticoServicioGrua" id="Nombres" name="Nombres" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label> Apellidos</label>
              <input type="text" class="form-control input-sm SaveAutomaticoServicioGrua" id="Apellidos" name="Apellidos" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Tipo de grúa</label>
              <input class="form-control input-sm " id="NombreGruasTipo" name="NombreGruasTipo" type="text" autocomplete="off" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Celular</label>
              <input class="form-control input-sm SaveAutomaticoServicioGrua " name="Celular" id="Celular" type="text" placeholder="" autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
              <label> Fecha de asignación</label>
              <input type="date" class="form-control input-sm SaveAutomaticoServicioGrua" id="FechaAsignacion" name="FechaAsignacion" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Hora de asignación</label>
              <input class="form-control input-sm SaveAutomaticoServicioGrua" id="HoraAsignacion" name="HoraAsignacion" type="time" autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Hrs.Estimadas de espera</label>
              <input type="number" size="4" min="0" max="96" value="0" class="form-control input-sm SaveAutomaticoServicioGrua" onchange="calculaTiempoDeEspera();" id="HoraTiempoEstimadoEspera" name="HoraTiempoEstimadoEspera">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Min.Estimados de espera</label>
              <input type="number" size="4" min="0" max="59" value="0" class="form-control input-sm SaveAutomaticoServicioGrua" onchange="calculaTiempoDeEspera();" id="MinutosTiempoEstimadoEspera" name="MinutosTiempoEstimadoEspera">
              <input type="hidden" value="00:00" class="form-control input-sm SaveAutomaticoServicioGrua" id="TiempoEstimadoEspera" name="TiempoEstimadoEspera">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> F.Estimada de llegada</label>
              <input class="form-control input-sm SaveAutomaticoServicioGrua" id="FechaEstimadaLlegada" name="FechaEstimadaLlegada" type="date" autocomplete="off" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Hr.Estimada de llegada</label>
              <input class="form-control input-sm SaveAutomaticoServicioGrua" id="HoraEstimadaLlegada" name="HoraEstimadaLlegada" type="text" autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<a class="btn btn-success" onclick="EnviarServicio(2);"><i class="fa"></i> Enviar servicio a gruero seleccionado</a>
				
			</div>
			
		</div>
      </div>
    </div>
  </div>
</div>
