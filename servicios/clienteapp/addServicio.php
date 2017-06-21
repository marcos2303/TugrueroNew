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

$values['IdAplicacion'] = 1;
$values['IdUsuario'] = 1;
$values['IdServicioTipo'] = 1;
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
$LatitudOrigen = '10.2131868';
$LongitudOrigen = '-67.8862887';
$LatitudDestino = '10.212626514872';
$LongitudDestino = '-67.8864110297';
if(!isset($values['Inicio']) or $values['Inicio']==''){
	$values['Inicio'] = date('Y-m-d h:i:s');
}

if(!isset($values['KM']) or $values['KM']==''){
//Calculo de KM en caso que no envie
$values['KM'] = $Baremo->getDistancia($LatitudOrigen, $LongitudOrigen, $LatitudDestino, $LongitudDestino);
}
/**********************se efectua el calculo del baremo automatico****************************/
//calculo el precio sin iva
$values['PrecioSIvaBaremo'] = $Baremo->calcularOferta( $values['KM'], "Encunetado", '1000', "Atascado en barro o arena.", $values['Inicio']);
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
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>$values['IdServicio']);
echo json_encode($response);die;



