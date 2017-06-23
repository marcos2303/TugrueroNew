<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);

//------------------------------
//Combrobando estructura del JSON.
//------------------------------
if (json_last_error() == 0) {
    $idSolicitud = ($obj["idSolicitud"]);
} else {
    echo(JSONerror());
    exit();
}

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';


//------------------------------
//Iniciando Asistencia
//------------------------------
$Tabla = "Servicios";
$Activo = "Activo";
$Asistiendo = "Asistiendo";

$result = $link->query("UPDATE $Tabla SET EstatusGrua = '$Asistiendo'"
        . " WHERE idSolicitud = '$idSolicitud' AND EstatusCliente = '$Activo'");

if ($result) {
    if ($link->affected_rows === 1) {
        Success($link);
    } else {
        Fail($link);
    }
} else {
    Error($link->error, $link);
}

//------------------------------
//Asistiendo Exitoso.
//------------------------------
function Success($link) {
    $data = (array('Success' => "Recuerde solicitar la confirmación del cliente."));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//No se pudo Asistir, el cliente canceló el servicio previamente.
//------------------------------
function Fail($link) {
    $data = (array('Fail' => "El Servicio fue cancelado previamente por el usaurio."));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Error del $link, asosicado a la DB
//------------------------------
function Error($error, $link) {
    $data = (array('Error' => $error));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Cerrando la conexión.
//------------------------------
function EndLogin($json_array, $link) {
    echo ($json_array);
    $link->close();
    exit();
}

//------------------------------
//Error del JSON
//------------------------------
function JSONerror() {
    $jsonData = (array('Error' => json_last_error()));
    $json_array = json_encode($jsonData, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}
