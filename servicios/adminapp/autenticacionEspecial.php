<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Usuarios= new Usuarios();
/****************Seteo y comprobacion de valores*******************/

$response = array("Error"=>1,"MensajeError"=>"Error en Usuario o Clave","MensajeSuccess"=> '');
$datos = $Usuarios->getLoginEspecial($values);
if($datos){
	$response = array(
		"Error"=>0,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Ok',
		'IdUsuario' => $datos['IdUsuario'],
		'Login' => $datos['Login'],
		'AutorizarPagos' => $datos['AutorizarPagos'],
        'AutorizarServicios' => $datos['AutorizarServicios'],
        'AutorizarGruas' => $datos['AutorizarGruas'],
        'Nombres' => $datos['Nombres'],
        'Apellidos' => $datos['Apellidos'],
        'Estatus' => $datos['Estatus'],
        'Perfil' => $datos['Perfil'],
		);

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);