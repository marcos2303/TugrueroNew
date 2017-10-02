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
		$columns[6] = 'Clave';
		$columns[7] = 'p.Identificacion';
		$columns[8] = "CONCAT(p.Nombres, ' ' , p.Apellidos )";
		$columns[9] = 'e.Nombre';
		$columns[10] = 'p.Ciudad';
		$columns[11] = 'p.Zona';
		$columns[12] = 'p.Celular1';
		$columns[13] = 'p.Celular2';
		$columns[14] = 'p.Celular3';
		$columns[15] = 'Disponible';
		$column_order = $columns[0];
		$where = '1 = 1';
		$order = 'asc';
		$limit = $values['length'];
		$offset = $values['start'];

		if(isset($values['IdProveedor']) and $values['IdProveedor']!=''){
			$where.=" AND p.IdProveedor = '".$values['IdProveedor']."'";
		}
		if(isset($values['Estatus']) and $values['Estatus']!=''){
			$where.=" AND Gruas.Estatus = '".$values['Estatus']."'";
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
		if(isset($values['columns'][6]['search']['value']) and $values['columns'][6]['search']['value']!='')
		{
			$where.=" AND Clave like ('%".strtoupper($values['columns'][6]['search']['value'])."%')";
		}
		if(isset($values['columns'][7]['search']['value']) and $values['columns'][7]['search']['value']!='')
		{
			$where.=" AND e.Identificacion like ('%".strtoupper($values['columns'][7]['search']['value'])."%')";
		}
		if(isset($values['columns'][8]['search']['value']) and $values['columns'][8]['search']['value']!='')
		{
			$where.=" AND CONCAT(p.Nombres ,' ', p.Apellidos) like ('%".strtoupper($values['columns'][8]['search']['value'])."%')";
		}
		if(isset($values['columns'][9]['search']['value']) and $values['columns'][9]['search']['value']!='')
		{
			$where.=" AND e.Nombre like ('%".strtoupper($values['columns'][9]['search']['value'])."%')";
		}
		if(isset($values['columns'][10]['search']['value']) and $values['columns'][10]['search']['value']!='')
		{
			$where.=" AND p.Ciudad like ('%".strtoupper($values['columns'][10]['search']['value'])."%')";
		}
		if(isset($values['columns'][11]['search']['value']) and $values['columns'][11]['search']['value']!='')
		{
			$where.=" AND p.Zona like ('%".strtoupper($values['columns'][11]['search']['value'])."%')";
		}
		if(isset($values['columns'][12]['search']['value']) and $values['columns'][12]['search']['value']!='')
		{
			$where.=" AND p.Celular1 like ('%".strtoupper($values['columns'][12]['search']['value'])."%')";
		}
		if(isset($values['columns'][13]['search']['value']) and $values['columns'][13]['search']['value']!='')
		{
			$where.=" AND p.Celular2 like ('%".strtoupper($values['columns'][13]['search']['value'])."%')";
		}
		if(isset($values['columns'][14]['search']['value']) and $values['columns'][14]['search']['value']!='')
		{
			$where.=" AND p.Celular3 like ('%".strtoupper($values['columns'][14]['search']['value'])."%')";
		}
		if(isset($values['columns'][15]['search']['value']) and $values['columns'][15]['search']['value']!='')
		{
			$where.=" AND (CASE Disponible WHEN 0 THEN 'NO'  WHEN 1 THEN 'SI' WHEN 2 THEN 'EN SERVICIO' END)  like ('%".strtoupper($values['columns'][15]['search']['value'])."%')";
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
		->select("Gruas.*,m.Nombre as NombreMarca, gt.Nombre as NombreGruaTipo,
		p.Identificacion as IdentificacionProveedor,CONCAT(p.Nombres,' ',p.Apellidos ) as Proveedor, UPPER(e.Nombre) as NombreEstado,p.Ciudad as CiudadProveedor,
		p.Zona as ZonaProveedor,p.Celular1, p.Celular2,p.Celular3,
		CASE Disponible WHEN 0 THEN 'NO'  WHEN 1 THEN 'SI' WHEN 2 THEN 'EN SERVICIO' END AS Disponible
		")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("Estados","INNER JOIN Estados e on e.IdEstado = p.IdEstado")
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
		->join("Estados","INNER JOIN Estados e on e.IdEstado = p.IdEstado")
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
	public function getGruasMapa(){
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Gruas
		->select("Gruas.*, m.Nombre as NombreMarca,
		p.Nombres as NombresProveedor, p.Apellidos as ApellidosProveedor, p.Celular1 as Celular1Proveedor,p.Celular2 as Celular2Proveedor,p.Celular3 as Celular3Proveedor,
		gt.Nombre as NombreGruasTipo")
		->join("Proveedores","INNER JOIN Proveedores p on p.IdProveedor = Gruas.IdProveedor")
		->join("Marcas","INNER JOIN Marcas m on m.IdMarca = Gruas.IdMarca")
		->join("GruasTipos","INNER JOIN GruasTipos gt on gt.IdGruaTipo = Gruas.IdGruaTipo")
		->where("Gruas.Estatus=?",1)
		->and("Latitud<>?","")
		->and("Longitud<>?","");
		//echo $q;die;
		return $q;
	}
	public function getGruerosOnOffLine(){
		$ConnectionORM = new ConnectionORM();
		$query = "SELECT * FROM (
			(SELECT COUNT(*) AS online FROM Gruas WHERE Estatus = 1) AS online,
			(SELECT COUNT(*) AS offline FROM Gruas WHERE Estatus = 0) AS offline ,
			(SELECT COUNT(*) AS onservice FROM Gruas WHERE Estatus = 2) AS onservice)";

			$q = $ConnectionORM->ejecutarPreparado($query);

			return $q;
		}
		public function getGruerosPorEstatus($Estatus){
			$ConnectionORM = new ConnectionORM();
			$query = "SELECT * FROM Gruas where Estatus = '".$Estatus."' ";

			$q = $ConnectionORM->ejecutarPreparado($query);

				return $q;
			}
	}
