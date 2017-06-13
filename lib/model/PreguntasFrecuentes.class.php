<?php
    class PreguntasFecuentes 
    {
        

		function getPreguntasRespuestas()
		{
			
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect('tugruero')->PreguntasFrecuentes
                        ->select("*")
                        ->where('Estado=?','Activo')
                        ->order('orden');
			$ConnectionORM -> close();
			return $q;            
        }
    }