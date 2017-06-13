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
		case "users_company_list_json":
			executeUsersCompanyListJson($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('users_company_list_view.php');
	}
	function executeNew($values = null)
	{       
                $values['status'] = '1';
		$values['action'] = 'add';
		require('users_company_form_view.php');
	}
	function executeSave($values = null)
	{
		
		$UsersCompany = new UsersCompany();
		$values = $UsersCompany->saveUsersCompany($values);
		executeEdit($values,message_created);die;
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$UsersCompany = new UsersCompany();
		$values = $UsersCompany->getUsersCompanyById($values);
		$values['action'] = 'update';
                $values['msg'] = $msg;
		require('users_company_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$UsersCompany = new UsersCompany();
		$UsersCompany->updateUsersCompany($values);		
		executeEdit($values,message_updated);die;
	}	
	function executeUsersCompanyListJson($values)
	{
		$UsersCompany = new UsersCompany();
		$users_company_list_json = $UsersCompany ->getUsersCompanyList($values);
		$users_company_list_json_cuenta = $UsersCompany ->getCountUsersCompanyList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $users_company_list_json_cuenta;
		$array_json['recordsFiltered'] = $users_company_list_json_cuenta;
		if(count($users_company_list_json)>0)
		{
			foreach ($users_company_list_json as $users_company) 
			{
				$status = $users_company['status'];
				if($status == 0)
				{
					$message_status = "<label class='label label-danger'>Desactivado</label>";
				}
				if($status == 1)
				{
					$message_status = "<label class='label label-success'>Activo</label>";
				}
				$id = $users_company['id'];
				$array_json['data'][] = array(
					"id" => $id,
					"id_user" => $users_company['id_user'],
                                        "login" => $users_company['login'],
                                        "razon_social" => $users_company['razon_social'],
					"id_company" => $users_company['id_company'],
					"status" => $message_status,
                                        "date_created" => $users_company['date_created'],
                                        "date_updated" => $users_company['date_updated'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/users_company/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="id" value="'.$id.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id"=>null,"login"=>"","razon_social"=>"","status"=>"","date_created"=>"","date_updated"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}