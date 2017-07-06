<?php

class Servicios {

	public $IdServicio = 1;
	public $IdAplicacion = 1;//por defecto es la APP movil
	public $Agendado = 0;//inicializa en No el agendado

	public function getIdServicio() {
		return $this->IdServicio;
	}
	public function setIdServicio($IdServicio) {
		$this->IdServicio = $IdServicio;
	}

	public function getIdAplicacion() {
		return $this->IdAplicacion;
	}
	public function setIdAplicacion($IdAplicacion) {
		$this->IdAplicacion = $IdAplicacion;
	}
	public function getAgendado() {
		return $this->Agendado;
	}
	public function setAgendado($Agendado) {
		$this->Agendado = $Agendado;
	}


	function addServicios($values){
		$array = array(
			'CodigoServicio' => null,
			'IdAplicacion' => $values['IdAplicacion'],
			'IdServicioTipo' => $values['IdServicioTipo'],
			'IdEstatus' => $values['IdEstatus'],
			'Agendado' => $values['Agendado'],
			'FechaAgendado' => $values['FechaAgendado'],
			'IdUsuario' => $values['IdUsuario'],
			'IdAveria' => $values['IdAveria'],
			'AveriaDetalle' => $values['AveriaDetalle'],
			'IdCondicionLugar' => $values['IdCondicionLugar'],
			'CondicionDetalle' => $values['CondicionDetalle'],
			'LatitudOrigen' => $values['LatitudOrigen'],
			'LongitudOrigen' => $values['LongitudOrigen'],
			'IdEstadoOrigen' => $values['IdEstadoOrigen'],
			'DireccionOrigen' => $values['DireccionOrigen'],
			'DireccionOrigenDetallada' => $values['DireccionOrigenDetallada'],
			'LatitudDestino' => $values['LatitudDestino'],
			'LongitudDestino' => $values['LongitudDestino'],
			'IdEstadoDestino' => $values['IdEstadoDestino'],
			'DireccionDestino' => $values['DireccionDestino'],
			'DireccionDestinoDetallada' => $values['DireccionDestinoDetallada'],
			'KM' => $values['KM'],
			'Inicio' => date('Y-m-d h:i:s'),
			'Fin' => null,
			'Observacion' => $values['Observacion'],
			'UltimaActCliente' => date('Y-m-d h:i:s'),
			'UltimaActGruero' => null
		);

		$ConnectionORM = new ConnectionORM();

		$q = $ConnectionORM->getConnect()->Servicios()->insert($array);
		$this->SetIdServicio($ConnectionORM->getConnect()->Servicios()->insert_id());
		return $q;
	}
	function deleteServicios($values){
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Servicios("IdServicio", $values['IdServicio'])->delete();
	}
	function updateServicios($values){


		$array = array();
		if(count($values)>0){
			foreach($values as $key => $val){
				if(strlen($val)>0){
					$array[$key] = $val;
				}
			}
		}
		$ConnectionORM= new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Servicios("IdServicio", $values['IdServicio'])->update($array);
		return $q;

	}
	function getServiciosInfo($values){
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Servicios
		->select("
		Servicios.IdServicio,Servicios.IdEstatus,Servicios.CodigoServicio,Servicios.IdAplicacion,Servicios.IdServicioTipo,
		Servicios.LatitudOrigen,Servicios.LongitudOrigen,Servicios.IdEstadoOrigen,Servicios.DireccionOrigen,Servicios.DireccionOrigenDetallada,
		Servicios.LatitudDestino,Servicios.LongitudDestino,Servicios.IdEstadoDestino,Servicios.DireccionDestino,Servicios.DireccionDestinoDetallada,
		Servicios.Agendado,Servicios.FechaAgendado,Servicios.IdAveria,Servicios.AveriaDetalle,Servicios.IdCondicionLugar,Servicios.CondicionDetalle,Servicios.KM,Servicios.Inicio,Servicios.Fin,Servicios.Inicio,Servicios.Fin,Servicios.Observacion,Servicios.UltimaActCliente,Servicios.UltimaActGruero,
		c.Nombres, c.Apellidos,c.Cedula,c.Placa,c.IdMarca, c.Modelo,c.Color,c.Anio,c.Celular,
		g.IdGrua,g.IdProveedor,g.Nombres as NombresGruero,g.Apellidos as ApellidosGruero,g2.Placa as PlacaGruero,
		g2.IdGruaTipo  as IdGruaTipo,g2.IdMarca  as IdMarcaGruero,g2.Modelo as ModeloGruero,g2.Color as ColorGruero,g2.Anio as AnioGruero,g2.Celular as CelularGruero,g2.Cedula as CedulaGruero,g2.Latitud as LatitudGruero,g2.Longitud as LongitudGruero,
		p.PrecioModificado,p.PrecioSIvaBaremo,p.PrecioCIvaBaremo,p.PrecioSIvaModificado,p.PrecioCIvaModificado,p.IdUsuarioPermiso
		")
		->join("ServiciosClientes","LEFT JOIN ServiciosClientes c on c.IdServicio = Servicios.IdServicio")
		->join("ServiciosPrecios","LEFT JOIN ServiciosPrecios p on p.IdServicio = Servicios.IdServicio")
		->join("ServiciosGruas","LEFT JOIN ServiciosGruas g on g.IdServicio = Servicios.IdServicio")
		->join("Gruas","LEFT JOIN Gruas g2 on g2.IdGrua = g.IdGrua")
		->join("Usuarios","LEFT JOIN Usuarios u on u.IdUsuario = Servicios.IdUsuario")
		->join("Aplicaciones","LEFT JOIN Aplicaciones ap on ap.IdAplicacion = Servicios.IdAplicacion")
		->join("Averias","LEFT JOIN Averias av on av.IdAveria = Servicios.IdAveria")
		->join("CondicionLugar","LEFT JOIN CondicionLugar cl on cl.IdCondicionLugar = Servicios.IdCondicionLugar")
		->join("Estados","LEFT JOIN Estados e on e.IdEstado = Servicios.IdEstadoOrigen")
		->join("Estados","LEFT JOIN Estados e2 on e2.IdEstado = Servicios.IdEstadoDestino")
		->where("Servicios.IdServicio=?",$values['IdServicio'])
		->fetch();
		//echo $q;die;
		return $q;
	}
	public function getList($values)
	{
		/************Datos Servicios******************/
		$columns = array();
		$columns[0] = 'CodigoServicio';
		$columns[1] = 'ap.Nombre';
		$columns[2] = 'st.Nombre';
		$columns[3] = 'e.Nombre';
		$columns[4] = 'Agendado';
		$columns[5] = 'FechaAgendado';
		$columns[6] = 'u.Login';
		$columns[7] = 'a.Nombre';
		$columns[8] = 'AveriaDetalle';
		$columns[9] = 'cl.Nombre';
		$columns[10] = 'CondicionDetalle';
		$columns[11] = 'LatitudOrigen';
		$columns[12] = 'LongitudOrigen';
		$columns[13] = 'e1.Nombre';
		$columns[14] = 'DireccionOrigen';
		$columns[15] = 'DireccionOrigenDetallada';
		$columns[16] = 'LatitudDestino';
		$columns[17] = 'LongitudDestino';
		$columns[18] = 'e2.Nombre';
		$columns[19] = 'DireccionDestino';
		$columns[20] = 'DireccionDestinoDetallada';
		$columns[21] = 'KM';
		$columns[22] = 'Inicio';
		$columns[23] = 'Fin';
		$columns[24] = 'Observacion';
		$columns[25] = 'UltimaActCliente';
		$columns[26] = 'UltimaActGruero';
		/************Datos ServiciosGruas, Proveedores y Gruas*******************/
		$columns[27] = 'p.Identificacion';
		$columns[28] = 'p.Nombres';
		$columns[29] = 'p.Apellidos';
		$columns[30] = 'pt.Nombre';
		$columns[31] = 'g.Placa';
		$columns[32] = 'm.Nombre';
		$columns[33] = 'g.Modelo';
		$columns[34] = 'g.Anio';
		$columns[35] = 'g.Color';
		$columns[36] = 'sg.Nombres';
		$columns[37] = 'sg.Apellidos';
		$columns[38] = 'sg.Cedula';
		$columns[39] = 'sg.Celular';
		$columns[40] = 'sg.TratoCordial';
		$columns[41] = 'sg.Presencia';
		$columns[42] = 'sg.TratoVehiculo';
		$columns[43] = 'sg.Puntual';
		/**********Datos ServiciosClientes****************************/
		$columns[44] = 'sc.Nombres';
		$columns[45] = 'sc.Apellidos';
		$columns[46] = 'sc.Cedula';
		$columns[47] = 'sc.Placa';
		$columns[48] = 'sc.Modelo';
		$columns[49] = 'sc.Color';
		$columns[50] = 'sc.Anio';
		$columns[51] = 'sc.Celular';
		$columns[52] = 'sc.PolizaVencida';
		$columns[53] = 'u2.Login';
		/*****************ServiciosPrecios*************************************/
		$columns[54] = 'sp.PrecioModificado';
		$columns[55] = 'sp.PrecioSIvaBaremo';
		$columns[56] = 'sp.PrecioCIvaBaremo';
		$columns[57] = 'sp.PrecioSIvaModificado';
		$columns[58] = 'sp.PrecioCIvaModificado';
		$columns[59] = 'u3.Login';


		$column_order = $columns[0];
		$where = '1 = 1';
		$order = 'asc';
		$limit = $values['length'];
		$offset = $values['start'];

		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
			$where.=" AND p.IdProveedor = '".$values['IdProveedor']."'";
		}
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(st.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(e.Nombre) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(Agendado) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(Color) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND Anio like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}


		if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
		{
			$column_order = $columns[$values['order'][0]['column']];
		}
		if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
		{
			$order = $values['order'][0]['dir'];//asc o desc
		}
		$ConnectionORM = new ConnectionORM();

		$query = "		SELECT
		Servicios.IdServicio,CodigoServicio,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
		CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, FechaAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
		AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
		DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
		KM, Inicio, Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
		p.Identificacion AS IdentificacionProveedor,pt.Nombre AS NombreProveedorTipo, sg.Nombres AS NombresGruas, sg.Apellidos AS ApellidosGruas,
		sg.Cedula AS CedulaGruas, sg.Celular AS CelularGruas,g.Placa AS PlacaGrua, m.Nombre AS NombreMarcaGruas,g.Modelo AS ModeloGrua, g.Color AS ColorGrua,g.Anio AS AnioGrua,
		sg.Nombres AS NombresGrua,sg.Apellidos AS ApellidosGrua,sg.Cedula AS CedulaGrua,sg.Celular AS CelularGrua,sg.TratoCordial, sg.Presencia,
		sg.TratoVehiculo, sg.Puntual, sc.IdPoliza , m2.Nombre AS NombreMarcaCliente, sc.Nombres AS NombresCliente,sc.Apellidos AS ApellidosCliente,
		sc.Cedula AS CedulaCliente, sc.Placa AS PlacaCliente, sc.Modelo AS ModeloCliente, sc.Color AS ColorCliente, sc.Anio AS AnioCliente,
		sc.Celular AS CelularCliente,
		CASE PolizaVencida WHEN PolizaVencida = 1 THEN 'SI' ELSE 'NO' END AS PolizaVencida, u2.Login AS NombreUsuarioCliente,
		sp.PrecioModificado, sp.PrecioSIvaBaremo, sp.PrecioCIvaBaremo, sp.PrecioSIvaModificado, sp.PrecioSIvaModificado,sp.PrecioCIvaModificado, u3.login AS NombreUsuarioPrecio
		FROM Servicios
		INNER JOIN ServiciosClientes sc ON sc.IdServicio = Servicios.IdServicio
		INNER JOIN Usuarios u ON u.IdUsuario = Servicios.IdUsuario
		LEFT JOIN ServiciosGruas sg ON sg.IdServicio = Servicios.IdServicio
		LEFT JOIN Gruas g ON g.IdGrua = sg.IdGrua
		LEFT JOIN Marcas m ON m.IdMarca = g.IdMarca
		LEFT JOIN GruasTipos gt ON gt.IdGruaTipo = g.IdGruaTipo
		LEFT JOIN Proveedores p ON p.IdProveedor = g.IdProveedor
		LEFT JOIN ProveedoresTipos pt ON pt.IdProveedorTipo = p.IdProveedorTipo
		LEFT JOIN Usuarios u2 ON u2.IdUsuario = sc.IdUsuarioPermiso
		LEFT JOIN Polizas pol ON pol.IdPoliza = sc.IdPoliza
		LEFT JOIN Seguros seg ON seg.IdSeguro = pol.IdSeguro
		LEFT JOIN Marcas m2 ON m2.IdMarca = sc.IdMarca
		LEFT JOIN ServiciosPrecios sp ON sp.IdServicio = Servicios.IdServicio
		LEFT JOIN Usuarios u3 ON u3.IdUsuario = sp.IdUsuarioPermiso
		LEFT JOIN ServiciosTipos st ON st.IdServicioTipo = Servicios.IdServicioTipo
		LEFT JOIN Estatus e ON e.IdEstatus = Servicios.IdEstatus
		LEFT JOIN Estados e1 ON e1.IdEstado = Servicios.IdEstadoOrigen
		LEFT JOIN Estados e2 ON e2.IdEstado = Servicios.IdEstadoDestino
		LEFT JOIN Averias a ON a.IdAveria = Servicios.IdAveria
		INNER JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion

		WHERE $where
		ORDER BY $column_order $order
		LIMIT $limit
		OFFSET $offset";
    $q = $ConnectionORM->ejecutarPreparado($query);
		return $q;
	}
	public function getCountList($values)
	{
		$where = '1 = 1';
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
			$where.=" AND p.IdProveedor = '".$values['IdProveedor']."'";
		}
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(Placa) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(gt.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(m.Nombre) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(Modelo) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(Color) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND Anio like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}
		$ConnectionORM = new ConnectionORM();
		$query = "SELECT count(*) as cuenta
		FROM Servicios
		INNER JOIN Usuarios u ON u.IdUsuario = Servicios.IdUsuario
		LEFT JOIN ServiciosGruas sg ON sg.IdServicio = Servicios.IdServicio
		INNER JOIN Gruas g ON g.IdGrua = sg.IdGrua
		INNER JOIN Marcas m ON m.IdMarca = g.IdMarca
		INNER JOIN GruasTipos gt ON gt.IdGruaTipo = g.IdGruaTipo
		INNER JOIN Proveedores p ON p.IdProveedor = g.IdProveedor
		INNER JOIN ProveedoresTipos pt ON pt.IdProveedorTipo = p.IdProveedorTipo
		INNER JOIN ServiciosClientes sc ON sc.IdServicio = Servicios.IdServicio
		LEFT JOIN Usuarios u2 ON u2.IdUsuario = sc.IdUsuarioPermiso
		LEFT JOIN Polizas pol ON pol.IdPoliza = sc.IdPoliza
		LEFT JOIN Seguros seg ON seg.IdSeguro = pol.IdSeguro
		LEFT JOIN Marcas m2 ON m2.IdMarca = sc.IdMarca
		LEFT JOIN ServiciosPrecios sp ON sp.IdServicio = Servicios.IdServicio
		LEFT JOIN Usuarios u3 ON u3.IdUsuario = sp.IdUsuarioPermiso
		LEFT JOIN ServiciosTipos st ON st.IdServicioTipo = Servicios.IdServicioTipo
		LEFT JOIN Estatus e ON e.IdEstatus = Servicios.IdEstatus

		LEFT JOIN Estados e1 ON e1.IdEstado = Servicios.IdEstadoOrigen
		LEFT JOIN Estados e2 ON e2.IdEstado = Servicios.IdEstadoDestino
		LEFT JOIN Averias a ON a.IdAveria = Servicios.IdAveria
		INNER JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		";
		$q = $ConnectionORM->ejecutarPreparado($query);
		$q = $q->fetch();
		return $q['cuenta'];
	}
}
