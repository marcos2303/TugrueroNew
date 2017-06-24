<?php include('../../view_header_app.php')?>
<?php include('../menu.php')?>


<div class="container">
	<div class="col-sm-12">
		<table>
			<tr>
				<th>Seguro</th>
			</tr>
			
		</table>
		
		
	</div>
	
	
	
</div>
<?php foreach($seguros_list as $list):?>
	<?php echo $list['name']?><br>
<?php endforeach;?>


<?php include('../../view_footer_solicitud.php');?>
