<?php

	class Estatus {

		public function getEstatusInfo($IdEstatus){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Estatus
			->select("*")
			->where("IdEstatus=?",$IdEstatus)->fetch();
			return $q;
		}
		public function getList($values){
			$ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->Estatus
			->select("*")
            ->where("Estatus=?",1)
			->order('Nombre');
			return $q;
		}
		public function getListEstatusFinales($values){
			$ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->Estatus
			->select("*")
            ->where("Estatus=?",1)
		    ->and("IdEstatus in(6,7,8,9)")
			->and("TipoEstatus=?","SER")
			->order('Orden asc');
			//echo $q;die;
			return $q;
		}
	}
