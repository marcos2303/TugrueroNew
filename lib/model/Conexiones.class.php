<?php

	class Conexiones {
	public function getListConexionesGruas($values)
	{
		$columns = array();
		$columns[0] = 'a.Nombre';
		$columns[1] = 'c.Nombre';
		$columns[2] = 'Fecha';
		$column_order = $columns[0];
		$where = '1 = 1 AND ct.IdConexionTipo = 1';
		$order = 'asc';
		$limit = $values['length'];
		$offset = $values['start'];


        if(isset($values['IdAplicacion']) and $values['IdAplicacion']!=''){
			$where.=" AND a.IdAplicacion = '".$values['IdAplicacion']."'";
		}
        if(isset($values['IdUsuario']) and $values['IdUsuario']!=''){
			$where.=" AND Conexiones.IdUsuario = '".$values['IdUsuario']."'";
		}
        
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(a.Nombre) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(c.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND Fecha >= ('".strtoupper($values['columns'][2]['search']['value'])."') and Fecha <= ('".strtoupper($values['columns'][2]['search']['value'])."') ";
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
		$q = $ConnectionORM->getConnect()->Conexiones
		->select("Conexiones.*,a.Nombre as NombreAplicacion, ct.Nombre as NombreConexionTipo")
		->join("Aplicaciones","INNER JOIN Aplicaciones a on a.IdAplicacion = Conexiones.IdAplicacion")
		->join("ConexionesTipos","INNER JOIN ConexionesTipos ct on ct.IdConexionTipo = Conexiones.IdConexionTipo")
		->order("$column_order $order")
		->where("$where")
		->limit($limit,$offset);
        //echo $q;die;
		return $q;
	}
	public function getCountListConexionesGruas($values)
	{
		$where = '1 = 1 AND ct.IdConexionTipo = 1';
        
        if(isset($values['IdAplicacion']) and $values['IdAplicacion']!=''){
			$where.=" AND a.IdAplicacion = '".$values['IdAplicacion']."'";
		}
        if(isset($values['IdUsuario']) and $values['IdUsuario']!=''){
			$where.=" AND Conexiones.IdUsuario = '".$values['IdUsuario']."'";
		}
		if(isset($values['columns'][0]['search']['value']) and $values['columns'][0]['search']['value']!='')
		{
			$where.=" AND upper(a.Nombre) like ('%".strtoupper($values['columns'][0]['search']['value'])."%')";
		}
		if(isset($values['columns'][1]['search']['value']) and $values['columns'][1]['search']['value']!='')
		{
			$where.=" AND upper(c.Nombre) like ('%".strtoupper($values['columns'][1]['search']['value'])."%')";
		}
		if(isset($values['columns'][2]['search']['value']) and $values['columns'][2]['search']['value']!='')
		{
			$where.=" AND Fecha >= ('".strtoupper($values['columns'][2]['search']['value'])."') and Fecha <= ('".strtoupper($values['columns'][2]['search']['value'])."') ";
		}
		$ConnectionORM = new ConnectionORM();
		$q = $ConnectionORM->getConnect()->Conexiones
		->select("count(*) as cuenta")
		->join("Aplicaciones","INNER JOIN Aplicaciones a on a.IdAplicacion = Conexiones.IdAplicacion")
		->join("ConexionesTipos","INNER JOIN ConexionesTipos ct on ct.IdConexionTipo = Conexiones.IdConexionTipo")
		->where("$where")
		->fetch();
		return $q['cuenta'];
	}
		public function getConexionesUsuario($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Conexiones
			->select("*")
			->where("IdConexionTipo=?",$values['IdConexionTipo'])
            ->and("IdUsuario=?",$values["IdUsuario"])
            ->and("IdAplicacion=?",$values["IdAplicacion"])
            ->order("IdConexion desc");
			return $q;
		}
		public function getCuentaConexionesUsuario($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Conexiones
			->select("count(*) as cuenta")
			->where("IdConexionTipo=?",$values['IdConexionTipo'])
            ->and("IdUsuario=?",$values["IdUsuario"])
            ->and("IdAplicacion=?",$values["IdAplicacion"])
            ->order("IdConexion desc")
            ->fetch();
			return $q["cuenta"];
		}
		public function getUltimaConexion($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Conexiones
			->select("DATE_FORMAT(Fecha, '%d/%m/%Y %H:%i:%s') as Fecha")
			->where("IdConexionTipo=?",$values['IdConexionTipo'])
            ->and("IdUsuario=?",$values["IdUsuario"])
            ->and("IdAplicacion=?",$values["IdAplicacion"])
            ->order("IdConexion desc")
            ->limit(1)
            ->fetch();
			return $q['Fecha'];
		}
        function addConexion($values){
            $array = array(

                'IdConexionTipo' => $values['IdConexionTipo'],
                'IdAplicacion' => $values['IdAplicacion'],
                'IdUsuario' => $values['IdUsuario'],
                'Fecha' => date('Y-m-d h:i:s')
            );

            $ConnectionORM = new ConnectionORM();
            $q = $ConnectionORM->getConnect()->Conexiones()->insert($array);

            return $q;
        }
    }