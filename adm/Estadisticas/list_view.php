<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>

    
<div class="">
<form id="DataForm" action="index.php" method="">
<input type="hidden" name="action" value="resumen_general">
<h1 class="text-center">Estadísticas</h1>	
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Tipo de cliente</label>
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="1" id="activaIdServicioTipo"  class="activaInputs">
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
						<input type="checkbox" value="1" id="activaIdSeguro"  class="activaInputs">
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
						<input type="checkbox" id="activaFechasRango" value="1" class="activaInputs">
					</span>
					<input type="date" class="form-control input-sm DatosEstadistica" name="FechaDesde" id="FechaDesde" disabled="disabled">
					<input type="date" class="form-control input-sm DatosEstadistica" name="FechaHasta" id="FechaHasta" disabled="disabled">
				</div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Fecha específica</label>   
				<div class="input-group">
					<span class="input-group-addon">
					  <input type="checkbox" id="activaFechaEspecifica" value="2" class="activaInputs">
					</span>
					<input type="date" class="form-control DatosEstadistica input-sm" name="FechaEspecifica" id="FechaEspecifica" disabled="disabled">
				</div>
            </div>
		  </div>			
       
          <div class="col-sm-2">
            <div class="form-group">
              <label>Estatus</label> 
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" value="1" id="activaIdEstatusFinal" class="activaInputs">
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
						<input type="checkbox" value="1" name="activaBaseDatos" id="activaBaseDatos"  class="activaInputs">
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

</form>
</div>      



<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Estadisticas.js"></script>
