<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="">
  <div class="wrapper ">
    <header class="main-header"></header>
    <aside class="main-sidebar">
      <div id="MapaServicio"></div>
    </aside>
    <div class="content-wrapper bg-body-tugruero">
      <div class="text-right" style="margin:5px;">
        <a href="#" class="btn btn-tugruero" data-toggle="push-menu" role="button"><i class="fa fa-map-marker"></i> Mapa</a>
        <a class="btn btn-tugruero"  href="<?php echo full_url."/adm/Servicios/index.php";?>"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
        <a class="btn btn-tugruero" onclick="EnviarServicio();"><i class="fa"></i> Enviar servicio</a>
        <a class="btn btn-tugruero" onclick="ConsultarBaremo();"><i class="fa"></i> Consultar baremo</a>

        <input class="input-sm" id="CodigoServicio" name="CodigoServicio" type="text" readonly="readonly">

      </div>
      <form action="" name="DataForm" id="DataForm" class="">
        <input type="hidden" class="" id="IdUsuario" name="IdUsuario" value="<?php if(isset($_SESSION['IdUsuario']) and $_SESSION['IdUsuario']!='') echo $_SESSION['IdUsuario'];?>">
        <input type="hidden" class="SaveAutomaticoServicio" id="IdServicioTipo" name="IdServicioTipo" value="<?php if(isset($values['IdServicioTipo']) and $values['IdServicioTipo']!='') echo $values['IdServicioTipo'];?>">
        <input type="hidden" class="SaveAutomaticoServicioCliente SaveAutomaticoServicio SaveAutomaticoServicioPrecio SaveAutomaticoServicioGrua" id="IdServicio" name="IdServicio" value="<?php if(isset($values['IdServicio']) and $values['IdServicio']!='') echo $values['IdServicio'];?>">
        <input type="hidden" class="form-control SaveAutomaticoServicioCliente" name="IdPoliza" id="IdPoliza">
        <input type="hidden" class="form-control SaveAutomaticoServicio" name="Inicio" id="Inicio">


        <input type="hidden" id="action" value="<?php echo $values['action'];?>">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php include('datos_cliente.php');?>
          <?php include('historial_servicios.php');?>
          <?php include('datos_servicio.php');?>
          <?php include('monto_servicio.php');?>
          <?php include('metodo_pago.php');?>
          <?php include('asignacion_gruero.php');?>
          <?php include('simulador.php');?>
          <?php include('calificacion.php');?>
        </div>
      </form>
    </div>

    <div class="control-sidebar-bg"></div>
  </div>

</div>

<?php include('../../view_footer_admin.php');?>
<script src="<?php echo full_url;?>/web/js/Servicios.js"></script>
