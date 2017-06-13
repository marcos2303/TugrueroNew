<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of ServicesOperator
	 *
	 * @author marcos
	 */
	class ServicesOperator {
		
		public function __construct() 
		{
			
		}
		public function getServicesOperatorList($values)
		{	
			$id_user = $values['id_user'];
			$columns = array();
			$columns[0] = 'Gruas.idGrua';
			$columns[1] = 'Cedula';
			$columns[2] = 'Nombre';
			$columns[3] = 'Servicios.IdSolicitud';
			$columns[4] = 'TimeInicio';
			$columns[5] = 'TimeFin';
            $columns[6] = 'EstatusCliente';
            $columns[7] = 'EstatusGrua';
			$columns[8] = 'Motivo';
			$column_order = $columns[4];
			
			$order = 'desc';
			$limit = $values['length'];
			$offset = $values['start'];
			$where = "1 = 1 ";
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""

                                        . "  upper(EstatusGrua) like upper('%$str%')"
										. "  or cast(IdSolicitud as char(100)) =  '$str'"
										. " or upper(Motivo) like upper('%$str%')"										
                                        . "or upper(EstatusCliente) like upper('%$str%')";
			}
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios
			->select("*,DATE_FORMAT(Servicios.TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,DATE_FORMAT(Servicios.TimeFin, '%d/%m/%Y %H:%i:%s') as TimeFin")
			->order("$column_order $order")
			->join("grueros","INNER JOIN Grueros on Grueros.idGrua = Servicios.idGrua")	
			->join("gruas","INNER JOIN Gruas on Gruas.idGrua = Servicios.idGrua")
			->join("solicitudes","INNER JOIN Solicitudes on Solicitudes.idSolicitud = Servicios.idSolicitud")
			->where("Grueros.idGrua=?",$id_user)
			->and("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountServicesOperatorList($values)
		{	
			$id_user = $values['id_user'];
			$where = " 1 = 1";
			
			
			
			
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""

                                        . "  upper(EstatusGrua) like upper('%$str%')"
										. "  or cast(IdSolicitud as char(100)) =  '$str'"
										. " or upper(Motivo) like upper('%$str%')"										
                                        . "or upper(EstatusCliente) like upper('%$str%')";
			}
            $ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios
			->select("count(*) as cuenta")
			->join("grueros","INNER JOIN Grueros on Grueros.idGrua = Servicios.idGrua")
			->join("gruas","INNER JOIN Gruas on Gruas.idGrua = Servicios.idGrua")
			->join("solicitudes","INNER JOIN Solicitudes on Solicitudes.idSolicitud = Servicios.idSolicitud")
			->where("Grueros.idGrua=?",$id_user)
			->fetch();
			return $q['cuenta']; 			
		}
		public function getServicesOperatorById($values){
			$id_user = $values['id_user'];
			$ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Servicios
			->select("*, Grueros.Nombre as nombre_gruero, Grueros.Apellido as apellido_gruero,Grueros.Cedula as cedula_gruero,Grueros.Celular as celular_gruero, Grueros.Placa as placa_gruero, Grueros.Modelo as modelo_gruero, Grueros.Color as color_gruero,DATE_FORMAT(TimeInicio, '%d/%m/%Y %H:%i:%s') as TimeInicio,DATE_FORMAT(TimeFin, '%d/%m/%Y %H:%i:%s') as TimeFin")
			->join("grueros","INNER JOIN Grueros on Grueros.idGrua = Servicios.idGrua")
			->join("solicitudes","INNER JOIN Solicitudes on Solicitudes.idSolicitud = Servicios.idSolicitud")
			->join("polizas","INNER JOIN Polizas on Polizas.idPoliza = Servicios.idPoliza")
			->where("Servicios.idGrua=?",$id_user)
			->and("Servicios.idSolicitud=?",$values['idSolicitud'])
			//print_r($values);echo $q;die;
			->fetch();
			return $q; 				
			
		}
		
	}
	