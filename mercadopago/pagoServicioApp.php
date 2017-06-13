<?php
setlocale(LC_NUMERIC,"es_ES.UTF8");
include_once 'conexion.php';
//------------------------------
//Incluyendo funciones de Error, Fallo y Exito.

//------------------------------
include_once 'funcionesGenerales.php';

$obj = $_REQUEST;
require_once ('lib/mercadopago.php');
//$mp = new MP('TEST-5186169867844597-010416-c52b08ec7835da68699c21828d0e3edf__LA_LD__-47922559');
$mp = new MP('APP_USR-2019407814509205-033114-293bc8d65b89b8a59ffc7e161e2787e4__LB_LA__-221065884');
$valido = true;
//print_r($obj);die;
//print_r($obj['params']);die;
//echo $obj['Modelo'];die;
//valido el payment method Id
if(!isset($obj['paymentMethodId']) or $obj['paymentMethodId'] == '')
{
	$valido = false;	
}
if(!isset($obj['token']) or $obj['token'] == '')
{
	$valido = false;
		
}


if($valido == true)
{
	$payment_data = array(
		"transaction_amount" => (float)$obj["precio"],
		"token" => $obj['token'],
		"description" => $obj["descripcion"],
		"installments" => 1,
		"payment_method_id" => $obj['paymentMethodId'],
		"payer" => array (
			"email" => $obj['email'],
			"identification" => array("type" => $obj["cardholder"]["identification"]["type"],"number" => $obj["cardholder"]["identification"]["number"])
		)
	);
	try{
		$payment = $mp->post("/v1/payments", $payment_data);
		$json_array = json_encode($payment, JSON_UNESCAPED_UNICODE);
		//print_r($payment);die;
		if(isset($payment['response']['status']) and $payment['response']['status'] =='approved')
		{
			$result = $link->query("
										INSERT INTO `TuGruero`.`PagosMP` 
											(`id`, 
											`Cedula`, 
											`Nombres`, 
											`Apellidos`, 
											`Clase`, 
											`Tipo`, 
											`Marca`, 
											`Modelo`, 
											`Anio`, 
											`Color`, 
											`description`, 
											`status`, 
											`status_detail`, 
											`currency_id`, 
											`date_created`, 
											`date_approved`, 
											`payment_method_id`, 
											`payment_type_id`, 
											`collector_id`, 
											`payer_type`, 
											`payer_id`, 
											`payer_email`, 
											`payer_identification_type`, 
											`payer_identification_number`, 
											`payer_first_name`, 
											`payer_last_name`, 
											`payer_entity_type`, 
											`transaction_amount`, 
											`net_received_amount`, 
											`carholder_name`, 
											`carholder_identification_type`, 
											`cardholder_identification_number`
											)
											VALUES
											('".$payment['response']['id']."', 
											'".$obj['Cedula']."', 
											'".$obj['Nombres']."', 
											'".$obj['Apellidos']."', 
											'".$obj['Clase']."', 
											'".$obj['Tipo']."', 
											'".$obj['Marca']."', 
											'".$obj['Modelo']."', 
											'".$obj['Anio']."', 
											'".$obj['Color']."', 
											'".$payment['response']['description']."', 
											'".$payment['response']['status']."', 
											'".$payment['response']['status_detail']."', 
											'".$payment['response']['currency_id']."', 
											'".$payment['response']['date_created']."', 
											'".$payment['response']['date_approved']."', 
											'".$payment['payment_method_id']."', 
											'".$payment['response']['payment_type_id']."', 
											'".$payment['response']['collector_id']."', 
											'".$payment['response']['payer']['type']."', 
											'".$payment['response']['payer']['id']."', 
											'".$payment['response']['payer']['email']."', 
											'".$payment['response']['payer']['identification']['type']."', 
											'".$payment['response']['payer']['identification']['number']."', 
											'".$payment['response']['payer']['first_name']."', 
											'".$payment['response']['payer']['last_name']."', 
											'".$payment['response']['response']['payer']['entity_type']."', 
											'".$payment['response']['transaction_amount']."', 
											'".$payment['response']['transaction_details']['net_received_amount']."', 
											'".$payment['response']['card']['cardholder']['name']."', 
											'".$payment['response']['card']['carholder']['identification_type']."', 
											'".$payment['response']['payer']['identification']['number']."'
											)");	
		}

		
		
	}catch(Exception $e){
		$error = array('error' => $e->getMessage());
		$json_array = json_encode($error,JSON_UNESCAPED_UNICODE);	
	}	


}else{

	$error = array('error' => 'Verifique la información suministrada');
	$json_array = json_encode($error, JSON_UNESCAPED_UNICODE);


}

echo $json_array;
