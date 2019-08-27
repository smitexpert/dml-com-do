<?php 
include('includes/header.php'); 

?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br><br>
					<!-- end: PAGE HEADER -->
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>Create Currency
								</div>
								<div class="panel-body">
									
									<div class="row">
										<div class="col-md-12">
										<?php 
											if (isset($insertcountry)) { ?>
												<div class="alert alert-info fade in">
												    <a href="#" class="close" data-dismiss="alert">&times;</a>
												    <strong><?php echo $insertcountry; ?></strong>
												</div>
										<?php } ?>
										</div>
									</div>

									<form action="add_country.php" method="POST" role="form" id="currencyForm">
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

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">
														Currency Name <span class="symbol required"></span>
													</label>
													<input style="text-transform: uppercase;" required type="text" class="form-control" id="currencyName" name="currencyName">
												</div>
											</div>											

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">
														Currency Rate <span class="symbol required"></span>
													</label>
													<input required type="text" class="form-control" id="currencyRate" name="currencyRate">
												</div>
											</div>


											

											<div class="col-md-3">
											        <label class="control-label">
														 
													</label>
												<input class="btn btn-sm btn-warning btn-block" type="submit" name="submit" value="SUBMIT">
											</div>

										</div>
										<br>
										<div class="col-md-4"></div>

									</form>
								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
						<div class="col-md-1"></div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Currency Lists:
								</div>

								<div class="panel-body table-responsive">
									<div class="tbl">
									<table class="table table-striped table-bordered table-hover table-full-width" id="countrytbl">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Currency Name</th>
												<th>Currency Price</th>
												<!--<th>Last Udpate</th>
												<th>Update By</th>-->
												<th></th>
											</tr>
										</thead>
										<tbody>

									   <?php
                                            $query = "SELECT * FROM currency";
                                            $result = $db->link->query($query);
                                            
                                            if($result->num_rows > 0){
                                                while($row = $result->fetch_assoc()){
                                                    ?>
                                                    <tr>
												<td class="center"><?php echo $row['id']; ?></td>
												<td><?php echo $row['currency_name']; ?></td>
												<td><?php echo $row['currency_rate']; ?></td>
												<!--<td><?php echo $row['last_update']; ?></td>
												<td><?php echo $db->getUserName($row['user']); ?></td>-->
												<td class="center">
												<div class="visible-md visible-lg hidden-sm hidden-xs">
												<button data-toggle="modal" data-target="#myModal" id="<?php echo $row['id']; ?>" type="button" class="btn btn-xs btn-teal tooltips editBtn"><i class="fa fa-edit"></i></button>
													<!--<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>-->
													<a href="#" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
													<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
												</div>
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
                                                    <?php
                                                }
                                            }else { echo "Data not found";} ?> 
										</tbody>
									</table>
									</div>
								</div>
							</div>


							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						<div class="col-md-1"></div>
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->
		
		<div class="" >
            <div class="modal modal-dialog fade" id="myModal" role="dialog">

              <!-- Modal content-->
              <div class="">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Update Currency</h4>
                </div>
                <div class="modal-body">
                  <form action="" id="updateCurrencyRate">
                     <input type="text" id="upCurrencyId" name="upCurrencyId" hidden>
                      <label for="currencyName">Currency Name</label>
                      <input type="text" placeholder="Currency Name" id="upCurrencyName" class="form-control" name="upCurrencyName" disabled><br>
                      <label for="currencyRate">Currency Rate</label>
                      <input type="text" placeholder="Rate" id="upCurrencyRate" class="form-control" name="upCurrencyRate" required><br>
                      <br>
                      <input type="submit" value="Update" class="btn btn-sm btn-warning btn-block">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>


<?php 
include('includes/footer.php');
?>
