<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');


/************* Clases a utilizar *******************/
$Servicios = new Servicios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"Servicio no existe","MensajeSuccess"=> '',"IdServicio"=>"");
$datos = $Servicios->getServiciosInfo($values);
if($datos){
	$response = array(
		"Error"=>0,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Ok',
		"IdServicio"=>$datos['IdServicio'],
		/***************Cliente*********************/
		"Nombres"=> $datos['Nombres'],
		"Apellidos"=> $datos['Apellidos'],
		"Cedula"=> $datos['Cedula'],
		/*************Vehiculo***********************/
		"Placa"=> $datos['Placa'],
		"IdMarca"=> $datos['IdMarca'],
		"Modelo"=> $datos['Modelo'],
		"Color"=> $datos['Color'],
		"Anio"=> $datos['Anio'],
		//***********Servicio************************/
		"IdEstatus"=> $datos['IdEstatus'],
		"CodigoServicio"=> $datos['CodigoServicio'],
		"IdServicioTipo"=> $datos['IdServicioTipo'],
		"Agendado"=> $datos['Agendado'],
		"FechaAgendado"=> $datos['FechaAgendado'],
		"IdAveria"=> $datos['IdAveria'],
		"AveriaDetalle"=> $datos['AveriaDetalle'],
		"IdCondicionLugar"=> $datos['CondicionDetalle'],
		"LatitudOrigen"=> $datos['LatitudOrigen'],
		"LongitudOrigen"=> $datos['LongitudOrigen'],
		"IdEstadoOrigen"=> $datos['IdEstadoOrigen'],
		"DireccionOrigen"=> $datos['DireccionOrigen'],
		"DireccionOrigenDetallada"=> $datos['DireccionOrigenDetallada'],
		"LatitudDestino"=> $datos['LatitudDestino'],
		"LongitudDestino"=> $datos['LongitudDestino'],
		"IdEstadoDestino"=> $datos['IdEstadoDestino'],
		"DireccionDestino"=> $datos['DireccionDestino'],
		"KM"=> $datos['KM'],
		"Inicio"=> $datos['Inicio'],
		"Fin"=> $datos['Fin'],
		"Observacion"=> $datos['Observacion'],
		"UltimaActCliente"=> $datos['UltimaActCliente'],
		"UltimaActGruero"=> $datos['UltimaActGruero'],
		/****************Gruero*********************/
		"IdGrua"=> $datos['IdGrua'],
		"IdProveedor"=> $datos['IdProveedor'],
		"IdGruaTipo"=> $datos['IdGruaTipo'],
		"IdMarcaGruero"=> $datos['IdMarcaGruero'],
		"NombresGruero"=> $datos['NombresGruero'],
		"ApellidosGruero"=> $datos['ApellidosGruero'],
		"PlacaGruero"=> $datos['PlacaGruero'],
		"ModeloGruero"=> $datos['ModeloGruero'],
		"AnioGruero"=> $datos['AnioGruero'],
		"ColorGruero"=> $datos['ColorGruero'],
		"CelularGruero"=> $datos['CelularGruero'],
		"CedulaGruero"=> $datos['CedulaGruero'],
		"LatitudGruero"=> $datos['LatitudGruero'],
		"LongitudGruero"=> $datos['LongitudGruero'],
		"NombresGruero"=> $datos['NombresGruero'],
		/*****************Servicios Precio*************************/
		"PrecioModificado"=> $datos['PrecioModificado'],
		"PrecioSIvaBaremo"=> $datos['PrecioSIvaBaremo'],
		"PrecioCIvaBaremo"=> $datos['PrecioCIvaBaremo'],
		"PrecioSIvaModificado"=> $datos['PrecioSIvaModificado'],
		"PrecioCIvaModificado"=> $datos['PrecioCIvaModificado'],
		"IdUsuarioPermiso"=> $datos['IdUsuarioPermiso'],


		);

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
