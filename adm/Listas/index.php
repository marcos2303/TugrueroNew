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
	case "lista_servicios_administracion":
	executeListaServiciosAdministracion($values);
	break;
	case "lista_servicios_json":
	executeListaServiciosJson($values);
	break;
	case "lista_servicios_administracion_json":
	executeListaServiciosAdministracionJson($values);
	break;
	case "lista_servicios_corta":
	executeListaServiciosCorta($values);
	break;
	case "detalle_servicio":
	executeDetalleServicio($values);
	break;
	case "detalle_servicio_json":
	executeDetalleServicioJson($values);
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
	$i  = 0;
	if(count($list_json)>0)
	{
		foreach ($list_json as $list)
		{

			$IdGrua = $list['IdGrua'];
			$array_json['data'][$i] = array(
				"IdProveedor" => $IdProveedor,
				"Placa" => $list['Placa'],
				"NombreGruaTipo" => $list['NombreGruaTipo'],
				"NombreMarca" => $list['NombreMarca'],
				"Modelo" => $list['Modelo'],
				"Color" => $list['Color'],
				"Anio" => $list['Anio'],
				"Clave" => $list['Clave'],
				"IdentificacionProveedor" => $list['IdentificacionProveedor'],
				"Proveedor" => $list['Proveedor'],
				"NombreEstado" => $list['NombreEstado'],
				"CiudadProveedor" => $list['CiudadProveedor'],
				"ZonaProveedor" => $list['ZonaProveedor'],
				"Celular1" => $list['Celular1'],
				"Celular2" => $list['Celular2'],
				"Celular3" => $list['Celular3'],
				"Disponible" => $list['Disponible']);

				if(!isset($values['opcion'])){
					$array_json['data'][$i]['actions'] = '
					<div class="btn-group">
					<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-gear"></i> <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#" onclick="editarDatatable('."'".$list['Placa']."'".')"> Editar</a></li>
					<li><a href="#" onclick="ListarServiciosGrua(1,1)"> Historial de servicios</a></li>
					<li><a href="#"> Conexiones</a></li>
					<li><a href="#"> Reiniciar dispositivo</a></li>
					</ul>
					</div>';
				}


				if(isset($values['opcion']) and $values['opcion']=='1'){
						$array_json['data'][$i]['actions'] = '
						<div class="btn-group">
						<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-gear"></i> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#" onclick="SeleccionarGruaLista('."'".$list['IdGrua']."'".')"> Seleccionar</a></li>
						</ul>
						</div>';
				}


				$i++;
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
			"IdentificacionProveedor" => null,
			"Proveedor" => null,
			"NombreEstado" => null,
			"CiudadProveedor" => null,
			"ZonaProveedor" => null,
			"Celular1" => null,
			"Celular2" => null,
			"Celular3" => null,
			"Disponible" => null,
			"actions" => null,

		);
	}
	echo json_encode($array_json);die;

}
function executeListaServicios($values){
	require("lista_servicios.php");
}
function executeListaServiciosCorta($values){
	require("lista_servicios_corta.php");
}
function executeListaServiciosAdministracion($values){
	require("lista_servicios_administracion.php");
}
function executeListaServiciosJson($values)
{
	$Servicios = new Servicios();
	$list_json = $Servicios ->getList($values);
	$list_json_cuenta = $Servicios ->getCountList($values);
	$array_json = array();
	$array_json['recordsTotal'] = $list_json_cuenta;
	$array_json['recordsFiltered'] = $list_json_cuenta;
	if($list_json_cuenta['cuenta']>0)
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
				"actions" => '
				<div class="btn-group">
				<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-gear"></i> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right">
				<li><a href="#" onclick="DetalleServicio('.$list['IdServicio'].')"> Detalle servicio</a></li>
				</ul>
				</div>'
			);
		}
	}else{
		$array_json['recordsTotal'] = 0;
		$array_json['recordsFiltered'] = 0;
		$array_json['data'][] = array(
			"CodigoServicio" =>  "",
			"NombreAplicacion" =>  "",
			"NombreServicioTipo" =>  "",
			"NombreEstatus" => "",
			"Agendado" =>  "",
			"FechaAgendado" => "",
			"NombreUsuarioServicio" =>  "",
			"NombreAveria" =>  "",
			"AveriaDetalle" =>  "",
			"NombreCondicionLugar" =>  "",
			"CondicionDetalle" =>  "",
			"LatitudOrigen" =>  "",
			"LongitudOrigen" =>  "",
			"NombreEstadoOrigen" => "",
			"DireccionOrigen" =>  "",
			"DireccionOrigenDetallada" =>  "",
			"LatitudDestino" =>  "",
			"LongitudDestino" =>  "",
			"NombreEstadoDestino" =>  "",
			"DireccionDestino" =>  "",
			"DireccionDestinoDetallada" =>  "",
			"KM" => "",
			"Inicio" =>  "",
			"Fin" =>  "",
			"Observacion" =>  "",
			"UltimaActCliente" =>  "",
			"UltimaActGruero" =>  "",
			/************Datos ServiciosGruas, Proveedores y Gruas*******************/
			"IdentificacionProveedor" =>  "",
			"NombresProveedor" =>  "",
			"ApellidosProveedor" =>  "",
			"NombreProveedorTipo" =>  "",
			"PlacaGrua" =>  "",
			"NombreMarcaGruas" =>  "",
			"ModeloGrua" =>  "",
			"AnioGrua" =>  "",
			"ColorGrua" =>  "",
			"NombresGrua" =>  "",
			"ApellidosGrua" => "",
			"CedulaGrua" =>  "",
			"CelularGrua" =>  "",
			"TratoCordial" =>  "",
			"Presencia" =>  "",
			"TratoVehiculo" =>  "",
			"Puntual" =>  "",
			/**********Datos ServiciosClientes****************************/
			"NombresCliente" =>  "",
			"ApellidosCliente" =>  "",
			"CedulaCliente" =>  "",
			"PlacaCliente" =>  "",
			"ModeloCliente" =>  "",
			"ColorCliente" =>  "",
			"AnioCliente" =>  "",
			"CelularCliente" =>  "",
			"PolizaVencida" =>  "",
			"NombreUsuarioCliente" =>  "",
			/*****************ServiciosPrecios*************************************/
			"PrecioModificado" =>  "",
			"PrecioSIvaBaremo" =>  "",
			"PrecioCIvaBaremo" =>  "",
			"PrecioSIvaModificado" =>  "",
			"PrecioCIvaModificado" =>  "",
			"NombreUsuarioPrecio" =>  "",
			"actions" => ''
		);
	}

	echo json_encode($array_json);die;

}
function executeListaServiciosAdministracionJson($values)
{
	$Servicios = new Servicios();
	$list_json = $Servicios ->getList($values);
	$list_json_cuenta = $Servicios ->getCountList($values);
	$array_json = array();
	$array_json['recordsTotal'] = $list_json_cuenta;
	$array_json['recordsFiltered'] = $list_json_cuenta;
	if($list_json_cuenta['cuenta']>0)
	{
		foreach ($list_json as $list)
		{

			$IdServicio = $list['IdServicio'];
			$checked = "";
			if($list['FacturaPagada']==1){
				$checked = 'checked="checked"';
			}
			$array_json['data'][] = array(
				"CodigoServicio" =>  '<input type="checkbox" name="" class="selec" value="'.$IdServicio.'" id="CodigoServicio['.$list['IdServicio'].']"> ['.$list['CodigoServicio']."]",
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
				"NumeroFactura" =>  "<input type='text' value='".$list['NumeroFactura']."' class=' bloquear NumeroFactura_".$list['IdServicio']."' onchange='CambiarNumeroFactura(this,".$list['IdServicio'].");' id='NumeroFactura[".$list['IdServicio']."]'>",
                "FechaFacturaDigital" =>  '<input type="date" value="'.$list['FechaFacturaDigital'].'" class="bloquear FechaFacturaDigital_'.$list['IdServicio'].'" onchange="CambiarFechaFacturaDigital(this,'.$list['IdServicio'].');" id="FechaFacturaDigital_'.$list['IdServicio'].'">',
                "FechaFacturaFisica" =>  "<input type='date' value='".$list['FechaFacturaFisica']."' class='bloquear FechaFacturaFisica_".$list['IdServicio']."'  onchange='CambiarFechaFacturaFisica(this,".$list['IdServicio'].");' id='FechaFacturaFisica[".$list['IdServicio']."]'>",
								"FechaEstimadaPago" =>  "<input type='date' readonly='readonly' value='".$list['FechaEstimadaPago']."' class=' bloquear FechaEstimadaPago_".$list['IdServicio']."' onchange='CambiarFechaEstimadaPago(this,".$list['IdServicio'].");' id='FechaEstimadaPago[".$list['IdServicio']."]'>",
								"FacturaPagada" =>  "<input type='checkbox' $checked value='".$list['FacturaPagada']."' class='bloquear FacturaPagada_".$list['IdServicio']."' onchange='CambiarFacturaPagada(this,".$list['IdServicio'].");' id='FacturaPagada[".$list['IdServicio']."]'>",
                /*"FechaFacturaDigital" =>  $list['FechaFacturaDigital'],
                "FechaEstimadaPago" =>  $list['FechaEstimadaPago'],
                "FechaFacturaFisica" =>  $list['FechaFacturaFisica'],
                "FacturaPagada" =>  $list['FacturaPagada'],*/
                "actions" => '
                    <div class="btn-group">
					<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-gear"></i> <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#" onclick="editarDatatable('."'".$list['Placa']."'".')"> Editar</a></li>
					<li><a href="#" onclick="ListarServiciosGrua(1,1)"> Historial de servicios</a></li>
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
			"CodigoServicio" =>  "",
			"NombreAplicacion" =>  "",
			"NombreServicioTipo" =>  "",
			"NombreEstatus" => "",
			"Agendado" =>  "",
			"FechaAgendado" => "",
			"NombreUsuarioServicio" =>  "",
			"NombreAveria" =>  "",
			"AveriaDetalle" =>  "",
			"NombreCondicionLugar" =>  "",
			"CondicionDetalle" =>  "",
			"LatitudOrigen" =>  "",
			"LongitudOrigen" =>  "",
			"NombreEstadoOrigen" => "",
			"DireccionOrigen" =>  "",
			"DireccionOrigenDetallada" =>  "",
			"LatitudDestino" =>  "",
			"LongitudDestino" =>  "",
			"NombreEstadoDestino" =>  "",
			"DireccionDestino" =>  "",
			"DireccionDestinoDetallada" =>  "",
			"KM" => "",
			"Inicio" =>  "",
			"Fin" =>  "",
			"Observacion" =>  "",
			"UltimaActCliente" =>  "",
			"UltimaActGruero" =>  "",
			/************Datos ServiciosGruas, Proveedores y Gruas*******************/
			"IdentificacionProveedor" =>  "",
			"NombresProveedor" =>  "",
			"ApellidosProveedor" =>  "",
			"NombreProveedorTipo" =>  "",
			"PlacaGrua" =>  "",
			"NombreMarcaGruas" =>  "",
			"ModeloGrua" =>  "",
			"AnioGrua" =>  "",
			"ColorGrua" =>  "",
			"NombresGrua" =>  "",
			"ApellidosGrua" => "",
			"CedulaGrua" =>  "",
			"CelularGrua" =>  "",
			"TratoCordial" =>  "",
			"Presencia" =>  "",
			"TratoVehiculo" =>  "",
			"Puntual" =>  "",
			/**********Datos ServiciosClientes****************************/
			"NombresCliente" =>  "",
			"ApellidosCliente" =>  "",
			"CedulaCliente" =>  "",
			"PlacaCliente" =>  "",
			"ModeloCliente" =>  "",
			"ColorCliente" =>  "",
			"AnioCliente" =>  "",
			"CelularCliente" =>  "",
			"PolizaVencida" =>  "",
			"NombreUsuarioCliente" =>  "",
			/*****************ServiciosPrecios*************************************/
			"PrecioModificado" =>  "",
			"PrecioSIvaBaremo" =>  "",
			"PrecioCIvaBaremo" =>  "",
			"PrecioSIvaModificado" =>  "",
			"PrecioCIvaModificado" =>  "",
			"NombreUsuarioPrecio" =>  "",
            "NumeroFactura" =>  "",
            "FechaFacturaDigital" =>  "",
            "FechaEstimadaPago" =>  "",
            "FechaFacturaFisica" =>  "",
            "FacturaPagada" =>  "",

			"actions" => ''
		);
	}

	echo json_encode($array_json);die;

}
function executeDetalleServicio($values){
	require("detalle_servicio.php");
}
function executeDetalleServicioJson($values)
{
	$Servicios= new Servicios();
	/****************Seteo y comprobacion de valores*******************/
	$values["IdServicio"] = 50;
	$response = array("Error"=>1,"MensajeError"=>"No existen datos del servicio","MensajeSuccess"=> '');
	$datos = $Servicios->getServiciosDetalle($values);
	if($datos){
	  $response = array(
	    "CodigoServicio" =>  $datos['CodigoServicio'],
	    "NombreAplicacion" =>  $datos['NombreAplicacion'],
	    "NombreServicioTipo" =>  $datos['NombreServicioTipo'],
	    "NombreEstatus" =>  $datos['NombreEstatus'],
	    "Agendado" =>  $datos['Agendado'],
	    "FechaAgendado" =>  $datos['FechaAgendado'],
	    "NombreUsuarioServicio" =>  $datos['NombreUsuarioServicio'],
	    "NombreAveria" =>  $datos['NombreAveria'],
	    "AveriaDetalle" =>  $datos['AveriaDetalle'],
	    "NombreCondicionLugar" =>  $datos['NombreCondicionLugar'],
	    "CondicionDetalle" =>  $datos['CondicionDetalle'],
	    "LatitudOrigen" =>  $datos['LatitudOrigen'],
	    "LongitudOrigen" =>  $datos['LongitudOrigen'],
	    "NombreEstadoOrigen" =>  $datos['NombreEstadoOrigen'],
	    "DireccionOrigen" =>  $datos['DireccionOrigen'],
	    "DireccionOrigenDetallada" =>  $datos['DireccionOrigenDetallada'],
	    "LatitudDestino" =>  $datos['LatitudDestino'],
	    "LongitudDestino" =>  $datos['LongitudDestino'],
	    "NombreEstadoDestino" =>  $datos['NombreEstadoDestino'],
	    "DireccionDestino" =>  $datos['DireccionDestino'],
	    "DireccionDestinoDetallada" =>  $datos['DireccionDestinoDetallada'],
	    "KM" =>  $datos['KM'],
	    "Inicio" =>  $datos['Inicio'],
	    "Fin" =>  $datos['Fin'],
	    "Observacion" =>  $datos['Observacion'],
	    "UltimaActCliente" =>  $datos['UltimaActCliente'],
	    "UltimaActGruero" =>  $datos['UltimaActGruero'],
	    /************Datos ServiciosGruas, Proveedores y Gruas*******************/
	    "IdentificacionProveedor" =>  $datos['IdentificacionProveedor'],
	    "NombresProveedor" =>  $datos['NombresProveedor'],
	    "ApellidosProveedor" =>  $datos['ApellidosProveedor'],
	    "NombreProveedorTipo" =>  $datos['NombreProveedorTipo'],
	    "PlacaGrua" =>  $datos['PlacaGrua'],
	    "NombreMarcaGruas" =>  $datos['NombreMarcaGruas'],
	    "ModeloGrua" =>  $datos['ModeloGrua'],
	    "AnioGrua" =>  $datos['AnioGrua'],
	    "ColorGrua" =>  $datos['ColorGrua'],
	    "NombresGrua" =>  $datos['NombresGrua'],
	    "ApellidosGrua" =>  $datos['ApellidosGrua'],
	    "CedulaGrua" =>  $datos['CedulaGrua'],
	    "CelularGrua" =>  $datos['CelularGrua'],
	    "TratoCordial" =>  $datos['TratoCordial'],
	    "Presencia" =>  $datos['Presencia'],
	    "TratoVehiculo" =>  $datos['TratoVehiculo'],
	    "Puntual" =>  $datos['Puntual'],
	    /**********Datos ServiciosClientes****************************/
	    "NombresCliente" =>  $datos['NombresCliente'],
	    "ApellidosCliente" =>  $datos['ApellidosCliente'],
	    "CedulaCliente" =>  $datos['CedulaCliente'],
	    "PlacaCliente" =>  $datos['PlacaCliente'],
	    "ModeloCliente" =>  $datos['ModeloCliente'],
	    "ColorCliente" =>  $datos['ColorCliente'],
	    "AnioCliente" =>  $datos['AnioCliente'],
	    "CelularCliente" =>  $datos['CelularCliente'],
	    "PolizaVencida" =>  $datos['PolizaVencida'],
	    "NombreUsuarioCliente" =>  $datos['NombreUsuarioCliente'],
	    /*****************ServiciosPrecios*************************************/
	    "PrecioModificado" =>  $datos['PrecioModificado'],
	    "PrecioSIvaBaremo" =>  $datos['PrecioSIvaBaremo'],
	    "PrecioCIvaBaremo" =>  $datos['PrecioCIvaBaremo'],
	    "PrecioSIvaModificado" =>  $datos['PrecioSIvaModificado'],
	    "PrecioCIvaModificado" =>  $datos['PrecioCIvaModificado'],
	    "NombreUsuarioPrecio" =>  $datos['NombreUsuarioPrecio']
	  );

	}
	echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
