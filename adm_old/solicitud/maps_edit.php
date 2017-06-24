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
.modal-dialog-center {
    margin-top: 40%;
	padding-left: 60%;
}	
</style>
	<div class="modal fade modal-lg" id="myModalCargando" tabindex="-2" role="dialog" aria-labelledby="myModalCargandoLabel">
	  <div class="modal-dialog modal-lg modal-dialog-center" role="document">
		<div class="modal-content">
		  <div class="modal-body">
			  <i class="fa fa-circle-o-notch fa-spin fa-5x"></i> Actualizando solicitud
		  </div>
		</div>
	  </div>
	</div>
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
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<form class="form-horizontal" action="#" method="POST">
					<div id="form-group">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" hidden>
							<input id="country" id="country" type="hidden" value="" class="controls">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">		
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne" style="background-color: #404040 !important;">
								  <h4 class="panel-title" style="color: white !important;">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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
								  <h4 class="panel-title" style="color: white !important;">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									 Tips de Condicionado
									</a>
								  </h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body" style="background-color: #ccc !important;" id="parcial_tips">
									  
								  </div>
								</div>
							  </div>
							</div>						
						</div>		
						<div class="row"></div>
						<input type="hidden" value="<?php echo $values['idPoliza']?>" name="idPoliza" id ="idPoliza">
						<input type="hidden" value="<?php echo $values['idSolicitud']?>" name="idSolicitud" id ="idSolicitud">
						<div class="panel panel-default">
						  <div class="panel-heading" style="background-color: #404040 !important;">
							<h3 class="panel-title"  style="color: white !important;">Detalle de solicitud</h3>
						  </div>
						  <div class="panel-body" style="background-color: #ccc !important;" id="parcial_solicitud">
									<div class="col-sm-12">
										<label for="EstadoOrigen">Estado origen: </label>
										<?php echo $values['EstadoOrigen']?>
									</div>
									<div class="col-sm-12">
										<label for="locationl">Direccion destino: </label>
										<?php echo $values['Direccion']?>
									</div>
									<div class="col-sm-12">
										<label for="QueOcurre">¿Qué ocurre?: </label>
										<?php echo $values['QueOcurre'];?>
									</div>
									<div class="col-sm-12">
											<label for="">Neúmaticos delanteros: </label>
											<?php echo $values['Neumaticos'];?>
									</div>
									<div class="col-sm-12">
										<label for="Situacion">Detalles importantes: </label>
											<?php echo $values['Situacion'];?>

									</div>
									<div class="col-sm-12">
										<label for="CellContacto">Contacto: </label>
										<?php echo $values['CellContacto'];?>
									</div>
									<div class="col-sm-12">
										<label for="InfoAdicional">Informacion adicional: </label>
										<?php echo $values['InfoAdicional'];?>
									</div>
									<div class="col-sm-12">
										<label for="InfoAdicional">Monto sin IVA: </label>
										<?php setlocale(LC_NUMERIC,"es_ES.UTF8");echo number_format($values['Monto'],2,",",".");?> Bs
									</div>	
						  </div>
						</div>
						<div>
						<div class="panel panel-default">
						  <div class="panel-heading" style="background-color: #404040 !important;">
							<h3 class="panel-title"  style="color: white !important;">Cambio de monto</h3>
						  </div>
						  <div class="panel-body" style="background-color: #ccc !important;">
							  <div class="col-sm-12">
								<label for="">Monto</label>
								<input type="number" id="MontoNuevo" value="<?php echo $values['Monto']?>">
								<input type="number" id="Monto" value="<?php echo $values['Monto']?>" class="hidden"> 
							  </div>
							  <div class="col-sm-12">
							  <label for="MotivoMonto">Motivo</label>
							  <input class="" id="MotivoMonto" value="" placeholder="Indique el motivo del cambio" size="80">
							  </div>

								<a class="btn btn-default " onclick="actualizaMonto();"><i class="fa fa-check"></i>Cambiar</a>
						  </div>
						</div>
							
							
							
							

						</div>
						<a class="btn btn-default"  href="<?php echo full_url."/adm/solicitud/index.php"?>"><i class="fa fa-arrow-left  fa-pull-left fa-border"></i> Regresar</a>

				</div>				
		
		
		
		<!--FinCodigo -->
		
		
	</nav>
	<div id="map" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
