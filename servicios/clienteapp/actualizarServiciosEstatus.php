<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Servicios = new Servicios();
$ServiciosEstatus = new ServiciosEstatus();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=>"0","MensajeError"=>"","MensajeSuccess"=> '');
/*************************Actualizamos el Servicio************************************/


if(!isset($values['Fecha']) or $values['Fecha']=="") $values['Fecha'] = date("Y-m-d");
if(!isset($values['Hora']) or $values['Hora']=="") $values['Hora'] = date("h:i:s");
if(!isset($values['IdUsuario']) or $values['IdUsuario']=="") $values['IdUsuario'] = 1;
if(!isset($values['FechaEstatus']) or $values['FechaEstatus']=="") $values['FechaEstatus'] = date("Y-m-d h:i:s");

if($ServiciosEstatus->existeServicioEstatus($values)!="0"){
  if($ServiciosEstatus->updateServiciosEstatus($values)){

    $response = array("Error"=>0,
    "Actualizado"=>"1",
    "MensajeError"=>"",
    "MensajeSuccess"=> 'Ok',
    "IdServicio"=>$values['IdServicio'],

    );
  }
}else{

  if($ServiciosEstatus->addServiciosEstatus($values)){
    $response = array("Error"=>0,
    "Agregado"=>"1",
    "MensajeError"=>"",
    "MensajeSuccess"=> 'Ok',
    "IdServicio"=>$values['IdServicio'],

    );
  }
}
if(isset($values['IdServicio']) and $values['IdServicio']!=''){
  $valores_update = array();
  $valores_update['IdServicio'] = $values['IdServicio'];
  $valores_update['IdEstatus'] = $values['IdEstatus'];
  /**********datos guardados del servicio***********/
  $datos_actuales = $ServiciosEstatus->getServicioEstatus($values);//actual
  $orden_actual = $datos_actuales['Orden'];//actual
  /**IdEstatus nuevo*/
  $datos_nuevos = $ServiciosEstatus->getEstatusOrden($values);//nuevo
  $orden_nuevo = $datos_nuevos['Orden'];

  if($orden_nuevo < $orden_actual){
    $valores_update['IdEstatus'] = $datos_actuales['IdEstatus'];
  }

	$Servicios->updateServicios($valores_update);
	//var_dump($data_servicio);die;
}

$DatosServicio = $Servicios->getServiciosInfo($values);
$response["DatosServicio"] = $DatosServicio;



echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
