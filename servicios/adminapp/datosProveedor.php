<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/
$Proveedores= new Proveedores();
/****************Seteo y comprobacion de valores*******************/

$response = array("Error"=>1,"MensajeError"=>"No existe el proveedor","MensajeSuccess"=> '');
$datos = $Proveedores->getProveedoresInfo($values['IdProveedor']);
if($datos){
	$response = array(
		"Error"=>0,
		"MensajeError"=>"",
		"MensajeSuccess"=> 'Ok',
		'IdProveedor' => $datos['IdProveedor'],
		'IdProveedorTipo' => $datos['IdProveedorTipo'],
		'IdEstado' => $datos['IdEstado'],
        'Estatus' => 1,
        'Identificacion' => $datos['Identificacion'],
        'Nombres' => $datos['Nombres'],
        'Apellidos' => $datos['Apellidos'],
        'Ciudad' => $datos['Ciudad'],
        'Zona' => $datos['Zona'],
        'NumeroClub' => $datos['NumeroClub'],
        'Celular1' => $datos['Celular1'],
		'Celular2' => $datos['Celular2'],
		'Celular3' => $datos['Celular3'],
		'ClaveEspecial' => $datos['ClaveEspecial'],
		);

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);