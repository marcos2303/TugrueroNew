<?php

	class ServiciosTipos {

		public function getServiciosTiposInfo($IdBanco){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Bancos
			->select("*")
			->where("IdBanco=?",$IdBanco)->fetch();
			return $q;
		}
		public function getList($values){
			$ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->ServiciosTipos
			->select("*")
            ->where("Estatus=?",1)
			->order('Nombre');
			return $q;
		}
	}
