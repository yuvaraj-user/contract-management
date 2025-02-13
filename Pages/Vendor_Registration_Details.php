<?php
/**
 * 
 */
class Vendor_Registration_Details
{
	public $conn;
	function __construct($conn)
	{
		$this->conn  = $conn; 
		include('Common_Functions.php');
	}

	public function Remove_Files($file_path)
	{
		if(file_exists($file_path)) {
			unlink($file_path);
		}
	}

	public function Vendor_Registeration_List($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

  		$Emp_Id = $_SESSION['EmpID'];

		$Qry     = "SELECT * FROM Contract_Portal_Vendor_Registration WHERE 1=1 AND Form_Status != 'Deleted' AND (Created_By = '".$Emp_Id."' OR Saved_By = '".$Emp_Id."')";

		if(isset($request['id'])) {
			$Qry .= " AND Id = '".$request['id']."'";
		}


		if(isset($request['status']) && $request['status'] == 'Pending') {
			$Qry .= " AND (Form_Status = 'Saved' OR Form_Status = 'Submitted' OR Form_Status = 'Approved')";
		}

		if(isset($request['status']) && $request['status'] == 'Sendback') {
			$Qry .= " AND Form_Status = 'Sendback'";
		}

		if(isset($request['status']) && $request['status'] == 'Rejected') {
			$Qry .= " AND Form_Status = 'Reject'";
		}				

		$Qry .= " ORDER BY Id DESC";


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
  			$response['message'] = "Vendor Registration list fetched successfully.";
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

	public function Vendor_Register_Save($request)
	{
		// daterange_date_split($request['contract_period']);
		$response['status']  = 422;
		$response['message'] = "Unprocessable Entry.";
		// echo "<pre>";print_r($request);exit;

		if(isset($_SESSION['EmpID']) && $_SESSION['EmpID'] != '') {
			$emp_id = $_SESSION['EmpID'];

			// get contract creator l1 manager employee code
			$L1_Emp_Id = $this->Get_L1_Manager_Code($emp_id);
			
			// company details section 
			$registration_primary_id = (isset($request['register_id']) && $request['register_id'] != '') ? $request['register_id'] : '';

			$REG_ID = (isset($request['REG_ID']) && $request['REG_ID'] != '') ? $request['REG_ID'] : '';
			
			// insertion time generate last CON ID   
			if($registration_primary_id == '') {
				$REG_ID = Generate_Registeration_No($this->conn);
			}

			$Vendor_Name = (isset($request['vendor_name']) && $request['vendor_name'] != '') ? $request['vendor_name'] : '';
			$Father_Name = (isset($request['father_name']) && $request['father_name'] != '') ? $request['father_name'] : '';
			$Partner_Name = (isset($request['partner_name']) && $request['partner_name'] != '') ? $request['partner_name'] : '';

			$Pan_No = (isset($request['pan_num']) && $request['pan_num'] != '') ? $request['pan_num'] : '';
			$Vendor_Type = (isset($request['type_of_vendor']) && $request['type_of_vendor'] != '') ? $request['type_of_vendor'] : '';
			$Address = (isset($request['Address']) && $request['Address'] != '') ? $request['Address'] : '';
			$Owner_Address = (isset($request['owner_address']) && $request['owner_address'] != '') ? $request['owner_address'] : '';

			$Phone_With_STD = (isset($request['phonenum']) && $request['phonenum'] != '') ? $request['phonenum'] : '';
			$Mobile_No = (isset($request['mobile_num']) && $request['mobile_num'] != '') ? $request['mobile_num'] : '';
			$Email = (isset($request['email']) && $request['email'] != '') ? $request['email'] : '';
			$Contact_Person_Name = (isset($request['contact_person_name']) && $request['contact_person_name'] != '') ? $request['contact_person_name'] : '';
			$Contact_Person_Mobile = (isset($request['contact_person_mobile']) && $request['contact_person_mobile'] != '') ? $request['contact_person_mobile'] : '';
			$Website_address = (isset($request['website']) && $request['website'] != '') ? $request['website'] : '';

			$GST_No = (isset($request['gst_num']) && $request['gst_num'] != '') ? $request['gst_num'] : '';
			$CIN_No = (isset($request['CIN_num']) && $request['CIN_num'] != '') ? $request['CIN_num'] : '';
			$Aadhar_No = (isset($request['aadhar_num']) && $request['aadhar_num'] != '') ? $request['aadhar_num'] : '';
			$MSME_Type = (isset($request['msme_type']) && $request['msme_type'] != '') ? $request['msme_type'] : '';
			$MSME_No = (isset($request['msme_num']) && $request['msme_num'] != '') ? $request['msme_num'] : '';
			$Seed_License_No = (isset($request['seed_licence_num']) && $request['seed_licence_num'] != '') ? $request['seed_licence_num'] : '';
			$Seed_License_Validity = (isset($request['seedvalidity']) && $request['seedvalidity'] != '') ? $request['seedvalidity'] : '';


			// Bank details section
			$Account_Holder_Name = (isset($request['acc_holder_name']) && $request['acc_holder_name'] != '') ? $request['acc_holder_name'] : '';
			$Account_Type = (isset($request['acc_type']) && $request['acc_type'] != '') ? $request['acc_type'] : '';
			$Bank_Name = (isset($request['bank_name']) && $request['bank_name'] != '') ? $request['bank_name'] : '';
			$Bank_Branch = (isset($request['branch_name']) && $request['branch_name'] != '') ? $request['branch_name'] : '';
			$Account_No = (isset($request['acc_number']) && $request['acc_number'] != '') ? $request['acc_number'] : '';
			$IFSC_Code = (isset($request['ifsc_code']) && $request['ifsc_code'] != '') ? $request['ifsc_code'] : '';
			$Other_Remarks = (isset($request['Other_Remarks']) && $request['Other_Remarks'] != '') ? $request['Other_Remarks'] : '';

			$Company_Reg_Certificate_Doc = '';
			$MSME_Certificate_Doc = '';
			$Address_Proof_Doc = '';
			$Cancelled_Cheque_Doc = '';
			$Pan_Card_Doc = '';
			$GST_Certificate_Doc = '';
			$Aadhar_Card_Doc = '';
			$Seed_License_Doc = '';
			$Other_Doc = '';


			$Form_Status = ($request['from'] == 'save') ? 'Saved' : 'Submitted';

			$current_datetime = date('Y-m-d H:i:s');

			$structured_register_id =  str_replace('/', '-',$REG_ID);

			$folder_path = 'uploads/vendor_registration/'.$structured_register_id;

			// contract file folder exist check otherwise create folder 
			if(!(file_exists($folder_path))) {
				mkdir($folder_path);
			}

			$saved_sql_res = array();

			// contract saved data get for edit functionality
			if($registration_primary_id != '') {
				$saved_sql      = "SELECT * from Contract_Portal_Vendor_Registration WHERE Id='".$registration_primary_id."'";
				$saved_sql_exec = sqlsrv_query($this->conn,$saved_sql); 
				$saved_sql_res  =  sqlsrv_fetch_array($saved_sql_exec,SQLSRV_FETCH_ASSOC);
			}


			if($_FILES['com_reg_certificate_file']['name'] != '') {
				$file_extension = pathinfo($_FILES['com_reg_certificate_file']['name'])['extension'];

				$Company_Reg_Certificate_Doc = $structured_register_id.'_Company_certificate_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$Company_Reg_Certificate_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Company_Reg_Certificate_Doc']; 
					$this->Remove_Files($old_file_path);
				}

				move_uploaded_file($_FILES['com_reg_certificate_file']['tmp_name'],$path);
			} else {
				if($request['com_reg_certificate_file_name'] != '') {
					$Company_Reg_Certificate_Doc = $request['com_reg_certificate_file_name'];
				}
			}		

			if($_FILES['msme_certificate']['name'] != '') {
				$file_extension = pathinfo($_FILES['msme_certificate']['name'])['extension'];

				$MSME_Certificate_Doc = $structured_register_id.'_MSME_certificate_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$MSME_Certificate_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['MSME_Certificate_Doc']; 
					$this->Remove_Files($old_file_path);
				}

				move_uploaded_file($_FILES['msme_certificate']['tmp_name'],$path);
			} else {
				if($request['msme_certificate_file_name'] != '') {
					$MSME_Certificate_Doc = $request['msme_certificate_file_name'];
				}
			}		

