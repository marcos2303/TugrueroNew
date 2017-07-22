<?php include('../../view_header_admin.php');?>
<?php include('../menu.php');?>
<div class="">
  <div class="wrapper ">
    <header class="main-header"></header>
    <aside class="main-sidebar">
      <div><?php include('mapa_servicio.php');?></div>
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
        <input type="hidden" class="form-control SaveAutomaticoServicioCliente" name="Inicio" id="Inicio">

        <input type="hidden" id="action" value="<?php echo $values['action'];?>">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-tugruero">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Datos cliente
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="" id="DivDatosPersonales">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label> Cédula/RIF</label>
                        <input class="form-control input-sm SaveAutomaticoServicioCliente" id="Cedula" name="Cedula" type="text" placeholder="" required="required"  autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>  Placa</label>
                        <input class="form-control input-sm SaveAutomaticoServicioCliente" id="Placa" name="Placa" type="text" placeholder=""  autocomplete="off">

                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <button type="button" class=" btn btn-success asegurado" style="display:none;margin-top:20px;margin-left:-20px;" onclick="DatosPoliza();">Buscar</button>

                      </div>
                    </div>



                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Nombres</label>
                        <input class="form-control SaveAutomaticoServicioCliente input-sm " id="Nombres" name="Nombres" type="text" placeholder="" required="required"  autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input class="form-control SaveAutomaticoServicioCliente input-sm " id="Apellidos" name="Apellidos" type="text" placeholder=""  autocomplete="off">
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Celular</label>
                        <input class="form-control SaveAutomaticoServicioCliente input-sm " name="Celular" id="Celular" type="text" placeholder="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Marca</label>
                        <select class="form-control SaveAutomaticoServicioCliente input-sm " id="IdMarca" name="IdMarca" style="width: 100%;" required="required"  autocomplete="off"></select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Modelo</label>
                        <input class="form-control SaveAutomaticoServicioCliente input-sm " name="Modelo" id="Modelo" type="text" placeholder=""  autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Color</label>
                        <input class="form-control SaveAutomaticoServicioCliente input-sm " name="Color" id="Color" type="text" placeholder=""  autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="asegurado"id="DivDatosPoliza" style="display:none">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label> Seguro</label>
                          <select class="form-control SaveAutomaticoServicioCliente" id="IdSeguro" name="IdSeguro" style="width: 100%;"></select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Estatus</label>
                          <input class="form-control input-sm " id="EstatusPoliza" name="EstatusPoliza" type="text" placeholder="" readonly="readonly">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label> Emisión</label>
                          <input class="form-control input-sm " id="DesdeVigencia" name="DesdeVigencia" type="text" placeholder="" readonly="readonly">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label> Vencimiento</label>
                          <input class="form-control input-sm " name="Vencimiento" id="Vencimiento" type="text" placeholder="" readonly="readonly">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label> Celular</label>
                          <input class="form-control input-sm " name="CelularBD" id="CelularBD" type="text" placeholder="" readonly="readonly">
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label> Domicilio</label>
                          <input class="form-control input-sm " name="Domicilio" id="Domicilio" type="text" placeholder="" readonly="readonly">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>



              </div>
            </div>
          </div>
          <div class="panel panel-tugruero">
            <div class="panel-heading" role="tab" id="headingTwo">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Historial de servicios
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="panel-body">
                <div class="" id="DivHistorialServicios">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            Debe indicar la cédula o placa
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-tugruero">
            <div class="panel-heading" role="tab" id="headingThree">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Datos servicio
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
              <div class="panel-body">
                <div class="" id="DivDatosServicio">
                  <input type="hidden" class="SaveAutomaticoServicio" id="LatitudOrigen" name="LatitudOrigen" value="">
                  <input type="hidden" class="SaveAutomaticoServicio" id="LongitudOrigen" name="LongitudOrigen" value="">
                  <input type="hidden" class="SaveAutomaticoServicio" id="LatitudDestino" name="LatitudDestino" value="">
                  <input type="hidden" class="SaveAutomaticoServicio" id="LongitudDestino" name="LongitudDestino" value="">
                  <input type="hidden" class="SaveAutomaticoServicio" id="Agendado" name="Agendado" value="0">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="checkbox-inline">
                          <input class="" onchange="CambiarAgendado(this);" type="checkbox" id="" name=""> Agendado
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <input type="date" class="form-control SaveAutomaticoServicio input-sm Agendado" style="display:none;" id="FechaAgendado" name="FechaAgendado" type="text" placeholder="" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <input type="time" class="form-control SaveAutomaticoServicio input-sm Agendado" style="display:none;" id="HoraAgendado" name="HoraAgendado" type="text" placeholder="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 alert alert-tugruero text-center"><label class="">Origen</label></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Estado</label>
                        <select class="form-control SaveAutomaticoServicio input-sm " id="IdEstadoOrigen" name="IdEstadoOrigen" style="width: 100%;"></select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Dir.Maps</label>
                        <input class="form-control SaveAutomaticoServicio input-sm " id="DireccionOrigen" name="DireccionOrigen" type="text" placeholder=""  autocomplete="off">
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Dir.Detallada</label>
                        <textarea class="form-control SaveAutomaticoServicio input-sm " name="DireccionOrigenDetallada" id="DireccionOrigenDetallada"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 alert alert-tugruero text-center"><label class="">Destino</label></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Estado</label>
                        <select class="form-control SaveAutomaticoServicio input-sm " id="IdEstadoDestino" name="IdEstadoDestino" style="width: 100%;"></select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Dir.Maps</label>
                        <input class="form-control SaveAutomaticoServicio input-sm " id="DireccionDestino" name="DireccionDestino" type="text" placeholder=""  autocomplete="off">
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Dir.Detallada</label>
                        <textarea class="form-control SaveAutomaticoServicio input-sm " name="DireccionDestinoDetallada" id="DireccionDestinoDetallada"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label> KM</label>
                        <input class="form-control SaveAutomaticoServicio input-sm " id="KM" name="KM" type="text" placeholder=""  autocomplete="off" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 alert alert-tugruero text-center"><label class="">¿Qué ocurre?</label></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Averia</label>
                        <select class="form-control SaveAutomaticoServicio input-sm " id="IdAveria" name="IdAveria" style="width: 100%;"></select>
                      </div>
                    </div>
                    <div class="col-sm-4" class="Averias">
                      <div class="form-group">
                        <label> Otra/Cauchos</label>
                        <select class="form-control SaveAutomaticoServicio Averias input-sm" id="IdAveriaHijo" name="IdAveriaHijo" style="width: 100%;"></select>

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Detalle</label>
                        <textarea class="form-control SaveAutomaticoServicio input-sm " id="AveriaDetalle" name="AveriaDetalle"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 alert alert-tugruero text-center"><label class="">Detalles importantes</label></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label> Condición lugar</label>
                        <select class="form-control SaveAutomaticoServicio input-sm " id="IdCondicionLugar" name="IdCondicionLugar" style="width: 100%;"></select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Detalle</label>
                        <textarea class="form-control SaveAutomaticoServicio input-sm " id="CondicionDetalle" name="CondicionDetalle" placeholder=""></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-tugruero">
            <div class="panel-heading" role="tab" id="headingFour">
              <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Monto servicio
                </a>
              </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
              <div class="panel-body">
                <div class="" id="DivDatosPrecio">
                  <div class="row">
                    <div class="col-sm-offset-8 col-sm-4">
                      <div class="form-group">
                        <label class="checkbox-inline">
                          <input class="" onchange="CambiarNegociar(this);" type="checkbox" id="" name=""> A negociar
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago gruero</label>
                        <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioSIvaBaremo" name="PrecioSIvaBaremo" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Iva</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaBaremo" name="IvaBaremo" type="text" autocomplete="off" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago total gruero</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioCIvaBaremo" id="PrecioCIvaBaremo" type="text" placeholder="" autocomplete="off" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago gruero</label>
                        <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioSIvaBaremoModificado" name="PrecioSIvaBaremoModificado">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Iva</label>
                        <input class="form-control input-sm SaveAutomaticoServicioPrecio" id="IvaBaremoModificado" name="IvaBaremoModificado" type="text" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago total gruero</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioCIvaBaremoModificado" id="PrecioCIvaBaremoModificado" type="text" placeholder="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago cliente</label>
                        <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioClienteSIva" name="PrecioClienteSIva" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Iva</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaCliente" name="IvaCliente" type="text" autocomplete="off" readonly="readonly">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago total cliente</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioClienteCIva" id="PrecioClienteCIva" type="text" placeholder="" autocomplete="off" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago cliente</label>
                        <input type="text" class="form-control SaveAutomaticoServicioPrecio input-sm " id="PrecioClienteSIvaModificado" name="PrecioClienteSIvaModificado">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Iva</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " id="IvaClienteModificado" name="IvaClienteModificado" type="text" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label> Pago total cliente</label>
                        <input class="form-control SaveAutomaticoServicioPrecio input-sm " name="PrecioClienteCIvaModificado" id="PrecioClienteCIvaModificado" type="text" placeholder="" autocomplete="off">
                      </div>
                    </div>
                  </div>
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
<script>

</script>
