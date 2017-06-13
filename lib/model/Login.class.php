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
	class Login {
		
		public function __construct() 
		{
			
		}
		public function GetLogin($user,$password)
		{	
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->users
			->where('login =?',$user)
			->and('password =?',hash('sha256', $password));
			
			$user = array();
			foreach($q as $users)
			{
				$user["users"] = $users;
				
					$q = $ConnectionORM->getConnect()->users_data
					->where('id_users =?',$users["id_user"]);
					
					foreach($q as $userData)
					{
						$user["users_data"] = $userData;
						break;
					}
					$q = $ConnectionORM->getConnect()->users_perms
					->where('id_user =?',$users["id_user"]);
					
					foreach($q as $userPerms)
					{
						$user["users_perms"] = $userPerms;
						break;
					}
					$q = $ConnectionORM->getConnect()->users_company
					->where('id_user =?',$users["id_user"]);
					
					foreach($q as $userCompany)
					{
						$user["users_company"] = $userCompany;
						break;
					}
				break;
			}
		$ConnectionORM->close();	
		return $user;
		}		
	}
	