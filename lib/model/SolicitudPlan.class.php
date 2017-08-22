<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of SolicitudPlans
	 *
	 * @author marcos
	 */
	class SolicitudPlan {
		
		public function __construct() 
		{
			
		}
		public function getSolicitudPlanListSelect(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
		public function getSolicitudPlanListSelect2(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("*")
			->order('name');
			
			return $q; 				
			
		}
		public function getSolicitudPlanList($values)
		{
                $Utilitarios = new Utilitarios();
			$columns = array();
			$columns[0] = 'SolicitudPlan.idSolicitudPlan';
			$columns[1] = 'SolicitudPlan.Nombres';
			$columns[2] = 'SolicitudPlan.Apellidos';
                        $columns[3] = 'SolicitudPlan.Cedula';
                        $columns[4] = 'SolicitudPlan.Rif';
                        $columns[5] = "CONCAT
				((
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				),' / ',
				(	
					SELECT CONCAT(Nombre, ' ',Puestos, ' Puestos' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				))";
                        $columns[6] = "(SELECT  SUM(PrecioConIva) 
					FROM SolicitudPlanSeleccion sps 
					RIGHT JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)";
                        $columns[7] = "(CASE WHEN TipoPago = 'TDC' THEN 'Tarjeta de crédito' ELSE 'Depósito o Transferencia')";

                        $columns[8] = "(CASE 
					WHEN Estatus = 'ENV' 
					THEN 'EN PROCESO DE VALIDACIÓN DE PAGO' 
					WHEN Estatus = 'ACT'
					THEN 'PLAN PAGADO'
					WHEN Estatus = 'REC'
					THEN 'RECHAZADO'
					END)";
                        $columns[9] = "(DATE_FORMAT(FechaSolicitud, '%d/%m/%Y'))";
                        $columns[10] = "pv.NombreVendedor ";
                        $column_order = $columns[0];
			$where = "1 = 1 and PagoRealizado = 'S'";
			$order = 'desc';
			$limit = $values['length'];
			$offset = $values['start'];
			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND SolicitudPlan.idSolicitudPlan = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Nombres) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Apellidos) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}					
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Cedula) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Rif) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(CONCAT
				((
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				),
				CASE WHEN(	
					SELECT CONCAT(Nombre, ' ',Puestos, ' Puestos' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				) IS NULL THEN '' ELSE (SELECT CONCAT(' / ',Nombre, ' ',Puestos, ' Puestos' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)
				

				END)) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND ((SELECT  SUM(PrecioConIva) 
					FROM SolicitudPlanSeleccion sps 
					RIGHT JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)) >= '".$values['columns'][6]['search']['value']."' ";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(CASE WHEN TipoPago = 'TDC' THEN 'Tarjeta de crédito' ELSE 'Depósito o Transferencia' END) like UPPER(('%".$values['columns'][7]['search']['value']."%'))";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(CASE 
					WHEN Estatus = 'ENV' 
					THEN 'EN PROCESO DE VALIDACIÓN DE PAGO' 
					WHEN Estatus = 'ACT'
					THEN 'PLAN PAGADO'
					WHEN Estatus = 'REC'
					THEN 'RECHAZADO'
					END) like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
                	if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
                                $FechaSolicitud = $values['columns'][9]['search']['value'];
                                
                                $FechaSolicitud = $Utilitarios->formatFechaInput($FechaSolicitud);
                                
				$where.=" AND FechaSolicitud >=  '".$FechaSolicitud."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
			{
				$where.=" AND upper(pv.NombreVendedor) LIKE(upper('%".$values['columns'][10]['search']['value']."%'))";
				//echo $values['columns'][0]['search']['value'];die;
			}

			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
                                $column_order = $columns[$values['order'][0]['column']];
			}else{
                                $column_order = " SolicitudPlan.idSolicitudPlan ";
                        }
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}else{
                           
                            $order = " desc ";
                        }
			//echo $column_order;die;
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->SolicitudPlan
			->select("SolicitudPlan.*,sa.*,SolicitudPlan.idSolicitudPlan,DATE_FORMAT(FechaSolicitud, '%d/%m/%Y') as FechaSolicitud, Estatus AS EstatusAbr,
				CASE 
					WHEN Estatus = 'ENV' 
					THEN 'EN PROCESO DE VALIDACIÓN DE PAGO' 
					WHEN Estatus = 'ACT'
					THEN 'PLAN PAGADO'
					WHEN Estatus = 'REC'
					THEN 'RECHAZADO'
					END AS Estatus,
                                        CONCAT (
                                        ( 
                                        CASE WHEN(SELECT Nombre 
                                        FROM SolicitudPlanSeleccion sps 
                                        INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                        WHERE p.Tipo = 'tugruero.com' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan ) IS NULL THEN '' 
                                        ELSE (SELECT Nombre 
                                        FROM SolicitudPlanSeleccion sps 
                                        INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                        WHERE p.Tipo = 'tugruero.com' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)
                                        END), 
                                        CASE WHEN(
                                                SELECT CONCAT(Nombre, ' ',Puestos, ' Puestos' ) 
                                                FROM SolicitudPlanSeleccion sps 
                                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                                WHERE p.Tipo = 'RCV' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan ) 
                                                IS NULL THEN '' ELSE (SELECT CONCAT(' / ',Nombre, ' ',Puestos, ' Puestos' ) 
                                                FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                                WHERE p.Tipo = 'RCV' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan) END) AS concatenado_plan, 

				(SELECT  SUM(PrecioConIva) 
					FROM SolicitudPlanSeleccion sps 
					RIGHT JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan) AS PrecioTotal,
                    CASE WHEN TipoPago = 'TDC' THEN 'Tarjeta de crédito' ELSE 'Depósito o Transferencia'  END AS TipoPago, pv.NombreVendedor
				")
			->where("$where and SolicitudPlan.idSolicitudPlan IN(SELECT idSolicitudPlan FROM SolicitudPlanSeleccion)")
			->join("SolicitudPagoDetalle","LEFT JOIN SolicitudPagoDetalle spd on spd.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
			->join("SolicitudAprobada","LEFT JOIN SolicitudAprobada sa on sa.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
			->join("PlanesVendedores","LEFT JOIN PlanesVendedores pv on pv.idV = SolicitudPlan.idV")

			->order("$column_order $order")			
			->limit($limit,$offset);
			//echo $q;die;
			return $q; 			
		}
		public function getCountSolicitudPlanList($values)
		{	
                        $Utilitarios = new Utilitarios();
			$where = "1 = 1 and PagoRealizado = 'S' ";
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND SolicitudPlan.idSolicitudPlan = ".$values['columns'][0]['search']['value']."";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Nombres) like ('%".$values['columns'][1]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Apellidos) like ('%".$values['columns'][2]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}					
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(Cedula) like ('%".$values['columns'][3]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}			
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(Rif) like ('%".$values['columns'][4]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(CONCAT
				((
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				),
				CASE WHEN(	
					SELECT CONCAT(Nombre, ' ',Puestos, ' Puestos' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				) IS NULL THEN '' ELSE (SELECT CONCAT(' / ',Nombre, ' ',Puestos, ' Puestos' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)
				

				END)) like ('%".$values['columns'][5]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
			{
				$where.=" AND ((SELECT  SUM(PrecioConIva) 
					FROM SolicitudPlanSeleccion sps 
					RIGHT JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)) >= '".$values['columns'][6]['search']['value']."' ";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
			{
				$where.=" AND upper(CASE WHEN TipoPago = 'TDC' THEN 'Tarjeta de crédito' ELSE 'Depósito o Transferencia' END) like UPPER(('%".$values['columns'][7]['search']['value']."%'))";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
			{
				$where.=" AND upper(CASE 
					WHEN Estatus = 'ENV' 
					THEN 'EN PROCESO DE VALIDACIÓN DE PAGO' 
					WHEN Estatus = 'ACT'
					THEN 'PLAN PAGADO'
					WHEN Estatus = 'REC'
					THEN 'RECHAZADO'
					END) like ('%".$values['columns'][8]['search']['value']."%')";
				//echo $values['columns'][0]['search']['value'];die;
			}
                	if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
			{
                                $FechaSolicitud = $values['columns'][9]['search']['value'];
                                
                                $FechaSolicitud = $Utilitarios->formatFechaInput($FechaSolicitud);
                                
				$where.=" AND FechaSolicitud >=  '".$FechaSolicitud."'";
				//echo $values['columns'][0]['search']['value'];die;
			}
			if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
			{
				$where.=" AND upper(pv.NombreVendedor) LIKE(upper('%".$values['columns'][10]['search']['value']."%'))";
				//echo $values['columns'][0]['search']['value'];die;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("count(*) as cuenta")
			->where("$where and SolicitudPlan.idSolicitudPlan IN(SELECT idSolicitudPlan FROM SolicitudPlanSeleccion)")
			->join("SolicitudPagoDetalle","LEFT JOIN SolicitudPagoDetalle spd on spd.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
			->join("SolicitudAprobada","LEFT JOIN SolicitudAprobada sa on sa.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
			->join("PlanesVendedores","LEFT JOIN PlanesVendedores pv on pv.idV = SolicitudPlan.idV")
            ->fetch();
            //echo $q;die;
			return $q['cuenta']; 			
		}
		public function getSolicitudPlanById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("*, 
			(
				SELECT pl.idPlan
				FROM SolicitudPlanSeleccion sps 
				INNER JOIN Planes pl ON pl.idPlan = sps.idPlan
				WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 	
				AND Tipo = 'tugruero.com'
			) AS idPlan,

                        CASE WHEN ( 
                                SELECT pl.idPlan
                                FROM SolicitudPlanSeleccion sps 
                                INNER JOIN Planes pl ON pl.idPlan = sps.idPlan 
                                WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 
                                AND Tipo = 'RCV' 
                        ) IS NULL THEN 'NO' ELSE 'SI' END AS RCV,
                        ( 
                                SELECT pl.Puestos
                                FROM SolicitudPlanSeleccion sps 
                                INNER JOIN Planes pl ON pl.idPlan = sps.idPlan 
                                WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 
                                AND Tipo = 'RCV' 
                        ) AS Puestos,
                        TipoPago AS MET,
                        (SELECT SUM(PrecioConIva) FROM SolicitudPlanSeleccion s WHERE s.idSolicitudPlan = SolicitudPlan.idSolicitudPlan) AS precio,
                        DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') as FechaNacimiento, SolicitudPlan.Kilometraje, SolicitudPlan.CantidadServicios
                        ")
                        ->join("PlanesVendedores","LEFT JOIN PlanesVendedores pv on pv.idV = SolicitudPlan.idV")
			->where("SolicitudPlan.idSolicitudPlan=?",$values['idSolicitudPlan'])
			//echo $q;die;
			->fetch();
			return $q; 				
			
		}		
		function saveSolicitudPlan($values){
                        
            $Utilitarios = new Utilitarios();           
			$array_solicitud_plan = array(
				'Nombres' => @$values['Nombres'],
				'Apellidos' => @$values['Apellidos'],
                                'Sexo' => @$values['Sexo'],
                                'EstadoCivil' => @$values['EstadoCivil'],
                                'FechaNacimiento' => $Utilitarios->formatFechaInput(@$values['FechaNacimiento']),
                                
                'Correo' => @$values['Correo'],
                'Cedula' => @strtoupper($values['Cedula']),
				'Rif' => @strtoupper($values['Rif']),
                'Estado' => $values['Estado'],
                'Ciudad' => @$values['Ciudad'],
                'Domicilio' => $values['Domicilio'],
                'Telefono' => @$values['Telefono'],
				'Celular' => @$values['Celular'],
                                'FechaSolicitud' => date('Y-m-d h:i:s'),
				'TipoPago' => @$values['MET'],
                                'NumeroTransaccion' => '0',
                                'Clase' => @$values['Clase'],
                                'Marca' => @$values['Marca'],
                                'Modelo' => @$values['Modelo'],
                                'Anio' => @$values['Anio'],
                                'Color' => @$values['Color'],
                                'Placa' => @$values['Placa'],
                                'Tipo' => @$values['Tipo'],
                                'Puestos' => @$values['Puestos'],
                                'Estatus' => 'ENV',
                                'TotalSinIva' => '0',
				'TotalConIva' => '0',
                                'PagoRealizado' => @$values['PagoRealizado'],
                                'IdV' => @$values['IdV']
			);
              
			try{
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan()->insert($array_solicitud_plan);
			$values['idSolicitudPlan'] = $ConnectionORM->getConnect()->SolicitudPlan()->insert_id();
            //almaceno los plens contratados en la solicitud

			$array_planes = array($values['idPlan']);
                        //actualizo el Kilometraje y la cantidad de servicios acorde al plan seleccionado
                        $datos_plan = $this->getDatosPlan($values['idPlan']);
                        $this->updateCantidadServiciosKm($values['idSolicitudPlan'],$datos_plan);
			$Planes = new Planes();
			if(isset($values['RCV']) and $values['RCV']=='SI' and isset($values['Puestos'])){
				
				$id_plan_rcv = $Planes->getIdPlanRCV($values['Puestos']);
                                if($id_plan_rcv > 0){
                                    $array_planes[] = $id_plan_rcv;
                                }
				
			}
			
			$TotalSinIva = 0;
                        $TotalConIva = 0;
		
				foreach($array_planes as $plan){
                        $IVA = $Planes->getIvaPlan($plan);
						$PrecioSinIva = $Planes->getPrecioPlan($plan);
						$PrecioConIva = $Planes->getPrecioPlan($plan);
                                                
                                                
                                                $PrecioConIva = $Planes->getPrecioPlan($plan);
                                                
												
                                                $TotalSinIva = $TotalSinIva + $PrecioConIva;
                                                $TotalConIva = $TotalConIva + $PrecioConIva;
                                                $array_solicitud_plan_seleccion = array();
						$array_solicitud_plan_seleccion['idSolicitudPlan'] = $values['idSolicitudPlan'];
						$array_solicitud_plan_seleccion['idPlan'] = $plan;
						$array_solicitud_plan_seleccion['PrecioSinIva'] = $PrecioConIva;
						$array_solicitud_plan_seleccion['PrecioConIva'] = $PrecioConIva;
						$array_solicitud_plan_seleccion['FechaSolicitud'] = date('Y-m-d h:i:s');
						$q = $ConnectionORM->getConnect()->SolicitudPlanSeleccion()->insert($array_solicitud_plan_seleccion);
						
				}
                        //actualizo la solicicitud para colocarle el total del precio con y sin IVA
			$this->updatePrecios($TotalConIva,$TotalSinIva,$values['idSolicitudPlan']);
			}catch(Exception $e){
				echo $e->getMessage();die;
			}
                        

			return $values;	
			
		}
		function saveSolicitudPlanAdmin($values){
			        $precio_tugruero = 0;
					$precio_rcv = 0;
             
                    if(isset( $values['precio_rcv']) and  $values['precio_rcv']!=''){
                        $precio_rcv = $values['precio_rcv'];
                    }
                    if(isset( $values['precio_tugruero']) and  $values['precio_tugruero']!=''){
                        $precio_tugruero = $values['precio_tugruero'];
                    }
                    

            $Utilitarios = new Utilitarios();           
			$array_solicitud_plan = array(
				'Nombres' => @$values['Nombres'],
				'Apellidos' => @$values['Apellidos'],
                                'Sexo' => @$values['Sexo'],
                                'EstadoCivil' => @$values['EstadoCivil'],
                                'FechaNacimiento' => $Utilitarios->formatFechaInput(@$values['FechaNacimiento']),
                                
                'Correo' => @$values['Correo'],
                'Cedula' => @strtoupper($values['Cedula']),
				'Rif' => @strtoupper($values['Rif']),
                'Estado' => $values['Estado'],
                'Ciudad' => @$values['Ciudad'],
                'Domicilio' => $values['Domicilio'],
                'Telefono' => @$values['Telefono'],
				'Celular' => @$values['Celular'],
                                'FechaSolicitud' => date('Y-m-d h:i:s'),
				'TipoPago' => @$values['MET'],
                                'NumeroTransaccion' => '0',
                                'Clase' => @$values['Clase'],
                                'Marca' => @$values['Marca'],
                                'Modelo' => @$values['Modelo'],
                                'Anio' => @$values['Anio'],
                                'Color' => @$values['Color'],
                                'Placa' => @$values['Placa'],
                                'Tipo' => @$values['Tipo'],
                                'Puestos' => @$values['Puestos'],
                                'Estatus' => 'ENV',
                                'TotalSinIva' => '0',
				'TotalConIva' => '0',
                                'PagoRealizado' => @$values['PagoRealizado'],
                                'IdV' => @$values['IdV'],
				"SerialMotor" =>  @$values['SerialMotor'],
				"SerialCarroceria" =>  @$values['SerialCarroceria']
			);
              
			try{
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan()->insert($array_solicitud_plan);
			$values['idSolicitudPlan'] = $ConnectionORM->getConnect()->SolicitudPlan()->insert_id();

                        //en caso de ser TDC almaceno en pago detalle
                        if(isset($values['MET']) == 'TDC'){
                            $array_solicitud_pago_detalle = array(
                                "idSolicitudPlan" => $values['idSolicitudPlan'],
                                "id" => $values['id'],
                                "description" => "Pago de plan mediante la herramienta administrativa",
                                "payment_method_id" => $values['payment_method_id'],
                                "payer_identification_number" => $values['payer_identification_number'],
                                "carholder_name" => $values['carholder_name'],
                                "transaction_amount" => $values['transaction_amount'],
                                "date_approved" => date('Y-m-d h:i:s'),
                                "payer_id" => "guest",
                                "payment_type_id" => 'credit_card',
                                "payer_email" => $values['Correo']
                            

                            );
                            $q = $ConnectionORM->getConnect()->SolicitudPagoDetalle()->insert($array_solicitud_pago_detalle);
                        }

                        
                       

                        //almaceno los planes contratados en la solicitud
                        $array_planes = array();
                        if(isset($values['idPlan']) and $values['idPlan']!=""){
                                    //actualizo el km acorde a lo que existe en la tabla planes
                                    $datos_plan = $this->getDatosPlan($values['idPlan']);
                                    $this->updateCantidadServiciosKm($values['idSolicitudPlan'],$datos_plan);
                                    /////////////////////////////////////////////
                                    $array_planes = array($values['idPlan']);
                                    $TotalConIva = $precio_tugruero;
                                    $TotalSinIva = $precio_tugruero;
                                    $array_solicitud_plan_seleccion = array();
                                    $array_solicitud_plan_seleccion['idSolicitudPlan'] = $values['idSolicitudPlan'];
                                    $array_solicitud_plan_seleccion['idPlan'] = $values['idPlan'];
                                    $array_solicitud_plan_seleccion['PrecioSinIva'] = $precio_tugruero;
                                    $array_solicitud_plan_seleccion['PrecioConIva'] = $precio_tugruero;
                                    $array_solicitud_plan_seleccion['FechaSolicitud'] = date('Y-m-d h:i:s');
                                    $q = $ConnectionORM->getConnect()->SolicitudPlanSeleccion()->insert($array_solicitud_plan_seleccion);
                                    

                        }
			
			$Planes = new Planes();
			if(isset($values['RCV']) and $values['RCV']=='SI' and isset($values['Puestos'])){
				
				$id_plan_rcv = $Planes->getIdPlanRCV($values['Puestos']);
                                if($id_plan_rcv > 0){
                                    $TotalConIva = $precio_rcv;
                                    $TotalSinIva = $precio_rcv;
                                    $array_solicitud_plan_seleccion = array();
                                    $array_solicitud_plan_seleccion['idSolicitudPlan'] = $values['idSolicitudPlan'];
                                    $array_solicitud_plan_seleccion['idPlan'] = $id_plan_rcv;
                                    $array_solicitud_plan_seleccion['PrecioSinIva'] = $precio_rcv;
                                    $array_solicitud_plan_seleccion['PrecioConIva'] = $precio_rcv;
                                    $array_solicitud_plan_seleccion['FechaSolicitud'] = date('Y-m-d h:i:s');
                                    $q = $ConnectionORM->getConnect()->SolicitudPlanSeleccion()->insert($array_solicitud_plan_seleccion);
                                    //$this->updatePrecios($TotalConIva,$TotalSinIva,$values['idSolicitudPlan']);

                                }
				
			}
			
			$TotalConIva = $precio_tugruero + $precio_rcv;
			$TotalSinIva = $precio_tugruero + $precio_rcv;
			
			$this->updatePrecios($TotalConIva,$TotalSinIva,$values['idSolicitudPlan']);
			
		
			}catch(Exception $e){
				echo $e->getMessage();die;
			}
                        

			return $values;	
			
		}
		function updateSolicitudPlan($values){	
			$Utilitarios = new Utilitarios();
                            $array_solicitud_plan = array(
				'Nombres' => @$values['Nombres'],
				'Apellidos' => @$values['Apellidos'],
    				'EstadoCivil' => @$values['EstadoCivil'],
    				'Sexo' => @$values['Sexo'],
    				'FechaNacimiento' => $Utilitarios->formatFechaInput(@$values['FechaNacimiento']),
                                'Correo' => @$values['Correo'],
                                'Cedula' => @strtoupper($values['Cedula']),
				'Rif' => @strtoupper($values['Rif']),
                                'Estado' => $values['Estado'],
                                'Ciudad' => $values['Ciudad'],           
                                'Domicilio' => $values['Domicilio'],
                                'Telefono' => @$values['Telefono'],
				'Celular' => @$values['Celular'],
                                'Marca' => @$values['Marca'],
                                'Modelo' => @$values['Modelo'],
                                'Tipo' => @$values['Tipo'],
                                'Anio' => @$values['Anio'],
                                'Color' => @$values['Color'],
                                'Placa' => @$values['Placa'],
                                'Puestos' => @$values['Puestos'],
				'SerialMotor' => @$values['SerialMotor'],
				'SerialCarroceria' => @$values['SerialCarroceria'],
                                'Kilometraje' => @$values['Kilometraje'],
                                'CantidadServicios' => @$values['CantidadServicios']
                                
			);
                        
		
			$idSolicitudPlan = $values['idSolicitudPlan'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan("idSolicitudPlan", $idSolicitudPlan)->update($array_solicitud_plan);	

			
			return $q;
			
		}

		function updatePrecios($TotalConIva,$TotalSinIva,$idSolicitudPlan ){			
			$array = array(
				'TotalConIva' => $TotalConIva,
				'TotalSinIva' => $TotalSinIva
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan("idSolicitudPlan", $idSolicitudPlan)->update($array);	
        }
		function updateSeriales($values ){	
			$idSolicitudPlan = $values['idSolicitudPlan'];
			$array = array(
				'SerialMotor' => @$values['SerialMotor'],
				'SerialCarroceria' => @$values['SerialCarroceria'],
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan("idSolicitudPlan", $idSolicitudPlan)->update($array);	
        }
		function updatePagoRealizado($idSolicitudPlan,$PagoRealizado){			
			$array = array(
				'PagoRealizado' => $PagoRealizado,
			);
					
			$ConnectionORM = new ConnectionORM();
			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionORM->getConnect()->SolicitudPlan("idSolicitudPlan", $idSolicitudPlan)->update($array);	
                }
		public function getSolicitudPorPlaca($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("count(*) as cuenta")
			->where("SolicitudPlan.Placa=?",$values['Placa'])
                        ->and('Estatus=?','ENV')
                        ->and('PagoRealizado=?','S')
			//echo $q;die;
			->fetch();
			return $q['cuenta']; 				
			
		}
                public function getSolicitudPlanInfo($idSolicitudPlan){
                       $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->SolicitudPlan
			->select("*,SolicitudPlan.idSolicitudPlan,DATE_FORMAT(FechaSolicitud, '%d/%m/%Y') as FechaSolicitud,
				CASE 
					WHEN Estatus = 'ENV' 
					THEN 'EN PROCESO DE VALIDACIÓN DE PAGO' 
					WHEN Estatus = 'ACT'
					THEN 'PLAN PAGADO'
					WHEN Estatus = 'REC'
					THEN 'RECHAZADO'
					END AS Estatus,
				CONCAT
				((
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				),
				CASE WHEN(	
					SELECT CONCAT(Nombre, ' ',Puestos, ' Puestos' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				) IS NULL THEN '' ELSE (SELECT CONCAT(' + ',Nombre, '' )  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'RCV'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan)
				

				END) AS concatenado_plan,
				(
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				) as plan_tugruero,

				(SELECT  SUM(PrecioConIva) 
					FROM SolicitudPlanSeleccion sps 
					RIGHT JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan) AS PrecioTotal,
                                CASE WHEN TipoPago = 'TDC' THEN 'Tarjeta de crédito' ELSE 'Depósito o Transferencia'  END AS TipoPago
				")
			->where("SolicitudPlan.idSolicitudPlan=?",$idSolicitudPlan)
			->join("SolicitudPagoDetalle","LEFT JOIN SolicitudPagoDetalle spd on spd.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
                        ->fetch();
                        
                        return $q;
                }
                
		public function getSolicitudPlanAprobadaInfo($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("*,CONCAT
				((
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				))
                                AS concatenado_plan,
                                ( SELECT TipoServicio FROM SolicitudPlanSeleccion sps 
                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                WHERE p.Tipo = 'tugruero.com' 
                                AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 
                                ) AS TipoServicio,
                                
								TIMESTAMPDIFF(YEAR, FechaNacimiento, CURDATE()) AS Edad,
								( SELECT Urbano FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE p.Tipo = 'tugruero.com' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan ) AS Urbano, 
								( SELECT ExtraUrbano FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE p.Tipo = 'tugruero.com' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan ) AS ExtraUrbano,
                                                                (
                                                                SELECT PrecioConIva FROM SolicitudPlanSeleccion sps
                                                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                                                WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'tugruero.com'
                                                                ) AS costoplantugruero,
								(
                                                                SELECT PrecioConIva FROM SolicitudPlanSeleccion sps
                                                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                                                WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV'
                                                                ) AS costoplanrcv, Kilometraje, CantidadServicios")
			->join("SolicitudAprobada","INNER JOIN SolicitudAprobada sa on sa.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
			->where("SolicitudPlan.idSolicitudPlan=?",$idSolicitudPlan)
			->fetch();
			return $q; 				
			
		}
		public function getSolicitudPlanAprobadaInfoAsistir($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan
			->select("*,CONCAT
				((
					SELECT Nombre  
					FROM SolicitudPlanSeleccion sps 
					INNER JOIN Planes p ON p.idPlan = sps.idPlan
					WHERE p.Tipo = 'tugruero.com'
					AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan
				))
                                AS concatenado_plan,
                                ( SELECT Kilometraje FROM SolicitudPlanSeleccion sps 
                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                WHERE p.Tipo = 'tugruero.com' 
                                AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 
                                ) AS Kilometraje,
                                ( SELECT TipoServicio FROM SolicitudPlanSeleccion sps 
                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                WHERE p.Tipo = 'tugruero.com' 
                                AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 
                                ) AS TipoServicio,
                                ( SELECT CantidadServicios FROM SolicitudPlanSeleccion sps 
                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                WHERE p.Tipo = 'tugruero.com' 
                                AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan 
                                ) AS CantidadServicios,
								TIMESTAMPDIFF(YEAR, FechaNacimiento, CURDATE()) AS Edad,
								( SELECT Urbano FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE p.Tipo = 'tugruero.com' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan ) AS Urbano, 
								( SELECT ExtraUrbano FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE p.Tipo = 'tugruero.com' AND sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan ) AS ExtraUrbano,
                                                                (
                                                                SELECT PrecioConIva FROM SolicitudPlanSeleccion sps
                                                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                                                WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'tugruero.com'
                                                                ) AS costoplantugruero,
								(
                                                                SELECT PrecioConIva FROM SolicitudPlanSeleccion sps
                                                                INNER JOIN Planes p ON p.idPlan = sps.idPlan 
                                                                WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV'
                                                                ) AS costoplanrcv,
								( SELECT RCVCosas FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS RCVCosas,
								( SELECT RCVPersonas FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS RCVPersonas,
								( SELECT RCVPrima FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS RCVPrima,
								( SELECT ExcesoLimites FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS ExcesoLimites,
								( SELECT ExcesoPrima FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS ExcesoPrima,
								( SELECT DefensaPenal FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS DefensaPenal,
								( SELECT DefensaPrima FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS DefensaPrima,
								( SELECT APOVMuerte FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS APOVMuerte,
								( SELECT APOVInvalidez FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS APOVInvalidez,
								( SELECT APOVGastos FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS APOVGastos,
								( SELECT APOVPrima FROM SolicitudPlanSeleccion sps INNER JOIN Planes p ON p.idPlan = sps.idPlan WHERE sps.idSolicitudPlan = SolicitudPlan.idSolicitudPlan AND p.Tipo = 'RCV' ) AS APOVPrima
								")
			->join("SolicitudAprobada","INNER JOIN SolicitudAprobada sa on sa.idSolicitudPlan = SolicitudPlan.idSolicitudPlan")
			->where("SolicitudPlan.idSolicitudPlan=?",$idSolicitudPlan)
			->fetch();
			return $q; 				
			
		}
		function rechazarSolicitud($idSolicitudPlan, $Observacion){			
                        $array_solicitud_plan = array(
				'Observacion' => $Observacion,
                                'Estatus' => 'REC'
                                
			);
		
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPlan("idSolicitudPlan", $idSolicitudPlan)->update($array_solicitud_plan);	

			
			return $q;
			
		}
		public function getCuentaIdV($IdV){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->PlanesVendedores
			->select("*")
			->where("IdV=?",$IdV);
			return $q; 				
			
		}
		public function getPlanesRCV($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->join("SolicitudPlanSeleccion","INNER JOIN SolicitudPlanSeleccion sa on sa.idPlan = Planes.idPlan")
			->where("idSolicitudPlan=?",$idSolicitudPlan)
			->and("Tipo=?",'RCV')
			->fetch();
			//echo $q;die;
			return $q; 				
			
		} 
		public function getDatosVendedor($IdV){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->PlanesVendedores
			->select("*")
			->where("IdV=?",$IdV)
			->fetch();
			//echo $q;die;
			return $q; 
			
		}
		public function getPlanesSeleccionados($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->join("SolicitudPlanSeleccion","INNER JOIN SolicitudPlanSeleccion sa on sa.idPlan = Planes.idPlan")
			->where("idSolicitudPlan=?",$idSolicitudPlan);
                        
			return $q; 				
			
		} 

            function getDatosPlan($idPlan){			
                            $ConnectionORM = new ConnectionORM();
                            $q = $ConnectionORM->getConnect()->Planes
                            ->select("*")
                            ->where("idPlan=?",$idPlan)
                            ->fetch();
                            return $q; 

            }
        function updateCantidadServiciosKm($idSolicitudPlan,$datos_plan){			
            $array = array(
                    'Kilometraje' => $datos_plan['Kilometraje'],
                    'CantidadServicios' => $datos_plan['CantidadServicios']);
            $ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->SolicitudPlan("idSolicitudPlan", $idSolicitudPlan)->update($array);	
        
        }

        }
        
			

	