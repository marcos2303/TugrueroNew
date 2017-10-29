<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="container-fluid">


  <form action="" name="DataForm" id="DataForm">
    <input type="hidden" id="IdUsuario" class="DatosUsuario" name="IdUsuario" value="<?php if(isset($values['IdUsuario']) and $values['IdUsuario']!='') echo $values['IdUsuario'];?>">
    <input type="hidden" id="action" value="<?php echo $values['action'];?>">
    <h1 class="text-center">Cuenta</h1>
    <div class="row">
      <div class="col-sm-offset-6 col-sm-3">
        <div class="form-group">
          <label>Login</label>
          <input class="form-control input-sm DatosUsuario" id="Login" name="Login" type="text" placeholder="" required="required" autocomplete="off" readonly="readonly">

        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label>Perfil</label>
          <input class="form-control input-sm DatosUsuario" id="Perfil" name="Perfil" type="text" placeholder="" required="required" autocomplete="off" readonly="readonly">
        </div>
      </div>
    </div>
    <h4>Datos básicos</h4>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Nombres</label>
          <input class="form-control input-sm DatosUsuario" id="Nombres" name="Nombres" type="text" placeholder="" required="required" autocomplete="off">

        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Apellidos</label>
          <input class="form-control input-sm DatosUsuario" id="Apellidos" name="Apellidos" type="text" placeholder="" required="required" autocomplete="off">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label> Celular</label>
          <input class="form-control input-sm DatosUsuario" id="Celular" name="Celular" type="text" placeholder="" autocomplete="off" pattern="^([04]{2})([0-9]{2})([0-9]{7})$" maxlength="11">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label>Email</label>
          <input class="form-control input-sm DatosUsuario" id="Email" name="Email" type="email" placeholder="" autocomplete="off">
        </div>
      </div>
    </div>
    <h4 class="box-title">Permisologías</h4>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label class="checkbox-inline">
            <input class="" type="checkbox" id="AutorizarPagos" name="AutorizarPagos" disabled="disabled"> Autorizar pagos
          </label>

        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label class="checkbox-inline">
            <input class="" type="checkbox" id="AutorizarServicios" name="AutorizarServicios" disabled="disabled"> Autorizar servicios
          </label>

        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label class="checkbox-inline">
            <input class="" type="checkbox" id="AutorizarGruas" name="AutorizarGruas" disabled="disabled"> Autorizar grúas
          </label>
        </div>
      </div>
    </div>
    <h4 class="box-title">Claves</h4>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Clave de usuario actual</label>
          <input class="form-control input-sm DatosUsuario" id="ClaveActual" name="ClaveActual" type="password" placeholder="" autocomplete="off" maxlength="12">

        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Nueva clave de usuario</label>
          <input class="form-control input-sm DatosUsuario" id="NuevaClave" name="NuevaClave" type="password" placeholder="" autocomplete="off" maxlength="12">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Repita nueva clave de usuario</label>
          <input class="form-control input-sm DatosUsuario" id="Clave" name="Clave" type="password" placeholder="" autocomplete="off" maxlength="12">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Clave de especial usuario actual</label>
          <input class="form-control input-sm DatosUsuario" id="ClaveActualEspecial" name="ClaveActualEspecial" type="password" placeholder="" autocomplete="off" maxlength="12">

        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Nueva clave especial de usuario</label>
          <input class="form-control input-sm DatosUsuario" id="NuevaClaveEspecial" name="NuevaClaveEspecial" type="password" placeholder="" autocomplete="off" maxlength="12">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label><small class="text-danger"> * </small> Repita nueva clave especial de usuario</label>
          <input class="form-control input-sm DatosUsuario" id="ClaveEspecial" name="ClaveEspecial" type="password" placeholder="" autocomplete="off" maxlength="12">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="btn-group">
          <button type="submit" id="EnviarUsuario" class="btn btn-primary">Aceptar</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Usuarios.js"></script>
