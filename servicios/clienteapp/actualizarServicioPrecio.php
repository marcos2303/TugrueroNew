<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$ServiciosPrecios = new ServiciosPrecios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"No actualizado.","MensajeSuccess"=> '');
$values['IdServicio'] = 50;
$values['PrecioModificado'] = 2;
/*************************Actualizamos el Servicio************************************/

if($ServiciosPrecios->updateServiciosPrecios($values)){
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>$values['IdServicio']);
	
}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
