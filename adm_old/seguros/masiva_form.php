<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>

<div class="container">
	<h1 class="text-center big_title">Carga de Pólizas</h1>
	<form class="" enctype="multipart/form-data" action="index.php" method="POST">
		<input autocomplete="off" type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>

	
	<div class="row">
		<div class="col-sm-12"> 		
					<div class="form-group" >
                        <div class="col-sm-12">
							<label for="">Archivo</label>
						   <div class="input-group" >
								
							   <input autocomplete="off" type="file" id="Archivo" class="form-control input-sm" name="Archivo" required="">
							   <span class="input-group-addon" id="basic-addon2">(*)</span>
							  
                            </div>
							<a href="<?php echo full_url?>/docs/archivo_ejemplo_carga_masiva.csv" target="_blank"> Descargar Archivo base</a>
						</div>
					</div>
		</div>
		<div class="col-sm-12"> 		
					<div class="form-group" >
                        <div class="col-sm-12">
							<label for="">&nbsp;</label>
						   <div class="input-group" >
								
								<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Cargar</button>
                            </div> 
						</div>
					</div>
		</div>
    <?php if(isset($errors) and count($errors)>0):?>
		<?php foreach($errors as $error):?>
		<div class="col-sm-12"> 		
					<div class="alert-danger" >
						<?php echo $error;?>
					</div>
		</div>
		<?php endforeach;?>
        
    <?php endif;?>		
	</div>
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
