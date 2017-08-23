<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Bancos = new Bancos();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"No hay elementos","MensajeSuccess"=> '');
$data = array();
$datos = $Bancos->getList($values);

if($datos){
    foreach($datos as $datos){
        $data[] = array("IdBanco"=>$datos['IdBanco'],"Nombre"=>$datos['Nombre']);

    }


    $response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"data" => $data);

}
$response['data'] = $data;
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
