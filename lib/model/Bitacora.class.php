<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Bitacoras
	 *
	 * @author marcos
	 */
	class Bitacora {
		
		public function __construct() 
		{
			
		}

		public function getBitacoraList($values)
		{	
                $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Bitacora
			->select("*,DATE_FORMAT(Bitacora.date_created, '%d/%m/%Y %H:%i:%s') as date_created")
			->join("users","INNER JOIN users u on u.id_user = Bitacora.id_user")
			->where("idSolicitud=?",$values['idSolicitud'])
                        ->order("Bitacora.date_created");
                        //echo $q;die;
			return $q; 			
		}
		public function getCountBitacoraByIdSolicitud($idSolicitud)
		{	
                $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Bitacora
			->select("count(*) as cuenta")
			->where("idSolicitud=?",$idSolicitud)
                        ->fetch();                       
                        //echo $q;die;
			return $q['cuenta']; 			
		}	
		public function insertBitacora($values){
			//print_r($values);die;
                        $hora = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
                        $array_bitacora = array(
                            "idSolicitud" => $values["idSolicitud"],
                            "id_user" => $_SESSION['id_user'],
                            "observacion" => $values["observacion"],
                            "date_created" => $hora,
                            
                        );
                        
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Bitacora()->insert($array_bitacora);	
                        //inserto en aws
 			$ConnectionAws= new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Bitacora()->insert($array_bitacora);	
                       
                        
                        
                        
                        
		}
		public function updateBitacora($values){
			//print_r($array);die;
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Bitacora()->insert($values);			
		}
	}
	