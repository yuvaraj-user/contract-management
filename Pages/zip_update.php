<?php 
require_once 'plugins/phpword_vendor/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;

// Create a new PhpWord object for the merged document
$phpWord = new PhpWord();

// Function to copy elements from one document's section to another
function copySectionElements($sourceSection, $targetSection) {
    foreach ($sourceSection->getElements() as $element) {
        copyElementToSection($element, $targetSection);
    }
}

// Function to copy individual elements (Text, Image, Table, etc.) to a section
function copyElementToSection($element, $targetSection) {
    // Ensure the section is valid before adding elements
    if (!$targetSection) {
        throw new Exception("Target section is not initialized properly.");
    }

    // Handle Text elements (standalone text)
    if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
        // Copy text with the exact font style and paragraph style
        $targetSection->addText(
            $element->getText(), 
            $element->getFontStyle(),  // Preserve the font style from the source element
            $element->getParagraphStyle()  // Preserve the paragraph alignment and other styles
        );
    }

    // Handle TextRun elements (Text chunks with specific style)
    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
        $newTextRun = $targetSection->addTextRun();
        foreach ($element->getElements() as $textElement) {
            // Only handle Text element inside TextRun
            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                $newTextRun->addText(
                    $textElement->getText(), 
                    $textElement->getFontStyle(),  // Preserve the font style
                    $textElement->getParagraphStyle()  // Preserve the paragraph style
                );
            }
        }
    }

    // Handle Table elements
    elseif ($element instanceof \PhpOffice\PhpWord\Element\Table) {
        $newTable = $targetSection->addTable($element->getStyle());
        foreach ($element->getRows() as $row) {
            $newTableRow = $newTable->addRow();
            foreach ($row->getCells() as $cell) {
                // Handle text inside table cells, preserving font and paragraph styles
                $newTableRow->addCell($cell->getWidth(), $cell->getStyle())->addText(
                    $cell->getText(),
                    $cell->getFontStyle(),  // Preserve the font style inside cells
                    $cell->getParagraphStyle()  // Preserve the paragraph alignment inside cells
                );
            }
        }
    }

    // Handle Image elements
    elseif ($element instanceof \PhpOffice\PhpWord\Element\Image) {
        $targetSection->addImage($element->getSource(), $element->getStyle());
    }

    // Handle TextBreak (line break)
    elseif ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
        $targetSection->addTextBreak(); // Simply add a line break without any text
    }

    // Handle ListItems (Bullet or Numbered List)
    elseif ($element instanceof \PhpOffice\PhpWord\Element\ListItem) {
        $targetSection->addListItem(
            $element->getText(),
            $element->getLevel(),
            $element->getStyle()
        );
    }
}

// Load the first document
$doc1 = IOFactory::load('uploads/Template.docx');

// Load the second document
$doc2 = IOFactory::load('uploads/Schedule1.docx');

// Merge the documents
foreach ([$doc1, $doc2] as $doc) {
    foreach ($doc->getSections() as $section) {
        // Create a new section for the merged document
        $newSection = $phpWord->addSection();

        // Ensure the section is valid
        if (!$newSection) {
            throw new Exception("Failed to initialize the target section.");
        }

        // Copy the elements of the current section
        copySectionElements($section, $newSection);
    }
}

// Save the merged document
$phpWord->save('uploads/merged_document.docx');
?>
