<?php

class PDF extends FPDF{
	/*
	 * Cabecera del reporte
	 */
	function Header(){
	    //Fuente
	    $this->SetFont('Arial', 'B', 12);

	    // Logo ANI
	    $this->setXY(15, 10);
	    $this->Cell( 37, 36, $this->Image('./img/logo_ani.jpg', $this->GetX()+2, $this->GetY()+4, 33.78), 1, 0, 'C', false );

	    $this->setX(52);
	    $this->MultiCell(105, 9, utf8_decode('SISTEMA INTEGRADO DE GESTIÓN'), 1, 'C');
	    $this->setX(52);

        $this->MultiCell(30, 18, utf8_decode('PROCESO'), 1, 'C');
	    $this->setX(52);
	    $this->MultiCell(30, 9, utf8_decode('FORMATO'), 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->setXY(82, 19);
        $this->MultiCell(75, 6, utf8_decode('GESTIÓN CONTRACTUAL Y SEGUIMIENTO DE PROYECTOS DE INFRAESTRUCTURA DE TRANSPORTE'), 1, 'C');
		$this->setX(82);
		$this->MultiCell(75, 9, utf8_decode('FICHA SOCIAL - REGISTRO FOTOGRÁFICO'), 1, 'C');

	    // Versión
	    $this->setXY(157,10);
	    $this->Cell(39, 9, utf8_decode('Código: GCSP-F-015'), 1, 1, 'C');
	    $this->setX(157);
	    $this->Cell(39, 18, utf8_decode('Versión 001'), 1, 1, 'C');
	    $this->setX(157);
	    $this->Cell(39, 9, utf8_decode('Fecha: 13/11/2013'), 1, 0, 'C');

	    // Salto de línea
	    $this->Ln(5);
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
	    $this->SetFont('Arial', '', 8);
	    // Número de página
	    $this->Cell(0,10, utf8_decode('Sistema de Gestión Predial - Página ').$this->PageNo().' de {nb}',0,0,'R');
	}
}//Fin PDF

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Letter');

//Anadir pagina
$pdf->AliasNbPages();

//Anadir pagina
$pdf->AddPage();

//Se definen las margenes
$pdf->SetMargins(15, 15, 15);

$pdf->setXY(15, $pdf->GetY() + 15);

// Datos generales
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(180, 5, utf8_decode('1. DATOS GENERALES'), 1, 0, 'C');


$pdf->setXY(15, $pdf->GetY() + 10);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 5, utf8_decode('Proyecto'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(25, 5, utf8_decode('Vías del nús'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, utf8_decode('Ficha Predial'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(30, 5, utf8_decode($predio->ficha_predial), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 5, utf8_decode('Trayecto'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(40, 5, utf8_decode($predio->tramo), 0, 0, 'L');

$pdf->setXY(15, $pdf->GetY() + 10);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(16, 5, utf8_decode('Municipio'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(35, 5, utf8_decode($predio->municipio), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(24, 5, utf8_decode('Vereda / Barrio'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(25, 5, utf8_decode($predio->barrio), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 5, utf8_decode('Dirección'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 8);
$pdf->Cell(40, 5, utf8_decode($predio->direccion), 0, 0, 'L');

$pdf->setXY(15, $pdf->GetY() + 10);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 5, utf8_decode('Unidad social No.'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(18, 5, utf8_decode('1'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(45, 5, utf8_decode('Relación con el inmueble'), 0, 0, 'L');
$pdf->SetFont('Arial', 'U', 9);
$pdf->Cell(40, 5, utf8_decode('MORADOR'), 0, 0, 'L');

$pdf->setXY(15, $pdf->GetY() + 10);

$cont = 1;
// carga de fotos
foreach ($fotos as $foto) {

	// Se consulta los datos de la foto
	$fecha = (isset($foto->fecha)) ?  $foto->fecha : $fecha = "";
	$descripcion =(isset($foto->descripcion)) ? utf8_decode($foto->descripcion) : $descripcion = "";

	if ($cont % 2 != 0) {
		$pdf->setY($pdf->GetY());
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->Ln();
	} else {
		$pdf->setXY(110, $pdf->GetY() - 72);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
	}

	$pdf->SetFont('Arial','',9);
	$pdf->SetX($x);
	$pdf->Cell(80, 1, utf8_decode("   Registro No. $foto->orden"), 0, 1, 'L');
	$pdf->SetX($x);

	$pdf->Cell(80, 70, $pdf->Image(base_url().$directorio.'/'.$foto->archivo, $pdf->GetX()+3, $pdf->GetY()+3, null, 66), 0, 1, 'C');

	$pdf->SetX($x);
	$pdf->Cell(80, 5, utf8_decode("   Descripción: $descripcion"), 0, 0, 'L');
	$pdf->SetX($x);


	if($cont % 2 == 0){
		$pdf->Ln();
	}

	if($cont % 4 == 0){
		$pdf->AddPage();
	}

	$cont++;
}

$pdf->Output('test'.'.pdf', 'D');
