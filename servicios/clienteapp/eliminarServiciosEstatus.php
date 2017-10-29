<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Servicios = new Servicios();
$ServiciosEstatus = new ServiciosEstatus();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Eliminado"=>"0","MensajeError"=>"","MensajeSuccess"=> '');
/*************************Actualizamos el Servicio************************************/

  if($ServiciosEstatus->deleteServiciosEstatus($values)){

    $response = array("Error"=>0,
    "Eliminado"=>"1",
    "MensajeError"=>"",
    "MensajeSuccess"=> 'Ok',
    "IdServicio"=>$values['IdServicio'],

    );
  }

if(isset($values['IdServicio']) and $values['IdServicio']!=''){
  $estatus_anterior = $ServiciosEstatus -> getEstatusAnterior($values);
  $valores_update = array();
  $valores_update['IdServicio'] = $values['IdServicio'];
  $valores_update['IdEstatus'] = $estatus_anterior[0]['IdEstatus'];
	$Servicios->updateServicios($valores_update);
	//var_dump($data_servicio);die;
}

$DatosServicio = $Servicios->getServiciosInfo($values);
$response["DatosServicio"] = $DatosServicio;



echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
