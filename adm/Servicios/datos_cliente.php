<div class="panel panel-tugruero">
  <div class="panel-heading" role="tab" id="headingOne">
    <h4 class="panel-title">
      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Datos cliente
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="" id="DivDatosPersonales">
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
              <label> Cédula/RIF</label>
              <input class="form-control input-sm SaveAutomaticoServicioCliente" id="Cedula" name="Cedula" type="text" placeholder="" required="required"  autocomplete="off">
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label>  Placa</label>
              <input class="form-control input-sm SaveAutomaticoServicioCliente" id="Placa" name="Placa" type="text" placeholder=""  autocomplete="off">

            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <button type="button" class=" btn btn-success asegurado" style="display:none;margin-top:20px;margin-left:-20px;" onclick="DatosPoliza();">Buscar</button>

            </div>
          </div>



        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label> Nombres</label>
              <input class="form-control SaveAutomaticoServicioCliente input-sm " id="Nombres" name="Nombres" type="text" placeholder="" required="required"  autocomplete="off">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Apellidos</label>
              <input class="form-control SaveAutomaticoServicioCliente input-sm " id="Apellidos" name="Apellidos" type="text" placeholder=""  autocomplete="off">
            </div>
          </div>


          <div class="col-sm-4">
            <div class="form-group">
              <label> Celular</label>
              <input class="form-control SaveAutomaticoServicioCliente input-sm " name="Celular" id="Celular" type="text" placeholder="" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>Marca</label>
              <select class="form-control SaveAutomaticoServicioCliente input-sm " id="IdMarca" name="IdMarca" style="width: 100%;" required="required"  autocomplete="off"></select>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Modelo</label>
              <input class="form-control SaveAutomaticoServicioCliente input-sm " name="Modelo" id="Modelo" type="text" placeholder=""  autocomplete="off">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Color</label>
              <input class="form-control SaveAutomaticoServicioCliente input-sm " name="Color" id="Color" type="text" placeholder=""  autocomplete="off">
            </div>
          </div>
        </div>
        <div class="asegurado"id="DivDatosPoliza" style="display:none">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label> Seguro</label>
                <select class="form-control SaveAutomaticoServicioCliente" id="IdSeguro" name="IdSeguro" style="width: 100%;"></select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label>Estatus</label>
                <input class="form-control input-sm " id="EstatusPoliza" name="EstatusPoliza" type="text" placeholder="" readonly="readonly">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label> Emisión</label>
                <input class="form-control input-sm " id="DesdeVigencia" name="DesdeVigencia" type="text" placeholder="" readonly="readonly">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label> Vencimiento</label>
                <input class="form-control input-sm " name="Vencimiento" id="Vencimiento" type="text" placeholder="" readonly="readonly">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label> Celular</label>
                <input class="form-control input-sm " name="CelularBD" id="CelularBD" type="text" placeholder="" readonly="readonly">
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <label> Domicilio</label>
                <input class="form-control input-sm " name="Domicilio" id="Domicilio" type="text" placeholder="" readonly="readonly">
              </div>
            </div>
          </div>

        </div>
      </div>



    </div>
  </div>
</div>
