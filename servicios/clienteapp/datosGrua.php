<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
//$values['IdGrua'] = 1;
$response = array("Error"=>1,"MensajeError"=>"Grúa no existe.","MensajeSuccess"=> '',"IdServicio"=>"");
$datos = $Gruas->getGruaInfo($values['IdGrua']);
if($datos){
	$response = array(
		"Error"=>0,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Ok',
		/***************Grua*********************/
		"IdGrua" => $datos['IdGrua'],
		"IdProveedor" => $datos['IdProveedor'],
		"IdGruaTipo" => $datos['IdGruaTipo'],
		"IdMarca" => $datos['IdMarca'],
		"Estatus" => $datos['Estatus'],
		"Placa" => $datos['Placa'],
		"Modelo" => $datos['Modelo'],
		"Anio" => $datos['Anio'],
		"Color" => $datos['Color'],
		"Celular" => $datos['Celular'],
		"Disponible" => $datos['Disponible'],
		"UltimaActualizacion" => $datos['UltimaActualizacion'],
		"Token" => $datos['Token'],
		"DeviceId" => $datos['DeviceId'],
		"GPSOn" => $datos['GPSOn'],
		/***************Proveedor*********************/		
		"NombresProveedor" => $datos['NombresProveedor'],
		"ApellidosProveedor" => $datos['ApellidosProveedor'],
		/******************Marca****************************/
		"NombreMarca" => $datos['NombreMarca'],
		/******************Gruas tipo********************************/
		"NombreGruasTipo" => $datos['NombreGruasTipo'],
		
		);

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);