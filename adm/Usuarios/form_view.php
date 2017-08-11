<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<form action="" name="DataForm" id="DataForm">
	<input type="text" id="IdProveedor" name="IdUsuario" value="<?php if(isset($values['IdUsuario']) and $values['IdUsuario']!='') echo $values['IdUsuario'];?>">
	<input type="text" id="action" value="<?php echo $values['action'];?>">
	<h1 class="text-center">Cuenta</h1>
	<div class="box box-shadow">
		<div class="box-header with-border">
			<h2 class="box-title">Datos básicos</h2>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Nombres</label>
						<input class="form-control" id="Nombres" name="Nombres" type="text" placeholder="" required="required" autocomplete="off">

					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Apellidos <small class="text-muted"> (V-12345678) </small></label>
						<input class="form-control" id="Apellidos" name="Apellidos" type="text" placeholder="" required="required" autocomplete="off">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><small class="text-danger"> * </small> Celular</label>
						<input class="form-control" id="Nombres" name="Nombres" type="text" placeholder="" autocomplete="off">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" id="Email" name="Email" type="email" placeholder="" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="btn-group">
						<button type="submit" id="EnviarUsuario" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Usuarios.js"></script>
