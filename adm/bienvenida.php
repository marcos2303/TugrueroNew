<?php include("../view_header_admin.php");?>
<?php include("menu.php");?>
<div class="col-xs-12">


        <div class="col-xs-offset-4 col-xs-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $_SESSION['Nombres']?> <?php echo $_SESSION['Apellidos']?></h3>

              <p class="text-muted text-center"><?php echo $_SESSION['Perfil']?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Última conexión </b> <label class="pull-right"><?php echo $_SESSION['UltimaConexion']?></label>
                </li>
                <li class="list-group-item">
                  <b>Cantidad de conexiones </b> <label class="pull-right"><?php echo $_SESSION['CuentaConexiones']?></label>
                </li>
                <li class="list-group-item">
                  <b>Servicios últimos 3 días</b> <label class="pull-right" id="last3Days"> 0 </label>
                </li>
                <li class="list-group-item">
                  <b>Servicios últimos 15 días</b> <label class="pull-right" id="last15Days"> 0 </label>
                </li>
                <li class="list-group-item">
                  <b>Servicios últimos 45 días</b> <label class="pull-right" id="last45Days"> 0 </label>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
<?php include("../view_footer_admin.php");?>
<script src="<?php echo full_url;?>/web/js/Bienvenida.js"></script>
