<?php
/*
 *
 */

class ValidateBase
{
	function validate_base($validator_values,$values){
		$errors = array();
		foreach($validator_values as $name => $key):
			//print_r($key);die;	
			//echo $name;die;
			
			$required = @$key['required'];
			$maxlength = @$key['maxlength'];
			$minlength = @$key['minlength'];
			
			if($required == true or $values[$name] !='')
			{
				//chequeo requerido
				$error = $this->required_validate($required, @$values[$name],$key['label']);
				if($error != '')
				{
					$errors[$name] = $error;
				}
				
				//chequeo min_lenght
				if(isset($key['minlength']))
				{
					$error = $this->minlength_validate($minlength, @$values[$name],$key['label']);
					if($error != '')
					{
						$errors[$name] = $error;
					}	
				}

				//chequeo max_lenght
				if(isset($key['maxlength']))
				{
					$error = $this->maxlength_validate($maxlength, @$values[$name],$key['label']);
					if($error != '')
					{
						$errors[$name] = $error;
					}
				}
				if(isset($key['type']))
				{
					if($key['type'] == "email")
					{
						$error = $this->email_validate($values[$name],$key['label']);
						if($error != '')
						{
							$errors[$name] = $error;
						}
					}
					if($key['type'] == "number")
					{
						$error = $this->number_validate($values[$name],$key['label']);
						if($error != '')
						{
							$errors[$name] = $error;
						}
					}

				}
				
			}
			
			
		endforeach;

		return $errors;
		
	}
	function required_validate($required, $validation_value,$name){
		$error = "";
		
			if($required == true)
			{
				
				if(strlen($validation_value) == 0)
				{
					$error = "El campo $name es requerido ";
				}			
			}
		return $error;		
	}
	function minlength_validate($minlength, $validation_value,$name){
		$error = "";
		if(strlen($validation_value)<$minlength)
		{
			$error = "El campo $name debe contener mínimo $minlength caracteres ";
		}
		return $error;
	}
	function maxlength_validate($maxlength, $validation_value,$name){
		$error = "";
		if(strlen($validation_value)>$maxlength)
		{
			$error = "El campo $name debe contener máximo $maxlength caracteres ";
		}
		return $error;		
	}
	function email_validate($validation_value,$name){
		$error = "";
		if (!filter_var($validation_value, FILTER_VALIDATE_EMAIL)) {
			$error = "El campo $name debe tener formato de correo electrónico";
		}
		return $error;
	}
	function number_validate($validation_value,$name){
		$error = "";
		if (!is_numeric($validation_value)) {
			$error = "El campo $name debe ser numérico";
		}
		return $error;
	}
	

	
}


