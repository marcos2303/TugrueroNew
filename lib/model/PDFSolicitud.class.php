<?php
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'logo_tugruero.png';
		$this->Image($image_file, 15, 2, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('times', '', 8);
		// Title
		//$this->Cell(0, 15, 'Soluciones Tugruero, C.A', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		//$this->Cell(0, 20, 'Soluciones Tugruero, C.A', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
		$html = '<table width="100%" border="0">'
			. '<tr>'
			. '<td align="center"><br></td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center"><b>Soluciones Tugruero, C.A</b></td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center"><b>Av. Principal Los Dos Caminos. Edif. Provincial. Piso 8. Ofic. 8 "B". Los Dos Caminos. Municipio Sucre. Caracas.</b></td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center">tugruero@gmail.com - www.tugruero.com.ve</td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center">02122357207 / 02122391093</td>'
			. '</tr>'
			. '</table><br><br><hr>';
		$this->writeHTML($html);
		
		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}
class MYPDF2 extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		//$image_file = K_PATH_IMAGES.'logo_tugruero.png';
		//$this->Image($image_file, 15, 2, 25, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
		// Set font
		//$this->SetFont('times', '', 8);
		// Title
		//$this->Cell(0, 15, 'Soluciones Tugruero, C.A', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		//$this->Cell(0, 20, 'Soluciones Tugruero, C.A', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		/*
		$html = '<table width="100%" border="0">'
			. '<tr>'
			. '<td align="center"><br></td>'
			. '</tr>'
			. '<tr>'
			. '<td align="left"><b>Soluciones Tugruero, C.A</b></td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center"><b>Av. Principal Los Dos Caminossssssssss. Edif. Provincial. Piso 8. Ofic. 8 "B". Los Dos Caminos. Municipio Sucre. Caracas.</b></td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center">tugruero@gmail.com - www.tugruero.com.ve</td>'
			. '</tr>'
			. '<tr>'
			. '<td align="center">02122357207 / 02122391093</td>'
			. '</tr>'
			. '</table><br><br><hr>';
		$this->writeHTML($html);*/
		
		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		/*$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');*/
	}
}	
	class PDFSolicitud 
	{
		
		function formatoGenerico($values)
		{
			setlocale(LC_NUMERIC,"es_ES.UTF8");
                        ob_start();
			
			//print_r($values);die;
			
			$cliente = '';
			$desde = $values['desde'];
			$hasta = $values['hasta'];
			
			if($desde == '')
			{
				$desde = '00000000';
			}
			if($hasta == '')
			{
				$hasta = '00000000';
			}
			
			$reporte = 'reporte_servicios_'.date('Ymd_his').'.pdf';
			if($values['formato'] == 1)
			{
				$reporte = 'reporte_servicios_generico_'.$desde.'_'.$hasta.'.pdf';
				$cliente = 'N/A';
			}else
			{
				
				$cliente = $values['formato'];
				$reporte = 'reporte_servicios_'.$cliente.'_'.$desde.'_'.$hasta.'.pdf';
			}
			$Solicitud = new Solicitud();
			$servicios_data = $Solicitud->getSolicitudesServiciosListPDF($values);
			$cuenta_servicios_taxis = $Solicitud->getSolicitudesServiciosTaxiListPDF($values);
			$cuenta_servicios_gruas = count($servicios_data);
			
			// create new PDF document
			$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('TU/GRUERO®');
			$pdf->SetTitle('TU/GRUERO®');
			$pdf->SetSubject('TU/GRUERO®');
			$pdf->SetKeywords('TU/GRUERO®');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, 32, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('times', '', 8);

			// add a page
			$pdf->AddPage();

			// set some text to print
			$html = '<h4 style="font-size: 12px;text-decoration:underline;" align="center"><b>REPORTE DE SERVICIOS DE GRÚA Y TAXI</b></h4>';
			$pdf->writeHTML($html);
			
			$html = '<label style="font-size: 12px;text-decoration:underline;">RESUMEN</label>';
			$pdf->writeHTML($html);			
			$html = '<table width="100%" border="1">'
				. '<tr>'
				. '<td align="center"><b>CLIENTE</b></td>'
				. '<td align="center"><b>'.strtoupper($cliente).'</b></td>'
				. '</tr>'
				. '<tr>'
				. '<td align="center"><b>PERIODO</b></td>'
				. '<td align="center"><b>'.$values['desde'].' - '.$values['hasta'].'</b></td>'
				. '</tr>'
				. '<tr>'
				. '<td align="center"><b>NÚMERO DE SERVICIOS DE GRÚA</b></td>'
				. '<td align="center"><b>'.$cuenta_servicios_gruas.'</b></td>'
				. '</tr>'
				. '<tr>'
				. '<td align="center"><b>NÚMERO DE SERVICIOS DE TAXI</b></td>'
				. '<td align="center"><b>'.$cuenta_servicios_taxis.'</b></td>'
				. '</tr>'
				. '</table>';
			$pdf->writeHTML($html);
			
			$html = '<label style="font-size: 12px;text-decoration:underline;">DETALLE</label>';
			$pdf->writeHTML($html);	
			
			
			$html = '<table width="100%" border="1">'
				. '<thead>'
				. '<tr style="background-color: #00b0f0;">'
				. '<th align="center" width="4%"><b>N°</b></th>'
				. '<th align="center" width="12%"><b>MODELO</b></th>'
				. '<th align="center" width="12%"><b>FECHA</b></th>'
				. '<th align="center" width="12%"><b>PLACA</b></th>'
				. '<th align="center" width="12%"><b>FALLA O AVERIA</b></th>'
				. '<th align="center" width="12%"><b>ORIGEN</b></th>'
				. '<th align="center" width="12%"><b>DESTINO</b></th>'
				. '<th align="center" width="12%"><b>TAXI</b></th>'
				. '<th align="center" width="12%"><b>SERVICIO DE GRÚA</b></th>'
				. '</tr>'
				. '</thead>'
				. '<tbody>';
				
				$i = 1;
				$total_gruas = 0;
				$total_taxi = 0;
				foreach($servicios_data as $data)
				{
				$total_taxi+=$data['montotaxi'];
				$total_gruas+=$data['montofinal'];
				$html.='<tr nobr="true">'
				. '<td align="center" width="4%">'.$i.'</td>'
				. '<td align="center" width="12%">'.strtoupper($data['modelo']).'</td>'
				. '<td align="center" width="12%">'.strtoupper($data['timeopen']).'</td>'
				. '<td align="center" width="12%">'.strtoupper($data['placa']).'</td>'
				. '<td align="center" width="12%">'.strtoupper($data['queocurre']).'</td>'
				. '<td align="center" width="12%">'.strtoupper($data['estadoorigen']).'</td>'
				. '<td align="center" width="12%">'.strtoupper($data['direccion']).'</td>'
				. '<td align="center" width="12%">'.number_format($data['montotaxi'],2,",",".").'</td>'
				. '<td align="center" width="12%">'.number_format($data['montofinal'],2,",",".").'</td>'
				. '</tr>';
				$i++;
				}
				$html.=	'</tbody>'
					. '<tr>'
					
					. '<td colspan="7" align="right" style="font-size:12px;"><b>Subtotales</b></td>'
					. '<td align="center"><b>'.number_format($total_taxi,2,",",".").'</b></td>'
					. '<td align="center"><b>'.number_format($total_gruas,2,",",".").'</b></td>'
					. '</tr>'
				
				. '</table>';
			
			$pdf->writeHTML($html);	
			
			
			$pdf->Output($reporte, 'I');

		}
	
	}