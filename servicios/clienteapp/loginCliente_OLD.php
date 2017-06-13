<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);

//------------------------------
//Incluyendo funciones de Errores.
//------------------------------
include_once 'funcionesGenerales.php';


//------------------------------
//Combrobando estructura del JSON.
//------------------------------
if (json_last_error() == 0) {
    $Cedula = ($obj["Cedula"]);
    $Placa = ($obj["Placa"]);
    $Seguro = ($obj["Seguro"]);
} else {
    JSONerror();
}
/*
$Cedula = "J-123456";
$Placa = "AAABBB";
$Seguro = "Banesco";
*/

//------------------------------
//Creando la variable $link de conexion.
//------------------------------
include_once 'conexion.php';


$Tabla = "Polizas";
$result = $link->query("SELECT * FROM $Tabla WHERE Cedula = '$Cedula' AND Placa = '$Placa' AND Seguro = '$Seguro'");

if ($result) {
    DatosValidos($link, $result);
} else {
    Error($link->error, $link);
}

//------------------------------
//Validando que los datos coincidan.
//------------------------------
function DatosValidos($link, $result) {
    if ($result->num_rows === 1) {
        checkVigencia($link, $result);
    } else {
        $mensaje = "Los datos no coinciden, verifique la información suministrada e intente nuevamente.";
        Fail($link, $mensaje);
    }
}

//------------------------------
//Creando la variable $link de conexion.
//------------------------------
function checkVigencia($link, $result) {
    $response = $result->fetch_array(MYSQLI_ASSOC);
    if (isVigente($response['Vencimiento'])) {
        Success($response, $link);
    } else {
        $mensaje = "Su póliza se encuentra VENCIDA, consulte con su empresa aseguradora o intente con otra póliza de su vehículo.";
        Fail($link, $mensaje);
    }
}

//------------------------------
//Verificando si la póliza se encuentra vigente.
//------------------------------
function isVigente($vencimiento) {
    $dateVencida = date_create_from_format('Y-m-d H:i:s', $vencimiento);
    $dateaActual = date_create_from_format('Y-m-d H:i:s', gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));
    return ($dateaActual < $dateVencida);
}
