<?php include("../../autoload.php");?>	
<?php //include("validator.php");?>
<?php include("../security/security.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
$values = array_merge($values,$_FILES);
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "new":
			executeNew($values);	
		break;
		case "add":
			executeSave($values);	
		break;
		case "edit":
			executeEdit($values);	
		break;
		case "update":
			executeUpdate($values);	
		break;		
		case "list_json":
			executeListJson($values);	
		break;
		case "poliza_masiva":
			executePolizaMasiva($values);	
		break;
		case "subir_polizas":
			executeSubirPolizas($values);	
		break;		
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
	{
		require('list_view.php');
	}
	function executeNew($values = null)
	{       
        $values['Estatus'] = '1';
		$values['action'] = 'add';
		$values['EstatusPoliza'] = 'Activo';
		require('form_view.php');
	}
	function executeSave($values = null)
	{
		$Polizas = new Polizas();
		//$values = $Polizas->savePolizas($values);
		executeEdit($values,message_created);die;
	}
	function executeEdit($values = null,$msg = null)
	{
		
		$Polizas = new Polizas();
		$values = $Polizas->getPolizasById($values);
		$values['action'] = 'update';
                $values['msg'] = $msg;
		
		require('form_view.php');
	}
	function executeUpdate($values = null)
	{
		$Polizas = new Polizas();
		$Polizas->updatePolizas($values);
		executeEdit($values,message_updated);die;
	}	
	function executeListJson($values)
	{
		$Polizas = new Polizas();
		$list_json = $Polizas ->getPolizasList($values);
		$list_json_cuenta = $Polizas ->getCountPolizasList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				$EstatusPoliza = null;
				if($list['dias_vencimiento'] > 0)
				{
					$EstatusPoliza = 'Vencido';
				}
				$IdPoliza = $list['IdPoliza'];
				$array_json['data'][] = array(
					"IdPoliza" => $IdPoliza,
					"Seguro" => $list['Seguro'],
					"NumPoliza" => $list['NumPoliza'],
					"Placa" => $list['Placa'],
					"Cedula" => $list['Cedula'],
					"EstatusPoliza" => $EstatusPoliza,
                    "NombresApellidos" => $list['Nombres'].' '.$list['Apellidos'],
                    "Vencimiento" => $list['Vencimiento'],
					"actions" => 
                                       '<form method="POST" action = "'.full_url.'/adm/Polizas/index.php" >'
                                       .'<input type="hidden" name="action" value="edit">  '
                                       .'<input type="hidden" name="IdPoliza" value="'.$IdPoliza.'">  '
                                       .'<button class="btn btn-default btn-sm" title="Ver detalle" type="submit"><i class="fa fa-edit  fa-pull-left fa-border"></i></button>'
                                       
										.'</form>'
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("IdPoliza"=>null,"Seguro"=>"","NumPoliza"=>"","Placa"=>"","Cedula"=>"","EstatusPoliza" => null,"NombresApellidos"=>"","Vencimiento"=>"","actions"=>"");
		}
		echo json_encode($array_json);die;
		
	}
	function executePolizaMasiva($values = null,$errors = null)
	{
		$values['action'] = 'subir_polizas';
		require('masiva_form.php');
	}
	function executeSubirPolizas($values = null)
	{
		$values['action'] = 'subir_polizas';
		$valid = true;
		$array = array();
			if(isset($values['Archivo']) and $_FILES['Archivo']['size']>0)
			{
						//obtenemos el archivo .csv
						$tipo = $_FILES['Archivo']['type'];
						$tamanio = $_FILES['Archivo']['size'];

						$archivotmp = $_FILES['Archivo']['tmp_name'];

						//cargamos el archivo
						$lineas = file($archivotmp);

						//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
						$i=0;
						$arreglo = array(array());
						$arreglo_errores = array();
						//Recorremos el bucle para leer línea por línea
						foreach ($lineas as $linea_num => $linea)
						{ 
						   //abrimos bucle
						   /*si es diferente a 0 significa que no se encuentra en la primera línea 
						   (con los títulos de las columnas) y por lo tanto puede leerla*/
						   if($i != 0) 
						   { 
							   //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
							   /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
							   leyendo hasta que encuentre un ; */
							   $datos = explode(",",$linea);

							   //Almacenamos los datos que vamos leyendo en una variable
							   $seguro = trim($datos[0]);
							   $numpoliza = trim($datos[1]);
							   $nacionalidad = trim($datos[2]);
							   $cedula = trim($datos[3]);
							   $nombres = trim($datos[4]);
							   $apellidos = trim($datos[5]);
							   $direccion = trim($datos[6]);
							   $celular = trim($datos[7]);
							   $email = trim($datos[8]);
							   $tipo = trim($datos[9]);
							   $marca = trim($datos[10]);
							   $modelo = trim($datos[11]);
							   $color = trim($datos[12]);
							   $anio = trim($datos[13]);
							   $placa = trim($datos[14]);
							   $serialcarroceria = trim($datos[15]);
							   $desdevigencia= trim($datos[16]);
							   $vencimiento = trim($datos[17]);
							   $estado = trim($datos[18]);
							   if(!isset($seguro) or $seguro == "")
							   {
								   $arreglo_errores[$i] = "error en seguro fila[$i]";
								   $valid = false;
							   }
							   if(!isset($numpoliza) or $numpoliza == "")
							   {
								   $arreglo_errores[$i] = "error en numpoliza fila[$i]";
								   $valid = false;
							   }
							   if(!isset($nacionalidad) or $nacionalidad == "")
							   {
								   $arreglo_errores[$i] = "error en nacionalidad fila[$i]";
								   $valid = false;
							   }
							   if(!isset($cedula) or $cedula == "")
							   {
								   $arreglo_errores[$i] = "error en cedula fila[$i]";
								   $valid = false;
							   }
							   if(!isset($nombres) or $nombres == "")
							   {
								   $arreglo_errores[$i] = "error en nombres fila[$i]";
								   $valid = false;
							   }
							   if(!isset($apellidos) or $apellidos == "")
							   {
								   $arreglo_errores[$i] = "error en apellidos fila[$i]";
								   $valid = false;
							   }
							   if(!isset($direccion) or $direccion == "")
							   {
								   $direccion = "N/A";
								   $arreglo_errores[$i] = "error en direccion fila[$i]";
								   $valid = false;
							   }
							   if(!isset($celular) or $celular == "")
							   {
								   $celular = "N/A";
								   $arreglo_errores[$i] = "error en celular fila[$i]";
								   //$valid = false;
							   }
							   if(!isset($email) or $email == "")
							   {
								   $email = "N/A";
								   $arreglo_errores[$i] = "error en email fila[$i]";
								   //$valid = false;
							   }
							   if(!isset($tipo) or $tipo == "")
							   {
								   $tipo = "N/A";
								   $arreglo_errores[$i] = "error en tipo de vehiculo fila[$i]";
								   $valid = false;
							   }
							   if(!isset($marca) or $marca == "")
							   {
								   $arreglo_errores[$i] = "error en marca fila[$i]";
								   $valid = false;
							   }
							   if(!isset($modelo) or $modelo == "")
							   {
								   $arreglo_errores[$i] = "error en modelo fila[$i]";
								   $valid = false;
							   }
							   if(!isset($color) or $color == "")
							   {
								   $arreglo_errores[$i] = "error en color fila[$i]";
								   $valid = false;
							   }
							   if(!isset($anio) or $anio == "")
							   {
								   $anio = 'NA';
								   $arreglo_errores[$i] = "error en anio fila[$i]";
								   //$valid = false;
							   }
							   if(!isset($placa) or $placa == "")
							   {
								   $placa = "N/A";
								   $arreglo_errores[$i] = "error en placa fila[$i]";
								   $valid = false;
							   }
							   if(!isset($serialcarroceria) or $serialcarroceria == "")
							   {
								   $serialcarroceria = 'N/A';
								   $arreglo_errores[$i] = "error en serialcarroceria fila[$i]";
								   $valid = false;
							   }
							   if(!isset($vencimiento) or $vencimiento == "")
							   {
								   $arreglo_errores[$i] = "error en vencimiento fila[$i]";
								   $valid = false;
							   }
							   if(!isset($desdevigencia) or $desdevigencia == "")
							   {
								   $arreglo_errores[$i] = "error en desde vigencia fila[$i]";
								   //$valid = false;
							   }
							   if(!isset($estado) or $estado == "")
							   {
								   $arreglo_errores[$i] = "error en estado fila[$i]";
								   $valid = false;
							   }
							$array[$i] = array(
								"Seguro" => $seguro,
								"NumPoliza" => $numpoliza,
								"Nacionalidad" => $nacionalidad,
								"Cedula" => $nacionalidad."-".$cedula,
								"Nombres" => $nombres,
								"Apellidos" => $apellidos,
								"Domicilio" => $direccion,
								"Celular" => $celular,
								"Email" => $email,
								"Tipo" => $tipo,
								"Marca" => $marca,
								"Modelo" => $modelo,
								"Color"=> $color,
								"Año" => $anio,
								"Placa" => $placa,
								"Serial" => $serialcarroceria,
								"DesdeVigencia" => $desdevigencia,
								"Vencimiento" => $vencimiento,								
								"DireccionEdo" => $estado,
								); 
								/*if($valid == true)
								{
									echo $seguro." ".$numpoliza." ".$nacionalidad." ".$cedula." "
										. "".$nombres." ".$apellidos." ".$direccion." ".$marca." ".$modelo." "
										. "".$anio." ".$placa." ".$serialcarroceria." ".$vencimiento." ".$estado."<br>";
								}*/


							   //guardamos en base de datos la línea leida
							   //mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion')");

							   //cerramos condición
						   }

						   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
						   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
						   $i++;
						   //cerramos bucle
						}//endforeach;



			}
			if($valid == true)
			{
				$Polizas = new Polizas();
				$Polizas->insertPoliza($array);
				$values["msg"] = "Datos cargados satisfactoriamente";
			}else
			{
				//print_r($array_errores);die;
			}		
			executePolizaMasiva($values,$arreglo_errores);
		
	}