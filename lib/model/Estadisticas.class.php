<?php


	class Estadisticas {
		public $Where = "";

		public function getWhere() {
			return $this->Where;
		}
		public function setWhere($Where) {
			$this->Where = $Where;
		}

		function getResumenGeneral($values){

			$where = " 1 =  1 AND Servicios.IdEstatus not in(1,2,3,4,5,8) ";
			if(isset($values['IdServicioTipo']) and $values['IdServicioTipo']!=0 and $values['IdServicioTipo']!="" and $values['IdServicioTipo']!="Todos"){
				$where.="AND Servicios.IdServicioTipo = ".$values["IdServicioTipo"]." ";
			}
			if(isset($values['IdSeguro']) and $values['IdSeguro']!=0 and $values['IdSeguro']!="" and $values['IdSeguro']!="Todos"){
				$where.="AND seg.IdSeguro = ".$values["IdSeguro"]." ";
			}
			if( (isset($values['FechaDesde']) and $values['FechaDesde'] !="") and (isset($values['FechaHasta']) and $values['FechaHasta'] !="")){
				$where.="AND Servicios.Inicio >= '".$values["FechaDesde"]." 0:00:00' and Servicios.Inicio <= '".$values["FechaHasta"]." 23:59:59'";
			}
			if(isset($values['FechaEspecifica']) and $values['FechaEspecifica']!=""){
				$where.="AND Servicios.Inicio >= '".$values["FechaEspecifica"]." 00:00:00' and Servicios.Inicio <= '".$values["FechaEspecifica"]." 23:59:59'";
			}
			if(isset($values['IdEstatusFinal']) and $values['IdEstatusFinal'] == 'Todos'){
				$where.=" AND Servicios.IdEstatus in(6,7,8,9)";
			}
			if(isset($values['IdEstatusFinal']) and $values['IdEstatusFinal'] !=0 and $values['IdEstatusFinal'] !=""){
				$where.=" AND Servicios.IdEstatus = ".$values['IdEstatusFinal']."";
			}
			if(!isset($values['IdEstatusFinal']) or $values['IdEstatusFinal'] ==""){
				$where.=" AND Servicios.IdEstatus in(6,7,8,9)";
			}
			if(isset($values['Agendado']) and $values['Agendado']!=0 and $values['Agendado']!="" and $values['Agendado']!="Ambos"){
				if($values['Agendado'] == 2){//
					$where.="AND Servicios.Agendado = 1 ";
				}
				if($values['Agendado'] == 1){//
					$where.="AND (Servicios.Agendado = 0 or Servicios.Agendado is null )";
				}
			}


			$ConnectionORM = new ConnectionORM();
			$query = "SELECT
			Servicios.IdServicio,CodigoServicio,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
			CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, DATE_FORMAT(FechaAgendado, '%d/%m/%Y') AS FechaAgendado,
			DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i:%s') AS Inicio, DATE_FORMAT(Fin, '%d/%m/%Y %H:%i:%s') AS Fin
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
			//echo "<pre>".$query."</pre>";
			$this->setWhere($where);
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getResumenBd($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT
			Servicios.IdServicio,CodigoServicio,Servicios.IdServicioTipo,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
			CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, FechaAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
			AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
			DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
			KM, DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i:%s') AS Inicio, DATE_FORMAT(Fin, '%d/%m/%Y %H:%i:%s') AS Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
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
			WHERE $Where
			AND Servicios.IdServicioTipo in (1,2)
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getResumenNoBd($Where){




			$ConnectionORM = new ConnectionORM();
			$query = "SELECT
			Servicios.IdServicio,CodigoServicio,Servicios.IdServicioTipo,ap.Nombre AS NombreAplicacion, st.Nombre AS NombreServicioTipo,e.Nombre AS NombreEstatus,
			CASE WHEN Agendado = 1 THEN 'SI' ELSE 'NO' END AS Agendado, FechaAgendado, u.Login AS NombreUsuarioServicio, a.Nombre AS NombreAveria,
			AveriaDetalle, cl.Nombre AS NombreCondicionLugar, CondicionDetalle,LatitudOrigen, LongitudOrigen, e1.Nombre AS NombreEstadoOrigen,
			DireccionOrigen, DireccionOrigenDetallada, LatitudDestino, LongitudDestino,e2.Nombre AS NombreEstadoDestino,DireccionDestino, DireccionDestinoDetallada,
			KM, DATE_FORMAT(Inicio, '%d/%m/%Y %H:%i:%s') AS Inicio, DATE_FORMAT(Fin, '%d/%m/%Y %H:%i:%s') AS Fin, UltimaActCliente, UltimaActGruero, sg.IdGrua, p.Nombres AS NombresProveedor,p.Apellidos AS ApellidosProveedor,
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
			WHERE $Where
				AND Servicios.IdServicioTipo in (3)
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountResumenGeneral($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT e.Nombre, COUNT(*) as Cuenta
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
			WHERE $Where
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountResumenBd($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT e.Nombre, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y') AS Fecha,  COUNT(*) AS Cuenta
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
			WHERE $Where
				AND Servicios.IdServicioTipo IN (1,2)
				GROUP BY Servicios.IdEstatus, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountResumenBdAgendados($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT e.Nombre, COUNT(*) as Cuenta
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
			WHERE $Where
				AND Servicios.Agendado = 1
				AND Servicios.IdServicioTipo in (1,2)
				GROUP BY Servicios.IdEstatus
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountResumenNoBd($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT e.Nombre, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y') AS Fecha,  COUNT(*) AS Cuenta
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
			WHERE $Where
				AND Servicios.IdServicioTipo in (3)

			GROUP BY Servicios.IdEstatus, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountResumenNoBdAgendados($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT e.Nombre, COUNT(*) as Cuenta
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
			WHERE $Where
				AND Servicios.Agendado = 1
				AND Servicios.IdServicioTipo in (3)
			GROUP BY Servicios.IdEstatus
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountLlamadasParticular($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT st.Nombre, COUNT(*) as Cuenta
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
			WHERE $Where
			AND Servicios.IdServicioTipo in (2)
			GROUP BY Servicios.IdServicioTipo
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountLlamadasSeguros($Where){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT seg.Nombre, COUNT(*) AS Cuenta
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
			WHERE $Where
			AND Servicios.IdServicioTipo in (1,3)
			GROUP BY seg.IdSeguro
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;
		}
		function getCountStatusBD($Where,$IdEstatus,$fecha){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT COUNT(*) AS Cuenta
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
			WHERE $Where
				AND Servicios.IdServicioTipo IN (1,2)
				AND Servicios.IdEstatus = $IdEstatus
				AND DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')  =  '".$fecha."'
				GROUP BY Servicios.IdEstatus, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			//echo $query;die;
			$q = $q->fetch();
			return $q;
		}
		function getCountStatusBDAgendado($Where,$IdEstatus,$fecha){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT COUNT(*) AS Cuenta
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
			WHERE $Where
				AND Servicios.IdServicioTipo IN (1,2)
				AND Servicios.IdEstatus = $IdEstatus
				AND Servicios.Agendado = 1
				AND DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')  =  '".$fecha."'
				GROUP BY Servicios.IdEstatus, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			//echo $query;die;
			$q = $q->fetch();
			return $q;
		}
		function getCountStatusNoBD($Where,$IdEstatus,$fecha){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT COUNT(*) AS Cuenta
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
			WHERE $Where
				AND Servicios.IdServicioTipo IN (3)
				AND Servicios.IdEstatus = $IdEstatus
				AND DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')  =  '".$fecha."'
				GROUP BY Servicios.IdEstatus, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			//echo $query;die;
			$q = $q->fetch();
			return $q;
		}
		function getCountStatusNoBDNoAgendado($Where,$IdEstatus,$fecha){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT COUNT(*) AS Cuenta
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
			WHERE $Where
				AND Servicios.IdServicioTipo IN (3)
				AND Servicios.IdEstatus = $IdEstatus
				AND (Servicios.Agendado <> 1)
				AND DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')  =  '".$fecha."'
				GROUP BY Servicios.IdEstatus, DATE_FORMAT(Servicios.Inicio, '%d/%m/%Y')
			";
			//echo "<pre>".$query."</pre>";
			$q = $ConnectionORM->ejecutarPreparado($query);
			//echo $query;die;
			$q = $q->fetch();
			return $q;
		}
	}
