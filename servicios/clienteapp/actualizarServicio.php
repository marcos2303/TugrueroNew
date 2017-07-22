<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Servicios = new Servicios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=>"0","MensajeError"=>"","MensajeSuccess"=> '');
/*************************Actualizamos el Servicio************************************/

if($Servicios->updateServicios($values)){

  $response = array("Error"=>0,
  "Actualizado"=>"1",
  "MensajeError"=>"",
  "MensajeSuccess"=> 'Ok',
  "IdServicio"=>$values['IdServicio'],

  );

}
$DatosServicio = $Servicios->getServiciosInfo($values);
$response["DatosServicio"] = $DatosServicio;



echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
