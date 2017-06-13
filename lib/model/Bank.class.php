<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bank
 *
 * @author Marcos
 */
class Bank {
    		public function getBankList()
                {
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank
			->select("*")->order("name");
			return $q; 				
			
		}
}
