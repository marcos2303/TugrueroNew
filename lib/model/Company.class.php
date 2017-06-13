<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Company
	 *
	 * @author marcos
	 */
	class Company {
		
		public function __construct() 
		{
			
		}
		public function getCompanyList($values)
		{	
			$columns = array();
			$columns[0] = 'id';
			$columns[1] = 'responsible_name';
			$columns[2] = 'RIF';
			$columns[3] = 'Razon_social';
			$columns[4] = 'date_created';
			$columns[5] = 'status';
			$columns[6] = 'date_created';
			$columns[7] = 'date_updated';
			$columns[8] = 'date_created';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(company.razon_social) like upper('%$str%')"
                                        . "or upper(company.responsible_name) like upper('%$str%')"
                                        . "or upper(company.rif) like upper('%$str%')"
                                        . "or cast(id as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->company()
			->select("company.*,DATE_FORMAT(company.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(company.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = company.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountCompanyList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(company.razon_social) like upper('%$str%')"
                                        . "or upper(company.responsible_name) like upper('%$str%')"
                                        . "or upper(company.rif) like upper('%$str%')"
                                        . "or cast(id as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("count(*) as cuenta")->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getCompanyById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id=?",$values['id'])->fetch();
			return $q; 				
			
		}
		function deleteCompany($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company("id", $id)->delete();
			
			
		}		
		function saveCompany($values){
			unset($values['action'],$values['PHPSESSID']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->Company()->insert_id();
			return $values;	
			
		}
		function updateCompany($values){
			unset($values['action'],$values['date_created'],$values['PHPSESSID']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company("id", $id)->update($values);
			return $q;
			
		}
	}
	