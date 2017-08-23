<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>
<div class="container">
<h1 class="text-center">Estadísticas</h1>	
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Tipo de cliente</label>
                <select class="form-control" id="IdServicioTipo" name="IdServicioTipo" style="width: 100%;"></select>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>Seguro</label>
                <select class="form-control" id="IdSeguro" name="IdSeguro" style="width: 100%;"></select>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
			  <label>Placa</label>

            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label> Cédula/RIF</label>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>  Placa</label>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
			  <label>  Placa</label>

            </div>
          </div>


        </div>	

</div>

<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Estadisticas.js"></script>
