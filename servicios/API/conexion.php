<?php
$conexion = array(
    'username' =>'root',
    'password' => 'tugrua',
    'database' => 'TuGruero',
    'host' => '52.25.178.106'
);

$link = new mysqli($conexion['host'], $conexion['username'], $conexion['password'], $conexion['database']);
$link->set_charset('utf8');

if ($link->connect_error) {
    echo(ConnectError($link->connect_error));
    exit();
}

function ConnectError($mError) {
    $jsonData = (array('Error' => "No se ha podido conectar con la plataforma, por favor intente de nuevo. ".$mError));
    $json_array = json_encode($jsonData, JSON_UNESCAPED_UNICODE);
    return ($json_array);
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

