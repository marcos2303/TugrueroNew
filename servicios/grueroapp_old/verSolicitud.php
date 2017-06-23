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
//Consulta con la DB para extraer los detalles
//------------------------------
$Estatus = "Localizando"; //DataSegura
$Tabla = "Solicitudes"; //DataSegura
$result = $link->query("SELECT * FROM $Tabla WHERE idSolicitud = '$idSolicitud' AND Estatus = '$Estatus'");


//------------------------------
//Verificando el resultado
//------------------------------
if ($result) {
    $response = ($result->num_rows === 1) ? $result->fetch_array(MYSQLI_ASSOC) : Fail($link);
    Success($response, $link);
} else {
    Error($link->error, $link);
}

//------------------------------
//Éxito, retorna todos los parámetros de la solicitud
//Parámentros en formato JSON.
//------------------------------
function Success($data, $link) {
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Fallo, retorna un mensaje dado que la solicitud
//no se enuentra en estado "Localizando".
//------------------------------
function Fail($link) {
    $data = (array('Fallo' => "Ésta solicitud ya no se encuentra disponible."));
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
