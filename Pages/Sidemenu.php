		<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
	<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<!-- <li>
					<a href="Dashboard.php" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
				</li> -->
				
				<li>
					<a <?php if($current_page == 'Vendor_Registration_List.php' || $current_page == 'Vendor_Registration.php'){ ?> class="active" <?php } ?> href="Vendor_Registration_List.php" data-toggle="collapse" data-target="#Vendor_Registration_dr"><div class="pull-left"><i class="fa-solid fa-user mend-12"></i><span class="right-nav-text">Vendor Registration</span></div><div class="clearfix"></div></a>
				</li>	

				<li>
					<a <?php if($current_page == 'Contract_Registration_List.php' || $current_page == 'Contract_Registration.php' || $current_page == 'Contract_Template_View.php'){ ?> class="active" <?php } ?> href="Contract_Registration_List.php" data-toggle="collapse" data-target="#Vendor_Registration_dr"><div class="pull-left"><i class="fa-solid fa-file-signature mend-12"></i><span class="right-nav-text">Contract Registration</span></div><div class="clearfix"></div></a>
				</li>				


				<?php if(Check_L1_Manager($conn,$_SESSION['EmpID'])) { ?>
					<li>
						<a <?php if($current_page == 'Vendor_L1_Approval_List.php' || $current_page == 'Vendor_L1_Approve.php'){ ?> class="active" <?php } ?> href="Vendor_L1_Approval_List.php">
							<div class="pull-left">
								<i class="fa-solid fa-user-check mend-12"></i>								
								<span class="right-nav-text">Vendor Approval</span>
							</div>
							<div class="clearfix"></div>
						</a>
					</li>	
											

				<?php } ?>


				

				<!-- <li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#form_dr"><div class="pull-left"><i class="zmdi zmdi-edit mr-20"></i><span class="right-nav-text">Contract Registration</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="form_dr" class="collapse collapse-level-1 two-col-list">
						<li>
							<a href="Contract_Registration_List.php">Registration</a>
						</li>
						
					</ul>
				</li> -->
			
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->