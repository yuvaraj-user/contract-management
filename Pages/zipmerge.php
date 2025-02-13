<?php
require_once 'plugins/phpword_vendor/vendor/autoload.php';

function mergeDocuments($doc1Path, $doc2Path, $outputPath) {
    // Load both documents
    $phpWord1 = PhpOffice\PhpWord\IOFactory::load($doc1Path);
    $phpWord2 = PhpOffice\PhpWord\IOFactory::load($doc2Path);

    // Create a new PhpWord instance for the merged document
    $phpWordMerged = new PhpOffice\PhpWord\PhpWord();

    // Function to copy all sections and elements from one document to another
    function copySections($sourcePhpWord, $targetPhpWord) {
        foreach ($sourcePhpWord->getSections() as $sourceSection) {
            // Create a new section in the target document
            $targetSection = $targetPhpWord->addSection();

            // Copy each element from the source section
            foreach ($sourceSection->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    // Add text with the same content and style
                    $targetSection->addText($element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
                } 
                elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    // Add TextRun content (handles inline text with different styles)
                    $targetTextRun = $targetSection->addTextRun($element->getParagraphStyle());
                    foreach ($element->getElements() as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $targetTextRun->addText($textElement->getText(), $textElement->getFontStyle());
                        }
                    }
                }
                elseif ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    // Add tables (ensure to copy the table rows and cells properly)
                    $targetTable = $targetSection->addTable($element->getStyle());
                    foreach ($element->getRows() as $row) {
                        $targetRow = $targetTable->addRow();
                        foreach ($row->getCells() as $cell) {
                            $targetCell = $targetRow->addCell($cell->getWidth(), $cell->getStyle());
                            foreach ($cell->getElements() as $cellElement) {
                                if ($cellElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                    $targetCell->addText($cellElement->getText(), $cellElement->getFontStyle());
                                }
                            }
                        }
                    }
                }
                // Handle other elements as needed (like images, lists, etc.)
            }
        }
    }

    // Copy content from both documents
    copySections($phpWord1, $phpWordMerged);
    copySections($phpWord2, $phpWordMerged);

    // Save the merged document to a new file
    $objWriter = PhpOffice\PhpWord\IOFactory::createWriter($phpWordMerged, 'Word2007');
    $objWriter->save($outputPath);
}

$doc1 = 'uploads/Schedule1.docx'; // Path to the first document
$doc2 = 'uploads/Schedule2.docx'; // Path to the second document
$output = 'uploads/merged_document.docx'; // Path to save the merged document

mergeDocuments($doc1, $doc2, $output);

echo "Documents merged successfully!";
?>
