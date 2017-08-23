<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$ServiciosPrecios = new ServiciosPrecios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"Actualizado" => 0,"MensajeError"=>"No actualizado.","MensajeSuccess"=> '');
/*************************Actualizamos el Servicio************************************/

if(isset($values['FechaFacturaFisica']) and $values['FechaFacturaFisica']!=''){
	$values['FechaEstimadaPago'] = $ServiciosPrecios->calculaFechaEstimadaPago($values['FechaFacturaFisica'],10);
}

if($ServiciosPrecios->updateServiciosPrecios($values)){
$response = array(
	"Error"=>0,
    "Actualizado" => 1,
	"MensajeError"=>"",
	"MensajeSuccess"=> 'Ok',
	"IdServicio"=> $values['IdServicio'],
	"FechaEstimadaPago" =>  $values['FechaEstimadaPago']

);

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
