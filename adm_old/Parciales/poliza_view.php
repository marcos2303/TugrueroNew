<div class="col-sm-12">
	<?php $status_poliza = "ACTIVA"; $class='text-success';?>
	<?php if($data['Vencimiento'] < date('d/m/Y')):?>
		<?php $status_poliza = 'VENCIDA'; $class='text-danger';?>
	<?php endif;?>
	<div class="col-sm-4">
		<label>Estatus de la póliza:</label> <label class=" <?php echo $class;?>"><?php echo $status_poliza;?></label> 
	</div>
</div>
<div class="col-sm-12">
	<div class="col-sm-4">
		<label>Seguro: </label> <?php echo $data['Seguro'];?> 
	</div>
	<div class="col-sm-4">
		<label>Id.Póliza: </label> <?php echo $data['idPoliza'];?> 
	</div>
	<div class="col-sm-4">
		<label>Número de Póliza: </label> <?php echo $data['NumPoliza'];?> 
	</div>
</div>
<div class="col-sm-12">
	<div class="col-sm-4">
		<label>Emisión: </label> <?php echo $data['DesdeVigencia'];?><br>
		<label>Vencimiento: </label> <?php echo $data['Vencimiento'];?> 
	</div>
	<div class="col-sm-4">
		<label>Placa:</label> <?php echo $data['Placa'];?>
	</div>
	<div class="col-sm-4">
		<label>Modelo:</label> <?php echo $data['Modelo'];?>
	</div>

</div>
<div class="col-sm-12 ">

	<div class="col-sm-4">
		<label>Tipo:</label> <?php echo $data['Tipo'];?>
	</div>
	<div class="col-sm-4">
		<label>Color:</label> <?php echo $data['Color'];?>
	</div>
	<div class="col-sm-4">
		<label>Año:</label> <?php echo $data['Año'];?>
	</div>
</div>
<div class="col-sm-12">
	<div class="col-sm-4">
		<label>Estado: </label> <?php echo $data['DireccionEDO'];?> 
	</div>
	<div class="col-sm-4">
		<label>Domicilio:</label> <?php echo $data['Domicilio'];?>
	</div>
	<div class="col-sm-4">
		<label>Dirección fiscal:</label> <?php echo $data['DireccionFiscal'];?>
	</div>
	</div>
</div>



<?php //print_r($data);?>