<?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);

//------------------------------
//Combrobando estructura del JSON.
//------------------------------
if (json_last_error() == 0) {
    $idSolicitud = ($obj["idSolicitud"]);
    $idGrua = ($obj["idGrua"]);

} else {
    echo(JSONerror());
    exit();
}

//$idSolicitud = 398;
//$idGrua = 2;

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';


//------------------------------
//Iniciando Finalización
//------------------------------
$Tabla = "Servicios";
$Completado = "Completado";
$TimeFin = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));

$result = $link->query("UPDATE $Tabla SET $Tabla.EstatusGrua = '$Completado', $Tabla.TimeFin ='$TimeFin' WHERE idSolicitud = '$idSolicitud'");


//$result = $link->query("UPDATE $Tabla,$Tabla2 SET $Tabla.Estatus = '$Completado', $Tabla.TimeFin ='$TimeFin', $Tabla2.Disponible = '$Disponible'"
 //       . " WHERE $Tabla.idSolicitud = '$idSolicitud' AND $Tabla2.idGrua = '$idGrua'");

if ($result) {
    if ($link->affected_rows ==1){
           Success($link);
    }else{
          Error("Parámetros incorrectos", $link);
  
    }
} else {
    Error($link->error, $link);
}

//------------------------------
//Servicio Finalizado.
//------------------------------
function Success($link) {
    $data = (array('Success' => "Recuerde siempre solicitar al cliente que finalice la encuesta del servicio. Gracias."));
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
