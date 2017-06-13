<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center"><label class="label label-default">Contenido de secciones</label></h1>
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input type="text" readonly="readonly"  class="form-control input-sm" id="" placeholder="" name="id_content" value="<?php if(isset($values['id_content'])) echo $values['id_content']?>">
		<div class="form-group">
		  <label for="">Título</label>
		  <input type="text" readonly="readonly" class="form-control input-sm" id="" placeholder="" name="title" value="<?php if(isset($values['title'])) echo $values['title']?>">
		</div>
		<div class="form-group">
		  <label for="">Contenido</label>
		  <textarea class="form-control input-sm" id="" placeholder="" rows="10" name="html"><?php if(isset($values['html'])) echo $values['html']?></textarea>
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

		<a class="btn btn-default"  href="<?php echo full_url."/adm/about/index.php"?>"><i class="fa fa-arrow-left fa-pull-left fa-border"></i>Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save  fa-pull-left fa-border"></i>Guardar</button>

	</form>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>
    <?php endif;?>
</div>
<?php include('../../view_footer.php')?>