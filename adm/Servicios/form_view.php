<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="">
  <div class="wrapper">
    <header class="main-header"></header>
    <aside class="main-sidebar">
      <div><?php include('mapa_servicio.php');?></div>
    </aside>
    <div class="content-wrapper">
      <a href="#" class="btn btn-default" data-toggle="push-menu" role="button"><i class="fa fa-map-marker"></i> Mapa</a>
      <a class="btn btn-default"  href="<?php echo full_url."/adm/Servicios/index.php";?>"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
      <form action="" name="DataForm" id="DataForm" class="">
        <input type="hidden" id="IdUsuario" name="IdUsuario" value="<?php if(isset($_SESSION['IdUsuario']) and $_SESSION['IdUsuario']!='') echo $_SESSION['IdUsuario'];?>">
        <input type="hidden" id="IdServicioTipo" name="IdServicioTipo" value="<?php if(isset($values['IdServicioTipo']) and $values['IdServicioTipo']!='') echo $values['IdServicioTipo'];?>">
        <input type="hidden" class="SaveAutomaticoServicioCliente SaveAutomaticoServicio SaveAutomaticoServicioPrecio SaveAutomaticoServicioGrua" id="IdServicio" name="IdServicio" value="<?php if(isset($values['IdServicio']) and $values['IdServicio']!='') echo $values['IdServicio'];?>">
        <input class="form-control SaveAutomaticoServicioCliente" name="IdPoliza" id="IdPoliza" type="text">
        <input type="hidden" id="action" value="<?php echo $values['action'];?>">
        <div class="box box-shadow <!--collapsed-box-->">
          <div class="box-header with-border" data-widget="collapse" data-target="#DivDatosPersonales">
            <h2 class="box-title">Datos del cliente</h2>
          </div>
          <div class="box-body" id="DivDatosPersonales">
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Código servicio</label>
                  <input class="form-control" id="CodigoServicio" name="CodigoServicio" type="text" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Cédula/RIF</label>
                  <input class="form-control SaveAutomaticoServicioCliente" id="Cedula" name="Cedula" type="text" placeholder="" required="required" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small>  Placa</label>
                  <input class="form-control SaveAutomaticoServicioCliente" id="Placa" name="Placa" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group asegurado" style="display:none;">
                  <label>&nbsp;</label>
                  <button type="button" class="form-control btn btn-success" onclick="DatosPoliza();">Buscar</button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Nombres</label>
                  <input class="form-control SaveAutomaticoServicioCliente" id="Nombres" name="Nombres" type="text" placeholder="" required="required" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Apellidos</label>
                  <input class="form-control SaveAutomaticoServicioCliente" id="Apellidos" name="Apellidos" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>


              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Celular</label>
                  <input class="form-control SaveAutomaticoServicioCliente" name="Celular" id="Celular" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Marca</label>
                  <select class="form-control SaveAutomaticoServicioCliente" id="IdMarca" name="IdMarca" style="width: 100%;" required="required" pattern="^([a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off"></select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Modelo</label>
                  <input class="form-control SaveAutomaticoServicioCliente" name="Modelo" id="Modelo" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Color</label>
                  <input class="form-control SaveAutomaticoServicioCliente" name="Color" id="Color" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row asegurado" id="DivDatosPoliza" style="display:none">
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Estatus póliza</label>
                  <input class="form-control" id="EstatusPoliza" name="EstatusPoliza" type="text" placeholder="" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>F.Emisión</label>
                  <input class="form-control" id="DesdeVigencia" name="DesdeVigencia" type="text" placeholder="" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> F.Vencimiento</label>
                  <input class="form-control" name="Vencimiento" id="Vencimiento" type="text" placeholder="" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Celular</label>
                  <input class="form-control" name="Celular" id="Celular" type="text" placeholder="" readonly="readonly">
                  </>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Domicilio</label>
                  <input class="form-control" name="Domicilio" id="Domicilio" type="text" placeholder="" readonly="readonly">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box box-shadow collapsed-box">
          <div class="box-header with-border" data-toggle="DivHistorialServicios" data-widget="collapse">
            <h2 class="box-title">Historial de servicios</h2>
          </div>
          <div class="box-body" id="DivHistorialServicios">
            <div class="row">
              <div class="col-sm-12">
                  <div class="text-center">
                      Debe indicar la cédula o placa
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="box box-shadow collapsed-box">
          <div class="box-header with-border" data-toggle="DivDatosServicio" data-widget="collapse">

            <h2 class="box-title">Datos del servicio</h2>
          </div>
          <div class="box-body" id="DivDatosServicio">
            <input type="text" class="SaveAutomaticoServicio" id="LatitudOrigen" name="LatitudOrigen" value="">
            <input type="text" class="SaveAutomaticoServicio" id="LongitudOrigen" name="LongitudOrigen" value="">
            <input type="text" class="SaveAutomaticoServicio" id="LatitudDestino" name="LatitudDestino" value="">
            <input type="text" class="SaveAutomaticoServicio" id="LongitudDestino" name="LongitudDestino" value="">

            <div class="row">
              <div class="col-sm-12 box-title"><label>Origen</label></div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Estado</label>
                  <select class="form-control SaveAutomaticoServicio" id="IdEstadoOrigen" name="IdEstadoOrigen" style="width: 100%;"></select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Dirección maps</label>
                  <input class="form-control" id="DireccionOrigen" name="DireccionOrigen" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>


              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Dirección detallada</label>
                  <input class="form-control" name="DireccionOrigenDetallada" id="DireccionOrigenDetallada" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 box-title"><label>Destino</label></div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Estado</label>
                  <select class="form-control SaveAutomaticoServicio" id="IdEstadoDestino" name="IdEstadoDestino" style="width: 100%;"></select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Dirección maps</label>
                  <input class="form-control" id="DireccionDestino" name="DireccionDestino" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>


              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Dirección detallada</label>
                  <input class="form-control" name="DireccionDestinoDetallada" id="DireccionDestinoDetallada" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 box-title"><label>¿Qué ocurre?</label></div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Averia</label>
                  <input class="form-control" id="IdAveria" name="IdAveria" type="text" placeholder="" required="required" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label>Detalle</label>
                  <input class="form-control" id="AveriaDetalle" name="AveriaDetalle" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 box-title"><label>Detalles importantes</label></div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label><small class="text-danger"> * </small> Condición lugar</label>
                  <input class="form-control" id="IdCondicionLugar" name="IdCondicionLugar" type="text" placeholder="" required="required" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label>Detalle</label>
                  <input class="form-control" id="CondicionDetalle" name="CondicionDetalle" type="text" placeholder="" pattern="^([a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50})$" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="control-sidebar-bg"></div>
  </div>

</div>
<?php include('../../view_footer_admin.php');?>
<script src="<?php echo full_url;?>/web/js/Servicios.js"></script>
<script src="<?php echo full_url."/web/js/maps/mapa_servicio.js";?>" async defer></script>
