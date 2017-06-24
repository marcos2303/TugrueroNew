<?php //include('../../autoload.php')?>

<!doctype html>
<html ng-app="cssawds">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grueros Venezuela, Grúas Venezuela">
    <meta name="author" content="tugruero">
    <link rel="alternate" hreflang="es" href="www.tugruero.com" />
    <link href="<?php echo full_url?>/web/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="<?php echo full_url?>/web/img/favicon.ico" type="image/x-icon"/>
    <link href="<?php echo full_url?>/web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo full_url?>/web/css/menu2.css">  
	<link rel="stylesheet" href="<?php echo full_url?>/web/css/hover.css">  
	<link href="<?php echo full_url?>/web/css/freelancer_app.css" rel="stylesheet">
        <title>TUGRUERO®</title>
</head>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
		padding-left: 10px;
		padding-top: 30px;
		
		font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif ;
		/*background: url(<?php echo full_url?>/web/img/fondos/Fondo-Tu-Gruero2.jpg) no-repeat center center fixed ;*/
    
		overflow-x: hidden;
		margin: 0;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;		
		
      }
      #map {
        height: 100%;
      }
	#floating-panel {
	  position: fixed;
		/*padding-top: 20%;*/
	  left: 22%;
	  z-index: 5;
	  /*background-color: #fff;*/
	  padding: 0px;
	  border: 0px solid #999;
	  text-align: center;
	  font-family: 'Roboto','sans-serif';
	  line-height: 30px;
	  padding-left: 10px;
	}
#searchInput {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 20%;
}

#searchInput:focus {
    border-color: #4d90fe;
}
.gm-style-iw + div {
  display: block;
}
label {
	/*color: #fff;*/
}
h1, h2 ,h3 {
	/*color: #fff;*/
}
.controls_search {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}
.navbar {
    text-transform: uppercase;
    font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-weight: 700;
    background-color: #404040 !important;
}
@media(min-width:768px) {
.navbar-fixed-top {
    padding: 0px 0;
    }
}
    </style>
