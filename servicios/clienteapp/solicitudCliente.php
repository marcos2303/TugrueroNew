<?php
header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);

//------------------------------
//Incluyendo funciones de Error, Fallo y Exito.
//------------------------------
include_once 'funcionesGenerales.php';

//------------------------------
//Combrobando estructura del JSON.
//------------------------------
if (json_last_error() !== 0) {
    JSONerror();
}

//------------------------------
//Creando la variable $link de conexion.
//------------------------------
include_once 'conexion.php';

//------------------------------
//Parámetros
//------------------------------
//var_dump($obj);die;
$idPoliza = null;
if(isset($obj["idPoliza"]) and $obj["idPoliza"]!=""){
    $idPoliza = ($obj["idPoliza"]);  
}else{
        $idPoliza = crearPolizaOnline($link,$link2,$obj);
        $obj["idPoliza"] = $idPoliza;
}
//$idPoliza = ($obj["idPoliza"]);
$latOrigen = ($obj["latOrigen"]);
$lngOrigen = ($obj["lngOrigen"]);
$latDestino = ($obj["latDestino"]);
$lngDestimo = ($obj["lngDestino"]);
$Direccion = ($obj["Direccion"]);
$Cell = ($obj["CellContacto"]);
$InfoAdicional = ($obj["InfoAdicional"]);
$EstadoOrigen = ($obj["EstadoOrigen"]);
if(isset($EstadoOrigen) and $EstadoOrigen!="")
{
	if(strpos($EstadoOrigen,'Dtto')==true or strpos($EstadoOrigen,'Dto') == true or strpos($EstadoOrigen,'District') == true or strpos($EstadoOrigen,'Capital') == true)
	{
		$obj["EstadoOrigen"] = 'Distrito Capital';
	}
}
if(!isset($obj["EstadoDestino"]) or $obj["EstadoDestino"]=='')
{
	$obj["EstadoDestino"] = 'N/A';
}
$QueOcurre = ($obj["QueOcurre"]);
$Neumaticos = ($obj["Neumaticos"]);
$Situacion = ($obj["Situacion"]);

//------------------------------
//Transformando el tiempo
//------------------------------
//$timeOpen = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
$timeOpen = date('Y-m-d H:i:s');
//------------------------------
//Generando la distancia del recorrido
//------------------------------
$baremo = GetBaremo($link);
$Distancia = GetDistancia($latOrigen, $lngOrigen, $latDestino, $lngDestimo);
$Monto = CalcularOferta($EstadoOrigen, $Distancia, $QueOcurre, $Neumaticos, $Situacion, $timeOpen, $baremo);

//------------------------------
//Extras
//------------------------------
$Tabla = "Solicitudes";

//------------------------------
//Query
//------------------------------
$result = $link->query("INSERT INTO $Tabla (idPoliza,latOrigen,lngOrigen,latDestino,lngDestino,EstadoOrigen,Direccion,Distancia,Monto,CellContacto,InfoAdicional,QueOcurre,Neumaticos,Situacion,TimeOpen) "
        . "VALUES ('$idPoliza','$latOrigen','$lngOrigen','$latDestino','$lngDestimo',remove_accents('$EstadoOrigen'),'$Direccion','$Distancia','$Monto','$Cell','$InfoAdicional','$QueOcurre','$Neumaticos','$Situacion','$timeOpen')");

//------------------------------
//Error Check
//------------------------------
if (!$result) {
    Error($link->error, $link);
}

//------------------------------
//JSON Response
//------------------------------
$idSolicitud = $link->insert_id;
$data = (array('idSolicitud' => $idSolicitud));
$json_array = json_encode($data, JSON_UNESCAPED_UNICODE);
echo $json_array;


//------------------------------
//Ubicando las gruas más cercanas para enviar el Push
//External.funcionesAPI
//------------------------------
include_once $_SERVER['DOCUMENT_ROOT'] . "/API/funcionesAPI.php";
ubicarGruas($link, $obj, $idSolicitud);

//------------------------------
//FUNCIONES:
//------------------------------
//------------------------------
//Obtener Factores de cálculo.
//------------------------------
function GetBaremo($link) {
//------------------------------
//Params
//------------------------------
    $Tabla = "Baremo";

//------------------------------
//Query
//------------------------------
    $result = $link->query("SELECT * FROM $Tabla");

//------------------------------
//Response
//------------------------------
    $response = $result->fetch_array(MYSQLI_ASSOC);
    return $response;
}

//------------------------------
//Calculando la oferta
//------------------------------
function CalcularOferta($EstadoOrigen, $Distancia, $QueOcurre, $Neumaticos, $Situacion, $timeOpen, $baremo) {

    $enganche = $baremo['Enganche'];
    $kilometraje = $Distancia * $baremo['KM'];
    $weekendFactor = WeekendFactor($timeOpen, $baremo);
    $problemaAjuste = ProblemaFactor($QueOcurre, $Neumaticos, $baremo) * $enganche;

    $situacionAjuste = SituacionFactor($Situacion, $baremo) * $enganche;
    $horaFactor = HorarioFactor($timeOpen, $baremo);

    $precio = ($enganche + $kilometraje + $problemaAjuste +$situacionAjuste) * $weekendFactor * $horaFactor;
    return $precio;
}

