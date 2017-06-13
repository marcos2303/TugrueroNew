<?php include("../view_header_app.php");?>
<?php include("menu.php");?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="page-header">
        <h1>Bienvenido(a) <strong><?php echo $_SESSION['name']?> </strong><small> a <?php echo title;?> <?php echo version;?></small></h1>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="col-xs-1 col-sm-1 col-md-4 col-lg-4">

	</div>
	<div class="col-xs-10 col-sm-10 col-md-4 col-lg-4">
		<div class="panel panel-default">
		  <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">Empresa: <strong>TU/GRUERO®</strong></li>
                        <li class="list-group-item">Usuario: <strong><?php echo $_SESSION['login'];?></strong></li>
						<li class="list-group-item text-center"><img src="<?php echo full_url;?>/web/img/logo_tugruero_mail.png"></li>
                        
                    </ul>                    
		  </div>
		</div>	
	</div>
	<div class="col-xs-1 col-sm-1 col-md-4 col-lg-4">
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

</div>
<?php //include("../view_footer.php");?>