<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');


/************* Clases a utilizar *******************/
$Usuarios= new Usuarios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdServicio"=>"0");
//$values['Cedula']='V-21411814';
//$values['Placa'] = 'AAABBB';
//$values['IdSeguro'] = '1';
$datos_usuario = $Usuarios->getDatosUsuario($values);
if($datos_usuario){

			$response = array(
				"Error"=>0,
				"MensajeError"=>"",
				"MensajeSuccess"=> 'OK',
				"IdUsuario"=> $datos_usuario['IdUsuario'],
                "Nombres"=> $datos_usuario['Nombres'],
				"Apellidos"=> $datos_usuario['Apellidos'],
				"Celular"=> $datos_usuario['Celular'],
				"Email"=> $datos_usuario['Email'],
				"Login"=> $datos_usuario['Login'],
				"Perfil"=> $datos_usuario['Perfil'],
                "AutorizarPagos"=> $datos_usuario['AutorizarPagos'],
                "AutorizarServicios"=> $datos_usuario['AutorizarServicios'],
                "AutorizarGruas"=> $datos_usuario['AutorizarGruas'],    

				);
}else{
$response = array("Error"=>0,"MensajeError"=> "","MensajeSuccess"=> '');

}

echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
