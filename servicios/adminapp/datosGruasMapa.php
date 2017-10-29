<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');


/************* Clases a utilizar *******************/
$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"DatosGrua" => array());
$DatosGruas = $Gruas->getGruasMapa();
if($DatosGruas){

			$response = array(
				"Error"=>0,
				"MensajeError"=>"",
				"MensajeSuccess"=> 'OK',
				"DatosGruas" => $DatosGruas

				);
}else{
$response = array("Error"=>0,"MensajeError"=> "","MensajeSuccess"=> '');

}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
