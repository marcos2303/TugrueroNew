<?php

$timeOpen = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600 + 30 * 60)));
$Distancia = "20";
$Situacion = "Estacionamiento techado o sótano";
$EstadoOrigen = "miranda";



echo CalcularOferta($EstadoOrigen, $Distancia, $Situacion, $timeOpen);

function CalcularOferta($EstadoOrigen, $Distancia, $Situacion, $timeOpen) {

    $enganche = 5000;
    $kilometraje = $Distancia * 130;
    $weekendFactor = WeekendFactor($timeOpen);
    $situacionAjuste = SituacionFactor($Situacion) * $enganche;
    $horaFactor = HorarioFactor($timeOpen);

    $precio = ($enganche + $kilometraje + $situacionAjuste) * $weekendFactor * $horaFactor;
    return $precio;
}

function WeekendFactor($timeOpen) {
    $dw = date("w", $timeOpen);
    if ($dw == 6 || $dw == 0) {
        return 1.25;
    } else {
        return 1;
    }
}

function SituacionFactor($Situacion) {
    switch ($Situacion) {
        case 'Atascado en barro o arena.':
            return 0.3;

        case 'Estacionamiento techado o sótano':
            return 0.9;

        default:
            return 0;
    }
}

function HorarioFactor($timeOpen) {

    $time = strtotime($timeOpen);
    $hora = date('H', $time);

    if ($hora > 4 && $hora < 19) {
        return(1);
    }

    if ($hora > 18 && $hora < 24) {
        return(1.2);
    }

    return 1.3;
}
