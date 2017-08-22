<?php

	class Averias {

		public function getAveriasInfo($IdAveria){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Averias
			->select("*")
			->where("IdAveria=?",$IdAveria)->fetch();
			return $q;
		}
		public function getList($values){
			$ConnectionORM = new ConnectionORM();
			if(isset($values['IdAveriaPadre']) and $values['IdAveriaPadre']!=''){
				$q = $ConnectionORM->getConnect()->Averias
				->select("*")
	      ->where("Estatus=?",1)
				->and("IdAveriaPadre=?",$values['IdAveriaPadre'])                
				->order('Nombre');
			}else{
				$q = $ConnectionORM->getConnect()->Averias
				->select("*")
	      ->where("Estatus=?",1)
				->order('Nombre');
			}

			return $q;
		}
	}
