<?php

require_once ('plugins/PDFMerger/PDFMerger.php');

use PDFMerger\PDFMerger;
$pdf = new PDFMerger;

$pdf->addPDF('uploads/Template.pdf');
$pdf->addPDF('uploads/generated.pdf');

$pdf->merge('file',__DIR__.'/uploads/merged.pdf');
?>
