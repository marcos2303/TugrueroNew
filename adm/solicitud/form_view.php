<?php include('../../view_header_app.php');?>
    
    <script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: -28.643387, lng: 153.612224},
    mapTypeControl: true,
    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        position: google.maps.ControlPosition.TOP_CENTER
    },
    zoomControl: true,
    zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    },
    scaleControl: true,
    streetViewControl: true,
    streetViewControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
    }
  });
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=true&callback=initMap" async defer>
    </script>

<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>


<form method="post" id="solicitud" name="solicitud" action="">	
<div id="map"></div>	
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">Poliza</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="idPoliza" id="idPoliza"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">latOrigen</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="latOrigen" id="latOrigen"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">lngOrigen</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="lngOrigen" id="lngOrigen"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">latDestino</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="latDestino" id="latDestino"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">lngDestino</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="lngDestino" id="lngDestino"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>		
	
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">Direccion</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="Direccion" id="Direccion"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">Cell</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="Cell" id="Cell"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">InfoAdicional</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="InfoAdicional" id="InfoAdicional"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">EstadoOrigen</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="EstadoOrigen" id="EstadoOrigen"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">QueOcurre</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="QueOcurre" id="QueOcurre"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">Neumaticos</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="Neumaticos" id="Neumaticos"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
			<label for="">Situacion</label>
				<div class="input-group">
					<input type="text" maxlength="50" autocomplete="off" name="Situacion" id="Situacion"  class="form-control">
					<span class="input-group-addon" id="basic-addon2">(*)</span>
				</div>
			</div>
		</div>
	</div>	

	
	
	<button type="button" id="enviaSolicitud" class="btn btn-default"><i class="fa fa-save fa-pull-left fa-border"></i> Generar</button>	
</form>

<?php include('../../view_footer.php');?>
<script>
	
	$(document).ready(function(){

		$('#enviaSolicitud').click(function(){
			var arr = {idPoliza: 5,latOrigen:'10.490438279359',lngOrigen: '-66.85555508755',latDestino: '10.459585046603',lngDestino: '-66.81719412076',Direccion: 'Distrito capital, Ccs, Cafetal',CellContacto:'04249631308',InfoAdicional:'Estoy en casa portuguesa',EstadoOrigen:'Dto. Capital',QueOcurre: 'Neumático espichado',Neumaticos:'0100',Situacion:'Fuerte'};
				$.ajax({
					type: "POST",
					url: 'http://localhost/clienteapp/solicitudCliente.php',
					//url: 'http://52.25.178.106/clienteapp/solicitudCliente.php',
					data: JSON.stringify(arr),
					contentType: 'application/json; charset=utf-8',
					async: false,
					success: function(data){
						alert('ready');
					},
					crossDomain: true,
					dataType: 'json',
					//success: function() { alert("Success"); },
					//error: function() { alert('Failed!'); },
				});
		});
	});


</script>

