<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
//$values['IdGrua'] = 1;
$response = array("Error"=>1,"MensajeError"=>"Grúa no existe.","MensajeSuccess"=> '',"IdGrua"=>"");
$datos = $Gruas->getGruaInfo($values['IdGrua']);
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
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
