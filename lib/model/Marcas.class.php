<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Users
	 *
	 * @author marcos
	 */
	class Marcas {

		public function __construct()
		{

		}
		public function getMarcasListSelect()
		{

    	$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Marcas
			->select("*")
			->where("Estado = 'A'");
			return $q;
		}
		public function getList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Marcas
			->select("*")
    	->where("Estatus=?",1)->order('Nombre');
			return $q;
		}








	}
