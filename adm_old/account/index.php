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
		case "change_pass_view":
			executeChangePassView($values);	
		break;
		case "change_pass":
			executeChangePass($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
	require('users_list_view.php');
	}
	function executeChangePassView($values){
		
		$values['action'] = "change_pass";
		require('change_pass_view.php');
		
	}
	function executeChangePass($values){

		$Users = new Users();
		if(strlen($values['new_password'])<6){
			$values['error'] = "La clave nueva debe contener 8 dígitos";
			require('change_pass_view.php');die;
		}
		
		if(strlen($values['retype_password'])<6){
			$values['error'] = "La clave nueva debe contener 8 dígitos";
			require('change_pass_view.php');die;
		}
		
		if($values['new_password'] != $values['retype_password'])
		{
			$values['error'] = "La clave nueva no coincide al repetirla";
			
		}elseif($values['new_password'] == '' or $values['retype_password']=='')
		{
			$values['error'] = "Debe indicar la clave nueva y repetirla";
		}else{
			$valid = $Users->comparePasswordByUser($values);
			if($valid == true)
			{
				$Users->changePassword($values);
				$values['msg'] = message_updated;
				/*$Grúas = new Aws();
				$dateGrueros = array("idGrua" => $values['id_user'],"Clave" => $values['new_password']);
				$Grúas->updateGrueros($dateGrueros);*/

			}else
			{
				$values['error'] = "La clave actual no coincide";

			}			
			
			
		}
		
		
		


		require('change_pass_view.php');die;
		//executeChangePass($values);die;
		
		
	}