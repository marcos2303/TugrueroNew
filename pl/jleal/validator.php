<?php


 
 
	function validate($values,$files = null){

		
		
		$errors = array();
		$validator_values = array();
		$validator_values['idPlan'] = array(
			
			"minlength" => 1,
			"maxlength" => 100,
			"type" => "number",
			"label" => "Nombres",
			"required" => true
		);		
		$validator_values['Nombres'] = array(
			
			"minlength" => 3,
			"maxlength" => 100,
			"type" => "text",
			"label" => "Nombres",
			"required" => true
		);
		$validator_values['Apellidos'] = array(
			
			"minlength" => 3,
			"maxlength" => 100,
			"type" => "text",
			"label" => "Apellidos",
			"required" => true
		);
		$validator_values['FechaNacimiento'] = array(
			
			"minlength" => 10,
			"maxlength" => 10,
			"type" => "text",
			"label" => "Fecha de nacimiento",
			"required" => true
		);
		$validator_values['Ciudad'] = array(
			
			"minlength" => 3,
			"maxlength" => 30,
			"type" => "text",
			"label" => "Ciudad",
			"required" => true
		);
		$validator_values['Cedula'] = array(
			
			"minlength" => 7,
			"maxlength" => 10,
			"type" => "text",
			"label" => "Cédula",
			"required" => true
		);
		$validator_values['Rif'] = array(
			
			"minlength" => 7,
			"maxlength" => 11,
			"type" => "text",
			"label" => "RIF",
			"required" => true
		);
		$validator_values['Correo'] = array(
			
			"minlength" => 1,
			"maxlength" => 100,
			"type" => "email",
			"label" => "",
			"required" => true
		);
		$validator_values['Correo2'] = array(
			
			"minlength" => 1,
			"maxlength" => 100,
			"type" => "email",
			"label" => "",
			"required" => true
		);
		$validator_values['Telefono'] = array(
			
			"minlength" => 11,
			"maxlength" => 11,
			"type" => "number",
			"label" => "Teléfono de habitación",
			"required" => false
		);
		$validator_values['Celular'] = array(
			
			"minlength" => 11,
			"maxlength" => 11,
			"type" => "number",
			"label" => "Celular",
			"required" => true
		);
		$validator_values['Marca'] = array(
			
			"minlength" => 1,
			"maxlength" => 50,
			"type" => "text",
			"label" => "Marca",
			"required" => true
		);
		$validator_values['Modelo'] = array(
			
			"minlength" => 1,
			"maxlength" => 20,
			"type" => "text",
			"label" => "Marca",
			"required" => true
		);
		$validator_values['Color'] = array(
			
			"minlength" => 3,
			"maxlength" => 20,
			"type" => "text",
			"label" => "Color",
			"required" => true
		);
		$validator_values['Placa'] = array(
			
			"minlength" => 5,
			"maxlength" => 7,
			"type" => "text",
			"label" => "Placa",
			"required" => true
		);
		$validator_values['Puestos'] = array(
			
			"type" => "number",
			"label" => "Puestos",
			"required" => true
		);
		$validator_values['Estado'] = array(
			
			"type" => "text",
			"label" => "Estado",
			"required" => true
		);
		$validator_values['Domicilio'] = array(
			
			"type" => "text",
			"label" => "Dirección de domicilio",
			"required" => true,
			"minlength" => 10,
			"maxlength" => 200,
		);
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		
				$securimage = new Securimage();
				$captcha = $values['ct_captcha'];
				if ($securimage->check($captcha) == false) {
				  
						$errors['captcha_error'] = "Imagen incorrecta";
				}
				
				
				
                if (!preg_match("/^[A-Z a-z]{3,80}$/", $values['Nombres'], $matches))      
                {
                    $errors['Nombres'] = "El campo debe contener solamente letras";
                }
                if (!preg_match("/^[A-Z a-z]{3,80}$/", $values['Apellidos'], $matches))      
                {
                    $errors['Apellidos'] = "El campo debe contener solamente letras";
                }
                if (!preg_match("/^[Vv,Ee][-][1-9][0-9]{5,7}$/", $values['Cedula'], $matches))      
                {
                    $errors['Cedula'] = "Verifique el formato de la cédula (V-1234567)";
                }
                if (!preg_match("/^[Vv,Ee][-][0-9]{6,9}$/", $values['Rif'], $matches))      
                {
                    $errors['Rif'] = "Verifique el formato del RIF (V-12345670)";
                }
                if (!preg_match("/^\\d{1,2}\\/\\d{1,2}\\/\\d{4}$/", $values['FechaNacimiento'])) {
                     $errors['FechaNacimiento'] = "Verifique el formato de la fecha de nacimiento (01/01/1980)";
                }
                if ( isset($values['Telefono']) and $values['Telefono']!='' and !preg_match("/^[0][2][1-9][1-9][0-9]{7}$/", $values['Telefono'], $matches))      
                {
                    $errors['Telefono'] = "Formato o número incorrecto (Ejemplo: 02121234567))";
                }
                if (!preg_match("/^[0][4][1-2][2,4,6][0-9]{7}$/", $values['Celular'], $matches))      
                {
                    $errors['Celular'] = "Formato o número incorrecto (Ejemplo: 04241234567)";
                }
                
                
                if(!isset($values['Sexo']) or $values['Sexo']==''){
                    $errors['Sexo'] = 'Debe seleccionar el sexo';
                }
                if(!isset($values['EstadoCivil']) or $values['EstadoCivil']==''){
                    $errors['EstadoCivil'] = 'Debe seleccionar el estado civil';
                }   
                if(!isset($values['idPlan']) or $values['idPlan']==''){
                    $errors['idPlan'] = 'Debe seleccionar el plan a contratar';
                }
                if(!isset($values['RCV']) or $values['RCV']==''){
                    $errors['RCV'] = 'Debe indicar si elige RCV';
                }
                if(!isset($values['Clase']) or $values['Clase']==''){
                    $errors['Clase'] = 'Debe seleccionar la Clase';
                }
                if(!isset($values['Marca']) or $values['Marca']==''){
                    $errors['Marca'] = 'Debe seleccionar la marca';
                }
                if(!isset($values['Anio']) or $values['Anio']==''){
                    $errors['Anio'] = 'Debe seleccionar el año';
                }
                if(!isset($values['Tipo']) or $values['Tipo']=='' and $values['Clase']!='Moto'){
                    
                    $errors['Tipo'] = 'Debe seleccionar el tipo de vehículo';
                } 
                if(!isset($values['MET']) or $values['MET']==''){
                    $errors['MET'] = 'Debe indicar el método de pago';
                }
		if( (isset($values['Correo']) and isset($values['Correo2']) ) and $values['Correo'] != $values['Correo2']  ){
                    $errors['Correo2'] = 'Los correos electrónicos deben coincidir';
		}
                

                /**************valido que esa placa no se encuentre en una solicitud que este en proceso para evitar duplicados******************************************/
                
                if(isset($values['Placa']) and $values['Placa']!=''){
                    $SolicitudPlan = new SolicitudPlan();
                    $solicitud_placa_enproceso = $SolicitudPlan->getSolicitudPorPlaca($values);
                    if($solicitud_placa_enproceso>0 ){
                        $errors['global'] = 'Ya se encuentra una solicitud en proceso para la placa indicada';
                    }
                    
                }
                
                
                
                
          /******************Validación de archivos*************************/ 
        //echo $files['Licencia']['size'];die;
		$array_extensions = array('jpg','JPG','PNG','png','jpeg','JPEG','pdf','PDF','octet-stream');
		
                
		if($_FILES['CedulaDoc']['size']>0)
		{
			if(!in_array(pathinfo($_FILES['CedulaDoc']['name'],PATHINFO_EXTENSION),$array_extensions)) 
			{
				$errors['CedulaDoc']= "Solamente se permiten los tipos de archivos JPG, JPEG, PNG y PDF";
			}
			if($_FILES['CedulaDoc']['size']>max_input_size)
			{
				$errors['CedulaDoc']= message_max_size;
			}
		}else
		{
			$errors['CedulaDoc']= "Debe seleccionar un archivo para la Cédula";
		}
               
		if($_FILES['CarnetCirculacion']['size']>0)
		{
			if(!in_array(pathinfo($_FILES['CarnetCirculacion']['name'],PATHINFO_EXTENSION),$array_extensions)) 
			{
				$errors['CarnetCirculacion']= "Solamente se permiten los tipos de archivos JPG, JPEG, PNG y PDF";
			}
			if($_FILES['CarnetCirculacion']['size']>max_input_size)
			{
				$errors['CarnetCirculacion']= message_max_size;
			}
		}else
		{
			$errors['CarnetCirculacion']= "Debe seleccionar un archivo para el carnet de circulación";
		}
		
                
                
/***************************Validación de archivos de pago************************/                
		if(isset($values['MET']) and  $values['MET']=='DEP')
		{
			if($_FILES['DEP1']['size']>0)
			{
				if(!in_array(pathinfo($_FILES['DEP1']['name'],PATHINFO_EXTENSION),$array_extensions)) 
				{
					$errors['DEP1']= "Solamente se permiten los tipos de archivos JPG, JPEG, PNG y PDF";
				}
				if($_FILES['DEP1']['size']>max_input_size)
				{
					$errors['DEP1']= message_max_size;
				}
			}else
			{
				$errors['DEP1']= "Debe seleccionar el archivo de transferencia o deposito bancario";
			}
			
			if($_FILES['DEP2']['size']>0)
			{
				if(!in_array(pathinfo($_FILES['DEP2']['name'],PATHINFO_EXTENSION),$array_extensions)) 
				{
					$errors['DEP2']= "Solamente se permiten los tipos de archivos JPG, JPEG, PNG y PDF";
				}
				if($_FILES['DEP2']['size']>max_input_size)
				{
					$errors['DEP2']= message_max_size;
				}
			}
			if($_FILES['DEP3']['size']>0)
			{
				if(!in_array(pathinfo($_FILES['DEP3']['name'],PATHINFO_EXTENSION),$array_extensions)) 
				{
					$errors['DEP3']= "Solamente se permiten los tipos de archivos JPG, JPEG, PNG y PDF";
				}
				if($_FILES['DEP3']['size']>max_input_size)
				{
					$errors['DEP3']= message_max_size;
				}
			}
		}                
                
                
                
                return $errors;
		
		
	}
	