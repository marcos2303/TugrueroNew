<?php

	class ServiciosEstatus {


    function addServiciosEstatus($values){

  		$array = array(
  			'IdServicio' => $values['IdServicio'],
  			'IdEstatus' => $values['IdEstatus'],
  			'Fecha' => $values['Fecha'],
  			'Hora' => $values['Hora'],
  			'FechaEstatus' => date("Y-m-d h:i:s"),
        'IdUsuario' => $values['IdUsuario']
  		);
  		$ConnectionORM = new ConnectionORM();
  		$q = $ConnectionORM->getConnect()->ServiciosEstatus()->insert($array);
  		return $q;
  	}

    function existeServicioEstatus($values){

        $ConnectionORM = new ConnectionORM();
        $q = $ConnectionORM->getConnect()->ServiciosEstatus
        ->select("count(*) as cuenta")
        ->where("IdServicio=?",$values['IdServicio'])
        ->and("IdEstatus=?",$values['IdEstatus'])
        ->fetch();
        return $q['cuenta'];

    }
    function updateServiciosEstatus($values){

      $query = "UPDATE ServiciosEstatus
      set Fecha = '".$values['Fecha']."' ,
			Hora = '".$values['Hora']."',
      FechaEstatus = '".$values['FechaEstatus']."',
      IdUsuario = '".$values['IdUsuario']."'
      WHERE IdServicio = ".$values['IdServicio']."
      AND IdEstatus = ".$values['IdEstatus']."
			";
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;

		}
    function deleteServiciosEstatus($values){

      $query = "DELETE FROM ServiciosEstatus
      WHERE IdServicio = ".$values['IdServicio']."
      AND IdEstatus = ".$values['IdEstatus']."
			";
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
			return $q;

		}
    function getEstatusAnterior($values){

      $query = "SELECT se.IdEstatus
      FROM ServiciosEstatus se
      INNER JOIN Estatus e ON e.IdEstatus = se.IdEstatus
      WHERE se.IdServicio = ".$values['IdServicio']."
      ORDER BY e.Orden DESC
      LIMIT 1";
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
      $q = $q->fetch();
			return $q;

		}
    function getOrdenServicioEstatus($values){

      $query = "SELECT e.Orden
      FROM ServiciosEstatus se
      INNER JOIN Estatus e ON e.IdEstatus = se.IdEstatus
      WHERE se.IdServicio = ".$values['IdServicio']."
      ORDER BY e.Orden DESC
      LIMIT 1";
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
      $q = $q->fetch();
			return $q;

		}
    function getServicioEstatus($values){

      $query = "SELECT s.IdEstatus, Orden
      FROM ServiciosEstatus se
      INNER JOIN Servicios s ON s.IdServicio = se.IdServicio
      INNER JOIN Estatus e ON e.IdEstatus = se.IdEstatus
      WHERE se.IdServicio = ".$values['IdServicio']."
      ORDER BY e.Orden DESC
      LIMIT 1";
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
      $q = $q->fetch();
			return $q;

		}
    function getEstatusOrden($values){

      $query = "SELECT Orden From Estatus where IdEstatus = ".$values['IdEstatus']." ";
			$ConnectionORM= new ConnectionORM();
			$q = $ConnectionORM->ejecutarPreparado($query);
      $q = $q->fetch();
			return $q;

		}
  }
