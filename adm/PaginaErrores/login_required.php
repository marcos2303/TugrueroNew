<?php include("../../autoload.php");?>	
<?php include('../../view_header_admin.php')?>

	<div class="container">
    <section class="content">

      <div class="error-page">
        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Al parecer no tiene permisos de acceso.</h3>

          <p>
            Debe iniciar sesión nuevamente.
             <a href="<?php echo full_url?>/adm/index.php">Ir a login</a>
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
	</div>

<?php include('../../view_footer_admin.php')?>
