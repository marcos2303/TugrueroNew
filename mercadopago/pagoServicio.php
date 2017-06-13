<?php

$obj = $_REQUEST;
require_once ('lib/mercadopago.php');
$mp = new MP('TEST-5186169867844597-010416-c52b08ec7835da68699c21828d0e3edf__LA_LD__-47922559');
$valido = true;
//print_r($obj);die;
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
			"email" => "deandrademarcos@hotmail.com",
			"identification" => array("type" => $obj["cardholder"]["identification"]["type"],"number" => $obj["cardholder"]["identification"]["number"])
		)
	);
	try{
		$payment = $mp->post("/v1/payments", $payment_data);
		$json_array = json_encode($payment, JSON_UNESCAPED_UNICODE);
	}catch(Exception $e){
		$error = array('error' => $e->getMessage());
		$json_array = json_encode($error, JSON_UNESCAPED_UNICODE);	
	}	


}else{

	$error = array('error' => 'Verifique la información suministrada');
	$json_array = json_encode($error, JSON_UNESCAPED_UNICODE);


}

echo $json_array;
