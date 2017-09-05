<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Servicios = new Servicios();
$ServiciosGruas = new ServiciosGruas();
$ServiciosEstatus = new ServiciosEstatus();
$Gruas = new Gruas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"","MensajeSuccess"=> '',"IdServicio" => $values['IdServicio'],"IdGrua"=>$values['IdGrua']);
/*************************Actualizamos************************************/
/*$valido = true;
$values['IdGrua'] = 1;
$values['Disponible'] = 0;*/
$valido = false;
$datos_servicio = $Servicios->getServiciosInfo($values);
$datos_gruero = $Gruas->getGruaInfo($values['IdGrua']);
$update_servicio = array();
$update_servicio_grua = array();
$update_grua = array();
$values['Fecha'] = date("Y-m-d");
$values['Hora'] = date("h:i:s");


if(!($datos_servicio["IdEstatus"] == 1 or $datos_servicio["IdEstatus"]==2)){
	$valido = false;	
	$response = array(
		"Error"=>1,"Actualizado"=> 0,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'El servicio ya no se encuentra disponible o ha sido asignado a otra grúa.'
	);
	echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);die;
	
}else{
	
	//Datos en Grúa
	$update_grua["IdGrua"] = $values["IdGrua"];
	//Datos en Servicio Grúa
	$update_servicio_grua["IdGrua"] = $values["IdGrua"];
	$update_servicio_grua["IdServicio"] = $values["IdServicio"];
	//Datos en servicio Grúa
	$update_servicio_grua["Nombres"] = $datos_gruero["Nombres"];
	$update_servicio_grua["Apellidos"] = $datos_gruero["Apellidos"];
	$update_servicio_grua["Cedula"] = $datos_gruero["Cedula"];
	$update_servicio_grua["Celular"] = $datos_gruero["Celular"];
	$update_servicio_grua["IdProveedor"] = $datos_gruero["IdProveedor"];
	$update_servicio_grua["FechaAsignacion"] = $values["Fecha"];
	$update_servicio_grua["HoraAsignacion"] = $values["Hora"];
	//Datos en Servicio	
	$update_servicio["IdServicio"] = $values["IdServicio"];;
	$update_servicio["IdEstatus"] = 3;
	//Datos Servicio Estatus
  	$update_servicio_estatus['IdServicio'] = $values['IdServicio'];
  	$update_servicio_estatus['IdEstatus'] = 3;
  	$update_servicio_estatus['Fecha'] = $values['Fecha'];
  	$update_servicio_estatus['Hora'] = $values['Hora'];
	$update_servicio_estatus['IdUsuario'] = 0;
	
	if($datos_servicio["Agendado"] == 0 ){//No es agendado
		//se debe cambiar el Disponible del Gruero a 2
		$update_grua["Disponible"] = 2;
		$datos_gruero["Disponible"] = 2; 
	}

	//se cambia el estatus de la solicitud a Gruero asignado

	$Gruas->updateGrua($update_grua);	
	$ServiciosGruas->updateServiciosGruas($update_servicio_grua);
	$Servicios->updateServicios($update_servicio);
	$ServiciosEstatus->addServiciosEstatus($update_servicio_estatus);
	$response = array(
		"Error"=>0,"Actualizado"=> 1,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Servicio asignado',
		"IdGrua"=>$datos_gruero["IdGrua"],
		"Placa"=>$datos_gruero["Placa"],
		"DatosGrua" => $datos_gruero
	);
	echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	
}

