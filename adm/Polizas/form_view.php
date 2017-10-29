<?php include('../../view_header_admin.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center big_title">Pólizas</h1>
	<form class="" action="" name="DataForm" method="POST" id="DataForm">
		<input autocomplete="off" type="text" id="action" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<input autocomplete="off" class="DatosPoliza" type="hidden" id='IdPoliza' name='IdPoliza' value='<?php if(isset($values['IdPoliza']))echo $values['IdPoliza'];?>'>	
					<div class="row" >
                        <div class="col-sm-offset-9 col-sm-3">
							<label for=""><small class="text-danger"> * </small> Cédula/Rif</label>
						   <div class="form-group" >								
							   <input autocomplete="off" type="text" pattern="^([VvEeJjPpGg]{1})(-)([0-9]{5,9})$" oninvalid="setCustomValidity('Debe indicar el formato V-12345678. Sin puntos y guiones')" oninput="setCustomValidity('')" id="Cedula" class="form-control input-sm DatosPoliza" name="Cedula" maxlength="11">
                            </div> 
						</div>
					</div>
							<h4>Datos personales</h4>
                            <hr>

					<div class="row">
                        <div class="col-sm-3">
                            <label for=""><small class="text-danger"> * </small> Nombres</label>
                            <div class="form-group">
								<input autocomplete="off" type="text" id="Nombres" class="form-control input-sm DatosPoliza" name="Nombres" maxlength="50">
                                    
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for=""><small class="text-danger"> * </small> Apellidos</label>
                            <div class="form-group">
                                    <input autocomplete="off" type="text" id="Apellidos" class="form-control input-sm DatosPoliza" name="Apellidos" maxlength="50">
                                    
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Celular</label>
                            <div class="form-group">
								<input autocomplete="off" type="text" id="Celular" class="form-control input-sm DatosPoliza" name="Celular" maxlength="50">
                                    
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Email</label>
                            <div class="form-group">
                                    <input autocomplete="off" type="email" id="Email" class="form-control input-sm DatosPoliza" name="Email" maxlength="50">
                                    
                            </div> 
                        </div>
                        <br>
                    </div>


							<h4 class="">Datos del seguro</h4>
                            <hr>


                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Seguro</label>
                            <div class="form-group">
								<select name="IdSeguro" class="form-control input-sm DatosPoliza" id="IdSeguro"></select>  
                            </div> 
                        </div>
                        <div class="col-sm-2" id="NumPolizaContenedor">
                            <label for=""><small class="text-danger"> * </small> Número de Póliza</label>
                            <div class="form-group">
                                <input autocomplete="off" type="text" id="NumPoliza" class="form-control input-sm DatosPoliza" name="NumPoliza" maxlength="20" required="required">  
                            </div> 
                        </div>
                        <div class="col-sm-6" id="VencimientoContenedor">
                            <label for=""><small class="text-danger"> * </small>  Emisión</label>
                            <div class="form-group">
                                <input autocomplete="off" type="date" id="DesdeVigencia" class="form-control input-sm datetimepicker1 DatosPoliza" name="DesdeVigencia" maxlength="50" required="required">
                                    
                            </div>
                            <label for=""><small class="text-danger"> * </small> Vencimiento</label>
                            <div class="form-group">
                                    <input autocomplete="off" type="date" id="Vencimiento" class="form-control input-sm datetimepicker1 DatosPoliza" name="Vencimiento" maxlength="50" required="required">
                                    
                            </div>

                        </div>
                     </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for=""><small class="text-danger"> * </small> Dirección Estado</label>
                            <div class="form-group">
                                <select name="IdEstado" class="form-control input-sm DatosPoliza" id="IdEstado" required="required">									
								</select>                 
								
                            </div> 
                        </div>
                        <div class="col-sm-4" id="DomicilioContenedor">
                            <label for="">Domicilio</label>
                            <div class="form-group">
								<textarea id="Domicilio" class="form-control input-sm DatosPoliza" name="Domicilio"></textarea>                                    
								
                            </div> 
                        </div>
                        <div class="col-sm-4" id="DireccionFiscalContenedor">
                            <label for="">Dirección fiscal</label>
                            <div class="form-group">
								<textarea id="DireccionFiscal"  class="form-control input-sm DatosPoliza" name="DireccionFiscal"></textarea>
                                    
                            </div> 
                        </div>                       
                    </div>
						
							<h4 class="">Datos del vehículo</h4>
                            <hr>

                    <div class="row">
                        <div class="col-sm-3">
                            <label for=""><small class="text-danger"> * </small> Placa</label>
                            <div class="form-group">
								<input autocomplete="off"  type="text" id="Placa" class="form-control input-sm DatosPoliza" name="Placa" maxlength="8" required="required">
                                    
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for="">Marca</label>
                            <div class="form-group">
								<select name="IdMarca" class="form-control input-sm DatosPoliza" id="IdMarca">
									
								</select>                                    
								
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for=""><small class="text-danger"> * </small> Modelo</label>
                            <div class="form-group">
                                <input autocomplete="off"  type="text" id="Modelo" class="form-control input-sm DatosPoliza" name="Modelo" maxlength="20" required="required">
                                    
                            </div> 
                        </div>
                        <div class="col-sm-3">
                            <label for=""><small class="text-danger"> * </small>  Año</label>
                            <div class="form-group">
                                <select name="Anio" class="form-control input-sm DatosPoliza" id="Anio" required="required">
									
								</select>                                      
								
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for=""><small class="text-danger"> * </small>  Color</label>
                            <div class="form-group">
                                <input autocomplete="off" type="text" id="Color" class="form-control input-sm DatosPoliza" name="Color" maxlength="15" required="required">   
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <label for="">Tipo</label>
                            <div class="form-group">
								<select name="IdVehiculoTipo" class="form-control input-sm DatosPoliza" id="IdVehiculoTipo">
									
								</select>  
								
                            </div> 
                        </div>
                        <div class="col-sm-4" id="SeriallContenedor">
                            <label for="">Serial de carroceria</label>
                            <div class="form-group">
                                    <input autocomplete="off" type="text" id="Serial" class="form-control input-sm DatosPoliza" name="Serial" maxlength="50">
                                    
                            </div> 
                        </div>
                    </div>
			<div class="row">
                <div class="col-sm-offset-3 col-sm-3">
                  <div class="form-group">
                    <label class="radio-inline">
                        <input class="" type="radio" id="" name="Estatus" value="1"> Activo
                    </label>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="radio-inline">
                        <input class="" type="radio" id="" name="Estatus" value="2"> Vencido
                    </label>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="radio-inline">
                        <input class="" type="radio" id="" name="Estatus" value="0"> Inactivo
                    </label>
                  </div>
                </div>
			</div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/Polizas/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>
	</form>
    
</div>
<?php include('../../view_footer_admin.php')?>
<script src="<?php echo full_url;?>/web/js/Polizas.js"></script>