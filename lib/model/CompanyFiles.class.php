<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyFiles
 *
 * @author Marcos
 */
class CompanyFiles {
                public function getCompanyFilesList($id_company)
                {
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_files
			->select("*")
                        ->where("id_company=?",$id_company)
                        ->order("name_file");
			return $q; 				
			
		}
}
