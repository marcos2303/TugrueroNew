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
$Tabla = "Servicios";
$EstatusCliente = "Cancelado";
$EstatusGrua = GetEstatus($idSolicitud, $Tabla, $link);
$Movito = "CLIENTE: canceló en " . $EstatusGrua;
$TimeFin = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));

//------------------------------
//Query
//------------------------------
$result = $link->query("UPDATE $Tabla SET EstatusCliente ='$EstatusCliente', "
        . "Motivo ='$Movito', TimeFin = '$TimeFin' "
        . "WHERE idSolicitud = '$idSolicitud' ");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

//------------------------------
//Send PUSH
//------------------------------
if ($EstatusGrua == "Activo" || $EstatusGrua == "Asistiendo") {
    CancelarServicioPUSH($idSolicitud, $link);
}

//------------------------------
//Respuesta
//------------------------------
$response = (array('Success' => "OK"));

//------------------------------
//External.funcionesGenerales
//------------------------------
Success($response, $link);

//------------------------------
//Funciones:
//------------------------------
function GetEstatus($idSolicitud, $Tabla, $link) {
//------------------------------
//Query
//------------------------------
    $result = $link->query("SELECT EstatusGrua FROM $Tabla WHERE idSolicitud = '$idSolicitud'");

//------------------------------
//Error Check
//------------------------------
    if (!$result) {
        Error($link->error, $link);
    }

//------------------------------
//Respuesta
//------------------------------
    $response = $result->fetch_array(MYSQLI_ASSOC);
    return $response["EstatusGrua"];
}

function CancelarServicioPUSH($idSolicitud, $link) {

//------------------------------
//Extras
//------------------------------
    $t1 = "Gruas";
    $t2 = "Servicios";

//------------------------------
//Query
//------------------------------
    $result = $link->query("SELECT Gruas.Token"
            . " FROM $t1 JOIN $t2 ON Gruas.idGrua = Servicios.idGrua "
            . "WHERE Servicios.idSolicitud = '$idSolicitud'");


//------------------------------
//Error Check
//------------------------------
    if (!$result) {
        exit();
    }

//------------------------------
//Respuesta
//------------------------------
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $Grua[] = $row;


//------------------------------
//Data PUSH
//------------------------------
    $data = array(
        'title' => 'Servicio cancelado.',
        'message' => 'El cliente ha cancelado el servicio #' . $idSolicitud,
        'notId' => $idSolicitud,
        'idSolicitud' => $idSolicitud,
        'Cancelado' => 'SI'
    );

//------------------------------
//External.funcionesAPI
//------------------------------
    include_once $_SERVER['DOCUMENT_ROOT'] . "/API/funcionesAPI.php";
    SendPush($Grua, $data);
}
