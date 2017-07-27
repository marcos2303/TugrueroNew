<?php

	class ServiciosGruas{


		function addServiciosGruas($values){

			$array = array(
					'IdServicio' =>  $values['IdServicio'],
				);

			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosGruas()->insert($array);
			return $q;
		}
		function updateServiciosGruas($values){


			$array = array();
			if(count($values)>0){
				foreach($values as $key => $val){
					if(strlen($val)>0){
						$array[$key] = $val;
					}
				}
			}
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ServiciosGruas("IdServicio", $values['IdServicio'])->update($array);
			return $q;

		}
	}
