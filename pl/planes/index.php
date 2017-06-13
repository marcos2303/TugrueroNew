<?php include("../../autoload.php");?>	
<?php include("validator.php");?>
<?php include("../security/security.php");?>

<?php $action = "";
setlocale(LC_NUMERIC,"es_ES.UTF8");
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}
$values = $_REQUEST;
    if(!isset($values['IdV']) or $values['IdV']==''){
        $values['IdV'] = '1';
    }else{
        $SolicitudPlan = new SolicitudPlan();
        $cuenta_idv = $SolicitudPlan->getCuentaIdV($values['IdV']);
        if(count($cuenta_idv)==0){
            echo "No puede continuar con la petición";die;
        } 
        
    }
$values = array_merge($values,$_FILES);
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "add":
			executeAdd($values);	
		break;
		case "precio_plan":
			executePrecioPlan($values);	
		break;
		case "mercadopago":
			executeMercadoPago($values);	
		break;
		case "pago":
			executePago($values);	
		break;
		case "cuadro_tugruero":
			executeCuadroTugruero($values);	
		break; 
		case "pagado":
			executePagado($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
	function executeIndex($values = null,$errors = array())
	{       
        $values['action'] = 'add';
		//print_r($values);die;
        
                

            
		require('form_view.php');
	}
	function executeAdd($values = null,$errors = array())
	{
                //subirDocumentos($values, $_FILES);
                $errors = validate($values,$_FILES);
                
				if(count($errors)>0){
					executeIndex($values,$errors);die;
				}else{
                                        $values['PagoRealizado'] = 'N';
                                        $SolicitudPlan = new SolicitudPlan();
                                        $Mail = new Mail();
					if($values['MET'] == 'TDC')
					{
                                                $values = $SolicitudPlan->saveSolicitudPlan($values);

                                                //subir documentos
                                                subirDocumentos($values, $_FILES);
                                                executeMercadoPago($values,$errors);
                                                
                                                
					}else
					{
                                                if(($_FILES['DEP1']['size']>0) or ($_FILES['DEP2']['size']>0) or ($_FILES['DEP3']['size']>0)){
                                                $values['PagoRealizado'] = 'S';
   
                                                }
                                                    
												$values = $SolicitudPlan->saveSolicitudPlan($values);
                                                //print_r($values);die;
                                                //subir documentos
                                                subirDocumentos($values, $_FILES);
                                                executePagado($values);
                                                $Mail->sendMessageDepositoPago($values);

                                                
                                        }
					die;
				}
                
	}
	function executeMercadoPago($values = null,$errors = array())
	{
      
		require('mercadopago_form.php');
                
	}	
	function executePrecioPlan($values = null,$errors = array())
	{

            $array= array('precio' => '0');
            $Planes = new Planes();
            $Puestos = $values['Puestos'];
            $idPlan = $values['id_plan'];
            $precio_plan = 0;
         
            if($idPlan!=''){
                $precio_plan = ($Planes->getPrecioPlan($idPlan));
               
                
                if(isset($values['RCV']) and $values['RCV']=='SI' ){
                    $precio_plan = ($Planes->getPrecioPlan($idPlan));
                    $precio_rcv = $Planes->getPrecioRCV($Puestos);
                    $precio_plan = $precio_plan + $precio_rcv;
                     
                }
            }

            $precio_plan_formateado = number_format($precio_plan,2,",",".");
            $array= array('precio' => $precio_plan_formateado, 'precio_sin_formato' => $precio_plan);  
            
            
            echo json_encode($array);
            
            
                
	}
        function executePago($values){
          
            $SolicitudPlan  = new SolicitudPlan();
            $SolicitudPlan -> updatePagoRealizado($values['idSolicitudPlan'],'S');
            $SolicitudPagoDetalle = new SolicitudPagoDetalle();
            $SolicitudPagoDetalle->savePagoDetalle($values);
            $array = array('OK');
            $Mail = new Mail();
            $Mail->sendMessageMercadopago($values);
            echo json_encode($array);die;
        }
        function executeCuadroTugruero($values){
          
            $PDFPagos = new PDFPagos();
            $pdf = $PDFPagos->cuadroTUGRUERO($values);
        }
        function executePagado($values){
          
            require('pagado.php');
        }
        function subirDocumentos($values,$files){
        $SolicitudDocumentos = new SolicitudDocumentos; 
        $idSolicitudPlan = $values['idSolicitudPlan'];
	$carpeta = "../../web/files/Solicitudes";
	$fichero_subido = $carpeta."/";
           // print_r($_FILES);die;
            if(isset($files['CedulaDoc']) and $files['CedulaDoc']['size']>0){
                $nombreArchivo = "Cedula_".$values['idSolicitudPlan'].".".pathinfo($_FILES['CedulaDoc']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['CedulaDoc']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    //inserto en bd;
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "Cedula", $nombreArchivo);
                }

            }
            /*if(isset($files['RifDoc']) and $files['RifDoc']['size']>0){
                $nombreArchivo = "Rif_".$values['idSolicitudPlan'].".".pathinfo($_FILES['RifDoc']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['RifDoc']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    //inserto en bd;
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "Rif", $nombreArchivo);
                }

            }
            if(isset($files['Licencia']) and $files['Licencia']['size']>0){
                $nombreArchivo = "Licencia_".$values['idSolicitudPlan'].".".pathinfo($_FILES['Licencia']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['Licencia']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    //inserto en bd;
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "Licencia", $nombreArchivo);
                }

            }*/
            if(isset($files['CarnetCirculacion']) and $files['CarnetCirculacion']['size']>0){
                $nombreArchivo = "CarnetCirculacion_".$values['idSolicitudPlan'].".".pathinfo($_FILES['CarnetCirculacion']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['CarnetCirculacion']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "CarnetCirculacion", $nombreArchivo);
                }

            }
           /* if(isset($files['CertificadoMedico']) and $files['CertificadoMedico']['size']>0){
                $nombreArchivo = "CertificadoMedico_".$values['idSolicitudPlan'].".".pathinfo($_FILES['CertificadoMedico']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['CertificadoMedico']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "CertificadoMedico", $nombreArchivo);
                }

            }
            if(isset($files['CertificadoOrigen']) and $files['CertificadoOrigen']['size']>0){
                $nombreArchivo = "CertificadoOrigen_".$values['idSolicitudPlan'].".".pathinfo($_FILES['CertificadoOrigen']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['CertificadoOrigen']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "CertificadoOrigen", $nombreArchivo);
                }

            }*/
            if(isset($files['DEP1']) and $files['DEP1']['size']>0){
                $nombreArchivo = "DEP1_".$values['idSolicitudPlan'].".".pathinfo($_FILES['DEP1']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['DEP1']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "DEP1", $nombreArchivo);
                }

            }
            if(isset($files['DEP2']) and $files['DEP2']['size']>0){
                $nombreArchivo = "DEP2_".$values['idSolicitudPlan'].".".pathinfo($_FILES['DEP2']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['DEP2']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "DEP2", $nombreArchivo);
                }

            }
            if(isset($files['DEP3']) and $files['DEP3']['size']>0){
                $nombreArchivo = "DEP3_".$values['idSolicitudPlan'].".".pathinfo($_FILES['DEP3']['name'],PATHINFO_EXTENSION);
                if (move_uploaded_file($files['DEP3']['tmp_name'], $fichero_subido.$nombreArchivo)){
                    $SolicitudDocumentos->saveSolicitudDocumentos($idSolicitudPlan, "DEP3", $nombreArchivo);
                }

            }
        }