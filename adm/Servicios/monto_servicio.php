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
                <input class="" onchange="CambiarNegociar(this);" type="checkbox" id="" name=""> A negociar
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago gruero</label>
              <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioSIvaBaremo" name="PrecioSIvaBaremo" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Iva</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaBaremo" name="IvaBaremo" type="text" autocomplete="off" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago total gruero</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioCIvaBaremo" id="PrecioCIvaBaremo" type="text" placeholder="" autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row">
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
              <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioClienteSIva" name="PrecioClienteSIva" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Iva</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaCliente" name="IvaCliente" type="text" autocomplete="off" readonly="readonly">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label> Pago total cliente</label>
              <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioClienteCIva" id="PrecioClienteCIva" type="text" placeholder="" autocomplete="off" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row">
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
        </div>
      </div>
    </div>
  </div>
</div>
