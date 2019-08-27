<?php 
	include('includes/header.php'); 
	
	if (isset($_REQUEST['consid'])) {
	$consid = $_REQUEST['consid'];

	$query = "SELECT * FROM tbl_consignment WHERE id=$consid";
    $selectCons = $Consignment->selectConsignment($query);
	$getConsignment=$selectCons->fetch_assoc(); 



	if ($getConsignment) {
		$income_or_outgo = $getConsignment['income_or_outgo'];
		$dest_country = $getConsignment['dest_country'];
		$goods_type = $getConsignment['goods_type'];
		$weight = $getConsignment['goods_weight'];
		if (!empty($income_or_outgo) && !empty($dest_country) && !empty($goods_type) && !empty($weight)) {
			// $queryprincipal = "SELECT p.*,c.country_name FROM tbl_principal_price as p,tbl_country as c WHERE p.country_id = c.country_id AND p.country_id=$dest_country AND p.income_or_outgo='$income_or_outgo' AND p.goods_type='$goods_type' AND p.unit=$weight";

			$queryprincipal = "SELECT p.*,c.country_name,r.cour_comp_name 
			FROM 
			tbl_principal_price as p,tbl_country as c,tbl_courier_companies as r 
			WHERE 
			p.country_id = c.country_id AND p.cour_company = r.cour_comp_id AND p.country_id=$dest_country AND p.income_or_outgo='$income_or_outgo' AND p.goods_type='$goods_type' AND p.unit=$weight ORDER BY price ASC";

			if (isset($queryprincipal)) {
				$selelctprincipal = $Consignment->selectConsignment($queryprincipal);
			}
			
		}
	}else{
		//header('Location:consignment_list.php');
	}




	if (isset($_POST['manifestsubmit'])) {
		if (isset($_REQUEST['consid'])) {
			$consid = $_REQUEST['consid'];
			}
		$cour_comp_id = $_POST['cour_company'];

		if (!empty($income_or_outgo) && !empty($dest_country) && !empty($goods_type) && !empty($weight)) {
			$queryprincipal2 = "SELECT p.*,c.country_name,r.cour_comp_name FROM tbl_principal_price as p,tbl_country as c,tbl_courier_companies as r WHERE p.country_id = c.country_id AND p.cour_company = r.cour_comp_id AND p.country_id=$dest_country AND p.income_or_outgo='$income_or_outgo' AND p.goods_type='$goods_type' AND p.unit=$weight AND cour_company='$cour_comp_id'";
			if (isset($queryprincipal2)) {
				$selelctprincipal2 = $Consignment->selectConsignment2($queryprincipal2);
				$followingdata = $selelctprincipal2->fetch_assoc();
				$selectedocurprice = $followingdata['price'];
				if (!empty($selectedocurprice) && !empty($cour_comp_id)) {
				$runupdateq = $Consignment->updatemenifest($cour_comp_id,$consid,$selectedocurprice);
				}
			}else{ }
			
		}else{}

		// if ($runupdateq) {
		// 	$principicequery = "SELECT price FROM tbl_principal_price";
		// }
	}




	}else{
		//header('Location:consignment_list.php');
	}
	

