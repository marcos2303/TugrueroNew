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
	class ServiciosClientes {
		
		public function __construct() 
		{
			
		}
		public function getServiciosClientesList($values)
		{	
			$columns = array();
			$columns[0] = 'Servicios.idSolicitud';
			$columns[1] = 'sol.EstadoOrigen';
			$columns[2] = 'sol.Direccion';
			$columns[3] = 'TimeInicio';
            $columns[4] = 'TimeFin';
            $columns[5] = 'gr.Cedula';
			$columns[6] = 'gr.Nombre';
			$columns[7] = 'EstatusCliente';
			$columns[8] = 'EstatusGrua';
			$columns[9] = 'queocurre';
			$column_order = $columns[0];
			$where = ' sol.IdPoliza = '.$values['idPoliza'];
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			/*if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where.= " and ( upper(gr.Nombre) like upper('%$str%')"
					. "OR upper(gr.Cedula) like upper('%".$str."%')"
					. "OR upper(sol.EstadoOrigen) like upper('%".$str."%')"
					. "OR upper(sol.Direccion) like upper('%".$str."%')"
					. "OR upper(EstatusCliente) like upper('%".$str."%')"
					. "OR upper(EstatusGrua) like upper('%".$str."%')"
					. "OR upper(Monto) like upper('%".$str."%'))";
			}*/
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND sol.idSolicitud = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(EstadoOrigen) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Direccion) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(TimeInicio, '%d/%m/%Y') = '".$values['columns'][3]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(TimeFin, '%d/%m/%Y') = '".$values['columns'][4]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(gr.Cedula) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(gr.Nombre),' ',upper(gr.Apellido )) like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(EstatusCliente) like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(EstatusGrua) like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND upper(queocurre) like ('%".$values['columns'][9]['search']['value']."%')";
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
			$q = $ConnectionAws->getConnect()->Servicios
			->select("*,DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,DATE_FORMAT(TimeFin, '%d/%m/%Y %H:%i:%s') as TimeFin, CONCAT(pol.Nombre, ' ', pol.Apellido) AS cliente")
			->join('Solicitud','INNER JOIN Solicitudes sol ON sol.idSolicitud = Servicios.idSolicitud')
			->join('Grueros','INNER JOIN Grueros gr ON Servicios.idGrua = gr.idGrua')
			->join('Polizas','INNER JOIN Polizas pol ON pol.idPoliza= sol.idPoliza')
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountServiciosClientesList($values)
		{	
			$where = ' sol.IdPoliza = '.$values['idPoliza'];
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND sol.idSolicitud = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(EstadoOrigen) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Direccion) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(TimeInicio, '%d/%m/%Y') = '".$values['columns'][3]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND DATE_FORMAT(TimeFin, '%d/%m/%Y') = '".$values['columns'][4]['search']['value']."'";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(gr.Cedula) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND CONCAT(upper(gr.Nombre),' ',upper(gr.Apellido )) like ('%".$values['columns'][6]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(EstatusCliente) like ('%".$values['columns'][7]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}	
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(EstatusGrua) like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
				$where.=" AND upper(queocurre) like ('%".$values['columns'][9]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}				
			
			
            $ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios
			->select("count(*) as cuenta")
			->join('Solicitud','INNER JOIN Solicitudes sol ON sol.idSolicitud = Servicios.idSolicitud')
			->join('Grueros','INNER JOIN Grueros gr ON Servicios.idGrua = gr.idGrua')
			->join('Polizas','INNER JOIN Polizas pol ON pol.idPoliza= sol.idPoliza')
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getServiciosClientesById($values){
			$ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios
			->select("*, Grueros.Nombre as nombre_gruero, Grueros.Apellido as apellido_gruero,Grueros.Cedula as cedula_gruero,Grueros.Celular as celular_gruero, Grueros.Placa as placa_gruero, Grueros.Modelo as modelo_gruero, Grueros.Color as color_gruero,DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,DATE_FORMAT(TimeFin, '%d/%m/%Y %H:%i:%s') as TimeFin")
			->join("grueros","INNER JOIN Grueros on Grueros.idGrua = Servicios.idGrua")
			->join("solicitudes","INNER JOIN Solicitudes on Solicitudes.idSolicitud = Servicios.idSolicitud")
			->join("polizas","INNER JOIN Polizas on Polizas.idPoliza = Servicios.idPoliza")
			->where("Servicios.idSolicitud=?",$values['idSolicitud'])
			->fetch();
			return $q; 				
			
		}		
	}
	