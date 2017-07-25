<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingEight">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
        Calificación
      </a>
    </h4>
  </div>
  <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
    <div class="panel-body">
      <div class="" id="DivAsignacionGruero">
        <input type="text" class="form-control SaveAutomaticoServicioCliente" name="IdGrua" id="IdGrua">
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
          <div class="col-sm-4">
            <div class="form-group">
              <label> Nombres y apellidos</label>
              <input type="text" class="form-control input-sm " id="NombresGrua" name="NombresGrua" readonly="readonly">
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
