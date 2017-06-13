<?php

	function validaFormularioUsers($values)
	{
		$errors = array();
		if(count($values)>0)
		{
			if($values['action'] == 'add')
			{
				if(empty($values['first_name']) || empty($values['first_last_name']) || empty($values['nationality'])
						|| empty($values['document']) || empty($values['gender']) || empty($values['mail']))
					{
						$errors['campos']="Todos los campos deben ser llenados";
					}
				if(isset($values["mail"]) and !filter_var($values["mail"], FILTER_VALIDATE_EMAIL))
				{
					$errors['correo'] = "correo invalido";
				}
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