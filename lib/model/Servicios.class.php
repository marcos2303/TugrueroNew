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
	}
