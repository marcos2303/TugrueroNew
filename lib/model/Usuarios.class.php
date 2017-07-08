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
	class Usuarios {
		
		public function __construct() 
		{
			
		}

		function getLogin($values){
			$ConnectionORM = new ConnectionORM();			
			$where = "upper(Usuarios.Login) = '".strtoupper($values['Login'])."'";
			$where.= " and Usuarios.Clave = '".hash("sha256",$values['Clave'])."'";
			$where.= " and Usuarios.Estatus = 1";
			$q = $ConnectionORM->getConnect()->Usuarios
			->select("*")
			->where("$where")
			->fetch();
			return $q; 				
			
			
		}
		function getLoginEspecial($values){
			$ConnectionORM = new ConnectionORM();			
			$where = "upper(Usuarios.Login) = '".strtoupper($values['Usuario'])."'";
			$where.= " and Usuarios.ClaveEspecial = '".hash("sha256",$values['ClaveEspecial'])."'";
			$where.= " and Usuarios.Estatus = 1";
			$q = $ConnectionORM->getConnect()->Usuarios
			->select("*")
			->where("$where")
			->fetch();
			return $q; 				
			
			
		}
		public function getUserModifById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("*, DATE_FORMAT(users.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(users.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("users_perms","INNER JOIN users_perms on users_perms.id_user = users.id_user")		
			->where("users.id_user=?",$values['id_user'])->fetch();
			return $q; 				
			
		}
		

	}
	
