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
		case "reset":
			executeReset($values);	
		break;
		case "cambia_status":
			executeCambiaStatus($values);	
		break;
		case "list_json":
			executeListJson($values);	
		break;		
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		require('list_view.php');
	}
	function executeReset($values = null)
	{
		$Grueros = new Grueros();
		$reset = $Grueros->reset($values);
	}
	function executeCambiaStatus($values = null)
	{
		$Grueros = new Grueros();
		$reset = $Grueros->cambiaStatus($values);
	}
	function executeListJson($values)
	{
		$Grueros = new Grueros();
		$list_json = $Grueros ->getGruerosList($values);
		$list_json_cuenta = $Grueros ->getCountGruerosList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				$idGrua = $list['idgrua'];

				$condicion= $list['condicion'];
				if($condicion == 'Inactivo')
				{
					$message_condicion = "<a class='btn btn-danger btn-sm' onclick='cambiaStatus(".$idGrua.",1)'><i class='fa fa-close'></i> Inactivo</a>";
				}
				if($condicion == 'Activo')
				{
					$message_condicion = "<a class='btn btn-success btn-sm' onclick='cambiaStatus(".$idGrua.",0)'><i class='fa fa-check'></i> Activo</a>";
				}
				$array_json['data'][] = array(
					"idGrua" => $idGrua,
					"Cedula" => $list['cedula'],
					"Nombre" => $list['nombre']." ".$list['apellido'],
					"Placa" => $list['placa'],
					"Celular" => $list['celular'],
					"Disponible" => $list['disponible'],
					"Location" => $list['location'],
					"ZoneWork" => $list['zone_work'],
					"DeviceId" => $list['deviceid'],
					"Condicion" => $message_condicion,
					"actions" => "<a class='btn btn-success' onclick='resetSessionAws(".$idGrua.")'><i class='fa fa-paint-brush fa-pull-left fa-border'></i> Resetear</a>"
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
				"idGrua"=>null,
				"Cedula"=>"",
				"Nombre"=>"",
				"Placa" => "",
				"Celular" => "",
				"Disponible" => "",
				"Location" => "",
				"ZoneWork" => "",
				"DeviceId" => "",
				"Condicion" => "",
				"actions"=>"",
				
				);
		}
		echo json_encode($array_json);die;
		
	}
