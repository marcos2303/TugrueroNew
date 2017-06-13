<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);

//------------------------------
//Combrobando estructura del JSON.
//------------------------------
if (json_last_error() == 0) {
    $idSolicitud = ($obj["idSolicitud"]);
    $Motive = ($obj["Motivo"]);
} else {
    echo(JSONerror());
    exit();
}


//------------------------------
//Creando el $link de conexiones.
//------------------------------
include_once 'conexion.php';



//------------------------------
//Iniciando el Abandono.
//------------------------------
$Tabla = "Servicios";
$Abandonado = "Abandonado";
$Activo = "Activo";
$Asistiendo = "Asistiendo";
$Motivo = "GRUERO: ".$Motive;
$TimeFin = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));

$result = $link->query("UPDATE $Tabla SET EstatusGrua = '$Abandonado', Motivo = '$Motivo', TimeFin = '$TimeFin'"
        . " WHERE idSolicitud = '$idSolicitud' AND EstatusCliente = '$Activo' ");

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
//Abandono exitoso.
//------------------------------
function Success($link) {
    $data = (array('Success' => "Se ha abandonado el servicio correctamente. Presione continuar para volver al panel principal."));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//No se pudo Abandonar porque el servicio ya estaba cancelado. 
//------------------------------
function Fail($link) {
    $data = (array('Fail' => "El Servicio fue cancelado previamente por el usaurio. Presione continuar para volver al panel principal."));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Error del $link, asosicado a la DB.
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
//Error del JSON.
//------------------------------
function JSONerror() {
    $jsonData = (array('Error' => json_last_error()));
    $json_array = json_encode($jsonData, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}
