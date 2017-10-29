<?php

	class Bancos {

		public function getBancosInfo($IdBanco){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Bancos
			->select("*")
			->where("IdBanco=?",$IdBanco)->fetch();
			return $q;
		}
		public function getList($values){
			$ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->Bancos
			->select("*")
            ->where("Estatus=?",1)
			->order('Nombre');
			return $q;
		}
	}
