<?php
/**
 * 
 */
class Vendor_L1_Approval_Details
{
	public $conn;
	function __construct($conn)
	{
		$this->conn  = $conn;
	}

	public function Vendor_L1_Approval_List($request)
	{
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

  		$Emp_Id = $_SESSION['EmpID'];

		$Qry     = "SELECT * FROM Contract_Portal_Vendor_Registration WHERE Form_Status != 'Deleted' AND L1_Emp_Id = '".$Emp_Id."'";

		if(isset($request['id'])) {
			$Qry .= " AND Id = '".$request['id']."'";
		}

		if(isset($request['status']) && $request['status'] == 'Pending') {
			$Qry .= " AND Form_Status = 'Submitted'";
		}

		if(isset($request['status']) && $request['status'] == 'Completed') {
			$Qry .= " AND (Form_Status = 'Sendback' OR Form_Status = 'Approved')";
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
  			$response['message'] = "Contract Registration list fetched successfully.";
		}

		$response['data'] = $resArr;

		return $response;			
	}

	public function Vendor_L1_Status_Update($request)
	{
		// echo "<pre>";print_r($request);exit;
		$response['status']  = 422;
  		$response['message'] = "Unprocessable Entry";

		if(isset($_SESSION['EmpID']) && $_SESSION['EmpID'] != '') {
	  		$Emp_Id = $_SESSION['EmpID'];
	  		$Id     = $request['id']; 
	  		$REG_ID = $request['reg_id']; 	
	  		$Form_Status = $request['vendor_action_status']; 
	  		$remarks = $request['Remarks-text']; 
			$current_datetime = date('Y-m-d H:i:s');

	  		$remark_column_name = '';
	  		$timestamp_column_name = '';

	  		if($Form_Status == 'Approved') {
	  			$remark_column_name    = 'L1_Approve_Remarks';
	  			$timestamp_column_name = 'L1_Approved_At';
	  			$response_message = 'Vendor Approved Successfully.'; 
	  		}

	  		if($Form_Status == 'Sendback') {
	  			$remark_column_name    = 'L1_Sendback_Remarks';
	  			$timestamp_column_name = 'L1_Sendbacked_At';
	  			$response_message = 'Vendor Sendbacked Successfully.';   			
	  		}  

			if($Form_Status == 'Reject') {
	  			$remark_column_name    = 'L1_Reject_Remarks';
	  			$timestamp_column_name = 'L1_Rejected_At';
	  			$response_message = 'Vendor Rejected Successfully.';   			  			
	  		}  				

			$sql = "UPDATE Contract_Portal_Vendor_Registration SET Form_Status = '".$Form_Status."', $remark_column_name = '".$remarks."',$timestamp_column_name = '".$current_datetime."'
			WHERE Id = '".$Id."' AND REG_ID = '".$REG_ID."'";

			// echo $sql;exit;

			$sql_exec = sqlsrv_query($this->conn,$sql);

			if($sql_exec === false) {
				$response['status']  = 500;
				$response['message'] = "Query Execution Failed.";
			} else {
				$response['status']  = 200;
				$response['message'] = $response_message;
			}  	
		} else {
			$response['status'] = 419;
			$response['message'] = 'Your Login Session closed.';
		}	

		return $response;			
	}	


	
}

?>
