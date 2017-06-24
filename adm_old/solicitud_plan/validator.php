<?php


 
 
	function validate($values,$files = null){

		
		
		$errors = array();
		$validator_values = array();
		/*$validator_values['idPlan'] = array(
			
			"minlength" => 1,
			"maxlength" => 100,
			"type" => "number",
			"label" => "idPlan",
			"required" => true
		);	*/	
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
			"label" => "Correo electrónico",
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
		$validator_values['Estado'] = array(
			
			"type" => "text",
			"label" => "Estado",
			"required" => true
		);
		$validator_values['Domicilio'] = array(
			
			"type" => "text",
			"label" => "Dirección de domicilio",
			"required" => true,
			"minlength" => 5,
			"maxlength" => 200,
		);
		$validator_values['SerialMotor'] = array(
			
			"type" => "text",
			"label" => "Serial de motor",
			"required" => false,
			"minlength" => 5,
			"maxlength" => 30,
		);
		$validator_values['SerialCarroceria'] = array(
			
			"type" => "text",
			"label" => "Serial de carroceria",
			"required" => false,
			"minlength" => 5,
			"maxlength" => 50,
		);
		$validator_values['Clase'] = array(
			
			"type" => "text",
			"label" => "Clase",
			"required" => true,
			"minlength" => 2,
			"maxlength" => 50,
		);
		/*$validator_values['Puestos'] = array(
			
			"type" => "number",
			"label" => "Puestos",
			"required" => true
		);*/
		$ValidateBase = new ValidateBase();
		$errors = $ValidateBase->validate_base($validator_values, $values);
		
				
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
                if ( isset($values['Telefono']) and $values['Telefono']!='' and !preg_match("/^[0][2][1-9][1-9][0-9]{7}$/", $values['Telefono'], $matches))      
                {
                    $errors['Telefono'] = "Formato o número incorrecto (Ejemplo: 02121234567))";
                }
                if (!preg_match("/^[0][4][1-2][2,4,6][0-9]{7}$/", $values['Celular'], $matches))      
                {
                    $errors['Celular'] = "Formato o número incorrecto (Ejemplo: 04241234567)";
                }
                
                /*if(!isset($values['idPlan']) or $values['idPlan']==''){
                    $errors['idPlan'] = 'Debe seleccionar el plan a contratar';
                }*/
                if((!isset($values['RCV']) or $values['RCV'] == '') and (!isset($values['idPlan']) or $values['idPlan'] == '') and $values['action'] == 'add'){
                         $errors['idPlan'] = 'Debe indicar si requiere un plan TU/GRUERO.';
                         $errors['RCV'] = 'Debe indicar si requiere una póliza de RCV.';
                }
                if((isset($values['idPlan']) and $values['idPlan'] != '')){
                    
                    if(!isset($values['Kilometraje']) or $values['Kilometraje']==''){
                        $errors['Kilometraje'] = 'Debe indicar el Kilometraje a permitir';
                    }
                    if(!isset($values['CantidadServicios']) or $values['CantidadServicios']==''){
                        $errors['CantidadServicios'] = 'Debe indicar la cantidad de servicios';
                    }
                }
                if(isset($values['RCV']) and $values['RCV']=='SI'){
                    if(!isset($values['SerialMotor']) or $values['SerialMotor']==''){
                        $errors['SerialMotor'] = 'Debe indicar el serial del motor';
                    }
                    if(!isset($values['SerialCarroceria']) or $values['SerialCarroceria']==''){
                        $errors['SerialCarroceria'] = 'Debe indicar el serial de carroceria';
                    } 
                }
                if(!isset($values['Clase']) or $values['Clase']==''){
                    $errors['Sexo'] = 'Debe seleccionar la clase';
                }
                if(!isset($values['Sexo']) or $values['Sexo']==''){
                    $errors['Sexo'] = 'Debe seleccionar el sexo';
                }
                if(!isset($values['EstadoCivil']) or $values['EstadoCivil']==''){
                    $errors['EstadoCivil'] = 'Debe seleccionar el estado civil';
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
                if(isset($values['MET']) and $values['MET']=='TDC'){
                    if(!isset($values['id']) or $values['id']==''){
                        $errors['id'] = 'Debe colocar el id de la transacción';
                    }
                    if(!isset($values['payment_method_id']) or $values['payment_method_id']==''){
                        $errors['payment_method_id'] = 'Debe seleccionar el tipo de tarjeta';
                    }
                    if(!isset($values['payer_identification_number']) or $values['payer_identification_number']==''){
                        $errors['payer_identification_number'] = 'Debe colocar la cédula del tarjetahabiente';
                    }
                    if(!isset($values['carholder_name']) or $values['carholder_name']==''){
                        $errors['carholder_name'] = 'Debe colocar el nombre y apellido del tarjetahabiente (JOSE A PEREZ C)';
                    }
                    if(!isset($values['transaction_amount']) or $values['transaction_amount']==''){
                        $errors['transaction_amount'] = 'Debe colocar el monto de la transacción';
                    }    
                }
                /*if(!isset($values['MET']) or $values['MET']==''){
                    $errors['MET'] = 'Debe indicar el método de pago';
                }*/
				if( (isset($values['Correo']) and isset($values['Correo2']) ) and $values['Correo'] != $values['Correo2']  ){
						$errors['Correo2'] = 'Los correos electrónicos deben coincidir';
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
                        if($values['action']=='add'){
                            $errors['CedulaDoc']= "Debe seleccionar un archivo para la Cédula";
                        }
			
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
                        if($values['action']=='add'){
                           $errors['CarnetCirculacion']= "Debe seleccionar un archivo para el carnet de circulación";  
                        }
			
		}
		
                
                
/***************************Validación de archivos de pago************************/                
                if($values['MET'] == "DEP"){
                            

	
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
	