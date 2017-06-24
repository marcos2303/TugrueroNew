<?php $Seguros = new Seguros(); $list_seguros = $Seguros->getSegurosListSelect()?>
<?php $Estados = new Estados(); $list_estados = $Estados->getEstadosListSelect()?>
<?php include('../../view_header_app.php')?>
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

<div class="container">
	<h1 class="text-center big_title">Pólizas</h1>
	<form class="" enctype="multipart/form-data" action="index.php" method="POST">
		<input autocomplete="off" type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input autocomplete="off" type="hidden" name='idPoliza' value='<?php if(isset($values['idPoliza']))echo $values['idPoliza'];?>'>

	<?php //if($values['action'] == "add"):?>
	<div class="row">
		<div class="col-sm-12"> 		
					<div class="form-group" >
						<div class="col-sm-2 col-sm-offset-7">
                            <label for="">IdPóliza</label>
                            <div class="input-group">
                                    <?php if(isset($values['idPoliza'])) echo $values['idPoliza'];?>                                    
                            </div> 
                        </div>
                        <div class="col-sm-1 ">
                            <label for="">&nbsp;</label>
							<div class="input-group" >
								<select name="Nacionalidad" class="form-control input-sm" id="Nacionalidad">
									<option value="V" <?php if(isset($letra) and $letra!='' and $letra =='V') echo 'selected="selected"'?>>V</option>
									<option value="E" <?php if(isset($letra) and $letra!='' and $letra =='E') echo 'selected="selected"'?>>E</option>
									<option value="J" <?php if(isset($letra) and $letra!='' and $letra =='J') echo 'selected="selected"'?>>J</option>

								</select>
								
							</div>

                        </div>
                        <div class="col-sm-2">
							<label for="">Cédula/Rif</label>
						   <div class="input-group" >
								
							   <input autocomplete="off" type="text" pattern="[0-9]{7,9}" oninvalid="setCustomValidity('El campo admite solo números')" oninput="setCustomValidity('')" id="Cedula" class="form-control input-sm" name="Cedula" maxlength="9" value="<?php if(isset($cedula)) echo $cedula;?>">
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
                            <label for="">Nombre</label>
                            <div class="input-group">
								<input autocomplete="off" type="text" id="Nombre" class="form-control input-sm" name="Nombre" maxlength="50" value="<?php if(isset($values['Nombre'])) echo $values['Nombre']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Apellido</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Apellido" class="form-control input-sm" name="Apellido" maxlength="50" value="<?php if(isset($values['Apellido'])) echo $values['Apellido']?>">
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
								<select name="Seguro" class="form-control input-sm" id="Seguro">
									<option value="">Seleccione...</option>
									<?php if(count($list_seguros)>0):?>
										<?php foreach($list_seguros as $list):?>
											<option value="<?php echo $list['name'];?>" <?php if(isset($values['Seguro']) and $values['Seguro'] == $list['name'] ) echo "selected = 'selected'";?>><?php echo $list['name'];?></option>
										<?php endforeach;?>
									<?php endif;?>
									
								</select>
                                    
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="NumPolizaContenedor">
                            <label for="">Número de Póliza</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="NumPoliza" class="form-control input-sm" name="NumPoliza" maxlength="15"  value="<?php if(isset($values['NumPoliza'])) echo $values['NumPoliza']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="VencimientoContenedor">
                            <label for="">Emisión</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="DesdeVigencia" class="form-control input-sm datetimepicker1" name="DesdeVigencia" maxlength="50"   value="<?php if(isset($values['DesdeVigencia'])) echo $values['DesdeVigencia']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div>
                            <label for="">Vencimiento</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Vencimiento" class="form-control input-sm datetimepicker1" name="Vencimiento" maxlength="50"   value="<?php if(isset($values['Vencimiento'])) echo $values['Vencimiento']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div>

                        </div>
                     </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="">Dirección Estado</label>
                            <div class="input-group">
								<select name="DireccionEDO" class="form-control input-sm" id="DireccionEDO">
									<option value="">Seleccione...</option>
									<?php if(count($list_estados)>0):?>
										<?php foreach($list_estados as $list):?>
											<option value="<?php echo $list['name'];?>" <?php if(isset($values['DireccionEDO']) and $values['DireccionEDO'] == $list['name'] ) echo "selected = 'selected'";?>><?php echo $list['name'];?></option>
										<?php endforeach;?>
									<?php endif;?>
									
								</select>                 
								<span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="DomicilioContenedor">
                            <label for="">Domicilio</label>
                            <div class="input-group">
								<textarea id="Domicilio" class="form-control input-sm" name="Domicilio"><?php if(isset($values['Domicilio'])) echo $values['Domicilio']?></textarea>                                    
								<span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4" id="DireccionFiscalContenedor">
                            <label for="">Dirección fiscal</label>
                            <div class="input-group">
								<textarea id="DireccionFiscal"  class="form-control input-sm" name="DireccionFiscal"><?php if(isset($values['DireccionFiscal'])) echo $values['DireccionFiscal']?></textarea>
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
								<input autocomplete="off"  type="text" id="Placa" class="form-control input-sm" name="Placa" maxlength="8" value="<?php if(isset($values['Placa'])) echo $values['Placa']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Marca</label>
                            <div class="input-group">
                                    <input autocomplete="off"  type="text" id="" class="form-control input-sm" name="Marca" maxlength="20" value="<?php if(isset($values['Marca'])) echo $values['Marca']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Modelo</label>
                            <div class="input-group">
                                    <input autocomplete="off"  type="text" id="Modelo" class="form-control input-sm" name="Modelo" maxlength="20" value="<?php if(isset($values['Modelo'])) echo $values['Modelo']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Año</label>
                            <div class="input-group">
									<input autocomplete="off"  type="text" id="Año" class="form-control input-sm" pattern="[0-9]{4,4}" oninvalid="setCustomValidity('El campo admite solo números y debe contener 4 digitos')" oninput="setCustomValidity('')"  name="Año" maxlength="4" min="4" value="<?php if(isset($values['Año'])) echo $values['Año']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="">Color</label>
                            <div class="input-group">
                                    <input autocomplete="off" type="text" id="Color" class="form-control input-sm" name="Color" maxlength="15"  value="<?php if(isset($values['Color'])) echo $values['Color']?>">
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
                                    <input autocomplete="off" type="text" id="Serial" class="form-control input-sm" name="Serial" maxlength="50" value="<?php if(isset($values['Serial'])) echo $values['Serial']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                    </div>
			<div class="col-sm-8 col-sm-offset-4">
				<div class="col-sm-4">
                        <label class="label label-danger">
                            <input type="radio"  name="EstatusPoliza" id="EstatusPoliza" value="Inactivo" <?php if(isset($values['EstatusPoliza']) and $values['EstatusPoliza'] =='Inactivo' ) echo "checked=checked"?>>
                            Inactivo
                        </label>
                </div>
                <div class="col-sm-4">
                    <label class="label label-success">
                        <input type="radio" name="EstatusPoliza" id="EstatusPoliza" value="Activo" <?php if(isset($values['EstatusPoliza']) and $values['EstatusPoliza'] =='Activo' ) echo "checked=checked"?>>
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
</div>
<?php include('../../view_footer.php')?>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#NumPolizaContenedor').hide();
		$('#VencimientoContenedor').hide();
		$('#DomicilioContenedor').hide();
		$('#DireccionFiscalContenedor').hide();	
		$('#SeriallContenedor').hide();	
		
		
		//datos personales
		$('#Letra').attr('required', 'required');
		$('#Cedula').attr('required', 'required');
		$('#Nombre').attr('required', 'required');	
		$('#Apellido').attr('required', 'required');	
		//datos poliza
		$('#Seguro').attr('required', 'required');	
		$('#DireccionEDO').attr('required', 'required');	
		
		
		
		
		//datos vehiculo
		$('#Placa').attr('required', 'required');
		$('#Marca').attr('required', 'required');
		$('#Modelo').attr('required', 'required');	
		$('#Año').attr('required', 'required');	
		$('#Color').attr('required', 'required');	
		$('#Tipo').attr('required', 'required');	
		
		
		//seteo los obligatorios
		
		
		
        $('.datetimepicker1,#datetimepicker2,#datetimepicker3,#datetimepicker4,#datetimepicker5').datetimepicker({
			 viewMode: 'days',
			 locale: 'es',
			 format: 'DD/MM/YYYY',
			 //useCurrent: true,
			 showTodayButton: true,
			 showClear: true,
                         inline: false,
			 showClose: true,
			tooltips: {
				today: 'Ir a hoy',
				clear: 'Limpiar selección',
				close: 'Cerrar el calendario',
				selectMonth: 'Seleccionar mes',
				prevMonth: 'Mes anterior',
				nextMonth: 'Próximo mes',
				selectYear: 'Seleccionar año',
				prevYear: 'Previous Year',
				nextYear: 'Próximo año',
				selectDecade: 'Select Decade',
				prevDecade: 'Previous Decade',
				nextDecade: 'Next Decade',
				prevCentury: 'Previous Century',
				nextCentury: 'Next Century'
			}
			 
        });	
		
		
		$('#Seguro').change(function(){
			var Seguro = $('#Seguro').val();
			if(Seguro == 'Particular' )
			{
				$('#NumPolizaContenedor').hide();
				$("#NumPoliza").removeAttr("required");
				$('#VencimientoContenedor').hide();
				$("#Vencimiento").removeAttr("required");
				$("#DesdeVigencia").removeAttr("required");
				$('#DomicilioContenedor').hide();
				$("#Domicilio").removeAttr("required");
				$('#DireccionFiscalContenedor').show();
				$("#DireccionFiscal").attr('required', 'required');
				$('#SeriallContenedor').hide();	
				$("#Serial").removeAttr("required");
			}else if(Seguro == '')//nada seleccionado
			{
				$('#NumPolizaContenedor').hide();
				$("#NumPoliza").removeAttr("required");
				$('#VencimientoContenedor').hide();
				$("#Vencimiento").removeAttr("required");
				$("#DesdeVigencia").removeAttr("required");
				$('#DomicilioContenedor').hide();
				$("#Domicilio").removeAttr("required");
				$('#DireccionFiscalContenedor').hide();	
				$("#DireccionFiscal").removeAttr("required");
				$('#SeriallContenedor').hide();	
				$("#Serial").removeAttr("required");
			}else {//es de algun seguro o plan prepagado
				$('#NumPolizaContenedor').show();
				$("#NumPoliza").attr('required', 'required');
				$('#VencimientoContenedor').show();
				$("#Vencimiento").attr('required', 'required');
				$("#DesdeVigencia").attr('required', 'required');
				$('#DomicilioContenedor').show();
				$("#Domicilio").attr('required', 'required');
				$('#DireccionFiscalContenedor').hide();
				$("#DireccionFiscal").removeAttr("required");
				$('#SeriallContenedor').show();	
				$("#Serial").removeAttr("required");
			}
		});
		
		
		<?php if(isset($values['Seguro']) and $values['Seguro']=='Particular'):?>
				$('#NumPolizaContenedor').hide();
				$("#NumPoliza").removeAttr("required");
				$('#VencimientoContenedor').hide();
				$("#Vencimiento").removeAttr("required");
				$("#DesdeVigencia").removeAttr("required");
				$('#DomicilioContenedor').hide();
				$("#Domicilio").removeAttr("required");
				$('#DireccionFiscalContenedor').show();
				$("#DireccionFiscal").attr('required', 'required');
				$('#SeriallContenedor').hide();	
				$("#Serial").removeAttr("required");
		
		<?php endif;?>
		<?php if(isset($values['Seguro']) and $values['Seguro']!='Particular' and  $values['Seguro']!=''):?>
				$('#NumPolizaContenedor').show();
				$("#NumPoliza").attr('required', 'required');
				$('#VencimientoContenedor').show();
				$("#Vencimiento").attr('required', 'required');
				$("#DesdeVigencia").attr('required', 'required');
				$('#DomicilioContenedor').show();
				$("#Domicilio").attr('required', 'required');
				$('#DireccionFiscalContenedor').hide();
				$("#DireccionFiscal").removeAttr("required");
				$('#SeriallContenedor').show();	
				$("#Serial").removeAttr("required");
		
		<?php endif;?>
		<?php if(!isset($values['Seguro']) or $values['Seguro'] == ''):?>
				$('#NumPolizaContenedor').hide();
				$("#NumPoliza").removeAttr("required");
				$('#VencimientoContenedor').hide();
				$("#Vencimiento").removeAttr("required");
				$("#DesdeVigencia").removeAttr("required");
				$('#DomicilioContenedor').hide();
				$("#Domicilio").removeAttr("required");
				$('#DireccionFiscalContenedor').hide();	
				$("#DireccionFiscal").removeAttr("required");
				$('#SeriallContenedor').hide();	
				$("#Serial").removeAttr("required");			
		<?php endif;?>
		
	});
</script>