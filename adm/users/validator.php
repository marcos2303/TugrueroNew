<?php


 
 
	function validate($values){
		$errors = array();
		$validator_values = array();
		
		$validator_values['login'] = array(
			
			"minlength" => 3,
			"maxlength" => 20,
			"type" => "text",
			"label" => "Login",
			"required" => true
		);
		$validator_values['password'] = array(
			
			"minlength" => 6,
			"maxlength" => 12,
			"type" => "text",
			"label" => "Password",
			"required" => true
		);
		
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		return $errors;
		
		
	}
	