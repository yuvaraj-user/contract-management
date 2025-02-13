<?php include "Header.php";?>

<?php include "Topbar.php" ?>		

<?php include "Sidemenu.php" ?>	

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">

				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-8 col-md-4 col-sm-4 col-xs-12 text-center">
					  <h5 class="txt-dark">Contract Template View</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><span><a href="Contract_Registration_List.php">Contract Registration List</a></span></li>
						<li class="active"><span><a href="javascript:void(0);">Contract Template</a></span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

				<div class="row">
					<?php
						$structured_contract_id =  str_replace('/', '-',$_GET['con_id']);

						$file_name = $structured_contract_id."_filled_document.pdf";
						$file_url  = "https://docs.google.com/viewer?url=https://devcorporate.rasiseeds.com/corporate/ContractManagement/pages/uploads/contract_generated_docs/".$file_name.'&embedded=true'; 

						$contract_data   = get_contract_data($conn,$_GET['con_id']);
					?>			
				
					<div class="row">
						<div class="col-md-8">
							<div class="text-right">
								<button class="btn btn-sm btn-info" onclick="reloadIframe();"><i class="fa-solid fa-arrows-rotate"></i> Reload View</button>
							</div>
						</div>	
					</div>	

					<div class="col-md-8">
						<iframe id="myIframe" src='<?= $file_url; ?>' frameborder='0' style="width:100%;height: 100vh;"></iframe>
					</div>

					<div class="col-md-4">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<h5 class="text-center">Contract Details</h5>
							</div>							
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="col-md-12 mb-10">
										<div class="col-md-6">
											<label class="control-label">Contract Category</label>
										</div>
										<div class="col-md-6">
											<p><?= $contract_data['Contract_Category']; ?></p>
										</div>
									</div>
									<?php if($contract_data['Contract_Division'] != '') { ?>
									<div class="col-md-12 mb-10">
										<div class="col-md-6">										
											<label class="control-label">Contract Division</label>
										</div>
										<div class="col-md-6">	
											<?php
												$division_text = ($contract_data['Contract_Division'] == 'CT01') ? 'Cotton' : (($contract_data['Contract_Division'] == 'FC01') ? 'Field Crop' : (($contract_data['Contract_Division'] == 'FR01') ? 'Forage' : $contract_data['Contract_Division'])); 

											?> 									
											<p><?= $division_text; ?></p>
										</div>
									</div>	
									<?php } ?>									
									<div class="col-md-12 mb-10">
										<div class="col-md-6">										
											<label class="control-label">Contract Type</label>
										</div>
										<div class="col-md-6">										
											<p><?= $contract_data['Contract_Type']; ?></p>
										</div>
									</div>
									<?php if($contract_data['Contract_Sub_Type1'] != '') { ?>	
									<div class="col-md-12 mb-10">
										<div class="col-md-6">										
											<label class="control-label">Contract Sub Type1</label>
										</div>
										<div class="col-md-6">										
											<p><?= $contract_data['Contract_Sub_Type1']; ?></p>
										</div>
									</div>	
									<?php } ?>	
									<?php if($contract_data['Contract_Sub_Type2'] != '') { ?>	
									<div class="col-md-12 mb-10">
										<div class="col-md-6">										
											<label class="control-label">Contract Sub Type2</label>
										</div>
										<div class="col-md-6">										
											<p><?= $contract_data['Contract_Sub_Type2']; ?></p>
										</div>
									</div>	
									<?php } ?>											

																										

									<!-- download btn -->
									<div class="col-md-12 p-0">
										<div class="text-center">
											<a href="uploads/contract_generated_docs/<?= $file_name; ?>" download="<?= $_GET['con_id'] ?>.pdf"><button class="btn btn-success" id="docs_download"><i class="fa-solid fa-file-arrow-down"></i> Download</button></a>
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


		</div>

	<?php include "Bottom_Script.php" ?>

	<script type="text/javascript">

		//iframe reload functionality
		function reloadIframe() {
			showLoader();
    		var ifr = $('#myIframe')[0];
    		ifr.src = ifr.src;
		}

		$('#myIframe').load(function () {			
   		  	hideLoader();
		});
	</script>


