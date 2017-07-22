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
		->select("Gruas.*, m.Nombre as NombreMarca, p.Nombres as NombresProveedor, p.Apellidos as ApellidosProveedor, gt.Nombre as NombreGruasTipo,p.Identificacion as IdentificacionProveedor")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
		->where("IdGrua=?",$IdGrua)->fetch();
		//	;echo $q;die;
		return $q;
	}
	public function getGruaInfoPlaca($Placa){
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Gruas
		->select("Gruas.*, m.Nombre as NombreMarca, p.Nombres as NombresProveedor, p.Apellidos as ApellidosProveedor, gt.Nombre as NombreGruasTipo")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
		->where("Placa=?",$Placa)->fetch();
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
			'Clave' => $values['Clave'],
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
	public function getExistePlaca($IdGrua = null, $Placa){
		$ConnectionORM = new ConnectionORM();
		if($IdGrua!=null){
			$q = $ConnectionORM->getConnect()->Gruas
			->select("count(*) as cuenta")
			->where("IdGrua<>?",$IdGrua)
			->and("Placa=?",$Placa)->fetch();
		}else{
			$q = $ConnectionORM->getConnect()->Gruas
			->select("count(*) as cuenta")
			->where("Placa=?",$Placa)->fetch();
		}

		return $q;
	}
	public function getList($values)
	{
		$columns = array();
		$columns[0] = 'Placa';
		$columns[1] = 'gt.Nombre';
		$columns[2] = 'm.Nombre';
		$columns[3] = 'Modelo';
		$columns[4] = 'Color';
		$columns[5] = 'Anio';
		$column_order = $columns[0];
		$where = '1 = 1';
		$order = 'asc';
		$limit = $values['length'];
		$offset = $values['start'];

		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
			$where.=" AND p.IdProveedor = '".$values['IdProveedor']."'";
		}
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(Placa) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(gt.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(m.Nombre) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(Modelo) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(Color) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND Anio like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}


		if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
		{
			$column_order = $columns[$values['order'][0]['column']];
		}
		if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
		{
			$order = $values['order'][0]['dir'];//asc o desc
		}
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Gruas
		->select("Gruas.*,m.Nombre as NombreMarca, gt.Nombre as NombreGruaTipo")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
		->order("$column_order $order")
		->where("$where")
		->limit($limit,$offset);
		//echo $q;die;
		return $q;
	}
	public function getCountList($values)
	{
		$where = '1 = 1';
		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
			$where.=" AND p.IdProveedor = '".$values['IdProveedor']."'";
		}
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(Placa) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(gt.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND upper(m.Nombre) like ('%".strtoupper($values['columns'][2]['search']['value'])."%')";
		}
		if(isset($values['columns'][3]['search']['value']) and $values['columns'][3]['search']['value']!='')
		{
			$where.=" AND upper(Modelo) like ('%".strtoupper($values['columns'][3]['search']['value'])."%')";
		}
		if(isset($values['columns'][4]['search']['value']) and $values['columns'][4]['search']['value']!='')
		{
			$where.=" AND upper(Color) like ('%".strtoupper($values['columns'][4]['search']['value'])."%')";
		}
		if(isset($values['columns'][5]['search']['value']) and $values['columns'][5]['search']['value']!='')
		{
			$where.=" AND Anio like ('%".strtoupper($values['columns'][5]['search']['value'])."%')";
		}
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Gruas
		->select("count(*) as cuenta")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
		->where("$where")
		->fetch();
		return $q['cuenta'];
	}
	function getLoginGruero($values){

		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Gruas
		->select("Gruas.*,p.Nombres as NombresProveedor, p.Apellidos as ApellidosProveedor, p.Identificacion as IdentificacionProveedor,
		m.Nombre as NombreMarca,gt.Nombre as NombreGruaTipo")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
		->where("upper(Placa)=?",strtoupper($values['Placa']))
		->and('Clave=?',strtoupper($values['Clave']))
		->fetch();
		return $q;
	}
	function getGruasServicio($datos_servicio,$grados) {
		$Tokens = array();
		$mTopes = array(
			'supLat' => $datos_servicio["LatitudOrigen"] + $grados,
			'infLat' => $datos_servicio["LatitudOrigen"] - $grados,
			'supLng' => $datos_servicio["LongitudOrigen"] + $grados,
			'infLng' => $datos_servicio["LongitudOrigen"] - $grados
		);

		if(!isset($datos_servicio['IdGrua']) or $datos_servicio['IdGrua']==''){
			$where = " Disponible = 1
			AND
				((Latitud BETWEEN '".$mTopes['infLat']."'
				AND '".$mTopes['supLat']."'
				AND Longitud BETWEEN '".$mTopes['supLng']."'
				AND '".$mTopes['infLng']."'
			)
			OR IdEstado = '".$datos_servicio['IdEstadoOrigen']."'

			)";
		}else{
			$where = " Disponible = 1 and IdGrua = ".$datos_servicio['IdGrua']."";

		}

		$ConnectionORM = new ConnectionORM();
		$query = "SELECT IdGrua, Token FROM Gruas where $where";
		$q = $ConnectionORM->ejecutarPreparado($query);
		return $q;
	}

}
