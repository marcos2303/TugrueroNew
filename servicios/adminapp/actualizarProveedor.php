<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Proveedores = new Proveedores();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"","MensajeSuccess"=> '',"IdProveedor"=>$values['IdProveedor']);
/*************************Actualizamos************************************/

if($Proveedores->updateProveedores($values)){
$response = array("Error"=>0,"Actualizado"=> 1,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdProveedor"=>$values['IdProveedor']);
	
}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
