<?php

	class ProveedoresTipos {
				
		public function getList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ProveedoresTipos
			->select("*")
            ->where("Estatus=?",1);
			return $q; 	
		}
		

	}
	