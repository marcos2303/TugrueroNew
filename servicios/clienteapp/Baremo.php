<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$ServiciosPrecios = new ServiciosPrecios();
$Baremo = new Baremo();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
//$values = $Servicios->getServiciosInfo($values);
if(!isset($values['KM']) or $values['KM']==''){

	if(isset($values['LatitudOrigen']) and isset($values['LongitudOrigen']) and isset($values['LatitudDestino']) and isset($values['LongitudDestino'])){
		//Calculo de KM en caso que no envie
		$values['KM'] = $Baremo->getDistancia($values['LatitudOrigen'], $values['LongitudOrigen'], $values['LatitudDestino'], $values['LongitudDestino'] );

  }
}
if(!isset($values['Neumaticos']) or $values['Neumaticos']==''){
	$values['Neumaticos'] = '0000';
}
/**********************se efectua el calculo del baremo automatico****************************/
//calculo el precio sin iva
if(isset($values['KM']) and isset($values['IdAveria']) and isset($values['IdCondicionLugar']) and isset($values['Inicio']) ){
    $values['PrecioSIvaBaremo'] = $Baremo->calcularOferta( $values['KM'], $values['IdAveria'], $values['Neumaticos'],$values['IdCondicionLugar'] , $values['Inicio']);
	//calculo el precio con iva
    $values['IvaBaremo'] = ($values['PrecioSIvaBaremo'] * 1.12) / 100;
    $values['PrecioCIvaBaremo'] = $values['PrecioSIvaBaremo'] + $values['IvaBaremo'];
	
	
}else{
	$values['PrecioSIvaBaremo'] = 0;
	$values['PrecioCIvaBaremo'] = 0;
    $values['IvaBaremo'] = 0;
}


  $precios_actualizar = array(
    "IdServicio" => $values['IdServicio'],
    "PrecioSIvaBaremo"=>$values['PrecioSIvaBaremo'],
  	"IvaBaremo"=>$values['IvaBaremo'],
    "PrecioCIvaBaremo"=>$values['PrecioCIvaBaremo'],
    "PrecioClienteSIva"=>$values['PrecioSIvaBaremo'],
  	"IvaCliente"=>$values['IvaBaremo'],
    "PrecioClienteCIva"=>$values['PrecioCIvaBaremo']
  );
  $values["PrecioClienteSIva"] = $precios_actualizar['PrecioSIvaBaremo'];
  $values["IvaCliente"] = $precios_actualizar['IvaCliente'];
  $values["PrecioClienteCIva"] = $precios_actualizar['PrecioClienteCIva'];
  
  $ServiciosPrecios->updateServiciosPrecios($precios_actualizar);
  $response = array("Error"=>0,
  "Actualizado"=>"0",
  "MensajeError"=>"",
  "MensajeSuccess"=> 'Ok',
  "Baremo"=>$values,

  );

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
