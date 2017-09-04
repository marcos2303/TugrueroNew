<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);

include('../../autoload_servicios.php');
$Servicios = new Servicios();
//$version = curl_version();
$response = array("Error"=>0,"MensajeError"=>"Se presentó un error al enviar la petición.","MensajeSuccess"=> '',"result" => array());
  /*$values["IdServicio"]="212";
  $values["TipoEnvio"] = "Masivo";
  $values["LatitudOrigen"] = "10.5216435";
  $values["LongitudOrigen"] = "-66.92799379999997";
  $values["IdEstadoOrigen"]="11";
  $values["notification"] = array(
  $values["body"] = "¡Nuevo servicio de Grúa!",
  $values["title"] = "TU/GRUERO®",
  $values["sound"] = "default");*/
$datos_servicio = $Servicios->getServiciosInfo($values);
$values["Modelo"] = $datos_servicio["Modelo"];
$values["Inicio"] = $datos_servicio["Inicio"];
$values["AveriaNombre"] = $datos_servicio["AveriaNombre"];

$values["result"] =  $Servicios->enviarServicio($values);
if($values["result"]){
  $response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> '',"result" =>json_decode($values["result"]));
}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
