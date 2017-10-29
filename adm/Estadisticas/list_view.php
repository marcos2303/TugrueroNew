<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>

<form id="DataForm" action="index.php" method="">
  <div id="DivBusquedaGeneral">

    <input type="hidden" name="action" value="resumen_general">
    <h1 class="text-center">Estadísticas</h1>
    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
          <label>Tipo de cliente</label>
          <div class="input-group">
            <span class="input-group-addon">
              <input type="checkbox" value="1" id="activaIdServicioTipo"  class="activaInputs">
            </span>
            <select class="form-control DatosEstadistica input-sm" id="IdServicioTipo" name="IdServicioTipo" style="width: 100%;" disabled="disabled"></select>

          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Seguro</label>
          <div class="input-group">
            <span class="input-group-addon">
              <input type="checkbox" value="1" id="activaIdSeguro"  class="activaInputs DatosResumenGeneral">
            </span>
            <select class="form-control DatosEstadistica input-sm" id="IdSeguro" name="IdSeguro" style="width: 100%;" disabled="disabled"></select>

          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Rango de fechas</label>
          <div class="input-group">
            <span class="input-group-addon">
              <input type="checkbox" id="activaFechasRango" value="1" class="activaInputs">
            </span>
            <input type="date" class="form-control input-sm DatosEstadistica" name="FechaDesde" id="FechaDesde" disabled="disabled">
            <input type="date" class="form-control input-sm DatosEstadistica" name="FechaHasta" id="FechaHasta" disabled="disabled">
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Fecha específica</label>
          <div class="input-group">
            <span class="input-group-addon">
              <input type="checkbox" id="activaFechaEspecifica" value="2" class="activaInputs">
            </span>
            <input type="date" class="form-control DatosEstadistica input-sm" name="FechaEspecifica" id="FechaEspecifica" disabled="disabled">
          </div>
        </div>
      </div>

      <div class="col-sm-2">
        <div class="form-group">
          <label>Estatus</label>
          <div class="input-group">
            <span class="input-group-addon">
              <input type="checkbox" value="1" id="activaIdEstatusFinal" class="activaInputs">
            </span>
            <select class="form-control DatosEstadistica input-sm" name="IdEstatusFinal" id="IdEstatusFinal"  style="width: 100%;" disabled="disabled"></select>
          </div>

        </div>
      </div>
      <!--<div class="col-sm-2">
      <div class="form-group">
      <label>Base de datos</label>
      <div class="input-group">
      <span class="input-group-addon">
      <input type="checkbox" value="1" name="activaBaseDatos" id="activaBaseDatos"  class="activaInputs">
    </span>
    <select class="form-control DatosEstadistica input-sm" id="BaseDatos" name="BaseDatos" style="width: 100%;" disabled="disabled">
    <option value="0">Seleccione...</option>
    <option value="2">Si</option>
    <option value="1">No</option>
    <option value="3">Ambos</option>
  </select>
</div>
</div>
</div>-->
<div class="col-sm-2">
  <div class="form-group">
    <label>Agendado</label>
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" value="1" name="activaAgendado" id="activaAgendado"  class="activaInputs">
      </span>
      <select class="form-control DatosEstadistica input-sm" id="Agendado" name="Agendado" style="width: 100%;" disabled="disabled">
        <option value="0">Seleccione...</option>
        <option value="2">Si</option>
        <option value="1">No</option>
        <option value="3">Ambos</option>
      </select>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-sm-4 col-sm-offset-5">
    <button type="button" class="btn btn-success" id="btnResumenGeneral">Generar</button>
  </div>
</div>
</div>
<div id="DivResumenGeneral" style="display: none;">

  <div class="col-sm-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Llamadas: <label></label></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">Mostrar/Ocultar</button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered" id="ResumenLLamadas">
          <thead>
            <tr>
              <th colspan="4">Llamadas</th>
            </tr>
          </thead>
          <tbody id="ResumenLLamadasTbody">

          </tbody>

        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">BD</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">Mostrar/Ocultar</button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Fecha</th>
              <th><a class="btn btn-default">Efectivos</a></th>
              <th><a class="btn btn-default">Fallidos</a></th>
              <th><a class="btn btn-default">Cancelados</a></th>
            </tr>
          </thead>
          <tbody id="tbody_resumen_fechas_bd">

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">No BD</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">Mostrar/Ocultar</button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>Fecha</th>
            <th>Efectivos</th>
            <th>Fallidos</th>
            <th>Cancelados</th>
          </tr>
          <tbody id="tbody_resumen_fechas_nobd">

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detalles</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">Mostrar/Ocultar</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="tbl">
          </div>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</form>
<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Estadisticas.js"></script>
