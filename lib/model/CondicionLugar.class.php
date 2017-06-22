<?php
	
	class CondicionLugar {
		public function getCondicionLugarInfo($IdCondicionLugar){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->CondicionLugar
			->select("*")
			->where("IdCondicionLugar=?",$IdCondicionLugar)->fetch();
			return $q; 	
		}
	}
	