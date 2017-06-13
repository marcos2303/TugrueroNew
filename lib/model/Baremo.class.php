<?php

	class Baremo 
	{
		
		
		function GetBaremo($values) {

			$ConnectionAws = new ConnectionAws();
			$q = $ConnectionAws->getConnect()->Baremo
			->select("*")->fetch();
			//->where("Disponible=?","SI");
			return $q; 
		}

		//------------------------------
		//Calculando la oferta
		//------------------------------
		function CalcularOferta($EstadoOrigen, $Distancia, $QueOcurre, $Neumaticos, $Situacion, $timeOpen, $baremo) {

			$enganche = $baremo['enganche'];
			$kilometraje = $Distancia * $baremo['km'];
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
					return $baremo['encunetado'];

				case "Volante/Palanca trabada":
					return $baremo["caja"];

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
			$dw = @date("w", $timeOpen);
			if ($dw == 6 || $dw == 0) {
				return $baremo['finsemana'];
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
					return $baremo['atasco'];

				case 'Estacionamiento techado o sótano':
					return $baremo['sotano'];

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
				return $baremo['diurno'];
			}

			if ($hora > 18 && $hora < 24) {
				return $baremo['nocturno'];
			}

			return $baremo['extranocturno'];
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
		
		
		
		
	}