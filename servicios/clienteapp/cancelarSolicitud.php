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
//Creando la variable $link de conexion.
//------------------------------
include_once 'conexion.php';

//------------------------------
//Parámetros
//------------------------------
$idSolicitud = ($obj["idSolicitud"]);

//------------------------------
//Extras
//------------------------------
$Tabla = "Solicitudes";
$Estatus = "Cancelado";
$Condicion = "Localizando";

//------------------------------
//Query
//------------------------------
$result = $link->query("UPDATE $Tabla SET Estatus = '$Estatus' "
        . "WHERE idSolicitud ='$idSolicitud' AND Estatus = '$Condicion'");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

if ($link->affected_rows === 1) {
//------------------------------
//External.FuncioneGenerales
//------------------------------  
    $jsonData = (array('Success' => "OK"));
    Success($jsonData, $link);
} else {

    $result = $link->query("SELECT Estatus FROM $Tabla "
            . "WHERE idSolicitud ='$idSolicitud'");
    $response = $result->fetch_array(MYSQLI_ASSOC);


//------------------------------
//External.FuncioneGenerales
//------------------------------   
    if ($response["Estatus"] === "Asignado") {
        $mensaje = "No se pudo cancelar, la solicitud ya fue tomada por un gruero.";
        Fail($link, $mensaje);
    } else {
        $jsonData = (array('Success' => "OK"));
        Success($jsonData, $link);
    }
}


