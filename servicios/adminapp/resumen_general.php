<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Estadisticas = new Estadisticas();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"No hay elementos","MensajeSuccess"=> '');
$data = array();
$datos_generales = $Estadisticas->getResumenGeneral($values);
$datos_bd = $Estadisticas->getResumenBd($Estadisticas->getWhere());
$datos_nobd = $Estadisticas->getResumenNoBd($Estadisticas->getWhere());
$datos_countgenerales = $Estadisticas->getCountResumenGeneral($Estadisticas->getWhere());
$datos_countbd = $Estadisticas->getCountResumenBd($Estadisticas->getWhere());
$datos_countbd_agendados = $Estadisticas->getCountResumenBdAgendados($Estadisticas->getWhere());
$datos_countnobd = $Estadisticas->getCountResumenNoBd($Estadisticas->getWhere());
$datos_countnobd_agendados = $Estadisticas->getCountResumenNoBdAgendados($Estadisticas->getWhere());

$datos_llamadas_particular = $Estadisticas->getCountLlamadasParticular($Estadisticas->getWhere());
$datos_llamadas_seguros = $Estadisticas->getCountLlamadasSeguros($Estadisticas->getWhere());

if($datos_generales){

	$response["Where"] = $Estadisticas->getWhere();
	foreach($datos_generales as $key=> $value){
		$response["datos_generales"][$key] = $value;
	}
	if($datos_bd){
		foreach($datos_bd as $key=> $value){
			$response["datos_bd"][$key] = $value;
		}

	}
	if($datos_nobd){
		foreach($datos_nobd as $key=> $value){
			$response["datos_nobd"][$key] = $value;
		}

	}
	if($datos_countgenerales){
		foreach($datos_countgenerales as $value){
			$response["countgenerales"][$value["Nombre"]] = $value["Cuenta"];
		}

	}
	if($datos_countbd){
		$array = array();
		foreach($datos_countbd as $key => $value){

				if (!array_key_exists($value["Fecha"], $array)) {
    				//echo "no existe debo agregar el indice fecha";;
						$cuenta_efectivos = $Estadisticas->getCountStatusBD($Estadisticas->getWhere(),6,$value["Fecha"]);
						$cuenta_fallido = $Estadisticas->getCountStatusBD($Estadisticas->getWhere(),7,$value["Fecha"]);
						$cuenta_cancelado = $Estadisticas->getCountStatusBD($Estadisticas->getWhere(),9,$value["Fecha"]);
						$cuenta_efectivos_agendado = $Estadisticas->getCountStatusBDAgendado($Estadisticas->getWhere(),6,$value["Fecha"]);
						$cuenta_fallido_agendado = $Estadisticas->getCountStatusBDAgendado($Estadisticas->getWhere(),7,$value["Fecha"]);
						$cuenta_cancelado_agendado = $Estadisticas->getCountStatusBDAgendado($Estadisticas->getWhere(),9,$value["Fecha"]);


						$array[$value["Fecha"]] = array(
							"Efectivo" => $cuenta_efectivos["Cuenta"],//6
							"Fallido" => $cuenta_fallido["Cuenta"],//7
							"Cancelado" => $cuenta_cancelado["Cuenta"],//9
							"EfectivoAgendado" => $cuenta_efectivos_agendado["Cuenta"],
							"FallidoAgendado" => $cuenta_fallido_agendado["Cuenta"],
							"CanceladoAgendado" => $cuenta_cancelado_agendado["Cuenta"],
						);
				}
		}
		$response["countbd"] = $array;

	}
	if($datos_countbd_agendados){
		foreach($datos_countbd_agendados as $value){
			$response["countbd_agendados"][$value["Nombre"]] = $value["Cuenta"];
		}

	}
	if($datos_countnobd){
		$array = array();
		foreach($datos_countnobd as $key => $value){

				if (!array_key_exists($value["Fecha"], $array)) {
    				//echo "no existe debo agregar el indice fecha";;
						$cuenta_efectivos = $Estadisticas->getCountStatusNoBD($Estadisticas->getWhere(),6,$value["Fecha"]);
						$cuenta_fallido = $Estadisticas->getCountStatusNoBd($Estadisticas->getWhere(),7,$value["Fecha"]);
						$cuenta_cancelado = $Estadisticas->getCountStatusNoBD($Estadisticas->getWhere(),9,$value["Fecha"]);
						$cuenta_efectivos_agendado = $Estadisticas->getCountStatusNoBDNoAgendado($Estadisticas->getWhere(),6,$value["Fecha"]);
						$cuenta_fallido_agendado = $Estadisticas->getCountStatusNoBDNoAgendado($Estadisticas->getWhere(),7,$value["Fecha"]);
						$cuenta_cancelado_agendado = $Estadisticas->getCountStatusNoBDNoAgendado($Estadisticas->getWhere(),9,$value["Fecha"]);

						$array[$value["Fecha"]] = array(
							"Efectivo" => $cuenta_efectivos["Cuenta"],//6
							"Fallido" => $cuenta_fallido["Cuenta"],//7
							"Cancelado" => $cuenta_cancelado["Cuenta"],//9
							"EfectivoAgendado" => $cuenta_efectivos_agendado["Cuenta"],
							"FallidoAgendado" => $cuenta_fallido_agendado["Cuenta"],
							"CanceladoAgendado" => $cuenta_cancelado_agendado["Cuenta"],

						);
				}
		}
		$response["countnobd"] = $array;

	}
	if($datos_countnobd_agendados){
		foreach($datos_countnobd_agendados as $key=> $value){
			$response["countnobd_agendados"][$value["Nombre"]] = $value["Cuenta"];
		}

	}
	if($datos_llamadas_particular){
		foreach($datos_llamadas_particular as $key=> $value){
			$response["datos_llamadas_particular"][] = $value;
		}

	}
	if($datos_llamadas_seguros){
		foreach($datos_llamadas_seguros as $key=> $value){
			$response["datos_llamadas_seguros"][] = $value;
		}

	}
}
	$response["Error"] = 0;
	$response["MensajeError"] = "";
	$response["MensajeSuccess"] = "OK";

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
