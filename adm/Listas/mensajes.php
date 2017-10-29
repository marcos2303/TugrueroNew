<input type="hidden" id="IdServicio" value="<?php echo $values["IdServicio"]?>">
<div class="row">
	<div class="col-sm-12"><h1>SERVICIO DE TU/GRUERO</h1></div>
</div>
<div class="row" id="esAgendado">
	<div class="col-sm-12">
		<label>SERVICIO AGENDADO PARA EL <span id="FechaAgendado" class="Mensajes"></span> A LAS <span id="HoraAgendado" class="Mensajes"></span></label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12"><label>FECHA Y HORA:</label> <span id="Inicio" class="Mensajes"></span></div>
</div>
<div class="row">
	<div class="col-sm-12"><label>ORIGEN: </label><span id="DireccionOrigenDetallada" class="Mensajes"></span></div>
</div>
<div class="row">
	<div class="col-sm-12"><label>DESTINO:</label> <span id="DireccionDestinoDetallada" class="Mensajes"></span></div>
</div>
<div class="row">
	<div class="col-sm-12"><label>VHC: </label><span id="NombreMarcaCliente" class="Mensajes"></span> <span id="ModeloCliente" class="Mensajes"></span> (<span id="InfoAdicional" class="Mensajes"></span>)</div>
</div>
<div class="row">
	<div class="col-sm-12"><label>AVERIA: </label><span id="NombreAveria" class="Mensajes"></span></div>
</div>
<div class="row">
	<div class="col-sm-12"><label>KILOMETRAJE: </label><span id="KM" class="Mensajes"></span> KM</div>
</div>
<div class="row">
	<div class="col-sm-12"><label>EXTRA: </label><span id="InfoExtra" class="Mensajes"></span></div>
</div>
<div class="row">
	<div class="col-sm-12">
		<p>
			Interesados llamar al teléfono: 02122379227
		</p>
		<p>
			O responder este mensaje con la palabra <b> SI </b>
		</p>
		<p>
			<label id="PrefijoCodigo"></label>
		</p>
	</div>
</div>
<script>

$(document).ready(function(){
	$.ajax({
		url: link_servidor + "/adm/Listas/index.php?action=mensajes_json&IdServicio=" + $("#IdServicio").val(),
		success: function(data){
			$.each(data, function(i, item) {
			  //console.log(i);
			  $("#" + i +".Mensajes").html(item);
			  	if($("#" + i).attr('id')=="CodigoServicio"){
					prefijo = item;
					prefijo = prefijo.split('-');
					console.log(prefijo[0]);
					$("#PrefijoCodigo").html(prefijo[0]);
				}
			  	if($("#" + i).attr('id')=="Agendado" && item == 'NO'){
					$("#esAgendado").hide();
				}
			});
		},
	  dataType: "json"
	});

});

</script>
