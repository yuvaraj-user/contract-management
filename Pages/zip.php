<?php 
require_once 'plugins/phpword_vendor/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

$phpWord = new PhpWord();

// // Define the font style for Calibri and size 12
// $fontStyle = new Font();
// $fontStyle->setName('Calibri');  // Set the font to Calibri
// $fontStyle->setSize(12);       // Set the font size to 12

// Load the first document
$doc1 = IOFactory::load('uploads/Template.docx');

// Load the second document
$doc2 = IOFactory::load('uploads/ANNEXURE A.docx');

// Function to copy elements from one document's section to another
function copySectionElements($sourceSection, $targetSection) {
    foreach ($sourceSection->getElements() as $element) {
        // Handle TextRun elements (Text chunks with specific style)
        if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            $newTextRun = $targetSection->addTextRun();
            foreach ($element->getElements() as $textElement) {
                // Only handle Text element inside TextRun
                if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                    $newTextRun->addText($textElement->getText(), $textElement->getFontStyle(), $textElement->getParagraphStyle());
                }
            }
        }
        // Handle Text elements (standalone text)
        elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
            $targetSection->addText($element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
        }
        // Handle Table elements
        elseif ($element instanceof \PhpOffice\PhpWord\Element\Table) {
            $newTable = $targetSection->addTable($element->getStyle());
            foreach ($element->getRows() as $row) {
                $newTableRow = $newTable->addRow();
                foreach ($row->getCells() as $cell) {
                    $newTableRow->addCell($cell->getWidth(), $cell->getStyle())->addText($cell->getText());
                }
            }
        }
        // Handle Image elements
        elseif ($element instanceof \PhpOffice\PhpWord\Element\Image) {
            $targetSection->addImage($element->getSource(), $element->getStyle());
        }
        // Handle TextBreak (line break) - No need to call getText() or any other method
        elseif ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
            $targetSection->addTextBreak(); // Simply add a line break without any text
        }

       // Handle ListItems (Bullet or Numbered List)
        elseif ($element instanceof \PhpOffice\PhpWord\Element\ListItem) {
            // Handle bullet or numbered list
            $targetSection->addListItem(
                $element->getText(), 
                $element->getLevel(), 
                $element->getStyle()
            );
        }
        // Other elements can be handled similarly, add more conditions if necessary
    }
}

// Add all sections from the first document
foreach ($doc1->getSections() as $section) {
    $newSection = $phpWord->addSection(); // Create a new section in the merged document
    copySectionElements($section, $newSection); // Copy elements from doc1 to the new section
}

// Add all sections from the second document
foreach ($doc2->getSections() as $section) {
    $newSection = $phpWord->addSection(); // Create a new section in the merged document
    copySectionElements($section, $newSection); // Copy elements from doc2 to the new section
}

// Save the merged document
$phpWord->save('uploads/merged_document.docx');
?>
