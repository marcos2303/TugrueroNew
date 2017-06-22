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
				'EstatusServicio' => $values['EstatusServicio'],
				'Agendado' => $values['Agendado'],
				'FechaAgendado' => $values['FechaAgendado'],
				'IdUsuario' => $values['IdUsuario'],
				'IdAveria' => $values['IdAveria'],
				'AveriaDetalle' => $values['AveriaDetalle'],
				'IdCondicionLugar' => $values['IdCondicionLugar'],
				'CondicionDetalle' => $values['CondicionDetalle'],
				'LatitudOrigen' => $values['LatitudOrigen'],
				'LongitudOrigen' => $values['LongitudOrigen'],
				'EstadoOrigen' => $values['EstadoOrigen'],
				'DireccionOrigen' => $values['DireccionOrigen'],
				'DireccionOrigenDetallada' => $values['DireccionOrigenDetallada'],
				'LatitudDestino' => $values['LatitudDestino'],
				'LongitudDestino' => $values['LongitudDestino'],
				'EstadoDestino' => $values['EstadoDestino'],
				'DireccionDestino' => $values['DireccionDestino'],
				'DireccionDestinoDetallada' => $values['DireccionDestinoDetallada'],
				'KM' => $values['KM'],
				'Inicio' => date('Y-m-d h:i:s'),
				'Fin' => null,
				'Observacion' => $values['Observacion'],
				'UlimaActCliente' => date('Y-m-d h:i:s'),
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
		$array = array(
				'CodigoServicio' => $values['CodigoServicio'],
				'IdAplicacion' => $values['IdAplicacion'],
				'IdServicioTipo' => $values['IdServicioTipo'],
				'EstatusServicio' => $values['EstatusServicio'],
				'Agendado' => $values['Agendado'],
				'FechaAgendado' => $values['FechaAgendado'],
				'IdUsuario' => $values['IdUsuario'],
				'IdAveria' => $values['IdAveria'],
				'AveriaDetalle' => $values['AveriaDetalle'],
				'IdCondicionLugar' => $values['IdCondicionLugar'],
				'CondicionDetalle' => $values['CondicionDetalle'],
				'LatitudOrigen' => $values['LatitudOrigen'],
				'LongitudOrigen' => $values['LongitudOrigen'],
				'EstadoOrigen' => $values['EstadoOrigen'],
				'DireccionOrigen' => $values['DireccionOrigen'],
				'DireccionOrigenDetallada' => $values['DireccionOrigenDetallada'],
				'LatitudDestino' => $values['LatitudDestino'],
				'LongitudDestino' => $values['LongitudDestino'],
				'EstadoDestino' => $values['EstadoDestino'],
				'DireccionDestino' => $values['DireccionDestino'],
				'DireccionDestinoDetallada' => $values['DireccionDestinoDetallada'],
				'KM' => $values['KM'],
				'Inicio' => $values['Inicio'],
				'Fin' => $values['Fin'],
				'Observacion' => $values['Observacion'],
				'UlimaActCliente' => $values['UlimaActCliente'],
				'UltimaActGruero' => $values['UlimaActCliente'],
			);
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Servicios("IdServicio", $values['IdServicio'])->update($array);

		}
		function getServiciosInfo($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Servicios
			->select("*")
			->join("ServiciosClientes","LEFT JOIN ServiciosClientes c on c.IdServicio = Servicios.IdServicio")
			->join("ServiciosPrecios","LEFT JOIN ServiciosPrecios p on p.IdServicio = Servicios.IdServicio")
			->join("ServiciosGruas","LEFT JOIN ServiciosGruas g on g.IdServicio = Servicios.IdServicio")
			->where("Servicios.IdServicio=?",$values['IdServicio']);
			return $q; 	
		}
	}
