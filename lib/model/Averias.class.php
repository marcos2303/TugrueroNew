<?php

	class Averias {
		
		public function getAveriasInfo($IdAveria){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Averias
			->select("*")
			->where("IdAveria=?",$IdAveria)->fetch();
			return $q; 	
		}
		
		
	}
	