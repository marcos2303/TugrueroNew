<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Seguros</h1>
	<form class="" enctype="multipart/form-data" action="index.php" method="POST">
		<input autocomplete="off" type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input autocomplete="off" type="hidden" name='id_seguro' value='<?php if(isset($values['id_seguro']))echo $values['id_seguro'];?>'>

	<?php //if($values['action'] == "add"):?>
	<div class="row">
		<div class="col-sm-12"> 		
					<div class="form-group" >
						<div class="col-sm-2 col-sm-offset-7">
                            <label for="">Id.Seguro</label>
                            <div class="input-group">
                                    <?php if(isset($values['id_seguro'])) echo $values['id_seguro'];?>                                    
                            </div> 
                        </div>
					<div class="form-group">
                        <div class="col-sm-12">
                            <label for="">Nombre</label>
                            <div class="input-group">
								<input autocomplete="off" type="text" id="name" class="form-control input-sm" name="name" maxlength="50" required value="<?php if(isset($values['name'])) echo $values['name']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                    </div>
			<div class="col-sm-8 col-sm-offset-4">
				<div class="col-sm-4">
                        <label class="label label-danger">
                            <input type="radio"  name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
                            Inactivo
                        </label>
                </div>
                <div class="col-sm-4">
                    <label class="label label-success">
                        <input type="radio" name="status" id="status" value="1" <?php if(isset($values['status']) and $values['status'] =='1' ) echo "checked=checked"?>>
                        Activo
                    </label>
                </div>
			</div>
                    <div class="form-group">
                          <div class="col-sm-6">
                                  <label class="text-danger">Campos requeridos (*)</label>

                          </div>
                    </div>
		</div>
		
	</div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/seguros/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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
<?php include('../../view_footer_solicitud.php')?>