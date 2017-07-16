<?php include("../view_header_login.php");?>
<div class="login-box" style="">
  <div class="login-logo">
    <a href="https://tugruero.com/adm"><b class="login-entrada-logo"><img src="<?php echo full_url;?>/web/img_admin/Icons/logo_icon-01.png"/></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicie sesión </p>
    <form action="index.php" method="post">
	  <input type="hidden" name="action" value="acceso">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="Login" placeholder="Usuario" autocomplete="off">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="Clave" placeholder="Clave" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12 text-center">
          <button type="submit"  class="btn btn-circle btn-xl">Entrar</button>
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
