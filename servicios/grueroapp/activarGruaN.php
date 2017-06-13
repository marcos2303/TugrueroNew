<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);


//------------------------------
//Incluyendo funciones de Error, Fallo y Exito.
//------------------------------
include_once 'funcionesGenerales.php';


//------------------------------
//Combrobando estructura del JSON.
//------------------------------
if (json_last_error() !== 0) {
    JSONerror();
}

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';


//------------------------------
//Parámetros
//------------------------------
$idGrua = ($obj["idGrua"]);
$disponible = ($obj["disponible"]);
$uuid = $obj["UUID"];
$Estado = "DISTRITO CAPITAL";
if(isset($obj["Estado"]) and $obj["Estado"]!='')
{
	$Estado = $obj["Estado"];
}

//------------------------------
//EXTRAS
//------------------------------
$TablaA = "Grueros";
$TablaB = "Gruas";



//------------------------------
//Query
//------------------------------
$result = $link->query("SELECT A.Condicion FROM $TablaA A LEFT JOIN $TablaB B ON A.idGrua = B.idGrua WHERE A.idGrua ='$idGrua' AND B.DeviceID ='$uuid'");
$response = ($result) ? $result->fetch_array(MYSQLI_ASSOC) : Error($link->error, $link);


//------------------------------
//Detectando Sesion
//------------------------------
if ($result->num_rows === 0) {
        Fail($link, "Se ha detectado otra sesión abierta, por favor cierre la sesión en su otro dispositivo antes de continuar. (".$uuid.")");
}

//------------------------------
//Ususario Suspendido
//------------------------------
if ($response["Condicion"] !== "Activo") {
    Suspendido($link);
}

updateDisponible($link, $idGrua, $disponible,$uuid,$Estado);


//------------------------------
//Actualizando la Disponibilidad
//------------------------------
function updateDisponible($link, $idGrua, $disponible,$uuid,$Estado) {
    $Tabla = "Gruas";
    //$LastUpdate = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
    $LastUpdate = date('Y-m-d H:i:s');
    $result = $link->query("UPDATE $Tabla SET Disponible = '$disponible',"
            . "LastUpdate = '$LastUpdate', DeviceID = '$uuid', Estado = upper(remove_accents('$Estado')) WHERE idGrua = '$idGrua'");

    if ($result) {
        $data = (array('OK' => "OK"));
        Success($data,$link);
    } else {
        Error($link->error, $link);
    }
}

//------------------------------
//Gruero Suspendido
//------------------------------
function Suspendido($link) {
    $data = (array('Suspendido' => "Usted se encuentra temporalmente suspendido, contacte a sporte técnico para mayor información."));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

/*
