<?php

	class GruasTipos {
				
		public function getList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->GruasTipos
			->select("*")
            ->where("Estatus=?",1);
			return $q; 	
		}
		

	}
	