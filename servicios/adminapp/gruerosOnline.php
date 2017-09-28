<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
//$values['IdGrua'] = 1;
$response = array("Error"=>1,"MensajeError"=>"Problemas en el servicio","MensajeSuccess"=> '');
$datos = $Gruas->getGruerosOnOffLine();
if($datos){
	$data = array();
	$response["Error"] = 0;
	$response["MensajeError"] = "";
	$response["MensajeSuccess"] = "OK";	
	foreach($datos as $key=> $value){
		
		$data[$key] = $value;
		
		
	}
	$response["data"] = $data;
	$response["Error"] = 0;
	$response["MensajeError"] = "";
	$response["MensajeSuccess"] = "OK";

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
