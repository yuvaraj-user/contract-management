<?php
include '../../auto_load.php';
include 'Vendor_Registration_Details.php';
include 'Vendor_L1_Approval_Details.php';

include 'Contract_Registration_Details.php';
include 'Contract_L1_Approval_Details.php';

$Vendor_Registration = new Vendor_Registration_Details($conn);
$Vendor_L1_Approval = new Vendor_L1_Approval_Details($conn);

$Contract_Registration = new Contract_Registration_Details($conn);
$Contract_L1_Approval = new Contract_L1_Approval_Details($conn);


// echo "<pre>";print_r($_FILES);exit;
function Filter_Post_Data($data) 
{
	$data = array_map(function($value) {
 		if(is_array($value)){
 				$mArr = array_map(function($value1) { 
 					return str_replace("'"," ", $value1); 
 				},$value);
 				return $mArr;
 		}else{
 			return str_replace("'"," ", $value); 
 		}
	 }, $data);

	return $data;
}

// filter input data for special characters
$Request = Filter_Post_Data($_POST); 


if($Request['Action'] == 'Vendor_Register_Save') {
	$Vendor_Register_Save = $Vendor_Registration->Vendor_Register_Save($Request);
	echo json_encode($Vendor_Register_Save);exit;
}

elseif($Request['Action'] == 'Vendor_Registeration_List') {
	$Vendor_Registeration_List = $Vendor_Registration->Vendor_Registeration_List($Request);
	echo json_encode($Vendor_Registeration_List);exit;
}

elseif($Request['Action'] == 'Vendor_Registeration_delete') {
	$Vendor_Registeration_delete = $Vendor_Registration->Vendor_Registeration_delete($Request);
	echo json_encode($Vendor_Registeration_delete);exit;
}

elseif($Request['Action'] == 'Vendor_L1_Approval_List') {
	$Vendor_L1_Approval_List = $Vendor_L1_Approval->Vendor_L1_Approval_List($Request);
	echo json_encode($Vendor_L1_Approval_List);exit;
}

elseif($Request['Action'] == 'Vendor_L1_Status_Update') {
	$Vendor_L1_Status_Update = $Vendor_L1_Approval->Vendor_L1_Status_Update($Request);
	echo json_encode($Vendor_L1_Status_Update);exit;
}

elseif($Request['Action'] == 'Contract_Register_Save') {
	$Contract_Register_Save = $Contract_Registration->Contract_Register_Save($Request);
	echo json_encode($Contract_Register_Save);exit;
}

elseif($Request['Action'] == 'Contract_Registeration_List') {
	$Contract_Registeration_List = $Contract_Registration->Contract_Registeration_List($Request);
	echo json_encode($Contract_Registeration_List);exit;
}

elseif($Request['Action'] == 'Contract_Registeration_delete') {
	$Contract_Registeration_delete = $Contract_Registration->Contract_Registeration_delete($Request);
	echo json_encode($Contract_Registeration_delete);exit;
}

elseif($Request['Action'] == 'Get_contract_basic_details') {
	$Get_contract_basic_details = $Contract_Registration->Get_contract_basic_details($Request);
	echo json_encode($Get_contract_basic_details);exit;
}

elseif($Request['Action'] == 'get_approved_vendors') {
	$get_approved_vendors = $Contract_Registration->get_approved_vendors($Request);
	echo json_encode($get_approved_vendors);exit;
}

elseif($Request['Action'] == 'get_representors') {
	$get_representors = $Contract_Registration->get_representors($Request);
	echo json_encode($get_representors);exit;
}

elseif($Request['Action'] == 'get_company_details') {
	$get_company_details = $Contract_Registration->get_company_details($Request);
	echo json_encode($get_company_details);exit;
}





// elseif($Request['Action'] == 'Contract_L1_Approval_List') {
// 	$Contract_L1_Approval_List = $Contract_L1_Approval->Contract_L1_Approval_List($Request);
// 	echo json_encode($Contract_L1_Approval_List);exit;
// }

// elseif($Request['Action'] == 'Contract_L1_Status_Update') {
// 	$Contract_L1_Status_Update = $Contract_L1_Approval->Contract_L1_Status_Update($Request);
// 	echo json_encode($Contract_L1_Status_Update);exit;
// }