?>






		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br>
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									<strong>Create Manifest</strong>
								</div><br>
								<div class="panel-body">


								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<span class="offer">Some Information of Consignment</span>
													</tr>
												</thead>
												<tbody>

													<tr>
														<td><strong>Recipient Name</strong></td>
														<td>
															<span class="label label-warning"><strong><?php echo $getConsignment['recipient_name']; ?></strong></span>
														</td>

														<td> <strong>Destination Country</strong></td>
														<td>
															<span class="label label-danger"><strong><?php echo $getConsignment['dest_country']; ?></strong></span>
														</td>

														<td><strong>Tracking ID</strong></td>
														<td>
															<span class="label label-info"> <strong><?php echo $getConsignment['track_id']; ?></strong></span>
														</td>

														<td><strong>Goods Type</strong></td>
														<td>
															<span class="label label-inverse"><strong><?php echo $getConsignment['goods_type']; ?></strong></span>
														</td>

													</tr>


													<tr>

														<td><strong>Weight</strong></td>
														<td>
															<span class="label label-default"> <strong><?php echo $getConsignment['goods_weight']; ?></strong></span>
														</td>

														<td><strong>Consignment Charge</strong></td>
														<td>
															<span class="label label-warning"><strong> <?php echo $getConsignment['total_charge']; ?></strong></span>
														</td>

														<td><strong>Assigned To</strong></td>
														<td>
															<span class="label label-warning"><strong> <?php if (empty($getConsignment['assigned_to'])) { echo "not assigned yet";}else{ echo $getConsignment['assigned_to']; }?></strong></span>
														</td>

														<td><strong>Booking Date</strong></td>
														<td>
															<span class="label label-info"> <strong><?php echo $getConsignment['booking_date']; ?></strong></span>
														</td>

													</tr>



												</tbody>
										</table>
									</div>
								</div><br><br>











									<form action="manifest.php?consid=<?php echo $consid; ?>" role="form" id="formmenifest" method="POST">
										<div class="row">

											<div class="row-fluid">
												<div class="col-md-12">
												<?php 
													if (isset($_REQUEST['msg'])) { ?>
														<div class="alert alert-info fade in">
														    <a href="#" class="close" data-dismiss="alert">&times;</a>
														    <strong>
														    	<?php echo $_REQUEST['msg']; ?>
														    </strong>
														</div>
												<?php } ?>
												</div>
											</div>


											<div class="row-fluid">
												<div class="col-md-6">

													<table class="table table-bordered table-striped">
														<thead>
															<tr>
																<span class="offer">What prices Companies Offers with this correspondent Data</span>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><span class="label label-default">Courier</span></td>
																<td><span class="label label-default">Delivery Charge</span></td>
															</tr>
													<?php 
														if (isset($selelctprincipal)) {
														
														
														while ($getprinicprice=$selelctprincipal->fetch_assoc()) { 

															if (isset($getprinicprice)) { ?>
															<tr>
																<td>
																	<strong><?php echo $getprinicprice['cour_comp_name']; ?></strong>
																	<input type="hidden" name="CourCompName" value="<?php echo $getprinicprice['cour_comp_name']; ?>">
																</td>
																<td>
																	<strong> <?php echo $getprinicprice['price']; ?></strong>
																	<input type="hidden" name="CourCompProposedPrice" value="<?php echo $getprinicprice['price']; ?>">
																</td>
															</tr>
													<?php } } }else{ echo "<br> <br><stong class='label label-warning'> Companies Offer Prices Not Found </strong>"; }?>

														</tbody>
													</table>

												</div>

												<div class="col-md-1"></div>
												<div class="col-md-4">
													<div class="form-group connected-group">
														<label class="control-label"><span class="offer">Assign To </span><span class="symbol required"></span>
														</label>
															<select name="cour_company" required id="cour_company" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
																<option value="">--</option>
																<?php 
																	$slectweight = "SELECT * FROM tbl_courier_companies WHERE status=1 ORDER BY cour_comp_name ASC";
																		 $execweight =  $Corpoclients->selectCorpoClient($slectweight);
																while ($findweight=$execweight->fetch_assoc()) { ?>
																	<option value="<?php echo $findweight['cour_comp_id']; ?>"><?php echo $findweight['cour_comp_name']; ?></option>
																<?php }?>

															</select>
													</div>

													


														<div class="row-fluid">
															<div class="col-md-12">
																<div class="form-group connected-group">
																	<input style="background: #3A87AD !important" class="btn btn-lg btn-green btn-block" type="submit" name="manifestsubmit" value="submit">
																</div>		
															</div>
														</div>



												</div>
												<div class="col-md-1"></div>
											</div><br><br>



									</form>
								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
					</div>

					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->

<?php 
include('includes/footer.php');
?>

<style type="text/css">

</style>