<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of UsersCompany
	 *
	 * @author marcos
	 */
	class UsersCompany {
		
		public function __construct() 
		{
			
		}
		public function getUsersCompanyList($values)
		{	
			$columns = array();
			$columns[0] = 'id';
			$columns[1] = 'id_user';
			$columns[2] = 'id_company';
			$columns[3] = 'status';
			$columns[4] = 'date_created';
			$columns[5] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where= ""
                                        . "upper(users.login) like upper('%$str%') "
                                        . "or upper(company.razon_social) like upper('%$str%' )"
                                        . "or upper(status.name) like upper('%$str%')"
                                        . "";
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
			$q = $ConnectionORM->getConnect()->users_company()
			->select("users_company.*,users.login,company.razon_social,DATE_FORMAT(users_company.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(users_company.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = users_company.status")
                        ->join("company","LEFT JOIN company on company.id = users_company.id_company")
                        ->join("users","LEFT JOIN users on users.id_user = users_company.id_user")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
                        //echo $q;die;
			return $q; 			
		}
		public function getCountUsersCompanyList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where= ""
                                        . "upper(users.login) like upper('%$str%') "
                                        . "or upper(company.razon_social) like upper('%$str%' )"
                                        . "or upper(status.name) like upper('%$str%')"
                                        . "";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = users_company.status")
                        ->join("company","LEFT JOIN company on company.id = users_company.id_company")
                        ->join("users","LEFT JOIN users on users.id_user = users_company.id_user")
                        ->where("$where")
                        ->fetch();
			return $q['cuenta']; 			
		}
		public function getUsersCompanyById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id=?",$values['id'])->fetch();
			return $q; 				
			
		}
		function deleteUsersCompany($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company("id", $id)->delete();
			
			
		}		
		function saveUsersCompany($values){
			unset($values['PHPSESSID']);
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->UsersCompany()->insert_id();
			return $values;	
			
		}
		function updateUsersCompany($values){
			unset($values['PHPSESSID']);
			unset($values['action'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_company("id", $id)->update($values);
			return $q;
			
		}
		public function getCompanyIdByUser($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("")
			->join("users_company","INNER JOIN users_company uc on uc.id_user = users.id_user")
			->where("users.id_user=?",$values['id_user'])
			->limit(1)
			->fetch();
			return $q; 				
			
		}
		public function getUsersByCompanyId($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users
			->select("users.*,ud.*")
			->join("users_company","INNER JOIN users_company uc on uc.id_user = users.id_user")
			->join("users_data","INNER JOIN users_data ud on ud.id_users = users.id_user")
			->where("id_company=?",$values['id']);
			return $q; 				
			
		}
	}
	