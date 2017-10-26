<?php

	class ServiciosPrecios {

		public $PrecioModificado = 0;//inicializo en no
		public $IdUsuarioPermiso = null;

		function getPrecioModificado() {
			return $this->PrecioModificado;
		}

		function getIdUsuarioPermiso() {
			return $this->IdUsuarioPermiso;
		}

		function setPrecioModificado($PrecioModificado) {
			$this->PrecioModificado = $PrecioModificado;
		}

		function setIdUsuarioPermiso($IdUsuarioPermiso) {
			$this->IdUsuarioPermiso = $IdUsuarioPermiso;
		}



		function addServiciosPrecios($values){

			if(!isset($values['PrecioModificado']) or $values['PrecioModificado']==''){
				$values['PrecioModificado'] = $this->getPrecioModificado();
			}
			$array = array(

				'IdServicio' => $values['IdServicio'],
				'PrecioSIvaBaremo' => $values['PrecioSIvaBaremo'],
				'IvaBaremo' => $values['IvaBaremo'],
				'PrecioCIvaBaremo' => $values['PrecioCIvaBaremo'],
				'PrecioSIvaBaremoModificado	' => $values['PrecioSIvaBaremoModificado'],
				'IvaBaremoModificado' => $values['IvaBaremoModificado'],
				'PrecioCIvaBaremoModificado' => $values['PrecioCIvaBaremoModificado'],
				'PrecioClienteSIva' => $values['PrecioClienteSIva'],
				'IvaCliente' => $values['IvaCliente'],
				'PrecioClienteCIva' => $values['PrecioClienteCIva'],
				'PrecioClienteSIvaModificado' => $values['PrecioClienteSIvaModificado'],
				'IvaClienteModificado' => $values['IvaClienteModificado'],
				'PrecioClienteCIvaModificado' => $values['PrecioClienteCIvaModificado'],
				'IdUsuarioPermiso' => $values['IdUsuarioPermiso'],
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosPrecios()->insert($array);
			return $q;
		}
		function updateServiciosPrecios($values){


			$array = array();
			if(count($values)>0){
				foreach($values as $key => $val){
					if(strlen($val)>0){
						$array[$key] = $val;
					}
				}
			}
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosPrecios("IdServicio", $values['IdServicio'])->update($array);
			return $q;

		}
		function deleteServiciosPrecios(){



		}
		function calculaFechaEstimadaPago($Fecha){
			$query = "SELECT sumaDiasHabiles('".$Fecha."') as FechaEstimadaPago";
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
			$q = $q->fetch();
			return $q['FechaEstimadaPago'];
		}
	}
