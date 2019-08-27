<?php 
include('includes/header.php'); 


	$query = "SELECT * FROM tbl_branch WHERE branch_status=1 ORDER BY dated DESC";
    $selectBranch = $Branchset->selectBranch($query);

?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Branch Lists:
								</div>

								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample-table-1">
										
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Name</th>
												<th>Email</th>
												<th>Contact</th>
												<th>Branch Man</th>
												<th>Address</th>
												<th>About Branch</th>
												<th>Status</th>
												<th>Created at</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
									   <?php $i=0; if ($selectBranch) {while ($getbrunch=$selectBranch->fetch_assoc()) { $i++; ?>
											<tr>
												<td class="center"><?php echo $i; ?></td>
												<td><?php echo $getbrunch['branch_name']; ?></td>
												<td><?php echo $getbrunch['branch_email']; ?></td>
												<td><?php echo $getbrunch['branch_contact']; ?></td>
												<td><?php echo $getbrunch['branch_man']; ?></td>
												<td><?php echo $getbrunch['branch_address']; ?></td>
												<td>
												
													<?php echo $getbrunch['branch_about']; ?>
												</td>
												<td class="hidden-xs"><?php echo $getbrunch['branch_status']; ?></td>
												<td class="hidden-xs text-center"><?php echo $getbrunch['dated']; ?></td>
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
										 <?php } }else{ echo "Data not found";} ?> 

											
										</tbody>
									</table>
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


<?php 
include('includes/footer.php');
?>