<style>
.hover_group:hover {
  opacity: 1;
}
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
<style>
.modal-dialog-center {
    margin-top: 20%;
	padding-left: 40%;
}	
</style>
	<div class="navbar navbar-fixed-top">      

			<a class="nav-close visible-md visible-lg" href="#header"><img class="img-logo" src="<?php echo full_url?>/web/img/logo_blanco.png" alt="tugruero.com" width="100"></a>

		
		<div class="navbar-header pull-right">
		  <a id="nav-expander" class="nav-expander fixed">
			<i class="fa fa-bars fa-lg white-font"></i>
		  </a>
		</div>
	</div>
	<nav class="nav2">
		
	  <ul class="list-unstyled main-menu">
		  
		  <li class="text-right nav-close"><a href="#" id="nav-close" class="">X</a></li>
		
	  </ul>
		
		<!--Codigo -->
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden">
											<label for="latlon">Lat/Long Origen</label>
											<input id="latlon" type="text" value=""  class="form-control input-sm" size="50" readonly="readonly">


										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " hidden>
											<label for="latlonl">Lat/Long destino</label>
											<input id="latlonl" type="text" value="" class="form-control input-sm" size="50" readonly="readonly">


										</div>				
					
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" hidden>
							<input id="country" id="country" type="hidden" value="" class="controls">
						</div>
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne" style="background-color: #404040 !important;">
								  <h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-target="#collapseOne" href="#" style="color: white !important;">									  
										Datos de Cliente y Póliza
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								  <div class="panel-body" style="background-color: #ccc !important;">
									  <div id="parcial_cliente"></div>
									  <div id="parcial_poliza"></div>
								  </div>
								</div>
							  </div>
							  <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo" style="background-color: #404040 !important;">
								  <h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-target="#collapseTwo" href="#" style="color: white !important;">
									 Tips de Condicionado
									</a>
								  </h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								  <div class="panel-body" style="background-color: #ccc !important;">
									  <div id="parcial_tips"></div>
								  </div>
								</div>
							  </div>
							</div>						
	
						
							<div class="panel panel-default">
							  <div class="panel-heading" style="background-color: #404040 !important;">
								<h3 class="panel-title"  style="color: white !important;">Datos solicitud</h3>
							  </div>
									<div class="panel-body" style="background-color: #ccc !important;">
										
											<div class="col-sm-12">
												<input type="text" readonly="readonly" id="identificador_error" class="form-control">
												<label for="EstadoOrigen">Estado origen</label>
												<select name="EstadoOrigen" id="EstadoOrigen" class="form-control">
													<option value=""></option>
													<option value="Amazonas">Amazonas</option>
													<option value="Anzoátegui">Anzoátegui</option>
													<option value="Apure">Apure</option>
													<option value="Aragua">Aragua</option>
													<option value="Barinas">Barinas</option>
													<option value="Bolivar">Bolivar</option>
													<option value="Carabobo">Carabobo</option>
													<option value="Cojedes">Cojedes</option>
													<option value="Delta Amacuro">Delta amacuro</option>
													<option value="Dependencias Federales">Dependencias federales</option>
													<option value="Distrito Capital">Distrito Capital</option>
													<option value="Falcón">Falcón</option>
													<option value="Guárico">Guárico</option>
													<option value="Lara">Lara</option>
													<option value="Mérida">Mérida</option>
													<option value="Miranda">Miranda</option>
													<option value="Monagas">Monagas</option>
													<option value="Nueva Esparta">Nueva Esparta</option>
													<option value="Portuguesa">Portuguesa</option>
													<option value="Sucre">Sucre</option>
													<option value="Táchira">Táchira</option>
													<option value="Trujillo">Trujillo</option>
													<option value="Vargas">Vargas</option>
													<option value="Yaracuy">Yaracuy</option>
													<option value="Zulia">Zulia</option>
												</select>
											</div>
											<div class="col-sm-6" hidden>
												id_poliza = <input id="idPoliza" type="text" value="<?php if(isset($values['idPoliza']) and $values['idPoliza']!='') echo $values['idPoliza']?>"  class="form-control input-sm" size="50">
												<label for="location">Dirección de Origen</label>
												<input id="location" type="text" value=""  class="form-control input-sm" size="50">
											</div>
											<div class="col-sm-12">
												<label for="InfoAdicional">Dirección detallada de Origen</label>
												<input name="InfoAdicional" id='InfoAdicional' class="form-control input-sm" placeholder="Informacion adicional">
											</div>
											<div class="col-sm-12">
												<label for="locationl">Dirección destino</label>
												<input id="locationl" type="text" value="" class="form-control input-sm" size="50">
											</div>
											<div class="col-sm-12">
												<label for="QueOcurre">¿Qué ocurre?</label>
												<select class="form-control input-sm" name='QueOcurre' id='QueOcurre'>
													<option value="">Seleccione</option>
													<option value="Falla de encendido">Falla de encendido / No puedo rotar</option>
													<option value="Neumático espichado">Neumático espichado / Torcido</option>
													<option value="Volante/Palanca trabada">Volante / Palanca trabada</option>
													<option value="Encunetado">Encunetado</option>
													<option value="Choqué">Choqué</option>
													<option value="Otra falla">Otra falla</option>
												</select>
											</div>
											<div class="col-sm-12">
												<div class="col-sm-12">
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
												<input id="caucho1" type="checkbox" value="1" class=" input-sm hidden">
												<input id="caucho2" type="checkbox" value="1" class=" input-sm hidden"><br>
												<input id="caucho3" type="checkbox" value="1" class=" input-sm hidden">
												<input id="caucho4" type="checkbox" value="1" class="input-sm hidden">
												</div>
											</div>
											<div class="col-sm-12">
												<label for="Situacion">Detalles importantes</label>
												<select class="form-control input-sm" name='Situacion' id='Situacion'>
													<option value="">Seleccione</option>
													<option value="Calle plana">Calle plana</option>
													<option value="Calle inclinada">Calle inclinada</option>
													<option value="Atascado en barro o arena.">Atascado en barro o arena</option>
													<option value="Estacionamiento techado o sótano">Estacionamiento techado o sótano</option>
												</select>
											</div>
											<div class="col-sm-6">
												<label for="CellContacto">Contacto</label>
												<input type="text" name="CellContacto" id="CellContacto" class="form-control input-sm" placeholder="Contacto" maxlength="11">
											</div>

											<div class="col-sm-12">
												<a id="listarSolicitudes" class="btn btn-default"  href="<?php echo full_url."/adm/solicitud/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>
												<a id="enviaSolicitud" name="" class="btn btn-default"><i class="fa fa-mobile-phone  fa-pull-left fa-border"></i> Solicitar</a>
											</div>			

									</div>	
							  </div>
							</div>						
						

									
		
		
		
		<!--FinCodigo -->
		
		
	</nav>
	<div id="floating-panel">
		
		<a onclick="deleteMarkers(0);" class="btn btn-danger controls" id="delMarkers0"><i class="fa fa-eraser"></i> Borrar origen</a>
		<a onclick="deleteMarkers(1);" class="btn btn-danger controls" id="delMarkers1"><i class="fa fa-eraser"></i> Borrar destino</a>

	</div>
	
	<input id="searchInput" class="controls_search" type="text" placeholder="Coloque el lugar del accidentado">
	<div id="map" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
			<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalMessageLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title" id="myModalMessageLabel"></h4>
				  </div>
				  <div class="modal-body">
				  </div>
				  <div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
