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
	class Seguros {
		
		public function __construct() 
		{
			
		}
		public function getSegurosListSelect(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
		public function getSegurosListSelect2(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros
			->select("*")
			->order('name');
			
			return $q; 				
			
		}
		public function getSegurosList($values)
		{	
			$columns = array();
			$columns[0] = 'id_seguro';
			$columns[1] = 'Seguros.name';
			$columns[2] = 'status.name';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND id_seguro = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Seguros.name) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(status.name) like ('%".$values['columns'][2]['search']['value']."%')";
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
			$q = $ConnectionORM->getConnect('tugruero')->Seguros
			->select("*, status.name as status, Seguros.name as name")
			->where("$where")
			->join("status","INNER JOIN status on status.id_status = Seguros.status")
			->order("$column_order $order")			
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountSegurosList($values)
		{	
			$where = '1 = 1';
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND id_seguro = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Seguros.name) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(status.name) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","INNER JOIN status on status.id_status = Seguros.status")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getSegurosById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros
			->select("*")
			->where("id_seguro=?",$values['id_seguro'])->fetch();
			return $q; 				
			
		}		
		function saveSeguros($values){

			$array_seguro = array(
				'name' => $values['name'],
				'status' => $values['status']
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Seguros()->insert($array_seguro);
			$values['id_seguro'] = $ConnectionORM->getConnect()->Seguros()->insert_id();
			$array_seguro['id_seguro'] = $values['id_seguro'];
			
			return $values;	
			
		}
		function updateSeguros($values){			
			$array_seguro = array(
				'name' => $values['name'],
				'status' => $values['status']
			);
			$id_seguro = $values['id_seguro'];
			
			//busco el nombre que tenia antes de la actualizacion para poder hacer update en las polizas
			$seguro_antiguo = $this->getSegurosById($values);
			$nombre_seguro_anterior = $seguro_antiguo['name'];
				
			
			
			$ConnectionORM = new ConnectionORM();
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionORM->getConnect()->Seguros("id_seguro", $id_seguro)->update($array_seguro);	
			
			if($values['status']==0)
			{
				$status = 'Desactivado';
			}else
			{
				$status = 'Activo';
			}
			
			
			//modifico en todas las polizas			

			$q = $ConnectionORM->ejecutarPreparado("UPDATE Polizas set Seguro = '".$values['name']."', EstatusPoliza = '".$status."' where Seguro = '$nombre_seguro_anterior'");
			$q = $ConnectionAws->ejecutarPreparado("UPDATE Polizas set Seguro = '".$values['name']."', EstatusPoliza = '".$status."' where Seguro = '$nombre_seguro_anterior'");
			
			
			return $q;
			
		}

		
	}
			

	