			if($_FILES['address_proof_file']['name'] != '') {
				$file_extension = pathinfo($_FILES['address_proof_file']['name'])['extension'];

				$Address_Proof_Doc = $structured_register_id.'_Address_Proof_'.strtotime("now").'.'.$file_extension; 

				$path = $folder_path.'/'.$Address_Proof_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Address_Proof_Doc']; 
					$this->Remove_Files($old_file_path);
				}			

				move_uploaded_file($_FILES['address_proof_file']['tmp_name'],$path);
			} else {
				if($request['address_proof_file_name'] != '') {
					$Address_Proof_Doc = $request['address_proof_file_name'];
				}
			}				

			if($_FILES['cancelled_cheque_file']['name'] != '') {
				$file_extension = pathinfo($_FILES['cancelled_cheque_file']['name'])['extension'];

				$Cancelled_Cheque_Doc = $structured_register_id.'_Cancelled_Cheque_'.strtotime("now").'.'.$file_extension; 
				
				$path = $folder_path.'/'.$Cancelled_Cheque_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Cancelled_Cheque_Doc']; 
					$this->Remove_Files($old_file_path);
				}				

				move_uploaded_file($_FILES['cancelled_cheque_file']['tmp_name'],$path);
			} else {
				if($request['cancelled_cheque_file_name'] != '') {
					$Cancelled_Cheque_Doc = $request['cancelled_cheque_file_name'];
				}
			}		

			if($_FILES['pan_card_file']['name'] != '') {
				$file_extension = pathinfo($_FILES['pan_card_file']['name'])['extension'];

				$Pan_Card_Doc = $structured_register_id.'_Pan_Card_'.strtotime("now").'.'.$file_extension; 
				
				$path = $folder_path.'/'.$Pan_Card_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Pan_Card_Doc']; 
					$this->Remove_Files($old_file_path);
				}					

				move_uploaded_file($_FILES['pan_card_file']['tmp_name'],$path);
			} else {
				if($request['pan_card_file_name'] != '') {
					$Pan_Card_Doc = $request['pan_card_file_name'];
				}
			}		

			if($_FILES['gst_certificate_certificate']['name'] != '') {
				$file_extension = pathinfo($_FILES['gst_certificate_certificate']['name'])['extension'];

				$GST_Certificate_Doc = $structured_register_id.'_GST_Certificate_'.strtotime("now").'.'.$file_extension; 
				
				$path = $folder_path.'/'.$GST_Certificate_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['GST_Certificate_Doc']; 
					$this->Remove_Files($old_file_path);
				}								

				move_uploaded_file($_FILES['gst_certificate_certificate']['tmp_name'],$path);
			} else {
				if($request['gst_certificate_file_name'] != '') {
					$GST_Certificate_Doc = $request['gst_certificate_file_name'];
				}
			}	

			if($_FILES['aadhar_card_file']['name'] != '') {
				$file_extension = pathinfo($_FILES['aadhar_card_file']['name'])['extension'];

				$Aadhar_Card_Doc = $structured_register_id.'_Aadhar_Card_'.strtotime("now").'.'.$file_extension; 
				
				$path = $folder_path.'/'.$Aadhar_Card_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Aadhar_Card_Doc']; 
					$this->Remove_Files($old_file_path);
				}				

				move_uploaded_file($_FILES['aadhar_card_file']['tmp_name'],$path);
			} else {
				if($request['aadhar_card_file_name'] != '') {
					$Aadhar_Card_Doc = $request['aadhar_card_file_name'];
				}
			}	

			if($_FILES['seed_license_certificate']['name'] != '') {
				$file_extension = pathinfo($_FILES['seed_license_certificate']['name'])['extension'];

				$Seed_License_Doc = $structured_register_id.'_Seed_Licence_Certificate_'.strtotime("now").'.'.$file_extension; 
				
				$path = $folder_path.'/'.$Seed_License_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Seed_License_Doc']; 
					$this->Remove_Files($old_file_path);
				}				

				move_uploaded_file($_FILES['seed_license_certificate']['tmp_name'],$path);
			} else {
				if($request['seed_license_certificate_file_name'] != '') {
					$Seed_License_Doc = $request['seed_license_certificate_file_name'];
				}
			}			

			if($_FILES['other_files']['name'] != '') {
				$file_extension = pathinfo($_FILES['other_files']['name'])['extension'];

				$Other_Doc = $structured_register_id.'_Other_file_'.strtotime("now").'.'.$file_extension; 
				
				$path = $folder_path.'/'.$Other_Doc;

				// old uploaded file exist check and remove that file 
				if($saved_sql_res != '') {
					$old_file_path = $folder_path.'/'.$saved_sql_res['Other_Doc']; 
					$this->Remove_Files($old_file_path);
				}			

				move_uploaded_file($_FILES['other_files']['tmp_name'],$path);
			} else {
				if($request['other_file_name'] != '') {
					$Other_Doc = $request['other_file_name'];
				}
			}				


			if($registration_primary_id == '') {
				$recorded_column = 'Saved_At';
				$recorded_by = 'Saved_By';
				if($Form_Status == 'submited') {
					$recorded_column = 'Created_At';
					$recorded_by = 'Created_By';
				}

				$sql = "INSERT INTO Contract_Portal_Vendor_Registration(REG_ID,Vendor_Name,Pan_No,Vendor_Type,Address,Phone_With_STD,Mobile_No,Email,Contact_Person_Name,Contact_Person_Mobile,Website_address,GST_No,CIN_No,Aadhar_No,MSME_Type,MSME_No,Seed_License_No,Seed_License_Validity,Account_Holder_Name,Account_Type,Bank_Name,Bank_Branch,Account_No,IFSC_Code,Company_Reg_Certificate_Doc,MSME_Certificate_Doc,Address_Proof_Doc,Cancelled_Cheque_Doc,Pan_Card_Doc,GST_Certificate_Doc,Aadhar_Card_Doc,Seed_License_Doc,Other_Doc,Form_Status,".$recorded_column.",Other_Remarks,".$recorded_by.",L1_Emp_Id,Father_Name,Partner_Name,Owner_Address) OUTPUT INSERTED.Id as inserted_id VALUES ('".$REG_ID."','".$Vendor_Name."','".$Pan_No."','".$Vendor_Type."','".$Address."','".$Phone_With_STD."','".$Mobile_No."','".$Email."','".$Contact_Person_Name."','".$Contact_Person_Mobile."','".$Website_address."','".$GST_No."','".$CIN_No."','".$Aadhar_No."','".$MSME_Type."','".$MSME_No."','".$Seed_License_No."','".$Seed_License_Validity."','".$Account_Holder_Name."','".$Account_Type."','".$Bank_Name."','".$Bank_Branch."','".$Account_No."','".$IFSC_Code."','".$Company_Reg_Certificate_Doc."','".$MSME_Certificate_Doc."','".$Address_Proof_Doc."','".$Cancelled_Cheque_Doc."','".$Pan_Card_Doc."','".$GST_Certificate_Doc."','".$Aadhar_Card_Doc."','".$Seed_License_Doc."','".$Other_Doc."','".$Form_Status."','".$current_datetime."','".$Other_Remarks."','".$emp_id."','".$L1_Emp_Id."','".$Father_Name."','".$Partner_Name."','".$Owner_Address."')";
			} else {
				$recorded_column = 'Saved_At';
				$recorded_by = 'Saved_By';
				if($Form_Status == 'Submitted' && $request['page_type'] == 'Create' || $request['page_type'] == 'Edit' && $saved_sql_res['Form_Status'] == 'Saved') {
					$recorded_column = 'Created_At';
					$recorded_by = 'Created_By';					
				} elseif($request['page_type'] == 'Edit' && $saved_sql_res['Form_Status'] == 'Submitted') {
					$recorded_column = 'Updated_At';
					$recorded_by = 'Updated_By';					
				}


				$sql = "UPDATE Contract_Portal_Vendor_Registration
				SET Vendor_Name = '".$Vendor_Name."',Pan_No = '".$Pan_No."',Vendor_Type = '".$Vendor_Type."',Address = '".$Address."',Phone_With_STD = '".$Phone_With_STD."',Mobile_No = '".$Mobile_No."',Email = '".$Email."',Contact_Person_Name = '".$Contact_Person_Name."',Contact_Person_Mobile = '".$Contact_Person_Mobile."',Website_address = '".$Website_address."',GST_No = '".$GST_No."',CIN_No = '".$CIN_No."',Aadhar_No = '".$Aadhar_No."',MSME_Type = '".$MSME_Type."',MSME_No = '".$MSME_No."',Seed_License_No = '".$Seed_License_No."',Seed_License_Validity = '".$Seed_License_Validity."',Account_Holder_Name = '".$Account_Holder_Name."',Account_Type = '".$Account_Type."',Bank_Name = '".$Bank_Name."',Bank_Branch = '".$Bank_Branch."',Account_No = '".$Account_No."',IFSC_Code = '".$IFSC_Code."',Company_Reg_Certificate_Doc = '".$Company_Reg_Certificate_Doc."',MSME_Certificate_Doc = '".$MSME_Certificate_Doc."',Address_Proof_Doc = '".$Address_Proof_Doc."',Cancelled_Cheque_Doc = '".$Cancelled_Cheque_Doc."',Pan_Card_Doc = '".$Pan_Card_Doc."',GST_Certificate_Doc = '".$GST_Certificate_Doc."',Aadhar_Card_Doc = '".$Aadhar_Card_Doc."',Seed_License_Doc = '".$Seed_License_Doc."',Other_Doc = '".$Other_Doc."',Form_Status = '".$Form_Status."',$recorded_column = '".$current_datetime."',Other_Remarks = '".$Other_Remarks."',$recorded_by = '".$emp_id."',L1_Emp_Id = '".$L1_Emp_Id."',Father_Name = '".$Father_Name."',Partner_Name = '".$Partner_Name."',Owner_Address = '".$Owner_Address."' 
				WHERE Id = '".$registration_primary_id."' AND REG_ID = '".$REG_ID."'";
			}

			// echo $sql;exit;

			$sql_exec = sqlsrv_query($this->conn,$sql);

			if($sql_exec === false) {
				$response['status']  = 500;
				$response['message'] = "Query Execution Failed.";
			} else {
				$response['status']  = 200;
				$response['message'] = "Vendor Registration Submitted Successfully.";

				if($Form_Status == 'Saved') {
					$response['Inserted_ID'] = sqlsrv_fetch_array($sql_exec)['inserted_id'];
					if($registration_primary_id != '') {
						$response['Inserted_ID'] = $registration_primary_id;
					}

					$response['status']  = 200;
					$response['message'] = "Vendor Registration Saved Successfully.";
				}
			}

		} else {
			$response['status'] = 419;
			$response['message'] = 'Your Login Session closed.';
		}

		return $response;

	}

	public function Vendor_Registeration_delete($request)
	{
		$response['status']  = 422;
		$response['message'] = "Unprocessable Entry.";



		if(isset($_SESSION['EmpID']) && $_SESSION['EmpID'] != '') {
			$Id = (isset($request['id']) && $request['id'] != '') ? $request['id'] : '';
			$Delete_Remarks = (isset($request['Remarks-text']) && $request['Remarks-text'] != '') ? $request['Remarks-text'] : '';
			$Deleted_By     = $_SESSION['EmpID'];
			$Deleted_At     = date('Y-m-d H:i:s');

			if($Id != '') {
				$sql = "UPDATE Contract_Portal_Vendor_Registration
				SET Form_Status = 'Deleted',Delete_Remarks = '".$Delete_Remarks."',Deleted_By = '".$Deleted_By."',Deleted_At = '".$Deleted_At."'
				WHERE Id = '".$Id."'";

				$sql_exec = sqlsrv_query($this->conn,$sql);

				if($sql_exec === false) {
					$response['status']  = 500;
					$response['message'] = "Query Execution Failed.";
				} else {
					$response['status']  = 200;
					$response['message'] = "Vendor Registration Deleted Successfully.";
				}
			}

		} else {
			$response['status'] = 419;
			$response['message'] = 'Your Login Session closed.';			
		}

		return $response;

	}

}


?>