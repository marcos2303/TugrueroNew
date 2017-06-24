<?php include("../../autoload.php");?>	
<?php include("validator.php");?>	
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
		case "new":
			executeNew($values);	
		break;
		case "add":
			executeSave($values);	
		break;
		case "edit":
			executeEdit($values);	
		break;
		case "update":
			executeUpdate($values);	
		break;		
		case "services_administrators_list_json":
			executeServicesAdministratorsListJson($values);	
		break;
		case "forwardPassword":
			executeforwardPassword($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('services_administrators_list_view.php');
	}
	function executeEdit($values = null,$msg = null)
	{
		$id_company = $values['id_company'];
		$ServicesAdministrators = new ServicesAdministrators();
		$values = $ServicesAdministrators->getServicesAdministratorsById($values);
		$values['action'] = 'update';
		$values['id_company'] = $id_company;
        $values['msg'] = $msg;
		require('services_administrators_form_view.php');
	}
	function executeServicesAdministratorsListJson($values)
	{
		$ServicesAdministrators = new ServicesAdministrators();
		$services_administrators_list_json = $ServicesAdministrators->getServicesAdministratorsList($values);
		$services_administrators_list_json_cuenta = $ServicesAdministrators ->getCountServicesAdministratorsList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $services_administrators_list_json_cuenta;
		$array_json['recordsFiltered'] = $services_administrators_list_json_cuenta;
		if(count($services_administrators_list_json)>0)
		{
						
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("*")
			->where("id=?",$values['id_company'])
			->fetch();
			$ConnectionORM -> close();
			
			$razon_social = $q['razon_social'];
			
			foreach ($services_administrators_list_json as $services_administrators) 
			{
				
				$idGrua = $services_administrators['idgrua'];
				$idSolicitud = $services_administrators['idsolicitud'];
				$array_json['data'][] = array(
					"idGrua" => $idGrua,
					"razon_social" => $razon_social,
					"NombresApellidos" => $services_administrators['nombre']." ".$services_administrators['apellido'],
					"IdSolicitud" => $services_administrators['idsolicitud'],
					"TimeInicio" => $services_administrators['timeinicio'],
					"TimeFin" => $services_administrators['timefin'],
					"EstatusCliente" => $services_administrators['estatuscliente'],
					"EstatusGrua" => $services_administrators['estatusgrua'],
					"Motivo" => $services_administrators['motivo'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/services_administrators/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
									   .'<input type="hidden" name="idSolicitud" value="'.$idSolicitud.'">  '
                                       .'<input type="hidden" name="idGrua" value="'.$idGrua.'">  '
									   .'<input type="hidden" name="id_company" value="'.$values['id_company'].'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-mobile fa-2x  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("idGrua"=>null,"razon_social"=>"","NombresApellidos"=>"","IdSolicitud"=>"","TimeInicio"=>"","TimeFin"=>"","EstatusCliente"=>"","EstatusGrua"=>"","Motivo"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}
