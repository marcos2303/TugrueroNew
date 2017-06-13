<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);


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
//Params
//------------------------------
$Tabla = "Baremo";
$neumaticos = "0001";

//------------------------------
//Query
//------------------------------
$result = $link->query("SELECT * FROM $Tabla");

if (!$result) {
    echo($link->error);
    die();
}

$response = $result->fetch_array(MYSQLI_ASSOC);
print_r($response);
$total = $response['Enganche'] + $response['KM'] * 10 + $response['Enganche'] * $response['Atasco'];
//echo $total;
$Cambios  =0;
for ($n = 0; $n < 4; $n++) {
    if ($neumaticos[$n] === '1') {
        $Cambios++;
    }
}

$Cambio = "Cambio" . $Cambios;
echo "Cambios:" . $response[$Cambio];




