<?php

// Se crea el nuevo objeto
$PHPWord = new PHPWord();

// $identificacion = $this->PrediosDAO->obtener_identificacion('UF1-01');

$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$temp_file_uri = tempnam('', 'xyz');
$objWriter->save($temp_file_uri);

/**
 * Configuración por defecto
 */
$PHPWord->setDefaultFontName('Arial');
$PHPWord->setDefaultFontSize(11);
$properties = $PHPWord->getProperties();
$properties->setCreator('Luis David Moreno Lopera');
$properties->setCompany('VINUS S.A.S.');
$properties->setTitle('Estudio de titulos');
$properties->setDescription('Estudio de titulos');
$properties->setCategory('informe');
$properties->setLastModifiedBy('Luis David Moreno Lopera');

/**
 * Estilos de alineación
 */
$alineacion_centrada = array ('align' => 'center', 'valign' => 'center');
$alineacion_izquierda = array ('align' => 'left', 'valign' => 'center');
$alineacion_derecha = array ('align' => 'right', 'valign' => 'center');
$alineacion_justificada = array ('align' => 'both', 'valign' => 'center');

/**
 * Estilos de las fuentes
 */
$PHPWord->addFontStyle('titulo1', array( 'name'=>'Arial', 'size'=> 18, 'color'=>'000000', 'bold'=> true, 'italic' => true));
$PHPWord->addFontStyle('titulo2', array( 'name'=>'Arial', 'size'=> 12, 'color'=>'000000', 'bold'=> true));
$PHPWord->addFontStyle('titulo3', array( 'name'=>'Arial', 'size'=> 8, 'color'=>'000000', 'bold'=> true, 'italic' => true));

$PHPWord->addFontStyle('parrafo1', array( 'name'=>'Arial', 'size'=> 11, 'color'=>'000000', 'bold'=> true));
$PHPWord->addFontStyle('parrafo2', array( 'name'=>'Arial', 'size'=> 12, 'color'=>'000000', 'bold'=> false));

/**
 * Estilos de las tablas
 */
$tabla1 = array('borderColor'=>'000000', 'borderSize'=> 6);
$tabla2 = array('borderSize' => 8, 'borderColor' => '1E1E1E',  'cellMarginTop' => 100, 'rules' => 'cols');
$tabla3 = array('cellMarginTop' => 50, 'rules' => 'cols');
$tabla4 = array('borderRightSize' => 50, 'borderBottomColor' => '009900',    'borderBottomSize' => 50, 'borderRightColor' => '00CCFF',    'borderTopSize' => 50, 'borderTopColor' => '00CCFF',    'borderLeftSize' => 50, 'borderLeftColor' => '00CCFF');

/**
 * Estilos de celdas
 */
$styleCell = array('valign' => 'center');

/**
 * Sección 1
 */
$seccion1 = $PHPWord->createSection(array('pageSizeW'=>12240, 'pageSizeH'=>15840));

/**
 * Cabecera
 */
$PHPWord->addTableStyle('tabla1', $tabla3);
$cabecera = $seccion1->createHeader();
$table = $cabecera->addTable('tabla1');
$table->addRow(1000);
// $table->addCell(4000, $styleCell)->addText('COCAN 900.193.471-9', 'titulo1', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addImage('./img/logo_vinus.png',
array(
  'width' => 80,
  'height' => 80,
  'align' => 'left',
  'marginTop' => -1,
  'marginLeft' => -1,
  'wrappingStyle' => 'behind'
));

$table->addCell(10000, $styleCell)->addText(utf8_decode("ESTUDIO DE TÍTULOS PREDIO "). utf8_decode(utf8_decode($descripcion->uso_edificacion)), 'titulo2', $alineacion_centrada);

$table->addCell(10000, $styleCell)->addImage('./img/logo_ani.jpg',
array(
  'width' => 80,
  'align' => 'right',
  'marginTop' => -1,
  'marginLeft' => -1,
  'wrappingStyle' => 'behind'
));
$cabecera->addTextBreak();

