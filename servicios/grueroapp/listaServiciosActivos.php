<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Servicios = new Servicios();

/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"No hay elementos","MensajeSuccess"=> '');
$data = array();

$datos = $Servicios->getServiciosActivos($values);

if($datos){
    $data = array();
    foreach($datos as $key => $datos){

       $data[] = $datos;
        //print_r($datos[1]);die;  
       
    }


    $response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"data" => $data);

}
$response['data'] = $data;
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
