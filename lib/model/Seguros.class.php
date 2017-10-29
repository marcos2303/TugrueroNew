<?php

	/**
	 * Description of Users
	 *
	 * @author marcos
	 */
	class Seguros {

		public function __construct()
		{

		}
		public function getSegurosListSelect()
		{

    	$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros
			->select("*")
			->where("Estatus = 1");
			return $q;
		}
		public function getList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros
			->select("*")
    	->where("Estatus=?",1)->order('Nombre');
			return $q;
		}








	}
