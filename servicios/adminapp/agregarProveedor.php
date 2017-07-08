<?php
//header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Proveedores = new Proveedores();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"Agregado"=>0,"MensajeError"=>"","MensajeSuccess"=> '');
$valido = true;
/*************************Creamos************************************/

$datos_existe = $Proveedores->getExisteProveedor($values['IdProveedor'],$values['Identificacion']);
if($datos_existe["cuenta"]>0){
	$response = array("Error"=>1,"Agregado"=> 0,"MensajeError"=>"La Cédula o RIF ya se encuentra registrada","MensajeSuccess"=> '',"IdProveedor"=>"");
	$valido = false;
}

if($valido){
	if($Proveedores ->addProveedor($values)){
		$response = array("Error"=>0,"Agregado"=>1,"MensajeError" => "","MensajeSuccess"=> "OK","IdProveedor"=>$Proveedores->getIdProveedor());
	}
}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
