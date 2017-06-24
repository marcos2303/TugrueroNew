
	
	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-hover table-striped">
			<tr>
				<th>Estado</th>
				<th>Cantidad</th>
			</tr>
			<?php if(count($grueros_online)>0): $total = 0;?>
			<?php foreach($grueros_online as $data):?>
			<tr>
				<td><a onclick="gruerosEstados('<?php echo $data['zone_work']?>','<?php echo $values['status']?>');"><?php echo $data['zone_work']?></a></td>
				<td><a onclick="gruerosEstados('<?php echo $data['zone_work']?>','<?php echo $values['status']?>')"><?php echo $data['cuenta']?></a></td>
			</tr>
			<?php $total+=$data['cuenta'];endforeach;?>
			<?php endif;?>
			<tr>
				<td colspan="2" align="right"><b>Total: <?php echo $total?></b></td>
			</tr>			
		</table>
		
		
	</div>


	
