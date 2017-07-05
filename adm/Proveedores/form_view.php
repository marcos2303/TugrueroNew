<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<form action="" name="DataForm" id="DataForm">
	<input type="hidden" id="IdProveedor" name="IdProveedor" value="<?php if(isset($values['IdProveedor']) and $values['IdProveedor']!='') echo $values['IdProveedor'];?>">
	<input type="hidden" id="action" value="<?php echo $values['action'];?>">
	<h1 class="text-center">Grueros</h1>
	<div class="box box-shadow">
		<div class="box-header with-border">
			<h2 class="box-title">Datos gruero</h2>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Empresa o independiente</label>
						<select class="form-control select2" id="IdProveedorTipo" name="IdProveedorTipo" style="width: 100%;" required="required">
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> CI o Rif <small class="text-muted"> (V-12345678) </small></label>
						<input class="form-control" id="Identificacion" name="Identificacion" type="text" placeholder="" required="required" pattern="^([VEJPG]{1})(-)([0-9]{5,9})$">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Nombres</label>
						<input class="form-control" id="Nombres" name="Nombres" type="text" placeholder="" required="required" pattern="^([a-zA-Z]{3,50})$">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Apellidos</label>
						<input class="form-control" id="Apellidos" name="Apellidos" type="text" placeholder="" pattern="^([a-zA-Z]{3,50})$">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Estado</label>
						<select class="form-control" id="IdEstado" name="IdEstado" style="width: 100%;" required="required">
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Ciudad</label>
						<input class="form-control" name="Ciudad" id="Ciudad" type="text" placeholder="" pattern="^([a-zA-Z]{3,50})$">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Zona</label>
						<input class="form-control" name="Zona" id="Zona" type="text" placeholder="" pattern="^([a-zA-Z0-9]{3,100})$">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Celular 1 <small class="text-muted"> (04261234567) </small></label>
						<input class="form-control" name="Celular1" id="Celular1" type="text" placeholder="" required="required" pattern="^([04]{2})([0-9]{2})([0-9]{7})$" maxlength="11">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Celular 2</label>
						<input class="form-control" name="Celular2" id="Celular2" type="text" placeholder="" pattern="^([04]{2})([0-9]{2})([0-9]{7})$" maxlength="11">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Celular 3</label>
						<input class="form-control" name="Celular3" id="Celular3" type="text" placeholder="" pattern="^([04]{2})([0-9]{2})([0-9]{7})$" maxlength="11">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Clave especial</label>
						<input class="form-control" name="ClaveEspecial" id="ClaveEspecial" type="text" placeholder="" maxlength="12">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="btn-group">
						<a class="btn btn-default" href="index.php" ><i class="fa fa-arrow-circle-left"></i> Regresar</a>
						<button type="submit" id="EnviarProveedor" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>
					</div>
				</div>
			</div>
			<div class="row" id="DivBotones" style="display:none;">
				<div class="col-sm-4 col-sm-offset-4 " >
					<div class="btn-group well well-sm">
						<button type="button" id="AgregarGrua" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Agregar grúas</button>
						<button type="button" id="ListarGruas" class="btn btn-default btn-md"><i class="fa fa-list"></i> Listado de grúas </button>
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-clock-o"></i> Historial de servicios</button>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
<div id="errores"></div>
<form action="" name="DataFormGrua" id="DataFormGrua" onsubmit="return false;">
	<input type="hidden" value="" name="IdGrua" Id="IdGrua">
	<div class="box box-shadow" id="DivGruas" style="display: none;">
		<div class="box-header with-border">
			<h2 class="box-title">Datos Grúas</h2>
		</div>
		<div class="box-body">

			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Placa</label>
						<div class="input-group">
							<input class="form-control" type="text" id="Placa" name="Placa" required="required" maxlength="6">
							<span class="input-group-btn">
								<button type="button" class="btn btn-success btn-flat" id="Verificar"><i class="fa fa-check-circle"></i> Verificar</button>
								<!--<button type="button" id="Reasignar" style="display:none;" class="btn btn-primary"></i> Reasignar</button> -->
							</span>
						</div>
					</div>
				</div>
			</div>
			<div id="DatosGrua" style="display: none;">
				<div class="row">
					<div class="col-sm-2">
						<div class="form-group">
							<label>Tipo de grúa</label>
							<select class="form-control" id="IdGruaTipo" name="IdGruaTipo" style="width: 100%;" required="required"></select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Marca</label>
							<select class="form-control" id="IdMarca" name="IdMarca" style="width: 100%;" required="required"></select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Modelo</label>
							<input class="form-control" type="text" id="Modelo" name="Modelo" required="required">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Año</label>
							<select class="form-control" style="width: 100%;" id="Anio" name="Anio" required="required">
								<option selected="selected" value="2017">2017</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Color</label>
							<input class="form-control" type="text" id="Color" name="Color" required="required">
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Clave</label>
							<input class="form-control" type="text" id="Clave" name="Clave" required="required">
						</div>
					</div>
					<div class="col-sm-1 col-sm-offset-11">
						<div class="form-group">
							<label>&nbsp;</label>

							<button type="submit" id="EnviarGrua" class="btn btn-primary form-control"><i class="fa fa-save"></i> Agregar/Actualizar</button>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</form>

<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Proveedores.js"></script>
