<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Hoists
	 *
	 * @author marcos
	 */
	class Hoist {
		
		public function __construct() 
		{
			
		}
		public function getHoistList($values)
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
			$q = $ConnectionORM->getConnect('tugruero')->hoist
			->select("*,DATE_FORMAT(hoist.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(hoist.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("hoist_company","INNER JOIN hoist_company on hoist_company.id_hoist = hoist.id")
			->order("$column_order $order")
			->where("$where")
			->and("hoist_company.id_company =?",$values["company"])
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountHoistList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(registration_plate) like upper('%$str%') ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist
			->select("count(*) as cuenta")
			->join("hoist_company","INNER JOIN hoist_company on hoist_company.id_hoist = hoist.id")
			->where("$where and hoist_company.id_company=".$values["company"]."")->fetch();
			return $q['cuenta']; 			
		}
		public function getHoistById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist
			->select("*,DATE_FORMAT(hoist.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(hoist.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id=?",$values['id'])->fetch();
			return $q; 				
			
		}
		function deleteHoist($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hosit("id", $id)->delete();
			
			
		}		
		function saveHoist($values){
			unset($values['PHPSESSID']);
			unset($values['action']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->hoist()->insert_id();
			$ConnectionORM = new ConnectionORM();
			$hoistCompany = array("id_hoist" => $values['id'],"id_company" => $_SESSION['id_company']);
			$q = $ConnectionORM->getConnect()->hoist_company()->insert($hoistCompany);
			
			return $values;	
			
		}
		function updateHoist($values){
			unset($values['PHPSESSID']);
			unset($values['action'],$values['date_created']);
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$id_hoist = $values['id'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist("id", $id_hoist)->update($values);
			return $q;
			
		}
		public function getHoistByIdCompany($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->hoist
			->select("*")
			->join("hoist_company","INNER JOIN hoist_company on hoist_company.id_hoist = hoist.id")
			->where("hoist_company.id_company=?",$values['id']);
			return $q; 				
			
		}
		public function getCountUserHoistCompanyByIdHoist($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_hoist_company
			->select("count(*) as cuenta")
			->where("users_hoist_company.id_hoist=?",$values['id'])->fetch();
			return $q; 				
			
		}
		public function getUserHoistCompanyByIdHoist($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->users_hoist_company
			->select("*")
			->where("users_hoist_company.id_hoist=?",$values['id']);
			return $q; 				
			
		}		
	}
	