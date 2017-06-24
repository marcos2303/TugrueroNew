<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Operadores</h1>
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		<label for="">Id.Usuario</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_user" value="<?php if(isset($values['id_user'])) echo $values['id_user']?>">
	  </div>
	  <div class="form-group">
		<label for="">Login</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="login" value="<?php if(isset($values['login'])) echo $values['login']?>">
		<?php if(isset($values['errors']['login']) and $values['errors']['login']!=''):?>
			<label class="alert alert-danger"><?php echo $values['errors']['login']?></label>
		<?php endif;?>
	  </div>
	  <div class="form-group">
		<label for="">Password</label>
		<input autocomplete="off" type="password" id="" class="form-control input-sm" name="password" value="<?php if(isset($values['password']) and $values['password']!='') echo $values['password']; ?>">
		<?php if(isset($values['errors']['password']) and $values['errors']['password']!=''):?>
			<label class="alert alert-danger"><?php echo $values['errors']['password']?></label>
		<?php endif;?>
	  </div>
	  <div class="form-group">
		<label for="">Teléfono de contacto</label>
		<input autocomplete="off" type="text" id="" readonly="readonly" class="form-control input-sm" name="phone1" value="<?php if(isset($values['phone1']) and $values['phone1']!='') echo $values['phone1']; ?>">
		<?php if(isset($values['errors']['phone1']) and $values['errors']['phone1']!=''):?>
			<label class="alert alert-danger"><?php echo $values['errors']['phone1']?></label>
		<?php endif;?>
	  </div>
	  <div class="form-group">
		<label for="">Correo electrónico</label>
		<input autocomplete="off" type="text" id="" readonly="readonly" class="form-control input-sm" name="mail" value="<?php if(isset($values['mail']) and $values['mail']!='') echo $values['mail']; ?>">
		<?php if(isset($values['errors']['mail']) and $values['errors']['mail']!=''):?>
			<label class="alert alert-danger"><?php echo $values['errors']['mail']?></label>
		<?php endif;?>
	  </div>
		<div class="form-group">
		  <label class="label label-danger">
			<input type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
			Desactivar
		  </label>
		</div>
		<div class="form-group">
		  <label class="label label-success">
			<input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
			Activar
		  </label>
		</div>	
	  <div class="form-group">
		<label autocomplete="off" for="">Fecha creado</label>
		<input autocomplete="off"  type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">
	  </div>
	  <div class="form-group">
		<label for="">Fecha modificado</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">
	  </div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/users/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>');
			$('#myModal').modal('show');	
			});

		
		</script>
    <?php endif;?>
	</form>
</div>
<?php include('../../view_footer.php')?>