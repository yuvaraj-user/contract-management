<?php
require '../../auto_load.php';  
require 'Common_Functions.php';  

require_once 'plugins/phpword_vendor/vendor/autoload.php';
require_once ('plugins/PDFMerger/PDFMerger.php');

use PDFMerger\PDFMerger;


use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;


function convert_word_to_pdf($file_path,$output_path)
{
	$status = false;

	$inputFile = __DIR__ . '/'.$file_path;  
	$outputDir = __DIR__ . '/'.$output_path;       

	$libreOfficePath = '"C:\Program Files\LibreOffice\program\soffice.exe"';

	exec("$libreOfficePath --headless --convert-to pdf --outdir \"$outputDir\" \"$inputFile\"", $output, $return_var);

	// Check if the conversion was successful
	if ($return_var === 0) {
		$status = true;
	    // echo "Success: The file has been converted to PDF.";
	} else {
		$status = false;
	    // echo "Error: Conversion failed with exit code $return_var.";
	}

	return $status;
}

function pdf_merge($file_array,$output_path)
{
	// echo "<pre>";print_r($file_array);exit;
	$status = false;
	$pdf = new PDFMerger;

	foreach ($file_array as $key => $fil_path) {
		if(file_exists($fil_path)) {
			$pdf->addPDF($fil_path);
		}
	}

	$merge_result = $pdf->merge('file',__DIR__.'/'.$output_path);
 	
 	if($merge_result) {
		$status = true;
 	} 

 	return $status;
}

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

	// word convert to pdf
	$pdf_conversion = convert_word_to_pdf($output_file_path,'uploads/contract_generated_docs/');


	if($pdf_conversion) {
		// uploaded document data write in existing template file 
		$contract_docs_path = "uploads/contract_registration/".$structured_contract_id;

		$docs_arr = array();
		$docs_arr[] = 'uploads/contract_generated_docs/'.$structured_contract_id.'_filled_document.pdf';
		if($contract_data['Schedule1_Doc'] != '') {
			$docs_arr[] = $contract_docs_path.'/'.$contract_data['Schedule1_Doc'];
		}

		if($contract_data['Schedule2_Doc'] != '') {
			$docs_arr[] = $contract_docs_path.'/'.$contract_data['Schedule2_Doc'];
		}

		if($contract_data['Schedule3_Doc'] != '') {
			$docs_arr[] = $contract_docs_path.'/'.$contract_data['Schedule3_Doc'];
		}

		if($contract_data['Annexure_Doc'] != '') {
			$docs_arr[] = $contract_docs_path.'/'.$contract_data['Annexure_Doc'];
		}

		$final_pdf_path = 'uploads/contract_generated_docs/'.$structured_contract_id."_filled_document.pdf";

		$pdf_merging = pdf_merge($docs_arr,$final_pdf_path);

		if($pdf_merging) {
			$response['status']  = 200;
			$response['message'] = "Contract template generated successfully.";
		} else {
			$response['status']  = 500;
			$response['message'] = "PDF Merging Error.";	
		}

	} else {
		$response['status']  = 500;
		$response['message'] = "PDF Conversion Error.";
	}

} catch (Exception $e) {
    // Handle the exception (if something goes wrong)
    // echo "Error saving document: " . $e->getMessage();
    $response['status']  = 500;
	$response['message'] = $e->getMessage();
}

echo json_encode($response);exit;


?>
