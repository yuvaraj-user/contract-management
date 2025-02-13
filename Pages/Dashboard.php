<?php include "Header.php" ?>




<body>
<?php include "Loader.php" ?>	
    <div class="wrapper  theme-3-active pimary-color-green">
	
	
	

<?php include "Topbar.php" ?>		

<?php include "Sidemenu.php" ?>	

<?php //include "Rightsidebar.php" ?>	


	



		
		
	
		
		
		
	     <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				<!-- Row -->
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <div class="panel panel-default card-view panel-refresh">
								<div class="refresh-container">
									<div class="la-anim-1"></div>
								</div>
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Budget</h6>
									</div>
									<div class="pull-right">
										<a href="#" class="pull-left inline-block refresh">
											<i class="zmdi zmdi-replay"></i>
										</a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div id="e_chart_3" class="" style="height:294px;"></div>
										<div class="label-chatrs mt-15">
											<div class="inline-block mr-15">
												<span class="clabels inline-block bg-green mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">planned</span>
											</div>
											<div class="inline-block">
												<span class="clabels inline-block bg-light-green mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">actual</span>
											</div>									
										</div>
									</div>	
								</div>
						</div>
					</div>
				
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                       <div class="panel panel-default card-view panel-refresh">
								<div class="refresh-container">
									<div class="la-anim-1"></div>
								</div>
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Pending Items</h6>
									</div>
									<div class="pull-right">
										<a href="#" class="pull-left inline-block refresh mr-15">
											<i class="zmdi zmdi-replay"></i>
										</a>
										<div class="pull-left inline-block dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
											<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
											</ul>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_1" class="" style="height:242px;"></div>
									<div class="label-chatrs mt-15">
										<div class="mb-5">
											<span class="clabels inline-block bg-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Actions pending</span>
										</div>
										<div class="mb-5">
											<span class="clabels inline-block bg-light-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">decision pending</span>
										</div>
										<div class="">
											<span class="clabels inline-block bg-xtra-light-green mr-5"></span>
											<span class="clabels-text font-12 inline-block txt-dark capitalize-font">chage request pending</span>
										</div>										
									</div>
								</div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Task Status</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block refresh">
										<i class="zmdi zmdi-replay"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_2" class="" style="height:330px;"></div>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
						<div class="panel card-view bg-green">
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left txt-light">
													<span class="weight-500 uppercase-font block">due</span>
													<span class="block counter">$<span class="counter-anim">15678</span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right txt-light">
													<span class="weight-500 uppercase-font block">overdue</span>
													<span class="block counter">$<span class="counter-anim">45678</span></span>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel card-view">
							<div class="panel-heading small-panel-heading relative">
								<div class="pull-left">
									<h6 class="panel-title">Monthly Revenue</h6>
								</div>
								<div class="clearfix"></div>
								<div class="head-overlay"></div>
							</div>		
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="sm-data-box">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="block"><i class="zmdi zmdi-trending-up txt-success font-18 mr-5"></i><span class="weight-500 uppercase-font">growth</span></span>
													<span class="txt-dark block counter">$<span class="counter-anim">15,678</span></span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<div id="sparkline_4" class="sp-small-chart" ></div>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default card-view">
								<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">My Stats</h6>
								</div>
								<div class="clearfix"></div>
							</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body row">
										<div class="">
											<div class="pl-15 pr-15 mb-15">
												<div class="pull-left">
													<i class="zmdi zmdi-collection-folder-image inline-block mr-10 font-16"></i>
													<span class="inline-block txt-dark">Active Projects</span>
												</div>	
												<span class="inline-block txt-warning pull-right weight-500">12</span>
												<div class="clearfix"></div>
											</div>
											<hr class="light-grey-hr mt-0 mb-15"/>
											<div class="pl-15 pr-15 mb-15">
												<div class="pull-left">
													<i class="zmdi zmdi-format-list-bulleted inline-block mr-10 font-16"></i>
													<span class="inline-block txt-dark">Task Pending</span>
												</div>	
												<span class="inline-block txt-danger pull-right weight-500">23</span>
												<div class="clearfix"></div>
											</div>
											<hr class="light-grey-hr mt-0 mb-15"/>
											<div class="pl-15 pr-15 mb-15">
												<div class="pull-left">
													<i class="zmdi zmdi-ticket-star inline-block mr-10 font-16"></i>
													<span class="inline-block txt-dark">Support Tickets</span>
												</div>	
												<span class="inline-block txt-primary pull-right weight-500">43</span>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					
					<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Project Status</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
									<div class="pull-left inline-block dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
										<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Update</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Edit</a></li>
											<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Remove</a></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
										  <table class="table table-hover mb-0">
											<thead>
											  <tr>
												<th>Task</th>
												<th>Progress</th>
												<th>Deadline</th>
												</tr>
											</thead>
											<tbody>
											  <tr>
												<td>CMVM Digitisation of paper records</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-danger" style="width: 35%"></div>
												  </div></td>
												<td>Jan 18, 2018</td>
												
											  </tr>
											  <tr>
												<td>Data management plans</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
												  </div></td>
												<td>Dec 1, 2016</td>
												
											  </tr>
											  <tr>
												<td>REF readiness</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-success" style="width: 100%"></div>
												  </div></td>
												<td>Nov 12, 2016</td>
												
											  </tr>
											  <tr>
												<td>Storage Strategy</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-primary" style="width: 70%"></div>
												  </div></td>
												<td>Oct 9, 2016</td>
												
											  </tr>
											  <tr>
												<td>Network Infrastructure strategy</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-primary" style="width: 85%"></div>
												  </div></td>
												<td>Sept 2, 2016</td>
												
											  </tr>
											  <tr>
												<td>Flexible Server hosting</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
												  </div></td>
												<td>August 11, 2015</td>
												
											  </tr>
											   <tr>
												<td>Virtual Desktop software access</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
												  </div></td>
												<td>June 11, 2016</td>
												
											  </tr>
											  <tr>
												<td>Server hosting Issues</td>
												<td><div class="progress progress-xs mb-0 ">
													<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
												  </div></td>
												<td>August 11, 2016</td>
												
											  </tr>
											</tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<!-- Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">customer support</h6>
								</div>
								<div class="pull-right">
									<a href="#" class="pull-left inline-block full-screen">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display product-overview border-none" id="support_table">
												<thead>
													<tr>
														<th>ticket ID</th>
														<th>Customer</th>
														<th>issue</th>
														<th>Date</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>#85457898</td>
														<td>Jens Brincker</td>
														<td>Droopy chart</td>
														<td>Oct 27</td>
														<td>
															<span class="label label-success">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457897</td>
														<td>Mark Hay</td>
														<td>PSD resolution</td>
														<td>Oct 26</td>
														<td>
															<span class="label label-warning ">Pending</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457896</td>
														<td>Anthony Davie</td>
														<td>Cinnabar</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457895</td>
														<td>David Perry</td>
														<td>Felix PSD</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-danger">pending</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457894</td>
														<td>Anthony Davie</td>
														<td>Beryl iphone</td>
														<td>Oct 25</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457893</td>
														<td>Alan Gilchrist</td>
														<td>Pogody button</td>
														<td>Oct 22</td>
														<td>
															<span class="label label-warning ">Pending</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457892</td>
														<td>Mark Hay</td>
														<td>Beavis sidebar</td>
														<td>Oct 18</td>
														<td>
															<span class="label label-success ">done</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
													<tr>
														<td>#85457891</td>
														<td>Sue Woodger</td>
														<td>Pogody header</td>
														<td>Oct 17</td>
														<td>
															<span class="label label-danger">pending</span>
														</td>
														<td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			</div>
			<!-- Footer -->
			<?php include "Footer.php" ?>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Counter Animation JavaScript -->
	<script src="../vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Data table JavaScript -->
	<script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="dist/js/productorders-data.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="../vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="../vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- EChartJS JavaScript -->
	<script src="../vendors/bower_components/echarts/dist/echarts-en.min.js"></script>
	<script src="../vendors/echarts-liquidfill.min.js"></script>
	
	<!-- Toast JavaScript -->
	<script src="../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard3-data.js"></script>
	
</body>

</html>
