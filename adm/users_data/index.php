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
		case "users_data_list_json":
			executeUsersDataListJson($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		executeEdit($values);die;
	}
	function executeNew($values = null)
	{       
        $values['status'] = '1';
		$values['action'] = 'add';
		require('users_data_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$UsersData = new UsersData();
		$values = $UsersData->saveUsersData($values);
		executeEdit($values,message_created);die;
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$UsersData = new UsersData();
		$values['id_users'] = $_SESSION['id_user'];
		$values = $UsersData->getUsersDataById($values);
		$values['action'] = 'update';
        $values['msg'] = $msg;
		require('users_data_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$UsersData = new UsersData();
		$carpeta = "../../web/files/operators";
		$fichero_subido = $carpeta."/";
		
		if(isset($_FILES['image']))
		{	
			$nombreArchivo = $values['login'].".".pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $fichero_subido.$nombreArchivo))
			{
				$values['image'] = $nombreArchivo;
			}
		}
		$UsersData->updateUsersData($values);		
		executeEdit($values,message_updated);die;
	}	
	function executeUsersDataListJson($values)
	{
		$UsersData = new UsersData();
		$users_data_list_json = $UsersData ->getUsersDataList($values);
		$users_data_list_json_cuenta = $UsersData ->getCountUsersDataList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $users_data_list_json_cuenta;
		$array_json['recordsFiltered'] = $users_data_list_json_cuenta;
		if(count($users_data_list_json)>0)
		{
			foreach ($users_data_list_json as $users_data) 
			{
				$id_users = $users_data['id'];
				$array_json['data'][] = array(
					"id" => $id_users,
					"engine_serial" => $users_data['engine_serial'],
					"body_serial" => $users_data['body_serial'],
					"registration_plate" => $users_data['registration_plate'],
					"year_vehicle" => $users_data['year_vehicle'],
					"make" => $users_data['make'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/ap/hoist/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id" value="'.$id_users.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
                                       .'</form>'
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id"=>null,"engine_serial"=>"","body_serial"=>"","registration_plate"=>"","year_vehicle"=>"","make"=>"","actions"=>"");
		}
		echo json_encode($array_json);die;
		
	}