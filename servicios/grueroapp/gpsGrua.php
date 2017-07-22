    <?php

header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);

if (json_last_error() == 0) {
    $idGrua = ($obj["idGrua"]);
    $Lat = ($obj["Lat"]);
    $Lng = ($obj["Lng"]);
} else {
    echo(JSONerror());
    exit();
}

//------------------------------
//Creando el $link de conexiones
//------------------------------
include_once 'conexion.php';


//------------------------------
//Query a la DB
//------------------------------

$Tabla = "Gruas"; //SecureData
$LastUpdate = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
$LastUpdate = date('Y-m-d H:i:s');
$result = $link->query("UPDATE $Tabla SET Latitud = '$Lat', Longitud = '$Lng', LastUpdate = '$LastUpdate' "
        . "WHERE idGrua = '$idGrua'");

//------------------------------
//Verificando el resultado
//------------------------------
if ($result) {
    if ($link->affected_rows === 1) {
        Success($link);
    } else {
        Suspendido($link);
    }
} else {
    Error($link->error, $link);
}

//------------------------------
//GPS almacenado correctamente
//------------------------------
function Success($link) {
    $data = (array('Success' => "GPS_OK"));
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}

//------------------------------
//Usuario Suspendido no puede actualizar su GPS
//------------------------------
function Suspendido($link) {
    $data = (array('Suspendido' => "Usted se encuentra temporalmente suspendido,"
        . " contacte a sporte técnico para mayor información."));
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
