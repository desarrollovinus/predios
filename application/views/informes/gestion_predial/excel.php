<?php
//Se crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

//Modelo que trae la gestión predial
$predios = $this->InformesDAO->obtener_informe_gestion_predial_ani(null);

//Se establece la configuracion general
$objPHPExcel->getProperties()
	->setCreator("John Arley Cano Salinas - Hatovial S.A.S.")
	->setLastModifiedBy("John Arley Cano Salinas")
	->setTitle("Sistema de Gestión Predial - Generado el ".$this->InformesDAO->formatear_fecha(date('Y-m-d')).' - '.date('h:i A'))
	->setSubject("Gestión predial")
	->setDescription("Gestión predial")
	->setKeywords("gestion predial vinus")
    ->setCategory("Reporte");

//Definicion de las configuraciones por defecto en todo el libro
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial'); //Tipo de letra
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9); //Tamanio
$objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);//Ajuste de texto
$objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);// Alineacion centrada

//Se establece la configuracion de la pagina
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); //Orientacion horizontal
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER); //Tamano carta
$objPHPExcel->getActiveSheet()->getPageSetup()->setScale(100); 

//Se indica el rango de filas que se van a repetir en el momento de imprimir. (Encabezado del reporte)
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1);

//Se establecen las margenes
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0,90); //Arriba
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0,70); //Derecha
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0,70); //Izquierda
// $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0,90); //Abajo

//Centrar página
$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered();

/**
 * Estilos
 */
//Estilo de los titulos
$titulo_centrado_negrita = array(
	'font' => array(
		'bold' => true
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);

$titulo_centrado = array(
	'font' => array(
		'bold' => false
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);

$titulo_izquierdo = array(
	'font' => array(
		'bold' => false
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
	)
);

$titulo_derecho = array(
	'font' => array(
		'bold' => true
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	)
);

//Estilo de los bordes
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

/*
 * Definicion de la anchura de las columnas
 */
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(200);

//Celdas a combinar
// $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');

/**
 * Aplicacion de los estilos a la cabecera
 */
$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($titulo_centrado_negrita);

//Encabezados
$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Unidad funcional');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Predio');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Tramo');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Abscisa inicial');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Abscisa final');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Longitud efectiva');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Margen');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Propietarios');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Nombres');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Documento');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Dirección');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Matrícula');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Cédula catastral');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Municipio');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'Barrio / vereda');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Clasificación');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'Actividad económica');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'Topografía');
$objPHPExcel->getActiveSheet()->setCellValue('T1', 'Área total terreno');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'Área requerida');
$objPHPExcel->getActiveSheet()->setCellValue('V1', 'Área remanente');
$objPHPExcel->getActiveSheet()->setCellValue('W1', 'Área sobrante');
$objPHPExcel->getActiveSheet()->setCellValue('X1', 'Área total requerida');
$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Lindero');

//Se declara fila
$fila = 2;
$numero = 1;

//Se recorren los predios
foreach ($predios as $predio) {
	//Estilos
	$objPHPExcel->getActiveSheet()->getStyle("T{$fila}")->getNumberFormat()->setFormatCode("#,##0");
	$objPHPExcel->getActiveSheet()->getStyle("U{$fila}")->getNumberFormat()->setFormatCode("#,##0");
	$objPHPExcel->getActiveSheet()->getStyle("V{$fila}")->getNumberFormat()->setFormatCode("#,##0");
	$objPHPExcel->getActiveSheet()->getStyle("W{$fila}")->getNumberFormat()->setFormatCode("#,##0");
	$objPHPExcel->getActiveSheet()->getStyle("X{$fila}")->getNumberFormat()->setFormatCode("#,##0");

	// Para el abscisado inicial
	$ms_inicial = substr($predio->abscisa_inicial, -3);
	$kms_inicial = substr($predio->abscisa_inicial, 0, strlen($predio->abscisa_inicial) - 3);
	if($kms_inicial == "") {
		$kms_inicial = "0";
	}

	// Para el abscisado final
	$ms_final = substr($predio->abscisa_final, -3);
	$kms_final = substr($predio->abscisa_final, 0, strlen($predio->abscisa_final) - 3);
	if($kms_final == "") {
		$kms_final = "0";
	}

	//Contenido
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $numero++);
	$unidad = explode('-', $predio->ficha_predial); // Se divide la ficha para sacar unidad y número
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $unidad['0']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $unidad['1']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $predio->tramo);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $kms_inicial."+".$ms_inicial);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $kms_final."+".$ms_final);
	// $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $predio->abscisa_inicial);
	// $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $predio->abscisa_final);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $predio->abscisa_final - $predio->abscisa_inicial);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $predio->margen);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $predio->numero_propietarios);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, $predio->nombre_propietario);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $predio->documento_propietario);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila, $predio->direccion);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila, $predio->matricula);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila, $predio->no_catastral);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$fila, $predio->municipio);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$fila, $predio->barrio);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila, $predio->uso_edificacion);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.$fila, $predio->uso_terreno);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.$fila, $predio->topografia);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.$fila, $predio->area_total);
	$objPHPExcel->getActiveSheet()->setCellValue('U'.$fila, $predio->area_requerida);
	$objPHPExcel->getActiveSheet()->setCellValue('V'.$fila, $predio->area_residual);
	$objPHPExcel->getActiveSheet()->setCellValue('W'.$fila, "=T{$fila}-X{$fila}");
	$objPHPExcel->getActiveSheet()->setCellValue('X'.$fila, "=U{$fila}+V{$fila}");
	$objPHPExcel->getActiveSheet()->setCellValue('Y'.$fila, utf8_decode($predio->lind_titulo));

	//Se aumenta la fila y el contador
	$fila++;
}

//Pié de página
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' .$objPHPExcel->getProperties()->getTitle() . '&RPágina &P de &N');

// Título de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Gestión predial");


//Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Cache-Control: max-age=0');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Gestión predial.xlsx"');

//Se genera el excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>