</html>

    <script src="../../web/js/jquery.js"></script>
    <script src="../../web/js/bootstrap.min.js"></script>
    <script src="../../web/js/freelancer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1_5ATmWh8kZkKHo6skucFrl9emI3dPMA&signed_in=false&libraries=places"></script>
   
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
		var idSolicitud = $('#idSolicitud').val();
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
		//carga parcial de Poliza
					$.ajax({
					  type: "GET",
					  url: '<?php echo full_url?>/adm/Parciales/index.php',
					  data: { action: "parcial_tips",idPoliza: idPoliza},
					  success: function(html){
							$('#parcial_tips').html(html);
					  },
					  //dataType: dataType
					});
		//carga parcial solicitud;
					$.ajax({
					  type: "GET",
					  url: '<?php echo full_url?>/adm/Parciales/index.php',
					  data: { action: "parcial_solicitud",idSolicitud: idSolicitud},
					  success: function(html){
							$('#parcial_solicitud').html(html);
					  },
					  //dataType: dataType
					});			

	</script>
	<script>
		
		function actualizaMonto()
		{	
			

			
			
					var idSolicitud = $('#idSolicitud').val();
					var Monto = parseFloat($('#Monto').val());
					var MontoNuevo = parseFloat($('#MontoNuevo').val());
					var MotivoMonto = $('#MotivoMonto').val();
					if(typeof MontoNuevo==='number' && !Number.isNaN(MontoNuevo)) {
						
					}else{
						alert("El monto debe ser numérico");
						return false;
					}
					
					
					if(MotivoMonto == ''){
						alert("Debe indicar el motivo del cambio");
						return false;
					}

					
					if(confirm("¿Está seguro(a) de cambiar el monto para la solicitud #?" + idSolicitud)){
					$('#myModalCargando').modal({
					  backdrop: 'static',
					  keyboard: false,
					});			

					$('body').toggleClass('nav-expanded2');
					$('#myModalCargando').modal({
					  backdrop: 'static',
					  keyboard: false,
					});	
					$('#myModalCargando').modal('show');
						$.ajax({
						  type: "POST",
						  url: '<?php echo full_url?>/adm/solicitud/index.php?action=actualiza_monto',
						  data: { action: "actualiza_monto",idSolicitud: idSolicitud,Monto: Monto, MontoNuevo: MontoNuevo,MotivoMonto:MotivoMonto},
						  success: function(html){
							 $('#myModalCargando').modal('toggle');
							 alert("Monto cambiado satisfactoriamente");
							 $(location).attr('href', '<?php echo full_url;?>/adm/solicitud/index.php?action=edit&idSolicitud='+idSolicitud+ "&idPoliza=" + idPoliza);
								//$('#parcial_cliente').html(html);
						  },
						  //dataType: dataType
						});		
					}else{
						return false;
					}
					
			
		}


	</script>

	<script>

      // This example adds a marker to indicate the position of Bondi Beach in Sydney,
      // Australia.
		var markerStore = {};
        var markersID = [];
		var array_existe = [];
		var INTERVAL = 10000;
		var myLatlng = new google.maps.LatLng(10.5168373,-66.9279394);
		var myOptions = {
			zoom: 14,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
		}
    var map = new google.maps.Map(document.getElementById("map"), myOptions);

    getMarkers();
function getMarkers() {
		$.each(markersID, function(i, value) {
			//console.log(value);
			var existe_en_json = array_existe.indexOf("" + value + ""); 
			if(existe_en_json == -1)
				{
					//console.log('No Existe' + value);
					console.log(existe_en_json);
					if((markerStore.hasOwnProperty(value))){
						marker = markerStore[value];
						marker.setMap(null);
						//console.log(marker);
						delete markerStore[value];
					}

					 
				}
		});
		//console.log(markerStore);
		//console.log(markersID);
		array_existe = [];	


$.getJSON("<?php echo full_url;?>/adm/solicitud/index.php?action=json_solicitud_livemap&idSolicitud=<?php echo $values['idSolicitud']?>", function(json1) {
			$.each(json1, function(key, data) {
                                $.each(data, function(key, data) {
                                                                    
                                        
									array_existe.push(data.idSolicitud + data.id);
                                    
                                    if((markerStore.hasOwnProperty(data.idSolicitud + data.id))) {
										
										
									}
                                    
                                    if((markerStore.hasOwnProperty(data.idSolicitud + data.id))) {
	
											var existe_en_json = array_existe.indexOf(markersID[data.idSolicitud + data.id]); 

                                            markerStore[data.idSolicitud + data.id].setPosition(new google.maps.LatLng(data.lat, data.lng));
                                            markerStore[data.idSolicitud + data.id].setIcon({
                                                      path: google.maps.SymbolPath.CIRCLE,
                                                      fillColor: 'yellow',
                                                      fillOpacity: 0.8,
                                                      scale: 1,
                                                      strokeColor: data.iconcolor,
                                                      strokeWeight: 14,
                                                    });
                                    }else{
                                            
                                            var latLng = new google.maps.LatLng(data.lat, data.lng);
                                            var marker = new google.maps.Marker({
                                                    position: latLng,
                                                    icon: {
                                                      path: google.maps.SymbolPath.CIRCLE,
                                                      fillColor: 'yellow',
                                                      fillOpacity: 0.8,
                                                      scale: 1,
                                                      strokeColor: data.iconcolor,
                                                      strokeWeight: 14,
                                                    },
                                                    map: map,
                                                    title: data.title,
                                                    label: data.label,
                                                    id: data.idSolicitud + data.id
                                            });
                                    // Creating a marker and putting it on the map
											var infowindow = new google.maps.InfoWindow({
															content: data.contentinfo
											});
                                            if(data.id != 0)
                                            {
                                            
                                            infowindow.open(map, marker);
                                                    marker.addListener('click', function() {
                                                            infowindow.open(map, marker);
                                                    });						
                                            }
                                            if(data.id == 0)
                                            {       
                                                    var center = new google.maps.LatLng(data.latCenter, data.lngCenter);
                                                    map.panTo(center);
                                            }					
                                            marker.addListener('click', function() {
                                                    infowindow.open(map, marker);
                                            });
                                            markerStore[data.idSolicitud + data.id] = marker;
											markersID.push(data.idSolicitud + data.id);
                                    }

				

                                });
			});
                        
		});
		
		window.setTimeout(getMarkers,INTERVAL);
}

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
						alert('ready');
					}
				});			
			
			
		});
		
	});

</script>
