<?php include("../view_header_login.php");?>	
<div class="login-box">
  <div class="login-logo">
    <a href="https://tugruero.com/adm"><b>TU/GRUERO®</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicie sesión </p>
	
    <form action="index.php" method="post">
	  <input type="hidden" name="action" value="acceso">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="Login" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="Clave" placeholder="Clave">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Aceptar</button>
        </div>
      </div>
		<?php if(isset($values['error']) and $values['error'] !=''):?>
		<div class="row">
			<div class="col-xs-12">
				<br>
              <div class="alert alert-danger">
                <label><i class="icon fa fa-ban"></i> <?php echo $values['error'];?></label>
              </div>
			</div>
		</div>
		<?php endif;?>
    </form>

  </div>
</div>

<?php include("../view_footer_login.php");?>		