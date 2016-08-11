<?php

//Se crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
$hoja = $objPHPExcel->getActiveSheet();

//Se establece la configuracion general
$objPHPExcel->getProperties()
	->setCreator("Luis David Moreno - Concesión Vías del Nus - Vinus")
	->setLastModifiedBy("Luis David Moreno")
	->setTitle("Sistema de Gestión Predial Vinus - Generado el ".$this->InformesDAO->formatear_fecha(date('Y-m-d')).' - '.date('h:i A'))
	->setSubject("Ficha social - Unidad social productiva")
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
$hoja->setTitle("Unidad social productiva");

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

$bordes_externos = array(
  'borders' => array(
    'outline' => array(
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

// Asignación del tamaño de las columnas
for ($columna="A"; $columna < "J"; $columna++) {
	$hoja->getColumnDimension($columna)->setWidth(12.5);
}

// asignacion del tamaño de las filas
for ($i=6; $i <= 50; $i++) {
	$hoja->getRowDimension($i)->setRowHeight(20);
}


// Logos
// Logo Vinus
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo Vinus');
$objDrawing->setDescription('Logo de uso exclusivo de Vinus');
$objDrawing->setPath('./img/logo_vinus.jpg');
$objDrawing->setCoordinates('G1');
$objDrawing->setHeight(60);
$objDrawing->setWidth(60);
$objDrawing->setOffsetX(10);
$objDrawing->setOffsetY(10);
$objDrawing->getShadow()->setDirection(160);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// logo ANI
$objDrawing2 = new PHPExcel_Worksheet_Drawing();
$objDrawing2->setName('Logo ANI');
$objDrawing2->setDescription('Logo de uso exclusivo de ANI');
$objDrawing2->setPath('./img/logo_ani.jpg');
$objDrawing2->setCoordinates('A1');
$objDrawing2->setHeight(50);
$objDrawing2->setWidth(120);
$objDrawing2->setOffsetX(20);
$objDrawing2->setOffsetY(0);
$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());

//encabezado
$fila = 1;

$hoja->mergeCells("A{$fila}:B3");
$hoja->mergeCells("C{$fila}:F{$fila}");
$hoja->mergeCells("G{$fila}:G3");
$hoja->getStyle("H{$fila}")->applyFromArray($negrita);
$hoja->setCellValue("C{$fila}", 'CONCESIÓN VÍAS DEL NUS - VINUS');
$hoja->setCellValue("H{$fila}", 'Código:');
$hoja->setCellValue("I{$fila}", 'F014');
$fila++;

$hoja->mergeCells("C{$fila}:F3");
$hoja->setCellValue("C{$fila}", 'FICHA SOCIAL - FORMATO DE CARACTERIZACIÓN DE UNIDAD SOCIAL PRODUCTIVA');
$hoja->getStyle("H{$fila}")->applyFromArray($negrita);
$hoja->setCellValue("H{$fila}", 'Versión:');
$hoja->setCellValueExplicit("I{$fila}", 'V1.00', PHPExcel_Cell_DataType::TYPE_STRING);
$fila++;

$hoja->getStyle("H{$fila}")->applyFromArray($negrita);
$hoja->setCellValue("H{$fila}", 'Fecha');
$hoja->setCellValue("I{$fila}", '9/08/2016');
$fila++;


// Contenido
$hoja->mergeCells("A{$fila}:I{$fila}");
array_push($filas_estrechas, $fila);
$fila++;

$hoja->mergeCells("A{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($relleno_gris);
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($negrita);
$hoja->setCellValue("A{$fila}", '1. DATOS GENERALES');
$fila++;

$hoja->mergeCells("B{$fila}:C{$fila}");
$hoja->mergeCells("E{$fila}:F{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:C{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("D{$fila}:F{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("G{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Proyecto');
$hoja->setCellValue("B{$fila}", 'Vías del Nus');
$hoja->setCellValue("D{$fila}", 'Ficha predial');
$hoja->setCellValue("E{$fila}", $predio->ficha_predial);
$hoja->setCellValue("G{$fila}", 'Tramo');
$hoja->setCellValue("H{$fila}", $predio->tramo);
$fila++;

$hoja->mergeCells("B{$fila}:C{$fila}");
$hoja->mergeCells("E{$fila}:F{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:C{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("D{$fila}:F{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("G{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Municipio');
$hoja->setCellValue("B{$fila}", $predio->municipio);
$hoja->setCellValue("D{$fila}", 'Vereda / Barrio');
$hoja->setCellValue("E{$fila}", $predio->barrio);
$hoja->setCellValue("G{$fila}", 'Dirección');
// $hoja->setCellValue("H{$fila}", $predio->direccion);
$hoja->setDinamicSizeRow($predio->direccion, $fila, "H:I");
$fila++;

$hoja->mergeCells("A{$fila}:B{$fila}");
$hoja->mergeCells("D{$fila}:F{$fila}");
$hoja->mergeCells("G{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:C{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("D{$fila}:F{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("G{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Unidad Social Nro.');
$hoja->setCellValue("C{$fila}", '1');
$hoja->setCellValue("D{$fila}", 'Relación con el inmueble');
$hoja->setCellValue("G{$fila}", $relacion_inmueble->nombre);
$fila_aux = $fila - 3;
$hoja->getStyle("A{$fila_aux}:I{$fila}")->applyFromArray($borde_negrita_externo);
$fila++;

$hoja->mergeCells("A{$fila}:I{$fila}");
array_push($filas_estrechas, $fila);
$fila++;

$hoja->mergeCells("A{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($relleno_gris);
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($negrita);
$hoja->setCellValue("A{$fila}", '1. IDENTIFICACIÓN DE LA UNIDAD SOCIAL PRODUCTIVA');
$fila++;

$hoja->mergeCells("B{$fila}:F{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:F{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("G{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Titular');
$hoja->setCellValue("B{$fila}", $unidad_productiva->titular);
$hoja->setCellValue("G{$fila}", 'Identificación');
$hoja->setCellValue("H{$fila}", $unidad_productiva->identificacion);
$fila++;

$hoja->mergeCells("A{$fila}:C{$fila}");
$hoja->mergeCells("D{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Datos de verificación');
$hoja->setCellValue("D{$fila}", $unidad_productiva->datos_verificacion);
$fila++;

$hoja->mergeCells("A{$fila}:B{$fila}");
$hoja->mergeCells("C{$fila}:F{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:F{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("G{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Nombre y/o razón social');
$hoja->setCellValue("C{$fila}", $unidad_productiva->razon_social);
$hoja->setCellValue("G{$fila}", 'NIT');
$hoja->setCellValue("H{$fila}", $unidad_productiva->nit);
$fila++;

$hoja->mergeCells("A{$fila}:D{$fila}");
$hoja->mergeCells("E{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Descripción de la actividad desarrollada');
$hoja->setCellValue("E{$fila}", $unidad_productiva->descripcion_actividad);
$fila++;

$hoja->mergeCells("A{$fila}:F{$fila}");
$hoja->mergeCells("G{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", '¿Cuánto tiempo hace que desarrolla la actividad en el inmueble?');
$hoja->setCellValue("G{$fila}", $unidad_productiva->antiguedad);
$fila++;

$hoja->mergeCells("A{$fila}:D{$fila}");
$hoja->mergeCells("F{$fila}:G{$fila}");
$hoja->mergeCells("H{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:E{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("F{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", 'Valor del Canon de arrendamiento (si existe)');
$hoja->setCellValue("E{$fila}", $unidad_productiva->canon);
$hoja->setCellValue("F{$fila}", 'Próximo vencimiento');
$hoja->setCellValue("H{$fila}", $unidad_productiva->fecha_vencimiento_contrato);
$fila++;

$hoja->mergeCells("A{$fila}:C{$fila}");
$hoja->mergeCells("G{$fila}:I{$fila}");
$hoja->getStyle("A{$fila}:E{$fila}")->applyFromArray($bordes_externos);
$hoja->getStyle("F{$fila}:I{$fila}")->applyFromArray($bordes_externos);
$hoja->setCellValue("A{$fila}", '¿Lleva algún tipo de contabilidad?');
$hoja->setCellValue("D{$fila}", ($unidad_productiva->lleva_contabilidad) ? "SI _X_" : "SI ___");
$hoja->setCellValue("E{$fila}", (!$unidad_productiva->lleva_contabilidad) ? "NO _X_" : "NO ___");
$hoja->setCellValue("F{$fila}", '¿Cuál?');
$hoja->setCellValue("G{$fila}", $unidad_productiva->contabilidad);
$fila++;

// Asignación del tamaño de las filas y aplicacion de bordes
for ($i=1; $i <= 3; $i++) {
	$hoja->getRowDimension($i)->setRowHeight(26);
	$hoja->getStyle("A{$i}:I{$i}")->applyFromArray($bordes);
}

// Asignación de las filas estrechas
foreach ($filas_estrechas as $f) {
	$hoja->getRowDimension($f)->setRowHeight(5.7);
}

header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$unidad_productiva->ficha_predial.' - Unidad social residente".xlsx"');

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
