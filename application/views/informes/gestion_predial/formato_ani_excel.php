<?php
// Se obtiene el número de ficha desde la URL
$ficha = $this->uri->segment(3);

// Se hace la consulta
$predio = $this->InformesDAO->obtener_informe_gestion_predial_ani($ficha);

//Se crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//Se establece la configuracion general
$objPHPExcel->getProperties()
	->setCreator("John Arley Cano Salinas - Hatovial S.A.S.")
	->setLastModifiedBy("John Arley Cano Salinas")
	->setTitle("Sistema de Gestión Predial Vinus - Generado el ".$this->InformesDAO->formatear_fecha(date('Y-m-d')).' - '.date('h:i A'))
	->setSubject("Gestión predial - Formato ANI")
    ->setCategory("Reporte");

/*********************************************************************
**************************** Ficha predial ***************************
*********************************************************************/
//Definicion de las configuraciones por defecto en todo el libro
$objPHPExcel->getDefaultStyle()->getFont()->setName('Tahoma'); //Tipo de letra
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10); //Tamaño
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);//Ajuste de texto
$objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);// Alineacion centrada

//Se establece la configuracion de la pagina
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //Orientacion horizontal
// $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER); //Tamano carta
$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(77);

//Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
// $objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1);

//Se establecen las margenes
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.10); //Arriba
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.70); //Derecha
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.80); //Izquierda
// $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0,90); //Abajo

//Centrar página
$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered();

// Ocultar la cuadrícula:
$objPHPExcel->getActiveSheet()->setShowGridlines(false);

$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//Logo Vinus
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo Vinus');
$objDrawing->setDescription('Logo de uso exclusivo de Vinus');
$objDrawing->setPath('./img/logo_vinus.jpg');
$objDrawing->setCoordinates('G3');
$objDrawing->setHeight(90);
$objDrawing->setOffsetX(32);
$objDrawing->setOffsetY(50);
$objDrawing->getShadow()->setDirection(160);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

//Logo ANI
$objDrawing2 = new PHPExcel_Worksheet_Drawing();
$objDrawing2->setName('Logo ANI');
$objDrawing2->setDescription('Logo de uso exclusivo de ANI');
$objDrawing2->setPath('./img/logo_ani.jpg');
$objDrawing2->setCoordinates('B3');
$objDrawing2->setWidth(125);
// $objDrawing2->setOffsetX(30);
$objDrawing2->setOffsetY(50);
$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());

// Fuente
// $objPHPExcel->getActiveSheet()->getStyle('J12')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
// $objPHPExcel->getActiveSheet()->getStyle('J12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/*******************************************************
 *********************** Estilos ***********************
 *******************************************************/
$centrado = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) ); // Alineación centrada
$negrita = array( 'font' => array( 'bold' => true ) ); // Negrita
$tamanio8 = array ( 'font' => array( 'size' => 8 ) );// Tamaño de fuente 8
$tamanio9 = array ( 'font' => array( 'size' => 9 ) );// Tamaño de fuente 9
$tamanio11 = array ( 'font' => array( 'size' => 11 ) );// Tamaño de fuente 11
$tamanio14 = array ( 'font' => array( 'size' => 14 ) );// Tamaño de fuente 14
$rojo = array( 'font' => array ( 'color' => array( 'argb' => 'FF0F0F' ) ) );
$arial = array( 'font' => array( 'name' => 'Arial' ) ); // Arial

$relleno_gris = array(
	'fill' => array(
	    'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	    'rotation' => 90,
	    'startcolor' => array(
  	  		'argb' => 'DBDBDB'
        ),
	    'endcolor' => array(
			'argb' => 'DBDBDB'
    	),
    ),
);

$borde_negrita_externo = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => '000000'),
		),
	),
);

$borde_puntos_externo = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_HAIR,
			'color' => array('argb' => '000000'),
		),
	),
);

/*
 * Definicion de la anchura de las columnas
 */
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(2);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(1);

