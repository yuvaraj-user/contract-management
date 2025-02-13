<?php
function Generate_Contract_No($conn)
{
	// CON/2025/0000001

	$Con_Number_Prefix = "CON/".date('Y');

	$sql = "SELECT TOP 1 * FROM Contract_Portal_Contract_Registration ORDER BY Id DESC";

	$sql_exec = sqlsrv_query($conn,$sql, array(), array("Scrollable" => 'static'));
    $contract_registration_count = sqlsrv_num_rows($sql_exec); 

    if($contract_registration_count > 0) {
		$last_con_id = sqlsrv_fetch_array($sql_exec)['CON_ID'];

		if($last_con_id != '') {
			$number_series_section = end(explode('/',$last_con_id));
			$incremented_id = substr($number_series_section,6) + 1;
    		$Con_Number = $Con_Number_Prefix.'/000000'.$incremented_id;
		}
    } else {
    	$Con_Number = $Con_Number_Prefix.'/0000001';
    }  

    return $Con_Number;
	  
}

function Generate_Registeration_No($conn)
{
	// REG/2025/0000001

	$Con_Number_Prefix = "REG/".date('Y');

	$sql = "SELECT TOP 1 * FROM Contract_Portal_Vendor_Registration ORDER BY Id DESC";

	$sql_exec = sqlsrv_query($conn,$sql, array(), array("Scrollable" => 'static'));
    $contract_registration_count = sqlsrv_num_rows($sql_exec); 

    if($contract_registration_count > 0) {
		$last_con_id = sqlsrv_fetch_array($sql_exec)['REG_ID'];

		if($last_con_id != '') {
			$number_series_section = end(explode('/',$last_con_id));
			$incremented_id = substr($number_series_section,6) + 1;
    		$Con_Number = $Con_Number_Prefix.'/000000'.$incremented_id;
		}
    } else {
    	$Con_Number = $Con_Number_Prefix.'/0000001';
    }  

    return $Con_Number;
	  
}


function Check_L1_Manager($conn,$emp_id)
{
	$Is_L1_Manager = false;

	$Qry     = "SELECT * FROM HR_Master_Table WHERE L1_Manager_Code = '".$emp_id."' AND Employment_Status = 'Active'";
	$QryExec = sqlsrv_query($conn, $Qry, array(), array("Scrollable" => 'static'));
    $row_count = sqlsrv_num_rows($QryExec); 
    if($row_count > 0) {
		$Is_L1_Manager = true;
    }

	return $Is_L1_Manager;
}

function get_contract_data($conn,$contract_id)
{
	$Is_L1_Manager = false;

	$Qry     = "SELECT Contract_Portal_Contract_Registration.*,Contract_Portal_Vendor_Registration.Vendor_Name,Contract_Portal_Vendor_Registration.Email,Contract_Portal_Vendor_Registration.Vendor_Type,
		Contract_Portal_Vendor_Registration.Mobile_No,Contract_Portal_Vendor_Registration.Pan_No,Contract_Portal_Vendor_Registration.CIN_No,Contract_Portal_Vendor_Registration.Father_Name,
		Contract_Portal_Vendor_Registration.Aadhar_No,Contract_Portal_Vendor_Registration.Address,Contract_Portal_Vendor_Registration.Owner_Address,Contract_Portal_Vendor_Registration.Partner_Name,
		FORMAT(Contract_Portal_Contract_Registration.Contract_Period_From,'dd-MM-yyyy') as Contract_Period_From_Date
		,FORMAT(Contract_Portal_Contract_Registration.Contract_Period_To,'dd-MM-yyyy') as Contract_Period_To_Date,
		FORMAT(Contract_Portal_Contract_Registration.Contract_Date,'dd-MM-yyyy') as Contract_Date
		FROM Contract_Portal_Contract_Registration
		LEFT JOIN Contract_Portal_Vendor_Registration on Contract_Portal_Vendor_Registration.REG_ID = Contract_Portal_Contract_Registration.VENDOR_REG_ID where CON_ID = '".$contract_id."'";
	$QryExec = sqlsrv_query($conn, $Qry);
	$Qryres  = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC);

	return $Qryres;
}

function get_hr_master_tbl_details($conn,$emp_id)
{
	$Qry     = "SELECT * FROM HR_Master_Table WHERE Employee_Code = '".$emp_id."' AND Employment_Status = 'Active'";
	$QryExec = sqlsrv_query($conn, $Qry, array(), array("Scrollable" => 'static'));
	$Qryres  = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC);

	return $Qryres;
}

function daterange_date_split($daterange_date)
{
	$splited_date = array_map('trim',explode('to',$daterange_date));

	return $splited_date;
}

function formatIndianCurrency($num) {
    // Check if the number is negative and handle both cases: minus at the end or at the front
    $isNegative = false;
    // Case 1: Minus at the end (e.g., '5036852.54-')
    if (substr($num, -1) === '-') {
        $isNegative = true;
        $num = substr($num, 0, -1); // Remove the minus sign from the end
    }
    // Case 2: Minus at the front (e.g., '-5036852.54')
    elseif ($num[0] === '-') {
        $isNegative = true;
        $num = substr($num, 1); // Remove the minus sign from the front
    }

    // Round the number to two decimal places
    $num = round($num, 2);

    // Split the number into integer and decimal parts
    $num_parts = explode('.', $num); // Split into integer and decimal parts

    $integer_part = $num_parts[0];
    $decimal_part = isset($num_parts[1]) ? '.' . $num_parts[1] : '.00';

    // Convert integer part to string
    $integer_part_str = (string) $integer_part;

    // Separate the last three digits
    $lastThree = substr($integer_part_str, -3);

    // Remaining digits
    $otherNumbers = substr($integer_part_str, 0, -3);

    // Insert commas every two digits in the remaining numbers
    if (!empty($otherNumbers)) {
        $otherNumbers = implode(',', str_split(strrev($otherNumbers), 2));
        $otherNumbers = strrev($otherNumbers);
    }

    // Combine with the last three digits and add the decimal part
    if ($otherNumbers) {
        $formatted_num = $otherNumbers . ',' . $lastThree . $decimal_part;
    } else {
        $formatted_num = $lastThree . $decimal_part;
    }

    // If the number was negative, add the minus sign at the front
    if ($isNegative) {
        // $formatted_num = '-' . $formatted_num;
        $formatted_num = $formatted_num;
    }

    return $formatted_num;
}


?>