<?php

// Se crea el nuevo objeto
$PHPWord = new PHPWord();



$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$temp_file_uri = tempnam('', 'xyz');
$objWriter->save($temp_file_uri);

//download code
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename=Acta_Recibo.docx');
header('Content-Disposition: attachment; filename=UF0-00 - Estudio de Títulos.docx');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Content-Length: ' . filesize($temp_file_uri));
readfile($temp_file_uri);
unlink($temp_file_uri); // deletes the temporary file