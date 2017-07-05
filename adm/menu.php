<nav id="custom-bootstrap-menu" class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="<?php echo full_url;?>/adm/index.php?action=bienvenida"><img src="<?php echo full_url;?>/web/img_admin/logo_blanco.png" width="100"></img></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a class="" href="<?php echo full_url;?>/adm/Servicios/index.php"> <i class="fa fa-automobile"></i> Servicios y monitoreo</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Proveedores/index.php"> <i class="fa fa-truck"></i> Grueros</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Administracion/index.php"> <i class="fa fa-pie-chart"></i> Administración</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Polizas/index.php"> <i class="fa fa-hospital-o"></i> Pólizas</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Planes/index.php"> <i class="fa fa-envelope"></i> Planes</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user"></i> MDEANDRADE <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <li><a href="<?php echo full_url;?>/adm/index.php?action=logout"> <i class="fa fa-power-off"></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
