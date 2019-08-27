
<?php include('includes/header.php'); ?>

		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>



			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							<!-- start: STYLE SELECTOR BOX -->
							<div id="style_selector" class="hidden-xs">
								<div id="style_selector_container">
									<div class="style-main-title">
										Style Selector
									</div>
									<div class="box-title">
										Choose Your Layout Style
									</div>
									<div class="input-box">
										<div class="input">
											<select name="layout">
												<option value="default">Wide</option><option value="boxed">Boxed</option>
											</select>
										</div>
									</div>
									<div class="box-title">
										Choose Your Header Style
									</div>
									<div class="input-box">
										<div class="input">
											<select name="header">
												<option value="fixed">Fixed</option><option value="default">Default</option>
											</select>
										</div>
									</div>
									<div class="box-title">
										Choose Your Footer Style
									</div>
									<div class="input-box">
										<div class="input">
											<select name="footer">
												<option value="default">Default</option><option value="fixed">Fixed</option>
											</select>
										</div>
									</div>
									<div class="box-title">
										Backgrounds for Boxed Version
									</div>
									<div class="images boxed-patterns">
										<a id="bg_style_1" href="#"><img alt="" src="assets/images/bg.png"></a>
										<a id="bg_style_2" href="#"><img alt="" src="assets/images/bg_2.png"></a>
										<a id="bg_style_3" href="#"><img alt="" src="assets/images/bg_3.png"></a>
										<a id="bg_style_4" href="#"><img alt="" src="assets/images/bg_4.png"></a>
										<a id="bg_style_5" href="#"><img alt="" src="assets/images/bg_5.png"></a>
									</div>
									<div class="box-title">
										5 Predefined Color Schemes
									</div>
									<div class="images icons-color">
										<a id="light" href="#"><img class="active" alt="" src="assets/images/lightgrey.png"></a>
										<a id="dark" href="#"><img alt="" src="assets/images/darkgrey.png"></a>
										<a id="black_and_white" href="#"><img alt="" src="assets/images/blackandwhite.png"></a>
										<a id="navy" href="#"><img alt="" src="assets/images/navy.png"></a>
										<a id="green" href="#"><img alt="" src="assets/images/green.png"></a>
									</div>
									<div class="box-title">
										Style it with LESS
									</div>
									<div class="images">
										<div class="form-group">
											<label>
												Basic
											</label>
											<input type="text" value="#ffffff" class="color-base">
											<div class="dropdown">
												<a class="add-on dropdown-toggle" data-toggle="dropdown"><i style="background-color: #ffffff"></i></a>
												<ul class="dropdown-menu pull-right">
													<li>
														<div class="colorpalette"></div>
													</li>
												</ul>
											</div>
										</div>
										<div class="form-group">
											<label>
												Text
											</label>
											<input type="text" value="#555555" class="color-text">
											<div class="dropdown">
												<a class="add-on dropdown-toggle" data-toggle="dropdown"><i style="background-color: #555555"></i></a>
												<ul class="dropdown-menu pull-right">
													<li>
														<div class="colorpalette"></div>
													</li>
												</ul>
											</div>
										</div>
										<div class="form-group">
											<label>
												Elements
											</label>
											<input type="text" value="#007AFF" class="color-badge">
											<div class="dropdown">
												<a class="add-on dropdown-toggle" data-toggle="dropdown"><i style="background-color: #007AFF"></i></a>
												<ul class="dropdown-menu pull-right">
													<li>
														<div class="colorpalette"></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div style="height:25px;line-height:25px; text-align: center">
										<a class="clear_style" href="#">
											Clear Styles
										</a>
										<a class="save_style" href="#">
											Save Styles
										</a>
									</div>
								</div>
								<div class="style-toggle close"></div>
							</div>
							<!-- end: STYLE SELECTOR BOX -->
							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-pencil"></i>
									<a href="#">
										Forms
									</a>
								</li>
								<li class="active">
									Form Validation
								</li>
								<li class="search-box">
									<form class="sidebar-search">
										<div class="form-group">
											<input type="text" placeholder="Start Searching...">
											<button class="submit">
												<i class="clip-search-3"></i>
											</button>
										</div>
									</form>
								</li>
							</ol>
							<div class="page-header">
								<h1>Form Validation <small>form validation samples</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Form Validation 1
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
									<h2><i class="fa fa-pencil-square teal"></i> REGISTER</h2>
									<p>
										Create one account to manage everything you do with ClipOne, from your shopping preferences to your ClipOne activity.
									</p>
									<hr>
									<form action="#" role="form" id="form">
										<div class="row">
											<div class="col-md-12">
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														First Name <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Insert your First Name" class="form-control" id="firstname" name="firstname">
												</div>
												<div class="form-group">
													<label class="control-label">
														Last Name <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Insert your Last Name" class="form-control" id="lastname" name="lastname">
												</div>
												<div class="form-group">
													<label class="control-label">
														Email Address <span class="symbol required"></span>
													</label>
													<input type="email" placeholder="Text Field" class="form-control" id="email" name="email">
												</div>
												<div class="form-group">
													<label class="control-label">
														Password <span class="symbol required"></span>
													</label>
													<input type="password" class="form-control" name="password" id="password">
												</div>
												<div class="form-group">
													<label class="control-label">
														Confirm Password <span class="symbol required"></span>
													</label>
													<input type="password" class="form-control" id="password_again" name="password_again">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group connected-group">
													<label class="control-label">
														Date of Birth <span class="symbol required"></span>
													</label>
													<div class="row">
														<div class="col-md-3">
															<select name="dd" id="dd" class="form-control" >
																<option value="">DD</option>
																<option value="01">1</option>
																<option value="02">2</option>
																<option value="03">3</option>
																<option value="04">4</option>
																<option value="05">5</option>
																<option value="06">6</option>
																<option value="07">7</option>
																<option value="08">8</option>
																<option value="09">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
																<option value="13">13</option>
																<option value="14">14</option>
																<option value="15">15</option>
																<option value="16">16</option>
																<option value="17">17</option>
																<option value="18">18</option>
																<option value="19">19</option>
																<option value="20">20</option>
																<option value="21">21</option>
																<option value="22">22</option>
																<option value="23">23</option>
																<option value="24">24</option>
																<option value="25">25</option>
																<option value="26">26</option>
																<option value="27">27</option>
																<option value="28">28</option>
																<option value="29">29</option>
																<option value="30">30</option>
																<option value="31">31</option>
															</select>
														</div>
														<div class="col-md-3">
															<select name="mm" id="mm" class="form-control" >
																<option value="">MM</option>
																<option value="01">1</option>
																<option value="02">2</option>
																<option value="03">3</option>
																<option value="04">4</option>
																<option value="05">5</option>
																<option value="06">6</option>
																<option value="07">7</option>
																<option value="08">8</option>
																<option value="09">9</option>
																<option value="10">10</option>
																<option value="11">11</option>
																<option value="12">12</option>
															</select>
														</div>
														<div class="col-md-3">
															<input type="text" placeholder="YYYY" id="yyyy" name="yyyy" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Gender <span class="symbol required"></span>
													</label>
													<div>
														<label class="radio-inline">
															<input type="radio" class="grey" value="" name="gender" id="gender_female">
															Female
														</label>
														<label class="radio-inline">
															<input type="radio" class="grey" value="" name="gender"  id="gender_male">
															Male
														</label>
													</div>
												</div>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">
																Zip Code <span class="symbol required"></span>
															</label>
															<input class="form-control" type="text" name="zipcode" id="zipcode">
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<label class="control-label">
																City <span class="symbol required"></span>
															</label>
															<input class="form-control tooltips" type="text" data-original-title="We'll display it when you write reviews" data-rel="tooltip"  title="" data-placement="top" name="city" id="city">
														</div>
													</div>
												</div>
												<div class="form-group">
													<hr>
													<label class="control-label">
														<strong>Signup for Clip-One Emails</strong> <span class="symbol required"></span>
													</label>
													<p>
														Would you like to review Clip-One emails?
													</p>
													<div>
														<label class="radio-inline">
															<input type="radio" class="grey" value="" name="newsletter">
															No
														</label>
														<label class="radio-inline">
															<input type="radio" class="grey" value="" name="newsletter">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Required Fields
													<hr>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8">
												<p>
													By clicking REGISTER, you are agreeing to the Policy and Terms &amp; Conditions.
												</p>
											</div>
											<div class="col-md-4">
												<button class="btn btn-yellow btn-block" type="submit">
													Register <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 2 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Form Validation 2
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
									<h2><i class="fa fa-pencil-square teal"></i> REGISTER</h2>
									<p>
										Create one account to manage everything you do with ClipOne, from your shopping preferences to your ClipOne activity.
									</p>
									<hr>
									<form action="#" role="form" id="form2">
										<div class="row">
											<div class="col-md-12">
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														First Name <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Insert your First Name" class="form-control" id="firstname2" name="firstname2">
												</div>
												<div class="form-group">
													<label class="control-label">
														Last Name <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Insert your Last Name" class="form-control" id="lastname2" name="lastname2">
												</div>
												<div class="form-group">
													<label class="control-label">
														Email Address <span class="symbol required"></span>
													</label>
													<input type="email" placeholder="Text Field" class="form-control" id="email2" name="email2">
												</div>
												<div class="form-group">
													<label class="control-label">
														Occupation <span class="symbol required"></span>
													</label>
													<input type="text" class="form-control" name="occupation" id="occupation">
												</div>
												<div class="form-group">
													<label class="control-label">
														Dropdown <span class="symbol required"></span>
													</label>
													<select class="form-control" id="dropdown" name="dropdown">
														<option value="">Select...</option>
														<option value="Category 1">Category 1</option>
														<option value="Category 2">Category 2</option>
														<option value="Category 3">Category 5</option>
														<option value="Category 4">Category 4</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Services <em>(select at least two)</em> <span class="symbol required"></span>
													</label>
													<div>
														<div class="checkbox">
															<label>
																<input type="checkbox" class="grey" value="" name="services" id="service1">
																Service 1
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" class="grey" value="" name="services"  id="service2">
																Service 2
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" class="grey" value="" name="services"  id="service3">
																Service 3
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" class="grey" value="" name="services"  id="service4">
																Service 4
															</label>
														</div>
													</div>
												</div>
												<div class="form-group connected-group">
													<label class="control-label">
														Credit Card <em>(e.g: 0000 0000 0000 0000)</em> <span class="symbol required"></span>
													</label>
													<input type="text" class="form-control" id="creditcard" name="creditcard">
												</div>
												<div class="form-group connected-group">
													<label class="control-label">
														URL <em>(e.g: http://www.yoursite.com)</em> <span class="symbol re