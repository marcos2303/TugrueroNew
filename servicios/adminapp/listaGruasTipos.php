<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$GruasTipos= new GruasTipos();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>1,"MensajeError"=>"No hay elementos","MensajeSuccess"=> '');
$data = array();
$datos = $GruasTipos->getList();
if($datos){
    foreach($datos as $datos){
        $data[] = array("IdGruaTipo"=>$datos['IdGruaTipo'],"Nombre"=>$datos['Nombre']);

    }
	
    
    $response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"data" => $data);

}
$response['data'] = $data;
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);