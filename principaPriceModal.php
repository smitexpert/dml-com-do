

<!-- PRICE SETTINGS MODAL CODE -->
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10">
											<div id="principalpricemodbtn" class="modal fade " tabindex="-1" data-width="760" style="display: none;">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title">PRINCIPAL PRICE SETTINGS : <span style="color: orange;font-weight: bold" id="clnamemdelhead"></span></h4>
											</div>
											<div class="modal-body">
												<div class="panel-body">

									<form  action="/" role="form" id="principriceinsForm">
										<div class="row">
											<div class="col-md-12">
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
										</div>

										<div class="row">

											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Courier Company<span class="symbol required"></span>
													</label>
												<select name="cour_comp2" required id="courcmomselect2" class="form-control">
														<option id="selectedcour_comp2" value=""></option>
												</select>
												</div>
											</div>	

										


											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Choose Option<span class="symbol required"></span> 

													<div class="center-block text-center" id="loader" style="display: none;">
													<span>Data is loading.. please wait for while</span><br>
													<img  src="assets/images/dataloader.gif" alt="ddd" width="25">
													</div>
													</label>
												
													<div id="showcntry2" style="padding: 4px;border: 1px solid #f3f3f3;background: #D9EDF7;"></div>
												</div>
											</div>
										


											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Where<span class="symbol required"></span>
													</label>
													<select name="income_or_outgo2" id="income_or_outgo2" class="form-control" required>
														<option value="">--</option>
														<option value="incoming">Incoming</option>
														<option value="outgoing">Outgoing</option>
													</select>
												</div>
											</div>	

										</div>	

										<div class="row">							

											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Goods Type<span class="symbol required"></span>
													</label>
													<select name="goods_type2" id="goods_type2" class="form-control" required>
														<option value="">--</option>
														<option value="doc">Document</option>
														<option value="sample">Sample</option>
													</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Unit<span class="symbol required"></span>
													</label>
													<select name="unit2" required id="unit2" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
														<option value="">--</option>

											<?php 
												$slectweight = "SELECT * FROM tbl_weight WHERE status=1 ORDER BY weight ASC";
													 $execweight =  $Courcompanyset->selectcourComp($slectweight);
											while ($findweight=$execweight->fetch_assoc()) { ?>
												<option value="<?php echo $findweight['weight']; ?>"><?php echo $findweight['weight']; ?></option>
											<?php }?>

													</select>
												</div>
											</div>


											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label">
														Price <span class="symbol required"></span>
													</label>
													<input required type="text" class="form-control" id="price2" name="price2">
													<img class="center-block text-center" id="loader2" style="display: none;" src="assets/images/dataloader.gif" alt="ddd" width="25">
													<span style="font-size: 12px;" id="shwpriceprinci"></span>
												</div>

											</div>
										</div>

										<br>
										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-4">
												<input class="btn btn-lg btn-green btn-block" id="submitpricebtn" type="submit" name="submit" value="submit">
												<!-- <a href="#" class="btn btn-lg btn-green btn-block" id="submitprincipricee">Submit</a> -->
											</div>
										</div>
										<div class="col-md-4"></div>

									</form>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" data-dismiss="modal"  class="btn btn-light-grey">
													Close
												</button>
											</div>
											</div>
										</div>
										<div class="col-md-1"></div>
									</div>
<!-- PRICE SETTINGS MODAL CODE -->





<!-- ROUTE SETTINGS MODAL CODE -->
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10" id="clientpricesetmodal">
											<div id="principalroutemodbtn" class="modal fade " tabindex="-1" data-width="760" style="display: none;">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title">PRINCIPAL ROUTE SETTINGS : <span style="color: orange;font-weight: bold" id="clnamemdelhead"></span></h4>
											</div>
											<div class="modal-body">
												<div class="panel-body">
												<!-- <form action="set_principal_route.php" method="POST" role="form" id="princiroutinsform"> -->
													<form action="/" role="form" id="princiroutinsform">
											<div class="row">
												<div class="col-md-12">
													<div class="errorHandler alert alert-danger no-display">
														<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
													</div>
													<div class="successHandler alert alert-success no-display">
														<i class="fa fa-ok"></i> Your form validation is successful!
													</div>
												</div>
											</div>

											<div class="row" id="princiroutsetmodal">


												<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Courier Company<span class="symbol required"></span>
														</label>
														<select name="cour_comp" id="courcomp4" required  class="form-control">
														<option id="selectedcour_comp" value=""></option>
														</select>
													</div>
												</div>	

												<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Route<span class="symbol required"></span>
														</label>
													<select name="route_code" required id="route_code4" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
															<option value="">--</option>
															<?php 
																$selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
																	 $execroute =  $Courcompanyset->selectcourComp($selectroute);
															while ($findroute=$execroute->fetch_assoc()) { ?>
																<option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
															<?php }?>

													</select>
													</div>
												</div>											

												<div class="col-md-3">
													<div class="form-group connected-group">

													<div class="center-block text-center" id="loader4" style="display: none;">
													<span>Data is loading.. please wait for while</span><br>
													<img  src="assets/images/dataloader.gif" alt="ddd" width="25">
													</div>

														<label class="control-label">Country<span class="symbol required"></span>
														</label>

													<div id="showcntry4" style="padding: 4px;border: 1px solid #f3f3f3;background: #D9EDF7;"></div>
													<!-- <select name="country" required id="country" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
															<option value=""></option>
															<?php 
																//$selectcountry = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
																	// $execcountry =  $Courcompanyset->selectcourComp($selectcountry);
															//while ($findcountry=$execcountry->fetch_assoc())// { ?>
															 option id="dd" value="<?php //echo $findcountry['country_id']; ?>"><?php //echo $findcountry['country_name']; ?>
															</option> -->
															<?php ?>

													<!-- </select> --> 
													</div>
												</div>



												<div class="col-md-3">
													<div class="form-group connected-group">
														<label class="control-label">Status<span class="symbol required"></span>
														</label>
														<select name="status" id="status" class="form-control" required>
															<option value="">--</option>
															<option value="1">publish</option>
															<option value="2">pending</option>
														</select>
													</div>
												</div>

											</div>

											<br>
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<input class="btn btn-lg btn-green btn-block" type="submit" name="submit" value="submit">
												</div>
											</div>
											<div class="col-md-4"></div>
													</form>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" data-dismiss="modal"  class="btn btn-light-grey">
													Close
												</button>
											</div>
											</div>
										</div>
										<div class="col-md-1"></div>
									</div>
<!-- ROUTE SETTINGS MODAL CODE -->