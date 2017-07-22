<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Gruas= new Gruas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"","MensajeSuccess"=> '',"IdGrua"=>$values['IdGrua'],"Placa"=>$values['Placa'],"DatosGrua" => null);
/*************************Actualizamos************************************/
$valido = true;

if($Gruas->updateGrua($values)){

	$datos_gruero = $Gruas->getGruaInfo($values['IdGrua']);

	$response = array(
		"Error"=>0,"Actualizado"=> 1,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Datos actualizados',
		"IdGrua"=>$values['IdGrua'],
		"Placa"=>$values['Placa'],
		"DatosGrua" => $datos_gruero
	);
}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
