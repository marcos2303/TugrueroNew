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
	class SolicitudPagoDetalle {
		
		public function __construct() 
		{
			
		}
                
                
                
         public function savePagoDetalle($values){
             
             
            $array = array();
            $array['idSolicitudPlan'] = $values['idSolicitudPlan'];
            $array['id'] = $values['response']['id'];
            $array['description'] = $values['descripcion'];
            $array['status'] = $values['response']['status'];
            $array['status_detail'] = $values['response']['status_detail'];
            $array['currency_id'] = $values['response']['currency_id'];
            $array['date_created'] = $values['response']['date_created'];
            $array['date_approved'] = $values['response']['date_approved'];
            $array['payment_method_id'] = $values['response']['payment_method_id'];
            $array['payment_type_id'] = $values['response']['payment_type_id'];
            $array['collector_id'] = $values['response']['collector_id'];
            $array['payer_type'] = $values['response']['payer']['type'];
            $array['payer_id'] = $values['response']['payer']['id'];
            $array['payer_email'] = $values['response']['payer']['email'];
            $array['payer_identification_type'] = $values['response']['payer']['identification']['type'];
            $array['payer_identification_number'] = $values['response']['payer']['identification']['number'];
            $array['payer_first_name'] = $values['response']['payer']['first_name'];
            $array['payer_last_name'] = $values['response']['payer']['last_name'];
            $array['payer_entity_type'] = $values['response']['payer']['entity_type'];
            $array['transaction_amount'] = $values['response']['transaction_amount'];
            $array['net_received_amount'] = $values['response']['transaction_details']['net_received_amount'];
            $array['carholder_name'] = $values['response']['card']['cardholder']['name'];
            $array['carholder_identification_type'] =$values['response']['card']['cardholder']['identification']['type'];
            $array['cardholder_identification_number'] = $values['response']['card']['cardholder']['identification']['number'];
             
            $ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->SolicitudPagoDetalle()->insert($array);
             
             //print_r($array);die;
             
         }
		public function getPagoDetalleByID($idSolicitudPlan){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->SolicitudPagoDetalle
			->select("*")
            ->where('idSolicitudPlan=?',$idSolicitudPlan)
            ->fetch();
			
			return $q; 				
			
		}
		



	}
	
