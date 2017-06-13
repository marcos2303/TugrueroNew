<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Polizass
	 *
	 * @author marcos
	 */
	class UsuariosInternos {
		
		public function __construct() 
		{
			
		}
		public function getUsuariosList($values)
		{	
			$columns = array();
			$columns[0] = 'users.id_user';
			$columns[1] = 'document';
			$columns[2] = 'login';
			$columns[3] = 'first_name';
			$columns[4] = 'first_lastname';
			$columns[5] = 'phone';
            $columns[6] = 'mail';
            $columns[7] = 'users.status';
			$column_order = $columns[0];
			$where = 'up.id_perms in(2,5)';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(document) like upper('%$str%')"
					. "OR upper(first_name) like upper('%".$str."%')"
					. "OR upper(first_name) like upper('%".$str."%')"
					. "OR upper(first_name) like upper('%".$str."%')"
					. "OR upper(first_name) like upper('%".$str."%')"
					. "OR upper(first_name) like upper('%".$str."%')";
			}
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND users.id_user = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND users.login = ".$values['columns'][1]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(document) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(first_name),' ',upper(second_name ) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(first_last_name),' ',upper(second_last_name )) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(phone) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(Nombre),' ',upper(Apellido) ) like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND users.status = '".$values['columns'][7]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			
			
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->users
			->select("users.*,ud.*")
			->join('users_data','INNER JOIN users_data ud ON ud.id_users = users.id_user')
			->join('users_perms','INNER JOIN users_perms up ON up.id_user = users.id_user')
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountUsuariosList($values)
		{	
			$where = 'up.id_perms in(2,5)';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = " ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("count(*) as cuenta")
			->join('users_data','INNER JOIN users_data ud ON ud.id_users = users.id_user')
			->join('users_perms','INNER JOIN users_perms up ON up.id_user = users.id_user')
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getUsuariosInternosById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			
			->select("users.*,ud.*,up.id_perms,DATE_FORMAT(ud.birthdate, '%d/%m/%Y') as birthdate")
			->join('users_data','INNER JOIN users_data ud ON ud.id_users = users.id_user')
			->join('users_perms','INNER JOIN users_perms up ON up.id_user = users.id_user')
			->where("users.id_user=?",$values['id_user'])->fetch();
			return $q; 				
			
		}
	
		function saveUsuariosInternos($values){
			unset($values['PHPSESSID'],$values['action']);
			$Utilitarios = new Utilitarios();
            if(isset($values['birthdate']) and $values['birthdate']!='')
            {
				$values['birthdate'] = $Utilitarios->formatFechaInput($values['birthdate']);

            }else
            {
				$values['birthdate']=null;
            }			
			
			
			//inserto en users
			$array_users = array(
				"login"=> strtoupper($values['login']),
				"password"=> hash('sha256',$values['password']),
				"status"=> $values['status'],
				"date_created"=> new NotORM_Literal("NOW()"),
				"date_updated"=> new NotORM_Literal("NOW()"),
				"mail"=> $values['mail'],
				"mail_alternative"=> $values['mail_alternative'],
 			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users()->insert($array_users);
			$id_user = $ConnectionORM->getConnect()->users()->insert_id();
			
			//inserto en users_data
			$array_users_data = array(
				"id_users"=> $id_user,
				"document"=> $values['document'],
				"first_name"=> strtoupper($values['first_name']),
				"second_name"=> strtoupper($values['second_name']),
				"first_last_name"=> strtoupper($values['first_last_name']),
				"second_last_name"=> strtoupper($values['second_last_name']),
				"nationality"=> $values['nationality'],
				"birthdate"=> $values['birthdate'],
				"gender"=> $values['gender'],
				"phone"=> $values['phone'],
				"phone1"=> $values['phone1'],
				"date_created"=> new NotORM_Literal("NOW()"),
				"date_updated"=> new NotORM_Literal("NOW()")
 			);			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data()->insert($array_users_data);		
			
			//inserto en users_perms
			$array_users_perms = array(
				"id_user"=> $id_user,
				"id_perms"=> $values['id_perms'],
				"status"=> $values['status'],
				"date_created"=> new NotORM_Literal("NOW()"),
				"date_updated"=> new NotORM_Literal("NOW()"),
 			);			
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_perms()->insert($array_users_perms);				
			$values['id_user'] = $id_user;
			return $values;	
			
		}
		function updateUsuariosInternos($values){
			$Utilitarios = new Utilitarios();
            if(isset($values['birthdate']) and $values['birthdate']!='')
            {
				$values['birthdate'] = $Utilitarios->formatFechaInput($values['birthdate']);

            }else
            {
				$values['birthdate']=null;
            }			
			
			
			
			$id_user = $values['id_user'];
			
			
			
			
			//actualizo en users
			$array_users = array(
				"login"=> strtoupper($values['login']),
				"status"=> $values['status'],
				"date_updated"=> new NotORM_Literal("NOW()"),
				"mail"=> $values['mail'],
				"mail_alternative"=> $values['mail_alternative'],
 			);
			//actualizo la clave
			if(isset($values['password']) and $values['password']!='')
			{
				$array_users['password'] = hash('sha256',$values['password']);
			}
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users("id_user", $id_user)->update($array_users);
			
			//actualizo en users_data
			$array_users_data = array(
				"id_users"=> $id_user,
				"document"=> $values['document'],
				"first_name"=> strtoupper($values['first_name']),
				"second_name"=> strtoupper($values['second_name']),
				"first_last_name"=> strtoupper($values['first_last_name']),
				"second_last_name"=> strtoupper($values['second_last_name']),
				"nationality"=> $values['nationality'],
				"birthdate"=> $values['birthdate'],
				"gender"=> $values['gender'],
				"phone"=> $values['phone'],
				"phone1"=> $values['phone1'],
				"date_created"=> new NotORM_Literal("NOW()"),
				"date_updated"=> new NotORM_Literal("NOW()")
 			);				
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data("id_users", $id_user)->update($array_users_data);			

			//actualizo en users_perms
			
				$array_users_perms = array(
				"id_user"=> $id_user,
				"id_perms"=> $values['id_perms'],
				"status"=> 1,
				"date_created"=> new NotORM_Literal("NOW()"),
				"date_updated"=> new NotORM_Literal("NOW()"),
 			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_perms("id_user", $id_user)->update($array_users_perms);			
			
			
			return $q;
			
		}		
	}
	