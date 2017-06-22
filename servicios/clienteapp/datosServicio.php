<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');


/************* Clases a utilizar *******************/
$Servicios = new Servicios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"Servicio no existe","MensajeSuccess"=> '',"IdServicio"=>"");
$datos_poliza = $Polizas->getLoginPoliza($values);
if($datos_poliza){
	$response = array(
		"Error"=>0,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Ok',
		"IdServicio"=>$datos_poliza['IdServicio'],
		"Nombres"=> $datos_poliza['Nombres'],
		"Apellidos"=> $datos_poliza['Nombres'],
		"IdServicio"=> $datos_poliza['Nombres'],
		"IdServicio"=> $datos_poliza['Nombres'],
		"IdServicio"=> $datos_poliza['Nombres'],
		"IdServicio"=> $datos_poliza['Nombres'],
		"IdServicio"=> $datos_poliza['Nombres'],
		"IdServicio"=> $datos_poliza['Nombres'],
		);

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);