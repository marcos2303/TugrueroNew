<?php

class Proveedores{
    
    public $IdProveedor;
    
    function getIdProveedor() {
        return $this->IdProveedor;
    }

    function setIdProveedor($IdProveedor) {
        $this->IdProveedor = $IdProveedor;
    }

    		public function getList($values)
		{	
			$columns = array();
			$columns[0] = 'Identificacion';
			$columns[1] = 'Nombres';
			$columns[2] = 'Apellidos';
			$columns[3] = '';
			$columns[4] = 'Apellido';
            $columns[5] = 'Vencimiento';
            $columns[6] = 'Seguro';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];

			
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND upper(Identificacion) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Nombres) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Apellidos) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(pt.Nombre) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(e.Nombre) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Ciudad) like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
			}				
			
			
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->Proveedores
			->select("Proveedores.*,e.Nombre as NombreEstado, pt.Nombre as NombreProveedorTipo")
			->join("ProveedoresTipo","INNER JOIN ProveedoresTipo pt on pt.IdProveedorTipo = Proveedores.IdProveedorTipo")
			->join("Estados","INNER JOIN Estados e on e.IdEstado = Proveedores.IdEstado")
            ->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountList($values)
		{	
			$where = '1 = 1';
			if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
			{
				$where.=" AND upper(Identificacion) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
			}
			if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
			{
				$where.=" AND upper(Nombres) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
			}			
			if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
			{
				$where.=" AND upper(Apellidos) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
			}			
			if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
			{
				$where.=" AND upper(pt.Nombre) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
			}	
			if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
			{
				$where.=" AND upper(e.Nombre) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
			}	
			if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
			{
				$where.=" AND upper(Ciudad) like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
			}				
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Proveedores
			->select("count(*) as cuenta")
			->join("ProveedoresTipo","INNER JOIN ProveedoresTipo pt on pt.IdProveedorTipo = Proveedores.IdProveedorTipo")
			->join("Estados","INNER JOIN Estados e on e.IdEstado = Proveedores.IdEstado")
            ->order("$column_order $order")
			->where("$where")
            ->fetch();
			return $q['cuenta']; 			
		}
		function addProveedor($values){
				$array = array(
				'IdProveedorTipo' => $values['IdProveedorTipo'],
				'IdEstado' => $values['IdEstado'],
                'Estatus' => 1,
                'Identificacion' => $values['Identificacion'],
                'Nombres' => $values['Nombres'],
                'Apellidos' => $values['Apellidos'],
                'Ciudad' => $values['Ciudad'],
                'Zona' => $values['Zona'],
                'NumeroClub' => $values['NumeroClub'],
                'Celular1' => $values['Celular1'],
				'Celular2' => $values['Celular2'],
				'Celular3' => $values['Celular3'],
				'ClaveEspecial' => $values['ClaveEspecial'],
			);
			
			$ConnectionORM = new ConnectionORM();			
			$q = $ConnectionORM->getConnect()->Proveedores()->insert($array);	
			$this->SetIdProveedor($ConnectionORM->getConnect()->Proveedores()->insert_id());
			return $q;
        }
		function updateProveedores($values){
			
			
			$array = array();
			if(count($values)>0){
				foreach($values as $key => $val){
					if(strlen($val)>0){
						$array[$key] = $val;
					}
				}
			}
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Proveedores("IdProveedor", $values['IdProveedor'])->update($array);
			return $q;

		}
		function getProveedoresInfo($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Proveedores
			->select("*")
			->where("IdProveedor=?",$values['IdProveedor'])
            ->fetch();
			return $q;
		}

}


