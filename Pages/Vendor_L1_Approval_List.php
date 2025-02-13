<?php include "Header.php";?>

<?php include "Topbar.php" ?>		

<?php include "Sidemenu.php" ?>	

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Contract Approval List</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li class="active"><span><a href="Contract_Registration_List.php">Contract Approval List</a></span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->


				
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs" id="myTabs_15">
											<li class="active" role="presentation">
												<a aria-expanded="true" data-toggle="tab" role="tab" id="pending_tab" href="#pending"><i class="fa-regular fa-hourglass-half"></i> Pending</a>
											</li>
											<li role="presentation" class="">
												<a data-toggle="tab" id="completed_tab" role="tab" href="#completed" aria-expanded="false"><i class="fa-solid fa-circle-check"></i> Completed</a>
											</li>
											<li role="presentation" class="">
												<a data-toggle="tab" id="rejeced_tab" role="tab" href="#rejected" aria-expanded="false"><i class="fa-solid fa-circle-xmark"></i> Rejected</a>
											</li>											
										</ul>
										<div class="tab-content" id="myTabContent_15">
											<div id="pending" class="tab-pane fade active in" role="tabpanel">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="L1_approval_pending_list_tbl" class="table table-hover display  pb-30" >
															<thead>
																<tr>
																	<th>Sno</th>
																	<th>Registration ID</th>
																	<th>Vendor Name</th>
																	<th>Vendor Type</th>
																	<th>Email</th>
																	<th>Mobile</th>
																	<th>Status</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="L1_approval_pending_list_body">

															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div id="completed" class="tab-pane fade" role="tabpanel">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="L1_completed_list_tbl" class="table table-hover display  pb-30" >
															<thead>
																<tr>
																	<th>Sno</th>
																	<th>Registration ID</th>
																	<th>Vendor Name</th>
																	<th>Vendor Type</th>
																	<th>Email</th>
																	<th>Mobile</th>
																	<th>Status</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="L1_completed_list_body">

															</tbody>
														</table>
													</div>
												</div>
											</div>

											<div id="rejected" class="tab-pane fade" role="tabpanel">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="L1_rejected_list_tbl" class="table table-hover display  pb-30" >
															<thead>
																<tr>
																	<th>Sno</th>
																	<th>Registration ID</th>
																	<th>Vendor Name</th>
																	<th>Vendor Type</th>
																	<th>Email</th>
																	<th>Mobile</th>
																	<th>Status</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="L1_rejected_list_body">

															</tbody>
														</table>
													</div>
												</div>
											</div>											
										</div>
									</div>

								</div>
							</div>
						</div>	
					</div>
				</div>

			<?php include "Footer.php" ?>

		</div>

	<?php include "Bottom_Script.php" ?>

	<script>
		function datatable(element_id){
			$('#'+element_id).DataTable({
				dom: 'Bfrtip',
				buttons: [
					 'excel', 'pdf', 'print'
				]
			});
        }

		$(document).ready(function() {
			// initialize datatable for all tabs
			datatable('L1_approval_pending_list_tbl');
			datatable('L1_completed_list_tbl');
			datatable('L1_rejected_list_tbl');

			// get data for dataatables
			get_contract_pending_list('Pending');
			get_contract_pending_list('Completed');
			get_contract_pending_list('Rejected');

		});	

 		function get_contract_pending_list(action_status){
            $.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Vendor_L1_Approval_List',status : action_status },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    var html = '';

                    if(response.data.length > 0) {    
                        for(i in response.data) {   
                        	var encodedId = btoa(response.data[i].Id);

                        	var status = ''
                        	if(response.data[i].Form_Status == 'Submitted' && response.data[i].Contract_Approval_Submission == '1') {
                        		status = `<span class="badge bg-primary txt-white list-page-badge">Pending</span>`;
                        	} else if(response.data[i].Form_Status == 'Approved') {
                        		status = `<span class="badge bg-success txt-white list-page-badge">${response.data[i].Form_Status}</span>`;
                        	} else if(response.data[i].Form_Status == 'Sendback') {
                        		status = `<span class="badge bg-info txt-white list-page-badge">${response.data[i].Form_Status}</span>`;
                        	} else if(response.data[i].Form_Status == 'Reject') {
                        		status = `<span class="badge bg-danger txt-white list-page-badge">${response.data[i].Form_Status}</span>`;
                        	}    

                            html += `<tr>
                                <td>${ parseInt(i)+ parseInt(1) }</td>
                                <td>${response.data[i].REG_ID}</td>
                                <td>${response.data[i].Vendor_Name}</td>
                                <td>${response.data[i].Vendor_Type}</td>
                                <td>${response.data[i].Email}</td>
                                <td>${response.data[i].Mobile_No}</td> 
                                <td>${status}</td>                                 
                                <td>
                                	<div class="tbl_action_div">
                                    <a href="Vendor_L1_Approve.php?id=${ encodedId }&action=${btoa('view')}" class="text-inverse pr-10 tbl_action_view" title="View" data-toggle="tooltip" data-original-title="Edit">
                                		<i class="zmdi zmdi-eye txt-primary"></i>
                                	</a>`;
                            
                               if(action_status == 'Pending') {
                                  html += `<a href="Vendor_L1_Approve.php?id=${ encodedId }" class="text-inverse pr-10" title="Approve" data-toggle="tooltip" data-original-title="Edit">
                                  		<button class="btn btn-sm btn-warning"><i class="fa-solid fa-check"></i> Approve</button>
                                	</a>`;
                                }                              
                                html += `</div></td>                               
                            	</tr>`;
                        }
                    }


                    if(action_status == 'Pending') {
	                    $('#L1_approval_pending_list_tbl').DataTable().destroy();    
	                    $('#L1_approval_pending_list_body').html(html);
	                    datatable('L1_approval_pending_list_tbl');
                    } else if(action_status == 'Completed') {
	                    $('#L1_completed_list_tbl').DataTable().destroy();    
	                    $('#L1_completed_list_body').html(html);
	                    datatable('L1_completed_list_tbl');                    	
                    } else if(action_status == 'Rejected') {
	                    $('#L1_rejected_list_tbl').DataTable().destroy();    
	                    $('#L1_rejected_list_body').html(html);
	                    datatable('L1_rejected_list_tbl');                    	
                    }

                },
                complete:function() {
                	hideLoader()
                }
            });
        }


	</script>