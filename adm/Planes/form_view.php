<?php include('../../view_header_admin.php')?>
<?php $Marcas = new Marcas(); $marcas_list = $Marcas->getMarcasListSelect();?>
<?php $SolicitudDocumentos = new SolicitudDocumentos();?>
<?php $SolicitudPagoDetalle = new SolicitudPagoDetalle();?>
<?php $SolicitudAprobada = new SolicitudAprobada();?>
<?php $Utilitarios  = new Utilitarios();?>

<?php $Estados = new Estados(); $list_estados = $Estados->getEstadosListSelect()?>
<?php 
$disabled = '';
$disabled_plan = '';
$isAprobada = false;
$input_type = '';
$hidden = '';

?>
<?php if(isset($values['Estatus']) and $values['Estatus']!='ENV'):?>
    <?php $disabled = ' disabled = "disabled" '?>
	<?php $input_type = "hidden" ?>
<?php endif;?>
<?php if(isset($values['action']) and $values['action']=='add'):?>
    <?php $disabled = ''?>
	<?php $input_type = "text"; ?>
	<?php $hidden = "hidden";?>
<?php endif;?>
<?php if(isset($values['action']) and $values['action']!='add' and (isset($values['Estatus']) and $values['Estatus']=='ENV')):?>
    <?php $disabled_plan = ' disabled = "disabled" '?>
	<?php $hidden = "hidden";?>
<?php endif;?>

<?php if(isset($values['idSolicitudPlan']) and $values['idSolicitudPlan']!=''):?>
    <?php $isAprobada = $SolicitudAprobada->isAprobada($values['idSolicitudPlan']);?>
<?php endif;?>




<div class="form-group col-sm-12">
<h1 align="center">Solicitud de planes</h1>
<form class="" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="action" name="action" value="<?php echo $values['action']?>">
    <input type="hidden" id="idSolicitudPlan" name="idSolicitudPlan" value="<?php if(isset($values['idSolicitudPlan']))echo $values['idSolicitudPlan']?>">
    <input type="hidden" id="IdV" name="IdV" value="<?php if(isset($values['IdV']))echo $values['IdV']?>">
    <input type="hidden" id="precio" name="precio" value="<?php if(isset($values['precio']))echo $values['precio']?>">
    <?php if(isset($values['action']) and $values['action']!='add'):?>
    <div class="form-group col-sm-12 text-right PlanPrecio">
      <p><b>Total a pagar con IVA:</b> <?php if(isset($values['precio']) and $values['precio']!='') echo "Bs. ".number_format($values['precio'],2,",",".")."."; else echo " Bs. 0,00"?></p>
    </div>
    <?php endif;?>
    <div class="form-group col-sm-12 text-left <?php echo $hidden;?>">
      <p><b>Solicitado desde:</b> <?php if(isset($values['NombreVendedor']) and $values['NombreVendedor']!='') echo $values['NombreVendedor']; ?></p>
  </div>
<?php if($isAprobada == true):?>
<?php $datos_aprobacion = $SolicitudAprobada->getSolicitudAprobada($values['idSolicitudPlan'])?>
<div class="form-group col-sm-3">
     <label>Producto Tu Gruero # </label> <?php echo $datos_aprobacion['NumProducto'];?>

</div>
<div class="form-group col-sm-3">
     <label>Producto RCV # </label> <?php echo $datos_aprobacion['PolizaAsistir'];?>

</div>
<div class="form-group col-sm-2">
     <label>Fecha aprobación</label> <?php echo $datos_aprobacion['FechaAprobacion'];?>
</div>
<div class="form-group col-sm-2">
     <label>Vigencia desde</label> <?php echo $datos_aprobacion['VigenciaDesde'];?>
</div>
<div class="form-group col-sm-2">
     <label>Vigencia hasta</label> <?php echo $datos_aprobacion['VigenciaHasta'];?>

