<div class="table-responsive">
<table width="100%" class="table table-bordered table-condensed table-hover">
	<thead>
	<tr>
		<th>Código</th>
		<th>Tipo</th>
		<th>Estatus</th>
		<th>Inicio</th>
		<th>Fin</th>		
		<th>Detalle</th>
	</tr>
	</thead>
	<?php if(count($servicios_list)>0):?>
		<?php foreach($servicios_list as $servicio):?>
			<tr>
				<td><?php echo $servicio["CodigoServicio"]?></td>
				<td><?php echo $servicio["NombreServicioTipo"]?></td>
				<td><?php echo $servicio["NombreEstatus"]?></td>
				<td><?php echo $servicio["Inicio"]?></td>
				<td><?php echo $servicio["Fin"]?></td>
				<td>
					<div class="btn-group">
						<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-gear"></i> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#" onclick="DetalleServicio(<?php echo $servicio["IdServicio"];?>)"> Detalle servicio</a></li>
						</ul>
					</div>
				</td>
			</tr>

		<?php endforeach;;?>	
	
	<?php endif;?>
	
</table>
</div>