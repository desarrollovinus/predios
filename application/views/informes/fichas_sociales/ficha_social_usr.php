<?php
//Se crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
$hoja = $objPHPExcel->getActiveSheet();

//Se establece la configuracion general
$objPHPExcel->getProperties()
	->setCreator("Luis David Moreno - Concesión Vías del Nus - Vinus")
	->setLastModifiedBy("Luis David Moreno")
	->setTitle("Sistema de Gestión Predial Vinus - Generado el ".$this->InformesDAO->formatear_fecha(date('Y-m-d')).' - '.date('h:i A'))
	->setSubject("Ficha social - Caracterización general del inmueble")
    ->setCategory("Reporte");

//Definicion de las configuraciones por defecto en todo el libro
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10); //Tamaño
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);//Ajuste de texto
$objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);// Alineacion centrada

//Se establece la configuracion de la pagina
// $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //Orientacion horizontal
$hoja->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //Tamano oficio
$hoja->getPageSetup()->setScale(100);

//Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
$hoja->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3);

// Título de la hoja
$hoja->setTitle("Caracterización general $ficha");

//Se establecen las margenes
$hoja->getPageMargins()->setTop(0.10); //Arriba
$hoja->getPageMargins()->setRight(0.70); //Derecha
$hoja->getPageMargins()->setLeft(0.80); //Izquierda
$hoja->getPageMargins()->setBottom(0,90); //Abajo

//Centrar página
$hoja->getPageSetup()->setHorizontalCentered();

/*******************************************************
 *********************** Estilos ***********************
 *******************************************************/
 $centrado = array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER ) ); // Alineación centrada
 $negrita = array( 'font' => array( 'bold' => true ) ); // negrita

 $bordes = array(
   'borders' => array(
     'allborders' => array(
       'style' => PHPExcel_Style_Border::BORDER_THIN,
         'color' => array(
           'argb' => '000000'
         	)
       ),
 		),
	);

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

 // variable para guardar valor tamaño de una fila estrecha y el numero de la fila
$filas_estrechas = array();

$hoja->getStyle("A1:N50")->applyFromArray($centrado);

// Logos
// Logo Vinus
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo Vinus');
$objDrawing->setDescription('Logo de uso exclusivo de Vinus');
$objDrawing->setPath('./img/logo_vinus.jpg');
$objDrawing->setCoordinates('J1');
$objDrawing->setHeight(60);
$objDrawing->setWidth(60);
$objDrawing->setOffsetX(30);
$objDrawing->setOffsetY(5);
$objDrawing->getShadow()->setDirection(160);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


// logo ANI
$objDrawing2 = new PHPExcel_Worksheet_Drawing();
$objDrawing2->setName('Logo ANI');
$objDrawing2->setDescription('Logo de uso exclusivo de ANI');
$objDrawing2->setPath('./img/logo_ani.jpg');
$objDrawing2->setCoordinates('A1');
$objDrawing2->setHeight(50);
$objDrawing2->setWidth(100);
$objDrawing2->setOffsetX(35);
$objDrawing2->setOffsetY(0);
$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());

//encabezado
$fila = 1;

$hoja->mergeCells("A{$fila}:C3");
$hoja->mergeCells("J{$fila}:K3");
$hoja->mergeCells("D{$fila}:I{$fila}");
$hoja->mergeCells("M{$fila}:N{$fila}");
$hoja->setCellValue("D{$fila}", "CONCESIÓN VÍAS DEL NUS - VINUS");
$hoja->setCellValue("L{$fila}", "Código:");
$hoja->setCellValue("M{$fila}", "F012");
$fila++;

$hoja->mergeCells("D{$fila}:I3");
$hoja->mergeCells("M{$fila}:N{$fila}");
$hoja->setCellValue("D{$fila}", "FICHA SOCIAL - FORMATO DE CARACTERIZACIÓN GENERAL DE INMUEBLE");
$hoja->setCellValue("L{$fila}", "Versión:");
$hoja->setCellValueExplicit("M{$fila}", "1.00", PHPExcel_Cell_DataType::TYPE_STRING);
$fila++;

$hoja->mergeCells("M{$fila}:N{$fila}");
$hoja->setCellValue("L{$fila}", "Fecha:");
$hoja->setCellValue("M{$fila}", "31/5/2016");
$fila++;

// Contenido
$hoja->mergeCells("A{$fila}:N{$fila}");
array_push($filas_estrechas, $fila);
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$hoja->getStyle("A{$fila}:N{$fila}")->applyFromArray($relleno_gris);
$hoja->setCellValue("A{$fila}", "1. DATOS GENERALES");
$fila++;

