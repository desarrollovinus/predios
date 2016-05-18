<?php
// Ficha predial
$GLOBALS['ficha'] = $this->uri->segment(3);

/*
 * Clase PDF
 */
class PDF extends FPDF{
	/*
	 * Cabecera del reporte
	 */
	function Header(){
	    //Fuente
	    $this->SetFont('Arial','',12);

	    // Logo ANI
	    $this->setXY(15, 10);
	    $this->Cell( 37, 36, $this->Image('./img/logo_ani.jpg', $this->GetX()+2, $this->GetY()+4, 33.78), 1, 0, 'C', false );
	    
	    $this->setX(52);
	    $this->MultiCell(85,9, utf8_decode('PROYECTO CONCESIÓN VÍAS DEL NUS VINUS'),1,'C');
	    $this->setX(52);
	    $this->MultiCell(85,9, utf8_decode('REGISTRO FOTOGRÁFICO'),1,'C');
	    $this->setX(52);
	    $this->MultiCell(85,9, utf8_decode('PREDIO '.$GLOBALS['ficha']),1,'C');
	    
	    // Logo Vinus
	    $this->setXY(137,10);
	    $this->Cell( 30, 36, $this->Image('./img/logo_vinus.png', $this->GetX()+2, $this->GetY()+2, 25), 1, 0, 'C', false );

	    // Versión
	    $this->SetFont('Arial','',10);
	    $this->setXY(167,10);
	    $this->Cell(39,12, utf8_decode('Código: F-078'),1,1,'C');
	    $this->setX(167);
	    $this->Cell(39,12, utf8_decode('Versión 1.00'),1,1,'C');
	    $this->setX(167);
	    $this->Cell(39,12, utf8_decode('Fecha: 29/04/2016'),1,0,'C');
	    
	    // Salto de línea
	    $this->Ln(20);
	}//Fin header

	/*
	 * Pie de pagina
	 */
	function Footer(){
		//Color negro
		$this->SetTextColor(0,0,0);
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    //Se define la fuente del footer
	    $this->SetFont('Arial','',8);
	    // Número de página
	    $this->Cell(0,10, utf8_decode('Sistema de gestión Predial - Página').$this->PageNo().' de {nb}',0,0,'R');
	}
}//Fin PDF

// Se obtiene el número de ficha desde la URL
$ficha = $this->uri->segment(3);

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Letter');

//Anadir pagina
$pdf->AliasNbPages();

//Anadir pagina
$pdf->AddPage();

//Se definen las margenes
$pdf->SetMargins(15, 15, 15);

$pdf->Ln(5);

// Carpeta de fotos
$directorio = "./files/{$ficha}/fotos/";

$cont = 1;
$fila_celdas = 6;

// Se recorren las fotos
foreach(glob($directorio.'*', GLOB_NOSORT) as $foto) {
	$pdf->Cell(95, 60, $pdf->Image($foto, $pdf->GetX()+3, $pdf->GetY()+3, null, 50),1,0,'C');
	$pdf->Cell(95, 7, "FOTO ",1,0,'C');




	// $pdf->Cell(0,$fila_celdas, $pdf->Image($foto,5,4,25),0,1);
	// $pdf->Cell(130,$fila_celdas, utf8_decode("FOTO ".$cont++),0,1);
	// $pdf->Image($foto, 20, null, 50);
	// $pdf->Image($foto, 100, null, 50);
	// $pdf->Cell(0, 10, $pdf->Image($foto, $pdf->GetX(),null, 50),'L',0,'R');
	// $pdf->Cell(50, 10, $pdf->Image($foto, $pdf->GetX(),null, 50),'L',0,'R');
	/*
	$cont++;
	$pdf->Cell(95, 7, "FOTO ".$cont,1,0,'C');
	$cont++;
	$pdf->Ln();*/

	
	// $pdf->Cell(95, 50, "FOTO ".$cont,1,0,'C');
	// $cont++;
	if($cont%2 == 0){
		$pdf->Ln();
	}

	if($cont == 6){
		$pdf->AddPage();
	}

	// if($cont == 10){
	// 	break;
	// }

	$cont++;
}


// Logo
// $pdf->Image('./img/logos/'.$this->session->userdata('id_empresa').'.png',5,4,25);



// Se imprime el reporte
$pdf->Output($ficha.'.pdf', 'I');
// $pdf->Output($ficha.'.pdf', 'D');