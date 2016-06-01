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
// Logo Vinus
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo Vinus');
$objDrawing->setDescription('Logo de uso exclusivo de Vinus');
$objDrawing->setPath('./img/logo_vinus.jpg');
$objDrawing->setCoordinates('J1');
$objDrawing->setHeight(60);
$objDrawing->setWidth(60);
$objDrawing->setOffsetX(20);
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
$objDrawing2->setOffsetX(25);
$objDrawing2->setOffsetY(0);
$objDrawing2->setWorksheet($objPHPExcel->getActiveSheet());
// Estilos



/*
 * Definicion de la anchura de las columnas
 */
$columna = "A";
$hoja = $objPHPExcel->getActiveSheet();
// Asingnacion del tamaño de las columnas en 7 desde A hasta N
for ($i=1; $i <= 50; $i++) {
	$hoja->getColumnDimension($columna)->setWidth(8.7);
	$hoja->getRowDimension($i)->setRowHeight(20);
	// siguiente columna
	$columna++;
} // for

//Celdas a combinar
$hoja->mergeCells('A1:C3');
$hoja->mergeCells('D1:I1');
$hoja->mergeCells('D2:I3');

$hoja->mergeCells('J1:K3');

$hoja->mergeCells('M1:N1');
$hoja->mergeCells('M2:N2');
$hoja->mergeCells('M3:N3');

$hoja->mergeCells('A5:N5');

$hoja->mergeCells('A6:B6');
$hoja->mergeCells('C6:E6');
$hoja->mergeCells('F6:G6');
$hoja->mergeCells('H6:I6');
$hoja->mergeCells('K6:N6');

$hoja->mergeCells('A7:B7');
$hoja->mergeCells('C7:E7');
$hoja->mergeCells('F7:G7');
$hoja->mergeCells('H7:I7');
$hoja->mergeCells('K7:N7');

$hoja->mergeCells('A8:C8');
$hoja->mergeCells('D8:N8');

$hoja->mergeCells('A9:C9');
$hoja->mergeCells('D9:N9');

$hoja->mergeCells('A11:N11');

$hoja->mergeCells('A12:E12');
$hoja->mergeCells('F12:G12');
$hoja->mergeCells('H12:I12');
$hoja->mergeCells('J12:L12');

$hoja->mergeCells('A13:G13');
$hoja->mergeCells('J13:N13');

$hoja->mergeCells('A14:B14');
$hoja->mergeCells('C14:D14');
$hoja->mergeCells('E14:F14');
$hoja->mergeCells('G14:H14');
$hoja->mergeCells('I14:J14');
$hoja->mergeCells('K14:L14');

$hoja->mergeCells('A15:L15');

$hoja->mergeCells('A16:D16');
$hoja->mergeCells('G16:L16');

$hoja->mergeCells('A17:E17');
$hoja->mergeCells('H17:I17');
$hoja->mergeCells('J17:N17');

$hoja->mergeCells('A19:C20');
$hoja->mergeCells('D19:E20');
$hoja->mergeCells('F19:N19');

$hoja->mergeCells('F20:H20');
$hoja->mergeCells('I20:K20');
$hoja->mergeCells('L20:N20');

$hoja->mergeCells('A21:B21');
$hoja->mergeCells('F21:G21');
$hoja->mergeCells('I21:J21');
$hoja->mergeCells('L21:M21');

$hoja->mergeCells('A23:L23');

$hoja->mergeCells('A24:B24');
$hoja->mergeCells('C24:N24');

$hoja->mergeCells('A26:N26');

$hoja->mergeCells('A27:E27');
$hoja->mergeCells('H27:I27');
$hoja->mergeCells('K27:N27');

$hoja->mergeCells('B28:C28');
$hoja->mergeCells('D28:E28');
$hoja->mergeCells('F28:H28');
$hoja->mergeCells('I28:J28');
$hoja->mergeCells('K28:N28');

$hoja->mergeCells('B29:C29');
$hoja->mergeCells('D29:E29');
$hoja->mergeCells('F29:H29');
$hoja->mergeCells('I29:J29');
$hoja->mergeCells('K29:N29');

