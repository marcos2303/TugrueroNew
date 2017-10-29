<?php
header('Content-Type: application/json; charset:utf-8');
$values = file_get_contents('php://input');
$values = json_decode($values, true);
include('../../autoload_servicios.php');
/************* Clases a utilizar *******************/

$Usuarios= new Usuarios();
/****************Seteo y comprobacion de valores*******************/
$response = array("Error"=>0,"Actualizado"=> 0,"MensajeError"=>"","MensajeSuccess"=> '',"IdUsuario"=>$values['IdUsuario']);
/*************************Actualizamos************************************/
//Clave

$cambio_clave = false;

if(isset($values['ClaveActual']) and $values['ClaveActual']!='') $cambio_clave = true;
if(isset($values['NuevaClave']) and $values['NuevaClave']!='') $cambio_clave = true;
if(isset($values['Clave']) and $values['Clave']!='') $cambio_clave = true;

if($cambio_clave){
    
    if($values['Clave'] != $values['NuevaClave']){
      $response = array("Error"=>1,"Actualizado"=> 0,"MensajeError"=>"La clave debe coincidir al repetirla","MensajeSuccess"=> 'Ok',"IdUsuario"=>$values['IdUsuario']);  
      $cambio_clave = false;
     
      
    }else{
        $clave_actual= hash("sha256",$values['ClaveActual']); 
        $clave_nueva = hash("sha256",$values['Clave']); 
        $datos_usuario = $Usuarios->getDatosUsuario($values);
        $clave_bd = $datos_usuario["Clave"];
        if($clave_actual != $clave_bd ){
            $response = array("Error"=>1,"Actualizado"=> 0,"MensajeError"=>"La clave actual no coincide","MensajeSuccess"=> 'Ok',"IdUsuario"=>$values['IdUsuario']);  
            $cambio_clave = false;
        }else{
            $cambio_clave = true;
            $values['Clave'] = $clave_nueva;
            unset($values['ClaveActual'], $values['NuevaClave']);
        }
        
    }
    
}

if(!$cambio_clave){
    unset($values['ClaveActual'], $values['NuevaClave'],$values['Clave']);
}

$cambio_clave_especial = false;

if(isset($values['ClaveActualEspecial']) and $values['ClaveActualEspecial']!='') $cambio_clave_especial = true;
if(isset($values['NuevaClaveEspecial']) and $values['NuevaClaveEspecial']!='') $cambio_clave_especial = true;
if(isset($values['ClaveEspecial']) and $values['ClaveEspecial']!='') $cambio_clave_especial = true;

if($cambio_clave_especial){
    
    if($values['ClaveEspecial'] != $values['NuevaClaveEspecial']){
      $response = array("Error"=>1,"Actualizado"=> 0,"MensajeError"=>"La clave especial debe coincidir al repetirla","MensajeSuccess"=> 'Ok',"IdUsuario"=>$values['IdUsuario']);  
      $cambio_clave_especial = false;
     
      
    }else{
        $clave_actual_especial= hash("sha256",$values['ClaveActualEspecial']); 
        $clave_nueva_especial = hash("sha256",$values['ClaveEspecial']); 
        $datos_usuario = $Usuarios->getDatosUsuario($values);
        $clave_bd_especial = $datos_usuario["ClaveEspecial"];
        if($clave_actual_especial != $clave_bd_especial ){
            $response = array("Error"=>1,"Actualizado"=> 0,"MensajeError"=>"La clave especial actual no coincide","MensajeSuccess"=> 'Ok',"IdUsuario"=>$values['IdUsuario']);  
            $cambio_clave_especial = false;
        }else{
            $cambio_clave_especial = true;
            $values['ClaveEspecial'] = $clave_nueva_especial;
            unset($values['ClaveActualEspecial'], $values['NuevaClaveEspecial']);
        }
        
    }
    
}

if(!$cambio_clave_especial){
    unset($values['ClaveActualEspecial'], $values['NuevaClaveEspecial'],$values['ClaveEspecial']);
}



$valido = true;
if($valido){
	if($Usuarios->updateUsuario($values)){
		$response = array("Error"=>0,"Actualizado"=> 1,"MensajeError"=>"","MensajeSuccess"=> 'Ok',"IdUsuario"=>$values['IdUsuario']);

	}

}
echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
