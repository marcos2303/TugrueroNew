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
	class SolicitudDocumentos {
		
		public function __construct() 
		{
			
		}


		function saveSolicitudDocumentos($idSolicitudPlan,$TipoDocumento, $NombreDocumento){
                        
                        
			$array = array(
				'idSolicitudPlan' => $idSolicitudPlan,
				'TipoDocumento' => $TipoDocumento,
                                'NombreDocumento' => $NombreDocumento,
                                'FechaSubida' => date('Y-m-d h:i:s'),
                                'Estatus' => "ENV",

			);
			 
                        $ConnectionORM = new ConnectionORM();
                        $q = $ConnectionORM->getConnect()->SolicitudDocumentos()->insert($array);


			
			
		}
		function updateSolicitudDocumentos($idSolicitudPlan,$TipoDocumento, $NombreDocumento){
                        
                        
			$array = array(
				'TipoDocumento' => $TipoDocumento,
                                'NombreDocumento' => $NombreDocumento,
                                'FechaSubida' => date('Y-m-d h:i:s'),
                                'Estatus' => "ENV",

			);
			$ConnectionORM = new ConnectionORM(); 
			$q = $ConnectionORM->ejecutarPreparado("UPDATE SolicitudDocumentos set NombreDocumento = '".$NombreDocumento."', FechaSubida = '".date('Y-m-d h:i:s')."' where idSolicitudPlan = $idSolicitudPlan AND TipoDocumento = '$TipoDocumento'");


			
			
		}
		public function getDocumentoByTipo($idSolicitudPlan, $TipoDocumento){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudDocumentos
			->select("*")
                        ->where('idSolicitudPlan=?',$idSolicitudPlan)
                        ->and('TipoDocumento=?',$TipoDocumento) 
                        ->fetch();
			
			return $q['NombreDocumento']; 				
			
		}

                
	}
			

	