<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>
<div class="container">
	<h1 class="text-center">Servicios - Operadores</h1>
	<form class="form-horizontal" action="index.php" method="POST">
		<input type="hidden" name='action' value='<?php if(isset($values['action']))echo $values['action'];?>'>
		<div class="form-group" style="display:none;">
		<label for="">Id.grua</label>
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="idGrua" value="<?php if(isset($values['idgrua'])) echo $values['idgrua']?>">
		<input autocomplete="off" readonly="readonly" type="text" class="form-control input-sm" id="" placeholder="" name="idSolicitud" value="<?php if(isset($values['idsolicitud'])) echo $values['idsolicitud']?>">
		</div>
		
	<div class="form-group">
		<div class="col-sm-4">
			<h4><label class="label label-default">Datos del solicitante</label></h4>
			<label for="">Documento de Identificación:</label>
			<?php echo $values['cedula'];?><br>
			<label for="">Nombres y apellidos:</label>
			<?php echo $values['nombre'];?><br>
			<label for="">Celular contacto:</label>
			<?php echo $values['cellcontacto'];?><br>
			<label for="">Estatus cliente:</label>
			<?php echo $values['estatuscliente'];?>
		</div>
		<div class="col-sm-4">
			<h4><label class="label label-default">Datos del vehículo</label></h4>
			<label for="">Placa:</label>
			<?php echo $values['placa'];?><br>
			<label for="">Marca:</label>
			<?php echo $values['marca'];?><br>
			<label for="">Modelo:</label>
			<?php echo $values['modelo'];?><br>
		</div>
		<div class="col-sm-4">
			<h4><label class="label label-default">Datos del gruero</label></h4>
			<label for="">Documento de Identificación:</label>
			<?php echo $values['cedula_gruero'];?><br>
			<label for="">Nombres y apellidos:</label>
			<?php echo $values['nombre_gruero'];?> <?php echo $values['apellido_gruero'];?><br>
			<label for="">Celular contacto:</label>
			<?php echo $values['celular_gruero'];?><br>
			<label for="">Placa grúa:</label>
			<?php echo $values['placa_gruero'];?><br>
			<label for="">Modelo grúa:</label>
			<?php echo $values['modelo_gruero'];?><br>
			<label for="">Color grúa:</label>
			<?php echo $values['color_gruero'];?><br>
			<label for="">Estatus grúa:</label>
			<?php echo $values['estatusgrua'];?>
		</div>	

	</div>
	<div class="form-group">
		<div class="col-sm-4">
			<h4><label class="label label-default">Detalle del servicio</label></h4>
			<label for="">Número de servicio:</label>
			<?php echo $values['idsolicitud'];?><br>
			<label for="">Estado de origen:</label>
			<?php echo $values['estadoorigen'];?><br>
			<label for="">Dirección:</label>
			<?php echo $values['direccion'];?><br>
			<label for="">Problema o falla:</label>
			<?php echo $values['queocurre'];?><br>
			<label for="">Situación:</label>
			<?php echo $values['situacion'];?><br>
			<label for="">Estatus:</label>
			<?php echo $values['estatus'];?>
			<br>
			<label for="">Fecha inicio:</label>
			<?php echo $values['timeinicio'];?>
			<br>
			<label for="">Fecha fin:</label>
			<?php echo $values['timefin'];?>
			<br>
			<label for="">Motivo:</label>
			<?php echo $values['motivo'];?>
			<br>
			<label for="">Monto a cobrar (sin IVA):</label>
			<?php setlocale(LC_NUMERIC,"es_ES.UTF8");echo number_format($values['monto'],2,",",".");?> Bs
		</div>	
		<div class="col-sm-4 col-sm-offset-4">
			<h4><label class="label label-default">Calificación</label></h4>
			<label for="">Trato cordial:</label>
			<?php echo $values['tratocordial'];?><br>
			<label for="">Presencia:</label>
			<?php echo $values['presencia'];?><br>
			<label for="">Trato al vehículo:</label>
			<?php echo $values['tratovehiculo'];?><br>
			<label for="">¿Recomendaría <strong>TU/GRUERO®</strong>?:</label>
			<?php echo $values['puntual'];?><br>
		</div>
	</div>
		<a class="btn btn-default"  href="<?php echo full_url."/adm/ServiciosClientes/index.php?idPoliza=".$values['idpoliza']?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
		<!--<button type="submit" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Guardar</button>-->

	</form>
	
</div>