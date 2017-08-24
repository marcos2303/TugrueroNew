<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="docType">Tipo de documento</label> <label class="text-danger"> * </label>
				<select required  id="docType" data-checkout="docType"  data-checkout="docType" class="form-control input-sm">
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
			<label for="Apellidos">Número de documento</label> <label class="text-danger"> * </label> (12345678)
			<input required type="text" class="form-control input-sm" autocomplete="off" data-checkout="docNumber" id="docNumber" maxlength="8" value="" placeholder=""> 
		  </div>	
	</div>
	<div class="col-sm-4">
		  <div class="form-group">
				<label for="cardholderName">Titular</label> 
				<input type="text" required class="form-control input-sm" autocomplete="off" id="cardholderName" maxlength="50" data-checkout="cardholderName" maxlength="" value="" Placeholder="Ejemplo: JUAN A ALVAREZ C">
		  </div>	
	</div>	
</div>
<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="cardNumber">Número de tarjeta</label> <label class="text-danger"> * </label>
			<div class="">
				<input required type="text" class="form-control input-sm" autocomplete="off" data-checkout="cardNumber" id="cardNumber" maxlength="16" value=""  placeholder="">
			</div>
		  </div>

	</div>
	<div class="col-sm-4">
		  <div class="form-group">
			  <label for="securityCode" >Código de seguridad</label> <label class="text-danger"> * </label> 
			  <input required type="text" class="form-control input-sm" data-checkout="securityCode" autocomplete="off" id="securityCode" maxlength="3" value="" placeholder="">
		  </div>

	</div>	
</div>
<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="cardExpirationYear" >Año de vencimiento</label> <label class="text-danger"> * </label>
			<select required id="cardExpirationYear" data-checkout="cardExpirationYear" class="form-control input-sm"></select>
		  </div>

	</div>
	<div class="col-sm-4">
		  <div class="form-group">
			<label for="cardExpirationMonth" >Mes de vencimiento</label> <label class="text-danger"> * </label>
				<select required id="cardExpirationMonth" data-checkout="cardExpirationMonth" class="form-control input-sm">
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
<div class="row">
	<div class="col-sm-4">
		  <div class="form-group">
			<button class="btn btn-success" >Procesar Pago</button>      
		  </div>	

	</div>	
</div>
       