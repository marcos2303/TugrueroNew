<?php $Seguros = new Seguros(); $list_seguros = $Seguros->getSegurosListSelect()?>
<?php $Estados = new Estados(); $list_estados = $Estados->getEstadosListSelect()?>
<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>
<?php 
	if(isset($values['Cedula']) and $values['Cedula']!='')
	{
		$datos_cedula = preg_split("/[\s-]+/", $values['Cedula']);
		//print_r($datos_cedula);die;
		$letra = $datos_cedula[0];
		$cedula = $datos_cedula[1];
	}

?>

	<h1 class="text-center big_title">Pólizas</h1>
	<form class="" action="" name="DataForm" method="POST" id="DataForm">
		<input autocomplete="off" type="text" id="action" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input autocomplete="off" class="DatosPoliza" type="hidden" id='IdPoliza' name='IdPoliza' value='<?php if(isset($values['IdPoliza']))echo $values['IdPoliza'];?>'>

	<?php //if($values['action'] == "add"):?>
	<div class="row">
		<div class="col-sm-12"> 		
					<div class="form-group" >
                        <div class="col-sm-3">
							<label for="">Cédula/Rif</label>
						   <div class="input-group" >
								
							   <input autocomplete="off" type="text" pattern="^([VvEeJjPpGg]{1})(-)([0-9]{5,9})$" oninvalid="setCustomValidity('Debe indicar el formato V-12345678. Sin puntos y guiones')" oninput="setCustomValidity('')" id="Cedula" class="form-control input-sm DatosPoliza" name="Cedula" maxlength="11" value="<?php if(isset($cedula)) echo $cedula;?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
						</div>
					</div>
                    <div class="form-group">
						<div class="col-sm-12">
							<hr class="">Datos personales</hr>

						</div>
					</div>
					<div class="form-group">
                        <div class="col-sm-6">
                            <label for="">Nombres</label>
                            <div class="input-group">
								<input autocomplete="off" type="text" id="Nombres" class="form-control input-sm DatosPoliza" name="Nombres" maxlength="50" value="<?php if(isset($values['Nombres'])) echo $values['Nombres']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Apellidos</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Apellidos" class="form-control input-sm DatosPoliza" name="Apellidos" maxlength="50" value="<?php if(isset($values['Apellidos'])) echo $values['Apellidos']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <br>
                    </div>
                    <div class="form-group">
						<div class="col-sm-12">
							<hr class="">Datos del seguro</hr>

						</div>
					</div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="">Seguro</label>
                            <div class="input-group">
								<select name="IdSeguro" class="form-control input-sm DatosPoliza" id="IdSeguro">
									
								</select>
                                    
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="NumPolizaContenedor">
                            <label for="">Número de Póliza</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="NumPoliza" class="form-control input-sm DatosPoliza" name="NumPoliza" maxlength="15"  value="<?php if(isset($values['NumPoliza'])) echo $values['NumPoliza']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="VencimientoContenedor">
                            <label for="">Emisión</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="date" id="DesdeVigencia" class="form-control input-sm datetimepicker1 DatosPoliza" name="DesdeVigencia" maxlength="50"   value="<?php if(isset($values['DesdeVigencia'])) echo $values['DesdeVigencia']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div>
                            <label for="">Vencimiento</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="date" id="Vencimiento" class="form-control input-sm datetimepicker1 DatosPoliza" name="Vencimiento" maxlength="50"   value="<?php if(isset($values['Vencimiento'])) echo $values['Vencimiento']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div>

                        </div>
                     </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="">Dirección Estado</label>
                            <div class="input-group">
								<select name="IdEstado" class="form-control input-sm DatosPoliza" id="IdEstado">

									
								</select>                 
								<span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="DomicilioContenedor">
                            <label for="">Domicilio</label>
                            <div class="input-group">
								<textarea id="Domicilio" class="form-control input-sm DatosPoliza" name="Domicilio"><?php if(isset($values['Domicilio'])) echo $values['Domicilio']?></textarea>                                    
								<span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="DireccionFiscalContenedor">
                            <label for="">Dirección fiscal</label>
                            <div class="input-group">
								<textarea id="DireccionFiscal"  class="form-control input-sm DatosPoliza" name="DireccionFiscal"><?php if(isset($values['DireccionFiscal'])) echo $values['DireccionFiscal']?></textarea>
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>                       
                    </div>
                    <div class="form-group">
						<div class="col-sm-12">
							<hr class="">Datos del vehículo</hr>

						</div>
					</div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="">Placa</label>
                            <div class="input-group">
								<input autocomplete="off"  type="text" id="Placa" class="form-control input-sm DatosPoliza" name="Placa" maxlength="8" value="<?php if(isset($values['Placa'])) echo $values['Placa']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Marca</label>
                            <div class="input-group">
								<select name="IdMarca" class="form-control input-sm DatosPoliza" id="IdMarca">
									
								</select>                                    
								<span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Modelo</label>
                            <div class="input-group">
                                    <input autocomplete="off"  type="text" id="Modelo" class="form-control input-sm DatosPoliza" name="Modelo" maxlength="20" value="<?php if(isset($values['Modelo'])) echo $values['Modelo']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Año</label>
                            <div class="input-group">
								<select name="Anio" class="form-control input-sm DatosPoliza" id="Anio">
									
								</select>                                      
								<span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="">Color</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Color" class="form-control input-sm DatosPoliza" name="Color" maxlength="15"  value="<?php if(isset($values['Color'])) echo $values['Color']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <label for="">Tipo</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Tipo" class="form-control input-sm" name="Tipo" maxlength="40"  value="<?php if(isset($values['Tipo'])) echo $values['Tipo']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="SeriallContenedor">
                            <label for="">Serial de carroceria</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Serial" class="form-control input-sm DatosPoliza" name="Serial" maxlength="50" value="<?php if(isset($values['Serial'])) echo $values['Serial']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                    </div>
			<div class="col-sm-8 col-sm-offset-4">
				<div class="col-sm-4">
                        <label class="label label-danger">
                            <input type="radio" class="DatosPoliza"  name="Estatus" id="Estatus" value="0">
                            Inactivo
                        </label>
                </div>
                <div class="col-sm-4">
                    <label class="label label-success">
                        <input type="radio" class="DatosPoliza" name="Estatus" id="Estatus" value="1">
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
		<a class="btn btn-default"  href="<?php echo full_url."/adm/Polizas/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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
<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Polizas.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		

		
	});
</script>