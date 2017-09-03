<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingSeven">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
        Simulador
      </a>
    </h4>
  </div>
  <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
    <div class="panel-body">
      <div class="" id="DivAsignacionGruero">
         <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name ="EstatusGrueroCliente" id ="EstatusGrueroCliente" onchange="actualizarServiciosEstatusClienteGruero();"> Confirmación de llegada Gruero-Cliente
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 EstatusGrueroCliente" style="display:none;">
              <div class="form-group">
                <input type="date" class="form-control input-sm" id="FechaGrueroCliente" onchange="actualizarServiciosEstatusClienteGruero();" name="FechaGrueroCliente" type="text" autocomplete="off">
              </div>
            </div>
            <div class="col-sm-4 EstatusGrueroCliente" style="display:none;">
              <div class="form-group">
                <input type="time" class="form-control input-sm" id="HoraGrueroCliente" onchange="actualizarServiciosEstatusClienteGruero();" name="HoraGrueroCliente" type="text" autocomplete="off">
              </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id ="EstatusLlegada"  name ="EstatusLlegada" onchange="actualizarServiciosEstatusLlegada();"> Confirmación de llegada destino
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 EstatusLlegada" style="display:none;">
              <div class="form-group ">
				  <input type="date" class="form-control input-sm" id="FechaLlegada" name="FechaLlegada" onchange="actualizarServiciosEstatusLlegada();" type="text" autocomplete="off">
              </div>
            </div>
            <div class="col-sm-4 EstatusLlegada" style="display:none;">
              <div class="form-group">
                <input type="time" class="form-control input-sm" id="HoraLlegada" name="FechaLlegada" onchange="actualizarServiciosEstatusLlegada();" type="text" autocomplete="off">
              </div>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
