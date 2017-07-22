<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Gruas = new Gruas();
/*$values['Placa'] = "AAABBB";
$values['Clave'] = '1234';*/
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
$datos_gruero = $Gruas->getLoginGruero($values);
if($datos_gruero){
			$response = array(
				"Error"=>0,
				"MensajeError"=>"",
				"MensajeSuccess"=> 'OK',
				"DatosGrua" => $datos_gruero
				);


}else{
$response = array("Error"=>1,"MensajeError"=> "Los datos no coinciden, verifique la información suministrada e intente nuevamente.","MensajeSuccess"=> '');

}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
