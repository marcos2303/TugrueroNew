<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Users
	 *
	 * @author marcos
	 */
	class Planes {
		
		public function __construct() 
		{
			
		}
		public function getPlanesSelect()
		{	
			
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->where("Estado = 'A'");
			return $q; 			
		}
		public function getPrecioPlan($idPlan)
		{	
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->where("Estado = 'A'")
            ->and('idPlan=?',$idPlan)->fetch();
			return $q['Precio']; 			
		}
		public function getPrecioRCV($Puestos)
		{	
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->where("Estado = 'A'")
            ->and('Tipo=?','RCV')      
            ->and('Puestos=?',$Puestos)->fetch();
			return $q['Precio']; 			
		}
		public function getIdPlanRCV($Puestos)
		{	
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->where("Estado = 'A'")
            ->and('Tipo=?','RCV')      
            ->and('Puestos=?',$Puestos)->fetch();
			return $q['idPlan']; 			
		}

		public function getIvaPlan($idPlan)
		{	
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("*")
			->where("Estado = 'A'")
            ->and('idPlan=?',$idPlan)->fetch();
			return $q['IVA']; 			
		}
		

		public function getBeneficios()
		{	
			
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Beneficios
			->select("*")
			->where("Estatus = 'Activo'")
                        ->order("orden asc");
			return $q; 			
		}
		public function getPlanesBeneficios($idPlan,$idBeneficio)
		{	
			
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->PlanesBeneficios
			->select("count(*) as cuenta")
			->join("Beneficios","INNER JOIN Beneficios b on b.idBeneficio = PlanesBeneficios.idBeneficio")
			->where("idPlan =?",$idPlan)
                        ->and("PlanesBeneficios.idBeneficio=?",$idBeneficio)
                        ->and("PlanesBeneficios.Estatus=?","Activo")
                        ->fetch();
			return $q['cuenta']; 			
		}
		public function getPlanPrecioIva($idPlan)
		{	
			setlocale(LC_NUMERIC,"es_ES.UTF8");
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Planes
			->select("PrecioIva")
			->where("idPlan =?",$idPlan)
            ->fetch();
			
			return number_format($q['PrecioIva'],2,",",".");	
		}

	}
	
