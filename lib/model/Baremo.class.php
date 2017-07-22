<?php

	class Baremo {

		function datosBaremo() {

			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->Baremo
			->select("*")->where("Estatus=?",1)->fetch();
			return $q;
		}
		function calcularOferta($Distancia, $IdAveria, $Neumaticos, $IdCondicionLugar, $timeOpen) {
			$baremo = $this->datosBaremo();
			$enganche = $baremo['Enganche'];
			$kilometraje = $Distancia * $baremo['KM'];
			$weekendFactor = $this->WeekendFactor($timeOpen, $baremo);
			$problemaAjuste = $this->AveriaFactor($IdAveria, $Neumaticos) * $enganche;

			$situacionAjuste = $this->SituacionFactor($IdCondicionLugar, $baremo) * $enganche;
			$horaFactor = $this->HorarioFactor($timeOpen, $baremo);

			$precio = ($enganche + $kilometraje + $problemaAjuste +$situacionAjuste) * $weekendFactor * $horaFactor;
			return $precio;
		}

		//------------------------------
		//Calculando Factor Que ocurre.
		//------------------------------
		function AveriaFactor($IdAveria, $Neumaticos) {
			$Averias = new Averias();
			$datos_averia = $Averias->getAveriasInfo($IdAveria);

			switch ($datos_averia['IdAveria']) {


				case "3":
					$Cambios = 0;
					for ($n = 0; $n < 4; $n++) {
						if ($Neumaticos[$n] === '1') {
							$Cambios++;
						}
					}
					if($Cambios == 0){
						return $datos_averia['FactorGeneral'];
					}elseif($Cambios == 1){
						return $datos_averia['Factor1'];
					}elseif($Cambios == 2){
						return $datos_averia['Factor2'];
					}elseif($Cambios == 3){
						return $datos_averia['Factor3'];
					}else{
						return $datos_averia['Factor4'];
					}

				default :
					return $datos_averia['FactorGeneral'];
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
		function SituacionFactor($IdCondicionLugar, $baremo) {
			$CondicionLugar = new CondicionLugar();
			$datos_condicion = $CondicionLugar->getCondicionLugarInfo($IdCondicionLugar);
			$datos_condicion['Factor'];
			return $datos_condicion['Factor'];

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