</html>

    <script src="../../web/js/jquery.js"></script>
    <script src="../../web/js/bootstrap.min.js"></script>
    <script src="../../web/js/freelancer.js"></script>
    
	<script>
		$(document).ready(function(){												
		$('body').toggleClass('nav-expanded2');
       //Navigation Menu Slider
        $('#nav-expander').on('click',function(e){
      		e.preventDefault();
      		$('body').toggleClass('nav-expanded2');
      	});
      	$('.nav-close').on('click',function(e){
      		//e.preventDefault();
      		$('body').removeClass('nav-expanded2');
      	});
 
      });

		
		
		var idPoliza = $('#idPoliza').val();
		//carga parcial de cliente
					$.ajax({
					  type: "GET",
					  url: '<?php echo full_url?>/adm/Parciales/index.php',
					  data: { action: "parcial_cliente",idPoliza: idPoliza},
					  success: function(html){
							$('#parcial_cliente').html(html);
					  },
					  //dataType: dataType
					});		
		//carga parcial de Poliza
					$.ajax({
					  type: "GET",
					  url: '<?php echo full_url?>/adm/Parciales/index.php',
					  data: { action: "parcial_poliza",idPoliza: idPoliza},
					  success: function(html){
							$('#parcial_poliza').html(html);
					  },
					  //dataType: dataType
					});
		//carga parcial de tips
					$.ajax({
					  type: "GET",
					  url: '<?php echo full_url?>/adm/Parciales/index.php',
					  data: { action: "parcial_tips",idPoliza: idPoliza},
					  success: function(html){
							$('#parcial_tips').html(html);
					  },
					  //dataType: dataType
					});	

	</script>
<script>

