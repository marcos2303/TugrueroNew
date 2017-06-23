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
$result = $link->query("SELECT EstatusCliente FROM $Tabla WHERE idSolicitud = '$idSolicitud'");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

//------------------------------
//JSON Response
//------------------------------
$response = $result->fetch_array(MYSQLI_ASSOC);

//------------------------------
//External.funcionesGenerales
//------------------------------
Success($response, $link);

