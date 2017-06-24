<?php include("../../autoload.php");?>	
<?php //include("validator.php");?>
<?php include("../security/security.php");?>

<?php $action = "";

if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
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
		case "list_json":
            executeListJson($values);	
		break;
		case "livemap":
            executeLivemap($values);	
		break;
		case "json_test":
            executeJsonTest($values);	
		break;
		case "solicitud_livemap":
            executeSolicitudLivemap($values);	
		break;
		case "solicitudes_livemap":
            executeSolicitudesLivemap($values);	
		break;
		case "json_solicitud_livemap":
            executeJsonSolicitudLivemap($values);	
		break;	
		case "json_solicitudes_livemap":
            executeJsonSolicitudesLivemap($values);	
		break;
		case "bitacora_list":
            executeBitacoraList($values);	
		break;
		case "save_bitacora":
            executeSaveBitacora($values);	
		break;
		case "simulador_view":
            executeSimuladorView($values);	
		break;
		case "gruero_select":
            executeGrueroSelect($values);	
		break;
		case "gruero_select_datatable_index":
            executeGrueroSelectDatatableIndex($values);	
		break;	
		case "gruero_select_datatable":
            executeGrueroSelectDatatable($values);	
		break;
		case "json_cliente":
            executeJsonCliente($values);	
		break;
		case "json_baremo":
            executeJsonBaremo($values);	
		break;
		case "actualiza_monto":
            executeActualizaMonto($values);	
		break;
		case "prueba_map":
            executePruebaMap($values);	
		break;
		case "grueros_mapa":
            executeGruerosMapa($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null)
        {       

                
		require('list_view.php');
	}
	function executeListJson($values)
	{	
		$Utilitarios = new Utilitarios();
		$Solicitud = new Solicitud();
                $Bitacora = new Bitacora();
		$list_json = $Solicitud ->getSolicitudesActivasList($values);
		$list_json_cuenta = $Solicitud ->getCountSolicitudesActivasList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				
				$end_time = date(gmdate('d-m-Y H:i:s', time() - (4 * 3600)));
                                
				$start_time = $list['laststatussolicitudn'];
				$minutos_transcurridos = $Utilitarios->calcula_tiempo_minutos($start_time, $end_time);
				$status_desierto = 0;
				$retardo_activo_activo  = 0;
				if(($minutos_transcurridos >=2 /*or $list['numgruas'] == 0*/)  and ($list['estatus'] == 'Localizando'))
				{
					
					//actualizar a status desierto
					$Solicitud->updateStatusDesierto($list);
					$list['estatus'] = "Desierto";
					//$status_desierto = 1;
				}
				//valido que el tiempo de encontrar el gruero al cliente no sea mayor a 20 minutos
				if($list['estatuscliente']=='Activo' and $list['estatusgrua']=='Activo')
				{
					$start_time = $list['laststatusgruan'];
                       
					//echo $start_time;die;
					$minutos_transcurridos_retardo = $Utilitarios->calcula_tiempo_minutos($start_time, $end_time);
					//echo $minutos_transcurridos_retardo;die;
					if($minutos_transcurridos_retardo >=20 and $start_time!='' )
					{   
                                            //echo $minutos_transcurridos_retardo;die;
                                                //echo $list['idsolicitud']."aa";die;
						$retardo_activo_activo = 1;
					}
					
				}
				//echo $minutos;die;
                                
				$idSolicitud = $list['idsolicitud'];
				$idPoliza = $list['idpoliza'];
                                $count_bitacora = $Bitacora->getCountBitacoraByIdSolicitud($idSolicitud);

				$array_json['data'][] = array(
					"idSolicitud" => $idSolicitud,
					"idPoliza" => $list['idpoliza'],
					"Origen" => $list['proviene'],
					"Cedula" => $list['cedula'],
					"Placa" => $list['placa'],
					"EstatusSolicitud" => $list['estatus'],
					"EstatusCliente" => $list['estatuscliente'],
                    "EstatusGrua" => $list['estatusgrua'],
					"TimeOpen" => $list['timeopen'],
                    "TimeInicio" => $list['timeinicio'],
					"StatusDesierto" => $status_desierto,
					"RetardoActivoActivo" => $retardo_activo_activo,
					"EstatusGrua" => $list['estatusgrua'],
					
					"actions" =>		'<input type="hidden" name="action" value="edit">  '
										.'<input type="hidden" name="idSolicitud" value="'.$idSolicitud.'">  '
										.'<form method="POST" action = "'.full_url.'/adm/solicitud/index.php" class="form-inline">'
										. '<div class="form-group">'										
										.' <a  class="btn btn-default btn-sm" title="Ver detalle" href="'.full_url.'/adm/solicitud/index.php?action=edit&idSolicitud='.$idSolicitud.'&idPoliza='.$idPoliza.'"><i class="fa fa-edit  fa-pull-left fa-border"></i></a>'                                       
                                        .' <a  href="'.full_url.'/adm/solicitud/index.php?action=simulador_view&idSolicitud='.$idSolicitud.'" class="btn btn-default btn-sm" title="Simulador de servicio"><i class="fa fa-headphones  fa-pull-left fa-border"></i></a>'
										.' <a class="badge" title="Agregar/Ver bitácora" onclick="addBitacora('.$idSolicitud.')">'.$count_bitacora.'</a>'

										. '</div>'									
										.'</form>'
					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("idSolicitud"=>null,"idPoliza"=>"","Origen"=>"","Cedula"=>"","Placa"=>"","EstatusSolicitud"=>"","EstatusCliente"=>"","EstatusGrua"=>"","TimeOpen"=>'',"TimeInicio"=>"","RetardoActivoActivo"=>'',"EstatusGrua" => "","StatusDesierto"=>'',"actions"=>"");
		}
		echo json_encode($array_json);die;
		
	}
	function executeNew($values)
	{
		$values['action'] = 'add';
		require('maps.php');
	}
	function executeEdit($values)
	{
		$Solicitud = new Solicitud();
		$values['action'] = 'update';
		$data = $Solicitud->getDatosSolicitud($values);
		$values['CellContacto'] = $data['cellcontacto'];
		$values['InfoAdicional'] = $data['infoadicional'];
		$values['EstadoOrigen'] = $data['estadoorigen'];
		$values['QueOcurre'] = $data['queocurre'];
		$values['Situacion'] = $data['situacion'];
		$values['Direccion'] = $data['direccion'];
		$values['Neumaticos'] = $data['neumaticos'];
		$values['Estatus'] = $data['estatus'];
		$values['TimeOpen'] = $data['timeopen'];
		$values['TimeInicio'] = $data['timeinicio'];
		$values['TimeFin'] = $data['timefin'];
		$values['EstatusCliente'] = $data['estatuscliente'];
		$values['Motivo'] = $data['motivo'];
		$values['Monto'] = $data['monto'];
		require('maps_edit.php');
	}
	function executeLivemap($values)
	{
		require('livemap.php');
	}
	function executeJsonTest($values)
	{
		$arr = array ();
		$Solicitud = new Solicitud();
		
		$grueros_online = $Solicitud->getGruerosOnline();
		if(count($grueros_online)>0)
		{
			foreach($grueros_online as $online)
			{	
				$iconcolor = 'green';
				$contentinfo = ''
					. '<label>Cédula: </label> '.$online['cedula'].'<br>'
					. '<label>Nombre y apellido: </label> '.$online['nombre'].' '.$online['apellido'].'<br>'
					. '<label>Contacto: </label> '.$online['celular'].'<br>'
					. '<label>Modelo: </label> '.$online['modelo'].'<br>'
					. '<label>Placa: </label> '.$online['placa'].'<br>'
					. '<label>Color: </label> '.$online['color'].'<br>'
					. '<label>Última actualización: </label> '.$online['lastupdate'].'<br>'
					
					;
				
				
				
				
				$arr[] = array("Disponible"=>$online["disponible"],"Cedula" => $online['cedula'],"Nombre" => $online['nombre'],"Apellido" => $online['apellido'], "Modelo" => $online['modelo'],"Color" => $online['color'],"Placa" => $online['placa'],"idGrua"=>$online['idgrua'],"title"=>$online['nombre']." ".$online['apellido'],"lat"=>$online['latitud'],"lng"=>$online['longitud'],"description"=>"Prueba","contentinfo"=>$contentinfo,"iconcolor" => $iconcolor);
			}
			
		}

		echo json_encode($arr); // {"a":1,"b":2,"c":3,"d":4,"e":5}		
	}
	function executeSolicitudLivemap($values)
	{
		require('solicitudlivemap.php');
	}
	function executeSolicitudesLivemap($values)
	{
		require('livemap.php');
	}
	function executeJsonSolicitudLivemap($values)
	{
		//$values['idSolicitud'] = 218;
		$idSolicitud = $values['idSolicitud'];
		$Solicitud = new Solicitud();
		$data = $Solicitud->getDatosSolicitud($values);
		
		$arr = array (array());
		$iconcolor = 'green';
		
				$i = 0;
                   if(isset($data['idsolicitud']) and $data['idsolicitud']!='')
                    {
                            $idSolicitud = $data['idsolicitud'];
                            $latOrigen = $data['latorigen'];
                            $lngOrigen = $data['lngorigen'];
                            $latDestino = $data['latdestino'];
                            $lngDestino = $data['lngdestino'];
                            $latGrua = $data['latgrua'];
                            $lngGrua = $data['lnggrua'];
                        /*Data cliente*/
                        $NombreCliente = $data['nombrecliente'];
                        $ApellidoCliente = $data['apellidocliente'];
                        $CedulaCliente = $data['cedulacliente'];
                        $PlacaCliente = $data['placacliente'];
                        
                        $contentinfo_cliente = "<label>Cliente</label><br>"
                                . "<label>IdSolicittud:</label> $idSolicitud<br>"
                                . " <label>Cédula: </label>  $CedulaCliente <br>"
                                . " <label>Nombres y apellidos: </label>  $NombreCliente $ApellidoCliente";
                        
                        /*Data gruero*/
                        $NombreGruero = $data['nombregruero'];
                        $ApellidoGruero = $data['apellidogruero'];
                        $CedulaGruero = $data['cedulagruero'];
                        $PlacaGruero= $data['placagruero'];
                        
                        $contentinfo_gruero = "<label>Gruero</label><br>"
                                . "<label>IdSolicittud:</label> $idSolicitud<br>"
                                . " <label>Cédula: </label>  $CedulaGruero <br>"
                                . " <label>Nombres y apellidos: </label>  $NombreGruero $ApellidoGruero";
                        
                        
                        
                        /*Data destino*/
                        $Direccion = $data['direccion'];
                        $EstadoOrigen = $data['estadoorigen'];
                        $contentinfo_destino = "<label>Destino</label><br>"
                                . "<label>IdSolicittud:</label> $idSolicitud<br>"
                                . " <label>Estado de origen: </label>  $EstadoOrigen <br>"
                                . " <label>Dirección: </label>  $Direccion <br>";
                        
                        
                                    //centrar mapa

                                    $arr[$i][0] = array("id"=>"0","latCenter"=>"$latOrigen","lngCenter"=>"$lngOrigen","idSolicitud" => $idSolicitud);

                                    //Cliente

                                    $arr[$i][1] = array("id"=>"1","idSolicitud"=>$idSolicitud,"label"=>"C","title"=>'Cliente',"lat"=>$latOrigen,"lng"=>$lngOrigen,"description"=>"Prueba","contentinfo"=>"$contentinfo_cliente","iconcolor" => "red");
                                    //Destino
                                    $arr[$i][2] = array("id"=>"2","idSolicitud"=>$idSolicitud,"label"=>"D","title"=>'Destino',"lat"=>$latDestino,"lng"=>$lngDestino,"description"=>"Prueba","contentinfo"=>"$contentinfo_destino","iconcolor" => "blue");	
                                    //Gruero

                                    if($data['estatusgrua']!='' or $data['estatusgrua']!=null)
                                    {
                                            $arr[$i][3] = array("id"=>"3","idSolicitud"=>$idSolicitud,"label"=>"G","title"=>'Gruero',"lat"=>"$latGrua","lng"=>$lngGrua,"description"=>"Prueba","contentinfo"=>"$contentinfo_gruero","iconcolor" => "green");			
                                    }
                                    //El gruero llegó al lugar del cliente y se convierten en un solo circulo
                                    if(isset($data['estatusgrua']) and ($data['estatusgrua'] == 'Asistiendo' ))
                                    {
                                            unset($arr[$i][1],$arr[$i][3]);
                                            $arr[$i][3] = array("id"=>"3","idSolicitud"=>$idSolicitud,"label"=>"G","title"=>'Gruero',"lat"=>"$latOrigen","lng"=>$lngOrigen,"description"=>"Prueba","contentinfo"=>"$contentinfo_gruero","iconcolor" => "yellow");			
                                            $arr[$i][0] = array("id"=>"0","latCenter"=>"$latGrua","lngCenter"=>"$lngGrua","idSolicitud" => $idSolicitud);
                                    }
                                    //el gruero llegó al destino y el cliente lleno la encuesta
                                    if(isset($data['estatuscliente']) and ($data['estatuscliente'] == 'Asistido' ))
                                    {
                                            unset($arr[$i][1],$arr[$i][3]);
                                            $arr[$i][2] = array("id"=>"2","idSolicitud"=>$idSolicitud,"label"=>"D","title"=>'Destino',"lat"=>$latDestino,"lng"=>$lngDestino,"description"=>"Prueba","contentinfo"=>"$contentinfo_destino","iconcolor" => "blue");	
                                            $arr[$i][0] = array("id"=>"0","latCenter"=>"$latDestino","lngCenter"=>"$lngDestino","idSolicitud" => $idSolicitud);

                                    }				

                                    if(isset($data['estatuscliente']) and ($data['estatuscliente'] == 'Completado' ))
                                    {
                                            unset($arr[$i][1],$arr[$i][3]);
                                            $arr[$i][2] = array("id"=>"2","idSolicitud"=>$idSolicitud,"label"=>"D","title"=>'Destino',"lat"=>$latDestino,"lng"=>$lngDestino,"description"=>"Prueba","contentinfo"=>"$contentinfo_destino","iconcolor" => "blue");	
                                            $arr[$i][0] = array("id"=>"0","latCenter"=>"$latDestino","lngCenter"=>"$lngDestino","idSolicitud" => $idSolicitud);

                                            
                                    }

                                    			
                    } 
					echo json_encode($arr);  
	
	}
	function executeJsonSolicitudesLivemap($values)
	{
		//$values['idSolicitud'] = 218;
		
		$Solicitud = new Solicitud();
		$datos_solicitudes = $Solicitud->getDatosSolicitudesActivas($values);
		
		$arr = array (array());
		$iconcolor = 'green';
		$i = 0;
                foreach ($datos_solicitudes as $data) 
                {
                    if(isset($data['idsolicitud']) and $data['idsolicitud']!='')
                    {
                            $idSolicitud = $data['idsolicitud'];
                            $latOrigen = $data['latorigen'];
                            $lngOrigen = $data['lngorigen'];
                            $latDestino = $data['latdestino'];
                            $lngDestino = $data['lngdestino'];
                            $latGrua = $data['latgrua'];
                            $lngGrua = $data['lnggrua'];
                        /*Data cliente*/
                        $NombreCliente = $data['nombrecliente'];
                        $ApellidoCliente = $data['apellidocliente'];
                        $CedulaCliente = $data['cedulacliente'];
                        $PlacaCliente = $data['placacliente'];
                        
                        $contentinfo_cliente = "<label>Cliente</label><br>"
                                . "<label>IdSolicittud:</label> $idSolicitud<br>"
                                . " <label>Cédula: </label>  $CedulaCliente <br>"
                                . " <label>Nombres y apellidos: </label>  $NombreCliente $ApellidoCliente";
                        
                        /*Data gruero*/
                        $NombreGruero = $data['nombregruero'];
                        $ApellidoGruero = $data['apellidogruero'];
                        $CedulaGruero = $data['cedulagruero'];
                        $PlacaGruero= $data['placagruero'];
                        
                        $contentinfo_gruero = "<label>Gruero</label><br>"
                                . "<label>IdSolicittud:</label> $idSolicitud<br>"
                                . " <label>Cédula: </label>  $CedulaGruero <br>"
                                . " <label>Nombres y apellidos: </label>  $NombreGruero $ApellidoGruero";
                        
                        
                        
                        /*Data destino*/
                        $Direccion = $data['direccion'];
                        $EstadoOrigen = $data['estadoorigen'];
                        $contentinfo_destino = "<label>Destino</label><br>"
                                . "<label>IdSolicittud:</label> $idSolicitud<br>"
                                . " <label>Estado de origen: </label>  $EstadoOrigen <br>"
                                . " <label>Dirección: </label>  $Direccion <br>";
                        
                        
                                    //centrar mapa

                                    $arr[$i][0] = array("id"=>"0","latCenter"=>"$latOrigen","lngCenter"=>"$lngOrigen","idSolicitud" => $idSolicitud);

                                    //Cliente

                                    $arr[$i][1] = array("id"=>"1","idSolicitud"=>$idSolicitud,"label"=>"C","title"=>'Cliente',"lat"=>$latOrigen,"lng"=>$lngOrigen,"description"=>"Prueba","contentinfo"=>"$contentinfo_cliente","iconcolor" => "red");
                                    //Destino
                                    $arr[$i][2] = array("id"=>"2","idSolicitud"=>$idSolicitud,"label"=>"D","title"=>'Destino',"lat"=>$latDestino,"lng"=>$lngDestino,"description"=>"Prueba","contentinfo"=>"$contentinfo_destino","iconcolor" => "blue");	
                                    //Gruero

                                    if($data['estatusgrua']!='' or $data['estatusgrua']!=null)
                                    {
                                            $arr[$i][3] = array("id"=>"3","idSolicitud"=>$idSolicitud,"label"=>"G","title"=>'Gruero',"lat"=>"$latGrua","lng"=>$lngGrua,"description"=>"Prueba","contentinfo"=>"$contentinfo_gruero","iconcolor" => "green");			
                                    }
                                    //El gruero llegó al lugar del cliente y se convierten en un solo circulo
                                    if(isset($data['estatusgrua']) and ($data['estatusgrua'] == 'Asistiendo' ))
                                    {
                                            unset($arr[$i][1],$arr[$i][3]);
                                            $arr[$i][3] = array("id"=>"3","idSolicitud"=>$idSolicitud,"label"=>"G","title"=>'Gruero',"lat"=>"$latOrigen","lng"=>$lngOrigen,"description"=>"Prueba","contentinfo"=>"$contentinfo_gruero","iconcolor" => "yellow");			
                                            $arr[$i][0] = array("id"=>"0","latCenter"=>"$latGrua","lngCenter"=>"$lngGrua","idSolicitud" => $idSolicitud);
                                    }
                                    //el gruero llegó al destino y el cliente lleno la encuesta
                                    if(isset($data['estatuscliente']) and ($data['estatuscliente'] == 'Asistido' ))
                                    {
                                            unset($arr[$i][1],$arr[$i][3]);
                                            $arr[$i][2] = array("id"=>"2","idSolicitud"=>$idSolicitud,"label"=>"D","title"=>'Destino',"lat"=>$latDestino,"lng"=>$lngDestino,"description"=>"Prueba","contentinfo"=>"$contentinfo_destino","iconcolor" => "blue");	
                                            $arr[$i][0] = array("id"=>"0","latCenter"=>"$latDestino","lngCenter"=>"$lngDestino","idSolicitud" => $idSolicitud);

                                    }				

                                    if(isset($data['estatuscliente']) and ($data['estatuscliente'] == 'Completado' ))
                                    {
                                            unset($arr[$i][1],$arr[$i][3]);
                                            $arr[$i][2] = array("id"=>"2","idSolicitud"=>$idSolicitud,"label"=>"D","title"=>'Destino',"lat"=>$latDestino,"lng"=>$lngDestino,"description"=>"Prueba","contentinfo"=>"$contentinfo_destino","iconcolor" => "blue");	
                                            $arr[$i][0] = array("id"=>"0","latCenter"=>"$latDestino","lngCenter"=>"$lngDestino","idSolicitud" => $idSolicitud);

                                            
                                    }

                                    			
                    } 
                   $i++; 	
                }
		echo json_encode($arr); // {"a":1,"b":2,"c":3,"d":4,"e":5}

	
	}        
	function executeBitacoraList($values)
	{
            $Bitacora = new Bitacora();
            $data_list = $Bitacora->getBitacoraList($values);
            require('bitacora_list.php');
	}
	function executeSaveBitacora($values)
	{
            $Bitacora = new Bitacora();
            $Bitacora->insertBitacora($values);
            die;
            //require('bitacora_list.php');
	}
	function executeSimuladorView($values)
	{
			$Solicitud = new Solicitud();
			
			
			if(isset($values['ind']) and $values['ind']==1)//ind = 1 significa cambio de estatus en todas las tablas
			{
				//echo $values['idSolicitud'];die;
				if(isset($values['estatus']) and isset($values['estatus_cambiar']))
				{
					//cambio de estatus en la solicitud
					$Solicitud->updateEstatusSolicitud($values);
				}
				if(isset($values['estatuscliente']) and isset($values['estatuscliente']))
				{
					//cambio de estatus en la solicitud
					$Solicitud->updateEstatusServicioCliente($values);
				}
				if(isset($values['estatusgrua']) and isset($values['estatusgrua_cambiar']))
				{	

					//cambio de estatus en la solicitud
					$Solicitud->updateEstatusServicioGrua($values);
				}				
			}
			if(isset($values['ind']) and $values['ind']==2)//ind = 2 significa creación de servicio
			{
				if(isset($values['idPoliza']) and isset($values['idSolicitud']) and isset($values['idGrua']))
				{

					//genero el servicio
					$Solicitud->insertServicio($values);
				}			
			}			
			
			$data = $Solicitud->getDatosSolicitud($values);
            require('simulador_view.php');
	}
	function executeGrueroSelect($values)
	{
		$Solicitud = new Solicitud();
		$data = $Solicitud->getDatosSolicitud($values);
		require('gruero_select.php');
	}
	function executeGrueroSelectDatatableIndex($values)
	{	
		
		require('gruero_select_datatable.php');
	}
	function executeGrueroSelectDatatable($values)
	{
		$Solicitud = new Solicitud();
		$list_json = $Solicitud ->getGruerosList($values);
		$list_json_cuenta = $Solicitud ->getCountGruerosList($values);
		$array_json = array();
		$array_json['recordsTotal'] = $list_json_cuenta;
		$array_json['recordsFiltered'] = $list_json_cuenta;
		if(count($list_json)>0)
		{
			foreach ($list_json as $list) 
			{
				//echo $minutos;die;
                                
				$idGrua = $list['idgrua'];

				$array_json['data'][] = array(
					"idGrua" => $idGrua,
					"Cedula" => $list['cedula'],
					"Nombre" => $list['nombre'],
					"Apellido" => $list['apellido'],
					"Placa" => $list['placa'],
					"Modelo" => $list['modelo'],
					"Color" => $list['color'],
					"Celular" => $list['celular'],
					"Disponible" => $list['disponible'],
					"location" => $list['location'],	
					"zone_work" => $list['zone_work'],	
					"actions" => '<a class="btn" title="Seleccionar gruero" onclick='."'".'seleccionarGruero('.$idGrua.',"'.$list['nombre'].'","'.$list['apellido'].'","'.$list['cedula'].'","'.$list['placa'].'","'.$list['modelo'].'","'.$list['color'].'","'.$list['celular'].'"'.")'".'><i class="fa fa-check  fa-pull-left fa-border text-success"></i></a>'
					//"actions" => '<a title="Seleccionar gruero" onclick=seleccionarGruero('.$idGrua.',"dsdsd","sdsdsd","sdsd","sdsdsddddd","ddddddd","ddddd")><i class="fa fa-check  fa-pull-left fa-border text-success"></i></a>'

					);	
			}		
		}else{
			$array_json['recordsTotal'] = 0;
			$array_json['recordsFiltered'] = 0;
			$array_json['data'][0] = array("idGrua"=>null,"Cedula"=>"","Nombre"=>"","Apellido"=>"","Placa"=>"","Modelo"=>"","Color"=>"","Celular"=>"","Disponible"=>"","location"=>"","zone_work"=>"","actions"=>"");
		}
		echo json_encode($array_json);die;		
	}

	function executeJsonCliente($values)
	{
		$Polizas = new Polizas();
		$data = $Polizas->getPolizasById($values);
		echo json_encode($data);
	}
	function executeJsonBaremo($values)
	{
		$Baremo = new Baremo();
		$latOrigen = $values['latOrigen'];
		$lngOrigen =  $values['lngOrigen'];
		$latDestino =  $values['latDestino'];
		$lngDestimo =  $values['lngDestino'];
		$EstadoOrigen =  $values['EstadoOrigen'];
		$QueOcurre = $values['QueOcurre'];
		$Neumaticos = $values['Neumaticos'];
		$Situacion = $values['Situacion'];
		$timeOpen  = date(gmdate('d-m-Y H:i:s', time() - (4 * 3600)));
		
		$baremo = $Baremo->GetBaremo($values);
		
		$Distancia = $Baremo->GetDistancia($latOrigen, $lngOrigen, $latDestino, $lngDestimo);
		$Monto = $Baremo->CalcularOferta($EstadoOrigen, $Distancia, $QueOcurre, $Neumaticos, $Situacion, $timeOpen, $baremo);
		echo $Monto;die;
		$data = $Baremo->getPolizasById($values);
		echo json_encode($data);
	}
	function executeActualizaMonto($values)
	{
		$Solicitud = new Solicitud();
		$Solicitud ->updateMonto($values);
	}
	function executePruebaMap($values)
	{
		require('prueba_map.php');
	}
	function executeGruerosMapa($values)
	{
		$Solicitud = new Solicitud();
		//$data = $Solicitud->getDatosSolicitud($values);
		require('grueros_mapa.php');
	}