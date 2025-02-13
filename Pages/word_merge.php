<?php
require_once 'plugins/phpword_vendor/vendor/autoload.php';


// use PhpOffice\PhpWord\IOFactory;
// use PhpOffice\PhpWord\PhpWord;

// Paths to the two DOCX files you want to merge
$file1 = 'uploads/Template.docx';
$file2 = 'uploads/CON-2025-0000002_Annexure_Document_1738149158.docx';
$mergedFile = 'uploads/merged_document.docx';


// Load the first DOCX file
$phpWord1 = PhpOffice\PhpWord\IOFactory::load($file1, 'Word2007');

// Load the second DOCX file
$phpWord2 = PhpOffice\PhpWord\IOFactory::load($file2, 'Word2007');

// Create a new PhpWord object for the merged document
$phpWordMerged = new PhpOffice\PhpWord\PhpWord();

// Function to copy sections from one PhpWord document to another
function copySections($sourcePhpWord, $targetPhpWord) {
    foreach ($sourcePhpWord->getSections() as $section) {
        // Add a new section to the target PhpWord document
        $newSection = $targetPhpWord->addSection();

        // Copy each element from the source section to the new section
        foreach ($section->getElements() as $element) {
            // Add the same element to the new section
            if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                $newSection->addText($element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
            } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                $newTextRun = $newSection->addTextRun($element->getParagraphStyle());
                foreach ($element->getElements() as $textElement) {
                    if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                        $newTextRun->addText($textElement->getText(), $textElement->getFontStyle());
                    }
                }
            } elseif ($element instanceof \PhpOffice\PhpWord\Element\ListItem) {
                $newSection->addListItem(
                    $element->getText(),
                    $element->getLevel(),
                    $element->getFontStyle(),
                    $element->getParagraphStyle()
                );
            } elseif ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                $newSection->addTable($element->getTableStyle());
                // You may need to copy table rows and cells as well, depending on the complexity of the table
            }
            // Add more conditions if you need to copy other types of elements
        }
    }
}

// Copy sections from the first document
copySections($phpWord1, $phpWordMerged);

// Optionally, add a page break before merging the second document
$phpWordMerged->addSection()->addPageBreak();

// Copy sections from the second document
copySections($phpWord2, $phpWordMerged);

// Save the merged document to the specified file path
$writer = PhpOffice\PhpWord\IOFactory::createWriter($phpWordMerged, 'Word2007');
$writer->save($mergedFile);

// Output the result
echo "Documents merged successfully! The merged file is: $mergedFile";
