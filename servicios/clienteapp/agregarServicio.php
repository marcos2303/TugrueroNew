<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Servicios = new Servicios();
$ServiciosClientes = new ServiciosClientes();
$ServiciosPrecios = new ServiciosPrecios();
$Baremo = new Baremo();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
$values['IdAplicacion'] = 1;
$values['IdUsuario'] = 1;
$values['IdServicioTipo'] = 1;
$values['IdCondicionLugar'] = 1;
$values['IdAveria'] = 3;
$values['LatitudOrigen']  = '10.2131868';
$values['LongitudOrigen']  = '-67.8862887';
$values['LatitudDestino']  = '10.212626514872';
$values['LongitudDestino']  = '-67.8864110297';
$values['IdEstatus']  = '1';
if(!isset($values['Inicio']) or $values['Inicio']==''){
	$values['Inicio'] = date('Y-m-d h:i:s');
}
if(!isset($values['KM']) or $values['KM']==''){
//Calculo de KM en caso que no envie
$values['KM'] = $Baremo->getDistancia($values['LatitudOrigen'], $values['LongitudOrigen'], $values['LatitudDestino'], $values['LongitudDestino'] );
}
if(!isset($values['Neumaticos']) and $values['Neumaticos']==''){
	$values['Neumaticos'] = '1000';
}
/**********************se efectua el calculo del baremo automatico****************************/
//calculo el precio sin iva
$values['PrecioSIvaBaremo'] = $Baremo->calcularOferta( $values['KM'], $values['IdAveria'], $values['Neumaticos'],$values['IdCondicionLugar'] , $values['Inicio']);
//calculo el precio con iva
$values['PrecioCIvaBaremo'] = $values['PrecioSIvaBaremo'] * 1.12;
/*************************Creamos el Servicio************************************/
//Insertamos en Servicios
if(!$Servicios ->addServicios($values)){
	$response = array("Error"=>1,"MensajeError" => "Se ha presentado un error. Intente de nuevo.");
	echo json_encode($response);die;
}
$values['IdServicio'] = $Servicios->getIdServicio();//Variable IdServicio
//insertamos en ServiciosCliente
if(!$ServiciosClientes ->addServiciosClientes($values)){
	$response = array("Error"=>0,"MensajeError" => "Se ha presentado un error. Intente de nuevo.");
	echo json_encode($response);die;
}
//insertamos en ServiciosPrecios
if(!$ServiciosPrecios ->addServiciosPrecios($values)){
	$response = array("Error"=>0,"MensajeError" => "Se ha presentado un error. Intente de nuevo.");
	echo json_encode($response);die;	
}
/***********************Localizar Grúas y enviar push*************************************************/

$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>$values['IdServicio']);
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
