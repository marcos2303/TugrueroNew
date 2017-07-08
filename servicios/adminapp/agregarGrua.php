<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"Agregado"=>0,"MensajeError"=>"No agregado","MensajeSuccess"=> '',"IdGrua"=>"0");
/*$values['IdProveedor'] = 1;
$values['IdGruaTipo'] = 1;
$values['IdMarca'] = 12;
$values['Estatus'] = 0;
$values['Placa'] = 0;*/
/*************************Creamos la grua************************************/
$valido = true;
$datos_existe = $Gruas->getExistePlaca($values['Placa']);
if($datos_existe["cuenta"]>0){
	$response = array("Error"=>1,"Agregado"=> 0,"MensajeError"=>"La placa ya se encuentra registrada para otra grúa","MensajeSuccess"=> '',"Placa"=>$values['Placa']);
	$valido = false;
}
if($valido){
	if($Gruas ->addGrua($values)){
		$response = array("Error"=>0,"Agregado"=>1,"MensajeError" => "","MensajeSuccess"=> "OK","IdGrua"=>$Gruas->getIdGrua());
	}
}


echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