$hoja->mergeCells("A{$fila}:B{$fila}");
$hoja->mergeCells("C{$fila}:E{$fila}");
$hoja->mergeCells("F{$fila}:G{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->mergeCells("K{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Proyecto:");
$hoja->setCellValue("C{$fila}", "Vias del Nus");
$hoja->setCellValue("F{$fila}", "Ficha predial:");
$hoja->setCellValue("H{$fila}", $ficha);
$hoja->setCellValue("J{$fila}", "Tramo:");
$hoja->setCellValue("K{$fila}", $predio->tramo);
$fila++;

$hoja->mergeCells("A{$fila}:B{$fila}");
$hoja->mergeCells("C{$fila}:E{$fila}");
$hoja->mergeCells("F{$fila}:G{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->mergeCells("K{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Municipio:");
$hoja->setCellValue("C{$fila}", $predio->municipio);
$hoja->setCellValue("F{$fila}", "Vereda / Barrio:");
$hoja->setCellValue("H{$fila}", $predio->barrio);
$hoja->setCellValue("J{$fila}", "Dirección:");
$hoja->setCellValue("K{$fila}", $predio->direccion);
$fila++;

$hoja->mergeCells("A{$fila}:C{$fila}");
$hoja->mergeCells("D{$fila}:E{$fila}");
$hoja->mergeCells("F{$fila}:I{$fila}");
$hoja->mergeCells("J{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Unidad social nro:");
$hoja->setCellValue("D{$fila}", "{nro}");
$hoja->setCellValue("F{$fila}", "Relacion con el inmueble");
$hoja->setCellValue("J{$fila}", "{Relacion con el inmueble}");
$fila++;

array_push($filas_estrechas, $fila);
$hoja->mergeCells("A{$fila}:N{$fila}");
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$hoja->getStyle("A{$fila}:N{$fila}")->applyFromArray($relleno_gris);
$hoja->setCellValue("A{$fila}", "2. IDENTIFICACION DE LOS INTEGRANTES DE LA UNIDAD SOCIAL RESIDENTE");
$fila++;

$hoja->mergeCells("A{$fila}:D{$fila}");
$hoja->mergeCells("E{$fila}:H{$fila}");
$hoja->mergeCells("I{$fila}:J{$fila}");
$hoja->mergeCells("K{$fila}:L{$fila}");
$hoja->setCellValue("A{$fila}", "Responsable de la unidad social");
$hoja->setCellValue("E{$fila}", "{Responsable de la unidad social}");
$hoja->setCellValue("I{$fila}", "Identificación");
$hoja->setCellValue("K{$fila}", "{Identificacion}");
$hoja->setCellValue("M{$fila}", "Edad");
$hoja->setCellValue("N{$fila}", "{Edad}");
$fila++;

$hoja->mergeCells("A{$fila}:C{$fila}");
$hoja->mergeCells("D{$fila}:F{$fila}");
$hoja->mergeCells("G{$fila}:J{$fila}");
$hoja->mergeCells("K{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Ocupación");
$hoja->setCellValue("D{$fila}", "{Ocupación}");
$hoja->setCellValue("G{$fila}", "Otras actividades");
$hoja->setCellValue("K{$fila}", "{Otras actividades}");
$fila++;

$hoja->mergeCells("A{$fila}:C{$fila}");
$hoja->mergeCells("D{$fila}:E{$fila}");
$hoja->mergeCells("F{$fila}:H{$fila}");
$hoja->mergeCells("I{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Ingresos mensuales");
$hoja->setCellValue("D{$fila}", "{Ingresos mensuales}");
$hoja->setCellValue("F{$fila}", "Datos de verificacion");
$hoja->setCellValue("I{$fila}", "{Datos de verificacion}");
$fila++;

array_push($filas_estrechas, $fila);
$hoja->mergeCells("A{$fila}:N{$fila}");
$fila++;

$hoja->mergeCells("A{$fila}:C{$fila}");
$hoja->mergeCells("D{$fila}:E{$fila}");
$hoja->mergeCells("G{$fila}:H{$fila}");
$hoja->mergeCells("I{$fila}:J{$fila}");
$hoja->mergeCells("K{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Nombre e Identificación");
$hoja->setCellValue("D{$fila}", "Relación");
$hoja->setCellValue("F{$fila}", "Edad");
$hoja->setCellValue("G{$fila}", "Ocupación");
$hoja->setCellValue("I{$fila}", "Ingresos mensuales");
$hoja->setCellValue("K{$fila}", "Datos de verificación");

// Asignación del tamaño de las columnas
for ($columna="A"; $columna < "N"; $columna++) {
	$hoja->getColumnDimension($columna)->setWidth(8.7);
}

// Asignación del tamaño de las filas y aplicacion de bordes
for ($i=1; $i <= $fila; $i++) {
	$hoja->getRowDimension($i)->setRowHeight(20);
	$hoja->getStyle("A{$i}:N{$i}")->applyFromArray($bordes);
	// siguiente columna
	$columna++;
}

// Asignación de las filas estrechas
foreach ($filas_estrechas as $f) {
	$hoja->getRowDimension($f)->setRowHeight(5.7);
}

header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$ficha.' - Caracterización general".xlsx"');

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