$hoja->mergeCells('A31:N31');

$hoja->mergeCells('A32:N32');

$hoja->mergeCells('A34:D34');
$hoja->mergeCells('E34:N34');

$hoja->mergeCells('A35:D36');
$hoja->mergeCells('E35:I35');
$hoja->mergeCells('J35:N35');

//Encabezados
$hoja->setCellValue('D1', 'CONCESIÓN VÍAS DEL NUS - VINUS');
$hoja->setCellValue('D2', 'FICHA SOCIAL - FORMATO DE CARACTERIZACIÓN GENERAL DE INMUEBLE');
$hoja->setCellValue('L1', 'Código:');
$hoja->setCellValue('L2', 'Versión:');
$hoja->setCellValue('L3', 'Fecha:');
$hoja->setCellValue('M1', 'F012');
$hoja->setCellValue('M2', '1.00');
$hoja->setCellValue('M3', '31/5/2016');



// Contenido
$hoja->setCellValue('A5', '1. DATOS GENERALES');

$hoja->setCellValue('A6', 'Proyecto:');
$hoja->setCellValue('F6', 'Ficha predial:');
$hoja->setCellValue('H6', $ficha);
$hoja->setCellValue('J6', 'Tramo:');

$hoja->setCellValue('A7', 'Municipio:');
$hoja->setCellValue('F7', 'Vereda / Barrio:');
$hoja->setCellValue('J7', 'Dirección:');

$hoja->setCellValue('A8', 'Propietario:');

$hoja->setCellValue('A9', 'Datos de contacto:');

$hoja->setCellValue('A11', '2. CARACTERISTCAS DEL INMUEBLE');

$hoja->setCellValue('A12', 'Requerimiento del terreno por el proyecto:');
$hoja->setCellValue('J12', '¿Se requieren edificaciones?');

$hoja->setCellValue('A13', '¿El valor del área a adquirir es inferior a 3 SLMMV?');
$hoja->setCellValue('J13', 'Usos actuales del inmueble:');

$hoja->setCellValue('A15', '¿En el área no requerida se puede restablecer el uso actual(en caso de requerimiento parcial)?:');

$hoja->setCellValue('A16', '¿Existe vivienda en el inmueble?');
$hoja->setCellValue('G16', '¿La vivienda se encuentra habitada?');

$hoja->setCellValue('A17','¿La vivienda se requiere para el proyecto?');
$hoja->setCellValue('J17', 'Condiciones actuales del inmueble:');

$hoja->setCellValue('A19', 'Servicios básicos');
$hoja->setCellValue('D19', 'Distribucion por numero de:');
$hoja->setCellValue('F19', 'Material predominante');

$hoja->setCellValue('F20', 'Paredes');
$hoja->setCellValue('I20', 'Pisos');
$hoja->setCellValue('L20', 'Techo');

$hoja->setCellValue('A23', '¿Existen edificaciones con infraesructura mínima para el desarrollo de actividades productivas?');

$hoja->setCellValue('A24', '¿Cuáles?');

$hoja->setCellValue('A26', '3. UNIDADES SOCIALES IDENTIFICADAS');

$hoja->setCellValue('A27', '¿Existen unidades sociales identificadas?');
$hoja->setCellValue('H27', '¿Cuantas?');
$hoja->setCellValue('K27', 'Identificación:');

$hoja->setCellValue('A28', 'Nro');
$hoja->setCellValue('B28', 'Categoría');
$hoja->setCellValue('D28', 'Relacion con el inmueble');
$hoja->setCellValue('F28', 'Responsable unidad social');
$hoja->setCellValue('I28', 'Numero de integrantes');
$hoja->setCellValue('K28', 'Firma del responsable de la unidada social');

$hoja->setCellValue('A31', '4. OBSERVACIONES');

$hoja->setCellValue('A34', 'Fecha de levantamiento de la información');
$hoja->setCellValue('E34', 'El profesional social certifica que en la fecha se levantó la inforacion contenida en el presente documento');

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
