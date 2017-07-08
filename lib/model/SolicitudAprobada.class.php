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
	class SolicitudAprobada {
		
		public function __construct() 
		{
			
		}


		function aprobar($idSolicitudPlan,$VigenciaDesde, $VigenciaHasta){
                        $Utilitarios = new Utilitarios();
                        
                        
			$array = array(
				'idSolicitudPlan' => $idSolicitudPlan,
				'VigenciaDesde' => $Utilitarios->formatFechaInput($VigenciaDesde),
                                'VigenciaHasta' => $Utilitarios->formatFechaInput($VigenciaHasta),
                                'FechaAprobacion' => date('Y-m-d h:i:s'),

			);
                        $ConnectionORM = new ConnectionORM();
                        $q = $ConnectionORM->getConnect()->SolicitudAprobada()->insert($array);
                        
                        //actualizo la solicitud
			$ConnectionORM = new ConnectionORM(); 
			$q = $ConnectionORM->ejecutarPreparado("UPDATE SolicitudPlan set Estatus = 'ACT'  where idSolicitudPlan = $idSolicitudPlan");
                        
                        
                        /******************Elaboro el numero de producto************************/
                        //TGP-PAG-000X
                        $SolicitudPlan = new SolicitudPlan();
                        $data = $SolicitudPlan->getSolicitudPlanAprobadaInfo($idSolicitudPlan);
                        
                        /*******************Preparo para póliza*******************************/
                        
                        $hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$array_poliza = array(
				'Placa' => $data['Placa'],
				'Cedula' => $data['Cedula'],
				'Nombre' => $data['Nombres'],
				'Apellido' => $data['Apellidos'],
				'Marca' => $data['Marca'],
				'Modelo' => $data['Modelo'],
				'Tipo' => "N/A",
				'Color' => $data['Color'],
				'Año' => $data['Anio'],
				'Serial' => "N/A",
				'Seguro' => $data['concatenado_plan'],
				'NumPoliza' => $data['NumProducto'],
				'DireccionEDO' => $data['Estado'],
				'Domicilio' => $data['Domicilio'],
				'Vencimiento' => $data['VigenciaHasta'],
				'DesdeVigencia' => $data['VigenciaDesde'],
				'date_created' => $hora,
				'date_updated' => $hora,
				'created_by' => 1,
				'updated_by' => 1,
				'EstatusPoliza' => 'Activo',
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Polizas()->insert($array_poliza);
			$data['idPoliza'] = $ConnectionORM->getConnect()->Polizas()->insert_id();
			$array_poliza['idPoliza'] = $data['idPoliza'];
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
			
			
		}
		public function isAprobada($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudAprobada
			->select("count(*) as cuenta")
                        ->where('idSolicitudPlan=?',$idSolicitudPlan)
                        ->fetch();
			if($q['cuenta']>0){
                            return true;
                        }else{
                            return false;
                        }			
		}
		public function getSolicitudAprobada($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudAprobada
			->select("*,DATE_FORMAT(VigenciaDesde, '%d/%m/%Y') as VigenciaDesde,DATE_FORMAT(VigenciaHasta, '%d/%m/%Y') as VigenciaHasta,DATE_FORMAT(FechaAprobacion, '%d/%m/%Y') as FechaAprobacion")
                        ->where('idSolicitudPlan=?',$idSolicitudPlan)
                        ->fetch();
                        return $q;
		}                
	}
			

	