<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>
<div class="">
<h1 class="text-center">Estadísticas</h1>	
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Tipo de cliente</label>
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="1" name="activaIdServicioTipo" id="activaIdServicioTipo"  class="activaInputs DatosEstadistica">
					</span>
					<select class="form-control DatosEstadistica input-sm" id="IdServicioTipo" name="IdServicioTipo" style="width: 100%;" disabled="disabled"></select>
			
				</div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Seguro</label>
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="1" name="activaIdSeguro" id="activaIdSeguro"  class="activaInputs DatosEstadistica">
					</span>
					<select class="form-control DatosEstadistica input-sm" id="IdSeguro" name="IdSeguro" style="width: 100%;" disabled="disabled"></select>
			
				</div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Rango de fechas</label>   
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="activaFechasRango" id="activaFechasRango" value="1" class="activaInputs DatosEstadistica">
					</span>
					<input type="date" class="form-control input-sm DatosEstadistica" id="FechaDesde" readonly="readonly">
					<input type="date" class="form-control input-sm DatosEstadistica" id="FechaHasta" readonly="readonly">
				</div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Fecha específica</label>   
				<div class="input-group">
					<span class="input-group-addon">
					  <input type="checkbox" name="activaFechaEspecifica" id="activaFechaEspecifica" value="2" class="activaInputs DatosEstadistica">
					</span>
					<input type="date" class="form-control DatosEstadistica input-sm" id="FechaEspecifica" readonly="readonly">
				</div>
            </div>
		  </div>			
       
          <div class="col-sm-2">
            <div class="form-group">
              <label>Tipo de cliente</label> 
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="1" name="activaIdEstatusFinal" id="activaIdEstatusFinal" class="activaInputs DatosEstadistica">
					</span>
					<select class="form-control DatosEstadistica input-sm" name="IdEstatusFinal" id="IdEstatusFinal"  style="width: 100%;" disabled="disabled"></select>
				</div>
                
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Base de datos</label>
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="1" name="activaBaseDatos" id="activaBaseDatos"  class="activaInputs DatosEstadistica">
					</span>
					<select class="form-control DatosEstadistica input-sm" id="BaseDatos" name="BaseDatos" style="width: 100%;" disabled="disabled">
						<option value="0">Seleccione...</option>
						<option value="2">Si</option>
						<option value="1">No</option>
						<option value="3">Ambos</option>
					</select>				
				</div>
            </div>
          </div>
		</div>
		<div class="row">
          <div class="col-sm-4 col-sm-offset-5">
			  <button class="btn btn-success">Resumen General</button>
          </div>
		</div>


</div>

<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Estadisticas.js"></script>
