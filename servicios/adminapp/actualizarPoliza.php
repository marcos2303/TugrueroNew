<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Polizas = new Polizas();
//$values["IdPoliza"] = 2;
//$values["Cedula"] = 1234678;
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"","MensajeSuccess"=> '',"IdPoliza"=>$values['IdPoliza']);
/*************************Actualizamos************************************/

$valido = true;
if($valido){
	if($Polizas->updatePolizas($values)){
		$response = array("Error"=>0,"Actualizado"=> 1,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdPoliza"=>$values['IdPoliza']);

	}

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