//Tamaño de celdas
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(6);
$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(8);
$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(7);
$objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(7);
$objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(15)->setRowHeight(7);
$objPHPExcel->getActiveSheet()->getRowDimension(17)->setRowHeight(3);
$objPHPExcel->getActiveSheet()->getRowDimension(19)->setRowHeight(3);
$objPHPExcel->getActiveSheet()->getRowDimension(20)->setRowHeight(11);
$objPHPExcel->getActiveSheet()->getRowDimension(22)->setRowHeight(4);
$objPHPExcel->getActiveSheet()->getRowDimension(23)->setRowHeight(4);
$objPHPExcel->getActiveSheet()->getRowDimension(25)->setRowHeight(4);
$objPHPExcel->getActiveSheet()->getRowDimension(30)->setRowHeight(5);
$objPHPExcel->getActiveSheet()->getRowDimension(31)->setRowHeight(14);
$objPHPExcel->getActiveSheet()->getRowDimension(59)->setRowHeight(1);
$objPHPExcel->getActiveSheet()->getRowDimension(60)->setRowHeight(1);
$objPHPExcel->getActiveSheet()->getRowDimension(62)->setRowHeight(2);
$objPHPExcel->getActiveSheet()->getRowDimension(64)->setRowHeight(1);
$objPHPExcel->getActiveSheet()->getRowDimension(65)->setRowHeight(1);
$objPHPExcel->getActiveSheet()->getRowDimension(69)->setRowHeight(4);
$objPHPExcel->getActiveSheet()->getRowDimension(70)->setRowHeight(4);

// tamaño para las celdas 33 hasta 56
for ($i = 33; $i <= 56; $i++) {
	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(11);
}

