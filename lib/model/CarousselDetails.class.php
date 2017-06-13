<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarousselDetails
 *
 * @author marcos
 */
class CarousselDetails {
        function getCarousselDetails($id_caroussel)
        {
			
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->caroussel_details
			->select("*")
                        ->where('id_caroussel=?',$id_caroussel)
                        ->order('orders');	
			return $q;            
        }
        function getCarousselName($id_caroussel)
        {
			
                        $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->caroussel
			->select("*")
                        ->where('id_caroussel=?',$id_caroussel)
                        ->fetch();	
			return $q['name'];            
        }
}