$seccion1->addText(utf8_decode("ESTUDIO DE TÍTULOS PREDIO "). utf8_decode(utf8_decode($descripcion->uso_edificacion)), 'titulo2', $alineacion_centrada);
$seccion1->addTextBreak();

$PHPWord->addTableStyle('tabla2', $tabla1);
$table = $seccion1->addTable('tabla2');
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("NOMBRE DEL PROYECTO"), 'parrafo1', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("TRAMO"), 'parrafo1', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("Nº PREDIO"), 'parrafo1', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("ABSCISA INICIAL"), 'parrafo1', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("ABSCISA FINAL"), 'parrafo1', $alineacion_centrada);
$table->addRow();
$abscisa_inicial = explode(".", (string)((int)$descripcion->abscisa_inicial / 1000));
$abscisa_inicial = "K".$abscisa_inicial[0]."+".$abscisa_inicial[1];
$abscisa_final = explode(".", (string)((int)$descripcion->abscisa_final / 1000));
$abscisa_final = "K".$abscisa_final[0]."+".$abscisa_final[1];
$table->addCell(10000, $styleCell)->addText(utf8_decode("VÍAS DEL NUS"), 'parrafo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($descripcion->tramo)), 'parrafo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($predio->ficha_predial)), 'parrafo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($abscisa_inicial)), 'parrafo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($abscisa_final)), 'parrafo2', $alineacion_centrada);
$seccion1->addTextBreak();

$seccion1->addText(utf8_decode("1. IDENTIFICACIÓN DEL INMUEBLE"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$PHPWord->addTableStyle('tabla3', $tabla3);
$table = $seccion1->addTable('tabla3');
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Dirección:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($identificacion->direccion)), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Municipio:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($identificacion->municipio)), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Departamento:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode("Antioquia"), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Matricula Inmobiliaria:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($identificacion->matricula_orig)), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Cedula catastral:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($identificacion->no_catastral)), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Destinación:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($descripcion->uso_edificacion)), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Coordenadas de amarre:"), 'parrafo2', $alineacion_izquierda);
$table->addCell(10000, $styleCell)->addText(utf8_decode("Sistema Magna Sirgas - Origen Bogotá"), 'parrafo2', $alineacion_izquierda);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("Área del predio:"), 'parrafo2', $alineacion_izquierda);

$seccion1->addTextBreak();

$PHPWord->addTableStyle('tabla4', $tabla1);
$table = $seccion1->addTable('tabla4');
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("CATASTRAL"), 'titulo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("REGISTRAL"), 'titulo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("TITULOS (E.P)"), 'titulo2', $alineacion_centrada);
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode($descripcion->area_total_catastral), 'parrafo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode($descripcion->area_total_registral), 'parrafo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode($descripcion->area_total_titulos), 'parrafo2', $alineacion_centrada);
$seccion1->addTextBreak();

$seccion1->addText(utf8_decode("Descripción, Cabida y Linderos: "), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$seccion1->addText(utf8_decode(utf8_decode($linderos->linderos)), 'parrafo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$seccion1->addText(utf8_decode("2. TITULARIDAD DEL INMUEBLE"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$PHPWord->addTableStyle('tabla5', $tabla1);
$table = $seccion1->addTable('tabla5');
$table->addRow();
$table->addCell(10000, $styleCell)->addText(utf8_decode("PROPIETARIO"), 'titulo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("DOCUMENTO"), 'titulo2', $alineacion_centrada);
$table->addCell(10000, $styleCell)->addText(utf8_decode("(%)"), 'titulo2', $alineacion_centrada);
foreach ($propietarios as $propietario) {
  $table->addRow();
  $table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($propietario->nombre)), 'parrafo2', $alineacion_izquierda);
  $table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($propietario->documento)), 'parrafo2', $alineacion_izquierda);
  $table->addCell(10000, $styleCell)->addText(utf8_decode(utf8_decode($propietario->participacion)), 'parrafo2', $alineacion_izquierda);
}
$seccion1->addTextBreak();

