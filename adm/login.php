<?php include("../view_header_app.php");?>	
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="img-logo" href="<?php echo full_url;?>/index.php"><img  src="<?php echo full_url;?>/web/img/logo_blanco.png" alt="" width="200"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"></div>
  </div>
</nav>
        	<div class="col-md-4 col-lg-4">
        	</div>
        	
            <div class="col-md-4 col-lg-4">
				 <div class="panel panel-default ">
				  <div class="panel-body">
                                      <div align='center' class="visible-lg visible-md">
                                         <img src="<?php echo full_url;?>/web/img/g190.png" class="img-responsive" width="200"> 
                                      </div>
                                      <div align='center' class="visible-sm visible-xs">
                                         <img src="<?php echo full_url;?>/web/img/g190.png" class="img-responsive" width="100"> 
                                      </div>					
                                        <form name="" id="" novalidate action="<?php echo full_url;?>/adm/index.php" method="POST">
			                
                                         <input type="hidden" name="action" value="acceso"/>
			                    <div class="control-group form-group">
			                        <div class="controls">
			                            <label>Usuario:</label>
			                            <input  autocomplete="off" name='login' type="text" class="form-control" id="login" required data-validation-required-message="Please enter your login.">
			                            <p class="help-block"></p>
			                        </div>
			                    </div>
			                    <div class="control-group form-group">
			                        <div class="controls">
			                            <label>Clave:</label>
			                            <input autocomplete="off" name='password' type="password" class="form-control" id="password" required data-validation-required-message="Please enter your password.">
			                        </div>
			                    </div>
			                   <div class="control-group form-group">
			                        <div class="controls">
										<?php
											  // show captcha HTML using Securimage::getCaptchaHtml()

											  $options = array();
											  $options['input_name']             = 'ct_captcha'; // change name of input element for form post
											  $options['disable_flash_fallback'] = false; // allow flash fallback
											  $options['show_audio_button'] = false;

											  if (!empty($_SESSION['ctform']['captcha_error'])) {
												// error html to show in captcha output
												$options['error_html'] = $_SESSION['ctform']['captcha_error'];
											  }

											  echo "<div id='captcha_container_1' class='text-center'>\n";
											  echo Securimage::getCaptchaHtml($options);
											  echo "\n</div><strong><p class='text-center small'>Respete letras mayúsculas y minúsculas</p>\n";
										 ?>
			 							
							
								                           
			                           
			                        </div>
			                    </div>
			                    <div class="control-group form-group text-center">
										<button type="submit" class="btn-lg btn-success">Conectar <i class="fa fa-arrow-right"></i></button>
			                    </div>
			                    
							
			                    <!-- For success/fail messages -->
			                    
			                    <?php if(isset($values['message']) and $values['message']!=''):?>
			                    	
			                    	<div id="" class="alert alert-danger"><?php echo $values['message'];?></div>
			                    <?php endif;?>
			                    <?php if(isset($values['error']) and $values['error']!=''):?>
			                    	
			                    	<div id="" class="alert alert-danger"><?php echo $values['error'];?></div>
			                    <?php endif;?>
			                </form>
				  </div>
				</div>               
            </div>
        	<div class="col-md-4 col-lg-4">
        	</div>

<?php include("../view_footer_clean.php");?>		