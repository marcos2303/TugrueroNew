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


//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';
//$idSolicitud = 398;
//$idGrua = 2;
//------------------------------
//Iniciando la toma del servicio
//------------------------------
TomarSevicio($link, $idSolicitud, $idGrua);

function TomarSevicio($link, $idSolicitud, $idGrua) {

    $Tabla = "Solicitudes"; //DataSegura
    $Localizando = "Localizando"; //DataSegura
    $Asignado = "Asignado"; //DataSegura

    $result = $link->query("UPDATE $Tabla SET Estatus = '$Asignado' "
            . "WHERE idSolicitud = '$idSolicitud' AND Estatus = '$Localizando'");
    if ($result) {

        if ($link->affected_rows === 1) {
            SetServicio($link, $idSolicitud, $idGrua);
        } else {
            Fail($link);
        }
    } else {
        Error($link->error);
    }
}

//------------------------------
//Creando el Servicio
//------------------------------
function SetServicio($link, $idSolicitud, $idGrua) {
    $Poliza = GetPoliza($link, $idSolicitud);
    CrearServicio($link, $idSolicitud, $idGrua, $Poliza["idPoliza"]);
    ActualizarEstatus($link,$idGrua);
    $json_array = json_encode($Poliza, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Obteniendo los datos del cliente.
//------------------------------
function GetPoliza($link, $idSolicitud) {
    $t1 = "Polizas";
    $t2 = "Solicitudes";
    $result = $link->query("SELECT Nombre,Apellido,Marca,Modelo,Placa,Tipo,Color,Año,CellContacto,Polizas.idPoliza"
            . " FROM $t1 JOIN $t2 ON Solicitudes.idPoliza = Polizas.idPoliza "
            . "WHERE Solicitudes.idSolicitud = '$idSolicitud'");

    if ($result) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    } else {
        Error($link->error, $link);
        exit();
    }
}

//------------------------------
//Insertando el  servicio a partir de la
//solicitud con el mismo id.
//------------------------------
function CrearServicio($link, $idSolicitud, $idGrua, $idPoilza) {
    $TimeInicio = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));
    $Tabla = "Servicios";
    $result = $link->query("INSERT INTO $Tabla (idSolicitud,idGrua,idPoliza,TimeInicio) "
            . "VALUES ('$idSolicitud','$idGrua','$idPoilza','$TimeInicio')");

    if (!$result) {
        Error($link->error, $link);
    }
}

function ActualizarEstatus($link, $idGrua) {
    $Tabla = "Gruas";
    $Disponible = "NO";
    $result = $link->query("UPDATE $Tabla SET Disponible = '$Disponible' "
            . "WHERE idGrua = '$idGrua'");

    if (!$result) {
        Error($link->error, $link);
    }
}

//------------------------------
//Fallo, retorna un mensaje dado que la solicitud
//no se enuentra en estado "Localizando".
//------------------------------
function Fail($link) {
    $data = (array('Fallo' => "Ésta solicitud ya no se encuentra disponible."));
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
