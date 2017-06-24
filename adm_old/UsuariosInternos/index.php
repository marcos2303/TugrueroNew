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
	function executeNew($values = null)
	{       
        $values['status'] = '1';
		$values['action'] = 'add';
		require('form_view.php');
	}
	function executeSave($values = null)
	{
		$UsuariosInternos = new UsuariosInternos();
		$values = $UsuariosInternos->saveUsuariosInternos($values);
		executeEdit($values,message_created);die;
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$UsuariosInternos = new UsuariosInternos();
		$values = $UsuariosInternos->getUsuariosInternosById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		$UsuariosInternos = new UsuariosInternos();
		$UsuariosInternos->updateUsuariosInternos($values);
		executeEdit($values,message_updated);die;
	}	
	function executeListJson($values)
	{
		$UsuariosInternos = new UsuariosInternos();
		$list_json = $UsuariosInternos ->getUsuariosList($values);
		$list_json_cuenta = $UsuariosInternos ->getCountUsuariosList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				$status = $list['status'];
				if($status == 0)
				{
					$message_status = "<label class='label label-danger'>Desactivado</label>";
				}
				if($status == 1)
				{
					$message_status = "<label class='label label-success'>Activo</label>";
				}
				$id_user = $list['id_user'];
				$array_json['data'][] = array(
					"id_user" => $id_user,
					"login" => $list['login'],
					"document" => $list['document'],
					"nombres" => $list['first_name'],
					"apellidos" => $list['first_last_name'],
					"contacto" => $list['phone'],
                    "email" => $list['mail'],
                    "status" => $message_status,
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/UsuariosInternos/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id_user" value="'.$id_user.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
                                       
										.'</form>'
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id_user"=>null,"login"=>null,"document"=>"","nombres"=>"","apellidos"=>"","contacto"=>"","email"=>"","status"=>"","actions"=>"");
		}
		echo json_encode($array_json);die;
		
	}