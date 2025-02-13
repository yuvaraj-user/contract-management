<?php
require_once('plugins/fpdi/vendor/autoload.php'); // Path to the Composer autoload file

require_once('plugins/TCPDF/tcpdf.php'); // Path to the Composer autoload file

use setasign\Fpdi\TcpdfFpdi;
// Create a new instance of TCPDF
$pdf = new TcpdfFpdi();

// Load the template (existing PDF with placeholders)
$templateFile = 'uploads/Template.pdf';
$pdf->setSourceFile($templateFile);
$templateId = $pdf->importPage(1); // Import the first page
$pdf->AddPage();
$pdf->useTemplate($templateId);

// Define dynamic variables to replace the placeholders
$dynamicVariables = [
    '${company_location}' => '1234 Street Name, City, Country',
];

// Set the font for the text
$pdf->SetFont('helvetica', '', 12);

// Function to write dynamic content
function writeDynamicText($pdf, $x, $y, $text, $width) {
    // Calculate the height of the text
    $pdf->SetXY($x, $y);
    $height = $pdf->getStringHeight($width, $text);

    // Write the text with automatic wrapping
    $pdf->MultiCell($width, 0, $text);

    // Return the height of the text to update the Y position for the next item
    return $height;
}

// Set initial position for ${company_location}
$startX = 80; // X-coordinate on the page
$startY = 50; // Y-coordinate on the page
$width = 100; // Width of the area to write text

// Replace the ${company_location} placeholder with the address
$companyLocation = $dynamicVariables['${company_location}'];

// Write the dynamic address content
$height = writeDynamicText($pdf, $startX, $startY, $companyLocation, $width);
$startY += $height; // Update Y position for the next item

// Output the modified PDF
$pdf->Output('output_with_dynamic_content.pdf', 'I');
?>