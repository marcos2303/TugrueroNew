<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
$Push = new Push();
$response = $Push->despacharPush($values);
echo $response;
