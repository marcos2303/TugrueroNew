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
	class Polizas {
		
		public function __construct() 
		{
			
		}
		public function getPolizasList($values)
		{	
			$columns = array();
			$columns[0] = 'idPoliza';
			$columns[1] = 'Placa';
			$columns[2] = 'Cedula';
			$columns[3] = 'Nombre';
			$columns[4] = 'Apellido';
            $columns[5] = 'Vencimiento';
            $columns[6] = 'Seguro';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(Placa) like upper('%$str%')"
					. "OR upper(Cedula) like upper('%".$str."%')"
					. "OR upper(Nombre) like upper('%".$str."%')"
					. "OR upper(NumPoliza) like upper('%".$str."%')"
					. "OR upper(Apellido) like upper('%".$str."%')"
					. "OR upper(Seguro) like upper('%".$str."%')";
			}
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND idPoliza = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Seguro) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(NumPoliza) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Placa) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Cedula) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(Nombre),' ',upper(Apellido) ) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(Polizas.Vencimiento, '%d/%m/%Y') = '".$values['columns'][6]['search']['value']."'";
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
			$q = $ConnectionORM->getConnect('tugruero')->Polizas
			->select("*,DATE_FORMAT(Polizas.Vencimiento, '%d/%m/%Y') as Vencimiento, DATEDIFF(NOW(),Polizas.Vencimiento) AS dias_vencimiento")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountPolizasList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = " ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("count(*) as cuenta")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getPolizasById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*,DATE_FORMAT(Vencimiento, '%d/%m/%Y') as Vencimiento,DATE_FORMAT(DesdeVigencia, '%d/%m/%Y') as DesdeVigencia")
			->where("idPoliza=?",$values['idPoliza'])->fetch();
			return $q; 				
			
		}
		public function getPolizasBySeguroName($Seguro){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*")
			->where("Seguro=?",$Seguro);
			return $q; 				
			
		}
		function deletePolizas($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas("idPoliza", $id)->delete();
			
			
		}		
		function savePolizas($values){
			$Utilitarios = new Utilitarios();
            if(isset($values['Vencimiento']) and $values['Vencimiento']!='')
            {
				$values['Vencimiento'] = $Utilitarios->formatFechaInput($values['Vencimiento']);

            }else
            {
				$values['Vencimiento']=null;
            }
            if(isset($values['DesdeVigencia']) and $values['DesdeVigencia']!='')
            {
				$values['DesdeVigencia'] = $Utilitarios->formatFechaInput($values['DesdeVigencia']);

            }else
            {
				$values['DesdeVigencia']=null;
            }
			$hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$array_poliza = array(
				'Placa' => $values['Placa'],
				'Cedula' => $values['Nacionalidad'].'-'.$values['Cedula'],
				'Nombre' => $values['Nombre'],
				'Apellido' => $values['Apellido'],
				'Marca' => $values['Marca'],
				'Modelo' => $values['Modelo'],
				'Tipo' => $values['Tipo'],
				'Color' => $values['Color'],
				'Año' => $values['Año'],
				'Serial' => $values['Serial'],
				'Seguro' => $values['concatenado_plan'],
				'NumPoliza' => $values['NumPoliza'],
				'DireccionEDO' => $values['DireccionEDO'],
				'Domicilio' => $values['Domicilio'],
				'DireccionFiscal' => $values['DireccionFiscal'],
				'Vencimiento' => $values['Vencimiento'],
				'DesdeVigencia' => $values['DesdeVigencia'],
				'date_created' => $hora,
				'date_updated' => $hora,
				'created_by' => 1,
				'updated_by' => 1,
				'EstatusPoliza' => $values['EstatusPoliza'],
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas()->insert($array_poliza);
			$values['idPoliza'] = $ConnectionORM->getConnect()->Polizas()->insert_id();
			$array_poliza['idPoliza'] = $values['idPoliza'];
			//preparo datos para el AWS
			unset(
				$array_poliza['date_created'],
				$array_poliza['date_updated'],
				$array_poliza['NumPoliza'],
				$array_poliza['DireccionFiscal'],
				$array_poliza['Domicilio'],
				$array_poliza['Serial'],
				$array_poliza['created_by'],
				$array_poliza['updated_by']			
				);
			//inserto en aws 
                     
			$ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Polizas()->insert($array_poliza);			
			
			
			return $values;	
			
		}
		function updatePolizas($values){			
			$Utilitarios = new Utilitarios();
            if(isset($values['Vencimiento']) and $values['Vencimiento']!='')
            {
				$values['Vencimiento'] = $Utilitarios->formatFechaInput($values['Vencimiento']);

            }else
            {
				$values['Vencimiento']=null;
            }

            if(isset($values['DesdeVigencia']) and $values['DesdeVigencia']!='')
            {
				$values['DesdeVigencia'] = $Utilitarios->formatFechaInput($values['DesdeVigencia']);

            }else
            {
				$values['DesdeVigencia']=null;
            }	
			
 			$hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$array_poliza = array(
				'Placa' => $values['Placa'],
				'Cedula' => $values['Nacionalidad'].'-'.$values['Cedula'],
				'Nombre' => $values['Nombre'],
				'Apellido' => $values['Apellido'],
				'Marca' => $values['Marca'],
				'Modelo' => $values['Modelo'],
				'Tipo' => $values['Tipo'],
				'Color' => $values['Color'],
				'Año' => $values['Año'],
				'Serial' => $values['Serial'],
				'Seguro' => $values['Seguro'],
				'NumPoliza' => $values['NumPoliza'],
				'DireccionEDO' => $values['DireccionEDO'],
				'Domicilio' => $values['Domicilio'],
				'DireccionFiscal' => $values['DireccionFiscal'],
				'Vencimiento' => $values['Vencimiento'],
				'DesdeVigencia' => $values['DesdeVigencia'],
				'date_updated' => $hora,
				'created_by' => 1,
				'updated_by' => 1,
				'EstatusPoliza' => $values['EstatusPoliza'],
			);
			$idPoliza = $values['idPoliza'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas("idPoliza", $idPoliza)->update($array_poliza);
			
			//preparo datos para el AWS
			unset(
				$array_poliza['date_created'],
				$array_poliza['date_updated'],
				$array_poliza['NumPoliza'],
				$array_poliza['DireccionFiscal'],
				$array_poliza['Domicilio'],
				$array_poliza['Serial'],
				$array_poliza['created_by'],
				$array_poliza['updated_by']			
				);
			//actualizo en aws 
			$ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Polizas("idPoliza", $idPoliza)->update($array_poliza);			
			
			
			
			
			
			return $q;
			
		}

		public function getCountUserPolizasCompanyByIdPolizas($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("count(*) as cuenta")
			->where("users_Polizas_company.id_Polizas=?",$values['idPoliza'])->fetch();
			return $q; 				
			
		}
		
		public function insertPoliza($array){
			//error_reporting(0);
			//print_r($array);die;
				$ConnectionORM = new ConnectionORM();
				$ConnectionAws = new ConnectionAws();
				$i = 0;
					
					foreach($array as $arr)
					{

						//$ConnectionORM->transaction = "BEGIN";
						//$ConnectionAws->transaction = "BEGIN";
						if(isset($arr['Cedula']) and isset($arr['NumPoliza']) and isset($arr['Seguro']))
						{
							
							$q = $ConnectionORM->getConnect()->Polizas
							->select("*")
							->where("Polizas.cedula=?",$arr['Cedula'])
							->and("Polizas.NumPoliza=?",$arr['NumPoliza'])
							->and("Polizas.Seguro=?",$arr['Seguro'])
							->fetch();
						}

							
						if(!isset($q['idPoliza']) or $q['idPoliza'] =='' or $q['idPoliza'] == null)//si no existe la poliza
						{
							//print_r($arr).$i."<br>";
							//echo "aqui";die;
							//inserto
							$insert_orm = $ConnectionORM->getConnect()->Polizas()->insert($arr);
							@$arr['idPoliza'] = $ConnectionORM->getConnect()->Polizas()->insert_id();//obtengo el idPoliza nuevo
							//quito campos que no estan en el aws
							unset($arr['NumPoliza'],$arr['Domicilio'],$arr['Nacionalidad']);
							$insert_aws = $ConnectionAws->getConnect()->Polizas()->insert($arr);	
						}
						if(isset($q['idPoliza']) and $q['idPoliza'] !='' and $q['idPoliza'] != null)//si existe la poliza
						{
							//actualizo
							$arr['idPoliza'] = $q['idPoliza'];//obtengo el idPoliza que se encuentra almacenado
							$update_orm = $ConnectionORM->getConnect()->Polizas("idPoliza", $q['idPoliza'])->update($arr);
							//quito campos que no estan en el aws
							unset($arr['NumPoliza'],$arr['Domicilio'],$arr['Nacionalidad']);
							$update_aws = $ConnectionAws->getConnect()->Polizas("idPoliza", $q['idPoliza'])->update($arr);

						}
						//$ConnectionORM->transaction = "COMMIT";
						//$ConnectionAws->transaction = "COMMIT";
						$i++;
						//echo $i."<br>";
					}
					//echo "termino";die;
					return true;
		
		}
		public function updatePoliza($array){
			//print_r($array);die;
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas()->insert($array);			
		}
		public function getPolizasByDocumento($values){
			
			$where = " Polizas.cedula = '".$values['Cedula']."' or Polizas.Placa = '".$values['Placa']."'";
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*")
			->where($where)
            ->fetch();
			return $q; 				
			
		}
		public function getLoginPoliza($values){
			
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*")
			->where("Cedula=?",$values['Cedula'])
			->and('Placa=?',$values['Placa'])
            ->fetch();
			return $q; 				
			
		}
		function isVigente($vencimiento) {
			$dateVencida = date_create_from_format('Y-m-d H:i:s', $vencimiento);
			$dateaActual = date_create_from_format('Y-m-d H:i:s', gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			return ($dateaActual < $dateVencida);
		}
	}
	
