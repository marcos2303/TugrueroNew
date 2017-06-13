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
$idGrua = $obj["idGrua"];
$uuid = $obj["UUID"];
$Disponible = "NO";
$LastUpdate = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));

    
//------------------------------
//Extras
//------------------------------
$Tabla = "Gruas";

//------------------------------
//Query
//------------------------------
$result = $link->query("UPDATE $Tabla SET Disponible ='$Disponible', LastUpdate = '$LastUpdate', DeviceID = ''"
        . "WHERE idGrua = '$idGrua' AND DeviceID = '$uuid'");


//------------------------------
//Error Check
//------------------------------
if(!$result){
        Error($link->error, $link);
  
}


//------------------------------
//Respuesta
//------------------------------
    if ($link->affected_rows === 1) {
        $data = (array('OK' => "OK"));
        Success($data,$link);
    } else {
        Fail($link, "Se ha detectado otra sesión abierta, por favor cierre la sesión en su otro dispositivo antes de continuar. (".$uuid.")");
    }
