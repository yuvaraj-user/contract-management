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
						<button class="btn btn-sm btn-success create_contract" style="float: right;"><i class="fa-solid fa-file-circle-plus"></i> Create Contract</button>
					</div>
				</div>

				
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="tab-struct custom-tab-1">
										<!-- <ul role="tablist" class="nav nav-tabs" id="myTabs_15">
											<li class="active" role="presentation">
												<a aria-expanded="true" data-toggle="tab" role="tab" id="pending_tab" href="#pending"><i class="fa-regular fa-hourglass-half"></i> Pending</a>
											</li>
											<li role="presentation" class="">
												<a data-toggle="tab" id="sendback_tab" role="tab" href="#sendback" aria-expanded="false"><i class="fa-solid fa-circle-check"></i> Send Backed</a>
											</li>
											<li role="presentation" class="">
												<a data-toggle="tab" id="rejeced_tab" role="tab" href="#rejected" aria-expanded="false"><i class="fa-solid fa-circle-xmark"></i> Rejected</a>
											</li>											
										</ul> -->
										<!-- <div class="tab-content" id="myTabContent_15"> -->
											<!-- <div id="pending" class="tab-pane fade active in" role="tabpanel"> -->
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="registration_list_tbl" class="table table-hover display  pb-30" >
															<thead>
																<tr>
																	<th>Sno</th>
																	<th>Contract ID</th>
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
												<!-- </div> -->
											<!-- </div> -->

											<!-- <div id="sendback" class="tab-pane fade" role="tabpane2">
												<div class="table-wrap">
													<div class="table-responsive">
														<table id="registration_sendback_list_tbl" class="table table-hover display  pb-30" >
															<thead>
																<tr>
																	<th>Sno</th>
																	<th>Contract ID</th>
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
																	<th>Contract ID</th>
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
											</div>	 -->

										</div>
									</div>


								</div>
							</div>
						</div>	
					</div>
				</div>

				<!-- New Contract modal -->
				<div id="new-contract-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog  modal-dialog-centered modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
								<h5 class="modal-title">Create Contract</h5>
							</div>
							<form id="create_contract_form" action="Contract_Registration.php" method="POST">
								<div class="modal-body">
									<div class="form-group">
										<div class="form-group">
											<label for="contract_category" class="control-label mb-10">Contract Category<span style="color: red;"> * :</span></label>

											<select class="form-control" name="contract_category" id="contract_category">
												<option value="">Select Contract Category</option>
												<?php
													$category_sql = "SELECT DISTINCT Contract_Category from Contract_Portal_basic_details_master"; 
													$category_sql_exec = sqlsrv_query($conn, $category_sql);
													while($row = sqlsrv_fetch_array($category_sql_exec,SQLSRV_FETCH_ASSOC))
													{												
												?>												
													<option value="<?= $row['Contract_Category'] ?>"><?= $row['Contract_Category'] ?></option>
												<?php } ?>
											</select>      
										</div>

										<div class="form-group" id="contract_division_div">
											<label for="contract_division" class="control-label mb-10">Contract Division<span style="color: red;"> * :</span></label>
											<select class="form-control" name="contract_division" id="contract_division" disabled="true">
												<option value="">Select Contract Division</option>
											</select>
										</div>

										<div class="form-group" id="contract_type_div">
											<label for="contract_type" class="control-label mb-10">Contract Type<span style="color: red;"> * :</span></label>
											<select class="form-control" name="contract_type" id="contract_type" disabled="true">
												<option value="">Select Contract Type</option>
											</select>
										</div>									

										<div class="form-group" id="contract_sub_type1_div">
											<label for="contract_sub_type1" class="control-label mb-10">Contract Sub Type1<span style="color: red;"> * :</span></label>
											<select class="form-control" name="contract_sub_type1" id="contract_sub_type1" disabled="true">
												<option value="">Select Contract Sub Type1</option>
											</select>
										</div>		

										<div class="form-group" id="contract_sub_type2_div">
											<label for="contract_sub_type2" class="control-label mb-10">Contract Sub Type2<span style="color: red;"> * :</span></label>
											<select class="form-control" name="contract_sub_type2" id="contract_sub_type2" disabled="true">
												<option value="">Select Contract Sub Type2</option>
											</select>
										</div>	
										</div>												


								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default create-contract-close">Close</button>
									<button type="submit" class="btn btn-primary create-contract-submit">Create</button>
								</div>
							</form>

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
								<h5 class="modal-title">Delete Contract Registration</h5>
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
			
			get_contract_registration_list();

		});	



 		function get_contract_registration_list(action_status = ''){
            $.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Contract_Registeration_List',status : action_status },
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
                                <td>${response.data[i].CON_ID}</td>
                                <td>${response.data[i].Vendor_Name}</td>
                                <td>${response.data[i].Vendor_Type}</td>
                                <td>${response.data[i].Email}</td>
                                <td>${response.data[i].Mobile_No}</td> 
                                <td>${status}</td>                                 
                                <td>
                                	<div class="tbl_action_div">
                                    <a href="Contract_Registration.php?id=${ encodedId }&action=${btoa('view')}" class="text-inverse pr-10 tbl_action_view" title="View" data-toggle="tooltip" data-original-title="Edit">
                                		<i class="zmdi zmdi-eye txt-primary"></i>
                                	</a>`;


                                	html += `<a href="Contract_Registration.php?id=${ encodedId }" class="text-inverse pr-10 tbl_action_edit" title="Edit" data-toggle="tooltip" data-original-title="Edit">
                                		<i class="zmdi zmdi-edit txt-warning"></i>
                                	</a>`;
                            
                                	html += `<a href="javascript:void(0)" class="text-inverse delete_contract tbl_action_edit pr-10" title="Delete" data-toggle="tooltip" data-original-title="Delete" data-id="${response.data[i].Id}">
                                		<i class="zmdi zmdi-delete txt-danger"></i>
                                	</a>`;

                           		if(response.data[i].Form_Status == 'Submitted') {
                                  html += `<a href="javascript:void(0);" class="text-inverse pr-10 Contract_Template_View" title="Word Document" data-toggle="tooltip" data-original-title="Edit" data-conid="${response.data[i].CON_ID}" data-href="Contract_Template_View.php?con_id=${ response.data[i].CON_ID }">
                                  		<img src="images/word.png" style="width:20px;height:20px;">
                                	</a>`;
                                }                                  
                                html += `</div></td>                               
                            </tr>`;
                        }
                    }
                    $('#registration_list_tbl').DataTable().destroy();    
                    $('#registration_list_body').html(html);
					datatable('registration_list_tbl');
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
		    	formData.append('Action','Contract_Registeration_delete');

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

        $(document).on('click','.create_contract',function(){
        	$('#new-contract-modal').modal('show');
        });

        function contract_form_enable()
        {
        	$('#contract_division_div').show();
            $('#contract_division').attr('disabled',true);
            
            $('#contract_type_div').show();
            $('#contract_type').attr('disabled',true);
            
            $('#contract_sub_type1_div').show();
            $('#contract_sub_type1').attr('disabled',true);
            
            $('#contract_sub_type2_div').show();
            $('#contract_sub_type2').attr('disabled',true); 
        } 

        $(document).on('click','.create-contract-close',function(){
        	$('#create_contract_form')[0].reset();
        	$('#new-contract-modal').modal('hide');
        	contract_form_enable();
        });

        

         $(document).on('change','#contract_category',function(){
         	var contract_category = $(this).val();
         	get_contract_division(contract_category);
        });

        $(document).on('change','#contract_division',function(){
         	var contract_category = $('#contract_category').val();
         	var contract_division = $(this).val();
         	get_contract_type(contract_category,contract_division);
        });         

        $(document).on('change','#contract_type',function(){
         	var contract_category = $('#contract_category').val();
         	var contract_division = $('#contract_division').val();
         	var contract_type     = $(this).val();
         	get_contract_sub_type1(contract_category,contract_division,contract_type);
        }); 

        $(document).on('change','#contract_sub_type1',function(){
         	var contract_category = $('#contract_category').val();
         	var contract_division = $('#contract_division').val();
         	var contract_type     = $('#contract_type').val();
         	var contract_sub_type1= $(this).val();

         	get_contract_sub_type2(contract_category,contract_division,contract_type,contract_sub_type1);
        });                 

         function get_contract_division(contract_category)
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Get_contract_basic_details',contract_category : contract_category },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    var division_select = type_select = sub_type1_select = sub_type2_select = '';
		        	$('#contract_division_div').show();
		            $('#contract_division').attr('disabled',false);

                    if(response.data.length > 0) {   

                        for(i in response.data) {

                        	if(response.data[i].Contract_Division !== null) {
                        		if(i == 0) {
									division_select += `<option value="">Select Contract Division</option>`;
                        		}                         		

                        		var division_text = response.data[i].Contract_Division; 
                        		if(division_text == 'CT01') {
                        			division_text = 'Cotton';
                        		} else if(response.data[i].Contract_Division == 'FC01') {
                        			division_text = 'Field Crop';
                        		} else if(response.data[i].Contract_Division == 'FR01') {
                        			division_text = 'Forage';
                        		} 

                        		division_select += `<option value="${response.data[i].Contract_Division}">${division_text}</option>`;
                        	}                         	                      	
                        }

                        if(division_select != '') {
                        	$('#contract_division').html(division_select);
                   			get_contract_type(contract_category,response.data[i].Contract_Division);
                        } else {
                        	$('#contract_division_div').hide();
                   			$('#contract_division').attr('disabled',true);
                   			get_contract_type(contract_category);
                        }                                              

                    } else {
                        $('#contract_division_div').hide();
                   		$('#contract_division').attr('disabled',true);	
                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
         }


         function get_contract_type(contract_category,contract_division = '')
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Get_contract_basic_details',contract_category : contract_category,contract_division : contract_division },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    var division_select = type_select = sub_type1_select = sub_type2_select = '';
		            $('#contract_type_div').show();
		            $('#contract_type').attr('disabled',false);

                    if(response.data.length > 0) {   

                        for(i in response.data) {

                        	if(response.data[i].Contract_Type !== null) {
                        		if(i == 0) {
									type_select += `<option value="">Select Contract Type</option>`;
                        		} 

                        		type_select += `<option value="${response.data[i].Contract_Type}">${response.data[i].Contract_Type}</option>`;
                        	}                        	                      	

                        }

                        if(type_select != '') {
                        	$('#contract_type').html(type_select);
		                    get_contract_sub_type1(contract_category,contract_division,response.data[i].Contract_Type);
                        } else {
                        	$('#contract_type_div').hide();
		                    $('#contract_type').attr('disabled',true);
                        }                                             

                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
         }


         function get_contract_sub_type1(contract_category,contract_division = '',contract_type = '')
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Get_contract_basic_details',contract_category : contract_category,contract_division : contract_division,contract_type : contract_type },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    var division_select = type_select = sub_type1_select = sub_type2_select = '';
            		$('#contract_sub_type1_div').show();
            		$('#contract_sub_type1').attr('disabled',false);

                    if(response.data.length > 0) {   

                        for(i in response.data) {

                        	if(response.data[i].Contract_Sub_Type1 !== null) {
                        		if(i == 0) {
									sub_type1_select += `<option value="">Select Contract Sub Type1</option>`;
                        		}                        		
                        		sub_type1_select += `<option value="${response.data[i].Contract_Sub_Type1}">${response.data[i].Contract_Sub_Type1}</option>`;
                        	}  
                        }

                        if(sub_type1_select != '') {
                        	$('#contract_sub_type1').html(sub_type1_select);
                        	get_contract_sub_type2(contract_category,contract_division,contract_type,response.data[i].Contract_Sub_Type1);
                        } else {
                        	$('#contract_sub_type1_div').hide();
		                    $('#contract_sub_type1').attr('disabled',true);

		                    $('#contract_sub_type2_div').hide();
		                    $('#contract_sub_type2').attr('disabled',true);
                        }                                                

                    } else {
                        	$('#contract_sub_type1_div').hide();
		                    $('#contract_sub_type1').attr('disabled',true);

		                    $('#contract_sub_type2_div').hide();
		                    $('#contract_sub_type2').attr('disabled',true);                    	
                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
         }

        function get_contract_sub_type2(contract_category,contract_division = '',contract_type = '',contract_sub_type1 = '')
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'Get_contract_basic_details',contract_category : contract_category,contract_division : contract_division,contract_type : contract_type,contract_sub_type1 : contract_sub_type1 },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    var sub_type2_select = '';
		            $('#contract_sub_type2_div').show();
		            $('#contract_sub_type2').attr('disabled',false); 

                    if(response.data.length > 0) {   

                        for(i in response.data) {

                        	if(response.data[i].Contract_Sub_Type2 !== null) {
                        		if(i == 0) {
									sub_type2_select += `<option value="">Select Contract Sub Type2</option>`;
                        		}
                        		
                        		sub_type2_select += `<option value="${response.data[i].Contract_Sub_Type2}">${response.data[i].Contract_Sub_Type2}</option>`;
                        	}                          	                      	

                        }
 
                        
                        if(sub_type2_select != '') {
                        	$('#contract_sub_type2').html(sub_type2_select);
                        } else {
                        	$('#contract_sub_type2_div').hide();
		                    $('#contract_sub_type2').attr('disabled',true);                        	
                        }                                                

                    } else {
                	    $('#contract_sub_type2_div').hide();
	                    $('#contract_sub_type2').attr('disabled',true);    
                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
         }


		$(document).on('submit','#create_contract_form',function(event) {
            // Prevent form submission initially to check validation
            event.preventDefault();

            // Check if all required fields are filled
            let isValid = true;

            // Check Contract Category
            if ($('#contract_category').is(':enabled') && $('#contract_category').val() === "") {
                isValid = false;
	    		alert_msg('warning','Warning!','Please select contract category.');
                return false;
            }

            // Check Contract Division
            if ($('#contract_division').is(':enabled') && $('#contract_division').val() === "") {
                isValid = false;
	    		alert_msg('warning','Warning!','Please select contract division.');
                return false;
            }

            // Check Contract Type
            if ($('#contract_type').is(':enabled') && $('#contract_type').val() === "") {
                isValid = false;
	    		alert_msg('warning','Warning!','Please select contract type.');
                return false;
            }

            // Check Contract Sub Type1
            if ($('#contract_sub_type1').is(':enabled') && $('#contract_sub_type1').val() === "") {
                isValid = false;
	    		alert_msg('warning','Warning!','Please select contract sub type1.');
                return false;
            }

            // Check Contract Sub Type2
            if ($('#contract_sub_type2').is(':enabled') && $('#contract_sub_type2').val() === "") {
                isValid = false;
	    		alert_msg('warning','Warning!','Please select contract sub type2.');
                return false;
            }

            // If all fields are valid, submit the form
            if (isValid) {
                // Submit the form
                this.submit();  // This triggers the form submission
            }
        });

        $(document).on('click','.Contract_Template_View',function(){
        	var con_id = $(this).data('conid');
        	var href   = $(this).data('href');

        	$.ajax({
                url: 'word_writter.php',
                type: 'POST',
                data: { con_id : con_id },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
               		if(response.status == 200) {
               			setTimeout(function(){
                			hideLoader()
               				location.href = href;
               			},3000);
               		} else {
               			hideLoader()
           				Swal.fire({
							icon: "error",
							title: "Error!",
							text: response.message,
							confirmButtonText: "OK"
						});
               		}	
                }

            });
        });

	</script>