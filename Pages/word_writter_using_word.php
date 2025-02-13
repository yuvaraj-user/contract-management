<?php
require '../../auto_load.php';  
require 'Common_Functions.php';  

// require_once 'plugins/PhpWord/TemplateProcessor.php'; 
// require_once 'plugins/PhpWord/Settings.php';  
// require_once 'plugins/PhpWord/Shared/ZipArchive.php';
// require_once 'plugins/PhpWord/Element/AbstractElement.php';
// require_once 'plugins/PhpWord/Element/Text.php';
// require_once 'plugins/PhpWord/Style/AbstractStyle.php';
// require_once 'plugins/PhpWord/Style/Shading.php';
// require_once 'plugins/PhpWord/Style/Font.php';
// require_once 'plugins/PhpWord/Style/Border.php';
// require_once 'plugins/PhpWord/Style/Cell.php';
require_once 'plugins/phpword_vendor/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;

try {
	$template_path = 'uploads/templates/Template - Vendor - C&F.docx';

	$contract_id = $_POST['con_id'];

	$structured_contract_id =  str_replace('/', '-',$contract_id);

	$output_file_path = 'uploads/contract_generated_docs/'.$structured_contract_id."_filled_document.docx";

	// Now you can use TemplateProcessor
	$templateProcessor = new PhpOffice\PhpWord\TemplateProcessor($template_path); // Path to your Word template file


	$contract_data = get_contract_data($conn,$contract_id);
	// echo "<pre>";print_r($contract_data);exit;
	$contract_created_date = $contract_data['Contract_Date']; 
	$vendor_name = $contract_data['Vendor_Name']; 
	$vendor_gst = $contract_data['GST_No']; 
	$vendor_pan = $contract_data['Pan_No']; 
	$vendor_aadhar = $contract_data['Aadhar_No'];
	$Contract_Period_From_Date =  $contract_data['Contract_Period_From_Date'];
	$Contract_Period_To_Date   =  $contract_data['Contract_Period_To_Date'];


	$contract_creation_date = date("dS F Y",strtotime($contract_created_date));
	$vendor_name_with_gstpan = $vendor_name.', GSTN'.$vendor_gst.' PAN '.$vendor_pan; 
	$vendor_address1 = htmlspecialchars($contract_data['Address'], ENT_QUOTES, 'UTF-8');
	$vendor_address2 = htmlspecialchars($contract_data['Owner_Address'], ENT_QUOTES, 'UTF-8');
	$vendor_aadharpan = 'AADHAR No '.$vendor_aadhar.' PAN No '.$vendor_pan;	
	$contract_period1 = $Contract_Period_From_Date.' to '.$Contract_Period_To_Date;
	$contract_period2 = date('d.m.Y',strtotime($Contract_Period_From_Date)).' to '.date('d.m.Y',strtotime($Contract_Period_To_Date));
	$contract_security_deposit_amount = formatIndianCurrency($contract_data['Contract_Security_Deposit_Amount']);

	$company_name = $contract_data['Company_Name']; 
	$company_address = htmlspecialchars($contract_data['Company_Address'], ENT_QUOTES, 'UTF-8'); 
	$company_representor_name = $contract_data['Company_Representor_Empcode'];
	$company_representor_designation = htmlspecialchars($contract_data['Company_Representor_Designation'], ENT_QUOTES, 'UTF-8');
	// echo $company_representor_designation;exit;
	$company_pan = $contract_data['Company_Pan_No']; 
	$company_cin = $contract_data['Company_CIN_No']; 
	$company_gst = $contract_data['Company_CIN_No']; 
	$vendor_partner_name = $contract_data['Partner_Name'];
	$vendor_father_name = $contract_data['Father_Name'];
	$company_location = $contract_data['Company_Location'];


	// Replace placeholder with actual data
	$templateProcessor->setValue('contract_creation_date', $contract_creation_date); 

	$templateProcessor->setValue('vendor_name_with_gstpan', $vendor_name_with_gstpan);

	$templateProcessor->setValue('vendor_address1', $vendor_address1);

	$templateProcessor->setValue('vendor_aadharpan', $vendor_aadharpan);

	$templateProcessor->setValue('vendor_address2', $vendor_address2);

	$templateProcessor->setValue('contract_creation_date2', $contract_creation_date); 

	$templateProcessor->setValue('contract_creation_date3', $contract_creation_date); 

	$templateProcessor->setValue('contract_period1', $contract_period1); 
	
	$templateProcessor->setValue('contract_period2', $contract_period2); 
	
	$templateProcessor->setValue('contract_security_deposit_amount', $contract_security_deposit_amount); 

	$templateProcessor->setValue('vendor_name', $vendor_name);
	
	$templateProcessor->setValue('company_name', $company_name); 
	$templateProcessor->setValue('company_cin', $company_cin); 
	$templateProcessor->setValue('company_pan', $company_pan); 
	$templateProcessor->setValue('company_gst', $company_gst); 
	
	$templateProcessor->setValue('company_address', $company_address);


	$templateProcessor->setValue('company_representor_name', $company_representor_name); 
	$templateProcessor->setValue('company_representor_designation', $company_representor_designation); 

	$templateProcessor->setValue('vendor_partner_name', $vendor_partner_name); 
	$templateProcessor->setValue('vendor_father_name', $vendor_father_name); 
	$templateProcessor->setValue('company_location', $company_location); 


	// Save the modified document
	$templateProcessor->saveAs($output_file_path);



	// uploaded document data write in existing template file 
	$contract_docs_path = "uploads/contract_registration/".$structured_contract_id;

	$docs_arr = array();
	$docs_arr[] = $contract_data['Schedule1_Doc'];
	$docs_arr[] = $contract_data['Schedule2_Doc'];
	$docs_arr[] = $contract_data['Schedule3_Doc'];
	$docs_arr[] = $contract_data['Annexure_Doc'];
	array_filter($docs_arr);


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

	$docs_loader = array();

	// Load the template document
	$doc = IOFactory::load($output_file_path);
	$docs_loader[] = $doc;

	// load attachment documents 
	foreach ($docs_arr as $key => $value) {
		if($value != '') {
			$file_path = $contract_docs_path.'/'.$value;
			$doc = IOFactory::load($file_path);
			array_push($docs_loader,$doc);
		}
	}


	// echo "<pre>";print_r($docs_loader);exit;
	// Merge the documents
	foreach ($docs_loader as $doc) {
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
	// $phpWord->save($output_file_path);


	// node js script call
	// // // Paths to the DOCX files you want to merge (dynamically set these)
	// $file1 = 'uploads/Template.docx';
	// $file2 = 'uploads/Schedule2.docx';

	// // Path to your Node.js script
	// $nodeScriptPath = 'docsmerger.js';

	// // Execute the Node.js script with the file paths as arguments
	// $output = exec("node $nodeScriptPath $file1 $file2");

	// // Optionally, output the result for debugging purposes
	// echo $output;exit;

	$response['status']  = 200;
	$response['message'] = "Contract template generated successfully.";
} catch (Exception $e) {
    // Handle the exception (if something goes wrong)
    // echo "Error saving document: " . $e->getMessage();
    $response['status']  = 500;
	$response['message'] = $e->getMessage();
}

echo json_encode($response);exit;


?>
