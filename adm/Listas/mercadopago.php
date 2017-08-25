<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="docType">Tipo de documento</label> <label class="text-danger"> * </label>
				<select required  id="TipoDocumento" data-checkout="docType"  data-checkout="docType" class="form-control input-sm SaveAutomaticoServicioPrecio">
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
			<input required type="text" class="MP form-control input-sm SaveAutomaticoServicioPrecio" autocomplete="off" data-checkout="docNumber" id="NumeroDocumento" maxlength="8" value="" placeholder=""> 
		  </div>	
	</div>
	<div class="col-sm-4">
		  <div class="form-group">
				<label for="cardholderName">Titular</label> 
				<input type="text" required class="MP form-control input-sm SaveAutomaticoServicioPrecio" autocomplete="off" id="NombreTarjeta" maxlength="50" data-checkout="cardholderName" maxlength="" value="APRO" Placeholder="">
		  </div>	
	</div>	
</div>
<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="cardNumber">Número de tarjeta</label> <label class="text-danger"> * </label>
			<div class="">
				<input required type="text" class="MP form-control input-sm SaveAutomaticoServicioPrecio" autocomplete="off" data-checkout="cardNumber" id="NumeroTarjeta" maxlength="16" value="4966382331109310"  placeholder="">
			</div>
		  </div>

	</div>
	<div class="col-sm-4">
		  <div class="form-group">
			  <label for="securityCode" >Código de seguridad</label> <label class="text-danger"> * </label> 
			  <input required type="text" class="MP form-control input-sm SaveAutomaticoServicioPrecio" data-checkout="securityCode" autocomplete="off" id="CodigoSeguridad" maxlength="3" value="" placeholder="">
		  </div>

	</div>	
</div>
<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="AnioTarjeta" >Año de vencimiento</label> <label class="text-danger"> * </label>
			<select required id="AnioTarjeta" data-checkout="cardExpirationYear" class="MP form-control input-sm SaveAutomaticoServicioPrecio"></select>
		  </div>

	</div>
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="MesTarjeta" >Mes de vencimiento</label> <label class="text-danger"> * </label>
				<select required id="MesTarjeta" data-checkout="cardExpirationMonth" class="MP form-control input-sm SaveAutomaticoServicioPrecio">
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
	<div class="col-sm-4">
		  <div class="form-group">
			<button class="btn btn-success" id="Pagar" >Procesar Pago</button>      
		  </div>	

	</div>	
</div>
<script src="<?php echo full_url;?>/web/js/mercadopago.js"></script>
<script>
    listaAnioTarjeta();
    initializeMP();
</script>