</div>
<?php endif;?>

  <div class="form-group col-sm-12">
	  <label for="idPlan" class="">Plan </label> <label class="text-danger"> * </label>
    <div class="">
        <select <?php echo $disabled;?> <?php echo $disabled_plan;?> class="form-control" id="idPlan" name="idPlan">
            <option value="">Seleccione el plan</option>
            <option value="2" <?php if(isset($values['idPlan']) and $values['idPlan']==2) echo "selected='selected'";?>>TU GRUERO GOLD</option>
            <option value="1" <?php if(isset($values['idPlan']) and $values['idPlan']==1) echo "selected='selected'";?>>TU GRUERO PLUS</option>
        </select>
    </div>
        <?php if(isset($errors['idPlan']) and $errors['idPlan']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['idPlan'];?></div>

        <?php endif;?> 
  </div> 	
  <div class="form-group col-sm-3">
    <label for="Cedula" class="control-label">Cédula</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Cedula" class="form-control" autocomplete="off" id="Cedula" maxlength="10" value="<?php if(isset($values['Cedula']) and $values['Cedula']!='') echo $values['Cedula'];?>" placeholder="Ejemplo: V-12345678">
    </div>
    
        <?php if(isset($errors['Cedula']) and $errors['Cedula']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Cedula'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-3">
    <label for="Rif" class=" control-label">RIF</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Rif" class="form-control" maxlength="11" autocomplete="off" value="<?php if(isset($values['Rif']) and $values['Rif']!='') echo $values['Rif'];?>" id="Rif" placeholder="Ejemplo: V-123456781">
    </div>
        <?php if(isset($errors['Rif']) and $errors['Rif']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Rif'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-3">
    <label for="Nombres" class="control-label">Nombres</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Nombres" class="form-control" autocomplete="off" maxlength="50" id="Nombres" value="<?php if(isset($values['Nombres']) and $values['Nombres']!='') echo $values['Nombres'];?>" placeholder="Ejemplo: Juan José">
    </div>
        <?php if(isset($errors['Nombres']) and $errors['Nombres']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Nombres'];?></div>
        <?php endif;?>
  </div>
  <div class="form-group col-sm-3">
    <label for="Apellidos" class="2 control-label">Apellidos</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Apellidos" class="form-control" autocomplete="off" maxlength="50" id="Apellidos" value="<?php if(isset($values['Apellidos']) and $values['Apellidos']!='') echo $values['Apellidos'];?>"  placeholder="Ejemplo: Alvarez Pérez">
    </div>
        <?php if(isset($errors['Apellidos']) and$errors['Apellidos']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Apellidos'];?></div>

        <?php endif;?>
  </div>
        <div class="form-group col-sm-3">
          <label for="RCV" class="control-label">Sexo</label> <label class="text-danger"> * </label>
          <div class="">
          <label class="radio-inline">
            <input type="radio" <?php echo $disabled;?> name="Sexo" class="Sexo" value="Masculino" <?php if(isset($values['Sexo']) and $values['Sexo']=='Masculino') echo "checked='checked'";?>> Masculino
          </label>
          <label class="radio-inline">
            <input type="radio" <?php echo $disabled;?> name="Sexo" class="Sexo" value="Femenino" <?php if(isset($values['Sexo']) and $values['Sexo']=='Femenino') echo "checked='checked'";?>> Femenino
          </label>
          </div>
              <?php if(isset($errors['Sexo']) and $errors['Sexo']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Sexo'];?></div>

              <?php endif;?>
        </div>
        <div class="form-group col-sm-3">
          <label for="EstadoCivil" class="control-label">Estado Civil</label> <label class="text-danger"> * </label>
          <div class="">
                <select name="EstadoCivil" <?php echo $disabled;?> class="form-control" id="EstadoCivil">
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
    <label for="FechaNacimiento" class="2 control-label">Fecha de nacimiento</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="FechaNacimiento" id="FechaNacimiento" class="form-control" autocomplete="off" maxlength="10" id="" value="<?php if(isset($values['FechaNacimiento']) and $values['FechaNacimiento']!='') echo $values['FechaNacimiento'];?>"  placeholder="Ejemplo: 01/01/1980">
    </div>
        <?php if(isset($errors['FechaNacimiento']) and$errors['FechaNacimiento']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['FechaNacimiento'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-3">
    <label for="Correo" class="control-label">Correo electrónico</label> <label class="text-danger"> * </label>
    <div class="">
      <input <?php echo $disabled;?> type="email" class="form-control" name="Correo" autocomplete="off" id="Correo" maxlength="100" value="<?php if(isset($values['Correo']) and $values['Correo']!='') echo $values['Correo'];?>" placeholder="Ejemplo: correo@gmail.com">
    </div>
        <?php if(isset($errors['Correo']) and $errors['Correo']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Correo'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-3">
    <label for="Telefono" class="control-label">Teléfono de habitación</label> <label class="text-danger"></label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Telefono" class="form-control" autocomplete="off" id="Telefono" maxlength="11" value="<?php if(isset($values['Telefono']) and $values['Telefono']!='') echo $values['Telefono'];?>" placeholder="Ejemplo: 02121234567">
    </div>
        <?php if(isset($errors['Telefono']) and $errors['Telefono']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Telefono'];?></div>

        <?php endif;?>
  </div> 
  <div class="form-group col-sm-3">
    <label for="Celular" class="control-label">Celular</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Celular" class="form-control" autocomplete="off" id="Celular" maxlength="11" value="<?php if(isset($values['Celular']) and $values['Celular']!='') echo $values['Celular'];?>" placeholder="Ejemplo: 04141234567">
    </div>
        <?php if(isset($errors['Celular']) and $errors['Celular']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Celular'];?></div>

        <?php endif;?>
  </div>
    <div class=""> 
        <div class="form-group col-sm-3">
          <label for="Estado" class="control-label">Estado</label> <label class="text-danger"> * </label>
          <div class="">
            <select <?php echo $disabled;?> name="Estado" class="form-control" id="Estado">
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
              <input type="text" <?php echo $disabled;?> name="Ciudad" class="form-control" id="Ciudad" value="<?php if(isset($values['Ciudad']) and $values['Ciudad']!='') echo $values['Ciudad'];?>" />
          </div>
              <?php if(isset($errors['Ciudad']) and $errors['Ciudad']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Ciudad'];?></div>

              <?php endif;?>
        </div>
        
        <div class="form-group col-sm-12">
          <label for="Domicilio" class="control-label">Dirección de domicilio</label> <label class="text-danger"> * </label>
          <div class="">
              <textarea <?php echo $disabled;?> name="Domicilio" class="form-control"id="Domicilio"><?php if(isset($values['Domicilio']) and $values['Domicilio']!='') echo $values['Domicilio'];?></textarea>
          </div>
              <?php if(isset($errors['Domicilio']) and $errors['Domicilio']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['Domicilio'];?></div>

              <?php endif;?>
        </div>
    </div> 
        <div class="form-group col-sm-12">
          <label for="RCV" class="control-label">¿Opción de RCV?</label> <label class="text-danger"> * </label>
          <div class="">
          <label class="radio-inline">
            <input <?php echo $disabled?> <?php echo $disabled_plan;?> type="radio" name="RCV" class="RCV" value="SI" <?php if(isset($values['RCV']) and $values['RCV']=='SI') echo "checked='checked'";?>> Si
          </label>
          <label class="radio-inline">
            <input <?php echo $disabled?> <?php echo $disabled_plan;?> type="radio" name="RCV" class="RCV" value="NO" <?php if(isset($values['RCV']) and $values['RCV']=='NO') echo "checked='checked'";?>> No
          </label>
          </div>
              <?php if(isset($errors['RCV']) and $errors['RCV']!=''):?>
              <div id="" class="alert alert-danger"><?php echo $errors['RCV'];?></div>

              <?php endif;?>
        </div>
  <div class="form-group col-sm-12 RCV_SI CedulaDiv">
      <label for="CedulaDoc" class="control-label">Cédula</label> <label class="text-danger"> * </label> 
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "Cedula"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="CedulaDoc" class="form-control "  id="CedulaDoc" accept="application/pdf,image/x-png,image/gif,image/jpeg">
        
    </div>
        <?php if(isset($errors['CedulaDoc']) and $errors['CedulaDoc']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CedulaDoc'];?></div>

        <?php endif;?>
  </div>
  <!--<div class="form-group col-sm-12 RCV_SI RifDiv">
    <label for="RifDoc" class="control-label">Rif</label> <label class="text-danger"> * </label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "Rif"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="RifDoc" class="form-control "  id="RifDoc" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['RifDoc']) and $errors['RifDoc']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['RifDoc'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 RCV_SI LicenciaDiv">
    <label for="Licencia" class="control-label">Licencia</label> <label class="text-danger"> * </label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "Licencia"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="Licencia" class="form-control "  id="Licencia" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['Licencia']) and $errors['Licencia']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Licencia'];?></div>

        <?php endif;?>
  </div>-->
  <div class="form-group col-sm-12 CarnetCirculacionDiv">
    <label for="CarnetCirculacion" class="control-label">Carnet de circulación</label> <label class="text-danger"> * </label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "CarnetCirculacion"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="CarnetCirculacion" class="form-control " id="CarnetCirculacion" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['CarnetCirculacion']) and $errors['CarnetCirculacion']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CarnetCirculacion'];?></div>

        <?php endif;?>
  </div>
  <!--<div class="form-group col-sm-12 CertificadoMedicoDiv">
    <label for="inputEmail3" class="control-label">Certificado médico</label> <label class="text-danger"> * </label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "CertificadoMedico"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="CertificadoMedico" class="form-control " id="CertificadoMedico" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['CertificadoMedico']) and $errors['CertificadoMedico']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CertificadoMedico'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 CertificadoOrigenDiv">
    <label for="certificadoOrigen" class="control-label">Certificado de origen del vehículo (Título de propiedad)</label> <label class="text-danger"> * </label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "CertificadoOrigen"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="CertificadoOrigen" class="form-control" id="CertificadoOrigen" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
    <?php if(isset($errors['CertificadoOrigen']) and $errors['CertificadoOrigen']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CertificadoOrigen'];?></div>

        <?php endif;?>
  </div>-->
        <div class="form-group col-sm-12">
          <label for="Clase" class="control-label">Clase</label> <label class="text-danger"> * </label>
          <div class="">
                <select <?php echo $disabled;?> name="Clase" class="form-control" id="Clase">
                    <option value="">Seleccione...</option> 
                    <option value="Automóvil" <?php if(isset($values['Clase']) and $values['Clase']=='Automóvil') echo "selected = 'selected'"?> >Automóvil</option>                   
                    <option value="Camioneta" <?php if(isset($values['Clase']) and $values['Clase']=='Camioneta') echo "selected = 'selected'"?> >Camioneta</option>                   
                    <option value="Moto" <?php if(isset($values['Clase']) and $values['Clase']=='Moto') echo "selected = 'selected'"?> >Moto</option>                   
                    <option value="Rústico" <?php if(isset($values['Clase']) and $values['Clase']=='Rústico') echo "selected = 'selected'"?> >Rústico</option>                   
                </select> 
          </div>
        <?php if(isset($errors['Clase']) and $errors['Clase']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Clase'];?></div>

        <?php endif;?>
        </div>
  <div class="form-group col-sm-2">
    <label for="Marca" class="control-label">Marca</label> <label class="text-danger"> * </label>
    <div class="">
        <select <?php echo $disabled;?> name="Marca" id="Marca" class="form-control">
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
        <input <?php echo $disabled;?> type="text" name="Modelo" class="form-control" autocomplete="off" id="Modelo" maxlength="20" value="<?php if(isset($values['Modelo']) and $values['Modelo']!='') echo $values['Modelo'];?>" placeholder="Ejemplo: AVEO">
    </div>
        <?php if(isset($errors['Modelo']) and $errors['Modelo']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Modelo'];?></div>

        <?php endif;?>
  </div> 
        <div class="form-group col-sm-2 TIPO">
          <label for="Tipo" class="control-label">Tipo</label> <label class="text-danger"> * </label>
          <div class="">
                <select <?php echo $disabled;?> name="Tipo" class="form-control" id="Tipo">
                    <option value="">Seleccione...</option> 
                    <option value="Coupé" <?php if(isset($values['Tipo']) and $values['Tipo']=='Coupé') echo "selected = 'selected'"?> >Coupé</option>                   
                    <option value="Cross Over" <?php if(isset($values['Tipo']) and $values['Tipo']=='Cross Over') echo "selected = 'selected'"?> >Cross Over</option>                   
                    <option value="Hatchback" <?php if(isset($values['Tipo']) and $values['Tipo']=='Hatchback') echo "selected = 'selected'"?> >Hatchback</option>                   
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
        <select <?php echo $disabled;?> name="Anio" id="Anio" class="form-control">
                    <option value="">Seleccione...</option>

                <?php for($anio = (date('Y')-27); $anio<=date('Y'); $anio++):?>
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
        <input <?php echo $disabled;?> type="text" name="Color" class="form-control" id="Color" autocomplete="off" maxlength="20" value="<?php if(isset($values['Color']) and $values['Color']!='') echo $values['Color'];?>" placeholder="Ejemplo: Azul">
    </div>
        <?php if(isset($errors['Color']) and $errors['Color']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Color'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-2">
    <label for="Telefono" class="control-label">Placa</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="text" name="Placa" class="form-control" id="Placa" autocomplete="off" maxlength="7" value="<?php if(isset($values['Placa']) and $values['Placa']!='') echo $values['Placa'];?>" placeholder="Ejemplo: AAABBB">
    </div>
        <?php if(isset($errors['Placa']) and $errors['Placa']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Placa'];?></div>

        <?php endif;?>
  </div> 
  <div class="form-group col-sm-2 Puestos">
    <label for="Puestos" class="control-label">Cantidad de puestos</label> <label class="text-danger"> * </label>
    <div class="">
        <input <?php echo $disabled;?> type="number" name="Puestos" class="form-control" id="Puestos" autocomplete="off" maxlength="1" value="<?php if(isset($values['Puestos']) and $values['Puestos']!='') echo $values['Puestos']; else echo "5";?>" min="5" max="7">
    </div>
        <?php if(isset($errors['Puestos']) and $errors['Puestos']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Puestos'];?></div>

        <?php endif;?>
  </div>
	<div class="row">
		
	</div>
  <div class="form-group col-sm-6">
    <label for="SerialMotor" class="control-label">Serial de motor</label> <label class="text-danger">  </label>
    <div class="">
        <input <?php echo $disabled;?>  type="text" name="SerialMotor" class="form-control" id="SerialMotor" autocomplete="off" maxlength="50" value="<?php if(isset($values['SerialMotor']) and $values['SerialMotor']!='') echo $values['SerialMotor'];?>">
    </div>
        <?php if(isset($errors['SerialMotor']) and $errors['SerialMotor']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['SerialMotor'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-6">
    <label for="SerialCarroceria" class="control-label">Serial de carrocería</label> <label class="text-danger">  </label>
    <div class="">
        <input <?php echo $disabled;?>  type="text" name="SerialCarroceria" class="form-control" id="SerialCarroceria" autocomplete="off" maxlength="50" value="<?php if(isset($values['SerialCarroceria']) and $values['SerialCarroceria']!='') echo $values['SerialCarroceria'];?>">
    </div>
        <?php if(isset($errors['SerialCarroceria']) and $errors['SerialCarroceria']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['SerialCarroceria'];?></div>

        <?php endif;?>
  </div> 
  <div class="form-group col-sm-6">
      <label for="SerialMotor" class="control-label">Kilometraje</label> <label class="text-danger">  </label> <small> MAX 50 KM</small>
    <div class="">
        <input <?php echo $disabled;?>  type="text" name="Kilometraje" class="form-control" id="Kilometraje" autocomplete="off" maxlength="50" value="<?php if(isset($values['Kilometraje']) and $values['Kilometraje']!='') echo $values['Kilometraje'];?>">
    </div>
        <?php if(isset($errors['Kilometraje']) and $errors['Kilometraje']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['Kilometraje'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-6">
    <label for="CantidadServicios" class="control-label">Cantidad de servicios</label> <label class="text-danger">  </label> <small> ILIMITADO URBANO (*) Y UNO (01) EXTRAURBANO (*)</small>
    <div class="">
        <input <?php echo $disabled;?>  type="text" name="CantidadServicios" class="form-control" id="CantidadServicios" autocomplete="off" maxlength="50" value="<?php if(isset($values['CantidadServicios']) and $values['CantidadServicios']!='') echo $values['CantidadServicios'];?>">
    </div>
        <?php if(isset($errors['CantidadServicios']) and $errors['CantidadServicios']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['CantidadServicios'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12">
    <label for="inputEmail3" class="control-label">Método de pago</label> <label class="text-danger"> * </label>
    <div class="">
    <label class="radio-inline">
      <input <?php echo $disabled_plan?>  <?php echo $disabled;?> type="radio" name="MET" class="MET" value="TDC" <?php if(isset($values['MET']) and $values['MET']=='TDC') echo "checked='checked'";?>>Tarjeta de crédito
    </label>
    <label class="radio-inline">
      <input <?php echo $disabled_plan?> <?php echo $disabled;?>  type="radio" name="MET" class="MET" value="DEP" <?php if(isset($values['MET']) and $values['MET']=='DEP') echo "checked='checked'";?>> Depósito o transferencia
    </label>
    </div>
        <?php if(isset($errors['MET']) and $errors['MET']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['MET'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 DEPOSITO">
    <label for="DEP1" class="control-label">Comprobante #1 </label> <label class="text-danger"> * </label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "DEP1"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="DEP1" class="form-control" id="DEP1" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['DEP1']) and $errors['DEP1']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['DEP1'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 DEPOSITO">
    <label for="DEP2" class="control-label">Comprobante #2</label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "DEP2"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="DEP2" class="form-control " id="DEP2" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['DEP2']) and $errors['DEP2']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['DEP2'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-12 DEPOSITO">
    <label for="DEP3" class="control-label">Comprobante #3</label>
      <?php $NombreDocumento = $SolicitudDocumentos->getDocumentoByTipo($values['idSolicitudPlan'], "DEP3"); ?>
      <?php if($NombreDocumento !=""):?>
        <a class="" target="_blank" href="<?php echo full_url?>/web/files/Solicitudes/<?php echo $NombreDocumento;?>">
            <i class="fa fa-eye alert alert-success" aria-hidden="true"> Descargar/Ver</i>
        </a>
      <?php endif;?>
    <div class="">
        <input <?php echo $disabled;?> type="file" name="DEP3" class="form-control " id="DEP3" accept="application/pdf,image/x-png,image/gif,image/jpeg">
    </div>
        <?php if(isset($errors['DEP3']) and $errors['DEP3']!=''):?>
        <div class="alert alert-danger"><?php echo $errors['DEP3'];?></div>

        <?php endif;?>
  </div>
  <div class="form-group col-sm-6">
	  <label for="idPlan" class="">Precio plan Tugruero</label> <label class="text-danger"> * </label>
    <div class="">
            <input type="text" <?php echo $disabled;?> <?php echo $disabled_plan;?> id="precio_tugruero" name="precio_tugruero" value="<?php if(isset($values['precio_tugruero']))echo $values['precio_tugruero']?>">

    </div>
        <?php if(isset($errors['precio_tugruero']) and $errors['precio_tugruero']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['precio_tugruero'];?></div>

        <?php endif;?> 
  </div>
  <div class="form-group col-sm-6">
	  <label for="idPlan" class="">Precio plan RCV </label> <label class="text-danger"> * </label>
    <div class="">
		<input type="text" readonly="" <?php echo $disabled;?> <?php echo $disabled_plan;?> id="precio_rcv" name="precio_rcv" value="<?php if(isset($values['precio_rcv']))echo $values['precio_rcv']?>">

    </div>
        <?php if(isset($errors['precio_rcv']) and $errors['precio_rcv']!=''):?>
        <div id="" class="alert alert-danger"><?php echo $errors['precio_rcv'];?></div>

        <?php endif;?> 
  </div>   
  <?php if(isset($values['action']) and $values['action']=='add'):?>

    <div class="form-group col-sm-12" id="mercadopago">
        <div class="row">
            <p class="subtitulo_planes"><strong>Datos de mercadopago</strong></p>
        </div>
      <div class="form-group col-sm-2">
        <label for="id" class="control-label">Id</label> <label class="text-danger"> * </label>
        <div class="">
            <input <?php echo $disabled;?> type="text" name="id" class="form-control" autocomplete="off" id="id" maxlength="20" value="<?php if(isset($values['id']) and $values['id']!='') echo $values['id'];?>" placeholder="">
        </div>
            <?php if(isset($errors['id']) and $errors['id']!=''):?>
            <div id="" class="alert alert-danger"><?php echo $errors['id'];?></div>

            <?php endif;?>
        </div>
      <div class="form-group col-sm-2">
        <label for="id" class="control-label">Tipo de tarjeta:</label> <label class="text-danger"> * </label>
        <div class="">
            <select class="form-control" name="payment_method_id">
                <option value="visa" <?php if(isset($values['payment_method_id']) and $values['payment_method_id'] =='visa') echo "selected='selected'"?>>Visa</option>
                <option value="mastercard" <?php if(isset($values['payment_method_id']) and $values['payment_method_id'] =='mastercard') echo "selected='selected'"?>>Mastercard</option>
            </select>
        </div>
            <?php if(isset($errors['payment_method_id']) and $errors['payment_method_id']!=''):?>
            <div id="" class="alert alert-danger"><?php echo $errors['payment_method_id'];?></div>

            <?php endif;?>
        </div> 
      <div class="form-group col-sm-3">
        <label for="id" class="control-label">Cédula:</label> <label class="text-danger"> * </label> <small> &nbsp;&nbsp;&nbsp;&nbsp;(V-12345678) </small>
        <div class="">
            <input <?php echo $disabled;?> type="text" name="payer_identification_number" class="form-control" autocomplete="off" id="payer_identification_number" maxlength="20" value="<?php if(isset($values['payer_identification_number']) and $values['payer_identification_number']!='') echo $values['payer_identification_number'];?>" placeholder="">
        </div>
            <?php if(isset($errors['payer_identification_number']) and $errors['payer_identification_number']!=''):?>
            <div id="" class="alert alert-danger"><?php echo $errors['payer_identification_number'];?></div>

            <?php endif;?>
        </div> 
      <div class="form-group col-sm-3">
          <label for="id" class="control-label">Nombre en tarjeta</label><label class="text-danger"> * </label><small> &nbsp;&nbsp;&nbsp;&nbsp;(JOSE A PEREZ C) </small>
        <div class="">
            <input <?php echo $disabled;?> type="text" name="carholder_name" class="form-control" autocomplete="off" id="carholder_name" maxlength="20" value="<?php if(isset($values['carholder_name']) and $values['carholder_name']!='') echo $values['carholder_name'];?>" placeholder=""> 
        </div>
            <?php if(isset($errors['carholder_name']) and $errors['carholder_name']!=''):?>
            <div id="" class="alert alert-danger"><?php echo $errors['carholder_name'];?></div>

            <?php endif;?>
        </div>
      <div class="form-group col-sm-2">
        <label for="id" class="control-label">Monto</label>  <label class="text-danger"> * </label> <small> &nbsp;&nbsp;&nbsp;&nbsp;(5932.9) </small>
        <div class="">
            <input <?php echo $disabled;?> type="text" id="transaction_amount"  name="transaction_amount" class="form-control" autocomplete="off"  maxlength="20" value="<?php if(isset($values['transaction_amount']) and $values['transaction_amount']!='') echo $values['transaction_amount'];?>" placeholder="">
        </div>
            <?php if(isset($errors['transaction_amount']) and $errors['transaction_amount']!=''):?>
            <div id="" class="alert alert-danger"><?php echo $errors['transaction_amount'];?></div>

            <?php endif;?>
        </div>
    </div>
  <?php endif;?>
<?php if(isset($values['MET']) and $values['MET']=='TDC' and $values['action']!='add'):?>
	<?php $mercadopagodata = $SolicitudPagoDetalle->getPagoDetalleByID($values['idSolicitudPlan']);?>
    <div class="form-group col-sm-12">
		<label>Detalle de Mercadopago</label>
    </div>
   
    <div class="form-group col-sm-12">
		<label>Id: </label>
		<?php echo $mercadopagodata['id'];?>
		<label>Tipo de tarjeta: </label>
		<?php echo $mercadopagodata['payment_method_id'];?>
		<label>Cédula: </label>
		<?php echo $mercadopagodata['payer_identification_type'];?> <?php echo $mercadopagodata['payer_identification_number'];?>
		<label>Nombre en tarjeta: </label>
		<?php echo $mercadopagodata['carholder_name'];?>
		<label>Monto de la transacción: </label>
		<?php echo $mercadopagodata['transaction_amount'];?>
		<label>Estatus: </label>
		<?php echo $mercadopagodata['status'];?>
    </div>	

<?php endif;?>
</div>

  
    
         
<div id="aprobacion" class="col-sm-12 well-lg" >
    <div id="" class="col-sm-3">

    </div>
    <div id="" class="col-sm-8 col-md-6" style="background-color:#ccc;">
        <h2>Aprobar solicitud</h2>
        <label>Vigencia desde</label><input type="text" value="" name="VigenciaDesde" id="VigenciaDesde">
        <label>Vigencia hasta</label><input type="text" value="" name="VigenciaHasta" id="VigenciaHasta">
        <button type="button" class="btn btn-info" id="btn-aprobar"><i class="fa fa-check-circle"></i> Aprobar</button>
    </div>
    <div id="" class="col-sm-3">

    </div>    
</div>
<div id="rechazo" class="col-sm-12 well-lg">
    <div id="" class="col-sm-3">

    </div>
    <div id="" class="col-sm-6" style="background-color:#ccc;">
        <h2>Rechazar solicitud</h2>
        <label>Motivo de rechazo</label><textarea name="Observacion" cols="50" id="Observacion"></textarea>
        <button type="button" class="btn btn-danger" id="btn-rechazar"><i class="fa fa-times-circle"></i> Rechazar</button>
    </div>
    <div id="" class="col-sm-3">

    </div>    
</div>

<div class="form-group col-sm-12">
    <a class="btn btn-default" href="<?php echo full_url?>/adm/Planes/index.php">Regresar</a> 
    <?php if((isset($values['action']) and $values['action']=='add')):?>
	<button class="btn btn-success" type="submit">Aceptar</button>  
	<?php endif;?>	
	<?php if((isset($values['Estatus']) and $values['Estatus']=='ENV')):?>
    <button class="btn btn-success" type="submit">Aceptar</button>    
    <button class="btn btn-info" type="button" id="aprobar"><i class="fa fa-check-circle"></i> Aprobar</button>  
    <button class="btn btn-danger" type="button" id="rechazar"><i class="fa fa-times-circle"></i> Rechazar</button>  
    <?php endif;?>
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

<?php include('../../view_footer_admin.php')?>
<script>

$(document).ready(function(){
    
$('#aprobacion').hide();    
$('#rechazo').hide();       
<?php if(isset($values['RCV']) and $values['RCV']=='SI'):?>
            console.log('eligio si');
            $('.Puestos').show();
            $('.LicenciaDiv').show();
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').show();
            $('.CertificadoOrigenDiv').show();
<?php endif;?>
<?php if(isset($values['RCV']) and $values['RCV']=='NO'):?>
            console.log('eligio no');
            $('.Puestos').hide();
            $('.LicenciaDiv').show();
            $('.CedulaDiv').show();
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
         $('#mercadopago').hide();
<?php endif;?>
<?php if(isset($values['MET']) and $values['MET']=='TDC'):?>
         $('.DEPOSITO').hide();
         $('#mercadopago').show();
<?php endif;?>
<?php if((!isset($values['MET']))):?>
        $('.DEPOSITO').hide();
        $('#mercadopago').hide();
<?php endif;?>   

    $('#idPlan').change(function(e){
    calculaPrecioTugruero();       
    });
    $('#Clase').change(function(e){
        if($('#Clase').val()=='Moto'){
            $('.TIPO').hide();
        }else{
            $('.TIPO').show();
        }
            
    });

    $('.RCV').change(function(e){
        calculaPrecioRcv();
        if($('.RCV:checked').val() == 'SI'){
            //console.log('seleccione si');
            $('.Puestos').show();
            $('.CedulaDiv').show();
            $('.RifDiv').show();
            $('.LicenciaDiv').show();
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').show();
            $('.CertificadoOrigenDiv').show();
        }else{
            //console.log('seleccione no');
            $('.Puestos').hide();
            $('.CedulaDiv').show();
            $('.RifDiv').show();
            $('.LicenciaDiv').show();
            $('.CarnetCirculacionDiv').show();
            $('.CertificadoMedicoDiv').hide();
            $('.CertificadoOrigenDiv').hide();
        }
        

        
    });
    $('#Puestos').change(function(e){
    calculaPrecioRcv();
    });
    $('.MET').change(function(e){
        if($('.MET:checked').val() == 'DEP'){
            $('.DEPOSITO').show();
            $('#mercadopago').hide();
        }else{
           
            $('.DEPOSITO').hide();
            $('#mercadopago').show();
        }
        

        
    });    
    $('#aprobar').click(function(){
       $('#aprobacion').show(); 
       $('#rechazo').hide(); 
    });
    $('#rechazar').click(function(){
       $('#rechazo').show();
       $('#aprobacion').hide();
    });
    $('#btn-rechazar').click(function(){
        
        
        
        if(confirm('¿Está seguro(a) de rechazar la solicitud?')){
            $.ajax({
            type: "POST",
            url: '<?php echo full_url?>/adm/Planes/index.php?action=rechazar',
            data: {idSolicitudPlan: $('#idSolicitudPlan').val(),Observacion: $('#Observacion').val() },
            success: function(){
                alert('Solicitud Rechazada');
                window.location.href = '<?php echo full_url?>/adm/Planes?action=edit&idSolicitudPlan=' + $('#idSolicitudPlan').val();
            }
          });
            
        }
    });    
    $('#btn-aprobar').click(function(){
        if($('#VigenciaDesde').val() == '' || $('#VigenciaHasta').val() == ''){
            alert('Debe indicar la vigencia ');
            return false;
        }
        if($('.RCV:checked').val() == 'SI'){
            if($('#SerialMotor').val() == ''){
                alert('Debe indicar el serial de motor ');
                return false;
            }
            if($('#SerialCarroceria').val() == ''){
                alert('Debe indicar el serial de carroceria ');
                return false;
            }
        }
        if(confirm('¿Está seguro(a) de aprobar la solicitud?')){
            $('#ModalLoading').modal('show');
            $.ajax({
            type: "POST",
            url: '<?php echo full_url?>/adm/Planes/index.php?action=aprobar',
            data: {idSolicitudPlan: $('#idSolicitudPlan').val(),VigenciaDesde: $('#VigenciaDesde').val(),VigenciaHasta: $('#VigenciaHasta').val(),SerialMotor: $('#SerialMotor').val(),SerialCarroceria: $('#SerialCarroceria').val() },
			success: function(){
                alert('Solicitud aprobada');
                window.location.href = '<?php echo full_url?>/adm/Planes/index.php?action=index&idSolicitudPlan=' + $('#idSolicitudPlan').val();
            }
          });
        }
        
    });      
    
});

    function calculaPrecioTugruero(){
        if($('#action').val() == 'update'){
            
            return false;
        }
        $.ajax({
        url: '<?php echo full_url?>/adm/Planes/index.php',
	data: { action: "precio_tugruero",id_plan: $('#idPlan').val(), RCV: $('.RCV:checked').val(), Puestos: $('#Puestos').val()},
	success: function(data){
            //$('.PlanPrecio').html("<p><b>Total a pagar:</b> " + data.precio + " Bs.</p>")
            $('#precio_tugruero').val(data.precio_sin_formato);
            calculaAmount();
	},
          dataType: 'JSON'
        });
        
    }
    function calculaPrecioRcv(){
    
        if($('#action').val() == 'update'){
            
            return false;
        }
            
        $.ajax({
        url: '<?php echo full_url?>/adm/Planes/index.php',
	data: { action: "precio_rcv",id_plan: $('#idPlan').val(), RCV: $('.RCV:checked').val(), Puestos: $('#Puestos').val()},
	success: function(data){
            //$('.PlanPrecio').html("<p><b>Total a pagar:</b> " + data.precio + " Bs.</p>")
            $('#precio_rcv').val(data.precio_sin_formato);
            calculaAmount();
            
	},
          dataType: 'JSON'
        });  
    }
    function calculaAmount(){
    

        var precio_tugruero = $('#precio_tugruero').val();
        var precio_rcv = $('#precio_rcv').val();
        var total = 0;
        
        //alert(total);
        if(isNaN(parseFloat(precio_tugruero))){
            precio_tugruero = 0;
            //alert("nan tugruero");
        }
        if(isNaN(parseFloat(precio_rcv))){
            precio_rcv = 0;
            //alert("nan rcv");
        }
        console.log("precio_tugruero" + precio_tugruero);
        console.log("precio_rcv" + precio_rcv);
        var total = parseFloat(precio_tugruero) + parseFloat(precio_rcv);
        $('#transaction_amount').val(total);
        
    }
</script>