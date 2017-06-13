<?php include('../../view_header_admin.php')?>

<form action="index.php">
	<div class="box box-primary">
        <div class="box-header with-border">
			<h1 class="box-title">Grueros</h1>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>
        <div class="box-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Empresa o independiente</label>
						<select class="form-control select2" style="width: 100%;">
						  <option selected="selected">Alabama</option>
						  <option>Alaska</option>
						  <option>California</option>
						  <option>Delaware</option>
						  <option>Tennessee</option>
						  <option>Texas</option>
						  <option>Washington</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>CI o Rif</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Nombres</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Apellidos</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Estado</label>
						<select class="form-control" style="width: 100%;">
						  <option selected="selected">Alabama</option>
						  <option>Alaska</option>
						  <option>California</option>
						  <option>Delaware</option>
						  <option>Tennessee</option>
						  <option>Texas</option>
						  <option>Washington</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Ciudad</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Zona</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Celular 1</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Celular 2</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Celular 3</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Clave especial</label>
						<input class="form-control" type="text" placeholder="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
                    <div class="btn-group">				
						<button type="Regresar" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Regresar</button>
						<button type="Aceptar" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>                    
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-4">
                    <div class="btn-group">				
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i> Agregar de grúas</button>
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-list"></i> Listado de grúas </button>
						<button type="button" class="btn btn-default btn-md"><i class="fa fa-clock-o"></i> Historial de servicios</button>
                    </div>	
				</div>
			</div>

        </div>
	</div>
	<div class="box box-primary">
        <div class="box-header with-border">
          <h1 class="box-title">Agregar Grúa</h1>
        </div>
        <div class="box-body">
			
			<div class="row">
				<div class="col-md-4">
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
				<div class="col-md-2">
					<div class="form-group">
						<label>Tipo de grúa</label>
							<select class="form-control" style="width: 100%;">
							  <option selected="selected">Alabama</option>
							  <option>Alaska</option>
							  <option>California</option>
							  <option>Delaware</option>
							  <option>Tennessee</option>
							  <option>Texas</option>
							  <option>Washington</option>
							</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Marca</label>

						  <input class="form-control" type="text">

					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Modelo</label>
						  <input class="form-control" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Año</label>
							<select class="form-control" style="width: 100%;">
							  <option selected="selected">Alabama</option>
							  <option>Alaska</option>
							  <option>California</option>
							  <option>Delaware</option>
							  <option>Tennessee</option>
							  <option>Texas</option>
							  <option>Washington</option>
							</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Clave</label>
						  <input class="form-control" type="text">
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label>&nbsp;</label>
						<button type="Aceptar" class="btn btn-primary form-control"><i class="fa fa-save"></i> Aceptar</button>                    

					</div>
				</div>
			</div>
        </div>

	</div>	
</form>
	



<?php include('../../view_footer_admin.php')?>