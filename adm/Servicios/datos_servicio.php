<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingThree">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Datos servicio
      </a>
    </h4>
  </div>
  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
      <div class="" id="DivDatosServicio">
        <input type="hidden" class="SaveAutomaticoServicio" id="LatitudOrigen" name="LatitudOrigen" value="">
        <input type="hidden" class="SaveAutomaticoServicio" id="LongitudOrigen" name="LongitudOrigen" value="">
        <input type="hidden" class="SaveAutomaticoServicio" id="LatitudDestino" name="LatitudDestino" value="">
        <input type="hidden" class="SaveAutomaticoServicio" id="LongitudDestino" name="LongitudDestino" value="">
        <input type="hidden" class="SaveAutomaticoServicio" id="Agendado" name="Agendado" value="0">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="checkbox-inline">
                <input class="" onchange="CambiarAgendado(this);" type="checkbox" id="" name=""> Agendado
              </label>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <input type="date" class="form-control SaveAutomaticoServicio input-sm Agendado" style="display:none;" id="FechaAgendado" name="FechaAgendado" type="text" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <input type="time" class="form-control SaveAutomaticoServicio input-sm Agendado" style="display:none;" id="HoraAgendado" name="HoraAgendado" type="text" placeholder="" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-sm-12 text-center"><label class="">Origen</label></div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Estado</label>
              <select class="form-control SaveAutomaticoServicio input-sm " id="IdEstadoOrigen" name="IdEstadoOrigen" style="width: 100%;">
                  <option value="0">Seleccione...</option>
              </select>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Dir.Maps</label>
              <input class="form-control SaveAutomaticoServicio input-sm " id="DireccionOrigen" name="DireccionOrigen" type="text" placeholder=""  autocomplete="off">
            </div>
          </div>


          <div class="col-sm-4">
            <div class="form-group">
              <label> Dir.Detallada</label>
              <textarea class="form-control SaveAutomaticoServicio input-sm " name="DireccionOrigenDetallada" id="DireccionOrigenDetallada"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <hr>
          <div class="col-sm-12 text-center"><label class="">Destino</label></div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Estado</label>
              <select class="form-control SaveAutomaticoServicio input-sm " id="IdEstadoDestino" name="IdEstadoDestino" style="width: 100%;">
                  <option value="0">Seleccione...</option>              
              </select>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Dir.Maps</label>
              <input class="form-control SaveAutomaticoServicio input-sm " id="DireccionDestino" name="DireccionDestino" type="text" placeholder=""  autocomplete="off">
            </div>
          </div>


          <div class="col-sm-4">
            <div class="form-group">
              <label> Dir.Detallada</label>
              <textarea class="form-control SaveAutomaticoServicio input-sm " name="DireccionDestinoDetallada" id="DireccionDestinoDetallada"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label> KM</label>
              <input class="form-control SaveAutomaticoServicio input-sm " id="KM" name="KM" type="text" placeholder=""  autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row">
          <hr>
          <div class="col-sm-12"><label class="">¿Qué ocurre?</label></div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Averia</label>
              <select class="form-control SaveAutomaticoServicio input-sm " id="IdAveria" name="IdAveria" style="width: 100%;">
                  <option value="0">Seleccione...</option>                  
              </select>
            </div>
          </div>
          <div class="col-sm-4" class="Averias">
            <div class="form-group">
              <label> Otra/Cauchos</label>
              <select class="form-control SaveAutomaticoServicio Averias input-sm" id="IdAveriaHijo" name="IdAveriaHijo" style="width: 100%;"></select>

            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Detalle</label>
              <textarea class="form-control SaveAutomaticoServicio input-sm " id="AveriaDetalle" name="AveriaDetalle"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <hr>
          <div class="col-sm-12"><label class="">Detalles importantes</label></div>
        </div>
        <div class="row">
          <div class="col-sm-8">
            <div class="form-group">
              <label> Condición lugar</label>
              <select class="form-control SaveAutomaticoServicio input-sm " id="IdCondicionLugar" name="IdCondicionLugar" style="width: 100%;">
                  <option value="0">Seleccione...</option>                  
              </select>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Detalle</label>
              <textarea class="form-control SaveAutomaticoServicio input-sm " id="CondicionDetalle" name="CondicionDetalle" placeholder=""></textarea>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>Información extra</label>
					<textarea class="form-control SaveAutomaticoServicio input-sm " id="InfoExtra" name="InfoExtra" placeholder=""></textarea>
				</div>
			 </div>
			
		</div>
      </div>
    </div>
  </div>
</div>
