<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Contáctenos</h1>	
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input readonly="readonly" type="hidden" class="form-control input-sm" id="" placeholder="" name="id_message" value="<?php if(isset($values['id_message'])) echo $values['id_message']?>">

	  <div class="form-group">
		<label for="">Nombres y apellidos:</label>
		<!--<input readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="names" value="<?php if(isset($values['names'])) echo $values['names']?>">-->
		<?php if(isset($values['names'])) echo strtoupper($values['names']);?>
	  </div>
	  <div class="form-group">
		<label for="">Correo electrónico:</label>
		<!--<input readonly="readonly" type="text" id="" class="form-control input-sm" name="email" value="<?php if(isset($values['email'])) echo $values['email']?>">-->
		<?php if(isset($values['email'])) echo $values['email']?>
	  </div>
	  <div class="form-group">
		<label for="">Número de contacto:</label>
		<!--<input readonly="readonly" type="text" id="" class="form-control input-sm" name="phone" value="<?php if(isset($values['phone'])) echo $values['phone']?>">-->
		<?php if(isset($values['phone'])) echo $values['phone']?>
	  </div>
	  <div class="form-group">
		<label for="">Mensaje:</label>
		<!--<input readonly="readonly" type="text" id="" class="form-control input-sm" name="message" value="<?php if(isset($values['message'])) echo $values['message']?>">-->
		<p class="text-justify"><?php if(isset($values['message'])) echo $values['message']?></p>
	  </div>
		<div class="form-group">
		  <label class="label label-success">
			<input  type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
			Visualizado
		  </label>
		</div>
		<div class="form-group">
		  <label class="label label-danger">
			<input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
			No visualizado
		  </label>
		</div>	
	  <div class="form-group">
		<label for="">Fecha de envio:</label>
		<!--<input readonly="readonly" type="text" id="" class="form-control input-sm" name="date_created" value="<?php if(isset($values['date_created'])) echo $values['date_created']?>">-->
		<?php if(isset($values['date_created'])) echo $values['date_created']?>
	  </div>
	  <div class="form-group">
		<label for="">Fecha visto:</label>
		<!--<input readonly="readonly" type="text" id="" class="form-control input-sm" name="date_updated" value="<?php if(isset($values['date_updated'])) echo $values['date_updated']?>">-->
		<?php if(isset($values['date_updated'])) echo $values['date_updated']?>
	  </div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/messages/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i>Regresar</a>
		<button type="submit" class="btn btn-default"><i class="fa fa-save  fa-pull-left fa-border"></i>Guardar</button>

	</form>
    <?php if(isset($values['msg']) and $values['msg']!=''):?>
        <script>
			$(document).ready(function(){
			$('.modal-body').html('<div class="alert alert-success" role="alert"><?php echo $values['msg'];?></div>');
			$('#myModal').modal('show');	
			});

		
		</script>
    <?php endif;?>
</div>
<?php include('../../view_footer.php')?>