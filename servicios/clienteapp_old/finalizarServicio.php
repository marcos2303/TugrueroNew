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

FinalizarServicio($obj, $link);
//EnviarFinalizacion($obj, $link);

function FinalizarServicio($obj, $link) {
//------------------------------
//Parámetros
//------------------------------
    
    $idSolicitud = ($obj["idSolicitud"]);
    $TratoCordial = ($obj["TratoCordial"]);
    $Presencia = ($obj["Presencia"]);
    $TratoVehiculo = ($obj["TratoVehiculo"]);
    $Puntual = ($obj["Puntual"]);
    $Observacion = ($obj["Observacion"]);


    
    /*
    $idSolicitud = "727";
    $TratoCordial = "5";
    $Presencia = "5";
    $TratoVehiculo = "5";
    $Puntual = "Si";
    $Observacion = "Data Forzada";

*/

//------------------------------
//Extras
//------------------------------
    $Tabla = "Servicios";
    $EstatusCliente = "Completado";

//------------------------------
//Query
//------------------------------
    $result = $link->query("UPDATE $Tabla SET EstatusCliente ='$EstatusCliente', TratoCordial = '$TratoCordial', "
            . "Presencia ='$Presencia', TratoVehiculo ='$TratoVehiculo', Observacion = '$Observacion', "
            . "Puntual = '$Puntual' WHERE idSolicitud = '$idSolicitud'");

//------------------------------
//Error Check
//------------------------------
    if (!$result) {
        Error($link->error, $link);
    }

//------------------------------
//External.FuncioneGenerales
//------------------------------
    $data = (array('Success' => "OK"));
    Success($data, $link);
  //  $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
  //  echo $json_array;
}

function EnviarFinalizacion($obj, $link) {

//------------------------------
//Parámetros
//------------------------------
    $idGrua = ($obj["idGrua"]);
    $idSolicitud = ($obj["idSolicitud"]);

   // $idGrua = "1";
   // $idSolicitud = "727";
    
//------------------------------
//Extras
//------------------------------
    $Tabla = "Gruas";

//------------------------------
//Query
//------------------------------   
    $result = $link->query("SELECT Token FROM $Tabla WHERE idGrua = '$idGrua'");

//------------------------------
//NO Error Check
//------------------------------
//------------------------------
//Respuesta
//------------------------------
    $response = $result->fetch_array(MYSQLI_ASSOC);
    $Grua[] = $response;
    $link->close();

//------------------------------
//Mensaje del Push
//------------------------------ 
    $data = array(
        'title' => 'Servicio Finalizado.',
        'message' => 'Finalizado el servicio #' . $idSolicitud,
        'notId' => $idSolicitud,
        'idSolicitud' => $idSolicitud,
        'Completado' => 'SI'
    );

//------------------------------
//Enviar Push
//------------------------------   
    include_once $_SERVER['DOCUMENT_ROOT'] . "/API/funcionesAPI.php";
    SendPush($Grua, $data);
}
