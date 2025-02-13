<?php
// Include the PDF2Text class (ensure this path is correct)
require_once('plugins/pdf2text/PDF2Text.php');

// Create a new PDF2Text object
$pdf = new PDF2Text();

// Set the PDF file path (ensure this is correct)
$pdf->setFilename('uploads/generated.pdf');

// echo file_get_contents('uploads/testpdf.pdf');

// Decode the PDF file (this is where the extraction happens)
$pdf->decodePDF();

// Get the extracted text
$text = $pdf->output();

// Check if text was extracted
if ($text) {
    echo htmlentities($text,ENT_QUOTES);  // Display the extracted text
} else {
    echo "No text extracted. Please check the PDF file.";
}

// Exit to prevent further code execution
exit;
?>
