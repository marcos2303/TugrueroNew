<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>

        <div class="container">
			<h1 class="text-center"><label class="label label-default">Contenido de secciones</label></h1>
             <?php foreach($contents_html as $contents):?>
            <div class="row">
                <div class="col-lg-12">
					
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<label class="label label-default">Titulo: <?php echo $contents['title'];?></label>
						</div>
						<div class="panel-body">
						  <?php echo htmlentities($contents['html']);?>
						</div>
						<div class="panel-footer">
                                                    <form method="post" action="<?php echo full_url;?>/adm/about/index.php">
                                                        <input type="hidden" name="action" value="edit">
                                                        <input type="hidden" name="id_content" value="<?php echo $contents['id_content']?>">
                                                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>

  
                                                          <?php if(isset($contents['status']) and $contents['status'] == 1):?>
								  <label class="label label-success">Activo</label>
							  <?php endif;?>
							  <?php if(isset($contents['status']) and $contents['status'] == 0):?>
								  <label class="label label-danger">Desactivado</label>
							  <?php endif;?>
                                                           <label>Fecha de creación: <small><?php echo $contents['date_created']?></small></label>
                                                           <label>Última modificación: <small><?php echo $contents['date_updated']?></small></label>
                                                    </form>                
						</div>
					</div>
					

				</div>
            </div>
			<?php endforeach;?>
		</div>
<?php include('../../view_footer.php')?>