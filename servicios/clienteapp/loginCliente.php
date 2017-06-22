<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');


/************* Clases a utilizar *******************/
$Polizas = new Polizas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
$values['Cedula']='V-21411814';
$values['Placa'] = 'AAABBB';
$values['IdSeguro'] = '1';
$datos_poliza = $Polizas->getLoginPoliza($values);
if($datos_poliza){
	$isVigente = $Polizas->isVigente($datos_poliza['Vencimiento']);
		if(!$isVigente){
			$response = array("Error"=>1,"MensajeError"=> "Su poliza se encuentra VENCIDA, consulte con su empresa aseguradora o intente con otra póliza de su vehículo.","MensajeSuccess"=> '');
		}else{
			$response = array(
				"Error"=>0,
				"MensajeError"=>"",
				"MensajeSuccess"=> 'OK',
				"Nombres"=> $datos_poliza['Nombres'],
				"Apellidos"=> $datos_poliza['Apellidos'],
				"Cedula"=> $datos_poliza['Cedula'],
				"Placa"=> $datos_poliza['Placa'],
				"IdMarca"=> $datos_poliza['IdMarca'],
				"Modelo"=> $datos_poliza['Modelo'],
				"Clase"=> $datos_poliza['Clase'],
				"Tipo"=> $datos_poliza['Tipo'],
				"Color"=> $datos_poliza['Color'],
				"Anio"=> $datos_poliza['Anio'],
				"Serial"=> $datos_poliza['Serial'],
				"IdSeguro"=> $datos_poliza['IdSeguro'],
				"NumPoliza"=> $datos_poliza['NumPoliza'],
				"DireccionEDO"=> $datos_poliza['DireccionEDO'],
				"Celular"=> $datos_poliza['Celular']
				);	
		}
	
}else{
$response = array("Error"=>1,"MensajeError"=> "Los datos no coinciden, verifique la información suministrada e intente nuevamente.","MensajeSuccess"=> '');
	
}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);