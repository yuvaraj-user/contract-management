<?php
/**
 * 
 */
class Contract_Registration_Details
{
	public $conn;
	function __construct($conn)
	{
		$this->conn  = $conn; 
		// include('Common_Functions.php');
	}

	public function Remove_Files($file_path)
	{
		if(file_exists($file_path)) {
			unlink($file_path);
		}
	}

	public function Contract_Registeration_List($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

  		$Emp_Id = $_SESSION['EmpID'];

		$Qry = "SELECT Contract_Portal_Contract_Registration.*,Contract_Portal_Vendor_Registration.Vendor_Name,Contract_Portal_Vendor_Registration.Email,Contract_Portal_Vendor_Registration.Vendor_Type,
		Contract_Portal_Vendor_Registration.Mobile_No,Contract_Portal_Vendor_Registration.Pan_No,Contract_Portal_Vendor_Registration.CIN_No,Contract_Portal_Vendor_Registration.Father_Name,
		Contract_Portal_Vendor_Registration.Aadhar_No,Contract_Portal_Vendor_Registration.Address,Contract_Portal_Vendor_Registration.Owner_Address,
		FORMAT(Contract_Portal_Contract_Registration.Contract_Period_From,'dd-MM-yyyy') as Contract_Period_From_Date
		,FORMAT(Contract_Portal_Contract_Registration.Contract_Period_To,'dd-MM-yyyy') as Contract_Period_To_Date,
		FORMAT(Contract_Portal_Contract_Registration.Contract_Date,'dd-MM-yyyy') as Contract_Date
		FROM Contract_Portal_Contract_Registration
		LEFT JOIN Contract_Portal_Vendor_Registration on Contract_Portal_Vendor_Registration.REG_ID = Contract_Portal_Contract_Registration.VENDOR_REG_ID
		WHERE 1=1 AND Contract_Portal_Contract_Registration.Form_Status != 'Deleted' AND (Contract_Portal_Contract_Registration.Created_By = '".$Emp_Id."'
		OR Contract_Portal_Contract_Registration.Saved_By = '".$Emp_Id."')";			

		if(isset($request['id'])) {
			$Qry .= " AND Contract_Portal_Contract_Registration.Id = '".$request['id']."'";
		}				

		$Qry .= " ORDER BY Contract_Portal_Contract_Registration.Id DESC";

		// echo $Qry;exit;


		$QryExec = sqlsrv_query($this->conn, $Qry, array(), array("Scrollable" => 'static'));
		$qCount  = sqlsrv_num_rows($QryExec);
		
		$resArr = array();
		if($qCount > 0) {
			while($row = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC))
			{
				$resArr[] = $row;
			}
			$response['status']  = 200;
  			$response['message'] = "Contract Registration list fetched successfully.";
		}

		$response['data'] = $resArr;

