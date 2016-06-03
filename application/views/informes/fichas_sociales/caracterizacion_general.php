<?php
//Se crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

$valores_f = array();

foreach ($valores_fichas as $valor_ficha) {
	array_push($valores_f, $valor_ficha->id_valor_social);
}
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
$hoja->mergeCells('M14:N14');

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
$hoja->setCellValue('C6', 'Vias del Nus');
$hoja->setCellValue('F6', 'Ficha predial:');
$hoja->setCellValue('H6', $ficha);
$hoja->setCellValue('J6', 'Tramo:');
$hoja->setCellValue('K6', $predio->tramo);

$hoja->setCellValue('A7', 'Municipio:');
$hoja->setCellValue('C7', $predio->municipio);
$hoja->setCellValue('F7', 'Vereda / Barrio:');
$hoja->setCellValue('H7', $predio->barrio);
$hoja->setCellValue('J7', 'Dirección:');
$hoja->setCellValue('K7', $predio->direccion);

$hoja->setCellValue('A8', 'Propietario:');
$hoja->setCellValue('D8', $predio->nombre_propietario);

$hoja->setCellValue('A9', 'Datos de contacto:');
$hoja->setCellValue('D9', $predio->direccion_propietario." / ".$predio->telefono_propietario." / ".$predio->email_propietario);

$hoja->setCellValue('A11', '2. CARACTERISTCAS DEL INMUEBLE');

$hoja->setCellValue('A12', 'Requerimiento del terreno por el proyecto:');
$hoja->setCellValue('F12', 'TOTAL ___');
$hoja->setCellValue('H12', 'PARCIAL ___');

if ($ficha_social->requerimiento_terreno == "1") {
	$hoja->setCellValue('H12', 'PARCIAL _X_');
} else if ($ficha_social->requerimiento_terreno == "2") {
	$hoja->setCellValue('F12', 'TOTAL _X_');
}

$hoja->setCellValue('J12', '¿Se requieren edificaciones?');
$hoja->setCellValue('M12', 'SI ___');
$hoja->setCellValue('N12', 'NO ___');

if ($ficha_social->requerimiento_edificaciones) {
	$hoja->setCellValue('M12', 'SI _X_');
} else {
	$hoja->setCellValue('N12', 'NO _X_');
}

$hoja->setCellValue('A13', '¿El valor del área a adquirir es inferior a 3 SLMMV?');
$hoja->setCellValue('H13', 'SI ___');
$hoja->setCellValue('I13', 'NO ___');

if ($ficha_social->area_adquirir) {
	$hoja->setCellValue('H13', 'SI _X_');
} else {
	$hoja->setCellValue('I13', 'NO _X_');
}

$hoja->setCellValue('J13', 'Usos actuales del inmueble:');

$col = "A";
foreach ($this->Gestion_socialDAO->cargar_valores_ficha(1) as $valor1) {
	if(in_array($valor1->id, $valores_f)) {$check = "X";} else {$check = "_";}
		$hoja->setCellValue("{$col}14", $valor1->nombre."_".$check."_");
		$col++;
		$col++;
}

$hoja->setCellValue('A15', '¿En el área no requerida se puede restablecer el uso actual(en caso de requerimiento parcial)?:');
$hoja->setCellValue('M15', 'SI ___');
$hoja->setCellValue('N15', 'NO ___');
if ($ficha_social->restablecer_uso_area_no_requerida) {
	$hoja->setCellValue('M15', 'SI _X_');
} else {
	$hoja->setCellValue('N15', 'NO _X_');
}

$hoja->setCellValue('A16', '¿Existe vivienda en el inmueble?');
$hoja->setCellValue('E16', 'SI ___');
$hoja->setCellValue('F16', 'NO ___');

if ($ficha_social->existe_vivienda) {
	$hoja->setCellValue('E16', 'SI _X_');
} else {
	$hoja->setCellValue('F16', 'NO _X_');
}

$hoja->setCellValue('G16', '¿La vivienda se encuentra habitada?');
$hoja->setCellValue('M16', 'SI ___');
$hoja->setCellValue('N16', 'NO ___');

if ($ficha_social->vivienda_habitada) {
	$hoja->setCellValue('M16', 'SI _X_');
} else {
	$hoja->setCellValue('M16', 'SI _X_');
}


$hoja->setCellValue('A17','¿La vivienda se requiere para el proyecto?');
$hoja->setCellValue('F17','SI ___');
$hoja->setCellValue('G17','NO ___');
$hoja->setCellValue('H17','PARCIAL ___');

switch ($ficha_social->requerida_proyecto) {
	case '0':
		$hoja->setCellValue('G17','NO _X_');
		break;

	case '1':
		$hoja->setCellValue('F17','SI _X_');
		break;

	case '2':
		$hoja->setCellValue('H17','PARCIAL _X_');
		break;
}

$hoja->setCellValue('J17', 'Condiciones actuales del inmueble:');

$hoja->setCellValue('A19', 'Servicios básicos');
$hoja->setCellValue("D19", 'Distribucion por numero de:');
$hoja->setCellValue("F19", 'Material predominante');

$hoja->setCellValue("F20", 'Paredes');
$hoja->setCellValue("I20", 'Pisos');
$hoja->setCellValue("L20", 'Techo');

