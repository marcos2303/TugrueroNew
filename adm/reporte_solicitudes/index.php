<?php include("../../autoload.php");?>	
<?php //include("validator.php");?>
<?php include("../security/security.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
$values = array_merge($values,$_FILES);
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "list_json":
			executeListJson($values);	
		break;
		case "pdf":
			executePdf($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{	
		$Seguros = new Seguros();
		$seguros_list = $Seguros->getSegurosListSelect2();
		require('list_view.php');
	}
	function executeListJson($values)
	{
		$Solicitud = new Solicitud();
		$list_json = $Solicitud ->getSolicitudesServiciosList($values);
		$list_json_cuenta = $Solicitud ->getCountSolicitudesServiciosList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				$idPoliza = $list['idpoliza'];
                                $idSolicitud = $list['idsolicitud'];
				$array_json['data'][] = array(
                                        "idSolicitud" => $idSolicitud,
					"idPoliza" => $idPoliza,                                       
                                        "Cedula" => $list['cedula'],
					"Cliente" => $list['cliente'],
                                        "Placa" => $list['placa'],
                                        "Modelo" => $list['modelo'],
					"Seguro" => $list['seguro'],					
					"EstadoOrigen" => $list['estadoorigen'],
					"Direccion" => $list['direccion'],
					"MontoTaxi" => '<input type="text" value="'.$list['montotaxi'].'" size="4" class="" onchange="changeMontoTaxi('.$idSolicitud.',this.value);">',
                                        "MontoTaxiLimpio" => $list['montotaxi'],
                                        
                                        "Monto" => number_format((float)$list['monto'], 2, '.', ''),
					"Utilidad" => '<input value="'.$list['utilidad'].'" size="4" autocomplete="off" class="" onchange="changeUtilidad('.$idSolicitud.','."'".$list['monto']."'".',this.value);">%',
					"MontoFinal" => number_format((float)$list['montofinal'], 2, '.', ''),
                                        "TimeOpen" => $list['timeopen'],
					"actions" => ""
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
                                        "idSolicitud" => null,
					"idPoliza" => null,                                       
                                        "Cedula" => null,
					"Cliente" => null,
                                        "Placa" => null,
                                        "Modelo" => null,
					"Seguro" => null,					
					"EstadoOrigen" => null,
					"Direccion" => null,
					"MontoTaxi" => null,
                                        "MontoTaxiLimpio" => null,
                                        "Monto" => null,
                                        "Utilidad" => null,
					"MontoFinal" => null,
                                        "TimeOpen" => null,
					"actions" => ""
				
				);
		}
		echo json_encode($array_json);die;
		
	}
	function executePdf($values = null)
	{
		
		
		$PDFSolicitud = new PDFSolicitud();
		switch($values['formato'])
		{
			case 1:
				$PDFSolicitud ->formatoGenerico($values);
			break;
			default:
				$PDFSolicitud ->formatoGenerico($values);
			break;
		}
		die;
		
		//print_r($values);die;
	}  
