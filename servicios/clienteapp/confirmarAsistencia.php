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
$EstatusCliente = "Asistido";

//------------------------------
//Query
//------------------------------   
$result = $link->query("UPDATE $Tabla SET EstatusCliente = '$EstatusCliente' WHERE idSolicitud ='$idSolicitud'");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

//------------------------------
//Respuesta
//------------------------------
    $response = (array('Success' => "OK"));

//------------------------------
//Success
//------------------------------
    $data = (array('Success' => "OK"));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json_array;

    
//------------------------------
//Ejecutar Push
//------------------------------  
    EnviarFinalizacion($obj, $link);
    

function EnviarFinalizacion($obj, $link) {

//------------------------------
//Parámetros
//------------------------------
    $idGrua = ($obj["idGrua"]);
    $idSolicitud = ($obj["idSolicitud"]);

 //   $idGrua = "1";
 //   $idSolicitud = "727";
    
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