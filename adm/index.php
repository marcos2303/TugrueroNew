<?php include("../autoload.php");?>		
<?php //include("security/security.php");?>						
<?php


$action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}
$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
        case "acceso":
			executeAcceso($values);	
		break;
		case "bienvenida":
			executeBienvenida($values);	
		break;
		case "logout":
			executeLogout($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
						
	function executeIndex($values = null){
		
	session_destroy();
	unset($_SESSION['id_perms'],$_SESSION['id_user'],$_SESSION['id_company'],$_SESSION['name'],$_SESSION['login']);
	require('login.php');
	}
	function executeBienvenida($values = null){
	
	require('bienvenida.php');
	}
	function executeAcceso($values = null){
		
		$login = true;
		$securimage = new Securimage();
		$captcha = $values['ct_captcha'];
		if ($securimage->check($captcha) == false) 
		{
				$errors['captcha_error'] = 'Incorrect security code entered<br />';
				$values['error'] = "Imagen incorrecta";
				require('login.php');die;
		}else
		{
			if($login == false)
			{
				require('bienvenida.php');
			}else
			{
				$Users = new Users();
				$user_data = $Users->getLogin($values);
				if($user_data['id_user'] == false or $user_data['id_user']=='' or !isset($user_data['id_user']))
				{
					$values['error'] = "Usuario o clave incorrecto";
					require('login.php');die;
				}else
				{
					if($user_data["id_perms"]!=2)
					{
						$values['error'] = "No posee permisos para ingresar. Comuníquese con el administrador";
						require('login.php');die;
					}else
					{
						$_SESSION['id_perms'] =$user_data["id_perms"];
						$_SESSION['id_user'] = $user_data["id_user"];
						$_SESSION['login'] = $user_data["login"];
						$_SESSION['name'] = ucwords(strtolower($user_data["first_name"]))." ".ucwords(strtolower($user_data["first_last_name"]));

						require('bienvenida.php');die;
					}

				}
				
				
				
			}
		}
	require('bienvenida.php');
	}
	function executeLogout($values = null){
        session_destroy();
	unset($_SESSION['id_perms'],$_SESSION['id_user'],$_SESSION['id_company'],$_SESSION['name'],$_SESSION['login']);

	require('login.php');
	}
