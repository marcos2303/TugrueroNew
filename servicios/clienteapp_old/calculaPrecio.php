<?php
header('Content-Type: application/json; charset:utf-8');
$myInput = file_get_contents('php://input');
$obj = json_decode($myInput, true);
setlocale(LC_NUMERIC,"es_ES.UTF8");
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
$idPoliza = ($obj["idPoliza"]);
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
$MontoFormateado = number_format($Monto,2,",",".");
        
        
$response = array('Precio' => $Monto, "PrecioFormateado" => $MontoFormateado);
$json_array = json_encode($response, JSON_UNESCAPED_UNICODE);
echo ($json_array);
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