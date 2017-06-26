<?php include('../../view_header_admin.php');         ?>

<form action="" name="DataForm" id="DataForm">
	<input type="text" id="IdProveedor" name="IdProveedor" value="<?php if(isset($values['IdProveedor']) and $values['IdProveedor']!='') echo $values['IdProveedor'];?>">
	<div class="box box-primary">
        <div class="box-header with-border">
			<h1 class="box-title">Grueros</h1>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>
        <div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Empresa o independiente</label>
						<select class="form-control select2" id="IdProveedorTipo" name="IdProveedorTipo" style="width: 100%;">
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>CI o Rif</label>
						<input class="form-control" id="Identificacion" name="Identificacion" type="text" placeholder="">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Nombres</label>
						<input class="form-control" id="Nombres" name="Nombres" type="text" placeholder="">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Apellidos</label>
						<input class="form-control" id="Apellidos" name="Apellidos" type="text" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Estado</label>
						<select class="form-control" id="IdEstado" name="IdEstado" style="width: 100%;">
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Ciudad</label>
						<input class="form-control" name="Ciudad" id="Ciudad" type="text" placeholder="">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Zona</label>
						<input class="form-control" name="Zona" id="Zona" type="text" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Celular 1</label>
						<input class="form-control" name="Celular1" id="Celular1" type="text" placeholder="">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Celular 2</label>
						<input class="form-control" name="Celular2" id="Celular2" type="text" placeholder="">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Celular 3</label>
						<input class="form-control" name="Celular3" id="Celular3" type="text" placeholder="">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Clave especial</label>
						<input class="form-control" name="ClaveEspecial" id="ClaveEspecial" type="text" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
                    <div class="btn-group">				
						<button type="Regresar" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Regresar</button>
						<button type="button" id="EnviarProveedor" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>                    
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-4">
                    <div class="btn-group">				
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i> Agregar de grúas</button>
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-list"></i> Listado de grúas </button>
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-clock-o"></i> Historial de servicios</button>
                    </div>	
				</div>
			</div>

        </div>
	</div>
</form>
	<div class="box box-primary">
        <div class="box-header with-border">
          <h1 class="box-title">Agregar Grúa</h1>
        </div>
        <div class="box-body">
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Placa</label>
						<div class="input-group">
							<input class="form-control" type="text">
							<span class="input-group-btn">
								<button type="button" class="btn btn-success btn-flat"><i class="fa fa-check-circle"></i> Verificar</button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<div class="form-group">
						<label>Tipo de grúa</label>
							<select class="form-control" id="IdGruaTipo" name="IdGruaTipo" style="width: 100%;"></select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Marca</label>

						  <input class="form-control" type="text" id="Marca" name="Marca">

					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label>Modelo</label>
						  <input class="form-control" type="text" id="Modelo" name="Modelo">
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label>Año</label>
							<select class="form-control" style="width: 100%;" id="Anio" name="Anio">
							  <option selected="selected" value="2017">2017</option>
							</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label>Clave</label>
						  <input class="form-control" type="text">
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						<label>&nbsp;</label>
						<button type="button" id="EnviarGrua" class="btn btn-primary form-control"><i class="fa fa-save"></i> Aceptar</button>                    

					</div>
				</div>
			</div>
        </div>

	</div>	

<?php include('../../view_footer_admin.php')?>
<script  type="text/javascript">

$(document).ready(function(){
	  
    listaProveedoresTipo();
    listaEstados();
    listaGruasTipos();
    
	var parametros = {
		IdProveedor : 50
	};
	var respuesta = AjaxCall("servicios/adminapp/datosProveedor.php", parametros, MensajeSuccess, MensajeError);
	
	
	
    $('#EnviarProveedor').click(function(){
		var parametros = {};  
		var DataForm = $('#DataForm').serializeArray();
    
        $.each(DataForm,
        function(i, v) {
            parametros[v.name] = v.value;
        });
		
		if($("#IdProveedor").val()==''){
			var respuesta = AjaxCall("servicios/adminapp/agregarProveedor.php", parametros, MensajeSuccess, MensajeError);

		}else{
			var respuesta = AjaxCall("servicios/adminapp/actualizarProveedor.php", parametros, MensajeSuccess, MensajeError);

		}
		
		if(typeof(respuesta) !='undefined'){
			$("#IdProveedor").val(respuesta.IdProveedor);
		}
		
        
    });
    
    
    
    $('#EnviarGrua').click(function(){
        alert(1);
    });    
});

</script>