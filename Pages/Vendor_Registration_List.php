<?php include "Header.php";?>

<?php include "Topbar.php" ?>		

<?php include "Sidemenu.php" ?>	

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Contract Registration List</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li class="active"><span><a href="Contract_Registration_List.php">Contract Registration List</a></span></li>
						<!-- <li><a href="#"><span>table</span></a></li> -->
						<!-- <li class="active"><span>Export</span></li> -->
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

				<div class="row">
					<div class="col-md-12">
						<a href="Vendor_Registration.php"><button class="btn btn-sm btn-success create_contract" style="float: right;"><i class="fa-solid fa-file-circle-plus"></i> Create Vendor</button></a>
					</div>
				</div>

				
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
												<a data-toggle="tab" id="sendback_tab" role="tab" href="#sendback" aria-expanded="false"><i class="fa-solid fa-circle-check"></i> Send Backed</a>
											</li>
											<li role="presentation" class="">
												<a data-toggle="tab" id="rejeced_tab" role="tab" href="#rejected" aria-expanded="false"><i class="fa-solid fa-circle-xmark"></i> Rejected</a>
											</li>											
										</ul>
										<div class="tab-content" id="myTabContent_15">
											<div id="pending" class="tab-pane fade active in" role="tabpanel">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="registration_list_tbl" class="table table-hover display  pb-30" >
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
															<tbody id="registration_list_body">

															</tbody>
														</table>
													</div>
												</div>
											</div>

											<div id="sendback" class="tab-pane fade" role="tabpane2">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="registration_sendback_list_tbl" class="table table-hover display  pb-30" >
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
															<tbody id="registration_sendback_list_body">

															</tbody>
														</table>
													</div>
												</div>
											</div>	

											<div id="rejected" class="tab-pane fade" role="tabpane3">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="registration_rejected_list_tbl" class="table table-hover display  pb-30" >
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
															<tbody id="registration_rejected_list_body">

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

			</div>	

			<?php include "Footer.php" ?>


				<!-- delete remark modal -->
				<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog  modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h5 class="modal-title">Delete Vendor Registration</h5>
							</div>
							<div class="modal-body">
								<form id="delete_form">
									<input type="hidden" name="id" id="delete_id">
									<div class="form-group">
										<label for="Remarks-text" class="control-label mb-10">Remarks<span style="color: red;">* :</span></label>
										<textarea class="form-control" name="Remarks-text" id="Remarks-text" rows="10" placeholder="Enter Your Remarks here..."></textarea>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-danger delete-submit">Delete</button>
							</div>
						</div>
					</div>
				</div>				
		</div>


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

			datatable('registration_list_tbl');
			datatable('registration_sendback_list_tbl');
			datatable('registration_rejected_list_tbl');
			
			get_contract_registration_list('Pending');
			get_contract_registration_list('Sendback');
			get_contract_registration_list('Rejected');


		});	



 		function get_contract_registration_list(action_status){
            $.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Vendor_Registeration_List',status : action_status },
                dataType: "json",
                beforeSend: function(){
                    // $('.ajax-preloader').show();
                },
                success: function(response) {
                    var html = '';

                    if(response.data.length > 0) {    
                        for(i in response.data) {   
                        	var encodedId = btoa(response.data[i].Id);

                        	var status = ''
                        	if(response.data[i].Form_Status == 'Submitted' && response.data[i].Contract_Approval_Submission != '1') {
                        		status = `<span class="badge bg-success txt-white list-page-badge">${response.data[i].Form_Status}</span>`;
                        	} else if(response.data[i].Form_Status == 'Saved') {
                        		status = `<span class="badge bg-info txt-white list-page-badge">${response.data[i].Form_Status}</span>`;
                        	} else if(response.data[i].Form_Status == 'Submitted' && response.data[i].Contract_Approval_Submission == '1') {
                        		status = `<span class="badge bg-primary txt-white list-page-badge">Pending For Approval</span>`;
                        	} else if(response.data[i].Form_Status == 'Approved') {
                        		status = `<span class="badge bg-warning txt-white list-page-badge">Approved</span>`;
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
                                    <a href="Vendor_Registration.php?id=${ encodedId }&action=${btoa('view')}" class="text-inverse pr-10 tbl_action_view" title="View" data-toggle="tooltip" data-original-title="Edit">
                                		<i class="zmdi zmdi-eye txt-primary"></i>
                                	</a>`;
                               if((action_status == 'Pending' && response.data[i].Form_Status != 'Approved') || action_status == 'Sendback') {

                                	html += `<a href="Vendor_Registration.php?id=${ encodedId }" class="text-inverse pr-10 tbl_action_edit" title="Edit" data-toggle="tooltip" data-original-title="Edit">
                                		<i class="zmdi zmdi-edit txt-warning"></i>
                                	</a>`;
                                }
                            
                               if(action_status == 'Pending' && response.data[i].Form_Status != 'Approved') {
                                	html += `<a href="javascript:void(0)" class="text-inverse delete_contract tbl_action_edit" title="Delete" data-toggle="tooltip" data-original-title="Delete" data-id="${response.data[i].Id}">
                                		<i class="zmdi zmdi-delete txt-danger"></i>
                                	</a>`;
                                }                             
                                html += `</div></td>                               
                            </tr>`;
                        }
                    }


                    if(action_status == 'Pending') {
	                    $('#registration_list_tbl').DataTable().destroy();    
	                    $('#registration_list_body').html(html);
						datatable('registration_list_tbl');
                    } else if(action_status == 'Sendback') {
	                    $('#registration_sendback_list_tbl').DataTable().destroy();    
	                    $('#registration_sendback_list_body').html(html);
	                    datatable('registration_sendback_list_tbl');                    	
                    } else if(action_status == 'Rejected') {
	                    $('#registration_rejected_list_tbl').DataTable().destroy();    
	                    $('#registration_rejected_list_body').html(html);
	                    datatable('registration_rejected_list_tbl');                    	
                    }					


                },
                complete:function() {
                    // $('.ajax-preloader').hide();
                }
            });
        }

        $(document).on('click','.delete_contract',function(){
        	var id = $(this).data('id');
        	$('#delete_id').val(id);
        	$('#delete-modal').modal('show');
        });

		function alert_msg(icon,title,message)
		{
	    	Swal.fire({
				icon: icon,
				title: title,
				text: message,
				confirmButtonText: "OK"
			});
		}

        $(document).on('click','.delete-submit',function(){
        	var remarks = $('#Remarks-text').val();
        	if(remarks == '') {
	    		alert_msg('warning','Warning!','Delete Remark is mandatory.');
	    		$('#Remarks-text').addClass('error');        		
        	} else {
		    	var form = $('#delete_form');
		    	var formData = new FormData(form[0]);
		    	formData.append('Action','Vendor_Registeration_delete');

	        	$.ajax({
					url: 'Common_Ajax.php',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					dataType: 'json',
					success: function(response) {
	        			$('#delete-modal').modal('hide');

						if (response.status == 200) {
							$('#contract_id').val(response.Inserted_ID);
							Swal.fire({
								icon: "success",
								title: "Success!",
								text: response.message,
								confirmButtonText: "OK"
							}).then(function(isconfirm){
								if(isconfirm) {
									get_contract_registration_list();
								}
							});

						} else {
							Swal.fire({
								icon: "error",
								title: "Error!",
								text: response.message,
								confirmButtonText: "OK"
							});
						}
					},
					error: function(xhr, status, error) {
						console.error('Error:', error);
						Swal.fire({
							icon: "error",
							title: "Error!",
							text: "Error in Registration.",
							confirmButtonText: "OK"
						});
					}
				});
        	}
        });


	</script>