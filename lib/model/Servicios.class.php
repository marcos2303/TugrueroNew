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

	public function getList($values)
	{
		/************Datos Servicios******************/
		$columns = array();
		$columns[0] = "SUBSTRING_INDEX(SUBSTRING_INDEX(CodigoServicio, '-', 2), '-', -1) ";
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
		$columns[43] = 'sg.ServicioGeneral';
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
        if($limit == ""){
            $limit = 100;
        }
        if($offset == ""){
            $offset = 0;
        }
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
      $where.=" AND sg.IdProveedor = ".$values['IdProveedor']."";
    }
    if(isset($values['IdGrua']) and $values['IdGrua']!=''){
      $where.=" AND sg.IdGrua = ".$values['IdGrua']."";
    }
		if(isset($values['Placa']) and $values['Placa']!=''){
      $where.=" AND sc.Placa = '".$values['Placa']."'";
    }
		if(isset($values['Cedula']) and $values['Cedula']!=''){
      $where.=" AND sc.Cedula = '".$values['Cedula']."'";
    }
    if(isset($values['filtro_status']) and $values['filtro_status']!=''){
        $where.=" AND Servicios.IdEstatus <> 1";
    }
		if(isset($values['filtro_administracion']) and $values['filtro_administracion']=='1'){
        $where.=" AND Servicios.IdEstatus in(6,7,8,9)";
    }
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(ap.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(st.Nombre) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(e.Nombre) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(Agendado) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND upper(FechaAgendado) like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}
		if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
		{
			$where.=" AND upper(u.Login) like ('%".strtoupper($values['columns'][6]['search']['value'])."%')";
		}
		if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
		{
			$where.=" AND upper(a.Nombre) like ('%".strtoupper($values['columns'][7]['search']['value'])."%')";
		}
		if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
		{
			$where.=" AND upper(AveriaDetalle) like ('%".strtoupper($values['columns'][8]['search']['value'])."%')";
		}
		if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
		{
			$where.=" AND upper(cl.Nombre) like ('%".strtoupper($values['columns'][9]['search']['value'])."%')";
		}
		if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
		{
			$where.=" AND upper(CondicionDetalle) like ('%".strtoupper($values['columns'][10]['search']['value'])."%')";
		}
		if(isset($values['columns'][11]['search']['value']) and $values['columns'][11]['search']['value']!='')
		{
			$where.=" AND upper(LatitudOrigen) like ('%".strtoupper($values['columns'][11]['search']['value'])."%')";
		}
		if(isset($values['columns'][12]['search']['value']) and $values['columns'][12]['search']['value']!='')
		{
			$where.=" AND upper(LongitudOrigen) like ('%".strtoupper($values['columns'][12]['search']['value'])."%')";
		}
		if(isset($values['columns'][13]['search']['value']) and $values['columns'][13]['search']['value']!='')
		{
			$where.=" AND upper(e1.Nombre) like ('%".strtoupper($values['columns'][13]['search']['value'])."%')";
		}
		if(isset($values['columns'][14]['search']['value']) and $values['columns'][14]['search']['value']!='')
		{
			$where.=" AND upper(DireccionOrigen) like ('%".strtoupper($values['columns'][14]['search']['value'])."%')";
		}
		if(isset($values['columns'][15]['search']['value']) and $values['columns'][15]['search']['value']!='')
		{
			$where.=" AND upper(DireccionOrigenDetallada) like ('%".strtoupper($values['columns'][15]['search']['value'])."%')";
		}
		if(isset($values['columns'][16]['search']['value']) and $values['columns'][16]['search']['value']!='')
		{
			$where.=" AND upper(LatitudDestino) like ('%".strtoupper($values['columns'][16]['search']['value'])."%')";
		}
		if(isset($values['columns'][17]['search']['value']) and $values['columns'][17]['search']['value']!='')
		{
			$where.=" AND upper(LongitudDestino) like ('%".strtoupper($values['columns'][17]['search']['value'])."%')";
		}
		if(isset($values['columns'][18]['search']['value']) and $values['columns'][18]['search']['value']!='')
		{
			$where.=" AND upper(e2.Nombre) like ('%".strtoupper($values['columns'][18]['search']['value'])."%')";
		}
		if(isset($values['columns'][19]['search']['value']) and $values['columns'][19]['search']['value']!='')
		{
			$where.=" AND upper(DireccionDestino) like ('%".strtoupper($values['columns'][19]['search']['value'])."%')";
		}
		if(isset($values['columns'][20]['search']['value']) and $values['columns'][20]['search']['value']!='')
		{
			$where.=" AND upper(DireccionDestinoDetallada) like ('%".strtoupper($values['columns'][20]['search']['value'])."%')";
		}
		if(isset($values['columns'][21]['search']['value']) and $values['columns'][21]['search']['value']!='')
		{
			$where.=" AND upper(KM) like ('%".strtoupper($values['columns'][21]['search']['value'])."%')";
		}
		if(isset($values['columns'][22]['search']['value']) and $values['columns'][22]['search']['value']!='')
		{
			$where.=" AND upper(Inicio) like ('%".strtoupper($values['columns'][22]['search']['value'])."%')";
		}
		if(isset($values['columns'][23]['search']['value']) and $values['columns'][23]['search']['value']!='')
		{
			$where.=" AND Fin like ('%".strtoupper($values['columns'][23]['search']['value'])."%')";
		}
		if(isset($values['columns'][24]['search']['value']) and $values['columns'][24]['search']['value']!='')
		{
			$where.=" AND upper(Observacion) like ('%".strtoupper($values['columns'][24]['search']['value'])."%')";
		}
		if(isset($values['columns'][25]['search']['value']) and $values['columns'][25]['search']['value']!='')
		{
			$where.=" AND upper(UltimaActCliente) like ('%".strtoupper($values['columns'][25]['search']['value'])."%')";
		}
		if(isset($values['columns'][26]['search']['value']) and $values['columns'][26]['search']['value']!='')
		{
			$where.=" AND upper(UltimaActGruero) like ('%".strtoupper($values['columns'][26]['search']['value'])."%')";
		}
		if(isset($values['columns'][27]['search']['value']) and $values['columns'][27]['search']['value']!='')
		{
			$where.=" AND upper(p.Identificacion) like ('%".strtoupper($values['columns'][27]['search']['value'])."%')";
		}
		if(isset($values['columns'][28]['search']['value']) and $values['columns'][28]['search']['value']!='')
		{
			$where.=" AND upper(p.Nombres) like ('%".strtoupper($values['columns'][28]['search']['value'])."%')";
		}
		if(isset($values['columns'][29]['search']['value']) and $values['columns'][29]['search']['value']!='')
		{
			$where.=" AND upper(p.Apellidos) like ('%".strtoupper($values['columns'][29]['search']['value'])."%')";
		}
		if(isset($values['columns'][30]['search']['value']) and $values['columns'][30]['search']['value']!='')
		{
			$where.=" AND upper(pt.Nombre) like ('%".strtoupper($values['columns'][30]['search']['value'])."%')";
		}
		if(isset($values['columns'][31]['search']['value']) and $values['columns'][31]['search']['value']!='')
		{
			$where.=" AND upper(g.Placa) like ('%".strtoupper($values['columns'][31]['search']['value'])."%')";
		}
		if(isset($values['columns'][32]['search']['value']) and $values['columns'][32]['search']['value']!='')
		{
			$where.=" AND upper(m.Nombre) like ('%".strtoupper($values['columns'][32]['search']['value'])."%')";
		}
		if(isset($values['columns'][33]['search']['value']) and $values['columns'][33]['search']['value']!='')
		{
			$where.=" AND upper(g.Modelo) like ('%".strtoupper($values['columns'][33]['search']['value'])."%')";
		}
		if(isset($values['columns'][34]['search']['value']) and $values['columns'][34]['search']['value']!='')
		{
			$where.=" AND upper(g.Anio) like ('%".strtoupper($values['columns'][34]['search']['value'])."%')";
		}
		if(isset($values['columns'][35]['search']['value']) and $values['columns'][35]['search']['value']!='')
		{
			$where.=" AND upper(g.Color) like ('%".strtoupper($values['columns'][35]['search']['value'])."%')";
		}
		if(isset($values['columns'][36]['search']['value']) and $values['columns'][36]['search']['value']!='')
		{
			$where.=" AND upper(sg.Nombres) like ('%".strtoupper($values['columns'][36]['search']['value'])."%')";
		}
		if(isset($values['columns'][37]['search']['value']) and $values['columns'][37]['search']['value']!='')
		{
			$where.=" AND upper(sg.Apellidos) like ('%".strtoupper($values['columns'][37]['search']['value'])."%')";
		}
		if(isset($values['columns'][38]['search']['value']) and $values['columns'][38]['search']['value']!='')
		{
			$where.=" AND upper(sg.Cedula) like ('%".strtoupper($values['columns'][38]['search']['value'])."%')";
		}
		if(isset($values['columns'][39]['search']['value']) and $values['columns'][39]['search']['value']!='')
		{
			$where.=" AND upper(sg.Celular) like ('%".strtoupper($values['columns'][39]['search']['value'])."%')";
		}
		if(isset($values['columns'][40]['search']['value']) and $values['columns'][40]['search']['value']!='')
		{
			$where.=" AND upper(sg.TratoCordial) like ('%".strtoupper($values['columns'][40]['search']['value'])."%')";
		}
		if(isset($values['columns'][41]['search']['value']) and $values['columns'][41]['search']['value']!='')
		{
			$where.=" AND upper(sg.Presencia) like ('%".strtoupper($values['columns'][41]['search']['value'])."%')";
		}
		if(isset($values['columns'][42]['search']['value']) and $values['columns'][42]['search']['value']!='')
		{
			$where.=" AND upper(sg.TratoVehiculo) like ('%".strtoupper($values['columns'][42]['search']['value'])."%')";
		}
		if(isset($values['columns'][43]['search']['value']) and $values['columns'][43]['search']['value']!='')
		{
			$where.=" AND upper(sg.ServicioGeneral) like ('%".strtoupper($values['columns'][43]['search']['value'])."%')";
		}
		if(isset($values['columns'][44]['search']['value']) and $values['columns'][44]['search']['value']!='')
		{
			$where.=" AND upper(sc.Nombres) like ('%".strtoupper($values['columns'][44]['search']['value'])."%')";
		}
		if(isset($values['columns'][45]['search']['value']) and $values['columns'][45]['search']['value']!='')
		{
			$where.=" AND upper(sc.Apellidos) like ('%".strtoupper($values['columns'][45]['search']['value'])."%')";
		}
		if(isset($values['columns'][46]['search']['value']) and $values['columns'][46]['search']['value']!='')
		{
			$where.=" AND upper(sc.Cedula) like ('%".strtoupper($values['columns'][46]['search']['value'])."%')";
		}
		if(isset($values['columns'][47]['search']['value']) and $values['columns'][47]['search']['value']!='')
		{
			$where.=" AND upper(sc.Placa) like ('%".strtoupper($values['columns'][47]['search']['value'])."%')";
		}
		if(isset($values['columns'][48]['search']['value']) and $values['columns'][48]['search']['value']!='')
		{
			$where.=" AND UPPER(sc.Modelo) like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}
		if(isset($values['columns'][49]['search']['value']) and $values['columns'][49]['search']['value']!='')
		{
			$where.=" AND upper(sc.Color) like ('%".strtoupper($values['columns'][49]['search']['value'])."%')";
		}
		if(isset($values['columns'][50]['search']['value']) and $values['columns'][50]['search']['value']!='')
		{
			$where.=" AND upper(sc.Anio) like ('%".strtoupper($values['columns'][50]['search']['value'])."%')";
		}
		if(isset($values['columns'][51]['search']['value']) and $values['columns'][51]['search']['value']!='')
		{
			$where.=" AND upper(sc.Celular) like ('%".strtoupper($values['columns'][51]['search']['value'])."%')";
		}
		if(isset($values['columns'][52]['search']['value']) and $values['columns'][52]['search']['value']!='')
		{
			$where.=" AND upper(sc.PolizaVencida) like ('%".strtoupper($values['columns'][52]['search']['value'])."%')";
		}
		if(isset($values['columns'][53]['search']['value']) and $values['columns'][53]['search']['value']!='')
		{
			$where.=" AND upper(u2.Login) like ('%".strtoupper($values['columns'][53]['search']['value'])."%')";
		}
		if(isset($values['columns'][54]['search']['value']) and $values['columns'][54]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioSIvaBaremo) like ('%".strtoupper($values['columns'][54]['search']['value'])."%')";
		}
		if(isset($values['columns'][55]['search']['value']) and $values['columns'][55]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioSIvaBaremo) like ('%".strtoupper($values['columns'][55]['search']['value'])."%')";
		}
		if(isset($values['columns'][56]['search']['value']) and $values['columns'][56]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioCIvaBaremo) like ('%".strtoupper($values['columns'][56]['search']['value'])."%')";
		}
		if(isset($values['columns'][57]['search']['value']) and $values['columns'][57]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioSIvaModificado) like ('%".strtoupper($values['columns'][57]['search']['value'])."%')";
		}
		if(isset($values['columns'][58]['search']['value']) and $values['columns'][58]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioCIvaModificado) like ('%".strtoupper($values['columns'][58]['search']['value'])."%')";
		}
		if(isset($values['columns'][59]['search']['value']) and $values['columns'][59]['search']['value']!='')
		{
			$where.=" AND upper(u3.Login) like ('%".strtoupper($values['columns'][59]['search']['value'])."%')";
		}
		if(isset($values['columns'][60]['search']['value']) and $values['columns'][60]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][60]['search']['value'])."%')";
		}
		/*****************************ORDER**************************************************************************/
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
		Servicios.IdServicio,CodigoServicio,Servicios.IdServicioTipo,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
		CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, FechaAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
		AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
		DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
		KM, DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i:%s') as Inicio, DATE_FORMAT(Fin, '%d/%m/%Y %H:%i:%s') as Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
		p.Identificacion AS IdentificacionProveedor,pt.Nombre AS NombreProveedorTipo, sg.Nombres AS NombresGruas, sg.Apellidos AS ApellidosGruas,
		sg.Cedula AS CedulaGruas, sg.Celular AS CelularGruas,g.Placa AS PlacaGrua, m.Nombre AS NombreMarcaGruas,g.Modelo AS ModeloGrua, g.Color AS ColorGrua,g.Anio AS AnioGrua,
		sg.Nombres AS NombresGrua,sg.Apellidos AS ApellidosGrua,sg.Cedula AS CedulaGrua,sg.Celular AS CelularGrua,sg.TratoCordial, sg.Presencia,
		sg.TratoVehiculo, sg.ServicioGeneral, sc.IdPoliza , m2.Nombre AS NombreMarcaCliente, sc.Nombres AS NombresCliente,sc.Apellidos AS ApellidosCliente,
		sc.Cedula AS CedulaCliente, sc.Placa AS PlacaCliente, sc.Modelo AS ModeloCliente, sc.Color AS ColorCliente, sc.Anio AS AnioCliente,
		sc.Celular AS CelularCliente,
		CASE PolizaVencida WHEN PolizaVencida = 1 THEN 'SI' ELSE 'NO' END AS PolizaVencida, u2.Login AS NombreUsuarioCliente,
		sp.PrecioSIvaBaremo,sp.IvaBaremo, sp.PrecioCIvaBaremo, sp.PrecioSIvaBaremoModificado, sp.IvaBaremoModificado, sp.PrecioCIvaBaremoModificado, sp.PrecioClienteSIva,
		sp.IvaCliente, sp.PrecioClienteCIva, sp.PrecioClienteSIvaModificado, sp.IvaClienteModificado,sp.PrecioClienteCIvaModificado, u3.login AS NombreUsuarioPrecio,
        sp.FechaFacturaDigital, sp.FechaFacturaFisica, sp.FechaEstimadaPago, sp.FacturaPagada, sp.NumeroFactura
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		ORDER BY $column_order $order
		LIMIT $limit
		OFFSET $offset";
        //echo $query;die;
    $q = $ConnectionORM->ejecutarPreparado($query);
		return $q;
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
			'Inicio' => $values['Inicio'],
			'Fin' => null,
			'Observacion' => $values['Observacion'],
			'UltimaActCliente' => date('Y-m-d H:i:s'),
			'UltimaActGruero' => null,
			'Neumaticos' => $values['Neumaticos'],
			'Token' => $values['Token']
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
		Servicios.IdServicio,Servicios.CodigoServicio,Servicios.IdEstatus,Servicios.CodigoServicio,Servicios.IdAplicacion,Servicios.IdServicioTipo,
		Servicios.LatitudOrigen,Servicios.LongitudOrigen,Servicios.IdEstadoOrigen,Servicios.DireccionOrigen,Servicios.DireccionOrigenDetallada,
		Servicios.LatitudDestino,Servicios.LongitudDestino,Servicios.IdEstadoDestino,Servicios.DireccionDestino,Servicios.DireccionDestinoDetallada,Servicios.InfoExtra,
		Servicios.Agendado,Servicios.FechaAgendado,Servicios.IdAveria,Servicios.IdAveriaHijo,Servicios.AveriaDetalle,Servicios.IdCondicionLugar,Servicios.CondicionDetalle,Servicios.KM,
		DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y %H:%i:%s') as Inicio, DATE_FORMAT(Servicios.Fin, '%d/%m/%Y %H:%i:%s') as Fin,Servicios.Inicio,Servicios.Fin,Servicios.Observacion,Servicios.UltimaActCliente,Servicios.UltimaActGruero,
		av.Nombre as AveriaNombre,
		Servicios.Token as ClienteToken,
		c.Nombres, c.Apellidos,c.Cedula,c.Placa,c.IdMarca, c.Modelo,c.Color,c.Anio,c.Celular,c.IdSeguro,c.InfoAdicional,
		g.IdGrua,g.IdProveedor,g.Nombres as NombresGruero,g.Apellidos as ApellidosGruero,g2.Placa as PlacaGruero,g.ServicioGeneral, g.TratoCordial, g.TratoVehiculo, g.Presencia, g.Recomienda,
		g.FechaAsignacion, g.HoraAsignacion, g.TiempoEstimadoEspera, g.FechaEstimadaLlegada, g.HoraEstimadaLlegada,g.HoraTiempoEstimadoEspera,g.MinutosTiempoEstimadoEspera,
		g2.IdGruaTipo  as IdGruaTipo,g2.IdMarca  as IdMarcaGruero,g2.Modelo as ModeloGruero,g2.Color as ColorGruero,g2.Anio as AnioGruero,g.Celular as CelularGruero,g.Cedula as CedulaGruero,g2.Latitud as LatitudGruero,g2.Longitud as LongitudGruero,
		g2.Token as GruaToken,
		p.PrecioSIvaBaremo,p.IvaBaremo, p.PrecioCIvaBaremo, p.PrecioSIvaBaremoModificado, p.IvaBaremoModificado, p.PrecioCIvaBaremoModificado, p.PrecioClienteSIva,
		p.IvaCliente, p.PrecioClienteCIva, p.PrecioClienteSIvaModificado, p.IvaClienteModificado,p.PrecioClienteCIvaModificado, p.IdUsuarioPermiso, p.FechaFacturaDigital, p.FechaFacturaFisica, p.FechaEstimadaPago, p.FacturaPagada,
		p.IdMetodoPago, p.IdBanco,p.Referencia,p.IdTipoPagoElectronico,p.TipoDocumento,p.NumeroDocumento,p.NumeroTarjeta,p.CodigoSeguridad,p.AnioTarjeta,p.TipoTarjeta,p.Link,p.NumeroTarjeta,p.Pagado,p.Negociar
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
		//echo $values['IdServicio']."".$q;die;
		->fetch();
		return $q;
	}
	public function getServiciosActivos($values)
	{
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
		sg.TratoVehiculo, sg.ServicioGeneral, sc.IdPoliza , m2.Nombre AS NombreMarcaCliente, sc.Nombres AS NombresCliente,sc.Apellidos AS ApellidosCliente,
		sc.Cedula AS CedulaCliente, sc.Placa AS PlacaCliente, sc.Modelo AS ModeloCliente, sc.Color AS ColorCliente, sc.Anio AS AnioCliente,
		sc.Celular AS CelularCliente,
		CASE PolizaVencida WHEN PolizaVencida = 1 THEN 'SI' ELSE 'NO' END AS PolizaVencida, u2.Login AS NombreUsuarioCliente,
		sp.PrecioSIvaBaremo,sp.IvaBaremo, sp.PrecioCIvaBaremo, sp.PrecioSIvaBaremoModificado, sp.IvaBaremoModificado, sp.PrecioCIvaBaremoModificado, sp.PrecioClienteSIva,
		sp.IvaCliente, sp.PrecioClienteCIva, sp.PrecioClienteSIvaModificado, sp.IvaClienteModificado,sp.PrecioClienteCIvaModificado, u3.login AS NombreUsuarioPrecio,
        sp.FechaFacturaDigital, sp.FechaFacturaFisica, sp.FechaEstimadaPago, sp.FacturaPagada, sp.NumeroFactura
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion

		WHERE Servicios.IdEstatus in(1,2) and (Agendado = 0  or Agendado is null)
		ORDER BY Inicio";
    $q = $ConnectionORM->ejecutarPreparado($query);
		return $q;
	}
	public function getCountList($values)
	{
		$where = '1 = 1';
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
      $where.=" AND sg.IdProveedor = ".$values['IdProveedor']."";
    }
    if(isset($values['IdGrua']) and $values['IdGrua']!=''){
      $where.=" AND sg.IdGrua = ".$values['IdGrua']."";
    }
		if(isset($values['Placa']) and $values['Placa']!=''){
      $where.=" AND sc.Placa = '".$values['Placa']."'";
    }
		if(isset($values['Cedula']) and $values['Cedula']!=''){
      $where.=" AND sc.Cedula = '".$values['Cedula']."'";
    }
    if(isset($values['filtro_status']) and $values['filtro_status']!=''){
        $where.=" AND Servicios.IdEstatus <> 1";
    }
		if(isset($values['filtro_administracion']) and $values['filtro_administracion']=='1'){
        $where.=" AND Servicios.IdEstatus in(6,7,8,9)";
    }
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(ap.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(st.Nombre) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(e.Nombre) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(Agendado) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND upper(FechaAgendado) like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}
		if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
		{
			$where.=" AND upper(u.Login) like ('%".strtoupper($values['columns'][6]['search']['value'])."%')";
		}
		if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
		{
			$where.=" AND upper(a.Nombre) like ('%".strtoupper($values['columns'][7]['search']['value'])."%')";
		}
		if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
		{
			$where.=" AND upper(AveriaDetalle) like ('%".strtoupper($values['columns'][8]['search']['value'])."%')";
		}
		if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
		{
			$where.=" AND upper(cl.Nombre) like ('%".strtoupper($values['columns'][9]['search']['value'])."%')";
		}
		if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
		{
			$where.=" AND upper(CondicionDetalle) like ('%".strtoupper($values['columns'][10]['search']['value'])."%')";
		}
		if(isset($values['columns'][11]['search']['value']) and $values['columns'][11]['search']['value']!='')
		{
			$where.=" AND upper(LatitudOrigen) like ('%".strtoupper($values['columns'][11]['search']['value'])."%')";
		}
		if(isset($values['columns'][12]['search']['value']) and $values['columns'][12]['search']['value']!='')
		{
			$where.=" AND upper(LongitudOrigen) like ('%".strtoupper($values['columns'][12]['search']['value'])."%')";
		}
		if(isset($values['columns'][13]['search']['value']) and $values['columns'][13]['search']['value']!='')
		{
			$where.=" AND upper(e1.Nombre) like ('%".strtoupper($values['columns'][13]['search']['value'])."%')";
		}
		if(isset($values['columns'][14]['search']['value']) and $values['columns'][14]['search']['value']!='')
		{
			$where.=" AND upper(DireccionOrigen) like ('%".strtoupper($values['columns'][14]['search']['value'])."%')";
		}
		if(isset($values['columns'][15]['search']['value']) and $values['columns'][15]['search']['value']!='')
		{
			$where.=" AND upper(DireccionOrigenDetallada) like ('%".strtoupper($values['columns'][15]['search']['value'])."%')";
		}
		if(isset($values['columns'][16]['search']['value']) and $values['columns'][16]['search']['value']!='')
		{
			$where.=" AND upper(LatitudDestino) like ('%".strtoupper($values['columns'][16]['search']['value'])."%')";
		}
		if(isset($values['columns'][17]['search']['value']) and $values['columns'][17]['search']['value']!='')
		{
			$where.=" AND upper(LongitudDestino) like ('%".strtoupper($values['columns'][17]['search']['value'])."%')";
		}
		if(isset($values['columns'][18]['search']['value']) and $values['columns'][18]['search']['value']!='')
		{
			$where.=" AND upper(e2.Nombre) like ('%".strtoupper($values['columns'][18]['search']['value'])."%')";
		}
		if(isset($values['columns'][19]['search']['value']) and $values['columns'][19]['search']['value']!='')
		{
			$where.=" AND upper(DireccionDestino) like ('%".strtoupper($values['columns'][19]['search']['value'])."%')";
		}
		if(isset($values['columns'][20]['search']['value']) and $values['columns'][20]['search']['value']!='')
		{
			$where.=" AND upper(DireccionDestinoDetallada) like ('%".strtoupper($values['columns'][20]['search']['value'])."%')";
		}
		if(isset($values['columns'][21]['search']['value']) and $values['columns'][21]['search']['value']!='')
		{
			$where.=" AND upper(KM) like ('%".strtoupper($values['columns'][21]['search']['value'])."%')";
		}
		if(isset($values['columns'][22]['search']['value']) and $values['columns'][22]['search']['value']!='')
		{
			$where.=" AND upper(Inicio) like ('%".strtoupper($values['columns'][22]['search']['value'])."%')";
		}
		if(isset($values['columns'][23]['search']['value']) and $values['columns'][23]['search']['value']!='')
		{
			$where.=" AND Fin like ('%".strtoupper($values['columns'][23]['search']['value'])."%')";
		}
		if(isset($values['columns'][24]['search']['value']) and $values['columns'][24]['search']['value']!='')
		{
			$where.=" AND upper(Observacion) like ('%".strtoupper($values['columns'][24]['search']['value'])."%')";
		}
		if(isset($values['columns'][25]['search']['value']) and $values['columns'][25]['search']['value']!='')
		{
			$where.=" AND upper(UltimaActCliente) like ('%".strtoupper($values['columns'][25]['search']['value'])."%')";
		}
		if(isset($values['columns'][26]['search']['value']) and $values['columns'][26]['search']['value']!='')
		{
			$where.=" AND upper(UltimaActGruero) like ('%".strtoupper($values['columns'][26]['search']['value'])."%')";
		}
		if(isset($values['columns'][27]['search']['value']) and $values['columns'][27]['search']['value']!='')
		{
			$where.=" AND upper(p.Identificacion) like ('%".strtoupper($values['columns'][27]['search']['value'])."%')";
		}
		if(isset($values['columns'][28]['search']['value']) and $values['columns'][28]['search']['value']!='')
		{
			$where.=" AND upper(p.Nombres) like ('%".strtoupper($values['columns'][28]['search']['value'])."%')";
		}
		if(isset($values['columns'][29]['search']['value']) and $values['columns'][29]['search']['value']!='')
		{
			$where.=" AND upper(p.Apellidos) like ('%".strtoupper($values['columns'][29]['search']['value'])."%')";
		}
		if(isset($values['columns'][30]['search']['value']) and $values['columns'][30]['search']['value']!='')
		{
			$where.=" AND upper(pt.Nombre) like ('%".strtoupper($values['columns'][30]['search']['value'])."%')";
		}
		if(isset($values['columns'][31]['search']['value']) and $values['columns'][31]['search']['value']!='')
		{
			$where.=" AND upper(g.Placa) like ('%".strtoupper($values['columns'][31]['search']['value'])."%')";
		}
		if(isset($values['columns'][32]['search']['value']) and $values['columns'][32]['search']['value']!='')
		{
			$where.=" AND upper(m.Nombre) like ('%".strtoupper($values['columns'][32]['search']['value'])."%')";
		}
		if(isset($values['columns'][33]['search']['value']) and $values['columns'][33]['search']['value']!='')
		{
			$where.=" AND upper(g.Modelo) like ('%".strtoupper($values['columns'][33]['search']['value'])."%')";
		}
		if(isset($values['columns'][34]['search']['value']) and $values['columns'][34]['search']['value']!='')
		{
			$where.=" AND upper(g.Anio) like ('%".strtoupper($values['columns'][34]['search']['value'])."%')";
		}
		if(isset($values['columns'][35]['search']['value']) and $values['columns'][35]['search']['value']!='')
		{
			$where.=" AND upper(g.Color) like ('%".strtoupper($values['columns'][35]['search']['value'])."%')";
		}
		if(isset($values['columns'][36]['search']['value']) and $values['columns'][36]['search']['value']!='')
		{
			$where.=" AND upper(sg.Nombres) like ('%".strtoupper($values['columns'][36]['search']['value'])."%')";
		}
		if(isset($values['columns'][37]['search']['value']) and $values['columns'][37]['search']['value']!='')
		{
			$where.=" AND upper(sg.Apellidos) like ('%".strtoupper($values['columns'][37]['search']['value'])."%')";
		}
		if(isset($values['columns'][38]['search']['value']) and $values['columns'][38]['search']['value']!='')
		{
			$where.=" AND upper(sg.Cedula) like ('%".strtoupper($values['columns'][38]['search']['value'])."%')";
		}
		if(isset($values['columns'][39]['search']['value']) and $values['columns'][39]['search']['value']!='')
		{
			$where.=" AND upper(sg.Celular) like ('%".strtoupper($values['columns'][39]['search']['value'])."%')";
		}
		if(isset($values['columns'][40]['search']['value']) and $values['columns'][40]['search']['value']!='')
		{
			$where.=" AND upper(sg.TratoCordial) like ('%".strtoupper($values['columns'][40]['search']['value'])."%')";
		}
		if(isset($values['columns'][41]['search']['value']) and $values['columns'][41]['search']['value']!='')
		{
			$where.=" AND upper(sg.Presencia) like ('%".strtoupper($values['columns'][41]['search']['value'])."%')";
		}
		if(isset($values['columns'][42]['search']['value']) and $values['columns'][42]['search']['value']!='')
		{
			$where.=" AND upper(sg.TratoVehiculo) like ('%".strtoupper($values['columns'][42]['search']['value'])."%')";
		}
		if(isset($values['columns'][43]['search']['value']) and $values['columns'][43]['search']['value']!='')
		{
			$where.=" AND upper(sg.ServicioGeneral) like ('%".strtoupper($values['columns'][43]['search']['value'])."%')";
		}
		if(isset($values['columns'][44]['search']['value']) and $values['columns'][44]['search']['value']!='')
		{
			$where.=" AND upper(sc.Nombres) like ('%".strtoupper($values['columns'][44]['search']['value'])."%')";
		}
		if(isset($values['columns'][45]['search']['value']) and $values['columns'][45]['search']['value']!='')
		{
			$where.=" AND upper(sc.Apellidos) like ('%".strtoupper($values['columns'][45]['search']['value'])."%')";
		}
		if(isset($values['columns'][46]['search']['value']) and $values['columns'][46]['search']['value']!='')
		{
			$where.=" AND upper(sc.Cedula) like ('%".strtoupper($values['columns'][46]['search']['value'])."%')";
		}
		if(isset($values['columns'][47]['search']['value']) and $values['columns'][47]['search']['value']!='')
		{
			$where.=" AND upper(sc.Placa) like ('%".strtoupper($values['columns'][47]['search']['value'])."%')";
		}
		if(isset($values['columns'][48]['search']['value']) and $values['columns'][48]['search']['value']!='')
		{
			$where.=" AND UPPER(sc.Modelo) like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}
		if(isset($values['columns'][49]['search']['value']) and $values['columns'][49]['search']['value']!='')
		{
			$where.=" AND upper(sc.Color) like ('%".strtoupper($values['columns'][49]['search']['value'])."%')";
		}
		if(isset($values['columns'][50]['search']['value']) and $values['columns'][50]['search']['value']!='')
		{
			$where.=" AND upper(sc.Anio) like ('%".strtoupper($values['columns'][50]['search']['value'])."%')";
		}
		if(isset($values['columns'][51]['search']['value']) and $values['columns'][51]['search']['value']!='')
		{
			$where.=" AND upper(sc.Celular) like ('%".strtoupper($values['columns'][51]['search']['value'])."%')";
		}
		if(isset($values['columns'][52]['search']['value']) and $values['columns'][52]['search']['value']!='')
		{
			$where.=" AND upper(sc.PolizaVencida) like ('%".strtoupper($values['columns'][52]['search']['value'])."%')";
		}
		if(isset($values['columns'][53]['search']['value']) and $values['columns'][53]['search']['value']!='')
		{
			$where.=" AND upper(u2.Login) like ('%".strtoupper($values['columns'][53]['search']['value'])."%')";
		}
		if(isset($values['columns'][54]['search']['value']) and $values['columns'][54]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioModificado) like ('%".strtoupper($values['columns'][54]['search']['value'])."%')";
		}
		if(isset($values['columns'][55]['search']['value']) and $values['columns'][55]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioSIvaBaremo) like ('%".strtoupper($values['columns'][55]['search']['value'])."%')";
		}
		if(isset($values['columns'][56]['search']['value']) and $values['columns'][56]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioCIvaBaremo) like ('%".strtoupper($values['columns'][56]['search']['value'])."%')";
		}
		if(isset($values['columns'][57]['search']['value']) and $values['columns'][57]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioSIvaModificado) like ('%".strtoupper($values['columns'][57]['search']['value'])."%')";
		}
		if(isset($values['columns'][58]['search']['value']) and $values['columns'][58]['search']['value']!='')
		{
			$where.=" AND upper(sp.PrecioCIvaModificado) like ('%".strtoupper($values['columns'][58]['search']['value'])."%')";
		}
		if(isset($values['columns'][59]['search']['value']) and $values['columns'][59]['search']['value']!='')
		{
			$where.=" AND upper(u3.Login) like ('%".strtoupper($values['columns'][59]['search']['value'])."%')";
		}
		if(isset($values['columns'][60]['search']['value']) and $values['columns'][60]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][60]['search']['value'])."%')";
		}
		$ConnectionORM = new ConnectionORM();
		$query = "SELECT count(*) as cuenta
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		";
		$q = $ConnectionORM->ejecutarPreparado($query);
		$q = $q->fetch();
		return $q['cuenta'];
	}
	public function getServiciosDetalle($values){

		$IdServicio = $values['IdServicio'];
		$ConnectionORM = new ConnectionORM();
		$query = "		SELECT
		Servicios.IdServicio,CodigoServicio,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,Servicios.InfoExtra,
		CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, DATE_FORMAT(FechaAgendado, '%d/%m/%Y') as FechaAgendado,Servicios.HoraAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
		AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
		DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
		KM, DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i') as Inicio, Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
		p.Identificacion AS IdentificacionProveedor,pt.Nombre AS NombreProveedorTipo, sg.Nombres AS NombresGruas, sg.Apellidos AS ApellidosGruas,
		sg.Cedula AS CedulaGruas, sg.Celular AS CelularGruas,g.Placa AS PlacaGrua, m.Nombre AS NombreMarcaGruas,g.Modelo AS ModeloGrua, g.Color AS ColorGrua,g.Anio AS AnioGrua,
		sg.Nombres AS NombresGrua,sg.Apellidos AS ApellidosGrua,sg.Cedula AS CedulaGrua,sg.Celular AS CelularGrua,sg.TratoCordial, sg.Presencia,Recomienda,
		sg.TratoVehiculo, sg.ServicioGeneral, sc.IdPoliza , m2.Nombre AS NombreMarcaCliente, sc.Nombres AS NombresCliente,sc.Apellidos AS ApellidosCliente,seg.Nombre AS NombreSeguro,
		sc.Cedula AS CedulaCliente, sc.Placa AS PlacaCliente, sc.Modelo AS ModeloCliente, sc.Color AS ColorCliente, sc.Anio AS AnioCliente,
		sc.Celular AS CelularCliente,sc.InfoAdicional,
		CASE PolizaVencida WHEN PolizaVencida = 1 THEN 'SI' ELSE 'NO' END AS PolizaVencida, u2.Login AS NombreUsuarioCliente,
		sp.PrecioSIvaBaremo,sp.IvaBaremo, sp.PrecioCIvaBaremo, sp.PrecioSIvaBaremoModificado, sp.IvaBaremoModificado, sp.PrecioCIvaBaremoModificado, sp.PrecioClienteSIva,
		sp.IvaCliente, sp.PrecioClienteCIva, sp.PrecioClienteSIvaModificado, sp.IvaClienteModificado,sp.PrecioClienteCIvaModificado,
		sp.Referencia, sp.TipoDocumento, sp.NumeroDocumento, sp.NumeroTarjeta, sp.NombreTarjeta, sp.CodigoSeguridad, sp.AnioTarjeta, sp.Mestarjeta, sp.TipoTarjeta, sp.Link,
		mp.Nombre AS NombreMetodoPago, tpe.Nombre AS NombreTipoPagoElectronico,b.Nombre AS NombreBanco
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		LEFT JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		LEFT JOIN MetodosPago mp ON mp.IdMetodoPago = sp.IdMetodoPago
		LEFT JOIN TiposPagosElectronicos tpe ON tpe.idTipoPagoElectronico = sp.idTipoPagoElectronico
		LEFT JOIN Bancos b ON b.IdBanco = sp.IdBanco
		WHERE Servicios.IdServicio = $IdServicio";
		$q = $ConnectionORM->ejecutarPreparado($query);
		//echo $query;die;
		$q = $q->fetch();
		return $q;

	}
	public function enviarServicio($values){
		$Push = new Push();
		$Gruas = new Gruas();
		$tokens = array();
		$resultado_envio = array();
			$gruas_disponibles = $Gruas->getGruasServicio($values, 0.10);
			foreach ($gruas_disponibles as $grua) {
				$tokens[] = $grua["Token"];

			}
			$resultado_envio = $Push->sendPushFirebase( $values,$tokens,$values["notification"] );
			return $resultado_envio;
	}
	public function getServiciosUsuarioLastDay(){
		$IdUsuario = $_SESSION["IdUsuario"];

		$ConnectionORM = new ConnectionORM();
		$query = "SELECT * FROM (
									(SELECT COUNT(*) AS last3Days FROM Servicios WHERE Inicio >= DATE_ADD(CURDATE(), INTERVAL -3 DAY) AND IdUsuario = $IdUsuario) AS last3Days ,
									(SELECT COUNT(*) AS last15Days FROM Servicios WHERE Inicio >= DATE_ADD(CURDATE(), INTERVAL -15 DAY) AND IdUsuario = $IdUsuario) AS last15Days,
									(SELECT COUNT(*) AS last45Days FROM Servicios WHERE Inicio >= DATE_ADD(CURDATE(), INTERVAL -45 DAY) AND IdUsuario = $IdUsuario) AS last45Days
									)";
		$q = $ConnectionORM->ejecutarPreparado($query);
		$q = $q->fetch();
		return $q;
	}
	public function getListAdministracion($values)
	{

		/************Datos Servicios******************/
		$columns = array();
		$columns[0] = "SUBSTRING_INDEX(SUBSTRING_INDEX(CodigoServicio, '-', 2), '-', -1) ";
		$columns[1] = 'p.Identificacion';
		$columns[2] = "CONCAT(p.Nombres, ' ' ,p.Apellidos )";
		$columns[3] = 'st.Nombre';
		$columns[4] = 'sp.NumeroFactura';
		$columns[5] = 'sp.FechaFacturaDigital';
		$columns[6] = 'sp.FechaFacturaFisica';
		$columns[7] = 'sp.FechaEstimadaPago';
		$columns[8] = 'sp.FacturaPagada';
		$column_order = $columns[0];
		$where = '1 = 1';
		$order = 'asc';
		$limit = $values['length'];
		$offset = $values['start'];
        if($limit == ""){
            $limit = 100;
        }
        if($offset == ""){
            $offset = 0;
        }
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
      $where.=" AND sg.IdProveedor = ".$values['IdProveedor']."";
    }
    if(isset($values['IdGrua']) and $values['IdGrua']!=''){
      $where.=" AND sg.IdGrua = ".$values['IdGrua']."";
    }
		if(isset($values['Placa']) and $values['Placa']!=''){
      $where.=" AND sc.Placa = '".$values['Placa']."'";
    }
		if(isset($values['Cedula']) and $values['Cedula']!=''){
      $where.=" AND sc.Cedula = '".$values['Cedula']."'";
    }
    if(isset($values['filtro_status']) and $values['filtro_status']!=''){
        $where.=" AND Servicios.IdEstatus <> 1";
    }
		if(isset($values['filtro_administracion']) and $values['filtro_administracion']=='1'){
        $where.=" AND Servicios.IdEstatus in(6,7,8,9)";
    }
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(p.Identificacion) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(CONCAT(p.Nombres, ' ' ,p.Apellidos )) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(st.Nombre) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(sp.NumeroFactura) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(sp.FechaFacturaDigital, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][5]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(sp.FechaFacturaFisica, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][6]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(sp.FechaEstimadaPago, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][7]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
		{
			$where.=" AND sp.FacturaPagada = '".$values['columns'][8]['search']['value']."'";
		}
		/*****************************ORDER**************************************************************************/
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
		Servicios.IdServicio,CodigoServicio,Servicios.IdServicioTipo,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
		CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, FechaAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
		AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
		DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
		KM, DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i:%s') as Inicio, DATE_FORMAT(Fin, '%d/%m/%Y %H:%i:%s') as Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
		p.Identificacion AS IdentificacionProveedor,pt.Nombre AS NombreProveedorTipo, sg.Nombres AS NombresGruas, sg.Apellidos AS ApellidosGruas,
		CONCAT(p.Nombres, ' ' ,p.Apellidos ) AS NombreProveedor,
		sg.Cedula AS CedulaGruas, sg.Celular AS CelularGruas,g.Placa AS PlacaGrua, m.Nombre AS NombreMarcaGruas,g.Modelo AS ModeloGrua, g.Color AS ColorGrua,g.Anio AS AnioGrua,
		sg.Nombres AS NombresGrua,sg.Apellidos AS ApellidosGrua,sg.Cedula AS CedulaGrua,sg.Celular AS CelularGrua,sg.TratoCordial, sg.Presencia,
		sg.TratoVehiculo, sg.ServicioGeneral, sc.IdPoliza , m2.Nombre AS NombreMarcaCliente, sc.Nombres AS NombresCliente,sc.Apellidos AS ApellidosCliente,
		sc.Cedula AS CedulaCliente, sc.Placa AS PlacaCliente, sc.Modelo AS ModeloCliente, sc.Color AS ColorCliente, sc.Anio AS AnioCliente,
		sc.Celular AS CelularCliente,
		CASE PolizaVencida WHEN PolizaVencida = 1 THEN 'SI' ELSE 'NO' END AS PolizaVencida, u2.Login AS NombreUsuarioCliente,
		sp.PrecioSIvaBaremo,sp.IvaBaremo, sp.PrecioCIvaBaremo, sp.PrecioSIvaBaremoModificado, sp.IvaBaremoModificado, sp.PrecioCIvaBaremoModificado, sp.PrecioClienteSIva,
		sp.IvaCliente, sp.PrecioClienteCIva, sp.PrecioClienteSIvaModificado, sp.IvaClienteModificado,sp.PrecioClienteCIvaModificado, u3.login AS NombreUsuarioPrecio,
        sp.FechaFacturaDigital, sp.FechaFacturaFisica, sp.FechaEstimadaPago, sp.FacturaPagada, sp.NumeroFactura
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		ORDER BY $column_order $order
		LIMIT $limit
		OFFSET $offset";
    $q = $ConnectionORM->ejecutarPreparado($query);
		return $q;
	}
	public function getCountListAdministracion($values)
	{
		$where = '1 = 1';
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
      $where.=" AND sg.IdProveedor = ".$values['IdProveedor']."";
    }
    if(isset($values['IdGrua']) and $values['IdGrua']!=''){
      $where.=" AND sg.IdGrua = ".$values['IdGrua']."";
    }
		if(isset($values['Placa']) and $values['Placa']!=''){
      $where.=" AND sc.Placa = '".$values['Placa']."'";
    }
		if(isset($values['Cedula']) and $values['Cedula']!=''){
      $where.=" AND sc.Cedula = '".$values['Cedula']."'";
    }
    if(isset($values['filtro_status']) and $values['filtro_status']!=''){
        $where.=" AND Servicios.IdEstatus <> 1";
    }
		if(isset($values['filtro_administracion']) and $values['filtro_administracion']=='1'){
        $where.=" AND Servicios.IdEstatus in(6,7,8,9)";
    }
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(CodigoServicio) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(p.Identificacion) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(CONCAT(p.Nombres, ' ' ,p.Apellidos )) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(st.Nombre) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(sp.NumeroFactura) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(sp.FechaFacturaDigital, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][5]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(sp.FechaFacturaFisica, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][6]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(sp.FechaEstimadaPago, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][7]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
		{
			$where.=" AND sp.FacturaPagada = '".$values['columns'][8]['search']['value']."'";
		}
		$ConnectionORM = new ConnectionORM();
		$query = "SELECT count(*) as cuenta
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		";
		//echo $query;die;
		$q = $ConnectionORM->ejecutarPreparado($query);
		$q = $q->fetch();
		return $q['cuenta'];
	}
	public function getListServiciosGrua($values)
	{
		/************Datos Servicios******************/
		$columns = array();
		$columns[0] = "SUBSTRING_INDEX(SUBSTRING_INDEX(CodigoServicio, '-', 2), '-', -1) ";
		$columns[1] = 'ap.Nombre';
		$columns[2] = 'st.Nombre';
		$columns[3] = 'e.Nombre';
		$columns[4] = 'Servicios.Inicio';
		$columns[5] = 'Servicios.Fin';
		$column_order = $columns[0];
		$where = '1 = 1';
		$order = 'asc';
		$limit = $values['length'];
		$offset = $values['start'];
				if($limit == ""){
						$limit = 100;
				}
				if($offset == ""){
						$offset = 0;
				}
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
			$where.=" AND sg.IdProveedor = ".$values['IdProveedor']."";
		}
		if(isset($values['IdGrua']) and $values['IdGrua']!=''){
			$where.=" AND sg.IdGrua = ".$values['IdGrua']."";
		}
		if(isset($values['Placa']) and $values['Placa']!=''){
			$where.=" AND sc.Placa = '".$values['Placa']."'";
		}
		if(isset($values['Cedula']) and $values['Cedula']!=''){
			$where.=" AND sc.Cedula = '".$values['Cedula']."'";
		}
		if(isset($values['filtro_status']) and $values['filtro_status']!=''){
				$where.=" AND Servicios.IdEstatus <> 1";
		}
		if(isset($values['filtro_administracion']) and $values['filtro_administracion']=='1'){
				$where.=" AND Servicios.IdEstatus in(6,7,8,9)";
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
			$where.=" AND DATE_FORMAT(Servicios.Inicio, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][3]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(Servicios.Fin, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][4]['search']['value']."', '%d-%m-%Y')";
		}
		/*****************************ORDER**************************************************************************/
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
		Servicios.IdServicio,CodigoServicio,Servicios.IdServicioTipo,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
		CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, FechaAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
		AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
		DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
		KM, DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i:%s') as Inicio, DATE_FORMAT(Fin, '%d/%m/%Y %H:%i:%s') as Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
		p.Identificacion AS IdentificacionProveedor,pt.Nombre AS NombreProveedorTipo, sg.Nombres AS NombresGruas, sg.Apellidos AS ApellidosGruas,
		sg.Cedula AS CedulaGruas, sg.Celular AS CelularGruas,g.Placa AS PlacaGrua, m.Nombre AS NombreMarcaGruas,g.Modelo AS ModeloGrua, g.Color AS ColorGrua,g.Anio AS AnioGrua,
		sg.Nombres AS NombresGrua,sg.Apellidos AS ApellidosGrua,sg.Cedula AS CedulaGrua,sg.Celular AS CelularGrua,sg.TratoCordial, sg.Presencia,
		sg.TratoVehiculo, sg.ServicioGeneral, sc.IdPoliza , m2.Nombre AS NombreMarcaCliente, sc.Nombres AS NombresCliente,sc.Apellidos AS ApellidosCliente,
		sc.Cedula AS CedulaCliente, sc.Placa AS PlacaCliente, sc.Modelo AS ModeloCliente, sc.Color AS ColorCliente, sc.Anio AS AnioCliente,
		sc.Celular AS CelularCliente,
		CASE PolizaVencida WHEN PolizaVencida = 1 THEN 'SI' ELSE 'NO' END AS PolizaVencida, u2.Login AS NombreUsuarioCliente,
		sp.PrecioSIvaBaremo,sp.IvaBaremo, sp.PrecioCIvaBaremo, sp.PrecioSIvaBaremoModificado, sp.IvaBaremoModificado, sp.PrecioCIvaBaremoModificado, sp.PrecioClienteSIva,
		sp.IvaCliente, sp.PrecioClienteCIva, sp.PrecioClienteSIvaModificado, sp.IvaClienteModificado,sp.PrecioClienteCIvaModificado, u3.login AS NombreUsuarioPrecio,
				sp.FechaFacturaDigital, sp.FechaFacturaFisica, sp.FechaEstimadaPago, sp.FacturaPagada, sp.NumeroFactura
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		ORDER BY $column_order $order
		LIMIT $limit
		OFFSET $offset";
		$q = $ConnectionORM->ejecutarPreparado($query);
		return $q;
	}
	public function getCountListServiciosGrua($values)
	{
		$where = '1 = 1';
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
      $where.=" AND sg.IdProveedor = ".$values['IdProveedor']."";
    }
    if(isset($values['IdGrua']) and $values['IdGrua']!=''){
      $where.=" AND sg.IdGrua = ".$values['IdGrua']."";
    }
		if(isset($values['Placa']) and $values['Placa']!=''){
      $where.=" AND sc.Placa = '".$values['Placa']."'";
    }
		if(isset($values['Cedula']) and $values['Cedula']!=''){
      $where.=" AND sc.Cedula = '".$values['Cedula']."'";
    }
    if(isset($values['filtro_status']) and $values['filtro_status']!=''){
        $where.=" AND Servicios.IdEstatus <> 1";
    }
		if(isset($values['filtro_administracion']) and $values['filtro_administracion']=='1'){
        $where.=" AND Servicios.IdEstatus in(6,7,8,9)";
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
			$where.=" AND DATE_FORMAT(Servicios.Inicio, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][3]['search']['value']."', '%d-%m-%Y')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND DATE_FORMAT(Servicios.Fin, '%d-%m-%Y') =  DATE_FORMAT('".$values['columns'][4]['search']['value']."', '%d-%m-%Y')";
		}
		$ConnectionORM = new ConnectionORM();
		$query = "SELECT count(*) as cuenta
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
		LEFT JOIN CondicionLugar cl ON cl.IdCondicionLugar = Servicios.IdCondicionLugar
		INNER JOIN Aplicaciones ap ON ap.IdAplicacion = Servicios.IdAplicacion
		WHERE $where
		";
		$q = $ConnectionORM->ejecutarPreparado($query);
		$q = $q->fetch();
		return $q['cuenta'];
	}
}
