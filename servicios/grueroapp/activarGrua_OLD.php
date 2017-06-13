<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);
if (json_last_error() == 0) {
    $idGrua = ($obj["idGrua"]);
    $disponible = ($obj["disponible"]);
} else {
    echo(JSONerror());
    exit();
}

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';


if (checkCondicion($link, $idGrua)) {
    updateDisponible($link, $idGrua, $disponible);
}

//------------------------------
//Verificando si el usuario ha sido suspendido.
//------------------------------
function checkCondicion($link, $idGrua) {
    $Tabla = "Grueros";
    $result = $link->query("SELECT Condicion FROM $Tabla WHERE idGrua = '$idGrua'");
    $response = ($result) ? $result->fetch_array(MYSQLI_ASSOC) : Error($link->error, $link);
    if ($result->num_rows === 1) {
        if ($response["Condicion"] === "Activo") {
            return true;
        } else {
            Suspendido($link);
        }
    }else{
       Error("Usuario Desconocido.", $link); 
    }
}

//------------------------------
//Actualizando la Disponibilidad
//------------------------------
function updateDisponible($link, $idGrua, $disponible) {
    $Tabla = "Gruas";
    $LastUpdate = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));

    $result = $link->query("UPDATE $Tabla SET Disponible = '$disponible',"
            . "LastUpdate = '$LastUpdate' WHERE idGrua = '$idGrua'");

    if ($result) {
        Success($link);
    } else {
        Error($link->error, $link);
    }
}

//------------------------------
//Disponibilidad Actualizada.
//------------------------------
function Success($link) {
    $data = (array('OK' => "OK"));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Gruero Suspendido
//------------------------------
function Suspendido($link) {
    $data = (array('Suspendido' => "Usted se encuentra temporalmente suspendido, contacte a sporte técnico para mayor información."));
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
