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
$idSolicitud = ($obj["idSolicitud"]);

//------------------------------
//Extras
//------------------------------
$t1 = "Polizas";
$t2 = "Solicitudes";

//------------------------------
//Query
//------------------------------
$result = $link->query("SELECT Nombre,Apellido,Marca,Modelo,Placa,Tipo,Color,Año,CellContacto,Polizas.idPoliza"
        . " FROM $t1 JOIN $t2 ON Solicitudes.idPoliza = Polizas.idPoliza "
        . "WHERE Solicitudes.idSolicitud = '$idSolicitud'");

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