$fila = 21;
foreach ($this->Gestion_socialDAO->cargar_valores_ficha(2) as $valor2) {
	if(in_array($valor1->id, $valores_f)) {$check = "X";} else {$check = "";}
		$hoja->setCellValue("A{$fila}", $valor2->nombre);
		$hoja->setCellValue("C{$fila}", $check);
		$hoja->mergeCells("A{$fila}:B{$fila}");
		$hoja->mergeCells("F{$fila}:G{$fila}");
		$hoja->mergeCells("I{$fila}:J{$fila}");
		$hoja->mergeCells("L{$fila}:M{$fila}");
		$objPHPExcel->getActiveSheet()->insertNewRowBefore($fila + 1, 1);
		$fila++;
}

// Distribucion por numero de:
$fila = 21;
$hoja->setCellValue("D{$fila}", "Alcobas");
$hoja->setCellValue("E{$fila}", $ficha_social->distribucion_alcobas);
$fila++;

$hoja->setCellValue("D{$fila}", "Cocinas");
$hoja->setCellValue("E{$fila}", $ficha_social->distribucion_cocinas);
$fila++;

$hoja->setCellValue("D{$fila}", "Salas");
$hoja->setCellValue("E{$fila}", $ficha_social->distribucion_sala);
$fila++;

$hoja->setCellValue("D{$fila}", "Comedor");
$hoja->setCellValue("E{$fila}", $ficha_social->distribucion_comedor);
$fila++;

//Paredes
$fila = 21;
foreach ($this->Gestion_socialDAO->cargar_valores_ficha(4) as $valor4) {
	if(in_array($valor4->id, $valores_f)) {$check = "X";} else {$check = "";}
	$hoja->setCellValue("F{$fila}", $valor4->nombre);
	$hoja->setCellValue("H{$fila}", $check);
	$fila++;
}

//Pisos
$fila = 21;
foreach ($this->Gestion_socialDAO->cargar_valores_ficha(5) as $valor5) {
	if(in_array($valor5->id, $valores_f)) {$check = "X";} else {$check = "";}
	$hoja->setCellValue("I{$fila}", $valor5->nombre);
	$hoja->setCellValue("K{$fila}", $check);
	$fila++;
}

//Techo
$fila = 21;
foreach ($this->Gestion_socialDAO->cargar_valores_ficha(6) as $valor6) {
	if(in_array($valor6->id, $valores_f)) {$check = "X";} else {$check = "";}
	$hoja->setCellValue("L{$fila}", $valor6->nombre);
	$hoja->setCellValue("N{$fila}", $check);
	$fila++;
}

$hoja->mergeCells("A{$fila}:N{$fila}");
$fila++;

$hoja->mergeCells("A{$fila}:L{$fila}");
$hoja->setCellValue("A{$fila}", "¿Existen edificaciones con infraesructura mínima para el desarrollo de actividades productivas?");
$hoja->setCellValue("M{$fila}", "SI ___");
$hoja->setCellValue("N{$fila}", "NO ___");
if ($ficha_social->edificaciones_unidades_productivas) {
	$hoja->setCellValue("M{$fila}", "SI _X_");
} else {
	$hoja->setCellValue("N{$fila}", "NO _X_");
}
$fila++;

$hoja->mergeCells("C{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "¿Cuáles?");
$hoja->setCellValue("C{$fila}", $ficha_social->edificaciones_unidades_productivas_descripcion);
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "3. UNIDADES SOCIALES IDENTIFICADAS");
$fila++;

$hoja->mergeCells("A{$fila}:E{$fila}");
$hoja->mergeCells("H{$fila}:J{$fila}");
$hoja->mergeCells("k{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "¿Existen unidades sociales identificadas?");
$hoja->setCellValue("F{$fila}", "SI ___");
$hoja->setCellValue("G{$fila}", "NO ___");
$hoja->setCellValue("H{$fila}", "¿Cuantas?");
$hoja->setCellValue("K{$fila}", "Identificación:");
$fila++;

$hoja->mergeCells("B{$fila}:C{$fila}");
$hoja->mergeCells("D{$fila}:E{$fila}");
$hoja->mergeCells("F{$fila}:H{$fila}");
$hoja->mergeCells("I{$fila}:J{$fila}");
$hoja->mergeCells("K{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Nro");
$hoja->setCellValue("B{$fila}", "Categoría");
$hoja->setCellValue("D{$fila}", "Relacion con el inmueble");
$hoja->setCellValue("F{$fila}", "Responsable unidad social");
$hoja->setCellValue("I{$fila}", "Numero de integrantes");
$hoja->setCellValue("K{$fila}", "Firma del responsable de la unidada social");
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "4. OBSERVACIONES");
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", $ficha_social->observaciones);
$fila++;

$hoja->mergeCells("A{$fila}:N{$fila}");
$fila++;

$hoja->mergeCells("A{$fila}:D{$fila}");
$hoja->mergeCells("E{$fila}:N{$fila}");
$hoja->setCellValue("A{$fila}", "Fecha de levantamiento de la información");
$hoja->setCellValue("E{$fila}", "El profesional social certifica que en la fecha se levantó la inforacion contenida en el presente documento");
$fila++;

$fila2 = $fila + 1;
$hoja->mergeCells("A{$fila}:D{$fila2}");
$hoja->mergeCells("E{$fila}:I{$fila}");
$hoja->mergeCells("J{$fila}:N{$fila}");
$hoja->setCellValue("E{$fila}", "Nombre / Cargo");
$hoja->setCellValue("J{$fila}", "Firma / CC");
$fila++;

$hoja->mergeCells("E{$fila}:I{$fila}");
$hoja->mergeCells("J{$fila}:N{$fila}");

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
