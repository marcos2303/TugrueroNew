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

/*
  $cedula = "V123456"; //TestValue
  $placa = "ALX900"; //TestValue
  $clave = "1234"; //TestValue
 */

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';

//------------------------------
//Parámetros
//------------------------------
$cedula = ($obj["Cedula"]);
$placa = ($obj["Placa"]);
$clave = ($obj["Clave"]);

//------------------------------
//Extras
//------------------------------
$Tabla = "Grueros";

//------------------------------
//Query
//------------------------------
$result = $link->query("SELECT idGrua,Nombre,Apellido,Modelo,Celular,Condicion FROM $Tabla WHERE Cedula = '$cedula' AND Placa = '$placa' AND Clave = '$clave'");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

//------------------------------
//Respuesta
//------------------------------
    $response = ($result->num_rows === 1) ? $result->fetch_array(MYSQLI_ASSOC) :
            Fail($link, "La información que usted ha suministrado es incorrecta,"
                    . " por favor ingrese sus datos nuevamente.");

    if ($response["Condicion"] !== "Activo") {
        Fail($link, "Usted se encuentra temporalmente suspendido, contacte a "
                . "sporte técnico para mayor información.");
    }
    
    Disponible($link, $response["idGrua"]);
    $json_array = json_encode($response, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
    
    

//------------------------------
//Actualizando campo de disponible
//------------------------------
function Disponible($link, $idGrua) {
    $Tabla = "Gruas";
    $LastUpdate = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));
    $Disponible = "NO";
    $result = $link->query("UPDATE $Tabla SET Disponible ='$Disponible', LastUpdate = '$LastUpdate'"
            . "WHERE idGrua = '$idGrua'");

    if (!$result) {
        Error($link->error, $link);
    } else if ($link->affected_rows !== 1) {
        Error("affected_rows:" . $link->affected_rows, $link);
    }
}


