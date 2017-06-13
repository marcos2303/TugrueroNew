<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grueros Venezuela, Grúas Venezuela">
    <meta name="author" content="tugruero">
    <meta name="google-site-verification" content="kXlZJPIsjo2kzjHRJpgR4ncAn-g_bF5ipNOvRSkhsE0" />
    <link rel="alternate" hreflang="es" href="www.tugruero.com" />
    <link rel="icon" href="<?php echo full_url?>/web/img/favicon.ico" type="image/x-icon"/>
    <title>TUGRUERO®</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo full_url?>/web/css/bootstrap.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?php echo full_url?>/web/css/freelancer2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo full_url?>/web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo full_url?>/web/css/animate.min.css" />
	<link href="<?php echo full_url;?>/web/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet">
        
</head>
<body class="" style="background-color: /*#004e9c*/#fff;color:#737474;">
<nav class="navbar navbar-default" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		<div class="">
			<div class="container text-left">
				<a class="" href="<?php echo full_url;?>/index.php"><img class="" src="<?php echo full_url;?>/web/img/logo_blanco.png" alt="" width="150"></a>
			</div>
		
		</div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"></div>
  </div>
</nav>
<?php $Marcas = new Marcas(); $marcas_list = $Marcas->getMarcasListSelect();?>
<?php $Estados = new Estados(); $list_estados = $Estados->getEstadosListSelect()?>




    <form  method="POST" enctype="multipart/form-data" id="sendForm">
		<div class="well well-sm text-center col-sm-12 text-info">
		<h1 class="text-center">
			Proceso de contratación Plan TU/GRUERO®
		</h1> 
		<strong>(Parte 1 de 2)</strong>
		</div>
        <?php if(isset($errors['global']) and $errors['global']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['global'];?></div>

        <?php endif;?> 
			<div class="">
				<div class="col-sm-12 text-center">
					<a class="text-center" href="#"><img class="text-center" src="<?php echo full_url;?>/web/img/fresh/jleal.png" alt=""></a>
                </div>  

            </div>
		
    <input type="hidden" name="action" value="<?php echo $values['action']?>">
    <input type="hidden" id="precio" name="precio" value="<?php if(isset($values['precio']))echo $values['precio']?>">
    <input type="hidden" id="IdV" name="IdV" value="2">
    <input type="hidden" id="plan" name="plan" value="<?php if(isset($values['plan']))echo $values['plan']?>">

    <div class="form-group col-sm-2 col-sm-offset-10 text-right PlanPrecio alert alert-info">
      <p><b>Total a pagar con IVA:</b> <?php if(isset($values['precio']) and $values['precio']!='') echo "Bs. ".number_format($values['precio'],2,",",".")."."; else echo " Bs. 0,00"?></p>
  </div>
	<div class="form-group col-sm-12 well well-sm text-info">
		
		<p class="subtitulo_planes_jleal"><strong>Escoja el Plan de su preferencia</strong></p>
	</div>
  <div class="form-group col-sm-12">
	  <!--<label for="idPlan" class="">Plan </label> <label class="text-danger"> * </label>-->
    <div class="">
        <select class="form-control" id="idPlan" name="idPlan">
            <option value="">Seleccione el plan</option>
            <option value="2" <?php if(isset($values['idPlan']) and $values['idPlan']==2) echo "selected='selected'";?>>TU GRUERO GOLD</option>
            <option value="1" <?php if(isset($values['idPlan']) and $values['idPlan']==1) echo "selected='selected'";?>>TU GRUERO PLUS</option>
        </select>
    </div>
        <?php if(isset($errors['idPlan']) and $errors['idPlan']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['idPlan'];?></div>

        <?php endif;?> 
  </div>    
	<div class="well well-sm form-group col-sm-12 text-info">
		
		<p class="subtitulo_planes_jleal"><strong>Información personal</strong></p>
	</div>

            <div class="form-group col-sm-3">
                    <label for="Cedula" class="control-label">Cédula</label> <label class="text-danger"> * </label>&nbsp;&nbsp;&nbsp;&nbsp;<small> (V-12345678)</small>
              <div class="">
                  <input type="text" name="Cedula" class="form-control" autocomplete="off" id="Cedula" maxlength="10" value="<?php if(isset($values['Cedula']) and $values['Cedula']!='') echo $values['Cedula'];?>" placeholder="Ejemplo: V-12345678">
              </div>
                  <?php if(isset($errors['Cedula']) and $errors['Cedula']!=''):?>
                  <div id="" class="alert alert-danger"><?php echo $errors['Cedula'];?></div>

                  <?php endif;?>
            </div>
              <div class="form-group col-sm-3">
                      <label for="Rif" class=" control-label">RIF</label> <label class="text-danger"> * </label>&nbsp;&nbsp;&nbsp;&nbsp;<small> (V-123456781)</small>
                <div class="">
                    <input type="text" name="Rif" class="form-control" maxlength="11" autocomplete="off" value="<?php if(isset($values['Rif']) and $values['Rif']!='') echo $values['Rif'];?>" id="Rif" placeholder="Ejemplo: V-123456781">
                </div>
                    <?php if(isset($errors['Rif']) and $errors['Rif']!=''):?>
                    <div id="" class="alert alert-danger"><?php echo $errors['Rif'];?></div>

                    <?php endif;?>
              </div>
              <div class="form-group col-sm-3">
                <label for="Nombres" class="control-label">Nombres</label> <label class="text-danger"> * </label>
                <div class="">
                    <input type="text" name="Nombres" class="form-control" autocomplete="off" maxlength="50" id="Nombres" value="<?php if(isset($values['Nombres']) and $values['Nombres']!='') echo $values['Nombres'];?>" placeholder="Ejemplo: Juan José">
                </div>
                    <?php if(isset($errors['Nombres']) and$errors['Nombres']!=''):?>
                    <div id="" class="alert alert-danger"><?php echo $errors['Nombres'];?></div>
                    <?php endif;?>
              </div>
              <div class="form-group col-sm-3">
                <label for="Apellidos" class="2 control-label">Apellidos</label> <label class="text-danger"> * </label>
                <div class="">
                    <input type="text" name="Apellidos" class="form-control" autocomplete="off" maxlength="50" id="Apellidos" value="<?php if(isset($values['Apellidos']) and $values['Apellidos']!='') echo $values['Apellidos'];?>"  placeholder="Ejemplo: Alvarez Pérez">
                </div>
                    <?php if(isset($errors['Apellidos']) and $errors['Apellidos']!=''):?>
                    <div id="" class="alert alert-danger"><?php echo $errors['Apellidos'];?></div>

                    <?php endif;?>
              </div>

              <div class="form-group col-sm-3">
                <label for="RCV" class="control-label">Sexo</label> <label class="text-danger"> * </label>
                <div class="">
                <label class="radio-inline">
                  <input type="radio" name="Sexo" class="Sexo" value="Masculino" <?php if(isset($values['Sexo']) and $values['Sexo']=='Masculino') echo "checked='checked'";?>> Masculino
                </label>
                <label class="radio-inline">
                  <input type="radio" name="Sexo" class="Sexo" value="Femenino" <?php if(isset($values['Sexo']) and $values['Sexo']=='Femenino') echo "checked='checked'";?>> Femenino
                </label>
                </div>
                    <?php if(isset($errors['Sexo']) and $errors['Sexo']!=''):?>
                    <div id="" class="alert alert-danger"><?php echo $errors['Sexo'];?></div>

                    <?php endif;?>
              </div>
        <div class="form-group col-sm-6">
          <label for="EstadoCivil" class="control-label">Estado Civil</label> <label class="text-danger"> * </label>
          <div class="">
                <select name="EstadoCivil" class="form-control" id="EstadoCivil">
                    <option value="">Seleccione...</option> 
                    <option value="Casado(a)" <?php if(isset($values['EstadoCivil']) and $values['EstadoCivil']=='Casado(a)') echo "selected = 'selected'"?> >Casado(a)</option>
                    <option value="Divorciado(a)" <?php if(isset($values['EstadoCivil']) and $values['EstadoCivil']=='Divorciado(a)') echo "selected = 'selected'"?> >Divorciado(a)</option>
                    <option value="Soltero(a)" <?php if(isset($values['EstadoCivil']) and $values['EstadoCivil']=='Soltero(a)') echo "selected = 'selected'"?> >Soltero(a)</option>
                    <option value="Viudo(a)" <?php if(isset($values['EstadoCivil']) and $values['EstadoCivil']=='Viudo(a)') echo "selected = 'selected'"?> >Viudo(a)</option>
                    
                </select> 
          </div>
              <?php if(isset($errors['EstadoCivil']) and $errors['EstadoCivil']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['EstadoCivil'];?></div>

              <?php endif;?>
        </div>
  <div class="form-group col-sm-3">
    <label for="FechaNacimiento" class="2 control-label">Fecha de nacimiento</label> <label class="text-danger"> * </label>&nbsp;&nbsp;&nbsp;&nbsp;<small> (01/01/1980)</small>
    <div class="">
        <input type="text" name="FechaNacimiento" class="form-control" autocomplete="off" maxlength="10" id="FechaNacimiento" value="<?php if(isset($values['FechaNacimiento']) and $values['FechaNacimiento']!='') echo $values['FechaNacimiento'];?>"  placeholder="Ejemplo: 01/01/1980">
    </div>
        <?php if(isset($errors['FechaNacimiento']) and$errors['FechaNacimiento']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['FechaNacimiento'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-6">
    <label for="Correo" class="control-label">Correo electrónico</label> <label class="text-danger"> * </label>
    <div class="">
      <input type="email" class="form-control" name="Correo" autocomplete="off" id="Correo" maxlength="100" value="<?php if(isset($values['Correo']) and $values['Correo']!='') echo $values['Correo'];?>" placeholder="Ejemplo: correo@gmail.com">
    </div>
        <?php if(isset($errors['Correo']) and $errors['Correo']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Correo'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-6">
    <label for="Correo2" class="control-label">Confirme su correo electrónico</label> <label class="text-danger"> * </label>
    <div class="">
      <input type="email" class="form-control" name="Correo2" autocomplete="off" id="Correo2" maxlength="100" value="<?php if(isset($values['Correo2']) and $values['Correo2']!='') echo $values['Correo2'];?>" placeholder="Ejemplo: correo@gmail.com">
    </div>
        <?php if(isset($errors['Correo2']) and $errors['Correo2']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Correo2'];?></div>

        <?php endif;?>    
  </div>
  <div class="form-group col-sm-6">
    <label for="Telefono" class="control-label">Teléfono de habitación</label> <label class="text-danger">  </label>&nbsp;&nbsp;&nbsp;<small> (02121234567)</small>
    <div class="">
        <input type="text" name="Telefono" class="form-control" autocomplete="off" id="Telefono" maxlength="11" value="<?php if(isset($values['Telefono']) and $values['Telefono']!='') echo $values['Telefono'];?>" placeholder="Ejemplo: 02121234567">
    </div>
        <?php if(isset($errors['Telefono']) and $errors['Telefono']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Telefono'];?></div>

        <?php endif;?>
  </div> 
  <div class="form-group col-sm-6">
    <label for="Celular" class="control-label">Celular</label> <label class="text-danger"> * </label>&nbsp;&nbsp;&nbsp;&nbsp;<small> (04141234567)</small>
    <div class="">
        <input type="text" name="Celular" class="form-control" autocomplete="off" id="Celular" maxlength="11" value="<?php if(isset($values['Celular']) and $values['Celular']!='') echo $values['Celular'];?>" placeholder="Ejemplo: 04141234567">
    </div>
        <?php if(isset($errors['Celular']) and $errors['Celular']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Celular'];?></div>

        <?php endif;?>
  </div>
    <div class=""> 
        <div class="form-group col-sm-3">
          <label for="Estado" class="control-label">Estado</label> <label class="text-danger"> * </label>
          <div class="">
            <select name="Estado" class="form-control" id="Estado">
                <option value="">Seleccione...</option>
                <?php if(count($list_estados)>0):?>
                    <?php foreach($list_estados as $list):?>
                        <option value="<?php echo $list['name'];?>" <?php if(isset($values['Estado']) and $values['Estado'] == $list['name'] ) echo "selected = 'selected'";?>><?php echo $list['name'];?></option>
                    <?php endforeach;?>
                <?php endif;?>						
            </select>
          </div>
              <?php if(isset($errors['Estado']) and $errors['Estado']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Estado'];?></div>

              <?php endif;?>
        </div>
        <div class="form-group col-sm-3">
          <label for="Ciudad" class="control-label">Ciudad</label> <label class="text-danger"> * </label>
          <div class="">
              <input type="text" name="Ciudad" class="form-control" id="Ciudad" value="<?php if(isset($values['Ciudad']) and $values['Ciudad']!='') echo $values['Ciudad'];?>" />
          </div>
              <?php if(isset($errors['Ciudad']) and $errors['Ciudad']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Ciudad'];?></div>

              <?php endif;?>
        </div>
        <div class="form-group col-sm-6">
          <label for="Domicilio" class="control-label">Dirección de domicilio</label> <label class="text-danger"> * </label>
          <div class="">
              <textarea name="Domicilio" class="form-control" id="Domicilio" placeholder="Colocar una Dirección de domicilio de mínimo 10 caracteres."><?php if(isset($values['Domicilio']) and $values['Domicilio']!='') echo $values['Domicilio'];?></textarea>
          </div>
              <?php if(isset($errors['Domicilio']) and $errors['Domicilio']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Domicilio'];?></div>

              <?php endif;?>
        </div>
    </div>    
    <div class=""> 
        <div class="form-group col-sm-12">
          <label for="RCV" class="control-label">¿Quiere el RCV? (Responsabilidad Civil Vehicular)</label> <label class="text-danger"> * </label>
          <div class="">
          <label class="radio-inline">
            <input type="radio" name="RCV" class="RCV" value="SI" <?php if(isset($values['RCV']) and $values['RCV']=='SI') echo "checked='checked'";?>> Si
          </label>
          <label class="radio-inline">
            <input type="radio" name="RCV" class="RCV" value="NO" <?php if(isset($values['RCV']) and $values['RCV']=='NO') echo "checked='checked'";?>> No
          </label>
          </div>
              <?php if(isset($errors['RCV']) and $errors['RCV']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['RCV'];?></div>

              <?php endif;?>
        </div>
   </div>
	<div class="form-group col-sm-12 CedulaDiv well well-sm text-info">

		<p class="subtitulo_planes_jleal"><strong>Documentos personales</strong></p>
	</div>
  <div class="form-group col-sm-12 RCV_SI CedulaDiv" style="display:none;">
    <label for="CedulaDoc" class="control-label">Cédula</label> <label class="text-danger"> * </label>
    <div class="">
        <input type="file" name="CedulaDoc" class="form-control "  id="CedulaDoc" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['CedulaDoc']) and $errors['CedulaDoc']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CedulaDoc'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 CarnetCirculacionDiv">
    <label for="CarnetCirculacion" class="control-label">Carnet de circulación</label> <label class="text-danger"> * </label>
    <div class="">
        <input type="file" name="CarnetCirculacion" class="form-control " id="CarnetCirculacion" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['CarnetCirculacion']) and $errors['CarnetCirculacion']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CarnetCirculacion'];?></div>

        <?php endif;?>
  </div>
	<div class="form-group col-sm-12 well well-sm text-info">
		
		<p class="subtitulo_planes_jleal"><strong>Información de su vehículo</strong></p>
	</div>
        <div class="form-group col-sm-12">
          <label for="Clase" class="control-label">Clase</label> <label class="text-danger"> * </label>
          <div class="">
                <select name="Clase" class="form-control" id="Clase">
                    <option value="">Seleccione...</option> 
                    <option value="Automóvil" <?php if(isset($values['Clase']) and $values['Clase']=='Automóvil') echo "selected = 'selected'"?> >Automóvil</option>                   
                    <option value="Camioneta" <?php if(isset($values['Clase']) and $values['Clase']=='Camioneta') echo "selected = 'selected'"?> >Camioneta</option>                   
                    <option value="Moto" <?php if(isset($values['Clase']) and $values['Clase']=='Moto') echo "selected = 'selected'"?> >Moto</option>                   

                </select> 
          </div>
            <?php if(isset($errors['Clase']) and $errors['Clase']!=''):?>
            <div id="" class="alert alert-danger"><?php echo $errors['Clase'];?></div>

            <?php endif;?>
        </div>
  <div class="form-group col-sm-2">
    <label for="Marca" class="control-label">Marca</label> <label class="text-danger"> * </label>
    <div class="">
        <select name="Marca" id="Marca" class="form-control">
                    <option value="">Seleccione...</option>
            <?php if(count($marcas_list)>0):?>
                <?php foreach($marcas_list as $marcas):?>
                    <option value="<?php echo $marcas['Marca']?>" <?php if(isset($values['Marca']) and $marcas['Marca'] == $values['Marca']) echo "selected='selected'";?>><?php echo $marcas['Marca']?></option>    
                <?php endforeach;?>
            <?php endif;?>
        </select>
    </div>
        <?php if(isset($errors['Marca']) and $errors['Marca']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Marca'];?></div>

        <?php endif;?>
  </div> 
  <div class="form-group col-sm-2">
    <label for="Telefono" class="control-label">Modelo</label> <label class="text-danger"> * </label>
    <div class="">
        <input type="text" name="Modelo" class="form-control" autocomplete="off" id="Modelo" maxlength="20" value="<?php if(isset($values['Modelo']) and $values['Modelo']!='') echo $values['Modelo'];?>" placeholder="Ejemplo: AVEO">
    </div>
        <?php if(isset($errors['Modelo']) and $errors['Modelo']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Modelo'];?></div>

        <?php endif;?>
  </div>
        <div class="form-group col-sm-2 TIPO">
          <label for="Tipo" class="control-label">Tipo</label> <label class="text-danger"> * </label>
          <div class="">
                <select name="Tipo" class="form-control" id="Tipo">
                    <option value="">Seleccione...</option> 
                    <option value="Coupé" <?php if(isset($values['Tipo']) and $values['Tipo']=='Coupé') echo "selected = 'selected'"?> >Coupé</option>                   
                    <option value="Cross Over" <?php if(isset($values['Tipo']) and $values['Tipo']=='Cross Over') echo "selected = 'selected'"?> >Cross Over</option>                   
                    <option value="Pick Up" <?php if(isset($values['Tipo']) and $values['Tipo']=='Pick Up') echo "selected = 'selected'"?> >Pick Up</option>                   
                    <option value="Rústico" <?php if(isset($values['Tipo']) and $values['Tipo']=='Rústico') echo "selected = 'selected'"?> >Rústico</option>                   
                    <option value="Sedán" <?php if(isset($values['Tipo']) and $values['Tipo']=='Sedán') echo "selected = 'selected'"?> >Sedán</option>                   
                    <option value="Sport Wagon" <?php if(isset($values['Tipo']) and $values['Tipo']=='Sport Wagon') echo "selected = 'selected'"?> >Sport Wagon</option>                   

                </select> 
          </div>
              <?php if(isset($errors['Tipo']) and $errors['Tipo']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Tipo'];?></div>

              <?php endif;?>
        </div> 
  <div class="form-group col-sm-2">
    <label for="Telefono" class="control-label">Año</label> <label class="text-danger"> * </label>
    <div class="">
        <select name="Anio" id="Anio" class="form-control">
                    <option value="">Seleccione...</option>

                <?php for($anio = (date('Y')-17); $anio<=date('Y'); $anio++):?>
                    <option value="<?php echo $anio?>" <?php if(isset($values['Anio']) and $anio == $values['Anio']) echo "selected='selected'";?>><?php echo $anio?></option>    
                <?php endfor;?>
 
        </select>
    </div>
        <?php if(isset($errors['Anio']) and $errors['Anio']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Anio'];?></div>

        <?php endif;?>
  </div> 
  <div class="form-group col-sm-2">
    <label for="Telefono" class="control-label">Color</label> <label class="text-danger"> * </label>
    <div class="">
        <input type="text" name="Color" class="form-control" id="Color" autocomplete="off" maxlength="20" value="<?php if(isset($values['Color']) and $values['Color']!='') echo $values['Color'];?>" placeholder="Ejemplo: Azul">
    </div>
        <?php if(isset($errors['Color']) and $errors['Color']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Color'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-2">
    <label for="Telefono" class="control-label">Placa</label> <label class="text-danger"> * </label>
    <div class="">
        <input type="text" name="Placa" class="form-control" id="Placa" autocomplete="off" maxlength="7" value="<?php if(isset($values['Placa']) and $values['Placa']!='') echo $values['Placa'];?>" placeholder="Ejemplo: AAABBB">
    </div>
        <?php if(isset($errors['Placa']) and $errors['Placa']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Placa'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 Puestos">
    <label for="Telefono" class="control-label">Cantidad de puestos</label> <label class="text-danger"> * </label>
    <div class="">
        <input type="number" name="Puestos" class="form-control" id="Puestos" autocomplete="off" maxlength="1" value="<?php if(isset($values['Puestos']) and $values['Puestos']!='') echo $values['Puestos']; else echo "5";?>" min="5" max="7">
    </div>
        <?php if(isset($errors['Puestos']) and $errors['Puestos']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Puestos'];?></div>

        <?php endif;?>
  </div>  
	<div class="form-group col-sm-12 well well-sm text-info">
		<p class="subtitulo_planes_jleal"><strong>Método de pago</strong></p>
	</div>
  <div class="form-group col-sm-12">
    <!--<label for="inputEmail3" class="control-label">Método de pago</label> <label class="text-danger"> * </label>-->
    <div class="">
		
		<table>
			<tr>
				<td><input type="radio" name="MET" class="MET " value="TDC" <?php if(isset($values['MET']) and $values['MET']=='TDC') echo "checked='checked'";?>> Tarjeta de crédito </td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="MET" class="MET" value="DEP" <?php if(isset($values['MET']) and $values['MET']=='DEP') echo "checked='checked'";?>> Depósito o transferencia  </td>
			</tr>
			<tr>
				<td align="center"><img src="<?php echo full_url;?>/web/img/fresh/medios_pagos/visa.png"> <img src="<?php echo full_url;?>/web/img/fresh/medios_pagos/mastercard.png"></td>
				<td align="center"><i class="fa fa-file-text-o fa-3x btn-info"></i></td>
			</tr>
		</table>
    <label class="">
    </label>
    <label class="">
      
    </label>
    </div>
        <?php if(isset($errors['MET']) and $errors['MET']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['MET'];?></div>

        <?php endif;?>
  </div>
	<div id="mensajetarjeta" class="col-sm-12 alert alert-info" style="display:none;">
		¡Excelente! En la próxima parte de este proceso podrás indicarnos los datos de tu tarjeta para que procesemos tu pago.
	</div>
	<div id="mensajedeposito" class="col-sm-12 alert alert-info" style="display:none;">
		Puedes pagar el monto total con una (01) o varias transferencias y/o depósitos, carga los comprobantes de todos los pagos.
	</div>
  <div class="form-group col-sm-12 DEPOSITO" style="display:none;">
    <label for="DEP1" class="control-label">Comprobante #1 </label> <label class="text-danger"> * </label>
    <div class="">
        <input type="file" name="DEP1" class="form-control" id="DEP1" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['DEP1']) and $errors['DEP1']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['DEP1'];?></div>

        <?php endif;?>
  </div>
	<div class="form-group col-sm-12 DEPOSITO" style="display:none;">
    <label for="DEP2" class="control-label">Comprobante #2</label>
    <div class="">
        <input type="file" name="DEP2" class="form-control " id="DEP2" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['DEP2']) and $errors['DEP2']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['DEP2'];?></div>

        <?php endif;?>
	</div>
	<div class="form-group col-sm-12 DEPOSITO" style="display:none;">
    <label for="DEP3" class="control-label">Comprobante #3</label>
    <div class="">
        <input type="file" name="DEP3" class="form-control " id="DEP3" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['DEP3']) and $errors['DEP3']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['DEP3'];?></div>

        <?php endif;?>
	</div>
	<div class="col-sm-12">
			<hr class="hr_subtitulo_planes_jleal">
	</div>
  <div class="form-group col-sm-2 col-sm-offset-10 text-right PlanPrecio alert alert-info">
      
	  <p><b>Total a pagar con IVA:</b> <?php if(isset($values['precio']) and $values['precio']!='') echo "Bs. ".number_format($values['precio'],2,",",".")."."; else echo "Bs. 0,00 "?></p>
  </div>

	<div class="col-sm-5">
			
	</div>
	<div class="form-group col-sm-3">		
		<?php

			$options = array();
			$options['input_name'] = 'ct_captcha'; // change name of input element for form post
			$options['disable_flash_fallback'] = false; // allow flash fallback
			$options['show_audio_button'] = false;
			if (!empty($_SESSION['ctform']['captcha_error'])) {

			$options['error_html'] = $_SESSION['ctform']['captcha_error'];
			}

			echo "<div id='captcha_container_1' class='text-center'>\n";
			echo Securimage::getCaptchaHtml($options);
			echo "\n</div><strong><p class='text-center small'>Respete letras mayúsculas y minúsculas</p></strong>\n";
		?>
        <?php if(isset($errors['captcha_error']) and $errors['captcha_error']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['captcha_error'];?></div>

        <?php endif;?>



	</div>
	<div class="col-sm-4">
		
	</div>
        <?php if(isset($errors['global']) and $errors['global']!=''):?>
        <div id="" class="alert alert-danger col-sm-12"><?php echo $errors['global'];?></div>

        <?php endif;?> 
  <div class="form-group col-xs-12">
	<div class="col-sm-4"></div>
    <div class="col-sm-4 text-center" >
		<button type="submit" class="btn btn-success"><strong style="font-size: 20px;">Continuar</strong></button>
    </div>
	<div class="col-sm-4"></div>
  </div>
</form>
<!-- Modal -->
<div class="modal fade bs-example-modal-xs" id="ModalLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		  
			<br><br><i class="fa fa-spinner fa-spin fa-5x fa-fw"></i><br><br><br>Espere un momento por favor. <br>No cierre ni recargue la ventana.<br><br><br><br>
			
      </div>
    </div>
  </div>
</div> 

<?php include('../../view_footer_solicitud.php')?>
<script>

$(document).ready(function(){
	
			calculaPrecio();
			$('#mensajetarjeta').hide();
            $('#mensajedeposito').hide();
			$("#sendForm").submit(function(){
				$('#ModalLoading').modal('show');
			});
			
			
<?php if(isset($values['RCV']) and $values['RCV']=='SI'):?>
            console.log('eligio si');
            $('.Puestos').show();
            $('.CedulaDiv').show();
            $('.RifDiv').show();
            $('.LicenciaDiv').show();
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').show();
            $('.CertificadoOrigenDiv').show();
<?php endif;?>
<?php if(isset($values['RCV']) and $values['RCV']=='NO'):?>
            console.log('eligio no');
            $('.Puestos').hide();
            $('.CedulaDiv').show();
            $('.RifDiv').show();
            $('.LicenciaDiv').show();
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').hide();
            $('.CertificadoOrigenDiv').hide();
<?php endif;?>
<?php if((!isset($values['RCV'])) or @$values['RCV']==''):?>
            console.log('No eligio nada');
            $('.Puestos').hide();
            $('.LicenciaDiv').hide();
            $('.CedulaDiv').hide();
            $('.RifDiv').hide();
            $('.CarnetCirculacionDiv').hide();
            $('.CertificadoMedicoDiv').hide();
            $('.CertificadoOrigenDiv').hide();
<?php endif;?>
<?php if(isset($values['Clase']) and $values['Clase']=='Moto'):?>
         $('.TIPO').hide();
<?php endif;?>
<?php if(isset($values['Clase']) and $values['Clase']!='Moto'):?>
         $('.TIPO').show();
<?php endif;?>


<?php if(isset($values['MET']) and $values['MET']=='DEP'):?>
         $('.DEPOSITO').show();
		 $('#mensajetarjeta').hide();
                 $('#mensajedeposito').show();
<?php endif;?>
<?php if(isset($values['MET']) and $values['MET']=='TDC'):?>
         $('.DEPOSITO').hide();
		 $('#mensajetarjeta').show();
                 $('#mensajedeposito').hide();
<?php endif;?>
<?php if((!isset($values['MET']))):?>
        $('.DEPOSITO').hide();
<?php endif;?>   
    $('#idPlan').change(function(e){
    calculaPrecio();       
    });
    $('#Clase').change(function(e){
        if($('#Clase').val()=='Moto'){
            $('.TIPO').hide();
        }else{
            $('.TIPO').show();
        }
            
    });
    $('.RCV').change(function(e){
        calculaPrecio();
        if($('.RCV:checked').val() == 'SI'){
            console.log('seleccione si');
            $('.Puestos').show();
            $('.CedulaDiv').show();
            $('.RifDiv').show();
            $('.LicenciaDiv').show();            
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').show();
            $('.CertificadoOrigenDiv').show();
        }else{
            console.log('seleccione no');
            $('.Puestos').hide();
            $('.CedulaDiv').show();
            $('.RifDiv').show();
            $('.LicenciaDiv').show();
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').hide();
            $('.CertificadoOrigenDiv').hide();
        }
        

        
    });
    $('.MET').change(function(e){
        calculaPrecio();
        if($('.MET:checked').val() == 'TDC'){
			console.log($('.MET:checked').val());
			$('#mensajetarjeta').show();
                        $('#mensajedeposito').hide();
        }else{
            console.log($('.MET:checked').val());
            $('#mensajetarjeta').hide();
             $('#mensajedeposito').show();
        }
        

        
    });
    $('#Puestos').change(function(e){
    calculaPrecio();       
    });
    $('.MET').change(function(e){
        if($('.MET:checked').val() == 'DEP'){
            $('.DEPOSITO').show();
        }else{
           
            $('.DEPOSITO').hide();            
        }
        

        
    });    
    
});

	function submitForm(){
		
		$('#ModalLoading').modal('show');
	}
    function calculaPrecio(){
        $.ajax({
        url: '<?php echo full_url?>/pl/planes/index.php',
	data: { action: "precio_plan",id_plan: $('#idPlan').val(), RCV: $('.RCV:checked').val(), Puestos: $('#Puestos').val()},
	success: function(data){
            $('.PlanPrecio').html("<p><b>Total a pagar con IVA:</b> Bs. " + data.precio + ".</p>")
            $('#precio').val(data.precio_sin_formato);
	},
          dataType: 'JSON'
        });        
        
    }

</script>