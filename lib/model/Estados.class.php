<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Seguross
	 *
	 * @author marcos
	 */
	class Estados {
		
		public function __construct() 
		{
			
		}
		public function getEstadosListSelect(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Estados
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}		
	}
	