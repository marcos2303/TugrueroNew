<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"","MensajeSuccess"=> '',"IdGrua"=>"0");
/*$values['IdProveedor'] = 1;
$values['IdGruaTipo'] = 1;
$values['IdMarca'] = 12;
$values['Estatus'] = 0;
$values['Placa'] = 0;*/
/*************************Creamos la grua************************************/
if(!$Gruas ->addGrua($values)){
	$response = array("Error"=>1,"MensajeError" => "Se ha presentado un error. Intente de nuevo.");
}else{
	$response = array("Error"=>0,"MensajeError" => "","MensajeSuccess"=> "OK","IdGrua"=>$Gruas->getIdGrua());
}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
