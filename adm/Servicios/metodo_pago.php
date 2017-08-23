<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingFive">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        Método de pago
      </a>
    </h4>
  </div>
  <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
    <div class="panel-body">
      <div class="" id="DivMetodoPago">
        <div class="row">
          <div class="col-sm-12">
                <label class="radio-inline">
                    <input type="radio" name="IdMetodoPago" id="" class="SaveAutomaticoServicioPrecio" value="1"> Bancos
                </label>
                <label class="radio-inline">
                  <input type="radio" name="IdMetodoPago" class="SaveAutomaticoServicioPrecio" value="2"> TDC
                </label>
                <label class="radio-inline">
                    <input type="radio" name="IdMetodoPago" class="SaveAutomaticoServicioPrecio" value="3" disabled="disabled"> Asegurado
                </label>
          </div>
        </div>
        <div class="row" id="DivBancos">
            <div class="col-sm-4">
              <div class="form-group">
                <label> Bancos</label>
                <select class="form-control SaveAutomaticoServicioPrecio input-sm" id="IdBanco" name="IdBanco" style="width: 100%;"></select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Referencia</label>
                    <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="Referencia" name="Referencia" type="text" placeholder=""  autocomplete="off">
              </div>
            </div>
        </div>
        <div class="row" id="DivTDC">
            <div class="col-sm-4">
              <div class="form-group">
                <label></label>
                <select class="form-control input-sm" id="" name="" style="width: 100%;">
                    <option>Link</option> 
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Referencia</label>
                    <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="Referencia" name="Referencia" type="text" placeholder=""  autocomplete="off">
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
