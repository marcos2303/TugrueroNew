<?php

header('Content-Type: application/json; charset:utf-8');

include_once 'conexion.php';


$Tabla = "Servicios"; //SecureData
$Tabla2 = "Solicitudes"; //SecureData

$idSolicitud = "727"; //SecureData
$Estatus = "Localizando";
$result = $link->query("DELETE FROM $Tabla WHERE idSolicitud = '$idSolicitud'");

if (!$result) {
    die($link->error);
}

$result2 = $link->query("UPDATE $Tabla2 SET Estatus='$Estatus' WHERE idSolicitud='$idSolicitud'");
if (!$result2) {
    die($link->error);
}

echo "OK";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

