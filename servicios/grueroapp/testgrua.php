<?php

header('Content-Type: application/json; charset:utf-8');

include_once 'conexion.php';
include_once $_SERVER['DOCUMENT_ROOT']."/API/funcionesAPI.php";

$mLat = "10.49";
$mLng = "-66.88";
$idSolicitud = "129";

echo (gmdate('g:i A - d/m/Y', time() - (4 * 3600 + 30 * 60)));
//ubicarGruas($link, $mLat, $mLng,$idSolicitud);


