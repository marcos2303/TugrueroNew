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
                    <input type="radio" name="IdMetodoPago" id="" class="SaveAutomaticoServicioPrecio MP" value="1"> Bancos
                </label>
                <label class="radio-inline">
                  <input type="radio" name="IdMetodoPago" class="SaveAutomaticoServicioPrecio MP" value="2"> TDC
                </label>
                <label class="radio-inline">
                    <input type="radio" name="IdMetodoPago" class="SaveAutomaticoServicioPrecio MP" value="3" disabled="disabled"> Asegurado
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
            <div class="col-sm-12">
              <div class="form-group">
                <label>Pago</label>
                <select class="form-control input-sm SaveAutomaticoServicioPrecio MP" id="IdTipoPagoElectronico" name="IdTipoPagoElectronico" style="width: 100%;"></select>
              </div>
            </div>
            <div class="panel-body" id="MercadopagoDiv">
				<div class="row">

					<div class="col-sm-4">
						  <div class="form-group">
							<label for="docType">Tipo de documento</label> <label class="text-danger"> * </label>
								<select required  id="TipoDocumento" data-checkout="docType" name="TipoDocumento"  data-checkout="docType" class="form-control input-sm SaveAutomaticoServicioPrecio MP">
									<option value="">Seleccione...</option>
									<option value="CI-V">CI-V</option>
									<option value="CI-E">CI-E</option>
									<option value="RIF-J">RIF-J</option>
									<option value="RIF-P">RIF-P</option>
									<option value="RIF-V">RIF-V</option>
									<option value="RIF-E">RIF-E</option>
									<option value="RIF-G">RIF-G</option>
									<option value="PASAPORTE">PASAPORTE</option>
								</select>    
						  </div>
					</div>
					<div class="col-sm-4">
						  <div class="form-group">
							<label for="docNumber">Número de documento</label> <label class="text-danger"> * </label> (12345678)
							<input required type="text" class="MP form-control input-sm SaveAutomaticoServicioPrecio" autocomplete="off" data-checkout="docNumber" name="NumeroDocumento" id="NumeroDocumento" maxlength="8" value="" placeholder=""> 
						  </div>	
					</div>
					<div class="col-sm-4">
						  <div class="form-group">
								<label for="cardholderName">Titular</label> 
								<input type="text" required class="MP form-control input-sm SaveAutomaticoServicioPrecio" autocomplete="off" id="NombreTarjeta" name="NombreTarjeta" maxlength="50" data-checkout="cardholderName" maxlength="" value="APRO" Placeholder="">
						  </div>	
					</div>	
				</div>
				<div class="row">
					<div class="col-sm-4">
						  <div class="form-group">
							<label for="cardNumber">Número de tarjeta</label> <label class="text-danger"> * </label>
							<div class="">
								<input required type="text" class="MP form-control input-sm SaveAutomaticoServicioPrecio" autocomplete="off" data-checkout="cardNumber" id="NumeroTarjeta" name="NumeroTarjeta" maxlength="16" value="4966382331109310"  placeholder="">
							</div>
						  </div>

					</div>
					<div class="col-sm-4">
						  <div class="form-group">
							  <label for="securityCode" >Código de seguridad</label> <label class="text-danger"> * </label> 
							  <input required type="text" class="MP form-control input-sm SaveAutomaticoServicioPrecio" data-checkout="securityCode" autocomplete="off" id="CodigoSeguridad" name="CodigoSeguridad" maxlength="3" value="" placeholder="">
						  </div>

					</div>	
				</div>
				<div class="row">
					<div class="col-sm-4">
						  <div class="form-group">
							<label for="AnioTarjeta" >Año de vencimiento</label> <label class="text-danger"> * </label>
							<select required id="AnioTarjeta" name="AnioTarjeta" data-checkout="cardExpirationYear" class="MP form-control input-sm SaveAutomaticoServicioPrecio"></select>
						  </div>

					</div>
					<div class="col-sm-4">
						  <div class="form-group">
							<label for="MesTarjeta" >Mes de vencimiento</label> <label class="text-danger"> * </label>
								<select required id="MesTarjeta" name="MesTarjeta" data-checkout="cardExpirationMonth" class="MP form-control input-sm SaveAutomaticoServicioPrecio">
									<option value="">Seleccione...</option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>
							</div>
					</div>
				</div>
				<div id="tipo_tarjeta">

				</div>
				<div class="row">
					<div class="col-sm-12" id="ErroresMP"></div>	
				</div>
				<div class="row">
					<div class="col-sm-12" id="SuccessMP"></div>	
				</div>
				<div class="row">
					<div class="col-sm-4">
						  <div class="form-group">
							  <button type="button" class="btn btn-success" id="Pagar" >Procesar Pago</button>      
						  </div>	

					</div>	
				</div>
			</div> 
			<div class="panel-body" id="MercadopagoLinkDiv">
				
				  <div class="form-group">
					<label> Link</label>
						<input class="form-control SaveAutomaticoServicioPrecio input-sm " id="Link" name="Link" type="text" placeholder=""  autocomplete="off">
				  </div>
				
			</div> 
        </div>
      </div>
    </div>
  </div>
</div>
