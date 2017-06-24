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
		case "view":
			executeView($values);	
		break;
		case "update":
			executeUpdate($values);	
		break;		
		case "list_json":
			executeListJson($values);	
		break;
		case "individual":
			executeIndividual($values);	
		break;
		case "individual_json":
			executeIndividualJson($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		require('list_view.php');
	}
	function executeView($values = null)
	{
		$ServiciosClientes = new ServiciosClientes();
		$values = $ServiciosClientes->getServiciosClientesById($values);
		require('form_view.php');
	}
	function executeListJson($values)
	{
		$ServiciosClientes = new ServiciosClientes();
		$list_json = $ServiciosClientes ->getServiciosClientesList($values);
		$list_json_cuenta = $ServiciosClientes ->getCountServiciosClientesList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				
				$idServicio = $list['idsolicitud'];
				$array_json['data'][] = array(
					"idServicio" => $idServicio,
					"EstadoOrigen" => $list['estadoorigen'],
					"Direccion" => $list['direccion'],
					"TimeInicio" => $list['timeinicio'],
					"TimeFin" => $list['timefin'],
                    "Cedula" => $list['cedula'],
                    "Nombre" => $list['nombre']." ".$list['apellido'],
					"EstatusCliente" => $list['estatuscliente'],
					"EstatusGrua" => $list['estatusgrua'],
					"queocurre" => $list['queocurre'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/ServiciosClientes/index.php" >'
                                       .'<input type="hidden" name="action" value="view">  '
                                       .'<input type="hidden" name="idSolicitud" value="'.$idServicio.'">  '
                                       .'<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'		
                                       
										.'</form>'
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("idServicio"=>"","EstadoOrigen"=>"","Direccion"=>"","TimeInicio"=>"","TimeFin"=>"","Cedula"=>"","Nombre"=>"","EstatusCliente"=>"","EstatusGrua"=>"","queocurre"=>"queocurre","actions"=>"");
		}
		echo json_encode($array_json);die;
		
	}
	function executeIndividual($values = null)
	{

		require('individual_view.php');
	}
	function executeIndividualJson($values = null)
	{

		$Polizas = new Polizas();
                $data = $Polizas->getPolizasByDocumento($values);
                echo json_encode($data);
                
	}