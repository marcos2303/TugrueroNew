
	
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-hover table-striped">
			<tr>
				<th>Id.Grúa</th>
                                <th>Cédula</th>
				<th>Nombres y apellidos</th>
                                <th>Celular</th>
                                <th>Placa</th>
                                <th>Modelo</th>
			</tr>
			<?php if(count($grueros_online)>0):?>
			<?php foreach($grueros_online as $data):?>
			<tr>
				<td><?php echo @$data['idgrua']?></td>
                                <td><?php echo @$data['cedula']?></td>
				<td><?php echo @$data['nombre']?> <?php echo @$data['apellido']?></td>
				<td><?php echo @$data['celular']?></td>
				<td><?php echo @$data['placa']?></td>
                                <td><?php echo @$data['modelo']?></td>

                        </tr>
			<?php endforeach;?>
			<?php endif;?>			
		</table>
		
		
	</div>
	
	<a class="btn btn-default"  href="#" onclick="regresarGruerosOnline('<?php echo $data['zone_work']?>','<?php echo $values['Disponible']?>');"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i>Regresar</a>