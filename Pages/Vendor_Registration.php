<?php include "Header.php";?>

<?php include "Topbar.php" ?>		

<?php include "Sidemenu.php" ?>	

	<!-- Main Content -->
	<div class="page-wrapper">
		<div class="container-fluid">

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <?php $page_type = !isset($_GET['id']) ? 'Create' : ((isset($_GET['id']) && isset($_GET['action'])) ? 'View' : 'Edit') ?>
					  <h5 class="txt-dark"><?= $page_type; ?> Vendor Registration</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><span><a href="Vendor_Registration_List.php">Vendor Registration List</a></span></li>
						<li class="active"><span><?= $page_type; ?> Vendor Registration</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
			
		
			
			<!-- Row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<form id="example-advanced-form" action="#">
									<input type="hidden" name="Action" value="Vendor_Register_Save">
									<input type="hidden" name="register_id" id="register_id" value="">
									<input type="hidden" name="page_type" id="page_type" value="<?= $page_type; ?>">
							

									<h3><span class="number"><i class="icon-user-following txt-black"></i></span><span class="head-font capitalize-font">Company Profile</span></h3>
									<fieldset>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-wrap">

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="REG_ID">REGISTRATION ID:</label>
																<input id="REG_ID" type="text" name="REG_ID" class="form-control required readonly_field" value="<?php echo Generate_Registeration_No($conn); ?>" readonly/>
															</div>
															<div class="span1"></div>
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">VENDOR NAME: <span style="color: red;">*:</span></label>
																<input id="vendorname" type="text" name="vendor_name" class="form-control required" value="" oninput="this.value = this.value.toUpperCase()" />
															</div>																	

														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="father_name">FATHER NAME <span style="color: red;">*:</span></label>
																<input id="father_name" type="text" name="father_name" class="form-control required" value="" oninput="this.value = this.value.toUpperCase()"/>
															</div>																	
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="partner_name">PARTNER NAME<span style="color: red;"> * :</span></label>
																<input id="partner_name" type="text" name="partner_name" class="form-control required" value="" oninput="this.value = this.value.toUpperCase()"/>
															</div>
														</div>
													</div>													

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">TYPE OF VENDOR <span style="color: red;">*:</span>: </label>
																<select id="typeofvendor" class="form-control required" name="type_of_vendor">
																	<option value="">SELECT</option>
																	<option value="INDIVIDUAL">INDIVIDUAL</option>
																	<option value="PARTNERSHIP">PARTNERSHIP</option>
																	<option value="COMPANY">COMPANY</option>
																	<option value="ASSOCIATION">ASSOCIATION</option>
																	<option value="LLP">LLP</option>
																</select>
															</div>																	
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">PAN NUM <span style="color: red;">*:</span>:</label>
																<input id="pannum" type="text" name="pan_num" class="form-control required" value="" maxlength="10" oninput="this.value = this.value.toUpperCase()"/>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">ADDRESS <span style="color: red;">*:</span>:</label>
																<textarea id="Address" name="Address" class="form-control required"></textarea>
															</div>

															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">OWNER/LESSEE ADDRESS <span style="color: red;">*:</span>:</label>
																<textarea id="owner_address" name="owner_address" class="form-control required"></textarea>
															</div>

														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">PHONE #( WITH STD CODE) <span style="color: red;">*:</span>: </label>
																<input id="phonenum" type="text" name="phonenum" class="form-control required" value="" />
															</div>																
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">MOBILE NUMBER <span style="color: red;">*:</span>:</label>
																<input id="mobilenum" type="text" name="mobile_num" class="form-control required" value="" onkeypress="return isNumber(event)" maxlength="10" />
															</div>
																
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">EMAIL <span style="color: red;">*:</span>: </label>
																<input id="email" type="text" name="email" class="form-control required" value="" />
															</div>																
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="contactperson">CONTACT PERSON NAME <span style="color: red;">*</span>: </label>
																<input id="contactperson" type="text" name="contact_person_name" class="form-control required" value=""  oninput="this.value = this.value.toUpperCase()"/>
															</div>
																
														</div>
													</div>
												
													
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="contactpersonmobile">CONTACT PERSON MOBILE NUMBER <span style="color: red;">*</span>: </label>
																<input id="contactpersonmobile" type="text" name="contact_person_mobile" class="form-control required" value="" onkeypress="return isNumber(event);" maxlength="10"/>
															</div>																
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">WEBSITE  ADDRESS (IF ANY)</label>
																<input id="website" type="text" name="website" class="form-control " value="" />
															</div>

														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="gstnum">GST REGISTRATION NUMBER (IF REGISTERED): </label>
																<input id="gstnum" type="text" name="gst_num" class="form-control " value="" maxlength="15" oninput="this.value = this.value.toUpperCase()"/>
															</div>																
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">CIN NUMBER (APPLICABLE FOR COMPANY) <span style="color: red;">*</span>:</label>
																<input id="cinnum" type="text" name="CIN_num" class="form-control required" value="" maxlength="21" />
															</div>
															
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">AADHAR NUMBER (APPLICABLE FOR INDIVIDUAL)<span style="color: red;">*</span>: </label>
																<input id="aadharnum" type="text" name="aadhar_num" class="form-control required" value="" onkeypress="return isNumber(event)" maxlength="12"/>
															</div>																
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="msme">MSME TYPE:</label>
																<select id="msme" class="form-control " name="msme_type">
																	<option value="">SELECT</option>
																	<option value="MICRO">MICRO</option>
																	<option value="SMALL">SMALL</option>
																	<option value="COMPANY">MEDIUM ENTERPRISES</option>
																</select>
															</div>
																
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="msmenum">MSME (UDYAM) REGISTRATION NUMBER: </label>
																<input id="msmenum" type="text" name="msme_num" class="form-control " value="" />
															</div>																
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="seednum">SEED LICENSE NUMBER (FOR SEED PROCESSING VENDORS ONLY)</label>
																<input id="seednum" type="text" name="seed_licence_num" class="form-control " value="" />
															</div>
																
														</div>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="seed_licence_validity">SEED LICENSE NUMBER VALIDITY: </label>
																<input id="seedvalidity" type="date" name="seedvalidity" class="form-control " value="" />
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

									<h3><span class="number"><i class="icon-bag txt-black"></i></span><span class="head-font capitalize-font">Bank Details</span></h3>
									<fieldset>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-wrap">
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">ACCOUNT HOLDER NAME<span style="color: red;">*:</span>:</label>
																<input id="accholdername" type="text" name="acc_holder_name" class="form-control required" value="" oninput="this.value = this.value.toUpperCase()"/>
															</div>
															<div class="span1"></div>
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="acc_type">ACCOUNT TYPE <span style="color: red;">*:</span>:</label>
															    <select class="form-control required" id="acc_type" name="acc_type">
															        <option value="">Choose Account Type</option>
															        <option value="savings">Savings Account</option>
															        <option value="current">Current Account</option>
															        <option value="joint">Joint Account</option>
															        <option value="salary">Salary Account</option>
															        <option value="business">Business Account</option>
															    </select>																		
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="accnumber">ACCOUNT NUMBER <span style="color: red;">*:</span>:</label>
																<input id="accnumber" type="text" name="acc_number" class="form-control required" value="" />
															</div>
															<div class="span1"></div>
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="ifsccode">IFSC CODE <span style="color: red;">*:</span>:</label>
																<input id="ifsccode" type="text" name="ifsc_code" class="form-control required" value="" maxlength="11" />
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="firstName">NAME OF THE BANK <span style="color: red;">*:</span>:</label>
																<input id="bankname" type="text" name="bank_name" class="form-control required" value="" readonly/>
															</div>
															<div class="span1"></div>
															<div class="col-md-6 col-xs-12">
																<label class="control-label mb-10" for="lastName">BRANCH <span style="color: red;">*:</span>:</label>
																<input id="branchname" type="text" name="branch_name" class="form-control required" value="" readonly/>
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
								 
									<h3><span class="number"><i class="icon-credit-card txt-black"></i></span><span class="head-font capitalize-font">Documents Attached</span></h3>
									<fieldset>
										<div class="row">
										<div class="col-sm-12">
											<div class="row mb-2rem">

												<div class="col-md-4">
														<p class="text-success">COMPANY REGISTRATION CERTIFICATE</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom1">
																<input name="com_reg_certificate_file_name" type="hidden" id="my-dropzone-custom1-file-name"/>

																	<input name="com_reg_certificate_file" type="file" style="display:none;" id="com_reg_certificate_file"/>
																	
															</div>
														</div>
												</div>

												<div class="col-md-4">
														<p class="text-success">MSME CERTIFICATE(UDYAM)</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom2">
																<input name="msme_certificate_file_name" type="hidden" id="my-dropzone-custom2-file-name"/>																				
																	<input name="msme_certificate" type="file" style="display:none;" id="msme_certificate"/>
															</div>
														</div>
												</div>	

												<div class="col-md-4">
														<p class="text-success">ADDRESS PROOF <small>(GST/AADHAR/OTHER DOCUMENTS)</small></p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom3">
																<input name="address_proof_file_name" type="hidden" id="my-dropzone-custom3-file-name"/>																
																	<input name="address_proof_file" type="file" style="display:none;" id="address_proof_file"/>
															</div>
														</div>
												</div>

											</div>

											<div class="row mb-2rem">


												<div class="col-md-4">
														<p class="text-success">CANCELLED CHEQUE LEAF/ PASSBOOK COPY</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom4">
																<input name="cancelled_cheque_file_name" type="hidden" id="my-dropzone-custom4-file-name"/>																
																	<input name="cancelled_cheque_file" type="file"  style="display:none;" id="cancelled_cheque_file"/>
															</div>
														</div>
												</div>	

												<div class="col-md-4">
														<p class="text-success">PAN CARD</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom5">
																<input name="pan_card_file_name" type="hidden" id="my-dropzone-custom5-file-name"/>																
																	<input name="pan_card_file" type="file" style="display:none;" id="pan_card_file"/>
															</div>
														</div>
												</div>

												<div class="col-md-4">
														<p class="text-success">GST CERTIFICATE</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom6">
																<input name="gst_certificate_file_name" type="hidden" id="my-dropzone-custom6-file-name"/>																
																	<input name="gst_certificate_certificate" type="file" style="display:none;" id="gst_certificate_certificate"/>
															</div>
														</div>
												</div>	
																			
											</div>		

											<div class="row mb-2rem">
												<div class="col-md-4">
														<p class="text-success">AADHAR CARD</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom7">
																<input name="aadhar_card_file_name" type="hidden" id="my-dropzone-custom7-file-name"/>																
																	<input name="aadhar_card_file" type="file" style="display:none;" id="aadhar_card_file"/>
															</div>
														</div>
												</div>

												<div class="col-md-4">
														<p class="text-success">SEED LICENSE</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom8">
																<input name="seed_license_certificate_file_name" type="hidden" id="my-dropzone-custom8-file-name"/>																
																	<input name="seed_license_certificate" type="file" style="display:none;" id="seed_license_certificate"/>
															</div>
														</div>
												</div>	

												<div class="col-md-4">
														<p class="text-success">OTHERS (SPECIFY BELOW)</p>
														<div class="mt-5">
															<div action="#" class="dropzone" id="my-dropzone-custom9">
																<input name="other_file_name" type="hidden" id="my-dropzone-custom9-file-name"/>																
																	<input name="other_files" type="file" style="display:none;" id="other_files"/>
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
								 
									<h3><span class="number"><i class="icon-basket-loaded txt-black"></i></span><span class="head-font capitalize-font">Details For Others</span></h3>
									<fieldset>
										<div class="col-md-12">
											<label class="control-label mb-10" for="Other_Remarks">Other Remarks:</label>
											<textarea class="form-control" id="Other_Remarks" name="Other_Remarks" rows="10" placeholder="Enter any other details here..."></textarea>
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
				acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp,.pdf",
    			success: function(file, response){
			        // Create a DataTransfer object
			        const dataTransfer = new DataTransfer();

			        // Add the uploaded file to the DataTransfer object
			        dataTransfer.items.add(file);

			        // Assign DataTransfer files to the file input
			        $(hidden_input_element)[0].files = dataTransfer.files;

			        var file_extension = '';
			        if (file.type === "application/pdf") {
			        	file_extension = 'pdf';
			        } else {
			        	file_extension = 'image';
			        }
					setTimeout(function() {
						var view_btn = `<a class="document-view" data-action="uploaded" data-filepath="${URL.createObjectURL(file)}" data-from='${dropzone_element_id}' data-filetype='${file_extension}'>View</a>`;
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
							var file_extension = existing_file_name.split('.')[1];

							var view_btn = `<a class="document-view" data-action="edit" data-filepath="${existing_file_path}" data-from='${dropzone_element_id}' data-filetype='${file_extension}'>View</a>`;
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


		// on ready function start 
		$(document).ready(function(){
            var url_string = window.location.href; 
            var url = new URL(url_string);
            var decodedid = url.searchParams.get("id");
            var id = atob(decodedid);
            var action = atob(url.searchParams.get("action"));

            //hide remark row
			$('.remark_row').hide();

			// initially hide gst field
			$('#gstnum').attr('readonly',true);
			$('#pannum').attr('readonly',true);

			initialize_dropzone("#my-dropzone-custom1","#com_reg_certificate_file");	
			initialize_dropzone("#my-dropzone-custom2","#msme_certificate");			
			initialize_dropzone("#my-dropzone-custom3","#address_proof_file");			
			initialize_dropzone("#my-dropzone-custom4","#cancelled_cheque_file");			
			initialize_dropzone("#my-dropzone-custom5","#pan_card_file");			
			initialize_dropzone("#my-dropzone-custom6","#gst_certificate_certificate");			
			initialize_dropzone("#my-dropzone-custom7","#aadhar_card_file");			
			initialize_dropzone("#my-dropzone-custom8","#seed_license_certificate");			
			initialize_dropzone("#my-dropzone-custom9","#other_files");		

			if(decodedid != null) {
            	get_registered_details(id,action);				
			}


		    $('#ifsccode').on('keyup',function(){
		    	var ifsc_code = $(this).val();

		    	if(ifsc_code.length == 11) {
		    		var api_url   = 'https://ifsc.razorpay.com/'+ifsc_code;

		    		// call ifsc code api to get bank details
		    		fetch(api_url).then(response => {
		    			if (!response.ok) {
				    		alert_msg('warning','Warning!','IFSC code invalid.');
	            		}
		    			return response.json()
		    		}).then(data => {
		    			if(data && data.BANK != '') {
		    				$('#bankname').val(data.BANK);
		    			}

		    			if(data && data.BRANCH != '') {
		    				$('#branchname').val(data.BRANCH);
		    			}
		    		}).catch(error => {
	            		console.error("Error fetching data:", error);
	        		});
		    	} else {
		    		$('#bankname').val('');
		    		$('#branchname').val('');
		    	}
		    });		


		    $('#pannum').on('keyup',function(){
		    	var pannum = $(this).val();
				$('#gstnum').attr('readonly',true);
		    	if(pannum.length == 10) {
		    		if(!validatePAN(pannum)) {
		    			alert_msg('warning','Warning!','PAN number format is invalid.');
		    		} else {
						$('#gstnum').removeAttr('readonly');
		    		}
		    	}
		    });	

			
		});
		// on ready function end 

		
		$(document).on('change','#typeofvendor',function(){
			var vendor_type = $(this).val();
			$('#pannum').attr('readonly',true);
			if(vendor_type != '') {
				$('#pannum').removeAttr('readonly');
			}
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
			var index = 3;
 			var input_pan_4th_digit =pan.charAt(index);

 			var vendor_type = $('#typeofvendor').val();

			if(vendor_type == 'INDIVIDUAL'){
				var validation_4th_digit = "P";
			} else if(vendor_type == 'PARTNERSHIP'){
				var validation_4th_digit = "F";
			} else if(vendor_type == 'HUF'){
				var validation_4th_digit = "H";
			} else if(vendor_type == 'COMPANY'){
				var validation_4th_digit = "C";
			} else if(vendor_type == 'LLP'){
				var validation_4th_digit = "F";
			} else if(vendor_type == 'Trust'){
				var validation_4th_digit = "T";
			}

			if(input_pan_4th_digit == validation_4th_digit) {
			    const panRegex = /^[A-Z]{3}[CPHFTG]{1}[A-Z]{1}[0-9]{4}[a-zA-Z]{1}$/;
			    return panRegex.test(pan);
			} else {
				return false;
			}

		}

		function validateGST(gst,pan_no)
		{
			var statecode = gst.substring(0, 2);
            var pancarno = gst.substring(2, 12);
            var entityNumber = gst.substring(12, 13);
            var defaultZvalue = gst.substring(13, 14);
            var checksumdigit = gst.substring(14, 15);

            if (pancarno.length != 10 ) {
            	return false;
            }

            if(pancarno != pan_no) {
            	return false;
            }

            if (defaultZvalue !== 'Z' ) {
            	return false;
            }

            if (!$.isNumeric(statecode)) {
            	return false;
            }

           if (!$.isNumeric(checksumdigit)) {
                return false;
           }

           return true;
		}

		// Function to validate Aadhar number
		function validateAadhar(aadhar) {
		    const aadharRegex = /^\d{12}$/;
		    return aadharRegex.test(aadhar);
		}	

		function form_validation()
		{
			var is_valid = false;
			var Pan_No = $('#pannum').val();
	    	var mobilenum = $('#mobilenum').val();
	    	var contact_person_mobile = $('#contactpersonmobile').val();
	    	var gst_num = $('#gstnum').val();
	    	var cin_num = $('#cinnum').val();
	    	var aadhar_num = $('#aadharnum').val();
	    	var ifsccode   = $('#ifsccode').val();
	    	var bankname   = $('#bankname').val();
	    	var branchname = $('#branchname').val();


	    	if(Pan_No == '') {
	    		alert_msg('warning','Warning!','Pan number is mandatory.');
	    		$('#pannum').addClass('error');
	    	} else if(Pan_No != '' && !validatePAN(Pan_No)) {
		    	alert_msg('warning','Warning!','PAN number format is invalid.');
	    		$('#pannum').addClass('error');
	    	} else if(mobilenum != '' && mobilenum.length < 10) {
	    		alert_msg('warning','Warning!','Mobile number must be 10 digits.');
	    		$('#mobilenum').addClass('error');
	    	} else if(contact_person_mobile != '' && contact_person_mobile.length < 10) {
	    		alert_msg('warning','Warning!','Contact person mobile number must be 10 digits.');
	    		$('#contactpersonmobile').addClass('error');
	    	} else if(gst_num != '' && gst_num.length < 15) {
	    		alert_msg('warning','Warning!','GST number must be 15 digits.');
	    		$('#gstnum').addClass('error');
	    	} else if(gst_num != '' && !validateGST(gst_num,Pan_No)) {
	    		alert_msg('warning','Warning!','Invalid GST Number.');
	    		$('#gstnum').addClass('error');
	    	} else if(cin_num != '' && cin_num.length < 15) {
	    		alert_msg('warning','Warning!','CIN number must be 21 digits.');
	    		$('#cinnum').addClass('error');
	    	} else if(aadhar_num != '' && !validateAadhar(aadhar_num)) {
	    		alert_msg('warning','Warning!','Aadhar number format is invalid.');
	    		$('#aadharnum').addClass('error');
	    	} else if(ifsccode != '' && ifsccode.length < 11) {
	    		alert_msg('warning','Warning!','IFSC Code must be 11 digits.');
	    		$('#ifsccode').addClass('error');
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
							$('#register_id').val(response.Inserted_ID);
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
									location.href = "Vendor_Registration_List.php";
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
	            data: { Action : 'Vendor_Registeration_List',id : id },
	            dataType: "json",
	            beforeSend: function(){
	                showLoader();
	            },
	            success: function(response) {

	                $('#register_id').val(response.data[0].Id);

	                $('#REG_ID').val(response.data[0].REG_ID);
	                $('#vendorname').val(response.data[0].Vendor_Name);
	                $('#father_name').val(response.data[0].Father_Name);
	                $('#partner_name').val(response.data[0].Partner_Name);

	                $('#pannum').val(response.data[0].Pan_No);
	                $('#typeofvendor').val(response.data[0].Vendor_Type);
	                $('#Address').val(response.data[0].Address);
	                $('#owner_address').val(response.data[0].Owner_Address);

	                $('#phonenum').val(response.data[0].Phone_With_STD);
	                $('#mobilenum').val(response.data[0].Mobile_No);
	                $('#email').val(response.data[0].Email);
	                $('#contactperson').val(response.data[0].Contact_Person_Name);
	                $('#contactpersonmobile').val(response.data[0].Contact_Person_Mobile);
	                $('#website').val(response.data[0].Website_address);
	                $('#gstnum').val(response.data[0].GST_No);
	                $('#cinnum').val(response.data[0].CIN_No);
	                $('#aadharnum').val(response.data[0].Aadhar_No);
	                $('#msme').val(response.data[0].MSME_Type);

	                $('#msmenum').val(response.data[0].MSME_No);
	                $('#seednum').val(response.data[0].Seed_License_No);
	                $('#seedvalidity').val(response.data[0].Seed_License_Validity);
	                $('#accholdername').val(response.data[0].Account_Holder_Name);
	                $('#acc_type').val(response.data[0].Account_Type);
	                $('#bankname').val(response.data[0].Bank_Name);
	                $('#branchname').val(response.data[0].Bank_Branch);
	                $('#accnumber').val(response.data[0].Account_No);
	                $('#ifsccode').val(response.data[0].IFSC_Code);

	                if(response.data[0].Other_Remarks != '') {
	                	$('#Other_Remarks').html(response.data[0].Other_Remarks);
	                }

	                $('#contract_category').val(response.data[0].Contract_Category);
	                $('#contract_division').val(response.data[0].Contract_Division);
	                $('#contract_type').val(response.data[0].Contract_Type);
	                $('#contract_sub_type1').val(response.data[0].Contract_Sub_Type1);
	                $('#contract_sub_type2').val(response.data[0].Contract_Sub_Type2);


	                if(response.data[0].Contract_Approval_Submission == 1) {
	               		 $('#contract_approval_submission').prop('checked',true);
	                }

	                var division = (response.data[0].Contract_Division ==  'CT01') ? 'Cotton' : ((response.data[0].Contract_Division ==  'FC01') ? 'Field Crop' : ((response.data[0].Contract_Division ==  'FR01') ? 'Forage' : response.data[0].Contract_Division));

	                $('#contract_category_badge').text(response.data[0].Contract_Category);
	                $('#contract_division_badge').text(division);
	                $('#contract_type_badge').text(response.data[0].Contract_Type);
	                $('#contract_sub_type1_badge').text(response.data[0].Contract_Sub_Type1);
	                $('#contract_sub_type2_badge').text(response.data[0].Contract_Sub_Type2);

					$('#my-dropzone-custom1-file-name').val(response.data[0].Company_Reg_Certificate_Doc);
					$('#my-dropzone-custom2-file-name').val(response.data[0].MSME_Certificate_Doc);
					$('#my-dropzone-custom3-file-name').val(response.data[0].Address_Proof_Doc);
					$('#my-dropzone-custom4-file-name').val(response.data[0].Cancelled_Cheque_Doc);
					$('#my-dropzone-custom5-file-name').val(response.data[0].Pan_Card_Doc);
					$('#my-dropzone-custom6-file-name').val(response.data[0].GST_Certificate_Doc);
					$('#my-dropzone-custom7-file-name').val(response.data[0].Aadhar_Card_Doc);
					$('#my-dropzone-custom8-file-name').val(response.data[0].Seed_License_Doc);
					$('#my-dropzone-custom9-file-name').val(response.data[0].Other_Doc);	                


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

	               	var folder_name = response.data[0].REG_ID;
	               	folder_name     = folder_name.replaceAll('/','-');

					var file_path = "uploads/vendor_registration/"+folder_name;

					
					initialize_dropzone("#my-dropzone-custom1","#com_reg_certificate_file",file_path,response.data[0].Company_Reg_Certificate_Doc);		

					initialize_dropzone("#my-dropzone-custom2","#msme_certificate",file_path,response.data[0].MSME_Certificate_Doc);	

					initialize_dropzone("#my-dropzone-custom3","#address_proof_file",file_path,response.data[0].Address_Proof_Doc);			
					initialize_dropzone("#my-dropzone-custom4","#cancelled_cheque_file",file_path,response.data[0].Cancelled_Cheque_Doc);			
					initialize_dropzone("#my-dropzone-custom5","#pan_card_file",file_path,response.data[0].Pan_Card_Doc);			
					initialize_dropzone("#my-dropzone-custom6","#gst_certificate_certificate",file_path,response.data[0].GST_Certificate_Doc);			
					initialize_dropzone("#my-dropzone-custom7","#aadhar_card_file",file_path,response.data[0].Aadhar_Card_Doc);			
					initialize_dropzone("#my-dropzone-custom8","#seed_license_certificate",file_path,response.data[0].Seed_License_Doc);			
					initialize_dropzone("#my-dropzone-custom9","#other_files",file_path,response.data[0].Other_Doc);	


	                if(action == 'view') {

	                    $('.manual_pagination_div').hide();
	                   	
	                   	$('#vendorname').attr('disabled',true);
	                	$('#father_name').attr('disabled',true);
	                	$('#partner_name').attr('disabled',true);	                   	
	                	$('#pannum').attr('disabled',true);
		                $('#typeofvendor').attr('disabled',true);
		                $('#Address').attr('disabled',true);
		                $('#owner_address').attr('disabled',true);


		                $('#phonenum').attr('disabled',true);
		                $('#mobilenum').attr('disabled',true);
		                $('#email').attr('disabled',true);
		                $('#contactperson').attr('disabled',true);
		                $('#contactpersonmobile').attr('disabled',true);
		                $('#website').attr('disabled',true);
		                $('#gstnum').attr('disabled',true);
		                $('#cinnum').attr('disabled',true);
		                $('#aadharnum').attr('disabled',true);
		                $('#msme').attr('disabled',true);

		                $('#msmenum').attr('disabled',true);
		                $('#seednum').attr('disabled',true);
		                $('#seedvalidity').attr('disabled',true);
		                $('#accholdername').attr('disabled',true);
		                $('#acc_type').attr('disabled',true);
		                $('#bankname').attr('disabled',true);
		                $('#branchname').attr('disabled',true);
		                $('#accnumber').attr('disabled',true);
		                $('#ifsccode').attr('disabled',true);
		                $('#Other_Remarks').attr('disabled',true);
		                $('.contract_period').attr('disabled',true);
		                $('#contract_security_deposit_amt').attr('disabled',true);

	                   // $('.submit_section').hide();
		                $('a[href="#finish"]').hide();

	                }
	            },
	            complete: function(){
	                hideLoader();
	            }
	        }); 
	    }

	  	$(document).on('click','.document-view',function(){
	    	var FromID = $(this).data('from');
	    	var file_path = $(this).data('filepath');
	    	var file_name = $(FromID+'-file-name').val();
	    	var action = $(this).data('action');
	    	var file_type = $(this).data('filetype');	    	

	    	if(action == 'edit') {
		    	var final_file_path = file_path+'/'+file_name;

		    	if(file_type == 'pdf') {
			    	var iframe_path = `https://docs.google.com/viewer?url=https://devcorporate.rasiseeds.com/corporate/ContractManagement/pages/${final_file_path}&embedded=true`;

		    		var iframe = `<iframe id="preview_file_pdf" src="${iframe_path}" style="width: 100%;height: 900px;display: block;" frameborder="0"></iframe>`;

		    	} else {
		    		var iframe = `<img class="preview_image" src="${final_file_path}" alt="your image" width="100%" style="display: block;">`;
		    	}
	    	} else {
		    	var final_file_path = `${file_path}#toolbar=0`;

		    	var iframe = `<iframe id="preview_file_pdf" src="${final_file_path}" style="width: 100%;height: 900px;display: block;" frameborder="0"></iframe>`;
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
