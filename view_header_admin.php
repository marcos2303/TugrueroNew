<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TU/GRUERO®</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo full_url;?>/web/admin_template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo full_url;?>/web/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo full_url;?>/web/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo full_url;?>/web/admin_template/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo full_url;?>/web/admin_template/dist/css/skins/_all-skins.css">
    <link rel="stylesheet" href="<?php echo full_url;?>/web/css/style.css">
    <link href="<?php echo full_url;?>/web/bootstrap/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="<?php echo full_url;?>/web/css/datatables.css" rel="stylesheet">
	<script src="<?php echo full_url;?>/web/js/datatables.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
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
        <!--<a class="navbar-brand" href="#"><img src="<?php echo full_url;?>/web/img_admin/logo_blanco.png"></img></a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="" href="<?php echo full_url;?>/adm/Servicios/index.php"> <i class="fa fa-automobile"></i> Servicios y monitoreo</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Proveedores/index.php"> <i class="fa fa-truck"></i> Grueros</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Administracion/index.php"> <i class="fa fa-pie-chart"></i> Administración</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Polizas/index.php"> <i class="fa fa-hospital-o"></i> Pólizas</a></li>
        <li><a class="" href="<?php echo full_url;?>/adm/Planes/index.php"> <i class="fa fa-envelope"></i> Planes</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
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
<body class="hold-transition sidebar-collapse">
    <section class="">
