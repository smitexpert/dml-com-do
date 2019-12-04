<?php 

include('includes/header.php'); 
	// $query = "SELECT cons.*,cntry.country_name,cour.cour_comp_name
	//  FROM tbl_consignment as cons,tbl_country as cntry,tbl_courier_companies as cour
	//  WHERE cons.dest_country = cntry.country_id AND cons.assigned_to = cour.cour_comp_id ORDER BY cons.booking_date DESC";	
	 //$query = "SELECT cons.*,cntry.country_name FROM tbl_consignment as cons,tbl_country as cntry WHERE cons.dest_country = cntry.country_id ORDER BY cons.booking_date DESC";



?>



		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>



			<div class="main-content">

				<div class="container"><br><br>

					<div class="row">

						<div class="col-md-12">

							<div class="panel panel-default">

								<div class="panel-heading">

									<i class="fa fa-external-link-square"></i>

									CONSIGNMENT SEARCH BY TRACKING CODE:

								</div>

	
								<div class="panel-body">

								<div class="row">
									<form method="post" action="track_consignment.php">
										<div class="col-md-3">
											<div class="form-group">
													<input type="text" class="form-control" id="trackcode" name="trackcode" placeholder="write track code here">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
													<input type="submit" name="constrackbtn" value="Go" class="btn btn-md btn-success">
											</div>

										</div>
										<div class="col-md-3"></div>
										<div class="col-md-3"></div>
									</form>
								</div>



									<div class="table-responsive">

									<table class="table table-striped table-bordered table-hover" id="sample-table-1">

										<thead>

											<tr>

												<th class="center">#</th>

												<th>Sender Name</th>

												<th>Sender Country</th>

												<th>Recipient Name</th>

												<th>Dest. Country</th>											

												<th>Tracking ID</th>											

												<th>GoodsType</th>

												<th>Assigned To</th>

												<th>Booked By</th>

												<th>Cons. Status</th>

												<th>Actions</th>

											</tr>

										</thead>

										<tbody>

									   <?php 



									   $i=0; 

if (isset($_POST['constrackbtn'])) {
	$track_id = $_POST['trackcode'];

	 // $query = "SELECT cons.*,cntry.country_name FROM tbl_consignment as cons,tbl_country as cntry WHERE cons.dest_country = cntry.country_id AND track_id=$track_id OR custom_trackID = $track_id";	

	  $query = "SELECT cons.* FROM tbl_consignment as cons WHERE track_id=$track_id OR custom_trackID = $track_id";
	 if ($query) {
    	$selectCons = $Consignment->selectConsignment($query);

									   if ($selectCons) { while ($getConsignment=$selectCons->fetch_assoc()) { $i++; ?>
											<tr>

												<td class="center"><?php echo $i; ?></td>

												<td><?php echo $getConsignment['sender_name']; ?></td>

												<td><?php echo $getConsignment['sender_country']; ?></td>

												<td><?php echo $getConsignment['recipient_name']; ?></td>

												<td><?php if (isset($getConsignment['dest_country'])) {
												 echo $getConsignment['dest_country']; 
												}else{echo "";}?></td>	

												<!-- <td> --><?php // if (isset($getConsignment['dest_country'])) {
												//echo $getConsignment['dest_country']; 
												//}else{echo "";}?><!-- </td> -->	

												<td><?php echo $getConsignment['track_id']; ?></td>

												<td><?php echo $getConsignment['goods_type']; ?></td>

												<td><?php echo $getConsignment['assigned_to']; ?></td>

												<td><?php echo $getConsignment['booked_by']; ?></td>

												<td><?php echo $getConsignment['consignment_status']; ?></td>

												<td class="center">

												<div class="visible-md visible-lg hidden-sm hidden-xs">


															<?php if (!empty($getConsignment['assigned_to'])) {?>

													<a href="#" class="btn btn-xs btn-gray tooltips" data-placement="top" data-original-title="menifested"><i class="fa fa-check-square"></i></a>

															<?php }else{ ?> 

													<a href="manifest.php?consid=<?php echo $getConsignment['id']; ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Create Manifest"><i class="fa fa-share"></i></a>

															<?php } ?>




													<a href="#" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>


													<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>

												</div>

												<div class="visible-xs visible-sm hidden-md hidden-lg">

													<div class="btn-group">

														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">

															<i class="fa fa-cog"></i> <span class="caret"></span>

														</a>

														<ul role="menu" class="dropdown-menu pull-right">

															<li role="presentation">
															<?php if (!empty($getConsignment['assigned_to'])) {?>

													<a href="#" class="btn btn-xs btn-gray tooltips" data-placement="top" data-original-title="menifested"><i class="fa fa-check-square"></i></a>

															<?php }else{ ?> 

													<a href="manifest.php?consid=<?php echo $getConsignment['id']; ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Create Manifest"><i class="fa fa-share"></i></a>

															<?php } ?>

															</li>



															<li role="presentation">

																<a role="menuitem" tabindex="-1" href="#">

																	<i class="fa fa-edit"></i> Edit

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

										 <?php } }else{ echo "Data not found";} } }?> 

										</tbody>

									</table>


									</div>

								</div>

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





<?php include('includes/footer.php'); ?>

