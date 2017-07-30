<?php

	class ServiciosClientes {

		public $IdUsuarioPermiso = null;
		public $IdPoliza = null;
		public $PolizaVencida = 0;//inicializo en no

		function getIdUsuarioPermiso() {
			return $this->IdUsuarioPermiso;
		}

		function getIdPoliza() {
			return $this->IdPoliza;
		}

		function setIdUsuarioPermiso($IdUsuarioPermiso) {
			$this->IdUsuarioPermiso = $IdUsuarioPermiso;
		}

		function setIdPoliza($IdPoliza) {
			$this->IdPoliza = $IdPoliza;
		}
		function getPolizaVencida() {
			return $this->PolizaVencida;
		}

		function setPolizaVencida($PolizaVencida) {
			$this->PolizaVencida = $PolizaVencida;
		}


		function addServiciosClientes($values){

			if(!isset($values['IdUsuarioPermiso']) or $values['IdUsuarioPermiso']==''){
				$values['IdUsuarioPermiso'] = $this->getIdUsuarioPermiso();
			}
			if(!isset($values['IdPoliza']) or $values['IdPoliza']==''){
				$values['IdPoliza'] = $this->getIdPoliza();
			}
			if(!isset($values['PolizaVencida']) or $values['PolizaVencida']==''){
				$values['PolizaVencida'] = $this->getPolizaVencida();
			}
			$array = array(
					'IdServicio' =>  $values['IdServicio'],
					'IdPoliza' => $values['IdPoliza'],
					'Nombres' => $values['Nombres'],
					'Apellidos' => $values['Apellidos'],
					'Cedula' => $values['Cedula'],
					'Placa' => $values['Placa'],
					'IdMarca' => $values['IdMarca'],
					'Modelo' => $values['Modelo'],
					'Color' => $values['Color'],
					'Anio' => $values['Anio'],
					'Celular' => $values['Celular'],
					'PolizaVencida' => $values['PolizaVencida'],
					'IdUsuarioPermiso' => $values['IdUsuarioPermiso'],
				);

			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosClientes()->insert($array);
			return $q;
		}
		function updateServiciosClientes($values){


			$array = array();
			if(count($values)>0){
				foreach($values as $key => $val){
					if(strlen($val)>0){
						$array[$key] = $val;
					}
				}
			}
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosClientes("IdServicio", $values['IdServicio'])->update($array);
			return $q;

		}
		function deleteServiciosClientes(){



		}
	}
