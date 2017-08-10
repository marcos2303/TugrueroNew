<?php

	class Estados {

		public function getList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Estados
			->select("*")
            ->where("Estatus=?",1);
			return $q;
		}

		public function getEstadosListSelect(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Estados
			->select("*")
			->where("Estatus=?",1);
			return $q; 				
			
		}
	}
