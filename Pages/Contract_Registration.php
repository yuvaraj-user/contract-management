<?php include "Header.php";?>

<style type="text/css">
	.wizard .steps ul > li  {
		width: 50%;
	}
</style>


<?php include "Topbar.php" ?>		

<?php include "Sidemenu.php" ?>	

	<!-- Main Content -->
	<div class="page-wrapper">
		<div class="container-fluid">

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <?php $page_type = !isset($_GET['id']) ? 'Create' : ((isset($_GET['id']) && isset($_GET['action'])) ? 'View' : 'Edit') ?>
					  <h5 class="txt-dark"><?= $page_type; ?> Contract Registration</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><span><a href="Contract_Registration_List.php">Contract Registration List</a></span></li>
						<li class="active"><span><?= $page_type; ?> Contract Registration</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
			
		
			
			<!-- Row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-12">
									<?php if($page_type == 'Create') { ?>
										<div class="basic_details flat">
											<?php if(isset($_POST['contract_category'])) { ?>
											 <a href="javascript:void(0);" class="active" id="contract_category_badge"><?= $_POST['contract_category'] ?></a>
											<?php } ?>
											<?php if(isset($_POST['contract_division'])) { 
												$badge_division_text = ($_POST['contract_division'] == 'CT01') ? 'Cotton' : (($_POST['contract_division'] == 'FC01') ? 'Field Crop' : (($_POST['contract_division'] == 'FR01') ? 'Forage' : $_POST['contract_division'])); 
											?>
											 <a href="javascript:void(0);" class="active" id="contract_division_badge"><?= $badge_division_text ?></a>
											<?php } ?>
											<?php if(isset($_POST['contract_type'])) { ?>
											 <a href="javascript:void(0);" class="active" id="contract_type_badge"><?= $_POST['contract_type'] ?></a>
											<?php } ?>
											<?php if(isset($_POST['contract_sub_type1'])) { ?>
											 <a href="javascript:void(0);" class="active" id="contract_sub_type1_badge"><?= $_POST['contract_sub_type1'] ?></a>
											<?php } ?>
											<?php if(isset($_POST['contract_sub_type2'])) { ?>
											 <a href="javascript:void(0);" class="active" id="contract_sub_type2_badge"><?= $_POST['contract_sub_type2'] ?></a>
											<?php } ?>											 
		   								</div>
	   								<?php } else { ?>
										<div class="basic_details flat">
											 <a href="javascript:void(0);" class="active" id="contract_category_badge"></a>
											 <a href="javascript:void(0);" class="active" id="contract_division_badge"></a>
											 <a href="javascript:void(0);" class="active" id="contract_type_badge"></a>
											 <a href="javascript:void(0);" class="active" id="contract_sub_type1_badge"></a>
											 <a href="javascript:void(0);" class="active" id="contract_sub_type2_badge"></a>
		   								</div>	   									
	   								<?php } ?> 

								</div>
																										
							</div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<form id="example-advanced-form" action="#">
									<input type="hidden" name="Action" value="Contract_Register_Save">
									<input type="hidden" name="contract_id" id="contract_id" value="">
									<input type="hidden" name="page_type" id="page_type" value="<?= $page_type; ?>">

									<!-- append data from the previous form -->
									<input type="hidden" name="contract_category" id="contract_category" value="<?= isset($_POST['contract_category']) ? $_POST['contract_category'] : ''; ?>">
									<input type="hidden" name="contract_division" id="contract_division" value="<?= isset($_POST['contract_division']) ? $_POST['contract_division'] : ''; ?>">
									<input type="hidden" name="contract_type" id="contract_type" value="<?= isset($_POST['contract_type']) ? $_POST['contract_type'] : ''; ?>">
									<input type="hidden" name="contract_sub_type1" id="contract_sub_type1" value="<?= isset($_POST['contract_sub_type1']) ? $_POST['contract_sub_type1'] : ''; ?>">
									<input type="hidden" name="contract_sub_type2" id="contract_sub_type2" value="<?= isset($_POST['contract_sub_type2']) ? $_POST['contract_sub_type2'] : ''; ?>">									

									<h3><span class="number"><i class="fa-solid fa-file-signature txt-black"></i></span><span class="head-font capitalize-font">BASE DETAILS</span></h3>
									<fieldset>
										<div class="row">
											<!-- Company section -->
											<div class="col-sm-6">
												<div class="row">
													<div class="col-md-6 col-xs-12 mb-10">
														<label class="control-label mb-10" for="CON_ID">CON ID:</label>
														<input id="CON_ID" type="text" name="CON_ID" class="form-control required readonly_field" value="<?php echo Generate_Contract_No($conn); ?>" readonly/>
													</div>
													<div class="col-md-6 col-xs-12 mb-10">
														<label class="control-label mb-10" for="contract_date">CONTRACT DATE:</label>
														<input id="contract_date" type="text" name="contract_date" class="form-control required readonly_field" value="<?php echo date('d-m-Y'); ?>" readonly/>
													</div>													
													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="company_name">COMPANY NAME: <span style="color: red;">*:</span></label>
														<!-- <input id="company_name" type="text" name="company_name" class="form-control required" value="" /> -->
														<select id="company_name" class="form-control select2" name="company_name">
															<option value="">SELECT</option>
														</select>														
													</div>	

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="company_address">ADDRESS <span style="color: red;">*:</span>:</label>
														<textarea id="company_address" name="company_address" class="form-control required" readonly></textarea>
													</div>


													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="company_pan">Location <span style="color: red;">*</span>:</label>
														<input id="company_location" type="text" name="company_location" class="form-control required" value="" readonly/>
													</div>													

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="company_pan">PAN NUM <span style="color: red;">*</span>:</label>
														<input id="company_pan" type="text" name="company_pan" class="form-control required" value="" maxlength="10" readonly/>
													</div>	

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="company_cin">CIN NUMBER <span style="color: red;">*</span>:</label>
														<input id="company_cin" type="text" name="company_cin" class="form-control required" value="" maxlength="21" readonly/>
													</div>	

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="company_gst">GST NUMBER <span style="color: red;">*</span>:</label>
														<input id="company_gst" type="text" name="company_gst" class="form-control required" value="" maxlength="15" readonly/>
													</div>														

													<div class="col-md-5 col-xs-12 mb-10">
														<label class="control-label mb-10 text-left">CONTRACT PERIOD <span style="color: red;">*</span>:</label>
														<input class="form-control contract_period mb-10 required" type="text" name="contract_period" value="<?= date('01-m-Y').' to '.date('t-m-Y')  ?>"/>
													</div>

													<div class="col-md-7 col-xs-12 mb-10">
														<label class="control-label mb-10" for="contract_security_deposit_amt">CONTRACT SECURITY DEPOSIT AMOUNT <span style="color: red;">*</span>:</label>
														<input id="contract_security_deposit_amt" type="text" name="contract_security_deposit_amt" class="form-control mb-10 required" value="" onkeypress="return isNumber(event)" placeholder="Ex:50000" />
													</div>		

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_registration_id">COMPANY REPRESENTOR:</label>
														<select id="representor_id" class="form-control select2" name="representor_id">
															<option value="">SELECT</option>
														</select>
													</div>		

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="contract_date">COMPANY REPRESENTOR DESIGNATION:</label>
														<input id="representor_designation" type="text" name="representor_designation" class="form-control required readonly_field" value="" readonly/>
													</div>


												</div>
											</div>

											<!-- Vendor section -->
											<div class="col-sm-6">
												<div class="row">
													<div class="col-md-12 col-xs-12 mb-10">
														<div class="form-group">

														<label class="control-label mb-10" for="vendor_registration_id">VENDORS:</label>
														<select id="vendor_registration_id" class="form-control select2" name="vendor_registration_id">
															<option value="">SELECT</option>
															<option value="MICRO">MICRO</option>
															<option value="SMALL">SMALL</option>
															<option value="COMPANY">MEDIUM ENTERPRISES</option>
														</select>
													</div>

													</div>

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_name">VENDOR NAME: <span style="color: red;">*:</span></label>
														<input id="vendor_name" type="text" name="vendor_name" class="form-control required" value="" readonly/>
													</div>

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_name">VENDOR FATHER NAME: <span style="color: red;">*:</span></label>
														<input id="vendor_father_name" type="text" name="vendor_father_name" class="form-control required" value="" readonly/>
													</div>																												
													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_pan">VENDOR PAN NUMBER<span style="color: red;">*:</span>:</label>
														<input id="vendor_pan" type="text" name="vendor_pan" class="form-control required" value="" maxlength="10" readonly />
													</div>	

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_cin">VENDOR CIN NUMBER</label>
														<input id="vendor_cin" type="text" name="vendor_cin" class="form-control" value="" maxlength="21" readonly/>
													</div>	

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_aadhar">AADHAR NUMBER: </label>
														<input id="vendor_aadhar" type="text" name="vendor_aadhar" class="form-control" value="" onkeypress="return isNumber(event)" maxlength="12" readonly/>
													</div>													

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="vendor_address">VENDOR ADDRESS <span style="color: red;">*:</span>:</label>
														<textarea id="vendor_address" name="vendor_address" class="form-control required" readonly></textarea>
													</div>

													<div class="col-md-12 col-xs-12 mb-10">
														<label class="control-label mb-10" for="owner_address">OWNER/LESSEE ADDRESS (VENDOR)<span style="color: red;">*</span>:</label>
														<textarea id="owner_address" name="owner_address" class="form-control required" readonly></textarea>
													</div>

												</div>
											</div>											
										</div>


										<div class="col-md-12 manual_pagination_div">
											<div>
												<button type="button" class="btn btn-info save_btn"><i class="fa-solid fa-floppy-disk"></i> Save</button>
											</div>												
										</div>
									</fieldset>

									<h3><span class="number"><i class="fa-solid fa-images txt-black"></i></span><span class="head-font capitalize-font">DOCUMENT ATTACHMENT</span></h3>
									<fieldset>
										<div class="row">
										<div class="col-sm-12">
											<div class="row mb-2rem">

												<div class="col-md-3">
														<p class="text-success">SCHEDULE1 DOCUMENT</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom1">
																<input name="Schedule1_Doc_file_name" type="hidden" id="my-dropzone-custom1-file-name"/>

																<input name="Schedule1_Doc" type="file" style="display:none;" id="Schedule1_Doc"/>
															</div>
														</div>
												</div>

												<div class="col-md-3">
														<p class="text-success">SCHEDULE2 DOCUMENT</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom2">
																<input name="Schedule2_Doc_file_name" type="hidden" id="my-dropzone-custom2-file-name"/>

																<input name="Schedule2_Doc" type="file" style="display:none;" id="Schedule2_Doc"/>
															</div>
														</div>
												</div>	

												<div class="col-md-3">
														<p class="text-success">SCHEDULE3 DOCUMENT</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom3">
																<input name="Schedule3_Doc_file_name" type="hidden" id="my-dropzone-custom3-file-name"/>

																<input name="Schedule3_Doc" type="file" style="display:none;" id="Schedule3_Doc"/>
															</div>
														</div>
												</div>


												<div class="col-md-3">
														<p class="text-success">ANNEXURE DOCUMENT</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom4">
																<input name="Annexure_Doc_file_name" type="hidden" id="my-dropzone-custom4-file-name"/>

																<input name="Annexure_Doc" type="file"  style="display:none;" id="Annexure_Doc"/>
															</div>
														</div>
												</div>												

											</div>
				

										</div>
										</div>

										<div class="col-md-12 manual_pagination_div">
											<div>
												<button type="button" class="btn btn-info save_btn"><i class="fa-solid fa-floppy-disk"></i> Save</button>
											</div>												
										</div>														
									</fieldset>																										

								</form>


									<!-- send backed or reject remark -->
									<div class="row remark_row">
										<div class="col-md-6 ml-auto">
											<div class="form-group">
												<label class="control-label mb-10" for="Remarks_Display" id="Remarks_Display_Label"></label>
												<textarea class="form-control" cols="10" id="Remarks_Display"></textarea>
											</div>
										</div>															
									</div>	


							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Row -->
			
		</div>

         <!-- file preview modal -->
		<div class="modal fade in" id="file_preview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="row">
						<div class="col-md-6">
							<h5 class="modal-title" id="exampleModalLabel1">File Preview</h5>
						</div>
						
						<div class="col-md-5 text-right">
							<button class="btn btn-sm btn-info" onclick="reloadIframe();"><i class="fa-solid fa-arrows-rotate"></i> Reload</button>
							<a href="" download id="file-preview-modal-download"><button class="btn btn-sm btn-success"><i class="fa-solid fa-download"></i> Download</button></a>							
						</div>

						<div class="col-md-1">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="file_preview_modal_close"><span aria-hidden="true">×</span></button>
						</div>
						

						</div>

					</div>
					<div class="modal-body">
						<div class="preview_file_section">

	                  	</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

        <!-- file preview modal end -->
		
	<!-- Footer -->
	<?php include "Footer.php" ?>
	<!-- /Footer -->
		
	</div>
	<!-- /Main Content -->


	<?php include "Bottom_Script.php" ?>


	<script>

		function initialize_dropzone(dropzone_element_id,hidden_input_element,existing_file_path = '',existing_file_name = '')
		{
			// First, check if Dropzone is already initialized on the element and destroy it
		   if ($(dropzone_element_id).hasClass('dz-clickable')) {
		        // Destroy the previous instance if it exists
		        var existingDropzone = Dropzone.forElement(dropzone_element_id);
		        if (existingDropzone) {
		            existingDropzone.destroy();
		        }
		    }

			const myDropzone = new Dropzone(dropzone_element_id, {
				addRemoveLinks: true,
				maxFiles:1,
				dictResponseError: 'Server not Configured',
				acceptedFiles: ".pdf",
    			success: function(file, response){
			        // Create a DataTransfer object
			        const dataTransfer = new DataTransfer();

			        // Add the uploaded file to the DataTransfer object
			        dataTransfer.items.add(file);

			        // Assign DataTransfer files to the file input
			        $(hidden_input_element)[0].files = dataTransfer.files;

					setTimeout(function() {
						var view_btn = `<a class="document-view" data-action="uploaded" data-filepath="${URL.createObjectURL(file)}" data-from='${dropzone_element_id}'>View</a>`;
				        $(dropzone_element_id).children('.dz-preview').append(view_btn);
					},100);			        
    			},
    			removedfile:function(file) {
    				// remove all files from the dropzone 
			        this.removeAllFiles();

			        // clear the preview of the dropzone 
			        $(dropzone_element_id).find('.dz-preview').remove();

			        // remove the file from the hidden input
			        $(hidden_input_element).val('');

    			},				
				init: function() {
				      this.on("maxfilesexceeded", function(file) {
				            this.removeAllFiles();
				            this.addFile(file);
				      });


					this.on("removedfile", function(file) {
						// file remove from the hidden input 
						$(dropzone_element_id).children(dropzone_element_id+'-file-name').val('');
			            // console.log("File removed from:", dropzone_element_id);
			        });

					setTimeout(function() {
						if(existing_file_name != '') {
							var view_btn = `<a class="document-view" data-action="edit" data-filepath="${existing_file_path}" data-from='${dropzone_element_id}'>View</a>`;
					        $(dropzone_element_id).children('.dz-preview').append(view_btn);
						}
					},100);
				}
			});



			if(existing_file_path != '' && existing_file_name != '') {
				// extract extension from file 
				var file_extension = existing_file_name.split('.')[1];

				// Path to the image on the server (e.g., after the upload is successful)
				const filePath = existing_file_path+'/'+existing_file_name;

				// Manually add the file to the Dropzone instance using the addFile method
				const mockFile = { 
				    name: existing_file_name, // File name
				    // size: '', // You can use the actual file size if available (this is just an example)
				    status: Dropzone.ADDED // Required to set the status
				};

				// Add the file to Dropzone and create the preview
				myDropzone.emit("addedfile", mockFile);

				if(file_extension != 'pdf') {
					// Set the thumbnail for the file
					myDropzone.emit("thumbnail", mockFile, filePath);
				}

				// Optionally, if you want to mark the file as uploaded
				myDropzone.emit("complete", mockFile);
			}



			return myDropzone;
		}

		function datepicker(classname)
		{
			$('.'+classname).daterangepicker({
	  			buttonClasses: ['btn', 'btn-sm'],
				applyClass: 'btn-info',
				cancelClass: 'btn-default',
		        autoUpdateInput: false,
		        locale: {
		          format: 'DD-MM-YYYY',
		          separator: " to ",
		          cancelLabel: 'Clear'
		        }
			}, function(start, end, label) {
			      // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

			      var date = start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY');
			      $('.'+classname).val(date);
			});
		}


		$(document).ready(function(){
            var url_string = window.location.href; 
            var url = new URL(url_string);
            var decodedid = url.searchParams.get("id");
            var id = atob(decodedid);
            var action = atob(url.searchParams.get("action"));

            //hide remark row
			$('.remark_row').hide();

			$('.select2').select2();

			initialize_dropzone("#my-dropzone-custom1","#Schedule1_Doc");	
			initialize_dropzone("#my-dropzone-custom2","#Schedule2_Doc");			
			initialize_dropzone("#my-dropzone-custom3","#Schedule3_Doc");			
			initialize_dropzone("#my-dropzone-custom4","#Annexure_Doc");				

			get_approved_vendors();
			get_representors();	
			get_company_details();			

			if(decodedid != null) {
            	get_registered_details(id,action);				
			}


			// daterange picker call
			datepicker('contract_period');	

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

		// Function to validate PAN number
		function validatePAN(pan) {
		    const panRegex = /^[A-Z]{5}[0-9]{4}[a-zA-Z]{1}$/;
		    return panRegex.test(pan);
		}

		// Function to validate Aadhar number
		function validateAadhar(aadhar) {
		    const aadharRegex = /^\d{12}$/;
		    return aadharRegex.test(aadhar);
		}	

		function form_validation()
		{
			var is_valid = false;
			var Pan_No = $('#company_pan').val();
	    	var gst_num = $('#gstnum').val();
	    	var cin_num = $('#company_cin').val();
	    	var contract_category = $('#contract_category').val();
	    	var contract_type = $('#contract_type').val();

	    	if(Pan_No == '') {
	    		alert_msg('warning','Warning!','Pan number is mandatory.');
	    		$('#pannum').addClass('error');
	    	} else if(Pan_No != '' && !validatePAN(Pan_No)) {
		    	alert_msg('warning','Warning!','PAN number format is invalid.');
	    		$('#pannum').addClass('error');
	    	} else if(cin_num != '' && cin_num.length < 15) {
	    		alert_msg('warning','Warning!','CIN number must be 21 digits.');
	    		$('#cinnum').addClass('error');
	    	} else if(contract_category == '') {
	    		alert_msg('warning','Warning!','Contract category is mandatory');
	    	} else if(contract_type == '') {
	    		alert_msg('warning','Warning!','Contract type is mandatory');
	    	} else {
	    		is_valid = true;
	    	}

	    	return is_valid;

		}	 

	    $(document).on("click",".save_btn",function() {
	    	var form_is_valid = form_validation();

	    	if(form_is_valid) {
		    	var form = $('#example-advanced-form');
		    	var formData = new FormData(form[0]);
		    	formData.append('from','save');
		    	Contract_Register(formData,'save');
	    	}

	    });

	    $(document).on("click","a[href='#finish']",function() {
	    	var form_is_valid = form_validation();

	    	if(form_is_valid) {
				var form = $('#example-advanced-form');
		    	var formData = new FormData(form[0]);
		    	formData.append('from','submit');
		    	Contract_Register(formData,'submit');
		    }
	    });	    

	    function Contract_Register(formData,call_from = '')
	    {
    		$.ajax({
				url: 'Common_Ajax.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
	            beforeSend: function(){
	                showLoader();
	            },				
				success: function(response) {
					if (response.status == 200) {
						if(call_from == 'save') {
							$('#contract_id').val(response.Inserted_ID);
							Swal.fire({
								icon: "success",
								title: "Success!",
								text: response.message,
								confirmButtonText: "OK"
							});
						} else {
							Swal.fire({
								icon: "success",
								title: "Success!",
								text: response.message,
								confirmButtonText: "OK"
							}).then(function(isconfirmed){
								if(isconfirmed) {
									location.href = "Contract_Registration_List.php";
								}
							});							
						}

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
				},
	            complete: function(){
	                hideLoader();
	            }
			});
	    }

	    function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

	    // Edit functionality
	    function get_registered_details(id,action)
	    {
	        $.ajax({
	            url: 'Common_Ajax.php',
	            type: 'POST',
	            data: { Action : 'Contract_Registeration_List',id : id },
	            dataType: "json",
	            beforeSend: function(){
	                showLoader();
	            },
	            success: function(response) {

	                $('#contract_id').val(response.data[0].Id);

	                $('#CON_ID').val(response.data[0].CON_ID);
	                $('#company_name').val(response.data[0].Company_Name);
	                $('#company_address').val(response.data[0].Company_Address);
	                $('#company_pan').val(response.data[0].Company_Pan_No);
	                $('#company_cin').val(response.data[0].Company_CIN_No);
	                $('#contract_date').val(response.data[0].Contract_Date);
	                $('#company_location').val(response.data[0].Company_Location);
	                $('#company_gst').val(response.data[0].Company_GST_No);


	                $('#representor_designation').val(response.data[0].Company_Representor_Designation);

		            get_approved_vendors('','all_vendor',response.data[0].VENDOR_REG_ID);
					get_representors(response.data[0].Company_Representor_Empcode);
					get_company_details('','all_company',response.data[0].Company_Name);


	                $('#vendor_name').val(response.data[0].Vendor_Name);
	                $('#vendor_father_name').val(response.data[0].Father_Name);
	                $('#vendor_pan').val(response.data[0].Pan_No);
	                $('#vendor_cin').val(response.data[0].CIN_No);
	                $('#vendor_aadhar').val(response.data[0].Aadhar_No);
	                $('#vendor_address').val(response.data[0].Address);
	                $('#owner_address').val(response.data[0].Owner_Address);


	                $('#contract_category').val(response.data[0].Contract_Category);
	                $('#contract_division').val(response.data[0].Contract_Division);
	                $('#contract_type').val(response.data[0].Contract_Type);
	                $('#contract_sub_type1').val(response.data[0].Contract_Sub_Type1);
	                $('#contract_sub_type2').val(response.data[0].Contract_Sub_Type2);

	                if(response.data[0].Contract_Period_From_Date != '' && response.data[0].Contract_Period_To_Date != '') {
		                //contract period daterange value format set
		                var contract_period_date = response.data[0].Contract_Period_From_Date+' to '+response.data[0].Contract_Period_To_Date;

		                $('.contract_period').val(contract_period_date);
	                }
		            
		            $('#contract_security_deposit_amt').val(response.data[0].Contract_Security_Deposit_Amount);


	                var division = (response.data[0].Contract_Division ==  'CT01') ? 'Cotton' : ((response.data[0].Contract_Division ==  'FC01') ? 'Field Crop' : ((response.data[0].Contract_Division ==  'FR01') ? 'Forage' : response.data[0].Contract_Division));

	                $('#contract_category_badge').text(response.data[0].Contract_Category);
	                $('#contract_division_badge').text(division);
	                $('#contract_type_badge').text(response.data[0].Contract_Type);
	                $('#contract_sub_type1_badge').text(response.data[0].Contract_Sub_Type1);
	                $('#contract_sub_type2_badge').text(response.data[0].Contract_Sub_Type2);


	                $('#my-dropzone-custom1-file-name').val(response.data[0].Schedule1_Doc);
	                $('#my-dropzone-custom2-file-name').val(response.data[0].Schedule2_Doc);
	                $('#my-dropzone-custom3-file-name').val(response.data[0].Schedule3_Doc);
	                $('#my-dropzone-custom4-file-name').val(response.data[0].Annexure_Doc);


	                if(response.data[0].Contract_Division == '' || response.data[0].Contract_Division == null) {
		                $('#contract_division_badge').hide();
	                }
	                if(response.data[0].Contract_Sub_Type1 == '' || response.data[0].Contract_Sub_Type1 == null) {
		                $('#contract_sub_type1_badge').hide();
	                }
	                if(response.data[0].Contract_Sub_Type2 == '' || response.data[0].Contract_Sub_Type2 == null) {
		                $('#contract_sub_type2_badge').hide();
	                }	 	    

	                $('.remark_row').hide();
	                // Remarks display for sendback and reject view page 
                	if(response.data[0].Form_Status == 'Sendback'  && action == 'view') {
	                	$('#Remarks_Display').text(response.data[0].L1_Sendback_Remarks);
	                	$('#Remarks_Display_Label').text('L1 Send Back Remark:');
	                	$('#Remarks_Display').attr('disabled',true);
						$('.remark_row').show();
	                    $('.manual_pagination_div').hide();

                	} else if(response.data[0].Form_Status == 'Reject'  && action == 'view') {
	                	$('#Remarks_Display').text(response.data[0].L1_Sendback_Remarks);
	                	$('#Remarks_Display_Label').text('L1 Rejected Remark:');	 
	                	$('#Remarks_Display').attr('disabled',true);
						$('.remark_row').show();
	                    $('.manual_pagination_div').hide();                		                		                	               		
                	}	                            	                

	                // destroy all dropzones
					Dropzone.instances.forEach(function(dropzoneInstance) {
        				dropzoneInstance.destroy();
    				});

	               	var folder_name = response.data[0].CON_ID;
	               	folder_name     = folder_name.replaceAll('/','-');

					var file_path = "uploads/contract_registration/"+folder_name;

					initialize_dropzone("#my-dropzone-custom1","#Schedule1_Doc",file_path,response.data[0].Schedule1_Doc);	
					initialize_dropzone("#my-dropzone-custom2","#Schedule2_Doc",file_path,response.data[0].Schedule2_Doc);			
					initialize_dropzone("#my-dropzone-custom3","#Schedule3_Doc",file_path,response.data[0].Schedule3_Doc);			
					initialize_dropzone("#my-dropzone-custom4","#Annexure_Doc",file_path,response.data[0].Annexure_Doc);

	
	                if(action == 'view') {

	                    $('.manual_pagination_div').hide();
	                
		                $('#company_name').attr('disabled',true);
		                $('#company_address').attr('disabled',true);
		                $('#company_pan').attr('disabled',true);
		                $('#company_cin').attr('disabled',true);
		                $('#contract_date').attr('disabled',true);
		                $('#representor_id').attr('disabled',true);
		                $('#representor_designation').attr('disabled',true);
		                $('#vendor_registration_id').attr('disabled',true);
		                $('.contract_period').attr('disabled',true);
		                $('#contract_security_deposit_amt').attr('disabled',true);


		                // select2 readonly
		                $('#select2-vendor_registration_id-container').addClass('readonly_field');

	                   // $('.submit_section').hide();
		                $('a[href="#finish"]').hide();

	                }
	            },
	            complete: function(){
	                hideLoader();
	            }
	        }); 
	    }

	    $(document).on('change','#vendor_registration_id',function(){
	    	var vendor_reg_id = $(this).val();
	    	get_approved_vendors(vendor_reg_id,'single_vendor');

	    });

	    $(document).on('change','#representor_id',function(){
	    	var designation = $(this).find('option:selected').data('designation');
	    	$('#representor_designation').val(designation);

	    });
         function get_approved_vendors(vendor_reg_id = '',action = 'all_vendor',selected_value = '')
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'get_approved_vendors',vendor_reg_id : vendor_reg_id },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    if(response.data.length > 0) {   

                    	if(action == 'all_vendor') {

                    		let selected = '';

	                    	html = '<option value="">SELECT</option>';

	                        for(i in response.data) {
	                    		if(selected_value != '' && response.data[i].REG_ID == selected_value) {
									selected = 'selected';
	                    		}

	                        	html += `<option value="${response.data[i].REG_ID}" ${selected}>${response.data[i].Pan_No} - ${response.data[i].Vendor_Name}</option>`;

								selected = '';

	                        }          
							$('#vendor_registration_id').select2('destroy');

	                       	$('#vendor_registration_id').html(html); 
							$('#vendor_registration_id').select2();


	                       } else {
	                       		$('#vendor_name').val(response.data[0].Vendor_Name);
	                       		$('#vendor_father_name').val(response.data[0].Father_Name);
	                       		$('#vendor_pan').val(response.data[0].Pan_No);
	                       		$('#vendor_cin').val(response.data[0].CIN_No);
	                       		$('#vendor_aadhar').val(response.data[0].Aadhar_No);
	                       		$('#vendor_address').val(response.data[0].Address);
	                       		$('#owner_address').val(response.data[0].Owner_Address);

	                       }
                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
         }


         function get_representors(selected_value = '')
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'get_representors' },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    if(response.data.length > 0) {   
	                	html = '<option value="" data-designation="">SELECT</option>';
                    	let selected = '';

	                    for(i in response.data) {
                    		if(selected_value != '' && response.data[i].Employee_Code == selected_value) {
								selected = 'selected';
                    		}

	                    	html += `<option data-designation="${response.data[i].Designation}" value="${response.data[i].Employee_Code}" ${selected}>${response.data[i].Employee_Name} - ${response.data[i].Department}</option>`;

							selected = '';

	                    }                         

						$('#representor_id').select2('destroy');
	                   	$('#representor_id').html(html);
						$('#representor_id').select2();

                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
        }

        function get_company_details(company_name ='',action = 'all_company',selected_value = '')
         {
         	$.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                data: { Action : 'get_company_details',company_name : company_name },
                dataType: "json",
                beforeSend: function(){
                    showLoader();
                },
                success: function(response) {
                    if(response.data.length > 0) {

                    	if(action == 'all_company') {

		                	html = '<option value="">SELECT</option>';
	                    	let selected = '';

		                    for(i in response.data) {
	                    		if(selected_value != '' && response.data[i].Company_Name == selected_value) {
									selected = 'selected';
	                    		}

		                    	html += `<option value="${response.data[i].Company_Name}" ${selected}>${response.data[i].Company_Name} - ${response.data[i].Company_Location}</option>`;

								selected = '';

		                    }                         

							$('#company_name').select2('destroy');
		                   	$('#company_name').html(html);
							$('#company_name').select2();
						} else {
							$('#company_address').html(response.data[0].Company_Address);
							$('#company_pan').val(response.data[0].Company_PAN_No);
							$('#company_cin').val(response.data[0].Company_CIN_No);
							$('#company_gst').val(response.data[0].Company_GST_No);
							$('#company_location').val(response.data[0].Company_Location);
						}

                    }
                },
                complete: function(){
                    hideLoader();
                },                
            });
        } 


	    $(document).on('change','#company_name',function(){
	    	var company_name = $(this).val();
	    	get_company_details(company_name,'single_company');
	    });


	  	$(document).on('click','.document-view',function(){
	    	var FromID = $(this).data('from');
	    	var file_path = $(this).data('filepath');
	    	var file_name = $(FromID+'-file-name').val();
	    	var action = $(this).data('action');

	    	if(action == 'edit') {
		    	var final_file_path = file_path+'/'+file_name;
		    	var iframe_path = `https://docs.google.com/viewer?url=https://devcorporate.rasiseeds.com/corporate/ContractManagement/pages/${final_file_path}&embedded=true`;

		    	var iframe = `<iframe id="preview_file_pdf" src="${iframe_path}" style="width: 100%;height: 900px;display: block;" frameborder="0"></iframe>`;
	    	} else {
		    	var iframe_path = `${file_path}#toolbar=0`;

		    	var iframe = `<iframe id="preview_file_pdf" src="${iframe_path}" style="width: 100%;height: 900px;display: block;" frameborder="0"></iframe>`;
	    	}

	    	$('.preview_file_section').html(iframe);
	    	$('#file-preview-modal-download').attr('href',final_file_path);
	    	$('#file_preview_modal').modal('show');
	    });


	  	$(document).on('click','#file_preview_modal_close',function(){
	    	$('.preview_file_section').html('');
	    });

		//iframe reload functionality
		function reloadIframe() {
			showLoader();
    		var ifr = $('#preview_file_pdf')[0];
    		ifr.src = ifr.src;

    		setTimeout(function(){
    			hideLoader();
    		},3000);
		}




	</script>
	
</body>

</html>
