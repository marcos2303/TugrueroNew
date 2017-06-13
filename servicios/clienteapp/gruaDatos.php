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

//------------------------------
//Query
//------------------------------   
$result = $link->query("SELECT idGrua FROM $Tabla WHERE idSolicitud ='$idSolicitud'");

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
$idGrua = $response["idGrua"];
//echo $idGrua;
GetDatos($idGrua, $link);

function GetDatos($idGrua, $link) {
    
//------------------------------
//Extras
//------------------------------
    $Tabla = "Grueros";
    $Tabla2 = "Gruas";

//------------------------------
//Query
//------------------------------    
    $result = $link->query("SELECT $Tabla.idGrua, $Tabla.Nombre, $Tabla.Apellido,"
            . "$Tabla.Placa, $Tabla.Modelo, $Tabla.Color, $Tabla.Cedula, "
            . "$Tabla.Celular, $Tabla2.Latitud, $Tabla2.Longitud FROM $Tabla, $Tabla2 "
            . "WHERE $Tabla.idGrua = '$idGrua' AND $Tabla2.idGrua = '$idGrua'");

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
    
//------------------------------
//External.funcionesGenerales
//------------------------------
    Success($response, $link);
    
}
