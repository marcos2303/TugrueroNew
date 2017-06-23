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

/*
  $cedula = "V123456"; //TestValue
  $placa = "ALX900"; //TestValue
  $clave = "1234"; //TestValue
 */

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';

//------------------------------
//Parámetros
//------------------------------
$cedula = ($obj["Cedula"]);
$placa = ($obj["Placa"]);
$clave = ($obj["Clave"]);
//------------------------------
//Extras
//------------------------------
$TablaA = "Grueros";
$TablaB = "Gruas";


//------------------------------
//Query
//------------------------------
$result = $link->query("SELECT A.idGrua,A.Nombre,A.Apellido,A.Modelo,A.Celular,A.Condicion,B.Disponible,B.DeviceID "
        . "FROM $TablaA A LEFT JOIN $TablaB B "
        . "ON A.idGrua = B.idGrua "
        . "WHERE A.Cedula = '$cedula' AND A.Placa = '$placa' AND A.Clave = '$clave'");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

//------------------------------
//Respuesta
//------------------------------
$response = ($result->num_rows === 1) ? $result->fetch_array(MYSQLI_ASSOC) :
        Fail($link, "La información que usted ha suministrado es incorrecta,"
                . " por favor ingrese sus datos nuevamente.");

//------------------------------
//Condición del Gruero
//------------------------------
if ($response["Condicion"] !== "Activo") {
    Fail($link, "Usted se encuentra temporalmente suspendido, contacte a "
            . "sporte técnico para mayor información.");
}


//------------------------------
//Sesion Abiera
//------------------------------
$uuid = ($obj["UUID"]);
if ($response["DeviceID"] != $uuid && $response["DeviceID"] != "") {
    Fail($link, "Se ha detectado otra sesión abierta, por favor cierre la sesión en su otro dispositivo antes de continuar. (" . $uuid . ")");
}


NuevaSesion($link, $response["idGrua"], $uuid);
$json_array = json_encode($response, JSON_UNESCAPED_UNICODE);
EndLogin($json_array, $link);

//------------------------------
//Actualizando campo de disponible
//------------------------------
function NuevaSesion($link, $idGrua, $uuid) {

    $Tabla = "Gruas";
    $LastUpdate = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
    $Disponible = "NO";
    $result = $link->query("UPDATE $Tabla SET Disponible ='$Disponible', LastUpdate = '$LastUpdate', DeviceID = '$uuid'"
            . "WHERE idGrua = '$idGrua'");

    if (!$result) {
        Error($link->error, $link);
    } else if ($link->affected_rows !== 1) {
        Error("affected_rows:" . $link->affected_rows, $link);
    }
}
