<?php


function Success($data, $link) {
    $json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
    EndLogin($json_array, $link);
}


//------------------------------
//Fallo, retorna un fallo de consulta.
//------------------------------
function Fail($link, $mensaje) {
    $data = (array('Fallo' => $mensaje));
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
    echo ($json_array);
    exit();
}
