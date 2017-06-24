<?php include("../../autoload.php");?>	
<?php include("../security/security.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "change_utilidad":
			executeChangeUtilidad($values);	
		break;
		case "change_monto_taxi":
                        executeChangeMontoTaxi($values);	
		break;
		case "grueros_online":
			executeGruerosOnline($values);	
		break;
		case "grueros_online_detalle":
			executeGruerosOnlineDetalle($values);	
		break;
		case "grueros_estados":
			executeGruerosEstados($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		echo "404";die;
	}
	function executeChangeUtilidad($values = null)
	{
		$Solicitud = new Solicitud();
                $id_solictud = $values['idSolicitud'];
                $utilidad = $values['utilidad'];
                $monto = $values['monto'];              
		//$data = $Polizas->getPolizasById($values);
		$monto_final = $monto + (($monto * $utilidad) / 100);
                $monto_final = number_format((float)$monto_final, 2, '.', '');
                $values['MontoFinal'] = $monto_final;
                $Solicitud->updateMontoFinal($values);
                           

	}
	function executeChangeMontoTaxi($values = null)
	{
		$Solicitud = new Solicitud();
                $id_solicitud = $values['idSolicitud'];
                $MontoTaxi = $values['MontoTaxi'];
                $Solicitud->updateMontoTaxi($values);
                           

	}
	function executeGruerosOnline($values = null)
	{
		$Grueros = new Grueros();
		$grueros_online = $Grueros->getGruerosOnline();
		
		
		$array= array("SI"=>$grueros_online['si'], "NO" => $grueros_online['no']);
		
		echo json_encode($array);
                           

	}
	function executeGruerosOnlineDetalle($values = null)
	{
		$Grueros = new Grueros();
		$grueros_online = $Grueros->getGruerosOnlineDetalle($values);
		
		require('grueros_online_detalle.php');
                           

	}
	function executeGruerosEstados($values = null)
	{
		$Grueros = new Grueros();
		$grueros_online = $Grueros->getGruerosOnlineDetalleEstados($values);
		
		require('grueros_estados.php');
                           

	}