//------------------------------
//Calculando Factor Que ocurre.
//------------------------------
function ProblemaFactor($QueOcurre, $Neumaticos, $baremo) {
    switch ($QueOcurre) {

        case "Encunetado":
            return $baremo[Encunetado];

        case "Volante/Palanca trabada":
            return $baremo["Caja"];

        case "Neumático espichado":
            $Cambios = 0;
            for ($n = 0; $n < 4; $n++) {
                if ($Neumaticos[$n] === '1') {
                    $Cambios++;
                }
            }
            $Cambio = "Cambio" . $Cambios;
            $factor = ($Cambios === 0) ? 0 : $baremo[$Cambio];
            return $factor;

        default :
            return 0;
    }
}

//------------------------------
//Calculando Factor de fin de semana.
//------------------------------
function WeekendFactor($timeOpen, $baremo) {
    $dw = date("w", $timeOpen);
    if ($dw == 6 || $dw == 0) {
        return $baremo['FinSemana'];
    } else {
        return 1;
    }
}

//------------------------------
//Calculando factor por situacion.
//------------------------------
function SituacionFactor($Situacion, $baremo) {
    switch ($Situacion) {
        case 'Atascado en barro o arena.':
            return $baremo['Atasco'];

        case 'Estacionamiento techado o sótano':
            return $baremo['Sotano'];

        default:
            return 0;
    }
}

//------------------------------
//Calculando El factor por horario.
//------------------------------
function HorarioFactor($timeOpen, $baremo) {

    $time = strtotime($timeOpen);
    $hora = date('H', $time);

    if ($hora > 4 && $hora < 19) {
        return $baremo['Diurno'];
    }

    if ($hora > 18 && $hora < 24) {
        return $baremo['Nocturno'];
    }

    return $baremo['ExtraNocturno'];
}

//------------------------------
//Calculando Distancia.
//------------------------------
function GetDistancia($oLAT, $oLNG, $dLAT, $dLNG) { //equación de Haversine
    //Conversión de Latitudes a Radianes
    $origenLAT = deg2rad($oLAT);
    $destinoLAT = deg2rad($dLAT);

    //Cálculo de Deltas
    $deltaLAT = ($destinoLAT - $origenLAT);
    $deltaLON = deg2rad($dLNG - $oLNG); //transformación a radianes.
    //Cáculo de factores
    $senoDeltaLAT = sin($deltaLAT / 2);
    $senoDeltaLAT *=$senoDeltaLAT; //al cuadrado
    $senoDeltaLON = sin($deltaLON / 2);
    $senoDeltaLON *=$senoDeltaLON; // al cuadrado

    $aFactor = $senoDeltaLAT + $senoDeltaLON * cos($origenLAT) * cos($destinoLAT);
    $cFactor = 2 * atan2(sqrt($aFactor), sqrt(1 - $aFactor));
    $distancia = $cFactor * 6371.137 * 1.3; //Distancia en KM

    return round($distancia);
}
function crearPolizaOnline($link,$link2,$obj){
$fechahora = date('Y-m-d H:i:s');   
$fecha = date('Y-m-d');
$seguro = "APP-TEMPORAL";
//inserto para la web   
    $result = $link2->query("INSERT INTO `admin_tugruero`.`Polizas` 
        (Placa,Cedula,Nombre,Apellido,Marca,Modelo,Clase,Tipo,Color,Año,Serial,Seguro,NumPoliza,DireccionEDO,Domicilio,DireccionFiscal,Vencimiento,date_created,date_updated,created_by,updated_by,Nacionalidad,Celular,Email,DesdeVigencia,EstatusPoliza)
	VALUES
	('".strtoupper($obj["Placa"])."','".strtoupper($obj["Cedula"])."','".strtoupper($obj["Nombres"])."','".strtoupper($obj["Apellidos"])."','".strtoupper($obj["Marca"])."','".strtoupper($obj["Modelo"])."','".$obj["Clase"]."','".$obj["Tipo"]."','".strtoupper($obj["Color"])."','".$obj["Anio"]."','','".$seguro."','".strtoupper($obj["EstadoOrigen"])."','".strtoupper($obj["EstadoOrigen"])."','".strtoupper($obj["EstadoOrigen"])."','".strtoupper($obj["EstadoOrigen"])."','".$fecha."','".$fechahora."','".$fechahora."','1','1','V','".$obj["CellContacto"]."',null,'".$fecha."','Inactivo')");
    
    
    
    if (!$result) {
    Error($link2->error, $link2);
    }
    
    $idPoliza = $link2->insert_id;   
//inserto para la app
    $result = $link->query("INSERT INTO `TuGruero`.`Polizas` 
	(idPoliza, Placa,Cedula,Nombre,Apellido, Marca,Modelo,Clase,Tipo,Color,Año,Seguro,  DireccionEDO,Vencimiento,Serial,Celular,Email,DesdeVigencia,EstatusPoliza)
	VALUES('".$idPoliza."','".strtoupper($obj["Placa"])."','".strtoupper($obj["Cedula"])."','".strtoupper($obj["Nombres"])."','".strtoupper($obj["Apellidos"])."','".strtoupper($obj["Marca"])."','".strtoupper($obj["Modelo"])."','".$obj["Clase"]."','".$obj["Tipo"]."','".strtoupper($obj["Color"])."','".$obj["Anio"]."','".$seguro."','".strtoupper($obj["EstadoOrigen"])."','".$fecha."',null,'".$obj["CellContacto"]."',null,'".$fechahora."','Inactivo')");

    if (!$result) {
    Error($link->error, $link);
    }

    return $idPoliza;
}
