<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);

include('../../autoload_servicios.php');
$Servicios = new Servicios();
//$version = curl_version();
$response = array("Error"=>0,"MensajeError"=>"Se presentó un error al enviar la petición.","MensajeSuccess"=> '',"result" => array());

$datos_servicio = $Servicios->getServiciosInfo($values);
$values["Modelo"] = $datos_servicio["Modelo"];
$values["Inicio"] = $datos_servicio["Inicio"];
$values["AveriaNombre"] = $datos_servicio["AveriaNombre"];
$values["CodigoServicio"] = $datos_servicio["CodigoServicio"];
$values["LatitudOrigen"] = $datos_servicio["LatitudOrigen"];
$values["LongitudOrigen"] = $datos_servicio["LongitudOrigen"];
$values["LatitudDestino"] = $datos_servicio["LatitudDestino"];
$values["LongitudDestino"] = $datos_servicio["LongitudDestino"];
$values["CodigoServicio"] = $datos_servicio["CodigoServicio"];
$values["IdEstatus"] = $datos_servicio["IdEstatus"];
$values["result"] =  $Servicios->enviarServicio($values);
if($values["result"]){
  $response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> '',"result" =>json_decode($values["result"]));
}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
