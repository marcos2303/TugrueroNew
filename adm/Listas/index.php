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
	case "lista_servicios":
	executeListaServicios($values);
	break;
	case "lista_servicios_json":
	executeListaServiciosJson($values);
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
				"Clave" => $list['Clave'],
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
			"Clave" => null,
			"actions" => null
		);
	}
	echo json_encode($array_json);die;

}
function executeListaServicios($values){
	require("lista_servicios.php");
}
function executeListaServiciosJson($values)
{
	$Servicios = new Servicios();
	$list_json = $Servicios ->getList($values);
	$list_json_cuenta = $Servicios ->getCountList($values);
	$array_json = array();
	$array_json['recordsTotal'] = $list_json_cuenta;
	$array_json['recordsFiltered'] = $list_json_cuenta;
	if(count($list_json)>0)
	{
		foreach ($list_json as $list)
		{

			$IdServicio = $list['IdServicio'];
			$array_json['data'][] = array(
				"CodigoServicio" =>  $list['CodigoServicio'],
				"NombreAplicacion" =>  $list['NombreAplicacion'],
				"NombreServicioTipo" =>  $list['NombreServicioTipo'],
				"NombreEstatus" =>  $list['NombreEstatus'],
				"Agendado" =>  $list['Agendado'],
				"FechaAgendado" =>  $list['FechaAgendado'],
				"NombreUsuarioServicio" =>  $list['NombreUsuarioServicio'],
				"NombreAveria" =>  $list['NombreAveria'],
				"AveriaDetalle" =>  $list['AveriaDetalle'],
				"NombreCondicionLugar" =>  $list['NombreCondicionLugar'],
				"CondicionDetalle" =>  $list['CondicionDetalle'],
				"LatitudOrigen" =>  $list['LatitudOrigen'],
				"LongitudOrigen" =>  $list['LongitudOrigen'],
				"NombreEstadoOrigen" =>  $list['NombreEstadoOrigen'],
				"DireccionOrigen" =>  $list['DireccionOrigen'],
				"DireccionOrigenDetallada" =>  $list['DireccionOrigenDetallada'],
				"LatitudDestino" =>  $list['LatitudDestino'],
				"LongitudDestino" =>  $list['LongitudDestino'],
				"NombreEstadoDestino" =>  $list['NombreEstadoDestino'],
				"DireccionDestino" =>  $list['DireccionDestino'],
				"DireccionDestinoDetallada" =>  $list['DireccionDestinoDetallada'],
				"KM" =>  $list['KM'],
				"Inicio" =>  $list['Inicio'],
				"Fin" =>  $list['Fin'],
				"Observacion" =>  $list['Observacion'],
				"UltimaActCliente" =>  $list['UltimaActCliente'],
				"UltimaActGruero" =>  $list['UltimaActGruero'],
				/************Datos ServiciosGruas, Proveedores y Gruas*******************/
				"IdentificacionProveedor" =>  $list['IdentificacionProveedor'],
				"NombresProveedor" =>  $list['NombresProveedor'],
				"ApellidosProveedor" =>  $list['ApellidosProveedor'],
				"NombreProveedorTipo" =>  $list['NombreProveedorTipo'],
				"PlacaGrua" =>  $list['PlacaGrua'],
				"NombreMarcaGruas" =>  $list['NombreMarcaGruas'],
				"ModeloGrua" =>  $list['ModeloGrua'],
				"AnioGrua" =>  $list['AnioGrua'],
				"ColorGrua" =>  $list['ColorGrua'],
				"NombresGrua" =>  $list['NombresGrua'],
				"ApellidosGrua" =>  $list['ApellidosGrua'],
				"CedulaGrua" =>  $list['CedulaGrua'],
				"CelularGrua" =>  $list['CelularGrua'],
				"TratoCordial" =>  $list['TratoCordial'],
				"Presencia" =>  $list['Presencia'],
				"TratoVehiculo" =>  $list['TratoVehiculo'],
				"Puntual" =>  $list['Puntual'],
				/**********Datos ServiciosClientes****************************/
				"NombresCliente" =>  $list['NombresCliente'],
				"ApellidosCliente" =>  $list['ApellidosCliente'],
				"CedulaCliente" =>  $list['CedulaCliente'],
				"PlacaCliente" =>  $list['PlacaCliente'],
				"ModeloCliente" =>  $list['ModeloCliente'],
				"ColorCliente" =>  $list['ColorCliente'],
				"AnioCliente" =>  $list['AnioCliente'],
				"CelularCliente" =>  $list['CelularCliente'],
				"PolizaVencida" =>  $list['PolizaVencida'],
				"NombreUsuarioCliente" =>  $list['NombreUsuarioCliente'],
				/*****************ServiciosPrecios*************************************/
				"PrecioModificado" =>  $list['PrecioModificado'],
				"PrecioSIvaBaremo" =>  $list['PrecioSIvaBaremo'],
				"PrecioCIvaBaremo" =>  $list['PrecioCIvaBaremo'],
				"PrecioSIvaModificado" =>  $list['PrecioSIvaModificado'],
				"PrecioCIvaModificado" =>  $list['PrecioCIvaModificado'],
				"NombreUsuarioPrecio" =>  $list['NombreUsuarioPrecio'],
				"actions" => 'vacio'
			);
		}
	}else{
		$array_json['recordsTotal'] = 0;
		$array_json['recordsFiltered'] = 0;
		$array_json['data'][] = array(
			"CodigoServicio" =>  null,
			"NombreAplicacion" =>  null,
			"NombreServicioTipo" =>  null ,
			"NombreEstatus" =>  null ,
			"Agendado" =>  null ,
			"FechaAgendado" =>  null ,
			"NombreUsuarioServicio" =>  null ,
			"NombreAveria" =>  null ,
			"AveriaDetalle" =>  null ,
			"NombreCondicionLugar" =>  null ,
			"CondicionDetalle" =>  null ,
			"LatitudOrigen" =>  null ,
			"LongitudOrigen" =>  null ,
			"NombreEstadoOrigen" => null,
			"DireccionOrigen" => null,
			"DireccionOrigenDetallada" =>  null ,
			"LatitudDestino" =>  null ,
			"LongitudDestino" =>  null ,
			"NombreEstadoDestino" =>  null ,
			"DireccionDestino" =>  null ,
			"DireccionDestinoDetallada" =>  null ,
			"KM" =>  null ,
			"Inicio" =>  null ,
			"Fin" =>  null ,
			"Observacion" =>  null ,
			"UltimaActCliente" =>  null ,
			"UltimaActGruero" =>  null ,
			/************Datos ServiciosGruas, Proveedores y Gruas*******************/
			"IdentificacionProveedor" =>  null ,
			"NombresProveedor" =>  null ,
			"ApellidosProveedor" =>  null ,
			"NombreProveedorTipo" =>  null ,
			"PlacaGrua" =>  null ,
			"NombreMarcaGruas" =>  null ,
			"ModeloGrua" =>  null ,
			"AnioGrua" =>  null ,
			"ColorGrua" =>  null ,
			"NombresGrua" =>  null ,
			"ApellidosGrua" =>  null ,
			"CedulaGrua" =>  null ,
			"CelularGrua" =>  null ,
			"TratoCordial" =>  null ,
			"Presencia" =>  null ,
			"TratoVehiculo" =>  null ,
			"Puntual" =>  null ,
			/**********Datos ServiciosClientes****************************/
			"NombresCliente" =>  null ,
			"ApellidosCliente" =>  null ,
			"CedulaCliente" =>  null ,
			"PlacaCliente" =>  null ,
			"ModeloCliente" =>  null ,
			"ColorCliente" =>  null ,
			"AnioCliente" =>  null ,
			"CelularCliente" =>  null ,
			"PolizaVencida" =>  null ,
			"NombreUsuarioCliente" =>  null ,
			/*****************ServiciosPrecios*************************************/
			"PrecioModificado" =>  null ,
			"PrecioSIvaBaremo" =>  null ,
			"PrecioCIvaBaremo" =>  null ,
			"PrecioSIvaModificado" =>  null ,
			"PrecioCIvaModificado" =>  null ,
			"NombreUsuarioPrecio" =>  null ,
			"actions" => 'vacio'
		);
	}
	echo json_encode($array_json);die;

}
