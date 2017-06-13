<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center"><label class="label label-default">Usuarios compañias</label></h1>
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		<label for="">Id</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id" value="<?php if(isset($values['id'])) echo $values['id']?>">
	  </div>
	  <div class="form-group">
		<label for="">Id_user</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_user" value="<?php if(isset($values['id_user'])) echo $values['id_user']?>">
	  </div>
	  <div class="form-group">
		<label for="">id_company</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_company" value="<?php if(isset($values['id_company'])) echo $values['id_company']?>">
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
		<a class="btn btn-default"  href="<?php echo full_url."/adm/users_company/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>
    <?php endif;?>
	</form>
</div>
<?php include('../../view_footer.php')?>