// In the following example, markers appear when the user clicks on the map.
// The markers are stored in an array.
// The user can then click an option to hide, show or delete the markers.
var map;
var markers = [];
var labels = '';
var labelIndex = 0;
var color = '';
function initMap() {
  var haightAshbury = {lat: 10.490438279359, lng: -66.85555508755};

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: haightAshbury,
	disableDefaultUI: true,
    zoomControl: true,
    scaleControl: true,
    zoomControl: true,
    zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    },


  });
 


  
  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
    addMarker(event.latLng);
	
  });



   var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        //infowindow.close();
		//alert(1);
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Por favor escriba la dirección aproximada en la barra y espere a que se muestre el texto de ayuda indicado por google.");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(14);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
			//alert(place.address_components[i].types[0]);
			
            if(place.address_components[i].types[0] == 'postal_code'){
                //document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
				//alert(place.address_components[i].long_name);
				$('#country').val(place.address_components[i].long_name);
                //document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'administrative_area_level_1'){
				var estado = place.address_components[i].long_name;
				$('#country').val(place.address_components[i].long_name);
				if(estado == 'Capital District')
				{
					estado = 'Distrito Capital';
				}
				if(estado == 'Federal Dependencies')
				{
					estado = 'Dependencias Federales';
				}
				//alert(estado);
				$('#EstadoOrigen option[value="'+estado+'"]').attr("selected", "selected");
                //document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }			
			
			
        }
		$('#location').val(place.formatted_address);
        //document.getElementById('location').innerHTML = place.formatted_address;
		
        //document.getElementById('lat').innerHTML = place.geometry.location.lat();
		var latlon = "(" + place.geometry.location.lat() + ',' + place.geometry.location.lng()+ ")";
		$('#latlon').val(latlon);
        //document.getElementById('lon').innerHTML = place.geometry.location.lng();
    });
  
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
	var idPoliza = $('#idPoliza').val();
	if(markers.length <= 1)
	{
	
	if(labelIndex==0)
	{
		labels = 'Cliente';
		color = 'green';
	}else
	{
		color = 'blue';
		labels = 'Destino';
	}
	labelIndex++;

	
	
	var marker = new google.maps.Marker({
	  position: location,
	  icon: {
		path: google.maps.SymbolPath.CIRCLE,
		//path: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
		fillColor: 'yellow',
		fillOpacity: 0.8,
		scale: 5,
		strokeColor: color,
		strokeWeight: 14,
	  },
	  draggable: true,
	  map: map,
	  //label: labels[labelIndex++ % labels.length]
	  label: labels
	});
	
	marker.setValues({id: labels});
	
	if(labels == "Cliente"){
		getEstadoOnMap(location);
		$('#latlon').val(location);
		$.getJSON("<?php echo full_url;?>/adm/solicitud/index.php?action=json_cliente&idPoliza=" + idPoliza, function(data) {
			
			var content = "";
			content+="<label> Cédula: </label> " + data.Cedula + "<br>";
			content+="<label> Nombres y apellidos: </label> " + data.Nombre + " " + data.Apellido + "<br>";
			content+="<label> Seguro: </label> " + data.Seguro + "<br>";
			content+="<label> Id.Póliza: </label> " + data.idPoliza + "<br>";
			content+="<label> Núm.Póliza: </label> " + data.NumPoliza + "<br>";
			content+="<label> Placa: </label> " + data.Placa + "<br>";
			content+="<label> Modelo: </label> " + data.Modelo + "<br>";
			content+="<label> Color: </label> " + data.Color + "<br>";
			marker.info = new google.maps.InfoWindow({
			  content: content
			});	
			marker.info.open(map, marker);
			});
			showLocationAddress(location,0);
	}
	
	if(labels== "Destino"){
		$('#latlonl').val(location);
		
		var geocoder = new google.maps.Geocoder;
		geocoder.geocode({'location': location}, function(results, status) {
			marker.info = new google.maps.InfoWindow({
			  content: results[0].formatted_address
			});	
			marker.info.open(map, marker);		
		});
		showLocationAddress(location,1);
		

	}	
	
	var Estado = "";	
	marker.addListener('dragend', function(event) {
		//alert(event.latLng);
		$('#identificador_error').val("");
		if(marker.label == 'Cliente')
		{
			
			$('#latlon').val(event.latLng);
			getEstadoOnMap(event.latLng);
			showLocationAddress(event.latLng,0);
			
		}else if(marker.label == 'Destino')
		{	
			marker.info.close(map.marker);
			
			//alert(Estado);  
			$('#latlonl').val(event.latLng);
			showLocationAddress(event.latLng,1);
			var geocoder = new google.maps.Geocoder;
			geocoder.geocode({'location': event.latLng}, function(results, status) {
				marker.info = new google.maps.InfoWindow({
				  content: results[0].formatted_address
				});	
				marker.info.open(map, marker);		
			});


		}else{
			$('#identificador_error').val("Problemas aaidentificando la dirección, espere un momento y reubique nuevamente el marcador...");
			//alert('Error seleccionando el punto');
		}
		
		
	});

	if(marker.label == 'Cliente')
	{
		if(markers.length >0)
		{
			if(markers[0].hasOwnProperty('id'))
			{
				//alert('existe esta posicion');//debo mover lo del 0 para el 1;
				markers[1] = markers[0];
			}
			
		}
		markers[0] = marker;
	}
	if(marker.label == 'Destino')
	{
		
		markers[1] = marker;
	}	
	//markers.push(marker);
	//console.log(markers);
	  
  }	
	
	



}
function getEstadoOnMap(location){
			$('#identificador_error').val("");
			var geocoder = new google.maps.Geocoder;
			geocoder.geocode({'latLng': location}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
			  //console.log(results);
				if (results[1]) {
				var indice=0;
				for (var j=0; j<results.length; j++)
				{
					if (results[j].types[0]=='locality')
						{
							indice=j;
							break;
						}
					}
				if(results[j])
				{
					for (var i=0; i<results[j].address_components.length; i++)
						{
							if (results[j].address_components[i].types[0] == "locality") {
									//this is the object you are looking for
									city = results[j].address_components[i];
								}
							if (results[j].address_components[i].types[0] == "administrative_area_level_1") {
									//this is the object you are looking for
									region = results[j].address_components[i];
									estado = region.long_name;
									//alert(estado);
									$("#EstadoOrigen").find("option").removeAttr("selected");
									if(estado == 'Capital District')
									{
										estado = 'Distrito Capital';
									}
									if(estado == 'Federal Dependencies')
									{
										estado = 'Dependencias Federales';
									}
									$('#EstadoOrigen option[value="'+estado+'"]').prop("selected", "selected");
									$('#identificador_error').val("");
								}
							if (results[j].address_components[i].types[0] == "country") {
									//this is the object you are looking for
									country = results[j].address_components[i];
								}
						}	
				}

					
					//alert(location);

					//city data
					//alert(city.long_name + " || " + region.long_name + " || " + country.short_name)
					

					} else {
					  	$('#identificador_error').val("Problemas aaidentificando la dirección, espere un momento y reubique nuevamente el marcador...");

					}
				//}
			  } else {
				//alert("Falló obteniendo la dirección intente nuevamente: " + status);
						//$('#identificador_error').val("Problemas identificando la dirección, espere un momento y reubique nuevamente el marcador...");

			  }
			});	

			
}
// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers(index) {
var removeByAttr = function(arr, attr, value){
    var i = arr.length;
    while(i--){
       if( arr[i] 
           && arr[i].hasOwnProperty(attr) 
           && (arguments.length > 2 && arr[i][attr] === value ) ){ 

           arr.splice(i,1);

       }
    }
    return arr;
} 
if(markers.length == 0)
{
	 setMapOnAll(null);
	 markers = [];
	 labelIndex = 0;
}
if(markers.length>0)
{
	if(index == 0)
	{
	
	  if(markers.length == 2)
	  {
		   //alert(1);
		   marker = markers[0]; 
		   labelIndex = 0;
	  }else
	  {
		  //alert(2);
		  marker = markers[0];
		  labelIndex = 0;
	  } 
	  marker.setMap(null);
		removeByAttr(markers, 'id', 'Cliente');
	   //markers.splice(index, 1);
	   $('#latlon').val(null);
	   $('#location').val(null);
	   $('#InfoAdicional').val(null);
	   $("#EstadoOrigen").find("option").removeAttr("selected");

	}
	if(index == 1)
	{
	  if(markers.length == 2)
	  {
		   //alert(3);
		   marker = markers[1]; 
		   labelIndex = 1;
	  }else
	  {
		  //alert(4);
		  marker = markers[0];
		  labelIndex = 0;
	  }

	  marker.setMap(null);
	  
	  removeByAttr(markers, 'id', 'Destino');
	  //markers.splice(index, 1);
	  $('#latlonl').val(null);

	  $('#locationl').val(null);	  
	}

	  //console.log(markers.length);
	  //console.log(labelIndex);
	 // console.log(markers);
}  
}


// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers(index) {
  clearMarkers(index);
  //markers = [];
  //labelIndex = 0;
}

function showLocationAddress(location,parameter) {
var latlng = { lat: 10.500639925300456, lng: -66.86270713806152 };
var geocoder = new google.maps.Geocoder;

	$('#identificador_error').val("");
 geocoder.geocode({'location': location}, function(results, status) {
	
   if (status === google.maps.GeocoderStatus.OK) {
    //$('#location').empty();
    //$('#location').val(results[0].formatted_address);
	//alert(results[0].formatted_address);
	if(parameter == 0)//origen
	{
		$('#location').val(results[0].formatted_address);
		$('#InfoAdicional').val(results[0].formatted_address);
		$('#identificador_error').val("");
		//alert(results[0].address_components[3]['long_name']);
		//$('#EstadoOrigen').val(results[0].address_components[2]['long_name']);
		//$('#EstadoOrigen').val(results[0].geometry.location);
	}else if(parameter == 1)//destino
	{
		
		$('#locationl').val(results[0].formatted_address);
		$('#identificador_error').val("");
		
	}else{
		alert('fallo geolocalizando');
	}
	//return results[0].formatted_address;
  } else {
	  
	 $('#identificador_error').val("Problemas identificando la dirección, espere un momento y reubique nuevamente el marcador...");

	 
   //window.alert('Geocoder failed due to: ' + status);
  }
 });
}

    </script>
