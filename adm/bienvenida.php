<?php include("../view_header_admin.php");?>
<?php include("../menu.php");?>
<div class="col-xs-12">


        <div class="col-xs-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $_SESSION['Nombres']?> <?php echo $_SESSION['Apellidos']?></h3>

              <p class="text-muted text-center"><?php echo $_SESSION['Perfil']?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Servicios ultimos 3 dias</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Servicios ultimos 15 dias</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Servicios ultimos 45 dias</b> <a class="pull-right">13,287</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
<?php include("../view_footer_admin.php");?>
