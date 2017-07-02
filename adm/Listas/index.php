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
	case "lista_gruas":
	executeListaGruas($values);
	break;
	case "lista_gruas_json":
	executeListaGruasJson($values);
	break;
	default:
	executeIndex($values);
	break;
}
function executeIndex($values = null)
{
	die;
}
function executeListaGruas($values){
	require("lista_gruas.php");
}
function executeListaGruasJson($values)
{
	$Gruas = new Gruas();
	$list_json = $Gruas ->getList($values);
	$list_json_cuenta = $Gruas ->getCountList($values);
	$array_json = array();
	$array_json['recordsTotal'] = $list_json_cuenta;
	$array_json['recordsFiltered'] = $list_json_cuenta;
	if(count($list_json)>0)
	{
		foreach ($list_json as $list)
		{

			$IdGrua = $list['IdGrua'];
			$array_json['data'][] = array(
				"IdProveedor" => $IdProveedor,
				"Placa" => $list['Placa'],
				"NombreGruaTipo" => $list['NombreGruaTipo'],
				"NombreMarca" => $list['NombreMarca'],
				"Modelo" => $list['Modelo'],
				"Color" => $list['Color'],
				"Anio" => $list['Anio'],
				"actions" => '
				<div class="btn-group">
				<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-gear"></i> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="#" onclick="editarDatatable('."'".$list['Placa']."'".')"> Editar</a></li>
				<li><a href="#"> Historial de servicios</a></li>
				<li><a href="#"> Conexiones</a></li>
				<li><a href="#"> Reiniciar dispositivo</a></li>
				</ul>
				</div>'
			);
		}
	}else{
		$array_json['recordsTotal'] = 0;
		$array_json['recordsFiltered'] = 0;
		$array_json['data'][] = array(
			"IdProveedor" => null,
			"Placa" => null,
			"NombreGruaTipo" => null,
			"NombreMarca" => null,
			"Modelo" => null,
			"Color" => null,
			"Anio" => null,
			"actions" => null
		);
	}
	echo json_encode($array_json);die;

}
