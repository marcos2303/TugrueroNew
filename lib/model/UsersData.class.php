<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of UsersDatas
	 *
	 * @author marcos
	 */
	class UsersData {
		
		public function __construct() 
		{
			
		}
		public function getUsersDataList($values)
		{	
			$columns = array();
			$columns[0] = 'id';
			$columns[1] = 'engine_serial';
			$columns[2] = 'body_serial';
			$columns[3] = 'registration_plate';
			$columns[4] = 'year_vehicle';
            $columns[5] = 'make';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(registration_plate) like upper('%$str%')";
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
			$q = $ConnectionORM->getConnect('tugruero')->users_data
			->select("*")
			->join("users_data_company","INNER JOIN users_data_company on users_data_company.id_users_data = users_data.id")
			->order("$column_order $order")
			->where("$where")
			->and("users_data_company.id_company =?",$values["company"])
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountUsersDataList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(registration_plate) like upper('%$str%') ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data
			->select("count(*) as cuenta")->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getUsersDataById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data
			->select("*")
			->where("id_users=?",$values['id_users'])
			->join("users","INNER JOIN users on users.id_user = users_data.id_users")
			->fetch();
			return $q; 				
			
		}
		function deleteUsersData($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data("id", $id)->delete();
			
			
		}		
		function saveUsersData($values){
			unset($values['PHPSESSID']);
			unset($values['action']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->users_data()->insert_id();
			$ConnectionORM = new ConnectionORM();
			$users_dataCompany = array("id_users_data" => $values['id'],"id_company" => $_SESSION['id_company']);
			$q = $ConnectionORM->getConnect()->users_data_company()->insert($users_dataCompany);
			
			return $values;	
			
		}
		function updateUsersData($values){
			unset($values['PHPSESSID']);
			unset($values['action'],$values['date_created'],$values['login']);
            $values['date_updated'] = new NotORM_Literal("NOW()");
			
			$Company = new Company();
			$values['id'] = $_SESSION["id_company"];
			$data_company = $Company->getCompanyById($values);
			unset($values['id']);
			$location =  $data_company['location'];
			$zone_work =  $data_company['zone_work'];
			$values['location'] = @$location;
			$values['zone_work'] = @$zone_work;
			$id_users_data = $values['id_users'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data("id_users", $id_users_data)->update($values);
			return $q;
			
		}
		public function getMasterByIdCompany($id_company){
						
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data
			->select("*")
			->join("users","INNER JOIN users on users.id_user = users_data.id_users")
			->join("users_company","INNER JOIN users_company on users_company.id_user = users_data.id_users")
			->join("users_perms","INNER JOIN users_perms on users_perms.id_user = users_data.id_users")
			->where("users_company.id_company=?",$id_company)
			->and('users_perms.id_perms=?',3)
			->fetch();
			
			return $q;
			}
			public function updateUsersDataCompany($values)
			{
			$id_users_data = $values['id_user'];
			unset($values['id_user']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_data("id_users", $id_users_data)->update($values);
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Grueros("idGrua", $id_users_data)->update($values);
			//echo $values['zone_work'];die;
			}
	}
	