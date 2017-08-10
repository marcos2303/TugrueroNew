<?php

	function validaFormulario($values)
	{
		$errors = array();
		if(count($values)>0)
		{
			foreach($values as $campos)
			
				if(empty($campos))
					{
						echo $campos;die;
						$errors[]="Todos los campos deben ser llenados";
					}
		}
		
		return $errors;
	}
	function validaFormulario2($values)
	{
		$errors = array();
		if(count($values)>0)
		{
			foreach($values as $campos)
			
				if(empty($campos))
					{
						$errors[]="Todos los campos deben ser llenados";
					}
		}
	}