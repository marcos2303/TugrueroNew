<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);

include('../../autoload_servicios.php');
$Push = new Push();
/*$values["IdServicio"] = 951;
$values["IdAplicacion"] = 1;*/
//$datos_servicio = $Servicios->getServiciosInfo($values);
$Push->despacharPush($values);



/*foreach($datos_servicio as $key => $value){
	
	$response[$key] = $value;
	
}*/
