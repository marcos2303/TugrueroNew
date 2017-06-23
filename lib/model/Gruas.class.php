<?php

	class Gruas {
		public $IdGrua;
		
		function getIdGrua() {
			return $this->IdGrua;
		}

		function setIdGrua($IdGrua) {
			$this->IdGrua = $IdGrua;
		}

				
		public function getGruaInfo($IdGrua){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Gruas
			->select("Gruas.*, m.Nombre as NombreMarca, p.Nombres as NombresProveedor, p.Apellidos as ApellidosProveedor, gt.Nombre as NombreGruasTipo")
			->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
			->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
			->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
			->where("IdGrua=?",$IdGrua)->fetch();
			//	;echo $q;die;
			return $q; 	
		}
		
		function addGrua($values){
				$array = array(
				'IdProveedor' => $values['IdProveedor'],
				'IdGruaTipo' => $values['IdGruaTipo'],
				'IdMarca' => $values['IdMarca'],
				'Estatus' => 1,
				'Placa' => $values['Placa'],
				'Modelo' => $values['Modelo'],
				'Anio' => $values['Anio'],
				'Color' => $values['Color'],
				'Celular' => $values['Celular'],
				'Disponible' => 0,
				'Latitud' => 0,
				'Longitud' => 0,
				'UltimaActualizacion' => date('Y-m-d h:i:s'),
				'Token' => $values['Token'],
				'DeviceId' => null,
				'GPSOn' => 0,
			);
			
			$ConnectionORM = new ConnectionORM();			
			$q = $ConnectionORM->getConnect()->Gruas()->insert($array);	
			$this->SetIdGrua($ConnectionORM->getConnect()->Gruas()->insert_id());
			return $q;
		}
		function updateGrua($values){
			
			
			$array = array();
			if(count($values)>0){
				foreach($values as $key => $val){
					if(strlen($val)>0){
						$array[$key] = $val;
					}
				}
			}
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Gruas("IdGrua", $values['IdGrua'])->update($array);
			return $q;

		}
	}
	