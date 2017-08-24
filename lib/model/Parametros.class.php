<?php

	class Parametros {

		public function getValor($IdParametro){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Parametros
			->select("*")
			->where("IdParametro=?",$IdParametro)->fetch();
			return $q;
		}
	}
