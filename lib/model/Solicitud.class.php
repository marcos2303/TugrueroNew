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
	class Solicitud {
		
		public function __construct() 
		{
			
		}
		public function buscaPolizas($values) 
		{       $where = '1 = 1';
                       
                        if(isset($values['Placa']) and $values['Placa']!='')
                        {
                            $str = $values['Placa'];
                            $where.= " or upper(Placa) like upper('%$str%')";
                            
                        }
                        if(isset($values['Cedula']) and $values['Cedula']!='')
                        {
                            $str = $values['Cedula'];
                            $where.= " or upper(Cedula) like upper('%$str%')";
                            
                        }
                        if(isset($values['idPoliza']) and $values['idPoliza']!='')
                        {
                            $str = $values['idPoliza'];
                            $where.= " or cast(idPoliza as char(100)) like upper('%$str%')";
                            
                        }
                        if(isset($values['NumPoliza']) and $values['NumPoliza']!='')
                        {
                            $str = $values['NumPoliza'];
                            $where.= " or upper(NumPoliza) like upper('%$str%')";
                            
                        }
                
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas
			->select("*,DATE_FORMAT(Vencimiento, '%d/%m/%Y') as Vencimiento")
			->where($where);
			return $q;   
			
		}
		public function getSolicitudesActivasList($values)
		{	
			$columns = array();
			$columns[0] = 'Solicitudes.idSolicitud';
			$columns[1] = 'Solicitudes.idPoliza';
			$columns[2] = 'Solicitudes.Proviene';
			$columns[3] = 'pol.Cedula';
            $columns[4] = 'pol.Placa';
			$columns[5] = 'Estatus';
            $columns[6] = 'EstatusCliente';
            $columns[7] = 'EstatusGrua';
			$columns[8] = 'TimeOpen';
			$columns[9] = 'TimeInicio';
			$column_order = $columns[0];
			$where = " Estatus NOT IN('Completado','Cancelado') 
						AND (EstatusCliente IS NULL OR EstatusCliente = 'Asignado' OR EstatusCliente = 'Activo' OR EstatusCliente = 'Asistido' OR EstatusCliente = 'Completado' OR EstatusCliente = 'Abandonado') 
						AND (EstatusGrua  IS NULL OR EstatusGrua = 'Asignado' OR EstatusGrua = 'Activo' OR EstatusGrua = 'Asistiendo' OR EstatusGrua = 'Abandonado')  ";
			$order = 'desc';
			$limit = $values['length'];
			$offset = $values['start'];
			/*if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where.= " upper(pol.Cedula) like upper('%$str%')"
                    . "OR upper(pol.Placa) like upper('%".$str."%')"
					. "OR upper(Estatus) like upper('%".$str."%')"
					. "OR upper(EstatusCliente) like upper('%".$str."%')"
					. "OR upper(EstatusGrua) like upper('%".$str."%')"
					. "OR upper(EstatusGrua) like upper('%".$str."%')";
			}*/
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND Solicitudes.idSolicitud = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(pol.idPoliza) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Proviene) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Cedula) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Placa) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Estatus) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND upper(EstatusCliente) like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(EstatusGrua) like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(TimeOpen, '%d/%m/%Y %H:%i:%s') = '".$values['columns'][8]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') = '".$values['columns'][9]['search']['value']."'";
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
                        $ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes
			->select("*,Solicitudes.idSolicitud as idSolicitud,DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,DATE_FORMAT(TimeFin, '%d/%m/%Y') as TimeFin,DATE_FORMAT(TimeOpen, '%d/%m/%Y %H:%i:%s') as TimeOpen,DATE_FORMAT(LastStatusSolicitud, '%d/%m/%Y %H:%i:%s') as LastStatusSolicitud,DATE_FORMAT(LastStatusSolicitud, '%d-%m-%Y %H:%i:%s') as LastStatusSolicitudn,DATE_FORMAT(LastStatusGrua, '%d/%m/%Y %H:%i:%s') as LastStatusGrua,DATE_FORMAT(LastStatusGrua, '%d-%m-%Y %H:%i:%s') as LastStatusGruan")
			->join('Servicios','LEFT JOIN Servicios ser ON ser.idSolicitud = Solicitudes.idSolicitud')
            ->join('Polizas','INNER JOIN Polizas pol ON pol.idPoliza = Solicitudes.idPoliza')
            ->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountSolicitudesActivasList($values)
		{	
			$where = " Estatus NOT IN('Completado','Cancelado') 
						AND (EstatusCliente IS NULL OR EstatusCliente = 'Asignado' ) 
						AND (EstatusGrua  IS NULL OR EstatusGrua = 'Asignado' )  ";
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where.=" ";
			}
            $ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes
			->select("count(*) as cuenta")
			->join('Servicios','LEFT JOIN Servicios ser ON ser.idSolicitud = Solicitudes.idSolicitud')
            ->join('Polizas','INNER JOIN Polizas pol ON pol.idPoliza = Solicitudes.idPoliza')
			->where("$where")
                        ->fetch();    
			return $q['cuenta']; 			
		}
		function updateStatusDesierto($values){			

 			$idSolicitud =  $values['idsolicitud'];
			$array_solicitud = array(
				'Estatus' => 'Desierto'
			);
			
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;
			
		}
		public function getGruerosOnline(){
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Gruas
			->select("*,DATE_FORMAT(LastUpdate, '%d/%m/%Y %H:%i:%s') as lastupdate")
			->join("Grueros","INNER JOIN Grueros on Grueros.idGrua = Gruas.idGrua");
			//->where("Disponible=?","SI");
			return $q; 				
			
		}
		public function getDatosSolicitud($values){
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes
			->select("*,Solicitudes.Direccion as direccion,Solicitudes.idSolicitud as idSolicitud,"
                                . "DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,"
                                . "DATE_FORMAT(TimeFin, '%d/%m/%Y') as TimeFin,"
                                . "DATE_FORMAT(TimeOpen, '%d/%m/%Y %H:%i:%s') as TimeOpen,"
                                . "Solicitudes.latOrigen as latOrigen,Solicitudes.lngOrigen as lngOrigen,"
                                . "Solicitudes.latDestino as latDestino,Solicitudes.lngDestino as lngDestino,"
                                . "DATE_FORMAT(LastStatusSolicitud, '%d/%m/%Y %H:%i:%s') as LastStatusSolicitud,"
                                . "DATE_FORMAT(LastStatusSolicitud, '%d-%m-%Y %H:%i:%s') as LastStatusSolicitudn,"
                                . "DATE_FORMAT(LastStatusGrua, '%d/%m/%Y %H:%i:%s') as LastStatusGrua,"
                                . "DATE_FORMAT(LastStatusGrua, '%d-%m-%Y %H:%i:%s') as LastStatusGruan,"
                                . "gr.Latitud as latGrua,gr.Longitud as lngGrua,"
                                . "pol.Nombre as NombreCliente, pol.Apellido as ApellidoCliente, pol.Placa as PlacaCliente, pol.Cedula as CedulaCliente,"
                                . "grs.Nombre as NombreGruero, grs.Apellido as ApellidoGruero, grs.Placa as PlacaGruero, grs.Cedula as CedulaGruero")
						->join('Servicios','LEFT JOIN Servicios ser ON ser.idSolicitud = Solicitudes.idSolicitud')
                        ->join('Gruas','LEFT JOIN Gruas gr ON gr.idGrua = ser.idGrua')
                        ->join('Grueros','LEFT JOIN Grueros grs ON grs.idGrua = gr.idGrua')
                        ->join('Polizas','INNER JOIN Polizas pol ON pol.idPoliza = Solicitudes.idPoliza')
						->where("Solicitudes.idSolicitud=?",$values['idSolicitud'])
			->fetch();
			return $q; 				
			
		}
		public function getDatosSolicitudesActivas($values){
			$where = " Estatus NOT IN('Completado','Cancelado') 
						AND (EstatusCliente IS NULL OR EstatusCliente = 'Asignado' OR EstatusCliente = 'Activo' OR EstatusCliente = 'Asistido' OR EstatusCliente = 'Completado') 
						AND (EstatusGrua  IS NULL OR EstatusGrua = 'Asignado' OR EstatusGrua = 'Activo' OR EstatusGrua = 'Asistiendo')  ";

            $ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes
			->select("*,Solicitudes.Direccion as direccion,Solicitudes.idSolicitud as idSolicitud,"
                                . "DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,"
                                . "DATE_FORMAT(TimeFin, '%d/%m/%Y') as TimeFin,"
                                . "DATE_FORMAT(TimeOpen, '%d/%m/%Y %H:%i:%s') as TimeOpen,"
                                . "Solicitudes.latOrigen as latOrigen,Solicitudes.lngOrigen as lngOrigen,"
                                . "Solicitudes.latDestino as latDestino,Solicitudes.lngDestino as lngDestino,"
                                . "DATE_FORMAT(LastStatusSolicitud, '%d/%m/%Y %H:%i:%s') as LastStatusSolicitud,"
                                . "DATE_FORMAT(LastStatusSolicitud, '%d-%m-%Y %H:%i:%s') as LastStatusSolicitudn,"
                                . "DATE_FORMAT(LastStatusGrua, '%d/%m/%Y %H:%i:%s') as LastStatusGrua,"
                                . "DATE_FORMAT(LastStatusGrua, '%d-%m-%Y %H:%i:%s') as LastStatusGruan,"
                                . "gr.Latitud as latGrua,gr.Longitud as lngGrua,"
                                . "pol.Nombre as NombreCliente, pol.Apellido as ApellidoCliente, pol.Placa as PlacaCliente, pol.Cedula as CedulaCliente,"
                                . "grs.Nombre as NombreGruero, grs.Apellido as ApellidoGruero, grs.Placa as PlacaGruero, grs.Cedula as CedulaGruero")
			->join('Servicios','LEFT JOIN Servicios ser ON ser.idSolicitud = Solicitudes.idSolicitud')
                        ->join('Gruas','LEFT JOIN Gruas gr ON gr.idGrua = ser.idGrua')
                        ->join('Grueros','LEFT JOIN Grueros grs ON grs.idGrua = gr.idGrua')
                        ->join('Polizas','INNER JOIN Polizas pol ON pol.idPoliza = Solicitudes.idPoliza')
			->where("$where");
			return $q; 				
			
		}
		public function updateEstatusSolicitud($values){
			
			$idSolicitud = $values['idSolicitud'];
			$array_solicitud = array(
				"Estatus" => $values['estatus_cambiar']
			);
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;			
			
		}
		public function updateEstatusServicioCliente($values){
			
			$idSolicitud = $values['idSolicitud'];
			$array_solicitud = array(
				"EstatusCliente" => $values['estatuscliente_cambiar']
			);
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;			
			
		}
		public function updateEstatusServicioGrua($values){


			$idSolicitud = $values['idSolicitud'];
			$array_solicitud = array(
				"EstatusGrua" => $values['estatusgrua_cambiar']
			);
			if($values['estatusgrua_cambiar'] == 'Completado')
			{
				$array_solicitud["TimeFin"] =  date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			}
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;			
			
		}
		public function insertServicio($values){
			$hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$idSolicitud = $values['idSolicitud'];
			$array = array(
				"idSolicitud" => $idSolicitud,
				"idPoliza" => $values['idPoliza'],
				"idGrua" => $values['idGrua'],
				"TimeInicio" => $hora
				
			);
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios()->insert($array);


			//actualizo el status de la solicitud a asignado
			$array_solicitud = array(
				"Estatus" => "Asignado"
			);			
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes("idSolicitud", $idSolicitud)->update($array_solicitud);
		}
		
		public function getGruerosList($values){
			$columns = array();
			$columns[0] = 'Grueros.idGrua';
			$columns[1] = 'Grueros.Cedula';
			$columns[2] = 'Grueros.Nombre';
			$columns[3] = 'Grueros.Apellido';
            $columns[4] = 'Grueros.Placa';
			$columns[5] = 'Grueros.Modelo';
            $columns[6] = 'Grueros.Color';
            $columns[7] = 'Grueros.Celular';
			$columns[8] = 'gr.Disponible';
			$columns[9] = 'gr.zone_work';
			$columns[10] = 'gr.location';
			
			$column_order = $columns[0];
			$where = "1 =1  ";
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND Grueros.idGrua = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Cedula) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Nombre) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Apellido) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Placa) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Modelo) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Color) like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Celular) like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(gr.Disponible) like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND upper(zone_work) like ('%".$values['columns'][9]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
			{
				$where.=" AND upper(location) like ('%".$values['columns'][10]['search']['value']."%')";
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
			//echo $where;die;
            $ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Grueros
			->select("*")
			->join('Gruas','LEFT JOIN Gruas gr ON gr.idGrua= Grueros.idGrua')
                        ->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
                        //echo $q;die;
			return $q; 				
			
		}
		public function getCountGruerosList($values)
		{	
			$where = " 1 = 1";
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND Grueros.idGrua = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Cedula) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Nombre) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Apellido) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Placa) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Modelo) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Color) like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(Grueros.Celular) like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(gr.Disponible) like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND upper(zone_work) like ('%".$values['columns'][9]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
			{
				$where.=" AND upper(location) like ('%".$values['columns'][10]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
            $ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Grueros
			->select("count(*) as cuenta")
			->join('Gruas','LEFT JOIN Gruas gr ON gr.idGrua= Grueros.idGrua')
			->where("$where")->fetch();    
			return $q['cuenta']; 			
		}
		function updateMonto($values){			

 			$idSolicitud =  $values['idSolicitud'];
			$array_solicitud = array(
				'Monto' => $values['MontoNuevo'],
				'MontoAnterior' => $values['Monto'],
				'MotivoMonto' => $values['MotivoMonto'],
			);
			
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;
			
		}
		function updateMontoFinal($values){			

 			$idSolicitud =  $values['idSolicitud'];
			$array_solicitud = array(
                                'Utilidad' => $values['utilidad'],
				'MontoFinal' => $values['MontoFinal'],
			);
			
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;
			
		}
		function updateMontoTaxi($values){			

 			$idSolicitud =  $values['idSolicitud'];
			$array_solicitud = array(
				'MontoTaxi' => $values['MontoTaxi'],
			);
			
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes("idSolicitud", $idSolicitud)->update($array_solicitud);
			return $q;
			
		}
		public function getSolicitudesServiciosList($values)
		{	
			
			$columns = array();
			$columns[0] = 'Solicitudes.idSolicitud';
			$columns[1] = 'Polizas.idPoliza';
			$columns[2] = 'Polizas.Cedula';
			$columns[3] = 'Polizas.Nombre';
			$columns[4] = 'Polizas.Placa';
			$columns[5] = 'Polizas.Modelo';
			$columns[6] = 'Seguro';
			$columns[7] = 'EstadoOrigen';
			$columns[8] = 'Direccion';
            $columns[9] = 'MontoTaxi';
            $columns[10] = 'MontoFinal';
			$columns[11] = 'Utilidad';
			$columns[12] = 'MontoFinal';
            $columns[13] = 'TimeOpen';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND Solicitudes.idSolicitud = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
 			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND Solicitudes.idPoliza = ".$values['columns'][1]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Polizas.Cedula) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}					
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(CONCAT(Polizas.Nombre, ' ', Polizas.Apellido )) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Polizas.Modelo)  like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND upper(Seguro)  like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}								
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(EstadoOrigen)  like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}				
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(Direccion)  like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			/*if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND upper(MontoTaxi)  like ('%".$values['columns'][9]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
			{
				$where.=" AND upper(MontoFinal)  like ('%".$values['columns'][10]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][11]['search']['value']) and $values['columns'][11]['search']['value']!='')
			{
				$where.=" AND TimeOpen ='".$values['columns'][11]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}*/
			if(isset($values['columns'][13]['search']['value']) and $values['columns'][13]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(Solicitudes.TimeOpen, '%d/%m/%Y %H:%i:%s') ='".$values['columns'][13]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
            $Utilitarios = new Utilitarios();
			if($values['desde']!='')
			{					
                            $values['desde'] = $Utilitarios->formatFechaInput($values['desde']);
			}
			if($values['hasta']!='')
			{
                            $values['hasta'] = $Utilitarios->formatFechaInput($values['hasta']);	
			}
			//echo $values['desde'].$values['hasta'];die;
			
			if($values['desde']!='')
			{
				$where.=" AND Solicitudes.TimeOpen >= '".$values['desde']." 00:00:00' ";
			}
			if($values['hasta']!='')
			{
				$where.=" AND Solicitudes.TimeOpen <= '".$values['hasta']." 24:59:59'";
			}
			if(isset($values['EstatusGrua']) and $values['EstatusGrua']!='')
			{
				$where.=" AND upper(EstatusGrua) like ('%".$values['EstatusGrua']."%')";
			} 
			if(isset($values['EstatusCliente']) and $values['EstatusCliente']!='')
			{
				$where.=" AND upper(EstatusCliente) like ('%".$values['EstatusCliente']."%')";
			}                         
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
                        $ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect('tugruero')->Solicitudes
			->select("*,CONCAT(Polizas.Nombre, ' ', Polizas.Apellido ) as cliente, Polizas.Modelo as Modelo, Polizas.Cedula as Cedula, Polizas.Placa as Placa,DATE_FORMAT(TimeOpen, '%d/%m/%Y %H:%i:%s') as TimeOpen")
			->join("Servicios","INNER JOIN Servicios on Servicios.idSolicitud = Solicitudes.idSolicitud")
			->join("Polizas","INNER JOIN Polizas on Polizas.idPoliza = Solicitudes.idPoliza")
			->join("Grueros","INNER JOIN Grueros on Grueros.idGrua= Servicios.idGrua")
                        ->where("$where")
                        ->order("$column_order $order")			
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountSolicitudesServiciosList($values)
		{	
			$where = '1 = 1';
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND Solicitudes.idSolicitud = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
 			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND Solicitudes.idPoliza = ".$values['columns'][1]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Polizas.Cedula) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}					
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(CONCAT(Polizas.Nombre, ' ', Polizas.Apellido )) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Polizas.Modelo)  like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND upper(Seguro)  like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}								
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(EstadoOrigen)  like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}				
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(Direccion)  like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			/*if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND upper(MontoTaxi)  like ('%".$values['columns'][9]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
			{
				$where.=" AND upper(MontoFinal)  like ('%".$values['columns'][10]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][11]['search']['value']) and $values['columns'][11]['search']['value']!='')
			{
				$where.=" AND TimeOpen ='".$values['columns'][11]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}*/
			if(isset($values['columns'][13]['search']['value']) and $values['columns'][13]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(Solicitudes.TimeOpen, '%d/%m/%Y %H:%i:%s') ='".$values['columns'][13]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}            $Utilitarios = new Utilitarios();
    			if($values['desde']!='')
			{					
                            $values['desde'] = $Utilitarios->formatFechaInput($values['desde']);
			}
			if($values['hasta']!='')
			{
                            $values['hasta'] = $Utilitarios->formatFechaInput($values['hasta']);	
			}
			//echo $values['desde'].$values['hasta'];die;
			
			if($values['desde']!='')
			{
				$where.=" AND Solicitudes.TimeOpen >= '".$values['desde']." 00:00:00' ";
			}
			if($values['hasta']!='')
			{
				$where.=" AND Solicitudes.TimeOpen <= '".$values['hasta']." 24:59:59'";
			}
			
			if(isset($values['columns'][11]['search']['value']) and $values['columns'][11]['search']['value']!='')
			{
				$where.=" AND TimeOpen ='".$values['columns'][11]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['EstatusGrua']) and $values['EstatusGrua']!='')
			{
				$where.=" AND upper(EstatusGrua) like ('%".$values['EstatusGrua']."%')";
			} 
			if(isset($values['EstatusCliente']) and $values['EstatusCliente']!='')
			{
				$where.=" AND upper(EstatusCliente) like ('%".$values['EstatusCliente']."%')";
			} 
            $ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Solicitudes
			->select("count(*) as cuenta")
			->join("Servicios","INNER JOIN Servicios on Servicios.idSolicitud = Solicitudes.idSolicitud")
			->join("Polizas","INNER JOIN Polizas on Polizas.idPoliza = Solicitudes.idPoliza")
			->join("Grueros","INNER JOIN Grueros on Grueros.idGrua= Servicios.idGrua")
			->where("$where")
                        ->fetch();
			return $q['cuenta']; 			
		}
		public function getSolicitudesServiciosListPDF($values)
		{	
			
			//print_r($values);die;
			$where = '1 = 1';
			
			if(isset($values['field_0']) and $values['field_0']!='')
			{
				$where.=" AND Solicitudes.idSolicitud = '".$values['field_0']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_1']) and $values['field_1']!='')
			{
				$where.=" AND Solicitudes.idPoliza = '".$values['field_1']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_2']) and $values['field_2']!='')
			{
				$where.=" AND upper(Polizas.Cedula) like ('%".$values['field_2']."%')";
			}
			if(isset($values['field_3']) and $values['field_3']!='')
			{
				$where.=" AND upper(CONCAT(Polizas.Nombre, ' ', Polizas.Apellido )) like ('%".$values['field_3']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_4']) and $values['field_4']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['field_4']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_5']) and $values['field_5']!='')
			{
				$where.=" AND upper(Polizas.Modelo) like ('%".$values['field_5']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_6']) and $values['field_6']!='')
			{
				$where.=" AND upper(Polizas.Seguro) like ('%".$values['field_6']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_7']) and $values['field_7']!='')
			{
				$where.=" AND upper(EstadoOrigen) like ('%".$values['field_7']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_8']) and $values['field_8']!='')
			{
				$where.=" AND upper(Direccion) like ('%".$values['field_8']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			/*if(isset($values['field_9']) and $values['field_9']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['field_9']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_10']) and $values['field_10']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['field_10']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_11']) and $values['field_11']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['field_11']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_12']) and $values['field_12']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['field_12']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}*/
			if(isset($values['field_13']) and $values['field_13']!='')
			{
				$where.=" AND DATE_FORMAT(Solicitudes.TimeOpen, '%d/%m/%Y %H:%i:%s') <= '".$values['field_13']." 24:59:59'";
				//echo $values['columns'][0]['search']['value'];die;
			}
            $Utilitarios = new Utilitarios();
    			if($values['desde']!='')
			{					
                            $values['desde'] = $Utilitarios->formatFechaInput($values['desde']);
			}
			if($values['hasta']!='')
			{
                            $values['hasta'] = $Utilitarios->formatFechaInput($values['hasta']);	
			}
			//echo $values['desde'].$values['hasta'];die;
			
			if($values['desde']!='')
			{
				$where.=" AND Solicitudes.TimeOpen >= '".$values['desde']." 00:00:00' ";
			}
			if($values['hasta']!='')
			{
				$where.=" AND Solicitudes.TimeOpen <= '".$values['hasta']." 24:59:59'";
			}
			if(isset($values['EstatusGrua']) and $values['EstatusGrua']!='')
			{
				$where.=" AND upper(EstatusGrua) like ('%".$values['EstatusGrua']."%')";
			} 
			if(isset($values['EstatusCliente']) and $values['EstatusCliente']!='')
			{
				$where.=" AND upper(EstatusCliente) like ('%".$values['EstatusCliente']."%')";
			}  

			
            $ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect('tugruero')->Solicitudes
			->select("*,CONCAT(Polizas.Nombre, ' ', Polizas.Apellido ) as cliente, Polizas.Modelo as Modelo, Polizas.Cedula as Cedula, Polizas.Placa as Placa,DATE_FORMAT(TimeOpen, '%d/%m/%Y %H:%i:%s') as TimeOpen")
			->join("Servicios","INNER JOIN Servicios on Servicios.idSolicitud = Solicitudes.idSolicitud")
			->join("Polizas","INNER JOIN Polizas on Polizas.idPoliza = Solicitudes.idPoliza")
			->join("Grueros","INNER JOIN Grueros on Grueros.idGrua= Servicios.idGrua")
            ->where("$where")
            ->order("TimeOpen");
			//echo $q;die;
			return $q; 			
		}
		public function getSolicitudesServiciosTaxiListPDF($values)
		{	
			
			//print_r($values);die;
			$where = '1 = 1';
			
			if(isset($values['field_0']) and $values['field_0']!='')
			{
				$where.=" AND Solicitudes.idSolicitud = '".$values['field_0']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_1']) and $values['field_1']!='')
			{
				$where.=" AND Solicitudes.idPoliza = '".$values['field_1']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_2']) and $values['field_2']!='')
			{
				$where.=" AND upper(Polizas.Cedula) like ('%".$values['field_2']."%')";
			}
			if(isset($values['field_3']) and $values['field_3']!='')
			{
				$where.=" AND upper(CONCAT(Polizas.Nombre, ' ', Polizas.Apellido )) like ('%".$values['field_3']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_4']) and $values['field_4']!='')
			{
				$where.=" AND upper(Polizas.Placa) like ('%".$values['field_4']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_5']) and $values['field_5']!='')
			{
				$where.=" AND upper(Polizas.Modelo) like ('%".$values['field_5']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_6']) and $values['field_6']!='')
			{
				$where.=" AND upper(Polizas.Seguro) like ('%".$values['field_6']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_7']) and $values['field_7']!='')
			{
				$where.=" AND upper(EstadoOrigen) like ('%".$values['field_7']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_8']) and $values['field_8']!='')
			{
				$where.=" AND upper(Direccion) like ('%".$values['field_8']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['field_13']) and $values['field_13']!='')
			{
				$where.=" AND DATE_FORMAT(Solicitudes.TimeOpen, '%d/%m/%Y %H:%i:%s') <= '".$values['field_13']." 24:59:59'";
				//echo $values['columns'][0]['search']['value'];die;
			}
            $Utilitarios = new Utilitarios();
    			if($values['desde']!='')
			{					
                            $values['desde'] = $Utilitarios->formatFechaInput($values['desde']);
			}
			if($values['hasta']!='')
			{
                            $values['hasta'] = $Utilitarios->formatFechaInput($values['hasta']);	
			}
			//echo $values['desde'].$values['hasta'];die;
			
			if($values['desde']!='')
			{
				$where.=" AND Solicitudes.TimeOpen >= '".$values['desde']." 00:00:00' ";
			}
			if($values['hasta']!='')
			{
				$where.=" AND Solicitudes.TimeOpen <= '".$values['hasta']." 24:59:59'";
			}

            $ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect('tugruero')->Solicitudes
			->select("count(*) as cuenta")
			->join("Servicios","INNER JOIN Servicios on Servicios.idSolicitud = Solicitudes.idSolicitud")
			->join("Polizas","INNER JOIN Polizas on Polizas.idPoliza = Solicitudes.idPoliza")
			->join("Grueros","INNER JOIN Grueros on Grueros.idGrua= Servicios.idGrua")
            ->where("$where and MontoTaxi >0")
            ->order("TimeOpen")->fetch();
			
			return $q['cuenta'];
		}		
		
		
	}
	