// para mostrar viñetas se usa TYPE_BULLET_FILLED con la funcion addListItem
$seccion1->addText(utf8_decode("3. TRADICION DEL INMUEBLE"), 'titulo2', $alineacion_izquierda);
$titulo_adq_items = explode("?", substr(utf8_decode(utf8_decode($identificacion->titulos_adq)), 1));
foreach ($titulo_adq_items as $item) {
  if ($item == null) { break; }
  $seccion1->addListItem($item, 0, 'parrafo2', 'TYPE_BULLET_FILLED');
  $seccion1->addTextBreak();
}

$seccion1->addText(utf8_decode("4. GRAVÁMENES Y LIMITACIONES"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$gravamenes = explode("?", substr(utf8_decode(utf8_decode($identificacion->gravamenes)), 1));
foreach ($gravamenes as $item) {
  if ($item == null) { break; }
  $seccion1->addListItem($item, 0, 'parrafo2', 'TYPE_BULLET_FILLED');
  $seccion1->addTextBreak();
}

$seccion1->addText(utf8_decode("5. SEGREGACIONES DEL INMUEBLE"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$seccion1->addText(utf8_decode("6. OBSERVACIONES DEL INMUEBLE"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$observaciones_titulo = explode("?", substr(utf8_decode(utf8_decode($identificacion->ob_titu)), 1));
foreach ($observaciones_titulo as $observacion) {
  if ($observacion == null) { break; }
  $seccion1->addListItem($observacion, 0, 'parrafo2', 'TYPE_BULLET_FILLED');
  $seccion1->addTextBreak();
}

$seccion1->addText(utf8_decode("7. CONCEPTO"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$concepto_items = explode("?", substr(utf8_decode(utf8_decode($identificacion->conc_titu)), 1));
foreach ($concepto_items as $item) {
  if ($item == null) { break; }
  $seccion1->addListItem($item, 0, 'parrafo2', 'TYPE_BULLET_FILLED');
  $seccion1->addTextBreak();
}

$seccion1->addText(utf8_decode("8. DOCUMENTOS DE ESTUDIO"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$documentos_items = explode("?", substr(utf8_decode(utf8_decode($identificacion->doc_estud)), 1));
foreach ($documentos_items as $item) {
  if ($item == null) { break; }
  $seccion1->addListItem($item, 0, 'parrafo2', 'TYPE_BULLET_FILLED');
  $seccion1->addTextBreak();
}

$seccion1->addText(utf8_decode("9. FECHA DE ELABORACION Y AJUSTE"), 'titulo2', $alineacion_izquierda);
$seccion1->addTextBreak();

$footer = $seccion1->createFooter();
$footer->addText(utf8_decode("Concesión Vías del NUS S.A.S | Calle 59 No.48 35 Copacabana, Antioquia (Kilómetro 4 + 500 Autopista Norte)"), 'titulo3', $alineacion_centrada);
$footer->addText(utf8_decode("PBX (574) 401 2277 FAX: (574) 401 2277"), 'titulo3', $alineacion_centrada);
$footer->addPreserveText(utf8_decode('www.vinus.com.co | Página {PAGE} de {NUMPAGES}'), 'titulo3', $alineacion_centrada);

$temp_file_uri = tempnam('', 'xyz');
$objWriter->save($temp_file_uri);
//download code
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename=Acta_Recibo.docx');
header("Content-Disposition: attachment; filename={$predio->ficha_predial} - Estudio de Títulos.docx");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Content-Length: ' . filesize($temp_file_uri));
readfile($temp_file_uri);
unlink($temp_file_uri); // deletes the temporary file
exit;
