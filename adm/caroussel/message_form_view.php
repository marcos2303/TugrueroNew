<?php include('../../view_header.php')?>
<form class="" action="index.php" method="POST">
	<input type="text" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
  <div class="form-group">
    <label for="">Id.Mensaje</label>
    <input readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id_message" value="<?php if(isset($values['id_message'])) echo $values['id_message']?>">
  </div>
  <div class="form-group">
    <label for="">Nombres</label>
    <input type="text" class="form-control input-sm" id="" placeholder="" name="names" value="<?php if(isset($values['names'])) echo $values['names']?>">
  </div>
  <div class="form-group">
    <label for="">Email</label>
    <input type="text" id="" class="form-control input-sm" name="email" value="<?php if(isset($values['email'])) echo $values['email']?>">
  </div>
  <div class="form-group">
    <label for="">Teléfono</label>
    <input type="text" id="" class="form-control input-sm" name="phone" value="<?php if(isset($values['phone'])) echo $values['phone']?>">
  </div>
  <div class="form-group">
    <label for="">Mensaje</label>
    <input type="text" id="" class="form-control input-sm" name="message" value="<?php if(isset($values['message'])) echo $values['message']?>">
  </div>
  <div class="form-group">
    <label for="">Fecha</label>
    <input type="text" id="" class="form-control input-sm" name="date_added" value="<?php if(isset($values['date_added'])) echo $values['date_added']?>">
  </div>
  <div class="form-group">
    <label for="">Status</label>
    <input type="text" id="" class="form-control input-sm" name="status" value="<?php if(isset($values['status'])) echo $values['status']?>">
  </div>
	<a class="btn btn-success"  href="<?php echo full_url."/adm/messages/index.php"?>">Regresar</a>
	<button type="submit" class="btn btn-default">Guardar</button>
  
</form>

<?php include('../../view_footer.php')?>