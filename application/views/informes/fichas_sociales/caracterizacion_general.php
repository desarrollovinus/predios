<?php 
//Se crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

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
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); //Tamano oficio
$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(100);

//Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3);

// Título de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Caracterización general $ficha");

//Se establecen las margenes
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.10); //Arriba
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.70); //Derecha
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.80); //Izquierda
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0,90); //Abajo

//Centrar página
$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered();

// Ocultar la cuadrícula: 
// $objPHPExcel->getActiveSheet()->setShowGridlines(false);

// Logos


// Estilos



/*
 * Definicion de la anchura de las columnas
 */
$columna = "A";

// 
for ($i=1; $i <= 14; $i++) {
	// 
	$objPHPExcel->getActiveSheet()->getColumnDimension($columna)->setWidth(7);
	
	// 
	$columna++;
} // for

//Celdas a combinar
$objPHPExcel->getActiveSheet()->mergeCells('A1:C3');
$objPHPExcel->getActiveSheet()->mergeCells('D1:I1');
$objPHPExcel->getActiveSheet()->mergeCells('D2:I3');
$objPHPExcel->getActiveSheet()->mergeCells('J1:K3');
$objPHPExcel->getActiveSheet()->mergeCells('M1:N1');
$objPHPExcel->getActiveSheet()->mergeCells('M2:N2');
$objPHPExcel->getActiveSheet()->mergeCells('M3:N3');

//Encabezados
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'CONCESIÓN VÍAS DEL NUS - VINUS');
$objPHPExcel->getActiveSheet()->setCellValue('F6', 'Ficha predial');




// Contenido
$objPHPExcel->getActiveSheet()->setCellValue('H6', $ficha);



//Tamaño de celdas
// $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(6);


//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$ficha.' - Caracterización general".xlsx"');

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>