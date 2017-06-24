<?php include("../../autoload.php");?>	
<?php //include("validator.php");?>	
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
		case "services_operator_list_json":
			executeServicesOperatorListJson($values);	
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
	require('services_operator_list_view.php');
	}
	function executeNew($values = null)
	{       
        $values['status'] = '1';
		$values['action'] = 'add';
		require('services_operator_form_view.php');
	}
	function executeSave($values = null)
	{
		$errors = validaFormularioUsers($values);
		if(count($errors)>0)
		{
			$values["errors"] = $errors;
			executeNew($values);
		}
		
		else 
		{
			$password = substr( md5(microtime()), 1, 8);
			$loggin = 'O-'.$values['nationality'].$values['document'];
			$mail = $values['mail'];
			$ServicesOperator = new Users();
			$values['login'] = $loggin;
			$values['password'] = $password;
			$values = $ServicesOperator->saveUserOperator($values);
			$message = "Usuario: ".$loggin." Clave: ".$password;
			$Mail = new Mail();
			//$Mail->send(array($mail), array('noreply@frbcomputersgroup.com.ve'),"Asunto",$message);
			$values['message'] = "se ha enviado la clave a su correo electrónico.";
			$values["action"] = "edit";
			executeEdit($values,message_created);die;
		}
	}
	function executeEdit($values = null,$msg = null)
	{
		$ServicesOperator = new ServicesOperator();
		$values = $ServicesOperator->getServicesOperatorById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		require('services_operator_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$ServicesOperator = new Users();
		$ServicesOperator->updateUserOperator($values);		
		executeEdit($values,message_updated);die;
	}	
	function executeServicesOperatorListJson($values)
	{
		$ServicesOperator = new ServicesOperator();
		$services_operator_list_json = $ServicesOperator->getServicesOperatorList($values);
		$services_operator_list_json_cuenta = $ServicesOperator ->getCountServicesOperatorList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $services_operator_list_json_cuenta;
		$array_json['recordsFiltered'] = $services_operator_list_json_cuenta;
		$UsersCompany = new UsersCompany();
		if(count($services_operator_list_json)>0)
		{
			foreach ($services_operator_list_json as $services_operator) 
			{
				
				$idGrua = $services_operator['idgrua'];
				$idSolicitud = $services_operator['idsolicitud'];
				$array_json['data'][] = array(
					"idGrua" => $idGrua,
					"Cedula" => $services_operator['cedula'],
					"NombreApellido" => $services_operator['nombre']." ".$services_operator['apellido'],
					"IdSolicitud" => $services_operator['idsolicitud'],
					"TimeInicio" => $services_operator['timeinicio'],
					"TimeFin" => $services_operator['timefin'],
					"EstatusCliente" => $services_operator['estatuscliente'],
					"EstatusGrua" => $services_operator['estatusgrua'],
					"Motivo" => $services_operator['motivo'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/services_operator/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="idSolicitud" value="'.$idSolicitud.'">  '
									   .'<input type="hidden" name="idGrua" value="'.$idGrua.'">  '
									   .'<input type="hidden" name="id_user" value="'.$idGrua.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-mobile fa-2x  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("idGrua"=>null,"Cedula"=>"","NombreApellido"=>"","IdSolicitud"=>"","TimeInicio"=>"","TimeFin"=>"","EstatusCliente"=>"","EstatusGrua"=>"","Motivo"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}
	function executeforwardPassword($values)
	{
		$services_operator = new Users();
		$usuario = $services_operator->getUserById($values);
		$mail = $usuario["mail"];
		$password = substr( md5(microtime()), 1, 8);
		unset($values);
		$values = array("id_user" => $usuario["id_user"],"password" => $password);
		$services_operator->updateUser($values);
		$message = "Clave: ".$password;
		$Mail = new Mail();
		$Mail->send(array($mail), array('noreply@frbcomputersgroup.com.ve'),"Asunto",$message);
		$msg = "se ha enviado la clave al correo electrónico del usuario.";
		executeEdit($values,$msg);
	}