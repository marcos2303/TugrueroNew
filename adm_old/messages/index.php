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
		case "messages_list_json":
			executeMessagesListJson($values);	
		break;	
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('messages_list_view.php');
	}
	function executeNew($values = null)
	{
		$values['action'] = 'add';
		require('messages_form_view.php');
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Message = new Message();
		$values = $Message->getMessageById($values);
		$values['action'] = 'update';
                $values['msg'] = $msg;
		require('messages_form_view.php');
	}
	function executeUpdate($values = null)
	{
		
		$Message = new Message();
		$Message->updateMessage($values);		
		executeEdit($values,message_updated);die;
	}	
	function executeMessagesListJson($values)
	{
		$Message = new Message();
		$message_list_json = $Message ->getMessageList($values);
		$message_list_json_cuenta = $Message ->getCountMessageList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $message_list_json_cuenta;
		$array_json['recordsFiltered'] = $message_list_json_cuenta;
		if(count($message_list_json)>0)
		{   
                        
			foreach ($message_list_json as $message) 
			{
				$id_message = $message['id_message'];
				$status = $message['status'];
				
				if($status == 1)
				{
					$message_status = "<label class='label label-danger'>No visualizado</label>";
				}
				if($status == 0)
				{
					$message_status = "<label class='label label-success'>Visualizado</label>";
				}				
				$array_json['data'][] = array(
					"id_message" => $id_message,
					"names" => $message['names'],
					"email" => $message['email'],
					"phone" => $message['phone'],
					"message" => $message['message'],
					"status" => $message_status,
					"date_created" => $message['date_created'],
					"date_updated" => $message['date_updated'],
					"actions" => '<a href="index.php?action=edit&id_message='.$id_message.'" class="btn btn-default btn-sm"><i class="fa fa-edit  fa-pull-left fa-border"></i></a>'

					);	
			}	
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("id_message"=>null,"names"=>"","email"=>"","phone"=>"","message"=>"","status"=>"","date_created"=>"","date_updated"=>"","actions"=>"");
		}

		echo json_encode($array_json);die;
		
	}