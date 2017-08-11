<?php

	class VehiculosTipos {


		public function getList($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->VehiculosTipos
			->select("*")
			->where("Estatus=?",1)
			->order('Nombre');
			return $q;
		}
	}
