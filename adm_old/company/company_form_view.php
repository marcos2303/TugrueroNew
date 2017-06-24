<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<?php $Aws = new Aws();?>
<?php $UsersData = new UsersData();?>
<?php 
	$usuario_master = $UsersData->getMasterByIdCompany($values['id']); 
	$values['id_users'] = $usuario_master['id_user'];
	$usuario_master_data = $UsersData->getUsersDataById($values);
	
?>

<div class="container">
		<h1 class="text-center big_title">Masters</h1>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#detalle" aria-controls="detalle" role="tab" data-toggle="tab">Detalle</a></li>
    <li role="presentation" class=""><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Operadores</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Grúas</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
	  <div role="tabpanel" class="tab-pane active" id="detalle">
	<form class="" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
	  <div class="form-group">
		<label for="">Id</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="id" value="<?php if(isset($values['id'])) echo $values['id']?>">
	  </div>
	  <div class="form-group">
		<label for="">Rif</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="rif" value="<?php if(isset($values['rif'])) echo $values['rif']?>">
	  </div>
	  <div class="form-group">
		<label for="">Razón social</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="razon_social" value="<?php if(isset($values['razon_social'])) echo $values['razon_social']?>">
	  </div>
	  <div class="form-group">
		<label for="">Responsable</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="responsible_name" value="<?php if(isset($values['responsible_name'])) echo $values['responsible_name']?>">
	  </div>
	  <div class="form-group">
		<label for="">Cédula</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="responsible_cedula" value="<?php if(isset($values['responsible_cedula'])) echo $values['responsible_cedula']?>">
	  </div>
	  <div class="form-group">
		<label for="">Teléfono de contacto</label>
		<input autocomplete="off" type="text" readonly="readonly"  class="form-control input-sm" id="" placeholder="" value="<?php if(isset($usuario_master_data['phone1'])) echo$usuario_master_data['phone1']?>">
	  </div>
	  <div class="form-group">
		<label for="">Estado</label>
												<select name="zone_work" class="form-control">
													<option value="">Seleccione</option>
													<option value="AMAZONAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='AMAZONAS') echo "selected='selected'";?>>AMAZONAS</option>
													<option value="ANZOATEGUI" <?php if(isset($values['zone_work']) and $values['zone_work']=='ANZOATEGUI') echo "selected='selected'";?>>ANZOATEGUI</option>
													<option value="APURE" <?php if(isset($values['zone_work']) and $values['zone_work']=='APURE') echo "selected='selected'";?>>APURE</option>
													<option value="ARAGUA" <?php if(isset($values['zone_work']) and $values['zone_work']=='ARAGUA') echo "selected='selected'";?>>ARAGUA</option>
													<option value="BARINAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='BARINAS') echo "selected='selected'";?>>BARINAS</option>
													<option value="BOLIVAR" <?php if(isset($values['zone_work']) and $values['zone_work']=='BOLIVAR') echo "selected='selected'";?>>BOLIVAR</option>
													<option value="CARABOBO" <?php if(isset($values['zone_work']) and $values['zone_work']=='CARABOBO') echo "selected='selected'";?>>CARABOBO</option>
													<option value="COJEDES" <?php if(isset($values['zone_work']) and $values['zone_work']=='COJEDES') echo "selected='selected'";?>>COJEDES</option>
													<option value="DELTA AMACURO" <?php if(isset($values['zone_work']) and $values['zone_work']=='DELTA AMACURO') echo "selected='selected'";?>>DELTA AMACURO</option>
													<option value="DEPENDENCIAS FEDERALES" <?php if(isset($values['zone_work']) and $values['zone_work']=='DEPENDENCIAS FEDERALES') echo "selected='selected'";?>>DEPENDENCIAS FEDERALES</option>
													<option value="DISTRITO CAPITAL" <?php if(isset($values['zone_work']) and $values['zone_work']=='DISTRITO CAPITAL') echo "selected='selected'";?>>DISTRITO CAPITAL</option>
													<option value="FALCON" <?php if(isset($values['zone_work']) and $values['zone_work']=='FALCON') echo "selected='selected'";?>>FALCON</option>
													<option value="GUARICO" <?php if(isset($values['zone_work']) and $values['zone_work']=='GUARICO') echo "selected='selected'";?>>GUARICO</option>
													<option value="LARA" <?php if(isset($values['zone_work']) and $values['zone_work']=='LARA') echo "selected='selected'";?>>LARA</option>
													<option value="MERIDA" <?php if(isset($values['zone_work']) and $values['zone_work']=='MERIDA') echo "selected='selected'";?>>MERIDA</option>
													<option value="MIRANDA" <?php if(isset($values['zone_work']) and $values['zone_work']=='MIRANDA') echo "selected='selected'";?>>MIRANDA</option>
													<option value="MONAGAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='MONAGAS') echo "selected='selected'";?>>MONAGAS</option>
													<option value="NUEVA ESPARTA" <?php if(isset($values['zone_work']) and $values['zone_work']=='NUEVA ESPARTA') echo "selected='selected'";?>>NUEVA ESPARTA</option>
													<option value="PORTUGUESA" <?php if(isset($values['zone_work']) and $values['zone_work']=='PORTUGUESA') echo "selected='selected'";?>>PORTUGUESA</option>
													<option value="SUCRE" <?php if(isset($values['zone_work']) and $values['zone_work']=='SUCRE') echo "selected='selected'";?>>SUCRE</option>
													<option value="TACHIRA" <?php if(isset($values['zone_work']) and $values['zone_work']=='TACHIRA') echo "selected='selected'";?>>TACHIRA</option>
													<option value="TRUJILLO" <?php if(isset($values['zone_work']) and $values['zone_work']=='TRUJILLO') echo "selected='selected'";?>>TRUJILLO</option>
													<option value="VARGAS" <?php if(isset($values['zone_work']) and $values['zone_work']=='VARGAS') echo "selected='selected'";?>>VARGAS</option>
													<option value="YARACUY" <?php if(isset($values['zone_work']) and $values['zone_work']=='YARACUY') echo "selected='selected'";?>>YARACUY</option>
													<option value="ZULIA" <?php if(isset($values['zone_work']) and $values['zone_work']=='ZULIA') echo "selected='selected'";?>>ZULIA</option>
												</select>
	  </div>

	  <div class="form-group">
		<label for="">Ubicación de empresa o firma personal</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="location" value="<?php if(isset($values['location'])) echo $values['location']?>">
	  </div>
		<div class="form-group">
			<label>¿Pertenece al Club Grúas Venezuela?</label>
			<label class="radio-inline"><input type="radio" <?php if(isset($values['club_gruas']) && $values['club_gruas'] == "1") echo "checked='checked'";?> value="1"  name="club_gruas" checked onchange="">Si</label>
			<label class="radio-inline"><input type="radio" <?php if(isset($values['club_gruas']) && $values['club_gruas'] == "0") echo "checked='checked'";?> value="0" name="club_gruas" onchange="">No</label>
		</div>		
	  <div class="form-group">
		<label for="">Número de socio en el Club de Grúas Venezuela</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="num_socio" value="<?php if(isset($values['num_socio'])) echo $values['num_socio']?>">
	  </div>	
 	  <div class="form-group">
		<label for="">Banco</label>
                <select name="id_bank">
                    <option value="">Seleccione...</option>
                    <?php if(isset($bank_list) and count($bank_list)>0):?>
                    <?php foreach ($bank_list as $bank):?>
                        <option value="<?php echo $bank['id'];?>" <?php if($bank['id']== $values['id_bank'])echo "selected='selected'" ?>><?php echo $bank['name'];?></option>
                    <?php endforeach;?>
                    <?php endif;?>
                </select>
	  </div>	
	  <div class="form-group">
		<label  for="tipo_cuenta">Tipo de cuenta</label>
			<select  name="tipo_cuenta" class="form-control" required>
				<option value="Personal" <?php if(isset($values['tipo_cuenta']) && $values['tipo_cuenta'] == "Personal") echo "selected";?>>Personal</option>
				<option value="Empresa" <?php if(isset($values['tipo_cuenta']) && $values['tipo_cuenta'] == "Empresa") echo "selected";?>>Empresa</option>
			</select>
		<label for="">Cuenta Nº</label>
		<input autocomplete="off" type="text" class="form-control input-sm" id="" placeholder="" name="num_cuenta" value="<?php if(isset($values['num_cuenta'])) echo $values['num_cuenta']?>">
	  </div>
		

	  <div class="form-group">
		<label for="">Archivos</label>
                    <?php if(isset($company_files_list) and count($company_files_list)>0):?>
                    <?php 
					$array_nombre_archivos = array();
					$array_nombre_archivos[1] = "Cédula";  
					$array_nombre_archivos[2] = "RIF jurídico o natural";
					$array_nombre_archivos[3] = "Licencia de conducir";
					$array_nombre_archivos[4] = "Carnet de circulación";
					?>
					<?php $i=1;foreach ($company_files_list as $files):?>
                        <div class="alert alert-success" role="alert">
							
                            <label><?php echo $array_nombre_archivos[$i]?></label>
							<br>
							<a target="_blank" href="<?php echo full_url?>/web/files/<?php echo $files['name_file'];?>"><i class="fa fa-eye fa-pull-left fa-border"></i> <?php echo $files['name_file'];?></a>
                        </div>
                    <?php $i++;endforeach;?>
                    <?php endif;?>
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

		<a class="btn btn-default"  href="<?php echo full_url."/adm/company/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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
	  <div role="tabpanel" class="tab-pane active" id="home">
		  
				<h1 class="text-center">Operadores</h1>
				<?php $UsersCompany = new UsersCompany(); $users_list = $UsersCompany->getUsersByCompanyId($values);?>
				<?php if(count($users_list)>0):?>
				<div align='center'>
				<table class="table-responsive table-bordered table-condensed table-hover">
					<tr>
						<th>Nombres y apellidos</th>
						<th>Usuario</th>
						<th>Estatus</th>
						<th>Placa</th>
						<th>Clave</th>
						<th>Teléfono de contacto</th>
						<th>Disponibilidad en vivo</th>
						<th>Imagen Cédula</th>			
					</tr>
					<?php foreach($users_list as $users):?>
					<tr>
						<td><?php echo $users['first_name']." ".$users['first_last_name']?></td>	
						<td><input type="text" name="login_operador" id="login_operador" onchange="actualizaLogin(<?php echo $users['id_users']?>,this.value);" value="<?php echo $users['login']?>"></td>
						<td><?php if($users['status']==1) {echo "Activo";} else{ echo "Desactivado";}?></td>
						<td><?php $placa = $Aws->getGruerosPlaca($users); echo $placa['placa'];?></td>
						<td><?php $clave = $Aws->getGruerosClave($users); echo $clave['clave'];?></td>
						<td><input type="text" name="phone_operador" id="phone_operador" onchange="actualizaPhone(<?php echo $users['id_users']?>,this.value);" value="<?php echo $users['phone']?>"></td>
						<td><?php $disponibilidad = $Aws->getDisponibilidad($users); echo $disponibilidad;?></td>
						<td>
							<?php if(isset($users['document_file']) and $users['document_file']!=''):?>
								<a href="<?php echo full_url?>/web/files/operators/<?php echo $users['document_file']?>" target="_blank">Cédula</a>
							<?php endif;?>
							<?php if(!isset($users['document_file']) or $users['document_file']==''):?>
								<label class="alert-danger">No posee cédula cargada</label>
							<?php endif;?>

						</td>			
					</tr>
					<?php endforeach;?>
				</table>
				</div>
				<?php endif;?>
	  </div>
	  <div role="tabpanel" class="tab-pane" id="profile">
				<h1 class="text-center">Grúas</h1>
				<?php $Hoist = new Hoist();	$hoist_list = $Hoist ->getHoistByIdCompany($values);?>
				<?php if(count($hoist_list)>0):?>
				<div align='center'>
				<table class="table-responsive table-bordered table-condensed table-hover">
					<tr>
						<th>Tipo</th>
						<th>Placa</th>
						<th>Color</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Año</th>
						<th>Estatus</th>
						<th>RCV</th>			
					</tr>
					<?php foreach($hoist_list as $hoist):?>
					<tr>
						<td>
							<?php echo $hoist['type_hoist']?></td>	
						<td>
							<?php echo $hoist['registration_plate']?></td>
						<td>
							<?php echo $hoist['color']?></td>
						<td>
							<?php echo $hoist['make']?></td>
						<td>
							<?php echo $hoist['model']?></td>
						<td>
							<?php echo $hoist['year_vehicle']?></td>
						<td>
							<?php if($hoist['status']==1) {echo "Activo";} else{ echo "Desactivado";}?></td>
						<td>
							<?php if(isset($hoist['rcv']) and $hoist['rcv']!=''):?>
								<a href="<?php echo full_url?>/web/files/hoist/<?php echo $hoist['rcv']?>" target="_blank"><?php echo $hoist['rcv']?></a>
							<?php endif;?>
							<?php if(!isset($hoist['rcv']) or $hoist['rcv']==''):?>
								<label class="alert-danger">No posee rcv</label>
							<?php endif;?>

						</td>			
					</tr>
					<?php endforeach;?>
				</table>
				</div>
				<?php endif;?>
	  </div>

  </div>

</div>

</div>	
	
<?php include('../../view_footer.php')?>
<script>

	function actualizaLogin(id_user, login){
		
		$.ajax({
			type: "POST",
			url: '<?php echo full_url;?>/adm/company/index.php',
			data: { action: "update_login",id_user: id_user, login: login},
			success: function(){
				alert('Login actualizado satisfactoriamente.');
			}
		});
	}
	function actualizaPhone(id_user, phone){
		
		$.ajax({
			type: "POST",
			url: '<?php echo full_url;?>/adm/company/index.php',
			data: { action: "update_phone",id_user: id_user, phone: phone},
			success: function(){
				alert('Contacto actualizado satisfactoriamente.');
			}
		});
	}
</script>