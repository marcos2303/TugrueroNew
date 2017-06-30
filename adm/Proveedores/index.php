<?php include("../../autoload.php");?>
<?php //include("validator.php");?>
<?php //include("../security/security.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
$values = array_merge($values,$_FILES);
	switch ($action) {
		case "index":
			executeIndex($values);
		break;
		case "new":
			executeNew($values);
		break;
		case "edit":
			executeEdit($values);
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
		$values['action'] = "new";
		require('form_view.php');
	}
	function executeEdit($values = null)
	{
		$values['action'] = "edit";
		require('form_view.php');
	}
	function executeListJson($values)
	{
		$Proveedores = new Proveedores();
		$list_json = $Proveedores ->getList($values);
		$list_json_cuenta = $Proveedores ->getCountList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list)
			{

				$IdProveedor = $list['IdProveedor'];
				$array_json['data'][] = array(
					"IdProveedor" => $IdProveedor,
                    "Identificacion" => $list['Identificacion'],
					"Nombres" => $list['Nombres'],
					"Apellidos" => $list['Apellidos'],
					"NombreTipoProveedor" => $list['NombreTipoProveedor'],
					"NombreEstado" => $list['NombreEstado'],
                    "Ciudad" => $list['NombreEstado'],
					"actions" =>
                                       '<form method="POST" action = "'.full_url.'/adm/Polizas/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="idPoliza" value="'.$idPoliza.'">  '
                                       .'<button class="btn btn-default btn-sm" title="Ver detalle" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
									   . '<a class="btn btn-default btn-sm" title="Ver servicios" href="'.full_url.'/adm/ServiciosClientes/index.php?idPoliza='.$idPoliza.'"><i class="fa fa-mobile   fa-pull-left fa-border"></i></a>'
									   .'<a class="btn btn-default btn-sm" title="Generar servicio" href="'.full_url.'/adm/solicitud/index.php?action=new&idPoliza='.$idPoliza.'"><i class="fa fa-map-marker   fa-pull-left fa-border"></i></a>'

										.'</form>'
					);
			}
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
            "IdProveedor"=>null,
            "Identificacion"=>"",
            "Nombres"=>"",
            "Apellidos"=>"",
            "NombreProveedorTipo"=>"",
            "NombreEstado" => null,
            "Ciudad"=>"",
            "actions"=>"");
		}
		echo json_encode($array_json);die;

	}
	function executeListGruas($values)
	{
		$Gruas = new Gruas();
		$list_json = $Gruas ->getList($values);
		$list_json_cuenta = $Proveedores ->getCountList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list)
			{

				$IdProveedor = $list['IdProveedor'];
				$array_json['data'][] = array(
					"IdProveedor" => $IdProveedor,
										"Identificacion" => $list['Identificacion'],
					"Nombres" => $list['Nombres'],
					"Apellidos" => $list['Apellidos'],
					"NombreTipoProveedor" => $list['NombreTipoProveedor'],
					"NombreEstado" => $list['NombreEstado'],
										"Ciudad" => $list['NombreEstado'],
					"actions" =>
																			 '<form method="POST" action = "'.full_url.'/adm/Polizas/index.php" >'
																			 .'<input type="hidden" name="action" value="edit">  '
																			 .'<input type="hidden" name="idPoliza" value="'.$idPoliza.'">  '
																			 .'<button class="btn btn-default btn-sm" title="Ver detalle" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
										 . '<a class="btn btn-default btn-sm" title="Ver servicios" href="'.full_url.'/adm/ServiciosClientes/index.php?idPoliza='.$idPoliza.'"><i class="fa fa-mobile   fa-pull-left fa-border"></i></a>'
										 .'<a class="btn btn-default btn-sm" title="Generar servicio" href="'.full_url.'/adm/solicitud/index.php?action=new&idPoliza='.$idPoliza.'"><i class="fa fa-map-marker   fa-pull-left fa-border"></i></a>'

										.'</form>'
					);
			}
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array(
						"IdProveedor"=>null,
						"Identificacion"=>"",
						"Nombres"=>"",
						"Apellidos"=>"",
						"NombreProveedorTipo"=>"",
						"NombreEstado" => null,
						"Ciudad"=>"",
						"actions"=>"");
		}
		echo json_encode($array_json);die;

	}
