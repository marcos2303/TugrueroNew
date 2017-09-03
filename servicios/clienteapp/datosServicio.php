<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');

/************* Clases a utilizar *******************/
$Servicios = new Servicios();
$ServiciosEstatus = new ServiciosEstatus();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"Servicio no existe","MensajeSuccess"=> '',"IdServicio"=>"");

$datos = $Servicios->getServiciosInfo($values);
$datos_estatus = $ServiciosEstatus->getListaServicioEstatus($values);
if($datos){
	$response["Error"] = 0;
	$response["MensajeError"] = "";
	$response["MensajeSuccess"] = "OK";	
	foreach($datos as $key=> $value){
		$response[$key] = $value;
	}
	$response["Error"] = 0;
	$response["MensajeError"] = "";
	$response["MensajeSuccess"] = "OK";
}
if($datos_estatus){
	foreach($datos_estatus as $key => $value){
		$response["Estatus"][$key] = $value;
		//print_r($key);die;
	}	
}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
