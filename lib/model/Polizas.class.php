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
		public $IdPoliza;

		function getIdPoliza() {
		  return $this->IdPoliza;
		}

		function setIdPoliza($IdPoliza) {
		  $this->IdPoliza = $IdPoliza;
		}
		public function __construct()
		{

		}
		public function getPolizasList($values)
		{
			$columns = array();
			$columns[0] = 'IdPoliza';
			$columns[1] = 'Placa';
			$columns[2] = 'Cedula';
			$columns[3] = 'Nombres';
			$columns[4] = 'Apellidos';
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
					. "OR upper(Nombres) like upper('%".$str."%')"
					. "OR upper(NumPoliza) like upper('%".$str."%')"
					. "OR upper(Apellidos) like upper('%".$str."%')"
					. "OR upper(Seguro) like upper('%".$str."%')";
			}

			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND IdPoliza = ".$values['columns'][0]['search']['value']."";
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
				$where.=" AND CONCAT(upper(Nombres),' ',upper(Apellidos) ) like ('%".$values['columns'][5]['search']['value']."%')";
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
			->where("IdPoliza=?",$values['IdPoliza'])->fetch();
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
			$q = $ConnectionORM->getConnect()->Polizas("IdPoliza", $id)->delete();


		}
		function addPoliza($values){
		  $array = array(
			'IdSeguro' => $values['IdSeguro'],
			'IdEstado' => $values['IdEstado'],
			'IdMarca' => $values['IdMarca'],
			'NumPoliza' => $values['NumPoliza'],
			'Placa' => $values['Placa'],
			'Cedula' => $values['Cedula'],
			'Nombres' => $values['Nombres'],
			'Apellidos' => $values['Apellidos'],
			'Modelo' => $values['Modelo'],
			'Clase' => $values['Clase'],
			'IdVehiculoTipo' => $values['IdVehiculoTipo'],
			'Color' => $values['Color'],
			'Anio' => $values['Anio'],
			'Serial' => $values['Serial'],
			'Domicilio' => $values['Domicilio'],
			'DireccionFiscal' => $values['DireccionFiscal'],
			'DesdeVigencia' => $values['DesdeVigencia'],
			'Vencimiento' => $values['Vencimiento'],
			'FechaCreado' => date('Y-m-d h:i:s'),
			'CreadoPor' => $_SESSION['IdUsuario'],
			'Celular' => $values['Celular'],
			'Email' => $values['Email'],
			'Estatus' => $values['Estatus'],
		  );
		  $ConnectionORM = new ConnectionORM();
		  $q = $ConnectionORM->getConnect()->Polizas()->insert($array);
		  $this->SetIdPoliza($ConnectionORM->getConnect()->Polizas()->insert_id());
		  return $q;
		}
		function updatePolizas($values){

			$array = array();
			if(count($values)>0){
			  foreach($values as $key => $val){
				if(strlen($val)>0){
				  $array[$key] = $val;
				}
			  }
			}
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas("IdPoliza", $values['IdPoliza'])->update($array);
			return $q;

		}

		public function getCountUserPolizasCompanyByIdPolizas($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("count(*) as cuenta")
			->where("users_Polizas_company.id_Polizas=?",$values['IdPoliza'])->fetch();
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


						if(!isset($q['IdPoliza']) or $q['IdPoliza'] =='' or $q['IdPoliza'] == null)//si no existe la poliza
						{
							//print_r($arr).$i."<br>";
							//echo "aqui";die;
							//inserto
							$insert_orm = $ConnectionORM->getConnect()->Polizas()->insert($arr);
							@$arr['IdPoliza'] = $ConnectionORM->getConnect()->Polizas()->insert_id();//obtengo el IdPoliza nuevo
							//quito campos que no estan en el aws
							unset($arr['NumPoliza'],$arr['Domicilio'],$arr['Nacionalidad']);
							$insert_aws = $ConnectionAws->getConnect()->Polizas()->insert($arr);
						}
						if(isset($q['IdPoliza']) and $q['IdPoliza'] !='' and $q['IdPoliza'] != null)//si existe la poliza
						{
							//actualizo
							$arr['IdPoliza'] = $q['IdPoliza'];//obtengo el IdPoliza que se encuentra almacenado
							$update_orm = $ConnectionORM->getConnect()->Polizas("IdPoliza", $q['IdPoliza'])->update($arr);
							//quito campos que no estan en el aws
							unset($arr['NumPoliza'],$arr['Domicilio'],$arr['Nacionalidad']);
							$update_aws = $ConnectionAws->getConnect()->Polizas("IdPoliza", $q['IdPoliza'])->update($arr);

						}
						//$ConnectionORM->transaction = "COMMIT";
						//$ConnectionAws->transaction = "COMMIT";
						$i++;
						//echo $i."<br>";
					}
					//echo "termino";die;
					return true;

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

			if(isset($values['IdPoliza']) and $values['IdPoliza']!=''){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*")
			->where("IdPoliza=?",strtoupper($values['IdPoliza']))
			->fetch();	
			}else{
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*")
			->where("upper(Cedula)=?",strtoupper($values['Cedula']))
			->and('upper(Placa)=?',strtoupper($values['Placa']))
			->fetch();
			}

			return $q;

		}
		function isVigente($vencimiento) {
			$dateVencida = date_create_from_format('Y-m-d H:i:s', $vencimiento);
			$dateaActual = date_create_from_format('Y-m-d H:i:s', gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			return ($dateaActual < $dateVencida);
		}
	}
