<?php

	class TiposPagosElectronicos {

		public function getTiposPagosElectronicosInfo($IdTipoPagoElectronico){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->TiposPagosElectronicos
			->select("*")
			->where("IdTipoPagoElectronico=?",$IdTipoPagoElectronico)->fetch();
			return $q;
		}
		public function getList($values){
			$ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->TiposPagosElectronicos
			->select("*")
            ->where("Estatus=?",1)
			->order('Nombre');
			return $q;
		}
	}