<script>
	
	$(document).ready(function(){

		$('#enviaSolicitud').click(function(){
	

			
			//alert(1);
			var latlon = $('#latlon').val();
			latlon = latlon.replace("(", "");
			latlon = latlon.replace(")", "");
			latlon = latlon.split(","); 
			
			var latlonl = $('#latlonl').val();
			latlonl = latlonl.replace("(", "");
			latlonl = latlonl.replace(")", "");
			latlonl = latlonl.split(","); 
			
			//neumaticos
			
			var neumaticos = "";
			var caucho1 = 0;
			var caucho2 = 0;
			var caucho3 = 0;
			var caucho4 = 0;
			

			if ($('#caucho1').is(':checked')) //caucho1
			{
				//alert(1);
				caucho1 = 1;
			}
			if ($('#caucho2').is(':checked')) //caucho2
			{
				//alert(2);
				caucho2 = 1;
			}
			if ($('#caucho3').is(':checked')) //caucho3
			{
				//alert(3);
				caucho3 = 1;
			}
			if ($('#caucho4').is(':checked')) //caucho4
			{
				//alert(4);
				caucho4 = 1;
			}
			
			neumaticos = caucho1 + '' + caucho2 + '' + caucho3 + '' + caucho4;
			//fin neumaticos
			if($('#latlon').val() == '' || $('#latlonl').val() == '')
			{
				alert('Debe indicar las coordenadas');
				return false;				
			}
			
			if($('#identificador_error').val() != '')
			{
				alert('Revise las ubicaciones seleccionadas');
				return false;
			}
			if($('#EstadoOrigen').val() == '')
			{
				alert('Debe seleccionar el estado de origen');
				return false;
			}else if($('#idPoliza').val() == '')
			{
				alert('Debe seleccionar una poliza');
				return false;
			}else if(latlonl=='' || latlon == '')
			{
				alert('Seleccione o arrastre nuevamente los puntos de origen y destino');
				return false;
			}else if($('#QueOcurre' ).val() == '')
			{
				alert('El campo ¿Que ocurre no debe estar vacio?');
				return false;
			}else if($('#Situacion' ).val() == '')
			{
				alert('Debe seleccionar los detalles importantes');
				return false;
			}else if($('#CellContacto').val() == '')
			{
				alert('Por favor indique el número de contacto de la persona que se encuentra con el vehículo, este dato es obligatorio');
				return false;				
			}





			var arr = {
				idPoliza: $('#idPoliza').val(),
				latOrigen:latlon[0],
				lngOrigen: latlon[1],
				latDestino: latlonl[0],
				lngDestino: latlonl[1],
				Direccion: $('#locationl').val(),
				CellContacto: $('#CellContacto').val(),
				InfoAdicional: $('#InfoAdicional').val(),
				EstadoOrigen: $('#EstadoOrigen').val(),
				QueOcurre: $('#QueOcurre').val(),
				Neumaticos:neumaticos,
				Situacion: $('#Situacion').val(),
				Proviene: 'WEB'
			};
				if(!confirm("¿Está seguro de generar la solicitud?"))
				{
					return false;
				}else
				{
					$('#listarSolicitudes').hide();
					$('#enviaSolicitud').text('Generando por favor espere...');
					$('#enviaSolicitud').addClass('disabled');
					//$('body').toggleClass('nav-expanded2');
					
					$.ajax({
						type: "POST",
						url: '<?php echo full_urlapi?>/clienteapp/solicitudCliente.php',
						//url: 'http://52.25.178.106/clienteapp/solicitudCliente.php',
						data: JSON.stringify(arr),
						contentType: 'application/json; charset=utf-8',
						async: false,
						success: function(data){

							
							alert("Solicitud generada satisfactoriamente");
							$(location).attr('href', '<?php echo full_url;?>/adm/solicitud/index.php');
						},
											error: function (request, status, error) {
													alert("Se presentó el error:" + error);

											},      
						crossDomain: true,
						dataType: 'json',
						//success: function() { alert("Success"); },
						//error: function() { alert('Failed!'); },
					});					
				}
				
		});
	});