//Celdas a combinar
// $objPHPExcel->getActiveSheet()->mergeCells('A1:F14');
// $objPHPExcel->getActiveSheet()->mergeCells('G1:I14');
$objPHPExcel->getActiveSheet()->mergeCells('A31:K31');
$objPHPExcel->getActiveSheet()->mergeCells('B16:N16');
$objPHPExcel->getActiveSheet()->mergeCells('B18:N20');
$objPHPExcel->getActiveSheet()->mergeCells('B24:E24');
$objPHPExcel->getActiveSheet()->mergeCells('B26:E26');
$objPHPExcel->getActiveSheet()->mergeCells('B27:E27');
$objPHPExcel->getActiveSheet()->mergeCells('B29:E29');
$objPHPExcel->getActiveSheet()->mergeCells('B32:F32');
// combinar celdas 33 hasta 55
for ($i = 33; $i <= 55; $i++) {
	$objPHPExcel->getActiveSheet()->mergeCells("B{$i}:F{$i}");
	$objPHPExcel->getActiveSheet()->mergeCells("I{$i}:J{$i}");
}
$objPHPExcel->getActiveSheet()->mergeCells('B58:G58');
$objPHPExcel->getActiveSheet()->mergeCells('B63:G63');
$objPHPExcel->getActiveSheet()->mergeCells('B68:G68');
$objPHPExcel->getActiveSheet()->mergeCells('F24:I24');
$objPHPExcel->getActiveSheet()->mergeCells('F26:I26');
$objPHPExcel->getActiveSheet()->mergeCells('F27:I27');
$objPHPExcel->getActiveSheet()->mergeCells('F29:I29');
$objPHPExcel->getActiveSheet()->mergeCells('I32:J32');
$objPHPExcel->getActiveSheet()->mergeCells('J1:O7');
$objPHPExcel->getActiveSheet()->mergeCells('J8:O11');
$objPHPExcel->getActiveSheet()->mergeCells('J12:O14');
$objPHPExcel->getActiveSheet()->mergeCells('J24:N26');
$objPHPExcel->getActiveSheet()->mergeCells('J27:N28');
$objPHPExcel->getActiveSheet()->mergeCells('J29:N29');
$objPHPExcel->getActiveSheet()->mergeCells('M52:Z52');
$objPHPExcel->getActiveSheet()->mergeCells('M53:Z53');
$objPHPExcel->getActiveSheet()->mergeCells('M54:Z54');
$objPHPExcel->getActiveSheet()->mergeCells('M55:Z55');
$objPHPExcel->getActiveSheet()->mergeCells('M56:Z56');
$objPHPExcel->getActiveSheet()->mergeCells('M58:O58');
$objPHPExcel->getActiveSheet()->mergeCells('M61:O61');
$objPHPExcel->getActiveSheet()->mergeCells('M63:O64');
$objPHPExcel->getActiveSheet()->mergeCells('M66:O66');
$objPHPExcel->getActiveSheet()->mergeCells('M68:O68');
$objPHPExcel->getActiveSheet()->mergeCells('N31:Z31');
$objPHPExcel->getActiveSheet()->mergeCells('N32:Z32');
$objPHPExcel->getActiveSheet()->mergeCells('N33:Z33');
$objPHPExcel->getActiveSheet()->mergeCells('N34:Z34');
$objPHPExcel->getActiveSheet()->mergeCells('N35:Z35');
$objPHPExcel->getActiveSheet()->mergeCells('N36:Z36');
// combinar celdas 39 hasta 48
for ($i = 39; $i <= 48; $i++) {
	$objPHPExcel->getActiveSheet()->mergeCells("N{$i}:Z{$i}");
}
$objPHPExcel->getActiveSheet()->mergeCells('O24:Q26');
$objPHPExcel->getActiveSheet()->mergeCells('O27:Q28');
$objPHPExcel->getActiveSheet()->mergeCells('O29:Q29');
$objPHPExcel->getActiveSheet()->mergeCells('Q2:U2');
$objPHPExcel->getActiveSheet()->mergeCells('Q3:U3');
$objPHPExcel->getActiveSheet()->mergeCells('Q5:S5');
$objPHPExcel->getActiveSheet()->mergeCells('Q12:S12');
$objPHPExcel->getActiveSheet()->mergeCells('Q13:S13');
$objPHPExcel->getActiveSheet()->mergeCells('Q16:T16');
$objPHPExcel->getActiveSheet()->mergeCells('Q18:T18');
$objPHPExcel->getActiveSheet()->mergeCells('Q20:T20');
$objPHPExcel->getActiveSheet()->mergeCells('R24:T24');
$objPHPExcel->getActiveSheet()->mergeCells('R26:T26');
$objPHPExcel->getActiveSheet()->mergeCells('R27:T27');
$objPHPExcel->getActiveSheet()->mergeCells('R28:T28');
$objPHPExcel->getActiveSheet()->mergeCells('R29:T29');
$objPHPExcel->getActiveSheet()->mergeCells('S8:U9');
$objPHPExcel->getActiveSheet()->mergeCells('T5:U5');
$objPHPExcel->getActiveSheet()->mergeCells('U16:Z16');
$objPHPExcel->getActiveSheet()->mergeCells('U18:Z18');
$objPHPExcel->getActiveSheet()->mergeCells('U20:Z20');
$objPHPExcel->getActiveSheet()->mergeCells('U58:AD58');
$objPHPExcel->getActiveSheet()->mergeCells('U59:AD69');
$objPHPExcel->getActiveSheet()->mergeCells('U24:V24');
$objPHPExcel->getActiveSheet()->mergeCells('U26:V26');
$objPHPExcel->getActiveSheet()->mergeCells('U27:V27');
$objPHPExcel->getActiveSheet()->mergeCells('U28:V28');
$objPHPExcel->getActiveSheet()->mergeCells('U29:V29');
$objPHPExcel->getActiveSheet()->mergeCells('U37:Z37');
$objPHPExcel->getActiveSheet()->mergeCells('V2:AD2');
$objPHPExcel->getActiveSheet()->mergeCells('V3:AD3');
$objPHPExcel->getActiveSheet()->mergeCells('W12:Y12');
$objPHPExcel->getActiveSheet()->mergeCells('W5:Y10');
$objPHPExcel->getActiveSheet()->mergeCells('W13:Y13');
$objPHPExcel->getActiveSheet()->mergeCells('W24:AD24');
$objPHPExcel->getActiveSheet()->mergeCells('W26:AD26');
$objPHPExcel->getActiveSheet()->mergeCells('W27:AD27');
$objPHPExcel->getActiveSheet()->mergeCells('W28:AD28');
$objPHPExcel->getActiveSheet()->mergeCells('W29:AD29');
$objPHPExcel->getActiveSheet()->mergeCells('Z5:AD10');
$objPHPExcel->getActiveSheet()->mergeCells('AB12:AB13');
$objPHPExcel->getActiveSheet()->mergeCells('AB16:AD16');
$objPHPExcel->getActiveSheet()->mergeCells('AB17:AD18');
$objPHPExcel->getActiveSheet()->mergeCells('AB20:AD20');
$objPHPExcel->getActiveSheet()->mergeCells('AB21:AD21');
$objPHPExcel->getActiveSheet()->mergeCells('AC12:AD13');

/**
 * Aplicacion de los estilos
 */
// Borde externo en negrita
$objPHPExcel->getActiveSheet()->getStyle('A1:I14')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('J1:O14')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('P1:AE14')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('A1:O22')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('P15:AE22')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('A23:AE30')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('A31:K56')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('A57:K70')->applyFromArray($borde_negrita_externo);
$objPHPExcel->getActiveSheet()->getStyle('L31:AE70')->applyFromArray($borde_negrita_externo);

