<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingFour">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        Monto servicio
      </a>
    </h4>
  </div>
  <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
    <div class="panel-body">
      <div class="" id="DivDatosPrecio">
        <div class="row">
          <div class="col-sm-offset-8 col-sm-4">
            <div class="form-group">
              <label class="checkbox-inline">
				  <input class=""  type="checkbox" onchange="CambiarNegociar(this)" id="Negociar" name="Negociar"> A negociar
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago gruero(Baremo)</label>
              <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioSIvaBaremo" name="PrecioSIvaBaremo" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Iva(Baremo)</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaBaremo" name="IvaBaremo" type="text" autocomplete="off" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago total gruero(Baremo)</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioCIvaBaremo" id="PrecioCIvaBaremo" type="text" placeholder="" autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row Negociar" style="display:none;">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago gruero</label>
              <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioSIvaBaremoModificado" name="PrecioSIvaBaremoModificado">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Iva</label>
              <input class="form-control input-sm SaveAutomaticoServicioPrecio" id="IvaBaremoModificado" name="IvaBaremoModificado" type="text" autocomplete="off">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago total gruero</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioCIvaBaremoModificado" id="PrecioCIvaBaremoModificado" type="text" placeholder="" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago cliente</label>
              <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioClienteSIva" name="PrecioClienteSIva">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Iva</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaCliente" name="IvaCliente" type="text" autocomplete="off">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago total cliente</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioClienteCIva" id="PrecioClienteCIva" type="text" placeholder="" value="0.00" autocomplete="off">
            </div>
          </div>
        </div>
         <!--<div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago cliente</label>
              <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioClienteSIvaModificado" name="PrecioClienteSIvaModificado">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Iva</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaClienteModificado" name="IvaClienteModificado" type="text" autocomplete="off">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago total cliente</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioClienteCIvaModificado" id="PrecioClienteCIvaModificado" type="text" placeholder="" autocomplete="off">
            </div>
          </div>
        </div>-->
        <div class="row">
          <div class="col-sm-12 text-center">
            <div class="form-group">
                    
				<button type="button" class="btn btn-default" onclick="mensajes();">Mensajes</button>
                <button type="button" class="btn btn-success" onclick="EnviarServicio(1);">Enviar solicitud</button>
                <button type="button" class="btn btn-danger">Cancelar</button>
                           
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
