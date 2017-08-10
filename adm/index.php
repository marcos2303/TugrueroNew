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
		/*$securimage = new Securimage();
		$captcha = $values['ct_captcha'];
		if ($securimage->check($captcha) == false) 
		{
				$errors['captcha_error'] = 'Incorrect security code entered<br />';
				$values['error'] = "Imagen incorrecta";
				require('login.php');die;
		}*/
			if( (!isset($values['Login']) and $values['Login'] == '') or  (!isset($values['Clave']) and $values['Clave'] == '') )
			{
				$values['error'] = "Debe indicar usuario y clave";
				require('login.php');die;
			}else
			{
				$Usuarios= new Usuarios();
				$usuario_data = $Usuarios->getLogin($values);	
				if(!$usuario_data['IdUsuario']){
					$values['error'] = "Error en Usuario y/o Clave";
					require('login.php');die;
				}else{
					
                    $cuenta_conexiones = 0;
                    $ultima_conexion = date('Y-m-d h:i:s');
                    $usuario_data['IdAplicacion'] = 3;
                    $usuario_data['IdConexionTipo'] = 3;
                    $Conexiones = new Conexiones();
                    $ultima_conexion = $Conexiones->getUltimaConexion($usuario_data);
                    $Conexiones->addConexion($usuario_data);                   
                    $cuenta_conexiones = $Conexiones->getCuentaConexionesUsuario($usuario_data);
					$_SESSION['IdUsuario'] = $usuario_data['IdUsuario'];
					$_SESSION['Usuario'] = $usuario_data['Login'];
					$_SESSION['AutorizarPagos'] = $usuario_data['AutorizarPagos'];
					$_SESSION['AutorizarServicios'] = $usuario_data['AutorizarServicios'];
					$_SESSION['Nombres'] = $usuario_data['Nombres'];
					$_SESSION['Apellidos'] = $usuario_data['Apellidos'];
					$_SESSION['Perfil'] = $usuario_data['Perfil'];
                    $_SESSION['CuentaConexiones'] = $cuenta_conexiones;
                    $_SESSION['UltimaConexion'] = $ultima_conexion;
					require('bienvenida.php');die;
					
				}
			}
		

	}
	function executeLogout($values = null){
        session_destroy();
	unset($_SESSION['IdUsuario'],$_SESSION['Login'],$_SESSION['AutorizarPagos'],$_SESSION['AutorizarServicios'],$_SESSION['Nombres'],$_SESSION['Apellidos']);

	require('login.php');
	}
