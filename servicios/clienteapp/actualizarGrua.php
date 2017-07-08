<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"No actualizado.","MensajeSuccess"=> '');
$values['IdGrua'] = 1;
$values['Modelo'] = '12345';
/*************************Actualizamos la Grua************************************/

if($Gruas->updateGrua($values)){
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdGrua"=>$values['IdGrua']);
	
}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
