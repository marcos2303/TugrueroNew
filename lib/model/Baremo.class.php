<?php

	class Baremo {
		
		function datosBaremo() {
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Baremo
			->select("*")->fetch();
			return $q; 	
		}		
		function calcularOferta($Distancia, $QueOcurre, $Neumaticos, $Situacion, $timeOpen) {
			$baremo = $this->datosBaremo();
			$enganche = $baremo['Enganche'];
			$kilometraje = $Distancia * $baremo['KM'];
			$weekendFactor = $this->WeekendFactor($timeOpen, $baremo);
			$problemaAjuste = $this->ProblemaFactor($QueOcurre, $Neumaticos, $baremo) * $enganche;

			$situacionAjuste = $this->SituacionFactor($Situacion, $baremo) * $enganche;
			$horaFactor = $this->HorarioFactor($timeOpen, $baremo);

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
	
		function getDistancia($LatitudOrigen, $LongitudOrigen, $LatitudDestino, $LongitudDestino) { //equación de Haversine
			//Conversión de Latitudes a Radianes
			$origenLAT = deg2rad($LatitudOrigen);
			$destinoLAT = deg2rad($LatitudDestino);

			//Cálculo de Deltas
			$deltaLAT = ($destinoLAT - $origenLAT);
			$deltaLON = deg2rad($LongitudDestino - $LongitudOrigen); //transformación a radianes.
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
	}
	