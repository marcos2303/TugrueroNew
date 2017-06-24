<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
	<h1 class="text-center">Administradores/Operadores</h1>
	<form class="" enctype="multipart/form-data" action="index.php" method="POST">
		<input autocomplete="off" type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input autocomplete="off" type="hidden" name='id_user' value='<?php if(isset($values['id_user']))echo $values['id_user'];?>'>

                        <div class="form-group">
						<div class="col-sm-4">
                            <label for="">IdUser</label>
                            <div class="input-group">
                                    <?php if(isset($values['id_user'])) echo $values['id_user'];?>
                                    
                            </div> 
                        </div>
						</div>
	<?php //if($values['action'] == "add"):?>
	<div class="row">
		<div class="col-md-12"> 
                    <div class="form-group">
                        <div class="col-sm-12">
                                <span class="label label-default">Datos personales</span>
                                 
                        </div>
                        <div class="col-sm-4">
                            <label for="">Cédula</label>
                            <div class="input-group">
								<select name="nationality" class="form-control input-sm">
									<option value='V' <?php if(isset($values['nationality']) and $values['nationality'] == 'V') echo 'selected="selected"'?> >V</option>
									<option value='E' <?php if(isset($values['nationality']) and $values['nationality'] == 'E') echo 'selected="selected"'?> >E</option>
								</select>
								    <span class="input-group-addon" id="basic-addon2">-</span>
                                    <input placeholder="Cédula" autocomplete="off" type="text" id="" class="form-control input-sm" name="document" maxlength="8" required pattern="[0-9]{7,9}" oninvalid="setCustomValidity('El campo admite solo números(entre 7 y 9 caracteres)')" oninput="setCustomValidity('')"  value="<?php if(isset($values['document'])) echo $values['document']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <label for="">Login</label>
                            <div class="input-group">
                                    <input placeholder="Login" autocomplete="off" type="text" id="" class="form-control input-sm" name="login" maxlength="20" required oninput=""  value="<?php if(isset($values['login'])) echo $values['login']?>">
                                    <span  class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <label for="">Tipo de acceso</label>
                            <div class="input-group">
								<select name="id_perms" class="form-control input-sm">
									<option value='2' <?php if(isset($values['id_perms']) and $values['id_perms'] == 2) echo 'selected="selected"'?>>Administrador</option>
									<option value='5'<?php if(isset($values['id_perms']) and $values['id_perms'] == 5) echo 'selected="selected"'?>>Operador</option>
								</select>									
                                    <span  class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Primer nombre</label>
                            <div class="input-group">
                                    <input placeholder="Primer nombre" autocomplete="off" type="text" id="" class="form-control input-sm" name="first_name" maxlength="50" required oninput=""  value="<?php if(isset($values['first_name'])) echo $values['first_name']?>">
                                    <span  class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Segundo nombre</label>
                            <div class="input-group">
                                    <input placeholder="Segundo nombre" autocomplete="off" type="text" id="" class="form-control input-sm" name="second_name" maxlength="50"  oninput=""  value="<?php if(isset($values['second_name'])) echo $values['second_name']?>">
                                    <span class="input-group-addon" id="basic-addon2"></span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Primer apellido</label>
                            <div class="input-group">
                                    <input placeholder="Primer apellido" autocomplete="off" type="text" id="" class="form-control input-sm" name="first_last_name" maxlength="50" required oninput=""  value="<?php if(isset($values['first_last_name'])) echo $values['first_last_name']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Segundo apellido</label>
                            <div class="input-group">
                                    <input placeholder="Segundo apellido" autocomplete="off" type="text" id="" class="form-control input-sm" name="second_last_name" maxlength="50"  oninput=""  value="<?php if(isset($values['second_last_name'])) echo $values['second_last_name']?>">
                                    <span class="input-group-addon" id="basic-addon2"></span>
                            </div> 
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="">Género</label>
                            <div class="input-group">
								<select name="gender" class="form-control input-sm">
									<option value='M' <?php if(isset($values['gender']) and $values['gender'] == 'M') echo 'selected="selected"'?>>Masculino</option>
									<option value='F' <?php if(isset($values['gender']) and $values['gender'] == 'F') echo 'selected="selected"'?>>Femenino</option>
								</select>
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Fecha de nacimiento</label>
                            <div class="input-group">
                                    <input placeholder="Fecha de nacimiento"   autocomplete="off" type="text" id="" class="form-control input-sm datetimepicker1" name="birthdate" maxlength="10" required oninput=""  value="<?php if(isset($values['birthdate'])) echo $values['birthdate']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="">Correo electrónico principal</label>
                            <div class="input-group">
                                    <input placeholder="Correo electrónico principal" autocomplete="off" type="email" id="" class="form-control input-sm" name="mail" maxlength="100" required oninput=""  value="<?php if(isset($values['mail'])) echo $values['mail']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Correo electrónico alternativo</label>
                            <div class="input-group">
                                    <input placeholder="Correo electrónico alternativo" autocomplete="off" type="email" id="" class="form-control input-sm" name="mail_alternative" maxlength="100" oninput=""  value="<?php if(isset($values['mail_alternative'])) echo $values['mail_alternative']?>">
                                    <span class="input-group-addon" id="basic-addon2"></span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="">Télefono/Celular principal</label>
                            <div class="input-group">
                                    <input placeholder="Télefono/Celular principal" autocomplete="off" type="text" id="" class="form-control input-sm" name="phone" maxlength="11" required oninput=""  value="<?php if(isset($values['phone'])) echo $values['phone']?>">
                                    <span class="input-group-addon" id="basic-addon2">(*)</span>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <label for="">Télefono/Celular alternativo</label>
                            <div class="input-group">
                                    <input placeholder="Télefono/Celular alternativo" autocomplete="off" type="text" id="" class="form-control input-sm" name="phone1" maxlength="11" oninput=""  value="<?php if(isset($values['phone1'])) echo $values['phone1']?>">
                                    <span class="input-group-addon" id="basic-addon2"></span>
                            </div> 
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="col-sm-4">
                        <label class="label label-danger">
                            <input type="radio" name="status" id="status" value="0" <?php if(isset($values['status']) and $values['status'] =='0' ) echo "checked=checked"?>>
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
						
                        <div class="col-sm-12">
                            <label for="">Clave</label>
                            <div class="input-group">
                                    <input placeholder="Clave" autocomplete="off" type="text" id="" class="form-control input-sm" name="password" maxlength="12" <?php if($values['action']=='add') echo "required";?> oninput=""  value="">
                                    <span class="input-group-addon" id="basic-addon2"></span>
                            </div> 
                        </div>
                    <div class="form-group">
                          <div class="col-sm-6">
                                  <label class="text-danger">Campos requeridos (*)</label>

                          </div>
                    </div>
		</div>
		
	</div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/UsuariosInternos/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
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
<?php include('../../view_footer_solicitud.php')?>
<script type="text/javascript">
	$(document).ready(function(){
		
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
	});
</script>