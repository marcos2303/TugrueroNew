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
			if(!isset($values['IdUsuarioPermiso']) or $values['IdUsuarioPermiso']==''){
				$values['IdUsuarioPermiso'] = $this->getIdUsuarioPermiso();			
			}
			$array = array(
				
				'IdServicio' => $values['IdServicio'],
				'PrecioModificado' => $values['PrecioModificado'],
				'PrecioSIvaBaremo' => $values['PrecioSIvaBaremo'],
				'PrecioCIvaBaremo' => $values['PrecioCIvaBaremo'],
				'PrecioSIvaModificado' => $values['PrecioSIvaModificado'],
				'PrecioCIvaModificado' => $values['PrecioCIvaModificado'],
				'IdUsuarioPermiso' => $values['IdUsuarioPermiso'],
			);			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosPrecios()->insert($array);
			return $q;
		}
		function updateServiciosPrecios(){
			
		}
		function deleteServiciosPrecios(){
			
			
			
		}
	}
