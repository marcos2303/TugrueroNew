<style>
#Auto {
  position: relative;
  width: 100%;
  padding-bottom: 15%;
  vertical-align: middle;
  margin: 0;
  overflow: hidden;
  background-color: transparent;
}
#Auto svg {
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
}	
</style>
<div class="col-sm-12">
	<div class="col-sm-2">
		<label>Id.Solicitud: </label> <?php echo $data['idsolicitud'];?> 
	</div>
	<div class="col-sm-2">
		<label>Estado Origen:</label> <?php echo $data['estadoorigen'];?>
	</div>
	<div class="col-sm-2">
		<label>Destino:</label> <?php echo $data['direccion'];?>
	</div>
	<div class="col-sm-2">
		<label>Monto sin iva:</label> <?php setlocale(LC_NUMERIC,"es_ES.UTF8");echo number_format($data['monto'],2,",",".");?> Bs
	</div>
	<div class="col-sm-4">
		<label>Contacto:</label> <?php echo $data['cellcontacto'];?>
	</div>
</div>
<div class="col-sm-12">
	<div class="col-sm-<?php if($data['neumaticos']!='0000') echo "6"; else echo "12";?>">
		<label>¿Qué ocurre?:</label> <?php echo $data['queocurre'];?>
	</div>

	<div class="col-sm-6">
		<label>Neumáticos:</label>
													<?php if($data['neumaticos']!='0000'):?>
													<figure id="Auto">
													  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 1080" preserveAspectRatio="xMinYMin meet">
														<image width="250" height="250" xlink:href="<?php echo full_url?>/web/img/SVGs/Cauchos.svg"></image>
														<g class="hover_group" opacity="1">
														  <a>
															<!--<text x="0" y="40" font-size="20">Caucho A</text>-->
															<rect x="0" y="40" opacity="1" width="40" height="40" id="CauchoA" style="fill:rgb(255,255,255);stroke-width:3;stroke:rgb(0,0,255);"></rect>
														  </a>
														</g>
														<g class="hover_group" opacity="1">
														  <a>
															<!--<text x="210" y="40" font-size="20">Caucho b</text>-->
															<rect x="210" y="40" opacity="1" width="40" height="40" id="CauchoB" style="fill:rgb(255,255,255);stroke-width:3;stroke:rgb(0,0,255);"></rect>
														  </a>

														</g>
														<g class="hover_group" opacity="1">
														  <a>
															<!--<text x="0" y="170" font-size="20">Caucho c</text>-->
															<rect x="0" y="170" opacity="1" width="40" height="40" id="CauchoC" style="fill:rgb(255,255,255);stroke-width:3;stroke:rgb(0,0,255);"></rect>
														  </a>

														</g>
														<g class="hover_group" opacity="1">
														  <a>
															<!--<text x="210" y="170" font-size="20">Caucho d</text>-->
															  <rect x="210" y="170" opacity="1" width="40" height="40" id="CauchoD" style="fill:rgb(255,255,255);stroke-width:3;stroke:rgb(0,0,255);"></rect>

														  </a>

														</g>
													  </svg>
													</figure>
													<?php endif;?>

	</div>
</div>
	<div class="col-sm-12">
	<div class="col-sm-3">
		<label>Situación:</label> <?php echo $data['situacion'];?>
	</div>

	<div class="col-sm-3">
		<label>Dirección detallada de Origen:</label> <?php echo $data['infoadicional'];?>
	</div>
	<div class="col-sm-3">
		<label>Abierto:</label> <?php echo $data['timeopen'];?>
	</div>
	<div class="col-sm-3">
		<label>Origen:</label> <?php echo $data['proviene'];?>
	</div>
</div>
<script>
$(document).ready(function(){
	var str = "<?php echo $data['neumaticos'];?>";
	var res = str.split("");
	
	if(res[0] == '1'){
		$('#CauchoA').css('fill', "rgb(0,0,0)");
	}
	if(res[1] == '1'){
		$('#CauchoB').css('fill', "rgb(0,0,0)");
	}
	if(res[2] == '1'){
		$('#CauchoC').css('fill', "rgb(0,0,0)");
	}
	if(res[3] == '1'){
		$('#CauchoD').css('fill', "rgb(0,0,0)");
	}
	
});

</script>