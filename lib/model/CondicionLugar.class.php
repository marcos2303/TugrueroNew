<?php

	class CondicionLugar {
		public function getCondicionLugarInfo($IdCondicionLugar){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->CondicionLugar
			->select("*")
			->where("IdCondicionLugar=?",$IdCondicionLugar)->fetch();
			return $q;
		}
		public function getList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->CondicionLugar
			->select("*")
			->where("Estatus=?",1)->order("Nombre");
			return $q;
		}
	}
