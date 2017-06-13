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
	<script src="<?php echo full_url;?>/web/js/jquery.js"></script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="<?php echo full_url;?>/web/js/mercadopago.js"></script>
</head>


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



<input type="hidden" id="precio" name="precio" value="<?php if(isset($values['precio']) and $values['precio']!='') echo $values['precio']?>">
<input type="hidden" id="Cedula" name="Cedula" value="<?php if(isset($values['Cedula']) and $values['Cedula']!='') echo $values['Cedula']?>">
<input type="hidden" id="descripcion" name="descripcion" value="<?php if(isset($values['descripcion']) and $values['descripcion']!='') echo $values['descripcion'];else echo "Afiliacion de plan TU/GRUERO WEB";?> <?php if(isset($values['idSolicitudPlan']) and $values['idSolicitudPlan']!='') echo $values['idSolicitudPlan']?>">
<input type="hidden" id="idSolicitudPlan" name="idSolicitudPlan" value="<?php if(isset($values['idSolicitudPlan']) and $values['idSolicitudPlan']!='') echo $values['idSolicitudPlan']?>">
		
		<div class="text-center col-sm-12 mercadopagodiv">
		<label class="titulo_contratacion text-center">
			Proceso de contratación Plan TU/GRUERO®
		</label> 
		<strong>(Parte 2 de 2)</strong>
		</div>
<div class="col-sm-8" id="mercadopagodiv">
    <form action="" method="post" id="pay" name="pay" class="">
	<div class="form-group col-sm-12">
		<p class="subtitulo_planes"><strong>Datos de su Tarjeta de Crédito</strong></p>
	</div>
      <div class="form-group col-sm-12">
		  <label for="cardholderName" class="control-label">Titular</label> <label class="text-danger"> * </label> &nbsp;&nbsp;&nbsp;&nbsp;<small>(Colocar las letras en mayúsculas)</small>

        <div class="">
            <input type="text" required class="form-control" autocomplete="off" id="cardholderName" maxlength="50" data-checkout="cardholderName" maxlength="" value="" Placeholder="Ejemplo: JUAN A ALVAREZ C">
        </div>
      </div>
      <div class="form-group col-sm-4">
        <label for="docType" class="control-label">Tipo de documento</label> <label class="text-danger"> * </label>
        <div class="">
			<select required  id="docType" data-checkout="docType"  data-checkout="docType" class="form-control">
				<option value="CI-V">CI-V</option>
				<option value="CI-E">CI-E</option>
				<option value="RIF-J">RIF-J</option>
				<option value="RIF-P">RIF-P</option>
				<option value="RIF-V">RIF-V</option>
				<option value="RIF-E">RIF-E</option>
				<option value="RIF-G">RIF-G</option>
				<option value="PASAPORTE">PASAPORTE</option>
			</select>    
        </div>
      </div>
      <div class="form-group col-sm-8">
        <label for="Apellidos" class="control-label">Número de documento</label> <label class="text-danger"> * </label> (12345678)
        <div class="">
            <input required type="text" class="form-control" autocomplete="off" data-checkout="docNumber" id="docNumber" maxlength="8" value="" placeholder="Ejemplo: 12345678"> 
        </div>
      </div>
      <div class="form-group col-sm-12">
        <label for="email" class="control-label">Correo electrónico</label> <label class="text-danger"> * </label>
        <div class="">
            <input required type="text" class="form-control" autocomplete="off" id="email" maxlength="" value="<?php if(isset($values['Correo']) and $values['Correo']!='') echo $values['Correo'];?>" placeholder="Ejemplo: correo@gmail.com">
        </div>
      </div>
      <div class="form-group col-sm-8">
        <label for="cardNumber" class="control-label">Número de tarjeta</label> <label class="text-danger"> * </label>
        <div class="">
            <input required type="text" class="form-control" autocomplete="off" data-checkout="cardNumber" id="cardNumber" maxlength="16" value=""  placeholder="Ejemplo: 4966382331109310">
        </div>
      </div>
      <div class="form-group col-sm-4">
          <label for="securityCode" class="control-label">Código de seguridad</label> <label class="text-danger"> * </label> 
        <div class="">
            <input required type="text" class="form-control" data-checkout="securityCode" autocomplete="off" id="securityCode" maxlength="3" value="" placeholder="Ejemplo: 123">
            <small style="cursor: pointer;"><a id="codigoseguridad" data-toggle="modal" data-target="#myModal5">¿Cuál es el código de seguridad?</a></small>
        </div>
      </div>
      <div class="form-group col-sm-6">
        <label for="cardExpirationYear" class="control-label">Año de vencimiento</label> <label class="text-danger"> * </label>
        <div class="">
            <select required id="cardExpirationYear" data-checkout="cardExpirationYear" class="form-control">
                    <?php for($anio = (date('Y')); $anio<=date('Y')+10; $anio++):?>
                        <option value="<?php echo $anio?>" ><?php echo $anio?></option>    
                    <?php endfor;?>

            </select>
        </div>
      </div>
      <div class="form-group col-sm-6">
        <label for="cardExpirationMonth" class="control-label">Mes de vencimiento</label> <label class="text-danger"> * </label>
        <div class="">
            <select required id="cardExpirationMonth" data-checkout="cardExpirationMonth" class="form-control">
                                                                    <option value="01">01</option>
                                                                    <option value="02">02</option>
                                                                    <option value="03">03</option>
                                                                    <option value="04">04</option>
                                                                    <option value="05">05</option>
                                                                    <option value="06">06</option>
                                                                    <option value="07">07</option>
                                                                    <option value="08">08</option>
                                                                    <option value="09">09</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>

            </select>
        </div>
      </div>
        <?php if(isset($values['precio']) and $values['precio']!=''):?>
        <div class="col-sm-12">
            <p><b>Total a pagar:</b> <?php echo "Bs. ".number_format($values['precio'],2,",",".").".";?></p>
        </div>
        <?php endif;?>
        <div id="show_error"></div>
        <div id="show_commit"></div>
        <input type="submit" class="btn btn-success" value="Procesar Pago" />
    </form>        
</div>
<div class="col-sm-12" id="mercadopagodivpagado"></div>

<!-- Modal -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-footer">
          <div class="text-center">
              <img class="img-responsive" src="<?php echo full_url?>/web/img/fresh/medios_pagos/codigo_seguridad.jpg">
          </div>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-xs" id="ModalLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		  
			<br><br><i class="fa fa-spinner fa-spin fa-5x fa-fw"></i><br><br><br>Espere un momento por favor. <br>No cierre ni recargue la ventana.<br><br><br><br>
			
      </div>
    </div>
  </div>
</div>   
<?php include('../../view_footer_solicitud.php');?>

<script>
    /*$("#codigoseguridad").click(function(){
       
    });*/
    
</script>