// Borde externo punteado
$objPHPExcel->getActiveSheet()->getStyle('B18:N20')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('F24:I24')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('F26:I26')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('F27:I27')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('F29:I29')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('M32')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('M33')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('M34')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('M35')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('M36')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('N32:Z32')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('N33:Z33')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('N34:Z34')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('N35:Z35')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('N36:Z36')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('O24:Q26')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('O27:Q28')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('O29:Q29')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Q58')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Q61')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Q63')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Q66')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Q68')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('V2:AD2')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('V3:AD3')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('S8:U9')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('T5:U5')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U16:Z16')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U18:Z18')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U20:Z20')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('T12')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U12')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('T13')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U13')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U24:V24')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U26:V26')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U27:V27')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U28:V28')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('U29:V29')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('W12')->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle('W13')->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle('W24:AD24')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('W26:AD26')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('W27:AD27')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('W28:AD28')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('W29:AD29')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Z5:AD10')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Z12')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('Z13')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB16:AD16')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB17:AD18')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB20:AD20')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB21:AD21')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB32')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB33')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB34')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB35')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB36')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AB37')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AD32')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AD33')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AD34')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AD35')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AD36')->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle('AD37')->applyFromArray($borde_puntos_externo);
// estilo para las celdas 33 hasta 55
for ($i = 33; $i <= 55; $i++) {
	$objPHPExcel->getActiveSheet()->getStyle("B{$i}:F{$i}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("G{$i}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("H{$i}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("I{$i}:J{$i}")->applyFromArray($borde_puntos_externo);
}
// combinar celdas 38 hasta 48
for ($i = 40; $i <= 49; $i++) {
	$objPHPExcel->getActiveSheet()->getStyle("M{$i}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("N{$i}:Z{$i}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("AB{$i}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("AD{$i}")->applyFromArray($borde_puntos_externo);
}
$objPHPExcel->getActiveSheet()->getStyle("M52:Z52")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("M53:Z53")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("M54:Z54")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("M55:Z55")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("M56:Z56")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("U59:AD69")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("AB52")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("AB53")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("AB54")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("AB55")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("AB56")->applyFromArray($borde_puntos_externo);
$objPHPExcel->getActiveSheet()->getStyle("AC12:AD13")->applyFromArray($borde_puntos_externo);

/*******************************************************
 ******************* Estilo de celdas ******************
 *******************************************************/
$objPHPExcel->getActiveSheet()->getStyle("A31:AD31")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("A31:AD31")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("A31:AD31")->applyFromArray($tamanio9);
$objPHPExcel->getActiveSheet()->getStyle("B16")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("B16")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("B58")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("B63")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("B68")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("B18")->applyFromArray($arial);
$objPHPExcel->getActiveSheet()->getStyle("B18")->applyFromArray($tamanio11);
$objPHPExcel->getActiveSheet()->getStyle("B18")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("B24:E29")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("B29")->applyFromArray($tamanio9);
$objPHPExcel->getActiveSheet()->getStyle("B32:J32")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("B32:J32")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("B33:J55")->applyFromArray($tamanio8);
$objPHPExcel->getActiveSheet()->getStyle("F24:I29")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("F24:I29")->applyFromArray($tamanio9);
$objPHPExcel->getActiveSheet()->getStyle("G33:J55")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("J1:O14")->applyFromArray($tamanio11);
$objPHPExcel->getActiveSheet()->getStyle("J1:O14")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("J1:O14")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("J12")->applyFromArray($rojo);
$objPHPExcel->getActiveSheet()->getStyle("J24:N29")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("M32:AD56")->applyFromArray($tamanio8);
$objPHPExcel->getActiveSheet()->getStyle("M32:M48")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("M37:AD39")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("M37:AD39")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("M58:O68")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("M58:O68")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("O24:Q29")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("Q2:AD3")->applyFromArray($tamanio8);
$objPHPExcel->getActiveSheet()->getStyle("Q2:AD3")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("Q2:AD3")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("Q5")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("Q16:S20")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("R24:T29")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("R58:R68")->applyFromArray($tamanio8);
$objPHPExcel->getActiveSheet()->getStyle("S8")->applyFromArray($tamanio14);
$objPHPExcel->getActiveSheet()->getStyle("T5")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("U24:AD24")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("U24:AD24")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("U26:AD29")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("W5")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("W5")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("W5")->applyFromArray($tamanio8);
$objPHPExcel->getActiveSheet()->getStyle("Z5")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("Q9:Q13")->applyFromArray($arial);
$objPHPExcel->getActiveSheet()->getStyle("Q9:Q13")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("Q9:Q13")->applyFromArray($tamanio8);
$objPHPExcel->getActiveSheet()->getStyle("U16:Z20")->applyFromArray($tamanio9);
$objPHPExcel->getActiveSheet()->getStyle("U16:Z20")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("U16:Z20")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("AB12")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("AB12")->applyFromArray($tamanio9);
$objPHPExcel->getActiveSheet()->getStyle("AB16")->applyFromArray($relleno_gris);
$objPHPExcel->getActiveSheet()->getStyle("AB16:AD21")->applyFromArray($arial);
$objPHPExcel->getActiveSheet()->getStyle("AB16:AD21")->applyFromArray($negrita);
$objPHPExcel->getActiveSheet()->getStyle("AB16:AD21")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("AB16:AD21")->applyFromArray($tamanio9);
$objPHPExcel->getActiveSheet()->getStyle("AB20")->applyFromArray($relleno_gris);
$objPHPExcel->getActiveSheet()->getStyle("AB32:AD55")->applyFromArray($centrado);
$objPHPExcel->getActiveSheet()->getStyle("AB51")->applyFromArray($negrita);

//Encabezados
$objPHPExcel->getActiveSheet()->setCellValue('A31', 'INVENTARIO DE CULTIVOS Y ESPECIES');
$objPHPExcel->getActiveSheet()->setCellValue('B16', 'NOMBRE DEL PROPIETARIO(S) DEL PREDIO');
$objPHPExcel->getActiveSheet()->setCellValue('B24', 'VEREDA / BARRIO:');
$objPHPExcel->getActiveSheet()->setCellValue('B26', 'MUNICIPIO:');
$objPHPExcel->getActiveSheet()->setCellValue('B27', 'DEPARTAMENTO:');
$objPHPExcel->getActiveSheet()->setCellValue('B29', 'Predio requerido para:');
$objPHPExcel->getActiveSheet()->setCellValue('B32', 'DESCRIPCIÓN');
$objPHPExcel->getActiveSheet()->setCellValue('B58', 'FECHA DE ELABORACIÓN:');
$objPHPExcel->getActiveSheet()->setCellValue('B63', 'Elaboró:');
$objPHPExcel->getActiveSheet()->setCellValue('B68', 'Revisó y Aprobó:');
$objPHPExcel->getActiveSheet()->setCellValue('G32', 'CANT.');
$objPHPExcel->getActiveSheet()->setCellValue('H32', 'DENS.');
$objPHPExcel->getActiveSheet()->setCellValue('I32', 'UN.');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'MINISTERIO DE TRANSPORTE');
$objPHPExcel->getActiveSheet()->setCellValue('J8', 'AGENCIA NACIONAL DE INFRAESTRUCTURA');
$objPHPExcel->getActiveSheet()->setCellValue('J12', 'FICHA PREDIAL');
$objPHPExcel->getActiveSheet()->setCellValue('J24', 'CLASIFICACIÓN DEL SUELO');
$objPHPExcel->getActiveSheet()->setCellValue('J27', 'ACTIVIDAD ECONÓMICA DEL PREDIO');
$objPHPExcel->getActiveSheet()->setCellValue('J29', 'TOPOGRAFÍA');
$objPHPExcel->getActiveSheet()->setCellValue('M31', 'ÍTEM');
$objPHPExcel->getActiveSheet()->setCellValue('M39', 'ÍTEM');
$objPHPExcel->getActiveSheet()->setCellValue('M52', '¿Tiene el inmueble licencia urbanística, Urbanización, parcelación, subdivisión, construcción, Intervención, Espacio Público?');
$objPHPExcel->getActiveSheet()->setCellValue('M53', '¿Tiene el inmueble reglamento de Propiedad Horizontal LEY 675 DE 2001?');
$objPHPExcel->getActiveSheet()->setCellValue('M54', '¿Tiene el inmueble aprobado plan parcial en el momento del levantamiento de la Ficha Predial?');
$objPHPExcel->getActiveSheet()->setCellValue('M55', '¿Aplica Informe de análisis de Área Remanente?');
$objPHPExcel->getActiveSheet()->setCellValue('M56', '¿De acuerdo al estudio de títulos, la franja que estipula el decreto 2770 debe adquirirse?');
$objPHPExcel->getActiveSheet()->setCellValue('M58', 'ÁREA TOTAL TERRENO');
$objPHPExcel->getActiveSheet()->setCellValue('M61', 'ÁREA REQUERIDA');
$objPHPExcel->getActiveSheet()->setCellValue('M63', 'ÁREA REMANENTE');
$objPHPExcel->getActiveSheet()->setCellValue('M66', 'ÁREA SOBRANTE');
$objPHPExcel->getActiveSheet()->setCellValue('M68', 'ÁREA TOTAL REQUERIDA');
$objPHPExcel->getActiveSheet()->setCellValue('N31', 'DESCRIPCIÓN DE LAS CONSTRUCCIONES');
$objPHPExcel->getActiveSheet()->setCellValue('N39', 'DESCRIPCIÓN DE LAS CONSTRUCCIONES ANEXAS');
$objPHPExcel->getActiveSheet()->setCellValue('Q2', 'PROYECTO DE CONCESIÓN');
$objPHPExcel->getActiveSheet()->setCellValue('Q3', 'Contrato No.:');
$objPHPExcel->getActiveSheet()->setCellValue('Q5', 'UNIDAD FUNCIONAL');
$objPHPExcel->getActiveSheet()->setCellValue('Q9', 'PREDIO No.');
$objPHPExcel->getActiveSheet()->setCellValue('Q12', 'ABSCISA INICIAL');
$objPHPExcel->getActiveSheet()->setCellValue('Q13', 'ABSCISA FINAL');
$objPHPExcel->getActiveSheet()->setCellValue('Q16', 'CÉDULA');
$objPHPExcel->getActiveSheet()->setCellValue('Q18', 'DIRECCIÓN / EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('Q20', 'DIRECCIÓN DEL PREDIO');
$objPHPExcel->getActiveSheet()->setCellValue('R24', 'LINDEROS');
$objPHPExcel->getActiveSheet()->setCellValue('R26', 'NORTE');
$objPHPExcel->getActiveSheet()->setCellValue('R27', 'SUR');
$objPHPExcel->getActiveSheet()->setCellValue('R28', 'ORIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('R29', 'OCCIDENTE');
$objPHPExcel->getActiveSheet()->setCellValue('R58', 'm2');
$objPHPExcel->getActiveSheet()->setCellValue('R61', 'm2');
$objPHPExcel->getActiveSheet()->setCellValue('R63', 'm2');
$objPHPExcel->getActiveSheet()->setCellValue('R66', 'm2');
$objPHPExcel->getActiveSheet()->setCellValue('R68', 'm2');
$objPHPExcel->getActiveSheet()->setCellValue('T12', 'K');
$objPHPExcel->getActiveSheet()->setCellValue('T13', 'K');
$objPHPExcel->getActiveSheet()->setCellValue('U24', 'LONGITUD');
$objPHPExcel->getActiveSheet()->setCellValue('U37', 'TOTAL ÁREA CONSTRUIDA');
$objPHPExcel->getActiveSheet()->setCellValue('U58', 'OBSERVACIONES:');
$objPHPExcel->getActiveSheet()->setCellValue('W24', 'COLINDANTES');
$objPHPExcel->getActiveSheet()->setCellValue('V2', 'CONCESIÓN VÍAS DEL NUS S.A.S.');
$objPHPExcel->getActiveSheet()->setCellValue('W5', 'SECTOR O TRAMO');
$objPHPExcel->getActiveSheet()->setCellValue('W12', 'MARGEN');
$objPHPExcel->getActiveSheet()->setCellValue('W13', 'MARGEN');
$objPHPExcel->getActiveSheet()->setCellValue('AB12', 'LONGITUD EFECTIVA');
$objPHPExcel->getActiveSheet()->setCellValue('AB16', 'MATRÍCULA INMOBILIARIA');
$objPHPExcel->getActiveSheet()->setCellValue('AB20', 'CÉDULA CATASTRAL');
$objPHPExcel->getActiveSheet()->setCellValue('AB31', 'CANTIDAD');
$objPHPExcel->getActiveSheet()->setCellValue('AB51', 'SI / NO');
$objPHPExcel->getActiveSheet()->setCellValue('AD31', 'UNIDAD');

// Formato de las celdas
$objPHPExcel->getActiveSheet()->getStyle("Q58:Q68")->getNumberFormat()->setFormatCode("#,##0");

//Datos
// Si son dos propietarios
if ($predio->numero_propietarios > 1) {
	// Si es mayor a dos
	if ($predio->numero_propietarios > 2) {
		$propietarios_adicionales = " Y OTROS";
	}else{
		$propietarios_adicionales = " Y OTRO";
	}
}else{
	$propietarios_adicionales = "";
}

$objPHPExcel->getActiveSheet()->setCellValue('B18', $predio->nombre_propietario.$propietarios_adicionales);
$objPHPExcel->getActiveSheet()->setCellValue('F24', $predio->barrio);
$objPHPExcel->getActiveSheet()->setCellValue('F26', $predio->municipio);
$objPHPExcel->getActiveSheet()->setCellValue('F27', 'ANTIOQUIA');
$objPHPExcel->getActiveSheet()->setCellValue('F29', 'USO DE VÍA');
$objPHPExcel->getActiveSheet()->setCellValue('O24', $predio->uso_terreno);
$objPHPExcel->getActiveSheet()->setCellValue('O27', $predio->uso_edificacion);
$objPHPExcel->getActiveSheet()->setCellValue('O29', $predio->topografia);
$objPHPExcel->getActiveSheet()->setCellValue('Q58', $predio->area_total_catastral);
$objPHPExcel->getActiveSheet()->setCellValue('Q61', $predio->area_requerida);
$objPHPExcel->getActiveSheet()->setCellValue('Q63', $predio->area_residual);
$objPHPExcel->getActiveSheet()->setCellValue('Q68', "=Q61+Q63");
$objPHPExcel->getActiveSheet()->setCellValue('Q66', "=Q58-Q68");
$objPHPExcel->getActiveSheet()->setCellValue('U12', $predio->abscisa_inicial);
$objPHPExcel->getActiveSheet()->setCellValue('U13', $predio->abscisa_final);
$unidad = explode('-', $ficha); // Se divide la ficha para sacar unidad y número
$objPHPExcel->getActiveSheet()->setCellValue('T5', $unidad['0']);
$objPHPExcel->getActiveSheet()->setCellValue('S8', $unidad['1']);
$objPHPExcel->getActiveSheet()->setCellValue('U16', $predio->documento_propietario);
$objPHPExcel->getActiveSheet()->setCellValue('U18', $predio->direccion_propietario);
$objPHPExcel->getActiveSheet()->setCellValue('U20', $predio->direccion);
$objPHPExcel->getActiveSheet()->setCellValue('U26', $predio->norte_long);
$objPHPExcel->getActiveSheet()->setCellValue('U27', $predio->sur_long);
$objPHPExcel->getActiveSheet()->setCellValue('U28', $predio->oriente_long);
$objPHPExcel->getActiveSheet()->setCellValue('U29', $predio->occidente_long);
$objPHPExcel->getActiveSheet()->setCellValue('U59', $predio->observacion);
$objPHPExcel->getActiveSheet()->setCellValue('W26', $predio->nom_norte);
$objPHPExcel->getActiveSheet()->setCellValue('W27', $predio->nom_sur);
$objPHPExcel->getActiveSheet()->setCellValue('W28', $predio->nom_oriente);
$objPHPExcel->getActiveSheet()->setCellValue('W29', $predio->nom_occ);
$objPHPExcel->getActiveSheet()->setCellValue('Z5', $predio->tramo);
$objPHPExcel->getActiveSheet()->setCellValue('Z12', $predio->margen_inicial);
$objPHPExcel->getActiveSheet()->setCellValue('Z13', $predio->margen_final);
$objPHPExcel->getActiveSheet()->setCellValue('AC12', '=U13-U12');
$objPHPExcel->getActiveSheet()->setCellValue('AB17', $predio->matricula);
$objPHPExcel->getActiveSheet()->setCellValue('AB21', " ".$predio->no_catastral);
$objPHPExcel->getActiveSheet()->setCellValue('F24', $predio->barrio);
$objPHPExcel->getActiveSheet()->setCellValue('F26', $predio->municipio);
$objPHPExcel->getActiveSheet()->setCellValue('O24', $predio->uso_terreno);
$objPHPExcel->getActiveSheet()->setCellValue('O26', $predio->uso_edificacion);
$objPHPExcel->getActiveSheet()->setCellValue('O28', $predio->topografia);
$objPHPExcel->getActiveSheet()->setCellValue('U26', $predio->norte_long);
$objPHPExcel->getActiveSheet()->setCellValue('U28', $predio->sur_long);
$objPHPExcel->getActiveSheet()->setCellValue('U30', $predio->oriente_long);
$objPHPExcel->getActiveSheet()->setCellValue('U32', $predio->occidente_long);
$objPHPExcel->getActiveSheet()->setCellValue('W26', $predio->nom_norte);
$objPHPExcel->getActiveSheet()->setDinamicSizeRow($predio->nom_norte, 26, "W:AD");
// $objPHPExcel->getActiveSheet()->setDinamicSizeRow($predio->nom_norte, 26, "W", "Z");
$objPHPExcel->getActiveSheet()->setCellValue('W28', $predio->nom_sur);
$objPHPExcel->getActiveSheet()->setCellValue('W30', $predio->nom_oriente);
$objPHPExcel->getActiveSheet()->setCellValue('W32', $predio->nom_occ);


/********************************************************************
************ Cultivos, especies y construcciones ********************
********************************************************************/

// Se consultan los cultivos, construcciones y construcciones anexas
$cultivos = $this->PrediosDAO->obtener_cultivos($ficha);
$construcciones = $this->PrediosDAO->obtener_construcciones($ficha, '1');
$construcciones_anexas = $this->PrediosDAO->obtener_construcciones($ficha, '2');

// Se cuentan los cultivos y las construcciones (mas 7 filas de encabezados y otros datos que tiene la ficha)
$total_cultivos = count($cultivos);
$total_construcciones = count($construcciones) + count($construcciones_anexas) + 9;

// Si hay más cultivos que construcciones, ese será el total de filas a crear, sino, será el total de contrucciones
($total_cultivos > $total_construcciones) ? $total_filas = $total_cultivos : $total_filas = $total_construcciones ;

// Fila inicial
$fila = 37;

// Recorrido del total de filas para formatear el espacio de los cultivos
for ($i=1; $i <= $total_filas; $i++) {
	// Celdas a combinar
	$objPHPExcel->getActiveSheet()->mergeCells("B{$fila}:F{$fila}");
	$objPHPExcel->getActiveSheet()->mergeCells("I{$fila}:J{$fila}");

	// Estilos de celda
	$objPHPExcel->getActiveSheet()->getStyle("B{$fila}:F{$fila}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("G{$fila}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("H{$fila}")->applyFromArray($borde_puntos_externo);
	$objPHPExcel->getActiveSheet()->getStyle("I{$fila}:J{$fila}")->applyFromArray($borde_puntos_externo);

	// Aumento de fila
	$fila++;
} // for

// Fila inicial
$fila = 37;

// Recorrido para llenar el dato de los cultivos y especies
foreach ($cultivos as $cultivo) {
	// Datos
	$objPHPExcel->getActiveSheet()->setCellValue("B{$fila}", $cultivo->descripcion);
	$objPHPExcel->getActiveSheet()->setCellValue("G{$fila}", $cultivo->cantidad);
	$objPHPExcel->getActiveSheet()->setCellValue("H{$fila}", $cultivo->densidad);
	$objPHPExcel->getActiveSheet()->setCellValue("I{$fila}", $cultivo->unidad);

	// Aumento de fila
	$fila++;
} // foreach

	$fila++;
}
// Recorrido de construcciones
$fila = 32;
$cont = 1;
foreach ($this->PrediosDAO->obtener_construcciones($predio->ficha_predial, '1') as $construccion1){
	$objPHPExcel->getActiveSheet()->setCellValue("M{$fila}", $cont++);
	$objPHPExcel->getActiveSheet()->setCellValue("N{$fila}", $construccion1->descripcion);
	$objPHPExcel->getActiveSheet()->setCellValue("AB{$fila}", $construccion1->cantidad);
	$objPHPExcel->getActiveSheet()->setCellValue("AD{$fila}", $construccion1->unidad);

	$fila++;
}
// Recorrido de construcciones anexas
$fila = 40;
$cont = 1;
foreach ($this->PrediosDAO->obtener_construcciones($predio->ficha_predial, '2') as $construccion2){
	$objPHPExcel->getActiveSheet()->setCellValue("M{$fila}", $cont++);
	$objPHPExcel->getActiveSheet()->setCellValue("N{$fila}", $construccion2->descripcion);
	$objPHPExcel->getActiveSheet()->setCellValue("AB{$fila}", $construccion2->cantidad);
	$objPHPExcel->getActiveSheet()->setCellValue("AD{$fila}", $construccion2->unidad);

	$fila++;
}
if ($predio->c_licencia == "1") { $objPHPExcel->getActiveSheet()->setCellValue("AB52", "SI"); }else{ $objPHPExcel->getActiveSheet()->setCellValue("AB52", "NO");}
if ($predio->c_reglamento == "1") { $objPHPExcel->getActiveSheet()->setCellValue("AB53", "SI"); }else{ $objPHPExcel->getActiveSheet()->setCellValue("AB53", "NO");}
if ($predio->c_levantamiento == "1") { $objPHPExcel->getActiveSheet()->setCellValue("AB54", "SI"); }else{ $objPHPExcel->getActiveSheet()->setCellValue("AB54", "NO");}
if ($predio->c_informe == "1") { $objPHPExcel->getActiveSheet()->setCellValue("AB55", "SI"); }else{ $objPHPExcel->getActiveSheet()->setCellValue("AB55", "NO");}
if ($predio->c_adquisicion == "1") { $objPHPExcel->getActiveSheet()->setCellValue("AB56", "SI"); }else{ $objPHPExcel->getActiveSheet()->setCellValue("AB56", "NO");}

// Título de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Ficha predial");

//Pié de página
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' .$objPHPExcel->getProperties()->getTitle() . '&RPágina &P de &N');

//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$ficha.'".xlsx"');

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>
