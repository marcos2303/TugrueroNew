<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Modificación de Clave</h1>
	<div class="col-md-10 col-md-offset-1">
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input autocomplete="off" readonly="readonly" type="hidden" class="form-control input-sm" id="" placeholder="" name="id_user" value="<?php echo $_SESSION['id_user']?>">
	  <div class="form-group">
			<label for="">Clave actual</label>									
			<div class="input-group">
				<input type="password" maxlength="8" class="form-control input-sm" id="" placeholder="" name="password" required>
				<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>											
	  </div>
	  <div class="form-group">
			<label for="">Clave nueva (Mínimo 6 dígitos)</label>									
			<div class="input-group">
				<input type="password" maxlength="8" class="form-control input-sm" id="" placeholder="" name="new_password" required>
				<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>											
	  </div>
	  <div class="form-group">
			<label for="">Repetir clave nueva (Mínimo 6 dígitos)</label>									
			<div class="input-group">
				<input type="password" maxlength="8" class="form-control input-sm" id="" placeholder="" name="retype_password" required>
				<span class="input-group-addon" id="basic-addon2">(*)</span>
			</div>											
	  </div>

		<!--<a class="btn btn-default"  href="<?php echo full_url."/adm/index.php?action=bienvenida"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Cancelar</a>-->
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
		<script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>');
			$('#myModal').modal('show');	
			});

		
		</script>
    <?php endif;?>
    <?php if(isset($values['error']) and $values['error']!=''):?>
        <div class="alert alert-danger" role="alert"><?php echo $values['error'];?></div>
    <?php endif;?>
	</form>
		                    <div class="form-top-right">
											<h6 class="text-danger">(*) Campos obligatorios.</h6>
							</div>
	
	</div>
</div>
<?php include('../../view_footer.php')?>