</script>
<script>

	$("#").ready(function(){
		
		$("#calculaBaremo").click(function(){
			var latlon = $('#latlon').val();
			latlon = latlon.replace("(", "");
			latlon = latlon.replace(")", "");
			latlon = latlon.split(","); 
			
			var latlonl = $('#latlonl').val();
			latlonl = latlonl.replace("(", "");
			latlonl = latlonl.replace(")", "");
			latlonl = latlonl.split(","); 
			
				var arr = {
					idPoliza: $('#idPoliza').val(),
					latOrigen:latlon[0],
					lngOrigen: latlon[1],
					latDestino: latlonl[0],
					lngDestino: latlonl[1],
					Direccion: $('#location').val(),
					CellContacto: $('#CellContacto').val(),
					InfoAdicional: $('#InfoAdicional').val(),
					EstadoOrigen: $('#EstadoOrigen').val(),
					QueOcurre: $('#QueOcurre').val(),
					Neumaticos:'0100',
					Situacion: $('#Situacion').val(),
				};
				
				$.ajax({
					type: "POST",
					url: '<?php echo full_url?>/adm/solicitud/index.php?action=json_baremo',
					//url: 'http://52.25.178.106/clienteapp/solicitudCliente.php',
					data: arr,
					//contentType: 'application/json; charset=utf-8',
					//async: false,
					success: function(data){
						//alert('ready');
					}
				});			
			
			
		});
		
	});

</script>
<script>

$(document).ready(function() {
	
	    $('#Auto').hide();
		$('#QueOcurre').change(function(){
			if($(this).val()=='Neumático espichado')
			{
				$('#Auto').show();
			}else{
				$('#Auto').hide();
				$( "#caucho1" ).prop( "checked", false );
				$( "#caucho2" ).prop( "checked", false );
				$( "#caucho3" ).prop( "checked", false );
				$( "#caucho4" ).prop( "checked", false );
				
				$( "#CauchoA" ).css('fill', "rgb(255,255,255)");
				$( "#CauchoB" ).css('fill', "rgb(255,255,255)");
				$( "#CauchoC" ).css('fill', "rgb(255,255,255)");
				$( "#CauchoD" ).css('fill', "rgb(255,255,255)");
			}
			
		});
	
	
		$('#CauchoA').click(function(e)
		{
			W = $(this).width();
			H = $(this).height();
			X = $(this).position().left;
			Y = $(this).position().top;
			

			if ($('#caucho1').is(':checked')) {
				$(this).css('fill', "rgb(255,255,255)");
				$( "#caucho1" ).prop( "checked", false );
			}else{
				$(this).css('fill', "rgb(0,0,0)");
				$( "#caucho1" ).prop( "checked", true );			
			}
			
			
		});
		$('#CauchoB').click(function(e)
		{
			W = $(this).width();
			H = $(this).height();
			X = $(this).position().left;
			Y = $(this).position().top;
			

			if ($('#caucho2').is(':checked')) {
				$(this).css('fill', "rgb(255,255,255)");
				$( "#caucho2" ).prop( "checked", false );
			}else{
				$(this).css('fill', "rgb(0,0,0)");
				$( "#caucho2" ).prop( "checked", true );			
			}
			
			
		});
		$('#CauchoC').click(function(e)
		{
			W = $(this).width();
			H = $(this).height();
			X = $(this).position().left;
			Y = $(this).position().top;
			

			if ($('#caucho3').is(':checked')) {
				$(this).css('fill', "rgb(255,255,255)");
				$( "#caucho3" ).prop( "checked", false );
			}else{
				$(this).css('fill', "rgb(0,0,0)");
				$( "#caucho3" ).prop( "checked", true );			
			}
			
			
		});
		$('#CauchoD').click(function(e)
		{
			W = $(this).width();
			H = $(this).height();
			X = $(this).position().left;
			Y = $(this).position().top;
			

			if ($('#caucho4').is(':checked')) {
				$(this).css('fill', "rgb(255,255,255)");
				$( "#caucho4" ).prop( "checked", false );
			}else{
				$(this).css('fill', "rgb(0,0,0)");
				$( "#caucho4" ).prop( "checked", true );			
			}
			
			
		});
});


</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=false&callback=initMap&libraries=places"></script>