		return $response;			
	}

	public function Get_L1_Manager_Code($emp_id)
	{	
		$Qry     = "SELECT * FROM HR_Master_Table WHERE Employee_Code = '".$emp_id."' AND Employment_Status = 'Active'";
		$QryExec = sqlsrv_query($this->conn, $Qry);
		$l1_manager_code = sqlsrv_fetch_array($QryExec)['L1_Manager_Code'];
		return $l1_manager_code;
	} 

	public function Contract_Register_Save($request)
	{
		$response['status']  = 422;
		$response['message'] = "Unprocessable Entry.";
		// echo "<pre>";print_r($request);exit;

		if(isset($_SESSION['EmpID']) && $_SESSION['EmpID'] != '') {
			$emp_id = $_SESSION['EmpID'];

			// contract basic details section
			$Contract_Category = (isset($request['contract_category']) && $request['contract_category'] != '') ? $request['contract_category'] : '';

			$Contract_Division = (isset($request['contract_division']) && $request['contract_division'] != '') ? $request['contract_division'] : '';

			$Contract_Type = (isset($request['contract_type']) && $request['contract_type'] != '') ? $request['contract_type'] : '';

			$Contract_Sub_Type1 = (isset($request['contract_sub_type1']) && $request['contract_sub_type1'] != '') ? $request['contract_sub_type1'] : '';

			$Contract_Sub_Type2 = (isset($request['contract_sub_type2']) && $request['contract_sub_type2'] != '') ? $request['contract_sub_type2'] : '';

			
			// company details section 
			$contract_primary_id = (isset($request['contract_id']) && $request['contract_id'] != '') ? $request['contract_id'] : '';

			$CON_ID = (isset($request['CON_ID']) && $request['CON_ID'] != '') ? $request['CON_ID'] : '';
			
			// insertion time generate last CON ID   
			if($contract_primary_id == '') {
				$CON_ID = Generate_Contract_No($this->conn);
			}


			$VENDOR_REG_ID = (isset($request['vendor_registration_id']) && $request['vendor_registration_id'] != '') ? $request['vendor_registration_id'] : '';

			$Company_Name = (isset($request['company_name']) && $request['company_name'] != '') ? $request['company_name'] : '';			

			$Company_Pan_No = (isset($request['company_pan']) && $request['company_pan'] != '') ? $request['company_pan'] : '';
			$Company_Address = (isset($request['company_address']) && $request['company_address'] != '') ? $request['company_address'] : '';
			$Company_CIN_No = (isset($request['company_cin']) && $request['company_cin'] != '') ? $request['company_cin'] : '';

			$Company_GST_No = (isset($request['company_gst']) && $request['company_gst'] != '') ? $request['company_gst'] : '';

			$Company_Location = (isset($request['company_location']) && $request['company_location'] != '') ? $request['company_location'] : '';


			$Company_Representor_Empcode = (isset($request['representor_id']) && $request['representor_id'] != '') ? $request['representor_id'] : '';

			$Company_Representor_Designation = (isset($request['representor_designation']) && $request['representor_designation'] != '') ? $request['representor_designation'] : '';

			$Contract_Date = (isset($request['contract_date']) && $request['contract_date'] != '') ? date('Y-m-d',strtotime($request['contract_date'])) : '';			
			

			$contract_period = (isset($request['contract_period']) && $request['contract_period'] != '') ? daterange_date_split($request['contract_period']) : '';
			$Contract_Period_From = $Contract_Period_To = '';
			if($contract_period != '' && is_array($contract_period)) {
				$Contract_Period_From = date('Y-m-d',strtotime($contract_period[0]));
				$Contract_Period_To   = date('Y-m-d',strtotime($contract_period[1]));  
			}

			$Contract_Security_Deposit_Amount = (isset($request['contract_security_deposit_amt']) && $request['contract_security_deposit_amt'] != '') ?$request['contract_security_deposit_amt'] : 0.00;


			$Schedule1_Doc = '';
			$Schedule2_Doc = '';
			$Schedule3_Doc = '';
			$Annexure_Doc = '';

			$Form_Status = ($request['from'] == 'save') ? 'Saved' : 'Submitted';

			$current_datetime = date('Y-m-d H:i:s');

			$structured_contract_id =  str_replace('/', '-',$CON_ID);

			$folder_path = 'uploads/contract_registration/'.$structured_contract_id;

			// contract file folder exist check otherwise create folder 
			if(!(file_exists($folder_path))) {
				mkdir($folder_path);
			}

			$saved_sql_res = array();

			// contract saved data get for edit functionality
			if($contract_primary_id != '') {
				$saved_sql      = "SELECT * from Contract_Portal_Contract_Registration WHERE Id='".$contract_primary_id."'";
				$saved_sql_exec = sqlsrv_query($this->conn,$saved_sql); 
				$saved_sql_res  =  sqlsrv_fetch_array($saved_sql_exec,SQLSRV_FETCH_ASSOC);
			}

			// schedule1 document file upload
			if($_FILES['Schedule1_Doc']['name'] != '') {
				$file_extension = pathinfo($_FILES['Schedule1_Doc']['name'])['extension'];

				$Schedule1_Doc = $structured_contract_id.'_Schedule1_Document_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$Schedule1_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Schedule1_Doc']; 
					$this->Remove_Files($old_file_path);
				}

				move_uploaded_file($_FILES['Schedule1_Doc']['tmp_name'],$path);
			} else {
				if($request['Schedule1_Doc_file_name'] != '') {
					$Schedule1_Doc = $request['Schedule1_Doc_file_name'];
				}
			}					

			// schedule2 document file upload
			if($_FILES['Schedule2_Doc']['name'] != '') {
				$file_extension = pathinfo($_FILES['Schedule2_Doc']['name'])['extension'];

				$Schedule2_Doc = $structured_contract_id.'_Schedule2_Document_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$Schedule2_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Schedule2_Doc']; 
					$this->Remove_Files($old_file_path);
				}

				move_uploaded_file($_FILES['Schedule2_Doc']['tmp_name'],$path);
			} else {
				if($request['Schedule2_Doc_file_name'] != '') {
					$Schedule2_Doc = $request['Schedule2_Doc_file_name'];
				}
			}

			// schedule3 document file upload
			if($_FILES['Schedule3_Doc']['name'] != '') {
				$file_extension = pathinfo($_FILES['Schedule3_Doc']['name'])['extension'];

				$Schedule3_Doc = $structured_contract_id.'_Schedule3_Document_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$Schedule3_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Schedule3_Doc']; 
					$this->Remove_Files($old_file_path);
				}

				move_uploaded_file($_FILES['Schedule3_Doc']['tmp_name'],$path);
			} else {
				if($request['Schedule3_Doc_file_name'] != '') {
					$Schedule3_Doc = $request['Schedule3_Doc_file_name'];
				}
			}

			// Annexure document file upload
			if($_FILES['Annexure_Doc']['name'] != '') {
				$file_extension = pathinfo($_FILES['Annexure_Doc']['name'])['extension'];

				$Annexure_Doc = $structured_contract_id.'_Annexure_Document_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$Annexure_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Annexure_Doc']; 
					$this->Remove_Files($old_file_path);
				}

				move_uploaded_file($_FILES['Annexure_Doc']['tmp_name'],$path);
			} else {
				if($request['Annexure_Doc_file_name'] != '') {
					$Annexure_Doc = $request['Annexure_Doc_file_name'];
				}
			}


			if($contract_primary_id == '') {
				$recorded_column = 'Saved_At';
				$recorded_by = 'Saved_By';
				if($Form_Status == 'submited') {
					$recorded_column = 'Created_At';
					$recorded_by = 'Created_By';
				}

				$sql = "INSERT INTO Contract_Portal_Contract_Registration(CON_ID,VENDOR_REG_ID,Contract_Category,Contract_Division,Contract_Type,Contract_Sub_Type1,Contract_Sub_Type2,Company_Name,Company_Address,Company_Pan_No,Company_CIN_No,Contract_Period_From,Contract_Period_To,Contract_Security_Deposit_Amount,Company_Representor_Empcode,Company_Representor_Designation,Schedule1_Doc,Schedule2_Doc,Schedule3_Doc,Annexure_Doc,Form_Status,".$recorded_column.",".$recorded_by.",Contract_Date,Company_Location,Company_GST_No) OUTPUT INSERTED.Id as inserted_id VALUES ('".$CON_ID."','".$VENDOR_REG_ID."','".$Contract_Category."','".$Contract_Division."','".$Contract_Type."','".$Contract_Sub_Type1."','".$Contract_Sub_Type2."','".$Company_Name."','".$Company_Address."','".$Company_Pan_No."','".$Company_CIN_No."','".$Contract_Period_From."','".$Contract_Period_To."','".$Contract_Security_Deposit_Amount."','".$Company_Representor_Empcode."','".$Company_Representor_Designation."','".$Schedule1_Doc."','".$Schedule2_Doc."','".$Schedule3_Doc."','".$Annexure_Doc."','".$Form_Status."','".$current_datetime."','".$emp_id."','".$Contract_Date."','".$Company_Location."','".$Company_GST_No."')";				

			} else {
				$recorded_column = 'Saved_At';
				$recorded_by = 'Saved_By';
				if($Form_Status == 'Submitted' && $request['page_type'] == 'Create') {
					$recorded_column = 'Created_At';
					$recorded_by = 'Created_By';					
				} elseif($request['page_type'] == 'Edit' && $saved_sql_res['Form_Status'] == 'Submitted') {
					$recorded_column = 'Updated_At';
					$recorded_by = 'Updated_By';					
				}

				$sql = "UPDATE Contract_Portal_Contract_Registration SET CON_ID = '".$CON_ID."',VENDOR_REG_ID = '".$VENDOR_REG_ID."',Contract_Category = '".$Contract_Category."',Contract_Division = '".$Contract_Division."',Contract_Type = '".$Contract_Type."',Contract_Sub_Type1 = '".$Contract_Sub_Type1."',Contract_Sub_Type2 = '".$Contract_Sub_Type2."',Company_Name = '".$Company_Name."',Company_Address = '".$Company_Address."',Company_Pan_No = '".$Company_Pan_No."',Company_CIN_No = '".$Company_CIN_No."',Contract_Period_From = '".$Contract_Period_From."',Contract_Period_To = '".$Contract_Period_To."',Contract_Security_Deposit_Amount = '".$Contract_Security_Deposit_Amount."',Company_Representor_Empcode = '".$Company_Representor_Empcode."',Company_Representor_Designation = '".$Company_Representor_Designation."',Schedule1_Doc = '".$Schedule1_Doc."',Schedule2_Doc = '".$Schedule2_Doc."',Schedule3_Doc = '".$Schedule3_Doc."',Annexure_Doc = '".$Annexure_Doc."',Form_Status = '".$Form_Status."',".$recorded_column." = '".$current_datetime."',".$recorded_by." = '".$emp_id."',Contract_Date = '".$Contract_Date."',Company_Location = '".$Company_Location."',Company_GST_No = '".$Company_GST_No."' WHERE Id = '".$contract_primary_id."' AND CON_ID = '".$CON_ID."'";
			}

			// echo $sql;exit;

			$sql_exec = sqlsrv_query($this->conn,$sql);

			if($sql_exec === false) {
				$response['status']  = 500;
				$response['message'] = "Query Execution Failed.";
			} else {
				$response['status']  = 200;
				$response['message'] = "Contract Registration Submited Successfully.";

				if($Form_Status == 'Saved') {
					$response['Inserted_ID'] = sqlsrv_fetch_array($sql_exec)['inserted_id'];
					if($contract_primary_id != '') {
						$response['Inserted_ID'] = $contract_primary_id;
					}

					$response['status']  = 200;
					$response['message'] = "Contract Registration Saved Successfully.";
				}
			}

		} else {
			$response['status'] = 419;
			$response['message'] = 'Your Login Session closed.';
		}

		return $response;

	}

	public function Contract_Registeration_delete($request)
	{
		$response['status']  = 422;
		$response['message'] = "Unprocessable Entry.";

		if(isset($_SESSION['EmpID']) && $_SESSION['EmpID'] != '') {
			$Id = (isset($request['id']) && $request['id'] != '') ? $request['id'] : '';
			$Delete_Remarks = (isset($request['Remarks-text']) && $request['Remarks-text'] != '') ? $request['Remarks-text'] : '';
			$Deleted_By     = $_SESSION['EmpID'];
			$Deleted_At     = date('Y-m-d H:i:s');

			if($Id != '') {
				$sql = "UPDATE Contract_Portal_Contract_Registration
				SET Form_Status = 'Deleted',Delete_Remarks = '".$Delete_Remarks."',Deleted_By = '".$Deleted_By."',Deleted_At = '".$Deleted_At."'
				WHERE Id = '".$Id."'";

				$sql_exec = sqlsrv_query($this->conn,$sql);

				if($sql_exec === false) {
					$response['status']  = 500;
					$response['message'] = "Query Execution Failed.";
				} else {
					$response['status']  = 200;
					$response['message'] = "Contract Registration Deleted Successfully.";
				}
			}

		} else {
			$response['status'] = 419;
			$response['message'] = 'Your Login Session closed.';			
		}

		return $response;

	}

	public function Get_contract_basic_details($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

  		$contract_category = (isset($request['contract_category'])) ? $request['contract_category'] : '';

  		$contract_division = (isset($request['contract_division'])) ? $request['contract_division'] : '';
  		$contract_type = (isset($request['contract_type'])) ? $request['contract_type'] : '';
  		
  		$contract_sub_type1 = (isset($request['contract_sub_type1'])) ? $request['contract_sub_type1'] : '';


		if($contract_category != '') {
			$Qry  = "SELECT DISTINCT Contract_Division from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."'";
		}

		if($contract_category != '' && $contract_division != '') {
			$Qry  = "SELECT DISTINCT Contract_Type from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."' AND Contract_Division = '".$contract_division."'";
		}

		if($contract_category != '' && (isset($request['contract_division']) && $contract_division == '')) {
			$Qry  = "SELECT DISTINCT Contract_Type from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."'";
		}

		if($contract_category != '' && $contract_division != '' && $contract_type != '') {
			$Qry  = "SELECT DISTINCT Contract_Sub_Type1 from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."' AND Contract_Division = '".$contract_division."' AND Contract_Type = '".$contract_type."'";
		}

		if($contract_category != '' && (isset($request['contract_division']) && $contract_division == '') && $contract_type != '') {
			$Qry  = "SELECT DISTINCT Contract_Sub_Type1 from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."' AND Contract_Type = '".$contract_type."'";
		}

		if($contract_category != '' && $contract_division != '' && $contract_type != '' && $contract_sub_type1 != '') {
			$Qry  = "SELECT DISTINCT Contract_Sub_Type2 from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."' AND Contract_Division = '".$contract_division."' AND Contract_Type = '".$contract_type."' AND Contract_Sub_Type1 = '".$contract_sub_type1."'";
		}

		if($contract_category != '' && (isset($request['contract_division']) && $contract_division == '') && $contract_type != '' && $contract_sub_type1 != '') {
			$Qry  = "SELECT DISTINCT Contract_Sub_Type1 from Contract_Portal_basic_details_master WHERE 1=1";
			$Qry .= " AND Contract_Category = '".$contract_category."' AND Contract_Type = '".$contract_type."' AND Contract_Sub_Type1 = '".$contract_sub_type1."'";
		}

		// echo $Qry;exit;


		$QryExec = sqlsrv_query($this->conn, $Qry, array(), array("Scrollable" => 'static'));
		$qCount  = sqlsrv_num_rows($QryExec);
		
		$resArr = array();
		if($qCount > 0) {
			while($row = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC))
			{
				$resArr[] = $row;
			}
			$response['status']  = 200;
  			$response['message'] = "Contract basic details fetched successfully.";
		}

		$response['data'] = $resArr;

		return $response;			
	}	


	public function get_approved_vendors($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

  		$vendor_reg_id = (isset($request['vendor_reg_id'])) ? $request['vendor_reg_id'] : '';

		$Qry  = "SELECT * from Contract_Portal_Vendor_Registration WHERE Form_Status = 'Approved'";
		
		if($vendor_reg_id != '') {
			$Qry .= " AND REG_ID = '".$vendor_reg_id."'";
		}

		// echo $Qry;exit;

		$QryExec = sqlsrv_query($this->conn, $Qry, array(), array("Scrollable" => 'static'));
		$qCount  = sqlsrv_num_rows($QryExec);
		
		$resArr = array();
		if($qCount > 0) {
			while($row = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC))
			{
				$resArr[] = $row;
			}
			$response['status']  = 200;
  			$response['message'] = "Vendor details fetched successfully.";
		}

		$response['data'] = $resArr;

		return $response;			
	}	

	public function get_representors($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

		$Qry  = "SELECT * from HR_Master_Table WHERE GRADE LIKE 'SM%' AND Employment_Status = 'Active' ORDER BY Employee_Name ASC";
		
		// echo $Qry;exit;

		$QryExec = sqlsrv_query($this->conn, $Qry, array(), array("Scrollable" => 'static'));
		$qCount  = sqlsrv_num_rows($QryExec);
		
		$resArr = array();
		if($qCount > 0) {
			while($row = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC))
			{
				$resArr[] = $row;
			}
			$response['status']  = 200;
  			$response['message'] = "Representors details fetched successfully.";
		}

		$response['data'] = $resArr;

		return $response;			
	}		


	public function get_company_details($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

		$Qry  = "SELECT * from Contract_Portal_Company_Master WHERE 1=1";
		
		if($request['company_name'] != '') {
			$Qry .= " AND Company_Name LIKE '%".$request['company_name']."%'";
		}		

		$Qry .= " ORDER BY Company_Name ASC"; 
		// echo $Qry;exit;

		$QryExec = sqlsrv_query($this->conn, $Qry, array(), array("Scrollable" => 'static'));
		$qCount  = sqlsrv_num_rows($QryExec);
		
		$resArr = array();
		if($qCount > 0) {
			while($row = sqlsrv_fetch_array($QryExec,SQLSRV_FETCH_ASSOC))
			{
				$resArr[] = $row;
			}
			$response['status']  = 200;
  			$response['message'] = "Representors details fetched successfully.";
		}

		$response['data'] = $resArr;

		return $response;			
	}	


}


?>