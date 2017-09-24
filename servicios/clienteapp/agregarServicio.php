<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Servicios = new Servicios();
$ServiciosClientes = new ServiciosClientes();
$ServiciosPrecios = new ServiciosPrecios();
$ServiciosGruas = new ServiciosGruas();
$ServiciosEstatus = new ServiciosEstatus();
$Baremo = new Baremo();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
/*$values['IdCondicionLugar'] = 1;
$values['IdAveria'] = 3;
$values['LatitudOrigen']  = '10.2131868';
$values['LongitudOrigen']  = '-67.8862887';
$values['LatitudDestino']  = '10.212626514872';
$values['LongitudDestino']  = '-67.8864110297';
$values['IdEstatus']  = '1';*/
if(!isset($values['Inicio']) or $values['Inicio']==''){
	$values['Inicio'] = date('Y-m-d H:i:s');
}
if(!isset($values['KM']) or $values['KM']==''){

	if(isset($values['LatitudOrigen']) and isset($values['LongitudOrigen']) and isset($values['LatitudDestino']) and isset($values['LongitudDestino'])){
		//Calculo de KM en caso que no envie
		$values['KM'] = $Baremo->getDistancia($values['LatitudOrigen'], $values['LongitudOrigen'], $values['LatitudDestino'], $values['LongitudDestino'] );
	}else{
		$values['KM'] = 0;
	}
}
if(!isset($values['Neumaticos']) and $values['Neumaticos']==''){
	$values['Neumaticos'] = '1000';
}
/**********************se efectua el calculo del baremo automatico****************************/
//calculo el precio sin iva
if(isset($values['KM']) and isset($values['IdAveria']) and isset($values['IdCondicionLugar']) and isset($values['Inicio']) ){
	$values['PrecioSIvaBaremo'] = $Baremo->calcularOferta( $values['KM'], $values['IdAveria'], $values['Neumaticos'],$values['IdCondicionLugar'] , $values['Inicio']);
	//calculo el precio con iva
	$values['PrecioCIvaBaremo'] = $values['PrecioSIvaBaremo'] * 1.12;
}else{
	$values['PrecioSIvaBaremo'] = 0;
	$values['PrecioCIvaBaremo'] = 0;
}


/*************************Creamos el Servicio************************************/
//Insertamos en Servicios

if(!$Servicios ->addServicios($values)){
	$response = array("Error"=>1,"MensajeError" => "Se ha presentado un error iniciando el servicio. Intente de nuevo.");
	echo json_encode($response);die;
}
$values['IdServicio'] = $Servicios->getIdServicio();//Variable IdServicio

if(isset($values['IdServicio'])){
	//Insertamos en ServiciosEstatus la traza
	if(isset($values['IdEstatus']) and $values['IdEstatus']==''){
		$values['IdEstatus'] = 2;
	}

	$values['Fecha'] = date("Y-m-d");
	$values['Hora'] = date("H:i:s");
	if(!$ServiciosEstatus ->addServiciosEstatus($values)){
		$response = array("Error"=>0,"MensajeError" => "Se ha presentado un error iniciando el servicio estatus. Intente de nuevo.");
		echo json_encode($response);die;
	}
	//insertamos en ServiciosCliente
	if(!$ServiciosClientes ->addServiciosClientes($values)){
		$response = array("Error"=>0,"MensajeError" => "Se ha presentado un error iniciando el servicio cliente. Intente de nuevo.");
		echo json_encode($response);die;
	}
	//insertamos en ServiciosPrecios
	if(!$ServiciosPrecios ->addServiciosPrecios($values)){
		$response = array("Error"=>0,"MensajeError" => "Se ha presentado un error iniciando el servicio precio. Intente de nuevo.");
		echo json_encode($response);die;
	}
	//insertamos en ServiciosGruas
	if(!$ServiciosGruas ->addServiciosGruas($values)){
		$response = array("Error"=>0,"MensajeError" => "Se ha presentado un error iniciando el servicio gruero. Intente de nuevo.");
		echo json_encode($response);die;
	}

}

/***********************Localizar Grúas y enviar push*************************************************/
if(isset($values['IdServicio']) and $values['IdServicio']!=''){
	$data_servicio = $Servicios->getServiciosInfo($values);
	//var_dump($data_servicio);die;
}
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>$values['IdServicio'],"CodigoServicio"=>$data_servicio['CodigoServicio'],"DatosServicio" => $data_servicio);
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
