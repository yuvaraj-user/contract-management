<?php
require_once 'plugins/PhpWord/Exception/Exception.php';
require_once 'plugins/PhpWord/IOFactory.php';
require_once 'plugins/PhpWord/PhpWord.php';



    $uploadedFilePath = 'uploads/SCHEDULE3.docx';
$existingFilePath = 'uploads/empty.docx'; // Path to your existing Word file

// Read the content from the uploaded Word file
$phpWord = PhpOffice\PhpWord\IOFactory::load($uploadedFilePath, 'Word2007'); // Load the Word file (No need to specify 'Word2007')
$content = '';

// Iterate through sections and extract text
foreach ($phpWord->getSections() as $section) {
    foreach ($section->getElements() as $element) {
        if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
            $content .= $element->getText() . "\n"; // Append text
        }
    }
}

// Write the content to the existing Word file
$phpWord = PhpOffice\PhpWord\IOFactory::load($existingFilePath); // Load the existing Word file

// Get the first section (you can append content to any section)
$section = $phpWord->getSections()[0];

// Add the new content to the section
$section->addText($content);

// Save the modified Word document
$writer = IOFactory::createWriter($phpWord, 'Word2007'); // Use Word2007 Writer for saving
$writer->save('modified_document.docx');

// $filename = "uploads/Schedule1.docx"; 
// $handle   = fopen($filename, "r");
// $contents = fread($handle, filesize($filename)); 
// fclose($handle);

// $contents3 =$contents;

// $fp = fopen("uploads/empty.docx", 'ab'); 

// fwrite($fp, $contents3);
// fclose($fp);
// echo $contents;exit;

?>