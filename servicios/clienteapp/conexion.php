<?php

$conexion = array(
    'username' => 'root',
    'password' => 'tugrua',
    'database' => 'TuGruero',
    'host' => 'localhost'
);
$conexion2 = array(
    'username' => 'root',
    'password' => 'tugrua',
    'database' => 'admin_tugruero',
    'host' => 'localhost'
);

$link = new mysqli($conexion['host'], $conexion['username'], $conexion['password'], $conexion['database']);
$link->set_charset('utf8');
if ($link->connect_error) {
    echo(ConnectError($link->connect_error));
    exit();
}

$link2 = new mysqli($conexion2['host'], $conexion2['username'], $conexion2['password'], $conexion2['database']);
$link2->set_charset('utf8');
if ($link2->connect_error) {
    echo(ConnectError($link2->connect_error));
    exit();
}

function ConnectError($mError) {
    $jsonData = (array('Error' => "No se ha podido conectar con la plataforma, por favor intente de nuevo. ".$mError));
    $json_array = json_encode($jsonData, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}
