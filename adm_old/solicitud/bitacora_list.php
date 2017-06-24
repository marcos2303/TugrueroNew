<?php include('../../view_header_app.php')?>

<div class="container">
    <div class="table-responsive">
        
        <table class="table table-responsive table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>idSolicitud</td>
                    <td>Usuario</td>
                    <td>Fecha/Hora</td>
                    <td>Observación</td>
                </tr>
            </thead>
            <?php if(count($data_list)>0):?>
            <?php foreach($data_list as $list):?>
                <tr>
                    <td><?php echo $list['idSolicitud']?></td>
                    <td><?php echo $list['login']?></td>
                    <td><?php echo $list['date_created']?></td>
                    <td><?php echo $list['observacion']?></td>
                </tr>            
            <?php endforeach;?>
            <?php endif;?>
        </table>
            
            <form class="" enctype="multipart/form-data" action="index.php" method="POST" id="bitacoraForm"> 
                <input type="hidden" name="idSolicitud" value="<?php echo $values['idSolicitud']?>">
                <div class="form-group" >
                        <div class="col-sm-12 ">
                            <label for="">Observación</label>
				<div class="input-group" >
                                    <textarea name="observacion" id="observacion" class="form-control input-sm" rows="10" cols="90" required></textarea>
								
                                </div>

                        </div>
                        <div class="col-sm-12 ">
                            <label for="">&nbsp;</label>
				<div class="input-group" >
                                    <a id="save_bitacora" class="btn btn-default" onclick="saveBitacora()"><i id="fa_save" class="fa fa-save fa-pull-left fa-border"></i> Guardar</a>
								
                                </div>

                        </div>
		</div>
            </form>      
        
    </div>
    
</div>