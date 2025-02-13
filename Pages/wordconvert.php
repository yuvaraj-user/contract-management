<?php

// Path to the Word document
$wordFilePath = 'uploads/Template.docx';
$pdfOutputPath = 'uploads/Convert_Template.pdf';

// Command to convert DOCX to PDF using LibreOffice in headless mode
$command = "libreoffice --headless --convert-to pdf --outdir " . dirname($pdfOutputPath) . " " . $wordFilePath;

// Execute the command
$output = shell_exec($command);

if ($output === null) {
    echo "Conversion successful. The PDF is located at: " . $pdfOutputPath;
} else {
    echo "An error occurred: " . $output;
}

?>
