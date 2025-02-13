<?php
	// // // Paths to the DOCX files you want to merge (dynamically set these)
	$file1 = 'uploads/Template.docx';
	$file2 = 'uploads/Schedule2.docx';

	// Path to your Node.js script
	$nodeScriptPath = 'docsmerger.js';

	// Execute the Node.js script with the file paths as arguments
	$output = exec("node $nodeScriptPath $file1 $file2");

	// Optionally, output the result for debugging purposes
	echo $output;exit;

require_once 'plugins/phpword_vendor/vendor/autoload.php';



$uploadedFilePath = 'uploads/Template.docx'; // Path to the uploaded file
$existingFilePath = 'uploads/empty.docx';  // Path to the existing Word file

// Load PhpWord object
$phpWord = PhpOffice\PhpWord\IOFactory::load($uploadedFilePath, 'Word2007');

// Ensure that TCPDF is used for PDF rendering
$pdfLibraryPath = __DIR__ . '/plugins/TCPDF'; // Adjust this path to where TCPDF is installed
PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');
PhpOffice\PhpWord\Settings::setPdfRendererPath($pdfLibraryPath);

// Create a PDF Writer and save as PDF
$pdfWriter = PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
$pdfOutputPath = 'uploads/processed.pdf';
$pdfWriter->save($pdfOutputPath);

echo "PDF saved to: " . $pdfOutputPath;exit;
// echo "<pre>";print_r($htmlWriter);exit;
// // Iterate through sections and extract text
// foreach ($phpWord->getSections() as $section) {
//     foreach ($section->getElements() as $element) {
//        if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
//             $content .= $element->getText() . "\n"; // Append text
//         } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
//             foreach ($element->getElements() as $textElement) {
//                 if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
//                     $content .= $textElement->getText() . "\n"; // Extract text from TextRun
//                 }
//             }
//         } else {
//             // var_dump($element); // Show other types of elements for debugging
//         }
//     }
// }

// // echo "<pre>";print_r($content);exit;

// // Load the existing Word file
// $phpWordExisting = PhpOffice\PhpWord\IOFactory::load($existingFilePath, 'Word2007'); // Load the existing Word file

// // Get the last section (you can append content to the last section)
// // $sections = $phpWordExisting->getSections();
// // $lastSection = end($sections); // Get the last section

// $section = $phpWordExisting->addSection();

// // Add a page break
// // $section->addPageBreak();
// // Add the extracted content from 'annexure.docx' to the last section
// $section->addText($content);

// // Save the modified Word document
// $writer = PhpOffice\PhpWord\IOFactory::createWriter($phpWordExisting, 'Word2007'); // Create writer to save
// $writer->save('modified_document.docx'); // Save the modified file



// $file2 = 'uploads/CON-2025-0000002_Annexure_Document_1738149158.docx';

// $a = file_get_contents($file1);
// file_put_contents("uploads/Doc1.docx", $a);
// $b = file_get_contents($file2); 
// file_put_contents("uploads/Doc1.docx", $b);
// exit;

// // Paths to the DOCX files you want to merge (dynamically set these)
// $file1 = 'uploads/Template.docx';
// $file2 = 'uploads/Schedule2.docx';

// // Path to your Node.js script
// $nodeScriptPath = 'docsmerger.js';

// // Execute the Node.js script with the file paths as arguments
// $output = [];
// $exitCode = null;
// exec("node $nodeScriptPath $file1 $file2", $output, $exitCode);

// // Output the result for debugging purposes
// echo implode("\n", $output);
// exit;
$nodeScriptPath = 'docsmerger.js';

// Execute the Node.js script with the file paths as arguments
$output = [];
$exitCode = null;
exec("node $nodeScriptPath", $output, $exitCode);

// Output the result for debugging purposes
echo implode("\n", $output);
exit;


$file1 = 'uploads/Template.docx';
$file2 = 'uploads/Template.docx';


$handle2 = fopen($file1, "r");
$contents = fread($handle2, filesize($file1)); 
fclose($handle2);

$fp = fopen("uploads/Doc1.docx", 'w'); 
fwrite($fp, $contents); 
fclose($fp);

$handle3 = fopen($file2, "r");
$contents2 = fread($handle3, filesize($file2)); 
fclose($handle3);


$fp = fopen("uploads/Doc1.docx", 'a'); 
fwrite($fp, $contents2); 
fclose($fp);


echo "appened";exit;

// $fp = fopen("uploads/empty.txt", 'a'); 
// fwrite($fp, $contents); 
// fwrite($fp, $contents2); 


// $handle4 = fopen('uploads/empty.txt', "r");
// $full_contents = fread($handle4, filesize('uploads/empty.txt')); 

$fp = fopen("uploads/Doc1.docx", 'w'); 
fwrite($fp, $full_contents); 

?>

 