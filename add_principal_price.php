<?php 
include('includes/header.php'); 


if (isset($_POST['submit'])) {
    $insertcourcompprice = $Courcompanyset->insertPrincipalPrice($_POST);
}

$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id";
$selectcourcomp = $Courcompanyset->selectcourComp($query);


?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br><br>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>PRINCIPAL PRICE SETTING
								</div>
								<div class="panel-body">									
									<div class="row">
										<div class="col-md-12">
										<?php 
											if (isset($insertcourcompprice)) { ?>
												<div class="alert alert-info fade in">
												    <a href="#" class="close" data-dismiss="alert">&times;</a>
												    <strong><?php echo $insertcourcompprice; ?></strong>
												</div>
										<?php } ?>
										</div>
									</div>

									<form action="add_principal_price.php" method="POST" role="form" id="form">
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
												<select name="cour_comp" required id="cour_comp" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
														<option value="">--</option>
														<?php 
															$selcourcomp = "SELECT * FROM tbl_courier_companies WHERE status=1 ORDER BY cour_comp_name ASC";
																 $execcourcomp =  $Courcompanyset->selectcourComp($selcourcomp);
														while ($findcourcomp=$execcourcomp->fetch_assoc()) { ?>
															<option id="dd" value="<?php echo $findcourcomp['cour_comp_id']; ?>"><?php echo $findcourcomp['cour_comp_name']; ?></option>
														<?php }?>

												</select>
												</div>
											</div>	

											<div class="col-md-3">
												<div class="form-group connected-group">
													<label class="control-label">Route<span class="symbol required"></span>
													</label>
												<select name="route_code" required id="route_code" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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
													<label class="control-label">Country<span class="symbol required"></span> 

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
													<select name="income_or_outgo" id="income_or_outgo" class="form-control" required>
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
													<select name="goods_type" id="goods_type" class="form-control" required>
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
													<select name="unit" required id="unit" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
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
													<input required type="text" class="form-control" id="price" name="price">
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
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
						<div class="col-md-1"></div>
					</div><br>
				

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Company Name</th>
												<th>Zone</th>
												<th>Country</th>
												<th>Where</th>
												<th>Goods Type</th>
												<th>Unit</th>
												<th>Price</th>
												<th>status</th>
												<th></th>
											</tr>
										</thead>

							<?php
								$record_per_page = 5; $page = '';
								if(isset($_GET["page"])){ $page = $_GET["page"]; }else{$page = 1;}
								$start_from = ($page-1)*$record_per_page;

								$query = "SELECT p.*,r.cour_comp_name,c.country_name FROM tbl_principal_price as p,tbl_courier_companies as r,tbl_country as c WHERE p.cour_company = r.cour_comp_id AND p.country_id = c.country_id ORDER BY p.unit ASC LIMIT $start_from, $record_per_page";
								if ($query) {
									$selectcourcomp = $Courcompanyset->selectcourComp($query);
									if (count($selectcourcomp)>0) {?> 
	
									   <?php $i=0; while ($getcourcomp=$selectcourcomp->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getcourcomp['cour_comp_name']; ?></td>
												<td><?php echo $getcourcomp['route_code']; ?></td>
												<td><?php echo $getcourcomp['country_name']; ?></td>
												<td><?php echo $getcourcomp['income_or_outgo']; ?></td>
												<td><?php echo $getcourcomp['goods_type']; ?></td>
												<td><?php echo $getcourcomp['unit']; ?></td>
												<td><?php echo $getcourcomp['price']; ?></td>
												<td class="text-center"><?php echo $getcourcomp['status']; ?></td>
												<td class="center">
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
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
										 <?php } } else{ $msg = "no data found"; echo $msg; } } ?>
									</table>

<!-- pagination code here starts-->
								<div class="row">
									<div class="col-md-12 text-right">
										<?php   
											$page_query = "SELECT * FROM tbl_principal_price ORDER BY id DESC";
										    $page_result = $Courcompanyset->selectcourComp($page_query);
										    $total_records = mysqli_num_rows($page_result);
										    $total_pages = ceil($total_records/$record_per_page);
										    for($i=1; $i<=$total_pages; $i++)
										    {     
										     echo "<a class='page' href='add_principal_price.php?page=".$i."'>".$i."</a>";
										    } 
										 ?>			
									</div>
								</div>
<!-- pagination code here ends-->


						</div>
						<div class="col-md-1"></div>
					</div>



				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>

<script type="text/javascript">
jQuery(document).ready(function($) {



// get principal routed country

		$('#route_code,#cour_comp').on('change', function(event) {
			event.preventDefault();
			srchPrincicountry();
		});

		function srchPrincicountry(){
					$("#loader").show();
					$('#showcntry').hide();
					var corcompany = $('#cour_comp').val();
					var route_code = $('#route_code').val();

					$.ajax({
						url: 'actions.php',
						type: 'POST',
						data: {action:'serchprincicntry',corcompany:corcompany,route_code:route_code},
					})
					.done(function(data) {
						$("#loader").hide();
						$('#showcntry2').html(data);
						//all time will be selected this options
       					$('#multicntry option').prop('selected', true);
						
					})
					.fail(function() {
					})
					.always(function() {
					});


				}



});
</script>