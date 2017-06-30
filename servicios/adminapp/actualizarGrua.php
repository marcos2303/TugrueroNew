<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Gruas= new Gruas();

/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"","MensajeSuccess"=> '',"IdGrua"=>$values['IdGrua'],"Placa"=>$values['Placa']);
/*************************Actualizamos************************************/
$valido = true;
$datos_existe = $Gruas->getExistePlaca($values['IdGrua'], $values['Placa']);
if($datos_existe["cuenta"]>0){
	$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"La placa ya se encuentra registrada para otra grúa","MensajeSuccess"=> '',"IdGrua"=>$values['IdGrua'],"Placa"=>$values['Placa']);
	$valido = false;
}

if($valido){
	if($Gruas->updateGrua($values)){
	$response = array("Error"=>0,"Actualizado"=> 1,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdGrua"=>$values['IdGrua'],"Placa"=>$values['Placa']);

	}	
}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
