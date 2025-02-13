<?php

require_once 'plugins/TCPDF/tcpdf.php';

// Create new PDF instance
$pdf = new TCPDF();

// Set the source file (PDF)
$pdf->setSourceFile('uploads/generated.pdf');

// Get the number of pages in the PDF
$pageCount = $pdf->getNumPages();

// Loop through each page and extract text
$text = '';
for ($page = 1; $page <= $pageCount; $page++) {
    // Import the page and extract text from it
    $template = $pdf->importPage($page);
    $pdf->useTemplate($template);
    $text .= $pdf->getText();
}

// Display extracted text
echo nl2br($text);
?>
