<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/

$response = array("Error"=>1,"MensajeError"=>"No existe grúa registrada con la placa indicada","MensajeSuccess"=> '');

$datos = $Gruas->getGruaInfoPlaca($values['Placa']);
if($datos){
	$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> '',"Existe" => 1,"MismoProveedor" => 0);
	$response = array(
		"Error"=>0,
		"MensajeError"=>"",
		"MensajeSuccess"=> '',
		'IdGrua' => $datos['IdGrua'],
		'IdProveedor' => $datos['IdProveedor'],
		'IdGruaTipo' => $datos['IdGruaTipo'],
		'IdMarca' => $datos['IdMarca'],
		'Placa' => $datos['Placa'],
		'Modelo' => $datos['Modelo'],
		'Anio' => $datos['Anio'],
		'Color' => $datos['Color'],
		'Clave' => $datos['Clave'],
		'Disponible' => $datos['Disponible'],
		'Latitud' => $datos['Latitud'],
		'Longitud' => $datos['Longitud'],
		'UltimaActualizacion' => $datos['UltimaActualizacion'],
		'Token' => $datos['Token'],
		'DeviceId' => $datos['DeviceId'],
		'GPSOn' => $datos['GPSOn'],
		'MismoProveedor' => 1
		);
		if($values['IdProveedor'] != $datos['IdProveedor']){
			$response['MismoProveedor'] = 0;
		}
}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);